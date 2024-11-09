<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'file_upload_id' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'employee_code' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'employee_name' => $this->faker->name,
            'designation' => $this->faker->optional()->jobTitle,
            'designation_code' => $this->faker->optional()->regexify('[A-Za-z0-9]{5}'),
            'grade' => $this->faker->optional()->word,
            'hospital_id' => $this->faker->optional()->regexify('[A-Za-z0-9]{8}'),
            'hospital_name' => $this->faker->optional()->company,
            'employee_bank_name' => $this->faker->optional()->company,
            'employee_account_no' => $this->faker->optional()->bankAccountNumber,
            'employee_ifsc_code' => $this->faker->optional()->regexify('[A-Za-z]{4}0[A-Z0-9a-z]{6}'),
            'employee_mobile_no' => $this->faker->optional()->phoneNumber,
            'employee_email_id' => $this->faker->optional()->email,
            'employee_pan_no' => $this->faker->optional()->regexify('[A-Z]{5}[0-9]{4}[A-Z]{1}'),
            'employee_aadhar_no' => $this->faker->optional()->regexify('[0-9]{12}'),
            'incentive_amount_cap' => $this->faker->optional()->randomFloat(2, 0, 10000),
            'employee_district' => $this->faker->optional()->city,
            'active' => $this->faker->boolean,
            'status' => $this->faker->randomElement(['pending', 'approved', 'rejected']),
        ];

    }
}
