<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class UserRequest extends FormRequest
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
            'name' => 'bail|nullable|min:10|max:255',
            'old_password' => 'bail|nullable',
            'password' => 'bail|nullable|min:10|max:255',
            'password_confirm' =>'bail|nullable|same:password',
            'avatar' => ['bail', 'nullable', File::image()->max('5mb')],
            'role' => 'nullable',
            'company' => 'nullable',
            'dob' => 'nullable',
        ];
    }

    // public function authenticate() {
    //     if (!Auth::attempt($this->only('old_password'))) {
    //         throw ValidationException::withMessages([
    //             'old_password' => __('auth.failed'),
    //         ]);
    //     }
    // }

    public function withValidator($validator) {
        $validator->after(function ($validator) {
            if (!empty($this->old_password) && !Hash::check($this->old_password, $this->user()->password)) {
                $validator->errors()->add('old_password', 'Wrong password, try again!');
            } else if (empty($this->old_password) && !empty($this->password)) {
                $validator->errors()->add('old_password', 'Your current password is required!');
            }
        });
        return;
    }
}
