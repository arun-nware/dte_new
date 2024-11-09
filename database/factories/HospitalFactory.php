<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Hospital>
 */
class HospitalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'hospital_code' => $this->faker->regexify('[A-Za-z0-9]{8}'),
            'hospital_name' => $this->faker->company,
            'sub_type' => $this->faker->optional()->word,
            'medical_college_id' => $this->faker->optional()->numberBetween(1, 11),
            'address_1' => $this->faker->optional()->streetAddress,
            'address_2' => $this->faker->optional()->secondaryAddress,
            'city' => $this->faker->optional()->city,
            'district' => $this->faker->optional()->city,
            'state' => $this->faker->optional()->state,
            'pincode' => $this->faker->optional()->postcode,
            'tds' => '0',
            'revolving_fund' => '0',
            'hospital_fund' => '0',
            'incentive' => '0',
            'non_operative_account_name' => $this->faker->optional()->company,
            'non_operative_account_no' => $this->faker->optional()->bankAccountNumber,
            'non_operative_account_ifsc' => $this->faker->optional()->regexify('[A-Za-z]{4}0[A-Z0-9a-z]{6}'),
            'non_operative_account_detail' => $this->faker->optional()->sentence,
            'settlement_account_name' => $this->faker->optional()->company,
            'settlement_account_no' => $this->faker->optional()->bankAccountNumber,
            'settlement_account_ifsc' => $this->faker->optional()->regexify('[A-Za-z]{4}0[A-Z0-9a-z]{6}'),
            'settlement_account_detail' => $this->faker->optional()->sentence,
            'contact_no' => $this->faker->optional()->phoneNumber,
            'communication_contact_no' => $this->faker->optional()->phoneNumber,
            'email_id' => $this->faker->optional()->email,
            'communication_email_id' => $this->faker->optional()->email,
            'pan' => $this->faker->optional()->regexify('[A-Z]{5}[0-9]{4}[A-Z]{1}'),
            'tan' => $this->faker->optional()->regexify('[A-Z]{4}[0-9]{5}[A-Z]{1}'),
            'status' => '0',
            'transaction_enabled' => '0',
            'hospital_type_id' => '0',
        ];
    }
}
