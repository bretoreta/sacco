<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class LoansRequest extends FormRequest
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
            'user.id' => 'required|integer|exists:users,id',
            'loan.id' => 'required|integer|exists:loans,id',
            'loan.min_amount' => 'required|integer',
            'loan.max_amount' => 'required|integer',
            'plan.id' => 'required|integer|exists:plans,id',
            'plan.interest_rate' => 'required|integer|max:100',
            'plan.repayment_months' => 'required|integer',
            'amount_payable' => 'required|integer',
        ];
    }
}
