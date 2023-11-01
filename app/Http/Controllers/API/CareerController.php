<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Career;

class CareerController extends Controller
{
    public function fetchCareerDetails($career_id){
        $data = DB::table('careers')
                    ->leftjoin('career_details', 'career_details.career_id', '=', 'careers.id')
                    ->leftjoin('detail_sections', 'detail_sections.id', '=', 'career_details.detail_sections_id')
                    ->where('career_details.career_id', '=', $career_id)
                    ->select('career_details.*', 'detail_sections.name', )
                    ->get();

        return $data;
    }

    function viewCareers(){
        $data = DB::table('careers')
                    ->leftjoin('job_types', 'careers.type', '=', 'job_types.id')
                    ->leftjoin('career_department', 'career_department.id', '=', 'careers.category')
                    ->select('careers.id','careers.title AS designation','careers.post_date','careers.close_date','careers.location',
                    'careers.publish_status','careers.description', 
                    'career_department.name AS department', 'job_types.name AS jobType')
                    ->where('careers.publish_status', '=', '1')
                    ->get();
        $dataArray = array();
        foreach ($data as $key => $value) {
            $publishStatus = 'Close';
            if ($value->publish_status == 1) {
                $publishStatus = 'Open';
            }
            array_push($dataArray,array(
                'id'=>$value->id,
                'designation'=>$value->designation,
                'post_date'=>$value->post_date,
                'close_date'=>$value->close_date,
                'location'=>$value->location,
                'publish_status'=>$publishStatus,
                'description'=>$value->description,
                'department'=>$value->department,
                'jobType'=>$value->jobType,
            ));
        }

        $response = [
                     'statusCode'=>200,
                     'message'=>'Successfully fetched',
                     'data'=>$dataArray
                    ];
        return ($response);
    }


    public function filterCareers($category_id = null, $type_id = null){
        $data = array();
        $query = DB::table('careers')
                    ->leftjoin('job_types', 'careers.type', '=', 'job_types.id')
                    ->leftjoin('career_department', 'career_department.id', '=', 'careers.category')
                    ->where('careers.category', '=', $category_id)
                    ->select('careers.id','careers.title AS designation','careers.post_date','careers.close_date','careers.location','careers.publish_status','careers.description', 'career_department.name AS department', 'job_types.name AS jobType');

        if ($type_id != null) {
            $data = $query->where('careers.type', '=', $type_id);
        }
        
        $data = $query->get();

        $dataArray = array();
        foreach ($data as $key => $value) {
            $publishStatus = 'Close';
            if ($value->publish_status == 1) {
                $publishStatus = 'Open';
            }
            array_push($dataArray,array(
                'id'=>$value->id,
                'designation'=>$value->designation,
                'post_date'=>$value->post_date,
                'close_date'=>$value->close_date,
                'location'=>$value->location,
                'publish_status'=>$publishStatus,
                'description'=>$value->description,
                'department'=>$value->department,
                'jobType'=>$value->jobType,
            ));
        }

        $response = [
            'statusCode'=>200,
            'message'=>'Successfully fetched',
            'data'=>$data
           ];
        return response()->json($response);
    }
    
    function singleCareer($career_id){
        $fetchCareerDetails = $this->fetchCareerDetails($career_id);
        $data = DB::table('careers')
                    ->leftjoin('job_types', 'careers.type', '=', 'job_types.id')
                    ->leftjoin('career_department', 'career_department.id', '=', 'careers.category')
                    ->where('careers.id','=',$career_id)                    
                    ->select('careers.id','careers.title AS designation','careers.post_date','careers.close_date','careers.location','careers.publish_status','careers.description', 'career_department.name AS department', 'job_types.name AS jobType')
                    ->first();

        $dataArray = array();
        $detailArray = array();
        foreach ($fetchCareerDetails as $key => $value) {
            array_push($detailArray,array(
                'title'=>$value->name,
                'content'=>$value->description,
            ));
        }
        
        $publishStatus = 'Close';
        if ($data->publish_status == 1) {
            $publishStatus = 'Open';
        }

        array_push($dataArray,array(
            'id'=>$data->id,
            'designation'=>$data->designation,
            'post_date'=>$data->post_date,
            'close_date'=>$data->close_date,
            'location'=>$data->location,
            'publish_status'=>$publishStatus,
            'description'=>$data->description,
            'department'=>$data->department,
            'jobType'=>$data->jobType,
            'details'=>$detailArray
        ));
        
        $response = [
            'statusCode'=>200,
            'message'=>'Successfully fetched',
            'data'=>$dataArray
            ];
        return response()->json($response);
    }
}