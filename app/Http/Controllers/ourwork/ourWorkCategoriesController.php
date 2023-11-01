<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\ourwork_category;
use Illuminate\Support\Facades\DB;

class ourWorkCategoriesController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Our Work Category - CREATE
    |--------------------------------------------------------------------------*/ 
    
    function desgnTypeList(){
        $design_types = DB::table('our_work_design_type')
                                ->get();

        return view('ourWork/categories/createOurWorkCategory',['design_types'=>$design_types]);
    }

    function createOurWorkCategory(Request $req){   

        $message = '';
        $value = 0;
        $redirect = '';
        $ourwork_category = new ourwork_category;

        $validation = Validator::make($req->all(), [
            'category' => ['required'],
            'code' => ['required'],
            'design_type' => ['required'],
        ]);
        
        if ($validation->fails()) {
            $message = 'Please Fill All Details!';
        }else{

            $ourwork_category->name=$req->category;
            $ourwork_category->code=$req->code;
            $ourwork_category->design_type=$req->design_type;
            $ourwork_category->description=$req->description;

            if (isset($req->file)) {
                
                $icon = $req->file('file');
                $icon_name = rand().'.'.$icon->getClientOriginalExtension();
    
                $icon->move(public_path("uploads/ourwork_icons"),$icon_name);
                
                $ourwork_category->icon = $icon_name;
            }
           
            $res = $ourwork_category->save();

            if ($res) {
                $message = 'Category created Successfully';
                $value = 1;
                $redirect = '/ourWorkCategoryList';
            } else {
                $message = 'Category is not created';
            }
        }
        return back()->with( array(
            'message' => $message,
            'value' => $value,
            'redirect'=> $redirect
        ));  
    }//createOurWorkCategory()


    /*
    |--------------------------------------------------------------------------
    | Our Work Category - LIST
    |--------------------------------------------------------------------------*/ 

    function showOurWorkCategories(){
        $data = ourwork_category::all();
        return view('ourWork/categories/ourWorkCategoryList',['category'=>$data]);
    }//showOurWorkCategories()


    /*
    |--------------------------------------------------------------------------
    | Our Work Category - UPDATE
    |--------------------------------------------------------------------------*/ 
    
    function showData($id){
        $data = ourwork_category::find($id);

        $design_types = DB::table('our_work_design_type')
                                ->get();

        return view('ourWork/categories/updateOurWorkCategory',['data'=>$data, 'design_types'=>$design_types]);
        
    }//showData()


    function updateOurWorkCategory(Request $req){
        $message = '';
        $value = 0;
        $redirect = '';
        $data = ourwork_category::find($req->id);

        $validation = Validator::make($req->all(), [
            'name' => ['required']
        ]);

        if ($validation->fails()) {
            $message = 'Please Enter Category!';
        }else{
            $name = $data->name = $req->name;
            $design_type = $data->design_type = $req->design_type;
            $description = $data->description = $req->description;  
            $code = $data->code = $req->code;
            $image = $req->file;                      

            if($image === null){
                $res = $data->update(['name' => $name, 'code' => $code, 'description' => $description, 'design_type' => $design_type]);
            }else{
                $path = public_path().'/uploads/ourwork_icons/';

                if($data->icon != ''  && $data->icon != null){

                    $file_old = $path.$data->icon;
                    unlink($file_old);

                    $icon = $req->file('file');
                    $icon_name = rand().'.'.$icon->getClientOriginalExtension();
                    $icon->move(public_path("uploads/ourwork_icons"),$icon_name);                
                } 

                $res = $data->update(['name' => $name, 'code' => $code, 'icon' => $icon_name, 'description' => $description, 'design_type' => $design_type]);
            }

            if ($res) {
                $message = 'Category Updated Successfully';
                $value = 1;
                $redirect = '/ourWorkCategoryList';
            } else {
                $message = 'Category is not updated';
            }
        }
        return back()->with( array(
            'message' => $message,
            'value' => $value,
            'redirect'=> $redirect
        ));    
    }//updateOurWorkCategory()


    /*
    |--------------------------------------------------------------------------
    | Our Work Category - DELETE
    |--------------------------------------------------------------------------*/ 

    function deleteOurWorkCategory($id){
        $message = '';
        $value = 0;
        $redirect = '';
        $data = ourwork_category::find($id);
        
        $path = public_path().'/uploads/ourwork_icons/';

        if($data->icon != ''  && $data->icon != null){                

            $file_old = $path.$data->icon;

            if(file_exists($file_old)){
                unlink($file_old);
            }

        }

        $res =  $data->delete();

        if($res){
            $message = 'Category deleted Successfully';
            $value = 1;
            $redirect = '/ourWorkCategoryList';
        }else {
            $message = 'Category is not deleted';
        }
    
        return back()->with( array(
            'message' => $message,
            'value' => $value,
            'redirect'=> $redirect
        ));
    }//deleteOurWorkCategory()

    // public function categoryOrder(){
    //     // $data = ourwork_category::all();
    //     $data = DB::table('ourwork_categories')
    //                     ->orderBy('order', 'ASC')
    //                     ->select('*')
    //                     ->get();

    //     return view('ourWork/categories/categoryOrder',['category'=>$data]);
    // }//categoryOrder

    public function categoryOrder(){
        $data = DB::table('ourwork_categories')
                        ->orderBy('order', 'ASC')
                        ->select('*')
                        ->get();
        return view('ourWork/categories/categoryOrder',['data'=>$data]);
    }//workList

    public function updatecategoryOrder(Request $request){

        $message = 'not done';
        $value = 0;
        $arr = count($request->category_id_array);

        for($i = 0; $i < $arr; $i++){
            $id = $request->category_id_array[$i];
            $res = DB::table('ourwork_categories')
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

    // public function updatecategoryOrder(Request $request){
    //     $droppedIndexParam = $request->droppedIndexParam;
    //     $order = $droppedIndexParam + 1;
    //     $message = 'Order is not updated!';
    //     $value = 0;
    //     $redirect = '';
    //     $category = new ourwork_category;
    //     $category = ourwork_category::find($request->category_id);
    //     $category->order = $order;
    //     $res = $category->save();
    //     if ($res == 1) {
    //         // $existingOrder = DB::table('ourwork_categories')
    //         //                 ->where('order','>=',$order)
    //         //                 ->select('order','id')
    //         //                 ->get();
    //         // if (count($existingOrder) != 0 ) {
    //         //     foreach ($existingOrder as $key => $value) {
    //         //         if ($value->id != $request->category_id) {
    //         //             $categoryOrder = ourwork_category::find($value->id);
    //         //             $categoryOrder->order = $value->order + 1;
    //         //             $res = $categoryOrder->save();
    //         //         }
    //         //     }
    //         // }
    //         $message = 'Order Updated Successfully!';
    //         $value = 1;
    //     }

    //     return array('message'=>$message,'value'=>$value,'redirect'=> $redirect);
    //     // return json_encode(array('workId'=>$workId,'droppedIndexParam'=>$droppedIndexParam));
    // }//updatecategoryOrder
}
