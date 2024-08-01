<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;


class UserCreateRequest extends FormRequest
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
            'name' => 'required|min:8|max:255',
            'password' => 'required|min:8|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password_confirm' =>'nullable|same:password',
            'avatar' => ['nullable', File::image()->max('5mb')],
            'role' => 'required',
            'company' => 'required',
            'dob' => 'required',
            'points' => 'nullable'

        ];
    }
}
