<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectCategoryRequest extends FormRequest
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
            'name' => 'required|string|max:255|unique:project_categories,name',
            'slug' => 'required|string|max:255|unique:project_categories,slug',
            'icon' => 'nullable|string|max:50',
            'color' => 'nullable|regex:/^#[0-9A-F]{6}$/i',
            'description' => 'nullable|string',
        ];
    }
}
