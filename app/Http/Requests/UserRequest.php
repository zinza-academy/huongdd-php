<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

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
            'name' => 'bail|nullable|min:10',
            'old_password' => 'bail|nullable',
            'password' => 'bail|nullable|min:8',
            'password_confirm' => 'bail|nullable|same:password',
            'avatar' => ['bail', 'nullable', File::image()->max('5mb')->types(['jpg', 'png'])],
        ];
    }
}
