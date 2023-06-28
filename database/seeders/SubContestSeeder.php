<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class SubContestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('sub_contests')->insert([
            [
                'contest_id' => 1,
                'subcontest_name' => 'Best in Costume'
            ],
            [
                'contest_id' => 1,
                'subcontest_name' => 'Best in Talent'
            ],
            [
                'contest_id' => 1,
                'subcontest_name' => 'Most Photogenic'
            ],

        ]);


        //\App\Models\SubContest::factory(15)->create();
    }
}
