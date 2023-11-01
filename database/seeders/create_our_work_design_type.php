<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class create_our_work_design_type extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('our_work_design_type')->insert([
            [
                'code' => 'web',
                'name' => 'Design Web & ecommerce',
            ],
            [
                'code' => 'vr',
                'name' => 'Design 3D VR',
            ],
            [
                'code' => 'zigzag',
                'name' => 'Design Zig Zag',
            ],
            [
                'code' => 'video_zigzag',
                'name' => 'Design Video Zig Zag',
            ],
        ]);

        
    }
}
