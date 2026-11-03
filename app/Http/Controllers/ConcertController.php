<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConcertRequest;
use App\Models\Concert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

/**
 * Manages concerts (full CRUD, including poster uploads).
 */
class ConcertController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * Supports searching and filtering by status.
     */
    public function index(Request $request)
    {
        $query = Concert::with('ticketCategories');

        // Search by name or location.
        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('name', 'like', "%{$s}%")
                ->orWhere('location', 'like', "%{$s}%");
            });
        }

        // Filter by concert status.
        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        $concerts = $query->latest()->paginate(8)->withQueryString();

        return view('concerts.index', compact('concerts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('concerts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ConcertRequest $request)
    {
        $data = $request->validated();

        // Store the uploaded poster on the public disk (storage/app/public/posters).
        if ($request->hasFile('poster')) {
            $data['poster_url'] = $request->file('poster')->store('posters', 'public');
        }

        // Split the comma-separated lineup into a clean array.
        $data['lineup'] = array_values(array_filter(array_map('trim', explode(',', $request->lineup))));

        Concert::create($data);

        return redirect()->route('concerts.index')->with('success', 'Konser pop punk baru berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Concert $concert)
    {
        $concert->load(['ticketCategories', 'orders.user']);
        return view('concerts.show', compact('concert'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Concert $concert)
    {
        return view('concerts.edit', compact('concert'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ConcertRequest $request, Concert $concert)
    {
        $data = $request->validated();
        if ($request->hasFile('poster')) {
            if ($concert->poster_url && Storage::disk('public')->exists($concert->poster_url)) {
                Storage::disk('public')->delete($concert->poster_url);
            }
            $data['poster_url'] = $request->file('poster')->store('posters', 'public');
        }

        $data['lineup'] = array_values(array_filter(array_map('trim', explode(',', $request->lineup))));

        $concert->update($data);

        return redirect()->route('concerts.index')->with('success', 'Data konser berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Concert $concert)
    {
        // Safe deletion check: prevent deleting if orders exist.
        if ($concert->orders()->exists()) {
            return back()->with('error', 'Konser tidak dapat dihapus karena sudah memiliki riwayat transaksi pesanan tiket.');
        }

        // Remove the poster file from storage.
        if ($concert->poster_url && Storage::disk('public')->exists($concert->poster_url)) {
            Storage::disk('public')->delete($concert->poster_url);
        }

        $concert->delete();

        return redirect()->route('concerts.index')->with('success', 'Konser berhasil dihapus dengan aman.');
    }
}
