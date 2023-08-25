<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class JobPostFormRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [            
            'feature_image' => 'required|mimes:png,jpeg,jpg|max:2048',
            'title' => 'required|min:5',
            'description' => 'required|min:20',
            'roles' => 'required',
            'job_type' => 'required',
            'address' => 'required',
            'date' => 'required',
            'salary' => 'required',   
        ];
    }
}
