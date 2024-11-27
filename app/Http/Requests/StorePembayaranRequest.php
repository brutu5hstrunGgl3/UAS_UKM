<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePembayaranRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            
            // pembayaran 
            'name' => 'required|max:100|min:3',
            'no_telp' => 'required|string|max:20',
            'email' => 'required|email',
            'jenis_paket' => 'required',
            'harga' => 'required',
            'status' => 'required',
            'struk' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'tanggal_pembayaran' => 'required',
            
        ];
    }
}
