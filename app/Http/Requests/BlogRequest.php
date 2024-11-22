<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
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
        $rules = [
            'title' => 'required',
            'description' => 'required',
            'status' => 'boolean',
            'published_at' => 'required',
        ];

        if ($this->isMethod('put') || $this->isMethod('patch')) {
            $rules['published_at'] = 'sometimes|date';
            $rules['title'] = 'sometimes|string';
            $rules['description'] = 'sometimes|string';
            $rules['status'] = 'boolean';
        }

        return $rules;
    }

}
