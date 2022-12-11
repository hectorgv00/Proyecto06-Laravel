<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Party_PlayersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        Log::alert("Seeders de party_players");

        DB::table('party_players')->insert(
            [
                [
                    "player" => 1,
                    "party" => 5,
    
                ],
                [
                    "player" => 1,
                    "party" => 4,
    
                ],
                [
                    "player" => 1,
                    "party" => 3,
    
                ],
                [
                    "player" => 2,
                    "party" => 2,
    
                ],
                [
                    "player" => 2,
                    "party" => 3,
    
                ],
                [
                    "player" => 1,
                    "party" => 1,
    
                ],
                [
                    "player" => 4,
                    "party" => 5,
    
                ],
                [
                    "player" => 2,
                    "party" => 5,
    
                ],
                [
                    "player" => 5,
                    "party" => 5,
    
                ],
                [
                    "player" => 5,
                    "party" => 4,
    
                ],
              
            ]
        );
    }
}
