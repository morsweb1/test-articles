<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ArticleUpdateRequest extends FormRequest
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
            'title' => 'required',
            'description' => 'nullable',
            'is_published' => 'nullable',
            'image' => 'nullable|image',
        ];
    }

    public function messages(): array
    {
        return [
            'image.image' => 'Файл должен быть картинкой',
            'title.required' => 'Заголовок обязателен'
        ];
    }
}
