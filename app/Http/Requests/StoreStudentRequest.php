<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreStudentRequest extends FormRequest
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
        $studentId  = $this->route('student') ? $this->route('student')->id : null;
    
        $passportId = $this->route('student') && $this->route('student')->passport
            ? $this->route('student')->passport->id : null;
    
        return [
            'name'              => 'required|string|max:255',
            'email'             => [
                'required',
                'email',
                'max:255',
                Rule::unique('students')->ignore($studentId), 
            ],
            'classroom_id'      => ['required', Rule::exists('classrooms', 'id')],

            'passport_number'   => ['required', 'max:255', Rule::unique('passports')->ignore($passportId)],
            'issued_date'       => 'required|date',
            'expiry_date'       => 'required|date',
    
            'subjects'          => 'required|array', 
            'subjects.*'        => [Rule::exists('subjects', 'id')], 
        ];
    }
    
}
