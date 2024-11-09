<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AddBeneficiaryRequest extends FormRequest
{
    public mixed $id;

    public function __construct($id)
    {
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
        return [
            'region_id' => 'required|max:255',
            'warehouse_code' => 'max:255',
            'warehouse_name' => 'required|string|max:255',
            'warehouse_email_id' => 'required|string|max:255|email:dns',
            'warehouse_mobile_no' => 'required|string|max:10',
            'warehouse_account_no' => 'required|string|max:255|unique:beneficiary_lists,warehouse_account_no',
            'warehouse_IFSC' => 'required|string|max:255',
        ];
    }
}
