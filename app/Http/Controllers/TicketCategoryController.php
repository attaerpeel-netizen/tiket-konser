<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketCategoryRequest;
use App\Models\Concert;
use App\Models\TicketCategory;
use Illuminate\Http\Request;

class TicketCategoryController extends Controller
{
    public function index(Request $request)
    {
        $tickets = TicketCategory::with('concert')->latest()->get(); 
        return view('tickets.index', compact('tickets'));
    }

    public function create()
    {
        $concerts = Concert::where('status', '!=', 'Selesai')->get();
        return view('tickets.create', compact('concerts'));
    }

    public function store(TicketCategoryRequest $request)
    {
        TicketCategory::create([
            'concert_id' => $request->concert_id,
            'name' => $request->name,
            'price' => $request->price,
            'initial_capacity' => $request->initial_capacity,
            'sold_count' => 0,
        ]);

        return redirect()->route('tickets.index')->with('success', 'Kategori tiket baru berhasil dibuat.');
    }

    public function edit(TicketCategory $ticketCategory)
    {
        $concerts = Concert::all();
        return view('tickets.edit', compact('ticketCategory', 'concerts'));
    }

    public function update(TicketCategoryRequest $request, TicketCategory $ticketCategory)
    {
        // Rule: new capacity must not be smaller than current sold tickets
        if ($request->initial_capacity < $ticketCategory->sold_count) {
            return back()->withErrors([
                'initial_capacity' => 'Kapasitas baru (' . $request->initial_capacity . ') tidak boleh lebih kecil dari jumlah tiket yang sudah terjual (' . $ticketCategory->sold_count . ').'
            ])->withInput();
        }

        $ticketCategory->update([
            'name' => $request->name,
            'price' => $request->price,
            'initial_capacity' => $request->initial_capacity,
        ]);

        return redirect()->route('tickets.index')->with('success', 'Kategori dan kapasitas tiket berhasil diperbarui.');
    }

    public function destroy(TicketCategory $ticketCategory)
    {
        if ($ticketCategory->orders()->exists()) {
            return back()->with('error', 'Kategori tiket tidak dapat dihapus karena telah memiliki pesanan tiket terkait.');
        }

        $ticketCategory->delete();
        return redirect()->route('tickets.index')->with('success', 'Kategori tiket berhasil dihapus.');
    }
}
