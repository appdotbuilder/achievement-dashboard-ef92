<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePresentationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'nullable|string|max:255',
            'presentation' => 'required|file|mimes:ppt,pptx|max:50000', // 50MB max
        ];
    }

    /**
     * Get custom error messages for validator errors.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'presentation.required' => 'Please select a PowerPoint file to upload.',
            'presentation.file' => 'The uploaded file is not valid.',
            'presentation.mimes' => 'The file must be a PowerPoint presentation (.ppt or .pptx).',
            'presentation.max' => 'The presentation file cannot be larger than 50MB.',
        ];
    }
}