<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'short_description' => 'required|string|max:500',
            'description' => 'required|string',
            'category_id' => 'required|exists:project_categories,id',
            'project_type' => 'required|in:web_app,ml,cybersecurity,design,data_analysis,api',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:5120',
            'github_url' => 'nullable|url',
            'live_url' => 'nullable|url',
            'featured' => 'boolean',
            'status' => 'required|in:completed,in_progress,archived',
            'technologies' => 'nullable|array',
        ];
    }

    /**
     * Prepare the data for validation.
     */
    protected function prepareForValidation(): void
    {
        // Convert comma-separated technologies string to array
        if ($this->has('technologies') && is_string($this->technologies)) {
            $technologies = array_map('trim', explode(',', $this->technologies));
            $this->merge(['technologies' => $technologies]);
        }
    }

    /**
     * Get custom messages for validation errors.
     */
    public function messages(): array
    {
        return [
            'category_id.required' => 'Please select a category for this project.',
            'category_id.exists' => 'The selected category does not exist.',
            'thumbnail.image' => 'The thumbnail must be a valid image file.',
            'thumbnail.max' => 'The thumbnail image may not be larger than 5MB.',
        ];
    }
}
