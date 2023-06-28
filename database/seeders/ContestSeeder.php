<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ContestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('contests')->insert([
            [
                'contest_name' => 'Mr. PSU',

                //mktime(hour, minute, second, month, day, year)
                'announcement_date' => Carbon::create(2023,8,31),
                'show_contest_result' => false,
            ],
            [
                'contest_name' => 'Ms. PSU',

                //mktime(hour, minute, second, month, day, year)
                'announcement_date' => Carbon::create(2023,8,31),
                'show_contest_result' => false,
            ],

            
        ]);


        //for seeding the database with dummy contests by using factories
        //\App\Models\Contest::factory(5)->create();
    }
}
