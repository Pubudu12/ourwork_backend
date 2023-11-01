<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class dynamicDependants extends Controller
{

    function index(){
        $job_list=DB::table('job_types')
                    ->get();
        
        $category_list=DB::table('career_department')
                    ->get();
        
        return view('careers/addCareer',['job_list'=>$job_list,'category_list'=>$category_list]);
    }
}
