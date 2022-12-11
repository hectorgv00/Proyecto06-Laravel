<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PartiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        Log::alert("Seeders de parties");

        DB::table('parties')->insert(
            [
                [
                    "name" => "Los mejores",
                    "game" => 1,
                    "owner" => 1
                ],
                [
                    "name" => "Los otrps",
                    "game" => 3,
                    "owner" => 2
                ],
                [
                    "name" => "Los peores",
                    "game" => 5,
                    "owner" => 2
                ],
                [
                    "name" => "Los reguleros",
                    "game" => 2,
                    "owner" => 4
                ],
                [
                    "name" => "Los ",
                    "game" => 5,
                    "owner" => 3
                ],
                
               
            ]
        );
    }
}
