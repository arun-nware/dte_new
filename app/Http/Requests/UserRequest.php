<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UserRequest extends FormRequest
{
    public bool $create;
    public bool $password;
    public string $id;

    public function __construct($create = false, $id, $password = false)
    {
        $this->create = $create;
        $this->password = $password;
        $this->id = $id;
    }

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
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', Rule::unique('users')->whereNull('deleted_at')],
            'email' => ['required', 'string', 'email:dns', 'max:255', Rule::unique('users')->whereNull('deleted_at')],
            'status' => ['nullable', Rule::in([false, true])],
            'role' => ['required', 'string'],
            'designation' => ['required_if:role,Approver,Checker,Maker'],
            'hospital' => ['required_if:role,Approver,Checker,Maker'],
            'medical_college_id' => ['required_if:role,Approver,Checker,Maker'],
            'employee_code' => ['required_if:role,Approver,Checker,Maker', 'max:255', Rule::unique('users')
                ->where(function ($query) {
                    return $query->where('employee_code', '!=', '');
                })->whereNull('deleted_at')
            ],

        ];

        if (!$this->create) {
            $rules['phone'] = ['required', 'string', Rule::unique('users')->ignore($this->id)->whereNull('deleted_at')];
            $rules['email'] = ['required', 'string', 'email:dns', 'max:255', Rule::unique('users')->ignore($this->id)->whereNull('deleted_at')];
            $rules['employee_code'] = ['required', 'max:255', Rule::unique('users')->ignore($this->id)->whereNull('deleted_at')];

            if ($this->password) {
                $rules['password'] = ['required', 'string', 'min:6', 'confirmed'];
                $rules['password_confirmation'] = ['required', 'string', 'min:6'];
            }
        } else {
            $rules['password'] = ['required', 'string', 'min:6', 'confirmed'];
            $rules['password_confirmation'] = ['required', 'string', 'min:6'];
        }
        return $rules;
    }

    public function messages(): array
    {
        return [
            'employee_code.required_if:role' => 'Employee code is required',
            'designation.required_if:role' => 'Designation is required',
            'hospital.required_if:role' => 'Hospital is required',
            'medical_college_id.required_if:role' => 'Medical College is required',
        ];
    }
}
