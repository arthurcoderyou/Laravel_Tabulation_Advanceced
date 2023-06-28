<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ContestantSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cities = ['Mabini','Bani','Sual','Alaminos','Agno'];
        $number = 1;
        for($i = 8;$i < 13;$i++){
            $index = $number - 1;
            DB::table('contestants')->insert([
                [
                    'user_id' => $i,
                    'contest_id' => 1,
                    'contestant_number' => $number,
                    'contestant_message' => 'i am a contestant number '.$number,
                    'contestant_representing' => $cities[$index],
                ],
            ]);
            $number++;
        }

        //\App\Models\Contestant::factory(10)->create();
    }
}
