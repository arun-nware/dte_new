<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Payment>
 */
class PaymentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'file_upload_id' => $this->faker->randomDigitNotNull,
            'transaction_type' => $this->faker->randomElement(['I', 'N']),
            'beneficiary_account_id' => $this->faker->regexify('[A-Za-z0-9]{10}'),
            'beneficiary_account_number' => $this->faker->bankAccountNumber,
            'amount' => $this->faker->randomFloat(2, 1000, 10000),
            'beneficiary_account_name' => $this->faker->company,
            'hospital_type' => $this->faker->randomElement(['public', 'private']),
            'dummy_field_1' => $this->faker->word,
            'beneficiary_account_address' => $this->faker->address,
            'beneficiary_account_address1' => $this->faker->optional()->address,
            'dummy_field_2' => $this->faker->optional()->word,
            'dummy_field_3' => $this->faker->optional()->word,
            'dummy_field_4' => $this->faker->optional()->word,
            'state_code' => $this->faker->stateAbbr,
            'unique_transaction_id' => $this->faker->uuid,
            'case_id' => $this->faker->uuid,
            'dummy_field_7' => $this->faker->optional()->word,
            'dummy_field_8' => $this->faker->optional()->word,
            'dummy_field_9' => $this->faker->optional()->word,
            'dummy_field_10' => $this->faker->optional()->word,
            'dummy_field_11' => $this->faker->optional()->word,
            'dummy_field_12' => $this->faker->optional()->word,
            'dummy_field_13' => $this->faker->optional()->word,
            'transaction_date' => $this->faker->dateTime,
            'dummy_field_14' => $this->faker->optional()->word,
            'ifsc_code' => $this->faker->regexify('[A-Za-z]{4}0[A-Z0-9a-z]{6}'),
            'bank_name' => $this->faker->streetName,
            'bank_branch' => $this->faker->streetName,
            'email_id' => $this->faker->email,
            'source_account_number' => $this->faker->bankAccountNumber,
        ];
    }
}
