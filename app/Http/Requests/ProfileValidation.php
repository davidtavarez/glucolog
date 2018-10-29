<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileValidation extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email, '.$this->user()->id,
            'password' => 'nullable|string|min:6|confirmed',
            'birthday' => 'required|date',
            'detection_date' => 'required|date',
            'diabetes' => ['required', 'string', Rule::in(['1', '2'])],
            'sex' => ['required', 'string', Rule::in(['Male', 'Female'])],
        ];
    }
}
