<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array {
        return [
            'title'       => 'required|string|max:255',
            'description' => 'required',
        ];
    }

    public function messages() {
        return [
            'title.required'       => 'The title field is mandatory.',
            'title.string'         => 'The title must be a valid string.',
            'title.max'            => 'The title may not be greater than 255 characters.',

            'description.required' => 'The description field is mandatory.',
        ];
    }
}