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
            'image' => ['mimes:png,jpg,jpeg,gif']
            // 'album_id' => ['required']
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'status.required' => 'status is required',
            'verifier.boolean' => 'verifier most be a boolean',
            'titre.required' => 'titre is required',
            'contenu.required' => 'contenu is required',
            'date_sortie.date' => 'date_sortie most be a date',
            'video.url' => 'url'
        ];
    }

}
