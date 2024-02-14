<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class StoreProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::id() === 1;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => ['bail', 'required', 'min:5', 'max:100', 'unique:projects'],
            'description' => ['bail', 'required', 'min:10', 'max:300'],
            'content' => ['bail', 'required', 'min:10', 'max:2000'],
            'thumb' => ['bail', 'required', 'image', 'max:2000'],
            'project_url' => ['bail', 'nullable', 'string', 'max:255', Rule::unique('projects')],
            'git_url' => ['bail', 'nullable', 'string', 'max:255', Rule::unique('projects')],
            'type_id' => ['nullable', 'exists:types,id'],
            'technologies' => ['nullable', 'exists:technologies,id'],
        ];
    }
}
