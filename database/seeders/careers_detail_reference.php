<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class careers_detail_reference extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Careers Department
        DB::table('detail_sections')->insert([
            [
                'name' => 'Requirements',
            ],
            [
                'name' => 'Responsibilities',
            ],
            
        ]);
    }
}
