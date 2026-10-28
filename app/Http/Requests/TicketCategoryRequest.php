<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TicketCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $category = $this->route('ticket_category');
        $minCapacity = $category ? $category->sold_count : 0;

        return [
            'concert_id' => 'required|exists:concerts,id',
            'name' => 'required|string|max:100',
            'price' => 'required|numeric|min:0',
            'initial_capacity' => 'required|integer|min:' . $minCapacity,
        ];
    }

    public function messages(): array
    {
        return [
            'concert_id.required' => 'Pilih konser tujuan.',
            'concert_id.exists' => 'Konser yang dipilih tidak ditemukan dalam database.',
            'name.required' => 'Nama kategori tiket wajib diisi.',
            'price.required' => 'Harga tiket wajib diisi.',
            'price.min' => 'Harga tiket tidak boleh bernilai negatif.',
            'initial_capacity.required' => 'Kapasitas awal tiket wajib diisi.',
            'initial_capacity.min' => 'Kapasitas awal tidak boleh lebih kecil dari jumlah tiket yang sudah terjual.',
        ];
    }
}
