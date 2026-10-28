<?php

namespace App\Http\Controllers;

use App\Http\Requests\ConcertRequest;
use App\Models\Concert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ConcertController extends Controller
{
    public function index(Request $request)
    {
        $query = Concert::with('ticketCategories');

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where(function ($q) use ($s) {
                $q->where('name', 'like', "%{$s}%")
                ->orWhere('location', 'like', "%{$s}%");
            });
        }

        if ($request->filled('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }

        $concerts = $query->latest()->paginate(8)->withQueryString();

        return view('concerts.index', compact('concerts'));
    }

    public function create()
    {
        return view('concerts.create');
    }

    public function store(ConcertRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('poster')) {
            $data['poster_url'] = $request->file('poster')->store('posters', 'public');
        }

        // Split comma-separated lineup
        $data['lineup'] = array_values(array_filter(array_map('trim', explode(',', $request->lineup))));

        Concert::create($data);

        return redirect()->route('concerts.index')->with('success', 'Konser pop punk baru berhasil ditambahkan.');
    }

    public function show(Concert $concert)
    {
        $concert->load(['ticketCategories', 'orders.user']);
        return view('concerts.show', compact('concert'));
    }

    public function edit(Concert $concert)
    {
        return view('concerts.edit', compact('concert'));
    }

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

    public function destroy(Concert $concert)
    {
        // Safe deletion check: prevent deleting if orders exist
        if ($concert->orders()->exists()) {
            return back()->with('error', 'Konser tidak dapat dihapus karena sudah memiliki riwayat transaksi pesanan tiket.');
        }

        if ($concert->poster_url && Storage::disk('public')->exists($concert->poster_url)) {
            Storage::disk('public')->delete($concert->poster_url);
        }

        $concert->delete();

        return redirect()->route('concerts.index')->with('success', 'Konser berhasil dihapus dengan aman.');
    }
}
