<?php

namespace Database\Factories;

use App\Models\Contest;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubContest>
 */
class SubContestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $contests = Contest::all();
        $count = 0; 
        foreach ($contests as $contest) {
            $contest_ids[$count] = $contest->id;
            $count++;
        }


        return [
            'contest_id' => fake()->randomElement($contest_ids),
            'subcontest_name' => fake()->word(),
        ];
    }
}
