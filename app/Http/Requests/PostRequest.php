<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
            'title' => 'required|min:8|max:255|string',
            'description' => 'required|',
            'user_id' => 'required',
            'topic_id' => 'required',
            'status' => 'required',
        ];
    }

    public function messages() {
        return [
            // 'tags[].required' => 'Choose tags for your post',
        ];
    }
}
