<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\TicketCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Manages ticket orders: listing, details and payment status changes.
 */
class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * Supports searching and filtering by payment status.
     */
    public function index(Request $request)
    {
        // Eager load the relations to keep the query count low.
        $query = Order::with(['user', 'concert', 'ticketCategory']);

        // Search by order code, customer name/email, or concert name.
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

        // Filter by payment status.
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('payment_status', $request->status);
        }

        // Newest first, 10 per page, keeping the current query string.
        $orders = $query->latest()->paginate(10)->withQueryString();

        return view('orders.index', compact('orders'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
        $order->load(['user', 'concert', 'ticketCategory', 'items']);
        return view('orders.show', compact('order'));
    }

    /**
     * Update the payment status of the specified order.
     *
     * Uses an atomic DB transaction with row locking to prevent
     * negative stock and duplicate allocation.
     */
    public function updateStatus(Request $request, Order $order)
    {
        // Validate the incoming status and notes.
        $request->validate([
            'payment_status' => 'required|in:Menunggu Pembayaran,Dibayar,Dibatalkan',
            'notes' => 'nullable|string|max:500',
        ]);

        $newStatus = $request->payment_status;
        $currentStatus = $order->payment_status;

        // If the status did not change, only update the notes.
        if ($newStatus === $currentStatus) {
            $order->update(['notes' => $request->notes]);
            return back()->with('success', 'Catatan pesanan berhasil diperbarui.');
        }

        try {
            DB::transaction(function () use ($order, $currentStatus, $newStatus, $request) {
                // Lock the ticket category row so no other process can modify it.
                $category = TicketCategory::where('id', $order->ticket_category_id)->lockForUpdate()->firstOrFail();

                // An "active" order is one that still holds ticket stock.
                $isCurrentActive = in_array($currentStatus, ['Menunggu Pembayaran', 'Dibayar']);
                $isNewActive = in_array($newStatus, ['Menunggu Pembayaran', 'Dibayar']);

                // Active -> Cancelled: release the reserved stock.
                if ($isCurrentActive && $newStatus === 'Dibatalkan') {
                    $category->sold_count = max(0, $category->sold_count - $order->quantity);
                    $category->save();
                }
                // Cancelled -> Active: check capacity, then reserve the stock again.
                else if ($currentStatus === 'Dibatalkan' && $isNewActive) {
                    $available = $category->initial_capacity - $category->sold_count;
                    if ($order->quantity > $available) {
                        throw new \Exception('Sisa kuota tiket tidak mencukupi untuk memulihkan pesanan ini. Sisa kuota: ' . $available . ' tiket.');
                    }
                    $category->sold_count += $order->quantity;
                    $category->save();
                }

                // Persist the new status and adjust the payment date.
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
            // The transaction is rolled back automatically on failure.
            return back()->with('error', 'Gagal memperbarui status: ' . $e->getMessage());
        }
    }
}
