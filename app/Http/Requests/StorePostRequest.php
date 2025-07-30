<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check(); // Allow authenticated users
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
            'excerpt' => 'required|string|max:1000',
            'content' => 'required|string',
            'author' => 'required|string|max:255',
            'image' => 'nullable|url|max:500',
            'readTime' => 'nullable|string|max:50',
            'status' => 'in:draft,published',
            'tags' => 'nullable|string|max:1000'
        ];
    }

    /**
     * Get custom validation messages
     */
    public function messages(): array
    {
        return [
            'title.required' => 'The post title is required.',
            'title.max' => 'The post title cannot exceed 255 characters.',
            'excerpt.required' => 'The post excerpt is required.',
            'excerpt.max' => 'The post excerpt cannot exceed 1000 characters.',
            'content.required' => 'The post content is required.',
            'author.required' => 'The author name is required.',
            'author.max' => 'The author name cannot exceed 255 characters.',
            'image.url' => 'The image must be a valid URL.',
            'image.max' => 'The image URL cannot exceed 500 characters.',
            'readTime.max' => 'The read time cannot exceed 50 characters.',
            'status.in' => 'The status must be either draft or published.',
            'tags.max' => 'The tags field cannot exceed 1000 characters.'
        ];
    }
}
