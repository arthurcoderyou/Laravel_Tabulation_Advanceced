<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class JudgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $number = 1;
        for($i = 3; $i < 8;$i++){
            DB::table('judges')->insert([
                [
                    'user_id' => $i,
                    'contest_id' => 1,
                    'judge_description' => 'I am judge number '.$number,
                ],
            ]);
            $number++;
        }
        

        //\App\Models\Judge::factory(10)->create();
    }
}
