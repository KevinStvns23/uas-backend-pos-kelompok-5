<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDiscountRequest extends FormRequest 
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'promo_name' => 'required|string|max:255',
            'percentage' => 'required|integer|min:0|max:100',
            'is_active' => 'required|boolean'
        ];
    }
}