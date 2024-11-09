<?php

namespace App\Http\Requests;

use App\Models\IfscCode;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EmployeeRequest extends FormRequest
{
    public $create = true;
    public $employeeID;

    public function __construct($create, $employeeID)
    {
        $this->create = $create;
        $this->employeeID = $employeeID;
    }

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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'employee_code' => ['required', 'max:255', Rule::unique('employees')->ignore($this->employeeID)->whereNull('deleted_at')],
            'employee_name' => ['required', 'max:255'],
            'designation' => ['required', 'max:255'],
            'designation_code' => ['required', 'max:255'],
            'grade' => ['required', 'max:255'],
            'hospital_id' => ['required', 'max:255'],
            'hospital_name' => ['required', 'max:255'],
            'employee_district' => ['required', 'max:255'],
            'employee_bank_name' => ['required', 'max:255'],
            'employee_bank_details' => ['required', 'max:255'],
            'employee_account_no' => ['required', 'max:255', Rule::unique('employees')->ignore($this->employeeID)->whereNull('deleted_at')],
            'employee_ifsc_code' => ['required', 'max:255', function ($attr, $value, $fails) {
                $ifscCode = IfscCode::where(['ifsc_code' => $value])->get()->first();
                if (!$ifscCode) {
                    $fails($attr, 'IFSC Code did not match with Master RBI IFSC Code list.');
                }
            }],
            'employee_email_id' => ['required', 'string', 'email:dns', 'max:255', Rule::unique('employees')->whereNull('deleted_at')],
            'employee_mobile_no' => ['required', 'max:255', Rule::unique('employees')->ignore($this->employeeID)->whereNull('deleted_at')],
            'employee_aadhar_no' => ['required', 'max:255', Rule::unique('employees')->ignore($this->employeeID)->whereNull('deleted_at')],
            'employee_pan_no' => ['required', 'max:255', Rule::unique('employees')->ignore($this->employeeID)->whereNull('deleted_at')],
        ];

        if (!$this->create) {
            $rules['employee_code'] = ['required', 'max:255', Rule::unique('employees')->ignore($this->employeeID)->whereNull('deleted_at')];
            $rules['employee_name'] = ['required', 'max:255'];
            $rules['designation'] = ['required', 'max:255'];
            $rules['designation_code'] = ['required', 'max:255'];
            $rules['grade'] = ['required', 'max:255'];
            $rules['hospital_id'] = ['required', 'max:255'];
            $rules['hospital_name'] = ['required', 'max:255'];
            $rules['employee_district'] = ['required', 'max:255'];
            $rules['employee_bank_name'] = ['required', 'max:255'];
            $rules['employee_bank_details'] = ['required', 'max:255'];
            $rules['employee_account_no'] = ['required', 'max:255', Rule::unique('employees')->ignore($this->employeeID)->whereNull('deleted_at')];
            $rules['employee_email_id'] = ['required', 'string', 'email:dns', 'max:255', Rule::unique('employees')->ignore($this->employeeID)->whereNull('deleted_at')];
            $rules['employee_mobile_no'] = ['required', 'max:255', Rule::unique('employees')->ignore($this->employeeID)->whereNull('deleted_at')];
            $rules['employee_aadhar_no'] = ['required', 'max:15', Rule::unique('employees')->ignore($this->employeeID)->whereNull('deleted_at')];
            $rules['employee_pan_no'] = ['required', 'max:255', Rule::unique('employees')->ignore($this->employeeID)->whereNull('deleted_at')];
        }
        return $rules;
    }
}
