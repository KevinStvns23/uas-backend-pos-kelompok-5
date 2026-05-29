<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSubCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'category_id' => 'required|exists:categories,id', //Pastikan ID Kategori valid dan ada di database
            'name' => 'required|string|max:255',
            'description' => 'nullable|string'
        ];
    }
}