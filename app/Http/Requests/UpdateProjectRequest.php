<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class UpdateProjectRequest extends FormRequest
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
        $id = $this->route('project');
        return [
            'project_name' => [
        'required',
        'string',
        'max:255',
        Rule::unique('projects')->ignore($id),
    ],
            'description'   => 'required|string',
            'start_date'    => 'required|date|after_or_equal:today',
        ];
    }
    protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
    {
        $response = response()->json([
            'success' => false,
            'message' => 'Có lỗi xảy ra khi xác thực dữ liệu',
            'errors' => $validator->errors() // Tự động lấy các lỗi xác thực cụ thể
        ], 422);

        throw new HttpResponseException($response);
    }
}
