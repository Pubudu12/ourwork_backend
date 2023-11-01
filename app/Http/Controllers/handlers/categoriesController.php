<?php
use GuzzleHttp\Client;
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use App\Models\career_department;

class categoriesController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Job Category - CREATE
    |--------------------------------------------------------------------------*/
    
    function  createCategory(Request $req){
        $message = '';
        $value = 0;
        $redirect = '';
        $careerDepartment = new careerDepartment;

        $validation = Validator::make($req->all(), [
            'category' => ['required']
        ]);
        
        if ($validation->fails()) {
            $message = 'Please Enter Category!';
        }else{
            $careerDepartment->name=$req->category;
            $res = $careerDepartment->save();

            if ($res) {
                $message = 'Department created Successfully';
                $value = 1;
                $redirect = '/categoryList';
            } else {
                $message = 'Department is not created';
            }
        }
        return back()->with( array(
            'message' => $message,
            'value' => $value,
            'redirect'=> $redirect
        ));        
    }//createCategory()

    /*
    |--------------------------------------------------------------------------
    | Job Category - LIST
    |--------------------------------------------------------------------------*/
    
    function showCategories(){
        $data = career_department::all();
        return view('categories/categoryList',['category'=>$data]);
    }//showCategories()


    /*
    |--------------------------------------------------------------------------
    | Job Category - UPDATE
    |--------------------------------------------------------------------------*/

    function showData($id){
        $data = career_department::find($id);
        return view('categories/updateCategory',['data'=>$data]);
    }//showData()


    function updateCategory(Request $req){
        $message = '';
        $value = 0;
        $redirect = '';
        $data = career_department::find($req->id);

        $validation = Validator::make($req->all(), [
            'name' => ['required']
        ]);

        if ($validation->fails()) {
            $message = 'Please Enter Category!';
        }else{
            $data->name = $req->name;
            $res = $data->save();

            if ($res) {
                $message = 'Department Updated Successfully';
                $value = 1;
                $redirect = '/categoryList';
            } else {
                $message = 'Department is not updated';
            }
        }
        return back()->with( array(
            'message' => $message,
            'value' => $value,
            'redirect'=> $redirect
        ));    
    }//updateCategory()


    /*
    |--------------------------------------------------------------------------
    | Job Category - DELETE
    |--------------------------------------------------------------------------*/
  
    function deleteCategory($id){
        $message = '';
        $value = 0;
        $redirect = '';
        $data = career_department::find($id);
        
        $res =  $data->delete();

        if($res){
            $message = 'Department deleted Successfully';
            $value = 1;
            $redirect = '/categoryList';
        }else {
            $message = 'Department is not deleted';
        }
    
        return back()->with( array(
            'message' => $message,
            'value' => $value,
            'redirect'=> $redirect
        ));
    }//deleteCategory()

}
