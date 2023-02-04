<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateMemberRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore(request()->id)],
            'id_number' => ['required', 'string', 'max:255', Rule::unique('users')->ignore(request()->id)],
            'phone_number' => ['required', 'string', 'max:255'],
            'kra_tax_number' => ['required', 'string', 'max:255'],
            'address' => ['required', 'string', 'max:255'],
        ];
    }
}
