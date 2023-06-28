<?php

namespace Database\Factories;

use App\Models\Contest;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Criteria>
 */
class CriteriaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $contests = Contest::all();
        $co = 0;
        foreach ($contests as $contest) {
            $con_ids[$co] = $contest->id;
            $co++;
        }

        return [
            'contest_id' => fake()->randomElement($con_ids),
            'criteria_name' => fake()->word,
            'criteria_description' => fake()->paragraph,
            'criteria_percent' => fake()->randomFloat($nbMaxDecimals = 2, $min = 0.01, $max = 0.99),

        ];
    }
}
