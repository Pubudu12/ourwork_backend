<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

use App\Models\detail_sections;

class detailSectionsController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Details Section - CREATE
    |--------------------------------------------------------------------------*/

    function  addDetailSection(Request $req){
        $message = '';
        $value = 0;
        $redirect = '';
        $detail_section = new detail_sections;

        $validation = Validator::make($req->all(), [
            'detail_section' => ['required']
        ]);
        
        if ($validation->fails()) {
            $message = 'Please Enter Reference Tab!';
        }else{
            $detail_section->name=$req->detail_section;
            $res = $detail_section->save();

            if ($res) {
                $message = 'Reference Tab created Successfully';
                $value = 1;
                $redirect = '/detailSectionList';
            } else {
                $message = 'Reference Tab is not created';
            }
        }
        return back()->with( array(
            'message' => $message,
            'value' => $value,
            'redirect'=> $redirect
        ));        
    }//addDetailSection()


    /*
    |--------------------------------------------------------------------------
    | Details Section - LIST
    |--------------------------------------------------------------------------*/
    
    function showDetailSections(){
        $data = detail_sections::all();
        return view('detail_section/detailSectionList',['data'=>$data]);
    }//showDetailSections()


    /*
    |--------------------------------------------------------------------------
    | Details Section - UPDATE
    |--------------------------------------------------------------------------*/
  
    function showData($id){
        $data = detail_sections::find($id);
        return view('detail_section/updateDetailSection',['data'=>$data]);
    }//showData()


    function updateDetailSection(Request $req){
        $message = '';
        $value = 0;
        $redirect = '';
        $data = detail_sections::find($req->id);

        $validation = Validator::make($req->all(), [
            'name' => ['required']
        ]);

        if ($validation->fails()) {
            $message = 'Please Enter Reference Tab!';
        }else{
            $data->name = $req->name;
            $res = $data->save();

            if ($res) {
                $message = 'Reference Tab Updated Successfully';
                $value = 1;
                $redirect = '/detailSectionList';
            } else {
                $message = 'Reference Tab is not updated';
            }
        }

        return back()->with( array(
            'message' => $message,
            'value' => $value,
            'redirect'=> $redirect
        ));    
    }//updateDetailSection()


    /*
    |--------------------------------------------------------------------------
    | Details Section - DELETE
    |--------------------------------------------------------------------------*/
  
    function deleteDetailSection($id){
        $message = '';
        $value = 0;
        $redirect = '';
        $data = detail_sections::find($id);
        
        $res =  $data->delete();

        if($res){
            $message = 'Reference Tab deleted Successfully';
            $value = 1;
            $redirect = '/detailSectionList';
        }else {
            $message = 'Reference Tab is not deleted';
        }
    
        return back()->with( array(
            'message' => $message,
            'value' => $value,
            'redirect'=> $redirect
        ));

    }//deleteDetailSection()

}
