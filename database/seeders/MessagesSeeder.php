<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MessagesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Log::alert("Seeders de messages");

        DB::table('messages')->insert(
            [
                [
                    "from" => 1,
                    "party" => 1,
                    "message" => "Esa peñita guapa",
                    "date"=> "2022-04-30 13:13:25"
                ],
                
                [
                    "from" => 2,
                    "party" => 2,
                    "message" => "Esa peñita fea",
                    "date"=> "2022-04-30 13:13:25"
                ],
                
                [
                    "from" => 3,
                    "party" => 3,
                    "message" => "Esa peñita loca",
                    "date"=> "2022-04-30 13:13:25"
                ],
                
                [
                    "from" => 4,
                    "party" => 4,
                    "message" => "Esa peñita sincera",
                    "date"=> "2022-04-30 13:13:25"
                ],
                
                [
                    "from" => 5,
                    "party" => 5,
                    "message" => "Esa peñita",
                    "date"=> "2022-04-30 13:13:25"
                ],
                
               
            ]
        );
    }
}
