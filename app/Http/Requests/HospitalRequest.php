<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class HospitalRequest extends FormRequest
{
    public bool $create;
    public string $id;

    public function __construct($create = false, $id)
    {
        $this->create = $create;
        $this->id = $id;
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'hospital_code' => ['required', 'string', 'max:255', Rule::unique('hospitals')->whereNull('deleted_at')],
            'hospital_name' => ['required', 'string', 'max:255', Rule::unique('hospitals')->whereNull('deleted_at')],
            'contact_no' => ['required', 'string', Rule::unique('hospitals')->whereNull('deleted_at')],
            'email_id' => ['required', 'string', 'email:dns', 'max:255', Rule::unique('hospitals')->whereNull('deleted_at')],
            'communication_contact_no' => ['required', 'string', Rule::unique('hospitals')->whereNull('deleted_at')],
            'communication_email_id' => ['required', 'string', 'email:dns', 'max:255', Rule::unique('hospitals')->whereNull('deleted_at')],
            'address_1' => ['required', 'string', 'max:255'],
            'address_2' => ['required', 'string', 'max:255'],
            'city' => ['required', 'string', 'max:255'],
            'district' => ['required', 'max:255'],
            'state' => ['required', 'max:255'],
            'pincode' => ['required', 'string', 'max:255'],
            'tds' => ['nullable'],
            'revolving_fund' => ['nullable'],
            'hospital_fund' => ['nullable'],
            'incentive' => ['nullable'],
            'non_operative_account_name' => ['required', 'string', 'max:255', Rule::unique('hospitals')->whereNull('deleted_at')],
            'non_operative_account_no' => ['required', 'string', 'max:255', Rule::unique('hospitals')->whereNull('deleted_at')],
            'non_operative_account_ifsc' => ['required', 'string', 'max:255'],
            'non_operative_account_detail' => ['required', 'string', 'max:255'],
            'settlement_account_name' => ['required', 'string', 'max:255', Rule::unique('hospitals')->whereNull('deleted_at')],
            'settlement_account_no' => ['required', 'string', 'max:255', Rule::unique('hospitals')->whereNull('deleted_at')],
            'settlement_account_ifsc' => ['required', 'string', 'max:255'],
            'settlement_account_detail' => ['required', 'string', 'max:255'],
            'pan' => ['required', 'string', 'max:255'],
            'tan' => ['nullable', 'string', 'max:255'],
            'status' => ['nullable'],
            'transaction_enabled' => ['nullable'],
            'medical_college_id' => ['required'],
        ];

        if (!$this->create) {
            $rules['hospital_code'] = ['required', 'string', 'max:255', Rule::unique('hospitals')->ignore($this->id)->whereNull('deleted_at')];
            $rules['hospital_name'] = ['required', 'string', 'max:255', Rule::unique('hospitals')->ignore($this->id)->whereNull('deleted_at')];
            $rules['contact_no'] = ['required', 'string', Rule::unique('hospitals')->ignore($this->id)->whereNull('deleted_at')];
            $rules['email_id'] = ['required', 'string', 'email:dns', 'max:255', Rule::unique('hospitals')->ignore($this->id)->whereNull('deleted_at')];
            $rules['communication_contact_no'] = ['required', 'string', Rule::unique('hospitals')->ignore($this->id)->whereNull('deleted_at')];
            $rules['communication_email_id'] = ['required', 'string', 'email:dns', 'max:255', Rule::unique('hospitals')->ignore($this->id)->whereNull('deleted_at')];
            $rules['non_operative_account_name'] = ['required', 'string', 'max:255', Rule::unique('hospitals')->ignore($this->id)->whereNull('deleted_at')];
            $rules['non_operative_account_no'] = ['required', 'string', 'max:255', Rule::unique('hospitals')->ignore($this->id)->whereNull('deleted_at')];
            $rules['non_operative_account_ifsc'] = ['required', 'string', 'max:255'];
            $rules['non_operative_account_detail'] = ['required', 'string', 'max:255'];
            $rules['settlement_account_name'] = ['required', 'string', 'max:255', Rule::unique('hospitals')->ignore($this->id)->whereNull('deleted_at')];
            $rules['settlement_account_no'] = ['required', 'string', 'max:255', Rule::unique('hospitals')->ignore($this->id)->whereNull('deleted_at')];

        }
        return $rules;
    }
}

