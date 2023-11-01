<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            create_our_work_design_type::class,
            general::class,
            careersDepartments::class,
            careers_detail_reference::class,
            userData::class,
        ]);
    }
}
