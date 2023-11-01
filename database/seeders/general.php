<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class general extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('work_link_types')->insert([
            [
                'code' => 'web',
                'name' => 'Website',
            ],
            [
                'code' => 'casestudy',
                'name' => 'Case Study',
            ],
            [
                'code' => 'fb',
                'name' => 'Facebook',
            ],
            [
                'code' => 'insta',
                'name' => 'Instagram',
            ],
            [
                'code' => 'youtube',
                'name' => 'Youtube',
            ],
            [
                'code' => 'googleplay',
                'name' => 'Google Play Store',
            ],
            [
                'code' => 'appstore',
                'name' => 'Apple App Store',
            ],
        ]);

        DB::table('ourwork_categories')->insert([
            [
                'code' => 'web',
                'name' => 'Website & e-Commerce',
                'design_type' => 'web',
                'order' => 1,
            ],
            [
                'code' => 'vr',
                'name' => '3D Virtual Tours',
                'design_type' => 'vr',
                'order' => 2,
            ],
            [
                'code' => 'branding',
                'name' => 'Branding & Designing',
                'design_type' => 'zigzag',
                'order' => 3,
            ],
            [
                'code' => 'cinematography',
                'name' => 'Cinematography',
                'design_type' => 'video_zigzag',
                'order' => 4,
            ],
            [
                'code' => 'dm',
                'name' => 'Digital Marketing',
                'design_type' => 'zigzag',
                'order' => 5,
            ],
            [
                'code' => 'mob_apps',
                'name' => 'Mobile Apps',
                'design_type' => 'zigzag',
                'order' => 6,
            ],
            [
                'code' => 'erp',
                'name' => 'ERP Solutions',
                'design_type' => 'zigzag',
                'order' => 7,
            ],
        ]);


        
        DB::table('job_types')->insert([
            [
                'name' => 'Full Time',
            ],
            [
                'name' => 'Part TIme',
            ],
            [
                'name' => 'Intern',
            ],
        ]);
    }
}
