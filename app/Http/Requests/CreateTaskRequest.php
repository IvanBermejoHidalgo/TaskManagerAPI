<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateTaskRequest extends FormRequest
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
            //
            'title' => 'required|string',
            'description' => 'nullable|string',
            'due_date' => 'nullable|date', 
        ];
    }

    public function messages() {
        return [
            'title.required' => 'Title is required',
            'due_date.date' => 'The date format must be Y-m-d'
        ];
    }
}
