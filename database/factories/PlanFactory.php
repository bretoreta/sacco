<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Plan>
 */
class PlanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'loan_id' => $this->faker->numberBetween(1,3),
            'name' => ucfirst($this->faker->word()) . ' Plan',
            'repayment_months' => $this->faker->numberBetween(12, 156),
            'interest_rate' => $this->faker->randomNumber(2),
            'penalty_rate' => $this->faker->randomNumber(2)
        ];
    }
}
