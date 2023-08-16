<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LyricsStoreRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'status' => ['required'],
            'verifier' => ['boolean'],
            'titre' => ['required'],
            'contenu' => ['required', 'min:10'],
            'date_sortie' => ['nullable','date', 'date_format:dd-mm-yy'],
            'video' => ['url'],
            // 'album_id' => ['required']
        ];
    }
}
