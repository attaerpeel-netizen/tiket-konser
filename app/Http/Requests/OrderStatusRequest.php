<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class OrderStatusRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check() && auth()->user()->isAdmin();
    }

    public function rules(): array
    {
        return [
            'payment_status' => [
                'required',
                'string',
                Rule::in(['Menunggu Pembayaran', 'Dibayar', 'Dibatalkan']),
            ],
            'notes' => ['nullable', 'string', 'max:500'],
        ];
    }

    public function messages(): array
    {
        return [
            'payment_status.required' => 'Status pembayaran wajib ditentukan.',
            'payment_status.in' => 'Status pembayaran tidak valid.',
        ];
    }
}
