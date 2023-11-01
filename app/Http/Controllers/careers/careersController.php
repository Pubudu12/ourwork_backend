<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\careers;
use App\Models\career_images;
use App\Models\career_details;
class careersController extends Controller
{   

    /*
    |--------------------------------------------------------------------------
    | Career - CREATE
    |--------------------------------------------------------------------------*/ 
    
    public function displayPage(){
        $data = $this->fetchDataToCarees();
        return view('careers/addCareer',['job_list'=>$data['job_list'],'category_list'=>$data['category_list']]);
    }//displayPage()


    function fetchDataToCarees(){
        $job_list=DB::table('job_types')
                    ->get();
        
        $category_list=DB::table('career_department')
                    ->get();
        
        return array('job_list'=>$job_list,'category_list'=>$category_list);
    }//fetchDataToCarees()    


    function addCareer(Request $req){
        $message = '';
        $value = 0;
        $redirect = '';
        $career = new careers;

        $validation = Validator::make($req->all(), [
            'title' => ['required'],
            'close_date' => ['required'],
            'job_types' => ['required'],
            'location' => ['required'],
            'categories' => ['required'],
        ]);
        
        if ($validation->fails()) {
            $message = 'Please Enter All Details!';
        }else{

            $career->title=$req->title;
            $career->post_date=$req->post_date;
            $career->close_date=$req->close_date;
            $career->description=$req->description;
            $career->type=$req->job_types;
            $career->publish_status=1;
            $career->location=$req->location;
            $career->category=$req->categories;

            $res = $career->save();
            
            if ($res) {

                $message = 'Career created Successfully';
                $value = 1;
                $latest_id = DB::table('careers')->orderBy('id', 'desc')->value('id');
                $redirect = '/addCareerImage/'.$latest_id;
            } else {
                $message = 'Career is not created';
            }
        }
        return back()->with( array(
            'message' => $message,
            'value' => $value,
            'redirect'=> $redirect            
        ));
    }//addCareer()


    /*
    |--------------------------------------------------------------------------
    | Career - LIST
    |--------------------------------------------------------------------------*/
    
    function showCareers(){
        $data = DB::table('careers')
                    ->leftjoin('job_types', 'job_types.id', '=', 'careers.type')
                    ->select('careers.*','job_types.name')
                    ->get();

        return view('careers/careerList',['career'=>$data]);
    }//showCareers()

    function viewCareer($career_id){
        $data = DB::table('careers')
                    ->leftjoin('job_types', 'job_types.id', '=', 'careers.type')
                    ->leftjoin('career_department', 'career_department.id', '=', 'careers.category')
                    ->leftjoin('career_images', 'career_images.career_id', '=', 'careers.id')
                    ->where('careers.id','=',$career_id)
                    ->select('careers.*','job_types.name AS type','career_department.name AS department','career_images.career_image AS image')
                    ->first();
        $careerDetails = $this->fetchCareerDetailSections($career_id);
        return view('careers/viewCareer',['career'=>$data,'careerDetails'=>$careerDetails]);
    }
    /*
    |--------------------------------------------------------------------------
    | Career - LIST
    |--------------------------------------------------------------------------*/

    function fetchCategories(){
        $category_list = DB::table('career_department')
                    ->get();

        return $category_list;

    }//fetchCategories()


    function fetchJobs(){
        $job_list = DB::table('job_types')
                    ->get();
        return $job_list;
    }//fetchJobs()

 
    function showDatainCreate($id){
        $job_list = $this->fetchJobs();
        $category = $this->fetchCategories();
        return view('careers/addCareer',['job_list'=>$job_list,'category'=>$category]);
    }//showDatainCreate()
    

    function showData($id){
        $job_list = $this->fetchJobs();
        $category_list = $this->fetchCategories();
        $data = careers::find($id);
        
        return $data;
        return $category_list;
        return $job_list;
    }//showData()


    public function fetchCareerData($id){
        $job_list = $this->fetchJobs();
        $category_list = $this->fetchCategories();
        $data = careers::find($id);
        return view('careers/updateCareer',['data'=>$data,'job_list'=>$job_list, 'category_list'=>$category_list]);
    }//fetchCareerData()


    function updateCareer(Request $req){

        $message = '';
        $value = 0;
        $redirect = '';
        $data = careers::find($req->id);

        $validation = Validator::make($req->all(), [
            'title' => ['required'],
            'close_date' => ['required'],
            'job_types' => ['required'],
            'location' => ['required'],
            'publish_status' => ['required'],
        ]);

        if ($validation->fails()) {
            $message = 'Please Enter All Details!';
        }else{
            $id = $req->id;
            $data->title = $req->title;
            $data->post_date = $req->post_date;
            $data->close_date = $req->close_date;
            $data->type = $req->job_types;
            $data->location = $req->location;
            $data->description = $req->description;
            $data->publish_status = $req->publish_status;

            $res =  $data->save();

            if ($res) {
                $message = 'Career updated Successfully';
                $value = 1;                
                $redirect = '/addCareerImage/'.$id;

            } else {
                $message = 'Career is not updated';
            }
        }
        return back()->with( array(
            'message' => $message,
            'value' => $value,
            'redirect'=> $redirect
        ));
    }//updateCareer()


    /*
    |--------------------------------------------------------------------------
    | Reference Tabs - INSERT and UPDATE
    |--------------------------------------------------------------------------*/

    function fetchSectionDetails($id){
        $careers =  $this->fetchCareerDetails($id);
        $details = $this->fetchCareerDetailSections($id);
        $sections = $this->detailSections($id);
        
        return view('careers/updateCareerDetails',['careers'=>$careers, 'details'=>$details,'sections'=>$sections]);
    }//fetchSectionDetails()

    public function updateCareerDetails(Request $req){
        $message = '';
        $value = 0;
        $redirect = '';
        $data = career_details::find($req->id);

        $validation = Validator::make($req->all(), [
            'description' => ['required']
        ]);
        
        if ($validation->fails()) {
            $message = 'Please Fill All Details!';
        }else{

            $res = DB::table('career_details')
                        ->updateOrInsert(
                            ['career_id' => $req->career_id, 'detail_sections_id' => $req->detail_section_id],
                            ['description' => $req->description]
                        );

            if ($res) {
                $message = 'Career Details Updated Successfully';
                $value = 1;
                $redirect = '/careerList';
            } else {
                $message = 'Career Details are not updated';
            }
        }
        return back()->with( array(
            'message' => $message,
            'value' => $value,
            'redirect'=> $redirect
        ));    

    }//updateCareerDetails()


    /*
    |--------------------------------------------------------------------------
    | Career - DELETE
    |--------------------------------------------------------------------------*/

    function fetchCareerImage($id){
        $careers_image = DB::table('careers')
                            ->leftjoin('career_images', 'careers.id', '=', 'career_images.career_id')
                            ->where('careers.id','=',$id)
                            ->select('careers.*','career_images.career_image AS career_image')
                            ->first();
        return $careers_image;
    }//fetchCareerImage()


    function deleteCareer($id){
        
        $message = '';
        $value = 0;
        $redirect = '';
        $data = careers::find($id);
        
        $careers_image = $this->fetchCareerImage($id);

        $path = public_path().'/uploads/careers/';

        if($careers_image->career_image != ''  && $careers_image->career_image != null){                

            $file_old = $path.$careers_image->career_image;

            if(file_exists($file_old)){
                unlink($file_old);
            }

        }

        $delete_image = career_images::where('career_id', $id)
                            ->delete();
                            
        $delete_data =  $data->delete();

        if($delete_image and $delete_data){           

            $message = 'Career deleted Successfully';
            $value = 1;
            $redirect = '/careerList';

        }else {
            $message = 'Career is not deleted';
        }
    
        return back()->with( array(
            'message' => $message,
            'value' => $value,
            'redirect'=> $redirect
        ));

    }//deleteCareer()


    function jsonToArray($dataArray){
        $formedArray = array();
        $array = json_decode($dataArray['data']);
        foreach ($array as $key => $arr) {
            array_push($formedArray,array(
                $key=>$arr
            ));
        }
        return $formedArray;
    }//jsonToArray

    public function fetchCareerDetailSections($id){
        $details = DB::table('career_details')
                    ->leftjoin('detail_sections', 'detail_sections.id', '=', 'career_details.detail_sections_id')
                    ->where('career_details.career_id','=',$id)
                    ->select('career_details.*','detail_sections.name')
                    ->get();

        $formedArray = array();
        foreach ($details as $key => $value) {
            array_push($formedArray,$value);
        }
        return $details;
    }    


    /*
    |--------------------------------------------------------------------------
    | Career Image - INSERT and UPDATE
    |--------------------------------------------------------------------------*/

    function fetchCareerDetails($id){
        $careers = DB::table('careers')
                            ->where('id','=',$id)
                            ->select('careers.*')
                            ->first();
        return $careers;
    }//fetchCareerDetails()


    function addCareerImage($id){
        $careers = $this->fetchCareerDetails($id);
        $data = career_images::find($id);
        
        return view('careers/addCareerImage',['data'=>$data, 'careers'=>$careers]);
    }//addCareerImage()


    function saveImage(Request $req){
        
        $message = '';
        $value = 0;
        $redirect = '';
        $career_image = new career_images;

        $data = career_images::find($req->id);
        
        $validation = Validator::make($req->all(), [
            'file' => ['required']
        ]);
        
        if ($validation->fails()) {
            $message = 'Please Upload Image!';
        }else{

            if($data === null){
                $image = $req->file('file');
                $image_name = rand().'.'.$image->getClientOriginalExtension();

                $image->move(public_path("uploads/careers"),$image_name);
                $career_image->career_id = $req->career_id;
                $career_image->career_image = $image_name;
                $res = $career_image->save();

                if ($res) {
                    $message = 'Image uploaded Successfully';
                    $value = 1;
                    $redirect = '/updateCareerDetails/'.$req->career_id;
                } else {
                    $message = 'Image is not uploaded';
                }
            }else{
                $path = public_path().'/uploads/careers/';

                if($data->career_image != ''  && $data->career_image != null){                

                    $file_old = $path.$data->career_image;
                    unlink($file_old);
                
                    $image = $req->file('file');
                    $image_name = rand().'.'.$image->getClientOriginalExtension();
                    $image->move(public_path("uploads/careers"),$image_name);
                
                    $res = $data->update(['career_image' => $image_name]);
        
                    if ($res) {
                        $message = 'Image updated Successfully';
                        $value = 1;
                        $redirect = '/updateCareerDetails/'.$req->career_id;
                    } else {
                        $message = 'Image is not updated';
                    }

                }
            }
            
        }

        return back()->with( array(
            'message' => $message,
            'value' => $value,
            'redirect'=> $redirect
        ));    
        
    }//saveImage()

    public function detailSections(){
        $sections = DB::table('detail_sections')
                        ->select('detail_sections.*')
                        ->get();
        return $sections;
    }

    // to delete an image after delete function
    //     if(file_exists(filePath)){
    //         unlink(filePath);
    //     }
}

