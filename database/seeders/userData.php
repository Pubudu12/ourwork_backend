<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class userData extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([

            [
                'name' => 'Pubudu',
                'password' => 'pubudu123',
                'email' => 'Pubudu',
                'level' => 1,
                'status' => 1
            ]

        ]);
    }
}
