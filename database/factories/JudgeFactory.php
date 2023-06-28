<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Contest;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Judge>
 */
class JudgeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $users = User::where('role','judge')->get();
        $c = 0;
        foreach($users as $user){
            $user_ids[$c] = $user->id;
            $c++;
        }


        $contests = Contest::all();
        $o = 0;
        foreach($contests as $contest){
            $con_ids[$o] = $contest->id;
            $o++;
        }

        return [
            'user_id' => fake()->randomElement($user_ids),
            'contest_id' => fake()->randomElement($con_ids),
            'judge_description' => fake()->paragraph,
        ];
    }
}
