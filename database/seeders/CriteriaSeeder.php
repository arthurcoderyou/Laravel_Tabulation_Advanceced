<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $criterias = ['Talent','Beauty','Intellegence','Character'];
        for($i = 0; $i < 4;$i++){
            DB::table('criterias')->insert([
                [
                    'contest_id' => 1,
                    'criteria_name' => $criterias[$i],
                    'criteria_description' => fake()->sentence,
                    'criteria_percent' => 0.25,
                    
                ],
            ]);
        }

        //\App\Models\Criteria::factory(20)->create();
        
    }
}
