<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTugas extends FormRequest
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
            
            'learning' => 'required|max:100|min:3',
            'lecturer' => 'required',
            'file' => 'required|mimes:doc,docx,pdf,xls,xlsx,ppt,pptx|max:2048', 
            
        ];
    }
}
