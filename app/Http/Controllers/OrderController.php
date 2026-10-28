<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\TicketCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with(['user', 'concert', 'ticketCategory']);

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('order_code', 'like', "%{$s}%")
                  ->orWhereHas('user', function ($uq) use ($s) {
                      $uq->where('name', 'like', "%{$s}%")
                         ->orWhere('email', 'like', "%{$s}%");
                  })
                  ->orWhereHas('concert', function ($cq) use ($s) {
                      $cq->where('name', 'like', "%{$s}%");
                  });
            });
        }

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('payment_status', $request->status);
        }

        $orders = $query->latest()->paginate(10)->withQueryString();

        return view('orders.index', compact('orders'));
    }

    public function show(Order $order)
    {
        $order->load(['user', 'concert', 'ticketCategory', 'items']);
        return view('orders.show', compact('order'));
    }

    /**
     * Update order payment status with atomic DB transaction and row locking
     * to prevent negative stock and duplicate allocation.
     */
    public function updateStatus(Request $request, Order $order)
    {
        $request->validate([
            'payment_status' => 'required|in:Menunggu Pembayaran,Dibayar,Dibatalkan',
            'notes' => 'nullable|string|max:500',
        ]);

        $newStatus = $request->payment_status;
        $currentStatus = $order->payment_status;

        if ($newStatus === $currentStatus) {
            $order->update(['notes' => $request->notes]);
            return back()->with('success', 'Catatan pesanan berhasil diperbarui.');
        }

        try {
            DB::transaction(function () use ($order, $currentStatus, $newStatus, $request) {
                // Lock ticket category row for update
                $category = TicketCategory::where('id', $order->ticket_category_id)->lockForUpdate()->firstOrFail();

                $isCurrentActive = in_array($currentStatus, ['Menunggu Pembayaran', 'Dibayar']);
                $isNewActive = in_array($newStatus, ['Menunggu Pembayaran', 'Dibayar']);

                // If transitioning to Dibatalkan -> release stock
                if ($isCurrentActive && $newStatus === 'Dibatalkan') {
                    $category->sold_count = max(0, $category->sold_count - $order->quantity);
                    $category->save();
                }
                // If transitioning from Dibatalkan back to active -> check capacity and re-reserve stock
                else if ($currentStatus === 'Dibatalkan' && $isNewActive) {
                    $available = $category->initial_capacity - $category->sold_count;
                    if ($order->quantity > $available) {
                        throw new \Exception('Sisa kuota tiket tidak mencukupi untuk memulihkan pesanan ini. Sisa kuota: ' . $available . ' tiket.');
                    }
                    $category->sold_count += $order->quantity;
                    $category->save();
                }

                $order->payment_status = $newStatus;
                $order->notes = $request->notes;
                if ($newStatus === 'Dibayar') {
                    $order->payment_date = now();
                } elseif ($newStatus === 'Menunggu Pembayaran') {
                    $order->payment_date = null;
                }
                $order->save();
            });

            return back()->with('success', 'Status pesanan ' . $order->order_code . ' berhasil diubah menjadi: ' . $newStatus);
        } catch (\Exception $e) {
            return back()->with('error', 'Gagal memperbarui status: ' . $e->getMessage());
        }
    }
}
