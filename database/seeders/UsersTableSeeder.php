<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [   //Admin Account
                'name' => 'Arthur Cervania',
                'email' => 'arthurcervania@gmail.com',
                'password' => Hash::make('@Arthur123'),    
                'photo' => 'admin/admin.jpg',
                'role' => 'admin'
            ],
            
            [   //Admin Account 2
                'name' => 'Milane Batan',
                'email' => 'batan@gmail.com',
                'password' => Hash::make('111'),    
                'photo' => 'admin/admin.jpg',
                'role' => 'admin'
            ],
            
            


            //Judge Account
                [   //id start at 3
                    'name' => 'James Anderson',
                    'email' => 'james@gmail.com',
                    'password' => Hash::make('James@123'), 
                    'photo' => 'judges/j1.jpg', 
                    'role' => 'judge'
                ],
                [   //
                    'name' => 'Michael Jorden',
                    'email' => 'michael@gmail.com',
                    'password' => Hash::make('Michael@123'), 
                    'photo' => 'judges/j2.jpg', 
                    'role' => 'judge'
                ],
                [   //
                    'name' => 'Lebron James',
                    'email' => 'lebron@gmail.com',
                    'password' => Hash::make('Lebron@123'),    
                    'photo' => 'judges/j3.jpg',
                    'role' => 'judge'
                ],
                [   //
                    'name' => 'Kawhi Leonard',
                    'email' => 'kawhi@gmail.com',
                    'password' => Hash::make('Kawhi@123'),    
                    'photo' => 'judges/j4.jpg',
                    'role' => 'judge'
                ],
                [   //
                    'name' => 'Japeth Aguilar',
                    'email' => 'japeth@gmail.com',
                    'password' => Hash::make('Japeth@123'),    
                    'photo' => 'judges/j5.jpg',
                    'role' => 'judge'
                ],
                

            //end of Judge Account
                

            
            //Contestant Account
                //contestant id start at 8
                [
                    'name' => 'Edlyn Dela Cruz',
                    'email' => 'edlyn@gmail.com',
                    'password' => Hash::make('Edlyn@123'),
                    'photo' => 'contestants/c1.jpg',
                    'role' => 'contestant'
                ],
                [
                    'name' => 'Kyla Leandado',
                    'email' => 'kyla@gmail.com',
                    'password' => Hash::make('Kyla@123'),
                    'photo' => 'contestants/c2.jpg',
                    'role' => 'contestant'
                ],
                [
                    'name' => 'Shane Dela Cruz',
                    'email' => 'shane@gmail.com',
                    'password' => Hash::make('Shane@123'),
                    'photo' => 'contestants/c3.jpg',
                    'role' => 'contestant'
                ],
                [
                    'name' => 'Arabelle Ulatan',
                    'email' => 'arabelle@gmail.com',
                    'password' => Hash::make('Arabelle@123'),
                    'photo' => 'contestants/c4.jpg',
                    'role' => 'contestant'    
                ],
                [
                    'name' => 'Janica Aspa',
                    'email' => 'janica@gmail.com',
                    'password' => Hash::make('Janica@123'),
                    'photo' => 'contestants/c5.jpg',
                    'role' => 'contestant'    
                ],
            //end of Contestant Account


            //User Account
                //user_id start at 13
                [   
                    'name' => 'Alexander Orpilla',
                    'email' => 'alexander@gmail.com',
                    'password' => Hash::make('Alexander@123'),
                    'photo' => 'users/u1.jpg',
                    'role' => 'user'
                ],

                [
                    'name' => 'Harris Casiano',
                    'email' => 'harris@gmail.com',
                    'password' => Hash::make('Harris@123'),
                    'photo' => 'users/u2.jpg',
                    'role' => 'user'
                ],
                [
                    'name' => 'James Tercenio',
                    'email' => 'tercenio@gmail.com',
                    'password' => Hash::make('James@123'),
                    'photo' => 'users/u3.jpg',
                    'role' => 'user'
                ],
                [
                    'name' => 'Charlo Cabural',
                    'email' => 'charlo@gmail.com',
                    'password' => Hash::make('Charlo@123'),
                    'photo' => 'users/u4.jpg',
                    'role' => 'user'
                ],
                [
                    'name' => 'Regie Ginez',
                    'email' => 'regie@gmail.com',
                    'password' => Hash::make('Regie@123'),
                    'photo' => 'users/u5.jpg',
                    'role' => 'user'
                ],
            //
            

        ]);

        //\App\Models\User::factory(10)->create();

    }
}
