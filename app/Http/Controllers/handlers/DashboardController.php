<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function counts(){
        $posted_career_count = DB::table('careers')
                    ->where('careers.publish_status','=','1')
                    ->select('careers.*')
                    ->get()
                    ->count();

        $all_career_count = DB::table('careers')
                    ->select('careers.*')
                    ->get()
                    ->count();
        
        $posted_works_count = DB::table('ourworks')
                    ->where('ourworks.home_page_view','=','1')
                    ->select('ourworks.*')
                    ->get()
                    ->count();
        
        $all_works_count = DB::table('ourworks')
                    ->select('ourworks.*')
                    ->get()
                    ->count();

        return view('dashboard/dashboard',['posted_career_count'=>$posted_career_count, 'all_career_count'=>$all_career_count, 'posted_works_count'=>$posted_works_count, 'all_works_count'=>$all_works_count]);
    }//counts()
}
