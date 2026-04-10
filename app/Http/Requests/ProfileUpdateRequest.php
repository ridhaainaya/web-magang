<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'lowercase',
                'email',
                'max:255',
                Rule::unique(User::class)->ignore($this->user()->id),
            ],

            // Tambahkan aturan untuk kolom-kolom tabel profiles di bawah ini
            'nama_lengkap'       => ['nullable', 'string', 'max:255'],
            'nim_nisn'           => ['nullable', 'string', 'max:50'],
            'no_hp'              => ['nullable', 'string', 'max:20'],
            'jenjang_pendidikan' => ['nullable', 'string', 'max:50'],
            'sekolah_univ'       => ['nullable', 'string', 'max:255'],
            'kota_asal'          => ['nullable', 'string', 'max:100'],
            'jurusan'            => ['nullable', 'string', 'max:100'],
        ];
    }
}
