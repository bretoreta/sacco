<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class FilterTransactionsRequest extends FormRequest
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
            'for.loan_disbursement' => 'nullable|boolean',
            'for.loan_repayment' => 'nullable|boolean',
            'for.contribution' => 'nullable|boolean',
            'for.deposit' => 'nullable|boolean',
            'date.start' => 'nullable|date',
            'date.end' => 'nullable|date',
            'day' => 'nullable|date',
        ];
    }
}
