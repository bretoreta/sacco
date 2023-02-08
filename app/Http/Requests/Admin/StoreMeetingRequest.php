<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StoreMeetingRequest extends FormRequest
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
            'meeting_type.id' => 'required|exists:meeting_types,id',
            'agenda' => 'required|string|max:255',
            'venue' => 'required|string|max:255',
            'happening_on' => 'required|date|after:today',
            'is_invite_only' => 'required|boolean',
        ];
    }
}
