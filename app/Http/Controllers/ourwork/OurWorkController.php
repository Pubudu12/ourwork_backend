<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use App\Models\ourworks;
use App\Models\ourwork_links;
use App\Models\ourwork_category;
use App\Models\ourwork_images;
use App\Models\case_study;
use App\Models\ourwork_videos;
use Illuminate\Support\Facades\Config;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class OurWorkController extends Controller
{

    private $imageOurWorkStroPath;

    public function __construct()
    {
        $this->imageOurWorkStroPath = Config::get('siteGlobalVar.ourWorkImagesPath');
        if (!file_exists($this->imageOurWorkStroPath)) {
            mkdir($this->imageOurWorkStroPath, 0777, true);
        }
        
    }

    /*
    |--------------------------------------------------------------------------
    | Send Data to Our Work View 
    |--------------------------------------------------------------------------*/

    public function showOurWork(){
        

        $categories = DB::table('ourwork_categories')
                        ->select('*')
                        ->get();

        $link_types = DB::table('work_link_types')
                        ->select('*')
                        ->get();

        return view('ourWork/works/createOurWork',['categories'=>$categories, 'link_types'=>$link_types]);

    }//showOurWork()


    /*
    |--------------------------------------------------------------------------
    | Our Work Links - CREATE / DELETE 
    |--------------------------------------------------------------------------*/

    public function createWorkLinks($work_id, $linkTypeArray ,$linkArray){
        
        $workLinks = ourwork_links::where('ourwork_id', $work_id)->get();

        if($workLinks->count() > 0){
            foreach ($workLinks as $key => $value) {
                $data = ourwork_links::find($value->id);
                $data->delete();
            }
        }

        if(isset($linkTypeArray)){
            foreach ($linkTypeArray as $key => $type) {
                ourwork_links::insert(['ourwork_id' => $work_id, 'type'=>$type,'link'=>$linkArray[$key]]);
            }
        }
    } //createWorkLinks()

    /*
    |--------------------------------------------------------------------------
    | Our Work - CREATE
    |--------------------------------------------------------------------------*/

    public function createOurWork(Request $req){
        $message = '';
        $value = 0;
        $redirect = '';
        $ourwork = new ourworks;
        $links = new ourwork_links;

        $validation = Validator::make($req->all(), [
            'title' => ['required'],
            'categories' => ['required']
        ]);

        if ($validation->fails()) {
            $message = 'Please Enter All Details!';
        }else{
            $homePageView = '0';
            if (isset($req->homePageView)) {
                $homePageView = '1';
            }
            $status = '0';
            if (isset($req->status)) {
                $status = '1';
            }

            $ourwork->title = $req->title;
            $ourwork->category = $req->categories;
            $ourwork->description = $req->description;
            $ourwork->home_page_view = $homePageView;            
            $ourwork->status = $status;

            $res = $ourwork->save();

            $linkArray = $req['link'];
            $linkTypeArray = $req['link_type'];

            if ($res) {
                $message = 'Work created Successfully';
                $value = 1;                      
                $latest_id = DB::table('ourworks')->orderBy('id', 'desc')->value('id');  
                $redirect = '/addOurWorkImage/'.$latest_id;    
                
                if(isset($linkTypeArray)){
                    $linkResult = $this->createWorkLinks($latest_id ,$linkTypeArray, $linkArray);
                }

            } else {
                $message = 'Work is not created';
            }
        }

        return back()->with( array(
                    'message' => $message,
                    'value' => $value,
                    'redirect'=> $redirect
        )); 
    }//createOurWork()


    /*
    |--------------------------------------------------------------------------
    | Our Work - LIST
    |--------------------------------------------------------------------------*/

    public function fetchWorkList(){
        $ourWorks = DB::table('ourworks')
                        ->leftjoin('ourwork_categories', 'ourwork_categories.id', '=', 'ourworks.category')
                        ->select('ourworks.*','ourwork_categories.id AS work_id', 'ourwork_categories.name AS cname')
                        ->get();
        return $ourWorks;
    }

    public function ourWorkList(){

        $ourWorks = $this->fetchWorkList();
        return view('ourWork/works/ourWorkList',['ourWorks'=>$ourWorks]);
    }//ourWorkList()


    /*
    |--------------------------------------------------------------------------
    | Our Work - UPDATE
    |--------------------------------------------------------------------------*/

    public function fetchImage(){
        $ourwork_image = DB::table('ourworks')
                        ->leftjoin('ourwork_images', 'ourworks.id', '=', 'ourwork_images.work_id')
                        ->select('ourwork_images.image AS image','ourworks.id')
                        ->get();

        return $ourwork_image;
    }//fetchImage()

    
    public function fetchCategories(){
        $categories = DB::table('ourwork_categories')
                    ->get();
        return $categories;     
    }//fetchCategories()


    //Fetch Data into Link Types Dropdown
    public function fetchLinkTypes(){
        $link_types = DB::table('work_link_types')
                    // ->leftJoin('ourwork_links', 'work_link_types.id', '=', 'ourwork_links.type')
                    ->select('*')
                    ->get();

        return $link_types;   
    }   //fetchLinkTypes()


    public function showData($id){
        
        $categories = $this->fetchCategories();
        $link_types = $this->fetchLinkTypes();
        // $links = $this->fetchLinks();

        $data = ourworks::find($id);

        $links = DB::table('work_link_types')
                    ->join('ourwork_links', 'work_link_types.id', '=', 'ourwork_links.type')
                    ->where('ourwork_links.ourwork_id','=',$id)
                    ->select('work_link_types.name', 'work_link_types.id', 'ourwork_links.ourwork_id','ourwork_links.type', 'ourwork_links.link')
                    ->get(); 
        
        return view('ourWork/works/updateOurWork',['data'=>$data, 'categories'=>$categories, 'link_types'=>$link_types, 'links'=>$links]);

    }//showData()

    function updateOurwork(Request $req){
        $message = '';
        $value = 0;
        $redirect = '';
        $data = ourworks::find($req->id);

        $links = DB::table('ourwork_links')
                        ->where('ourwork_id', '=', $req->id)
                        ->select('ourwork_id')
                        ->get(); 

        $validation = Validator::make($req->all(), [
            'title' => ['required'],
            'categories' => ['required']
        ]);

        if ($validation->fails()) {
            $message = 'Please Enter All Details!';
        }else{
            $homePageView = '0';
            if (isset($req->homePageView)) {
                $homePageView = '1';
            }
            
            $status = '0';
            if (isset($req->status)) {
                $status = '1';
            }

            $data->title=$req->title;
            $data->category=$req->categories;
            $data->description=$req->description;   
            $data->home_page_view = $homePageView;   
            $data->status = $status;     

            $res = $data->save();
            
            $linkArray = $req['link'];
            $linkTypeArray = $req['link_type'];

            if ($res) {
                $message = 'Work updated Successfully';
                $value = 1;
                $redirect = '/addOurWorkImage/'.$req->id; 
                
                if(isset($linkTypeArray)){
                    $linkResult = $this->createWorkLinks($req->id ,$linkTypeArray, $linkArray);
                }

            } else {
                $message = 'Work is not updated';
            }
        }

        return back()->with( array(
                    'message' => $message,
                    'value' => $value,
                    'redirect'=> $redirect
        )); 
    }


    /*
    |--------------------------------------------------------------------------
    | Delete Our Work 
    |--------------------------------------------------------------------------*/

    function fetchOurworkImage($id){
        $ourwork_image = DB::table('ourworks')
                            ->leftjoin('ourwork_images', 'ourworks.id', '=', 'ourwork_images.work_id')
                            ->where('ourworks.id','=',$id)
                            ->select('ourworks.*','ourwork_images.image AS ourwork_image')
                            ->first();
        return $ourwork_image;
    }//fetchOurworkImage()


    function deleteWork(Request $req){
        $message = '';
        $value = 0;
        $redirect = '';
        $data = ourworks::find($req->id);

        // $image = DB::table('ourwork_images')
        //                 ->where('work_id','=',$req->id)
        //                 ->select('ourwork_images.*')
        //                 ->get();
        
        $links = DB::table('ourwork_links')
                        ->where('ourwork_id', '=', $req->id)
                        ->select('ourwork_id')
                        ->get(); 

        // if($image != null){
        //     $path = public_path().'/uploads/ourworks/'.$image->image;
        //     unlink($path);

        //     $image->delete();            
        // }
        
        $ourwork_image = $this->fetchOurworkImage($req->id);

        $path = public_path().'/uploads/ourworks/';

        if($ourwork_image->ourwork_image != ''  && $ourwork_image->ourwork_image != null){                

            $file_old = $path.$ourwork_image->ourwork_image;

            if(file_exists($file_old)){
                unlink($file_old);
            }

        }

        $delete_image = ourwork_images::where('work_id', $req->id)
                            ->delete();
        
        $delete_data =  $data->delete();

        $linkArray = $req['link'];
        $linkTypeArray = $req['link_type'];

        if($delete_image and $delete_data){

            $message = 'Work deleted Successfully';
            $value = 1;
            $redirect = '/ourWorkList';

            $linkResult = $this->createWorkLinks($req->id ,$linkTypeArray, $linkArray);
        }else {
            $message = 'Work is not deleted';
        }
    
        return back()->with( array(
            'message' => $message,
            'value' => $value,
            'redirect'=> $redirect
        ));
    }



    /*
    |--------------------------------------------------------------------------
    | Create Our Work Image
    |--------------------------------------------------------------------------*/

    function fetchOurWorkDetails($id){
        $ourWorks = DB::table('ourworks')
                            ->where('id','=',$id)
                            ->select('ourworks.*')
                            ->first();
        return $ourWorks;
    }

    function addOurWorkImage($id){
        $ourWorks = $this->fetchOurWorkDetails($id);
        
        $data = ourwork_images::where('work_id',$id)->first();
        $video_data = ourwork_videos::where('work_id',$id)->first();
        
        return view('ourWork/works/addOurWorkImage',['data'=>$data, 'ourWorks'=>$ourWorks, 'video_data'=>$video_data]);
    }

    function deleteImage($imagename, $path){

        $imageFullPath = $path.'/'.$imagename;

        if (file_exists($imageFullPath)) {
            unlink($imageFullPath);
        }

    } //deleteImage

    // It Will Delete All the Images and Videos Linked with OUR Work
    function deleteOurWorkImagesAndVideos($ourWorkId){

        // ourwork_videos
        $findImages = ourwork_images::where('work_id', $ourWorkId)->get();
        if(count($findImages) > 0){
            // Fetch all the images 
            foreach ($findImages as $key => $value) {
                $imageName = $value->image;
                $this->deleteImage($imageName,$this->imageOurWorkStroPath);
            }

            ourwork_images::where('work_id','=', $ourWorkId)->delete();

        }

        $findImages = ourwork_videos::where('work_id','=', $ourWorkId)->get();
        if(count($findImages) > 0){
            // Fetch all the images 
            ourwork_videos::where('work_id','=', $ourWorkId)->delete();

        }

    } //deleteOurWorkImagesAndVideos()

    function saveImage(Request $req){
        
        $message = '';
        $value = 0;
        $redirect = '';
        $ourwork_image = new ourwork_images;
        $ourwork_video = new ourwork_videos;

        $validation = Validator::make($req->all(), [
            'upload_type' => ['required']
        ]);

        if ($validation->fails()) {
            
            $message = 'Please Select Upload Type!';

        }else{

            $ourWorkId = $req->work_id;

            $this->deleteOurWorkImagesAndVideos($ourWorkId);

            //Insert
            if($req->upload_type == "image"){


                $image = $req->file('file');
                $image_name = rand().'.'.$image->getClientOriginalExtension();

                $image->move($this->imageOurWorkStroPath,$image_name);

                $ourwork_image->work_id  = $ourWorkId;
                $ourwork_image->image = $image_name;

                $res = $ourwork_image->save();

                if ($res) {
                    $message = 'Image uploaded Successfully';
                    $value = 1;
                    $redirect = '/ourWorkList';
                } else {
                    $message = 'Image is not uploaded';
                }
         

            }else{
                
                $ourwork_video->work_id=$ourWorkId;   
                $ourwork_video->video=$req->link;        

                $res = $ourwork_video->save();

                if ($res) {
                    $message = 'Video Link Inserted Successfully';
                    $value = 1;
                    $redirect = '/ourWorkList';
                } else {
                    $message = 'Video Link is not Inserted';
                }
                
            }
            //End of Insert
            
        }
        // return json_encode($message);
        return back()->with( array(
            'message' => $message,
            'value' => $value,
            'redirect'=> $redirect
        ));    
    }

    

    public function changeStatus(Request $request){
        $message = 'Status is not updated!';
        $value = 0;
        $redirect = '';
        $ourworks = new ourworks;
        $ourworks = ourworks::find($request->id);
        if ($ourworks->status == '1') {
            $ourworks->status = '0';
        } else {
            $ourworks->status = '1';
        }
        $res = $ourworks->save();
        if ($res == 1) {
            $message = 'Status Updated Successfully!';
            $value = 1;
        }

        return array('message'=>$message,'value'=>$value,'redirect'=> $redirect);
    }

    public function updateOurWorkOrder(Request $request){

        $message = 'Status is not updated!';
        $value = 0;
        $redirect = '';

        $ourWorkId = $request->id;
        $workOrder = (int)trim($request->workOrder);

        $ourworks = new ourworks;
        $ourworks = ourworks::find($ourWorkId);
        $ourworks->order = $workOrder;

        $res = $ourworks->save();
        if ($res == 1) {
            $message = 'Our work order has been Updated!';
            $value = 1;
        }

        return array('message'=>$message,'value'=>$value,'redirect'=> $redirect);

    } //updateOurWorkOrder

    public function changeHomepageStatus(Request $request){
        $message = 'Status is not updated!';
        $value = 0;
        $redirect = '';
        $ourworks = new ourworks;
        $ourworks = ourworks::find($request->id);
        if ($ourworks->home_page_view == '1') {
            $ourworks->home_page_view = '0';
        } else {
            $ourworks->home_page_view = '1';
        }
        $res = $ourworks->save();
        if ($res == 1) {
            $message = 'Status Updated Successfully!';
            $value = 1;
        }

        return array('message'=>$message,'value'=>$value,'redirect'=> $redirect);
    }

    public function getCaseStudy($id){
        $case_study = DB::table('case_studies')
                        ->where('id','=',$id)
                        ->select('case_studies.content','case_studies.id')
                        ->first();
        $content = json_decode($case_study->content);
        return view('ourWork/works/updateCaseStudy',['data'=>$case_study]);
    }

    public function storeCaseStudy(Request $request){
        $message = 'Case Study is not created!';
        $value = 0;
        $redirect = '';
        $case_study = new case_study;
        $case_study->code = 'web';
        // $case_study->content = $request->html.$request->css;
        // $case = json_encode($request->case);
        $case_study->content = json_encode($request->case);
        $case_study->order = 1;
        $case_study->status = 1;
        $res = $case_study->save();

        if ($res == 1) {
            $message = 'Case Study created Successfully!';
            $value = 1;
        }
        return $case_study->content;
        // return array('message'=>$message,'value'=>$value,'redirect'=> $redirect);
    }

    public function updateCaseStudy(Request $request){
        $message = 'Case Study is not updated!';
        $value = 0;
        $redirect = '';
        // $case_study = new case_study;
        $case_study = case_study::find($request->case_id);
        // $res =  $case_study->delete();
        // $case_study->content = $request->html.$request->css;
        // $case = json_encode($request->case);
        // $case_id = $request->case_id;
        // $case_study->content = json_encode($request->case);
        $case_study->content = json_encode($request->case);
        $case_study->code = 'web';
        $case_study->order = 1;
        $case_study->status = 1;
        $res = $case_study->save();

        if ($res == 1) {
            $message = 'Case Study Updated Successfully!';
            $value = 1;
        }
        return $case_study->content;
        // return array('message'=>$message,'value'=>$value,'redirect'=> $redirect);
    }//updateCaseStudy

    public function workList(){
        // $ourworks = $this->fetchWorkList();
        $ourworks = DB::table('ourworks')
                        ->orderBy('order', 'ASC')
                        ->select('*')
                        ->get();
        return view('ourWork/works/workOrder',['ourworks'=>$ourworks]);
    }//workList
    
    public function updateWorkOrder(Request $request){

        $message = 'not done';
        $value = 0;
        $arr = count($request->work_id_array);

        for($i = 0; $i < $arr; $i++){
            $id = $request->work_id_array[$i];
            $res = DB::table('ourworks')
                        ->where('id','=',$id)
                        ->update(['order' => $i]);
        }

        echo "Updated";

        // if ($res == 1) {
        //     $message = 'Successfully!';
        //     $value = 1;
        // }
        // return array('message'=>$message,'value'=>$value);
        
    }//updateWorkOrder

    // public function updateWorkOrder(Request $request){
    //     $droppedIndexParam = $request->droppedIndexParam;
    //     $order = $droppedIndexParam + 1;
    //     $message = 'Order is not updated!';
    //     $value = 0;
    //     $redirect = '';
    //     $ourworks = new ourworks;
    //     $ourworks = ourworks::find($request->workId);
    //     $ourworks->order = $order;
    //     $res = $ourworks->save();
    //     if ($res == 1) {
    //         $existingOrder = DB::table('ourworks')
    //                         ->where('order','>=',$order)
    //                         ->select('order','id')
    //                         ->get();
    //         if (count($existingOrder) != 0 ) {
    //             foreach ($existingOrder as $key => $value) {
    //                 if ($value->id != $request->workId) {
    //                     $workOrder = ourworks::find($value->id);
    //                     $workOrder->order = $value->order + 1;
    //                     $res = $workOrder->save();
    //                 }
    //             }
    //         }
    //         $message = 'Order Updated Successfully!';
    //         $value = 1;
    //     }

    //     return array('message'=>$message,'value'=>$value,'redirect'=> $redirect,'res'=>$existingOrder);
    //     // return json_encode(array('workId'=>$workId,'droppedIndexParam'=>$droppedIndexParam));
    // }//updateWorkOrder
}
