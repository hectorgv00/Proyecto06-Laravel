<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class GamesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        Log::alert("Seeders de games");

        DB::table('games')->insert(
            [
                [
                    "title" => "Rocket league",
                    "thumbnail_url" => "aaaa",
                    "url" => "bbbb"
                ],
                [
                    "title" => "League of legends",
                    "thumbnail_url" => "aaaa",
                    "url" => "bbbb"
                ],
                [
                    "title" => "World of Warcraft",
                    "thumbnail_url" => "aaaa",
                    "url" => "bbbb"
                ],
                [
                    "title" => "FIFA",
                    "thumbnail_url" => "aaaa",
                    "url" => "bbbb"
                ],
                [
                    "title" => "The Binding of Isaac",
                    "thumbnail_url" => "aaaa",
                    "url" => "bbbb"
                ],
            ]
        );
    }
}
