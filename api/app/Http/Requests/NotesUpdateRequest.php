<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NotesUpdateRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            "title" => "nullable|string|min:1",
            "content" => "nullable|string|min:1",
        ];
    }
}