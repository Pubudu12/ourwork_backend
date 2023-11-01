<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\job_type;

class jobTypesController extends Controller
{   
    /*
    |--------------------------------------------------------------------------
    | Job Type - CREATE
    |--------------------------------------------------------------------------*/

    function  createJob(Request $req){
        $message = '';
        $value = 0;
        $redirect = '';
        $job_type = new job_type;

        $validation = Validator::make($req->all(), [
            'job_type' => ['required']
        ]);

        if ($validation->fails()) {
            $message = 'Please Enter Job type!';
        }else{
            $job_type->name=$req->job_type;
            $res = $job_type->save();
            if ($res) {
                $message = 'Job type created Successfully';
                $value = 1;
                $redirect = '/jobList';
            } else {
                $message = 'Job type is not created';
            }
        }
        return back()->with( array(
            'message' => $message,
            'value' => $value,
            'redirect'=> $redirect
        ));
    }//createJob()


    /*
    |--------------------------------------------------------------------------
    | Job Type - LIST
    |--------------------------------------------------------------------------*/

    function showJobs(){
        $data = job_type::all();
        return view('job_types/jobList',['job_type'=>$data]);
    }//showJobs()


    /*
    |--------------------------------------------------------------------------
    | Job Type - UPDATE
    |--------------------------------------------------------------------------*/
   
    function showData($id){
        $data = job_type::find($id);
        return view('job_types/updateJob',['data'=>$data]);
    }//showData()

    function updateJobType(Request $req){
        $message = '';
        $value = 0;
        $redirect = '';
        $data = job_type::find($req->id);

        $validation = Validator::make($req->all(), [
            'job_type' => ['required']
        ]);
        
        if ($validation->fails()) {
            $message = 'Please Enter Job Type!';
        }else{
            $data->name = $req->job_type;
            $res = $data->save();

            if ($res) {
                $message = 'Job Type Updated Successfully';
                $value = 1;
                $redirect = '/jobList';
            } else {
                $message = 'Job Type is not updated';
            }
        }
        return back()->with( array(
            'message' => $message,
            'value' => $value,
            'redirect'=> $redirect
        ));    
    }//updateJobType()

    /*
    |--------------------------------------------------------------------------
    | Job Type - DELETE
    |--------------------------------------------------------------------------*/

    function deleteJobType($id){
        $message = '';
        $value = 0;
        $redirect = '';
        $data = job_type::find($id);
        
        $res =  $data->delete();

        if($res){
            $message = 'Job Type deleted Successfully';
            $value = 1;
            $redirect = '/jobList';
        }else {
            $message = 'Job Type is not deleted';
        }
    
        return back()->with( array(
            'message' => $message,
            'value' => $value,
            'redirect'=> $redirect
        ));
    }//deleteJobType()
}



    // public function updateCategory(Request $request)
    // {
    //     $message = 0;
    //     $redirect = '';
    //     $value = 0;
    //     $validation = Validator::make($request->all(), [
    //         'category_name' => ['required']
    //     ]);

    //     if ($validation->fails()) {
    //         $message = 'Please enter category name!';
    //     }else{
    //         $category = $request['category_name'];
    //         $id = $request['category_id'];
    //         $dbstate = DB::table("project_category")->where('id', $id)->update(['name'=> $category]);
    //         if ($dbstate == 0) {
    //             $message = "Category not updated!";
    //             $redirect = '/update_category/'.$id;
    //         } else {
    //             $message = "Category successfully updated!";
    //             $value = 1;
    //             $redirect = '/category_list';
    //         }
    //     }
    //     return back()->with( array(
    //         'message' => $message,
    //         'value' => $value,
    //         'redirect'=> $redirect
    //     ));
    // }

