<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class careersDepartments extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Careers Department
        DB::table('career_department')->insert([
            [
                'code' => 'dev',
                'name' => 'Development',
            ],
            [
                'code' => 'design',
                'name' => 'Designing',
            ],
            [
                'code' => 'sales',
                'name' => 'Sales',
            ],
            [
                'code' => 'dm',
                'name' => 'Digital marketing',
            ],
        ]);
    }
}
