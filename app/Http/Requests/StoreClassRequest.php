<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClassRequest extends FormRequest
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
            'nama_kelas' => 'required|string|regex:/^[a-zA-Z0-9\s]+$/|max:50', // Aturan validasi
        ];
    }

    public function messages()
    {
        return [
            'nama_kelas.required' => 'Nama kelas wajib diisi.',
            'nama_kelas.string' => 'Nama kelas harus berupa string.',
            'nama_kelas.regex' => 'Nama kelas hanya boleh mengandung huruf, angka, dan spasi.',
            'nama_kelas.max' => 'Nama kelas tidak boleh lebih dari :max karakter.',
        ];
    }
}
