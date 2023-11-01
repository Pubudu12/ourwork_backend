<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Symfony\Component\Routing\Generator\UrlGenerator;
use Illuminate\Support\Facades\DB;
use Ramsey\Uuid\Type\Integer;

class APIOurWorks extends Controller
{

    public function fetchWorkLinksByID($work_id){
        $data = DB::table('ourwork_links')
                    ->leftjoin('work_link_types','ourwork_links.type','=','work_link_types.id')
                    ->where('ourwork_links.ourwork_id','=',$work_id)
                    ->select('ourwork_links.link','work_link_types.code AS code')
                    ->get();

        $linksArray = array();
        foreach ($data as $key => $value) {
            array_push( $linksArray, [
                'type' => $value->code,
                'link' => $value->link
            ] );
        }
         

        return $linksArray;
    }

    function filterByCategory($category_id){

        if(!is_numeric($category_id)){
            $category_id = $this->categoryByCode($category_id);
        }


        $data = DB::table('ourworks')
                    ->leftjoin('ourwork_categories', 'ourwork_categories.id', '=', 'ourworks.category')
                    ->leftjoin('ourwork_videos', 'ourwork_videos.work_id', '=', 'ourworks.id')
                    ->leftjoin('ourwork_images', 'ourwork_images.work_id', '=', 'ourworks.id')
                    ->where('ourworks.category', '=', $category_id)
                    ->where('ourworks.status', '=', 1)
                    ->select('ourworks.id AS work_id','ourworks.title','ourworks.description','ourwork_categories.name AS categoryName','ourwork_images.image','ourwork_videos.video')
                    ->orderBy('ourworks.order')
                    ->get();

        $dataArray = array();
        foreach ($data as $key => $value) {
            
            $tempDataArray = [];

            $linksArray = $this->fetchWorkLinksByID($value->work_id);
            if(count($linksArray) > 0){
                $tempDataArray['linkArray'] = $linksArray;
            }

            $image = 'https://via.placeholder.com/150C/O';
            if ($value->image != null) {
                $image =  url('/').'/uploads/ourworks/'.$value->image;
            }            

            if($value->video !=null){
                $tempDataArray['video_embed'] = $value->video;
            }

            $tempDataArray['id'] = $value->work_id;
            $tempDataArray['title'] = $value->title;
            $tempDataArray['description'] = $value->description;
            $tempDataArray['mockup'] = $image;

            array_push($dataArray, $tempDataArray);
            
        }

        return response()->json($dataArray, 200);
        
    }

    public function categoryByCode($category_code){
        $result = DB::table('ourwork_categories')
                ->where('code', '=', $category_code)
                ->select('id')
                ->first();
        return $result;
    }

    public function filterEnabledWorks($category_code, $limit = 4){
        $result = $this->categoryByCode($category_code);
        $data = DB::table('ourworks')
                ->leftjoin('ourwork_categories', 'ourwork_categories.id', '=', 'ourworks.category')
                ->leftjoin('ourwork_videos', 'ourwork_videos.work_id', '=', 'ourworks.id')
                ->leftjoin('ourwork_images', 'ourwork_images.work_id', '=', 'ourworks.id')
                ->where('ourworks.category', '=', $result->id)
                ->where('ourworks.home_page_view', '=', 1)
                ->orderBy('ourworks.order','ASC')
                ->limit($limit)
                ->select('ourworks.id AS work_id','ourworks.title','ourworks.description','ourwork_categories.name AS categoryName','ourwork_images.image','ourwork_videos.video')
                ->get();

        $dataArray = array();
        foreach ($data as $key => $value) {
            $tempDataArray = [];
            $linksArray = $this->fetchWorkLinksByID($value->work_id);
            if(count($linksArray) > 0){
                $tempDataArray['linkArray'] = $linksArray;
            }
            

            $image = 'https://via.placeholder.com/250x250.png?text=Creative+Hub';
            if ($value->image != null) {
                $image =  url('/').'/uploads/ourworks/'.$value->image;
            }            

            if($value->video !=null){
                $tempDataArray['video_embed'] = $value->video;
            }

            $tempDataArray['id'] = $value->work_id;
            $tempDataArray['title'] = $value->title;
            $tempDataArray['description'] = $value->description;
            $tempDataArray['mockup'] = $image;

            array_push($dataArray, $tempDataArray);

        }

        return response()->json($dataArray, 200);
    }

    public function fetchWorkCategories(){
        $data = DB::table('ourwork_categories')
                ->select('*')
                ->orderBy('order')
                ->get();

        $dataArray = array();
        foreach ($data as $key => $value) {
            $image = 'https://via.placeholder.com/150C/O';
            if ($value->icon != null) {
                $image =  'http://127.0.0.1:8000/uploads/ourwork_icons/'.$value->icon ;
            }
            array_push($dataArray,array(
                    'id'=>$value->id,
                    'name'=>$value->name,
                    'icon'=>$image,
                    'description'=>$value->description,
                    'design_type'=>$value->design_type,
                ));
        }

        $response = [
            'statusCode'=>200,
            'message'=>'Successfully fetched',
            'data'=>$dataArray
            ];
        return response()->json($response);
    }

    function singleWork($work_id){
        $links = $this->fetchWorkLinksByID($work_id);
        $data = DB::table('ourworks')
                    ->leftjoin('ourwork_categories', 'ourwork_categories.id', '=', 'ourworks.category')
                    ->leftjoin('ourwork_videos', 'ourwork_videos.work_id', '=', 'ourworks.id')
                    ->leftjoin('ourwork_images', 'ourwork_images.work_id', '=', 'ourworks.id')
                    ->where('ourworks.id','=',$work_id)                    
                    ->select('ourworks.*','ourwork_images.image','ourwork_videos.video')
                    ->first();
        $dataArray = array();
        $linkArray = array();
        foreach ($links as $key => $value) {
            array_push($linkArray,array(
                'linkType'=>$value->typeName,
                'link'=>$value->description,
            ));
        }
    }
}
