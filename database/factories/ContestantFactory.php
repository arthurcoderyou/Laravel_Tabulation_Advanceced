<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Contest;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contestant>
 */
class ContestantFactory extends Factory
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

        //get the contestants
        $count2 = 0;
        $users = User::where('role','contestant')->get();
        foreach ($users as $user) {
            $user_ids[$count2] = $user->id;
            $count2++;
        }


        return [
            
            'user_id' => fake()->randomElement($user_ids),
            'contest_id' => fake()->randomElement($contest_ids),
            'contestant_number' => fake()->randomDigit,
            'contestant_message' => fake()->paragraph,
            'contestant_representing' => fake()->country,
            
        ];
    }
}
