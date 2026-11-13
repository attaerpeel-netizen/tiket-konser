<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConcertRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'lineup' => 'required|string',
            'date_time' => 'required|date',
            'location' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:Draft,Akan Datang,Berlangsung,Selesai',
            'poster' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:3072',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Nama konser wajib diisi.',
            'lineup.required' => 'Daftar artis atau band pengisi acara wajib diisi.',
            'date_time.required' => 'Tanggal dan waktu konser wajib diisi.',
            'location.required' => 'Lokasi panggung/venue konser wajib diisi.',
            'description.required' => 'Deskripsi konser wajib diisi.',
            'status.required' => 'Pilih status konser.',
            'poster.image' => 'Berkas poster harus berupa format gambar valid (JPG, PNG, WebP).',
            'poster.max' => 'Ukuran berkas poster maksimal 3MB.',
        ];
    }
}
