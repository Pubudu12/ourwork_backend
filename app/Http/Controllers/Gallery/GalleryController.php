<?php

namespace App\Http\Controllers\Gallery;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use App\Models\gallery as GalleryTable;

class GalleryController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Gallery Items - LIST
    |--------------------------------------------------------------------------*/
    
    public function getImages(){
        $gallery = GalleryTable::all();
        return view('gallery/gallery',['data'=>$gallery]);
    } //getImages()

    /*
    |--------------------------------------------------------------------------
    | Gallery Items - CREATE
    |--------------------------------------------------------------------------*/

    function createGalleryItem(Request $req){

        $message = '';
        $value = 0;
        $redirect = '';

        $gallery = new GalleryTable;

        if($req->upload_type == "image"){
            $validation = Validator::make($req->all(), [
                'file' => ['required'],
                'upload_type' => ['required']
            ]);
        }else{
            $validation = Validator::make($req->all(), [
                'file' => ['required'],
                'upload_type' => ['required'],
                'video_type' => ['required'],
                'link' => ['required'],
            ]);
        }

        if ($validation->fails()) {
            $message = 'Please Fill All Details!';
        }else{
            //Insert
            if($req->upload_type == "image"){

                $image = $req->file('file');
                $image_name = rand().'.'.$image->getClientOriginalExtension();
                $image->move(public_path("uploads/gallery/"),$image_name);
                $gallery->image = $image_name;

                $gallery->video = null;
                $gallery->video_type = null;
                $gallery->text = $req->text;
                $gallery->item_type = $req->upload_type;

                $res = $gallery->save();

                if ($res) {
                    $message = 'Image uploaded Successfully';
                    $value = 1;
                    $redirect = '/gallery';
                } else {
                    $message = 'Image is not uploaded';
                }

            }else{
                $image = $req->file('file');
                $image_name = rand().'.'.$image->getClientOriginalExtension();
                $image->move(public_path("uploads/gallery/"),$image_name);
                $gallery->image = $image_name;

                $gallery->video = $req->link;
                $gallery->video_type = $req->video_type;
                $gallery->text = $req->text;
                $gallery->item_type = $req->upload_type;

                $res = $gallery->save();

                if ($res) {
                    $message = 'Video Link Inserted Successfully';
                    $value = 1;
                    $redirect = '/gallery';
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

    /*
    |--------------------------------------------------------------------------
    | Gallery Items - DELETE
    |--------------------------------------------------------------------------*/

    function deleteGalleryItem($id){
        $message = '';
        $value = 0;
        $redirect = '';
        $gallery = GalleryTable::find($id);

        $path = public_path().'/uploads/gallery/';

        if($gallery->image != ''  && $gallery->image != null){                

            $file_old = $path.$gallery->image;

            if(file_exists($file_old)){
                unlink($file_old);
            }

        }

        $res =  $gallery->delete();

        if($res){
            $message = 'Gallery Item Deleted Successfully';
            $value = 1;
        }else{
            $message = 'Gallery item is deleted';
        }
    
        return back()->with( array(
            'message' => $message,
            'value' => $value,
            'redirect'=> $redirect
        ));
    }


    /*
    |--------------------------------------------------------------------------
    | Gallery Items - UPDATE
    |--------------------------------------------------------------------------*/

    function fetchGalleryDetails($id){

        // $data = GalleryTable::all();

        $data = DB::table('galleries')
                            ->where('id','=',$id)
                            ->select('galleries.*')
                            ->first();
        // return $galleries;
        return view('gallery/updateGalleryItem', ['data' => $data]);
    }

    function updateGalleryItem(Request $req){
        
        $message = '';
        $value = 0;
        $redirect = '';

        if($req->upload_type == "image"){
            $validation = Validator::make($req->all(), [
                'file' => ['required'],
                'upload_type' => ['required']
            ]);
        }else{
            $validation = Validator::make($req->all(), [
                'file' => ['required'],
                'upload_type' => ['required'],
                'video_type' => ['required'],
                'link' => ['required']
            ]);
        }

        if ($validation->fails()) {
            $message = 'Please Fill All Details!';
        }else{

            $data = GalleryTable::find($req->id);
            //Insert
            $path = public_path().'/uploads/gallery/';

                if($data->image != '' && $data->image != null){

                        $file_old = $path.$data->image;
                        unlink($file_old);
                        
                        $image = $req->file('file');
                        $image_name = rand().'.'.$image->getClientOriginalExtension();
                        $image->move(public_path("uploads/gallery/"),$image_name);
                        $data->image = $image_name;

                    if($req->upload_type == "image"){

                        $data->video = null;
                        $data->video_type = null;
                        $data->text = $req->text;
                        $data->item_type = $req->upload_type;
                        $data->video_type = null;

                    }else{
                        $data->video = $req->link;
                        $data->video_type = $req->video_type;
                        $data->text = $req->text;
                        $data->item_type = $req->upload_type;
                    }
                    
                    $res = $data->save();

                    if ($res) {
                        $message = 'Image updated Successfully';
                        $value = 1;
                        $redirect = '/gallery';
                    } else {
                        $message = 'Image is not updated';
                    }

                }//End of Insert            
        }
        // return json_encode($message);
        return back()->with( array(
            'message' => $message,
            'value' => $value,
            'redirect'=> $redirect
        ));


    }
}
