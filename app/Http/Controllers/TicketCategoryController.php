<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketCategoryRequest;
use App\Models\Concert;
use App\Models\TicketCategory;
use Illuminate\Http\Request;

/**
 * Manages the ticket categories (e.g. VIP, Festival) of each concert.
 */
class TicketCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tickets = TicketCategory::with('concert')->latest()->get();
        return view('tickets.index', compact('tickets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $concerts = Concert::where('status', '!=', 'Selesai')->get();
        return view('tickets.create', compact('concerts'));
    }

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TicketCategory $ticketCategory)
    {
        $concerts = Concert::all();
        return view('tickets.edit', compact('ticketCategory', 'concerts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TicketCategoryRequest $request, TicketCategory $ticketCategory)
    {
        // Rule: the new capacity must not be smaller than the tickets already sold.
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TicketCategory $ticketCategory)
    {
        if ($ticketCategory->orders()->exists()) {
            return back()->with('error', 'Kategori tiket tidak dapat dihapus karena telah memiliki pesanan tiket terkait.');
        }

        $ticketCategory->delete();
        return redirect()->route('tickets.index')->with('success', 'Kategori tiket berhasil dihapus.');
    }
}
