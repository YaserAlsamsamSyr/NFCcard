<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
            'img'=>'required|image|mimes:jpeg,jpg,png,gif',
            'firstName'=> ['required', 'string', 'max:255'],
            'lastName'=> ['required', 'string', 'max:255'],
            'address'=>  ['required', 'string', 'max:255'],
            'age'=>'numeric|min:1|max:150',
            'password'=>'required|unique:employees|max:255',
            'phone'=>'required|regex:/^[0-9]{8,9}$/'
        ];
    }
}
