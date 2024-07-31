<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\File;
use Illuminate\Support\Facades\Hash;

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
            'name' => 'nullable|min:10|max:255',
            'old_password' => 'nullable',
            'password' => 'nullable|min:10|max:255',
            'password_confirm' =>'nullable|same:password',
            'avatar' => ['nullable', File::image()->max('5mb')],
            'role' => 'nullable',
            'company' => 'nullable',
            'dob' => 'nullable',
        ];
    }

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
