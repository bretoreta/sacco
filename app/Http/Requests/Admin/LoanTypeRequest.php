<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class LoanTypeRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return request()->user()->hasRole('admin');
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'loan_type' => 'required|string|max:255',
            'loan_description' => 'required|string|max:255',
            'min_amount' => 'required|integer|min:100',
            'max_amount' => 'required|integer|min:100|gt:min_amount',
        ];
    }
}
