<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAchievementRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'metric_type' => 'required|string|in:count,percentage,currency,decimal',
            'value' => 'required|numeric|min:0',
            'target_value' => 'nullable|numeric|min:0',
            'unit' => 'nullable|string|max:20',
            'period' => 'required|string|in:daily,weekly,monthly,quarterly,yearly',
            'date' => 'required|date',
            'category' => 'nullable|string|max:100',
            'color' => 'nullable|string|regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/',
            'is_active' => 'boolean',
            'onedrive_sheet_id' => 'nullable|string|max:255',
            'onedrive_range' => 'nullable|string|max:50',
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
            'title.required' => 'Achievement title is required.',
            'description.required' => 'Achievement description is required.',
            'metric_type.required' => 'Metric type is required.',
            'metric_type.in' => 'Metric type must be one of: count, percentage, currency, decimal.',
            'value.required' => 'Achievement value is required.',
            'value.numeric' => 'Achievement value must be a number.',
            'period.required' => 'Time period is required.',
            'period.in' => 'Period must be one of: daily, weekly, monthly, quarterly, yearly.',
            'date.required' => 'Achievement date is required.',
            'color.regex' => 'Color must be a valid hex color code.',
        ];
    }
}