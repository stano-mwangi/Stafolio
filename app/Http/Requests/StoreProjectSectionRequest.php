<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectSectionRequest extends FormRequest
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
            'project_id' => 'required|exists:projects,id',
            'section_type' => 'required|in:text,image,gallery,code,notebook_step,metrics,visualization,timeline,embedded_video,features',
            'title' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'gallery.*' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
            'metadata' => 'nullable|array',
            'sort_order' => 'nullable|integer|min:0',
        ];
    }

    /**
     * Get custom validation messages
     */
    public function messages(): array
    {
        return [
            'image.image' => 'The image must be a valid image file (JPG, PNG, or WebP).',
            'image.mimes' => 'The image must be in JPG, PNG, or WebP format.',
            'image.max' => 'The image must not exceed 2MB. Current server limit is 2MB.',
            'gallery.*.image' => 'All gallery items must be valid image files.',
            'gallery.*.mimes' => 'All gallery items must be in JPG, PNG, or WebP format.',
            'gallery.*.max' => 'Each image must not exceed 2MB.',
        ];
    }
}
