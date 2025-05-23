<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
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
            'post' => ['nullable'],
            'images' => ['nullable', 'image', 'mimes:png,jpg,jpeg,gif', 'max:2048'],
            'parent_id'=>['nullable','exists:posts,id']
        ];
    }
    
}
