<?php

namespace App\Http\Controllers\dogood;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


use App\Models\dogoodCategory as DoGoodCategoryTable;

class DoGoodCategoryController extends Controller
{
    // |--------------------------------------------------------------------------
    // | Blog Categories - LIST
    // |--------------------------------------------------------------------------*/
    
    public function getCategories(){
        $categories = DoGoodCategoryTable::all();
        return view('dogood/category/categories',['data'=>$categories]);
    } //getCategories()

    
    /*
    |--------------------------------------------------------------------------
    | Blog Categories - CREATE
    |--------------------------------------------------------------------------*/

    public function createBlogCategories(Request $request){

        $message = 'Failed to create the blog category';
        $value = 0;
        $redirect = '/blog/categories';

        $validation = Validator::make($request->all(), [
            'name' => ['required']
        ]);
        
        if ($validation->fails()) {
            $message = 'Please Enter Category Name!';
        }else{

            $inputs = $request->all();
            $code = strtolower(trim($inputs['code']));
            if(empty($code)){
                $code = rand().Date("ymdhis");
            }
            
            $DoGoodCategoryTable = new DoGoodCategoryTable;

            $DoGoodCategoryTable->name = $inputs['name'];
            $DoGoodCategoryTable->code = $code;
            $insert = $DoGoodCategoryTable->save();

            if ($insert) {
                $message = 'Blog category has been created successfully';
                $value = 1;
            }

        }

        return back()->with( array(
            'message' => $message,
            'value' => $value,
            'redirect'=> $redirect
        ));


    } //createBlogCategories


    /*
    |--------------------------------------------------------------------------
    | Blog Categories - UPDATE
    |--------------------------------------------------------------------------*/

    public function getBlogCategoryById($categoryId){
        $data = DoGoodCategoryTable::find($categoryId);
        return view('blog/blogCategories/updateCategories',['data'=>$data]);
    } //getBlogCategoryById 


    public function updateBlogCategories(Request $request){

        $message = 'Failed to update the blog category';
        $value = 0;
        $redirect = '/blog/categories';

        $validation = Validator::make($request->all(), [
            'name' => ['required'],
            'code' => ['required'],
            'id' => ['required'],
        ]);

        if ($validation->fails()) {
            $message = 'Please Enter Required Details!';

        }else{

            $data = DoGoodCategoryTable::find($request->id);

            $data->name = $request->name;
            $data->code = $request->code;
            $response = $data->save();

            if ($response) {
                $message = 'Blog category has been updated successfully';
                $value = 1;
            }
        }
        return back()->with( array(
            'message' => $message,
            'value' => $value,
            'redirect'=> $redirect
        ));    
    } //updateBlogCategories


    /*
    |--------------------------------------------------------------------------
    | Blog Categories - DELETE
    |--------------------------------------------------------------------------*/

    public function deleteBlogCategories($categoryId){

        $message = 'Failed to delete the category';
        $value = 0;
        $redirect = '/blog/categories';
        $data = DoGoodCategoryTable::find($categoryId);
        
        $res =  $data->delete();

        if($res){
            $message = 'Blog category has been deleted successfully';
            $value = 1;
        }
    
        return back()->with( array(
            'message' => $message,
            'value' => $value,
            'redirect'=> $redirect
        ));

    } //deleteBlogCategories
}
