<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Loan>
 */
class LoanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'loan_type' => ucfirst($this->faker->word()) . ' Loan',
            'loan_description' => $this->faker->sentence(12),
            'min_amount' => $this->faker->numberBetween(100, 200),
            'max_amount' => $this->faker->numberBetween(100000, 900000),
        ];
    }
}
