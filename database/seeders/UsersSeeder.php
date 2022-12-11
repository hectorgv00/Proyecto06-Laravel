<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
       
        Log::alert("Seeders de users");

        DB::table('users')->insert(
            [
                [
                    "username" => "thoggan0",
                    "steamUsername" => "thoggan0",
                    "password" => "password12345",
                    "email" => "gousby0@hud.gov"
                ],
                [
                    "username" => "hmctaggart1",
                    "steamUsername" => "hmctaggart1",
                    "password" => "password12345",
                    "email" => "cbarke1@indiatimes.com"
                ],
                [
                    "username" => "lgeipel2",
                    "steamUsername" => "lgeipel2",
                    "password" => "password12345",
                    "email" => "iciotto2@mayoclinic.com"
                ],
                [
                    "username" => "asnare3",
                    "steamUsername" => "asnare3",
                    "password" => "password12345",
                    "email" => "mcosgry3@imdb.com"
                ],
                [
                    "username" => "mparker4",
                    "steamUsername" => "mparker4",
                    "password" => "password12345",
                    "email" => "mkienlein4@bbb.org"
                ],
               
            ]
        );
    }
}
