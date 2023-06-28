<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SubCriteriaJudgmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sub_criterias')->insert([
            [
                'criteria_id' => 1,
                'sub_criteria_name' => 'Uniqueness',
                'sub_criteria_percent' => 0.25,
            ],
            [
                'criteria_id' => 1,
                'sub_criteria_name' => 'Hardness',
                'sub_criteria_percent' => 0.25,
            ],
            [
                'criteria_id' => 1,
                'sub_criteria_name' => 'Impact',
                'sub_criteria_percent' => 0.50,
            ],

        ]);
    }
}
