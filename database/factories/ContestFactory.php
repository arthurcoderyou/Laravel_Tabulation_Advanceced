<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contest>
 */
class ContestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        /**$table->string('contest_name');
            $table->date('announcement_date')->nullable();
            $table->boolean('show_contest_result')->default(false); */
        return [
            'contest_name' => fake()->word(),
            'announcement_date' => fake()->date($format = 'Y-m-d',$max = 'now'),
            'show_contest_result' => fake()->boolean
        ];
    }
}
