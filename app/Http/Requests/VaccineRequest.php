<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class VaccineRequest extends FormRequest
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
            'name' => 'required|string|max:50',
            'nid' => 'required|numeric|digits_between:1,16|unique:users,nid',
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'required|string|max:11|unique:users,phone_number|regex:/^(01[3-9]\d{8})$/',
            'vaccine_center_id' => 'required|exists:vaccine_centers,id',
        ];
    }
}
