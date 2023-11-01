<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class APIBlogController extends Controller
{   
    /*
    |--------------------------------------------------------------------------
    | All Categories
    |--------------------------------------------------------------------------*/

    // public function blogCategories(){
    //     $categoryArray = array();
        
    //     $result = DB::table('blog_categories')
    //             ->leftJoin('blog_posts','blog_posts.category_id','=','blog_categories.id')
    //             ->select(DB::raw('count(blog_posts.id) as post_count'),'blog_categories.name', 'blog_categories.id','blog_categories.code')
    //             ->groupBy('blog_categories.name')
    //             ->groupBy('blog_categories.id')
    //             ->groupBy('blog_categories.code')
    //             ->get();

    //     // $result = DB::table('blog_categories')
    //     //         ->select('id','name','code')
    //     //         ->get();

    //     $count['number_of_categories'] = DB::table('blog_categories')
    //                                     ->select('id')
    //                                     ->count();

    //     foreach ($result as $key => $value) {
    //         array_push($categoryArray,[
    //             'id'=>$value->id,
    //             'code'=>$value->code,
    //             'name'=>$value->name,
    //             'post_count'=>$value->post_count
    //         ]);
    //     }
        
    //     $response = [
    //         'statusCode'=>200,
    //         'message'=>'Successfully fetched',
    //         'categories'=>$categoryArray,
    //         'post_count'=>$count
    //        ];
        
    //     return ($response);

    //     // return response()->json([$count, $categoryArray], 200);
    // }//blogCategories


    /*
    |--------------------------------------------------------------------------
    | Single Category
    |--------------------------------------------------------------------------*/

    public function categoryByCode($category_code){

        $result = DB::table('blog_categories')
                ->where('code', '=', $category_code)
                ->select('id')
                ->first();

        return $result;

    }//categoryByName


    /*
    |--------------------------------------------------------------------------
    | All Tags
    |--------------------------------------------------------------------------*/

    public function blogTags(){
        $tagArray = array();
        $result = DB::table('blog_tag')
                ->select('id', 'code', 'name')
                ->get();

        $count['number_of_tag'] = DB::table('blog_tag')
                ->select('id')
                ->count();
                
        foreach ($result as $key => $value) {
            array_push($tagArray,[
                'id'=>$value->id,
                'code'=>$value->code,
                'name'=>$value->name,
            ]);
        }

        $response = [
            'statusCode'=>200,
            'message'=>'Successfully fetched',
            'tags'=>$result,
            'pagination_data'=>$count
           ];
        
        return ($response);

        // return response()->json([$count, $result], 200);
    }//blogTags


    /*
    |--------------------------------------------------------------------------
    | Single Tags
    |--------------------------------------------------------------------------*/
    
    public function tagByCode($tag_code){

        $result = DB::table('blog_tag')
                ->where('code', '=', $tag_code)
                ->select('id')
                ->first();

        return $result;
        
    }


    /*
    |--------------------------------------------------------------------------
    | All Posts
    |--------------------------------------------------------------------------*/

    public function blogPostsAll($limit){
        
        $data = DB::table('blog_posts')
                    ->leftjoin('blog_categories', 'blog_categories.id', '=', 'blog_posts.category_id')
                    ->leftjoin('blog_post_content', 'blog_post_content.post_id', '=', 'blog_posts.id')
                    ->leftJoin('meta_titles', 'meta_titles.post_id', '=', 'blog_posts.id')
                    ->where('blog_posts.status', '=', 1)
                    ->select('blog_posts.id AS post_id','blog_posts.title','blog_posts.description',
                            'blog_categories.name AS category',
                            'blog_posts.post_date','blog_post_content.content AS content','meta_titles.title as slug')
                    ->paginate($limit);
        
        $postArray = array();

        $count = DB::table('blog_posts')
                ->count();
    
        $tempDataArray = [];
        
        foreach ($data as $data) {

            $tagsArray = $this->fetchBlogTagsByID($data->post_id); 
            $imageArray = $this->fetchBlogAttachmentsByID($data->post_id);
            $postData = $this->postData($count, $limit);
                 
            $tempDataArray['title'] = $data->title;
            $tempDataArray['slug'] = $data->slug;
            $tempDataArray['description'] = $data->description;
            $tempDataArray['post_date'] = $data->post_date;
            $tempDataArray['category'] = $data->category;
            $tempDataArray['content'] = htmlentities($data->content);

            if(count($tagsArray) > 0){
                $tempDataArray['tagsArray'] = $tagsArray;
            }

            if(count($imageArray) > 0){
                $tempDataArray['imagesArray'] = $imageArray;
            }
    
            array_push($postArray, $tempDataArray);
        }

        $response = [
            'statusCode'=>200,
            'message'=>'Successfully fetched',
            'posts'=>$postArray,
            'pagination_data'=>$postData
           ];
        
        return ($response);
                
        // return response()->json([$postData, $postArray], 200);

        // foreach ($result as $key => $value) {
        //     array_push($postArray,[
        //         'id'=>$value->id,
        //         'category'=>$value->category,
        //         'title'=>$value->title,
        //         'slug'=>$value->slug,
        //         'description'=>$value->description,
        //         'post_date'=>$value->post_date,
        //     ]);
        // }

        // return response()->json($result, 200);
    }//blogTags


    /*
    |--------------------------------------------------------------------------
    | Single Post
    |--------------------------------------------------------------------------*/
    
    public function blogSingle($post_url_slug){

        $data = DB::table('blog_posts')
                    ->leftjoin('blog_categories', 'blog_categories.id', '=', 'blog_posts.category_id')
                    ->leftjoin('blog_post_content', 'blog_post_content.post_id', '=', 'blog_posts.id')
                    ->leftJoin('meta_titles', 'meta_titles.post_id', '=', 'blog_posts.id')
                    ->where('meta_titles.title', '=', $post_url_slug)
                    ->where('blog_posts.status', '=', 1)
                    ->select('blog_posts.id AS post_id','blog_posts.title','blog_posts.description',
                            'blog_categories.name AS categoryName',
                            'blog_posts.post_date','blog_post_content.content AS content','meta_titles.title as slug')
                    ->get();

        $dataArray = array();
    
        $tempDataArray = [];

        foreach ($data as $data){
            $tagsArray = $this->fetchBlogTagsByID($data->post_id);
            $imageArray = $this->fetchBlogAttachmentsByID($data->post_id);

            $tempDataArray['title'] = $data->title;
            $tempDataArray['slug'] = $data->slug;
            $tempDataArray['description'] = $data->description;
            $tempDataArray['post_date'] = $data->post_date;
            $tempDataArray['category'] = $data->categoryName;
            $tempDataArray['content'] = htmlentities($data->content);

            if(count($tagsArray) > 0){
                $tempDataArray['tagsArray'] = $tagsArray;
            }
    
            if(count($imageArray) > 0){
                $tempDataArray['imagesArray'] = $imageArray;
            }
    
            array_push($dataArray, $tempDataArray);
        }       
        
        $response = [
            'statusCode'=>200,
            'message'=>'Successfully fetched',
            'post'=>$dataArray
           ];
        
        return ($response);

        // return response()->json($dataArray, 200);
    }


    /*
    |--------------------------------------------------------------------------
    | Search Posts
    |--------------------------------------------------------------------------*/


    public function postData($count,$limit){
        $number_of_pages = round($count/$limit, 0);
        $offset = round(($number_of_pages - 1) * $limit, 0);
        $current_page = round($number_of_pages - ($offset/$limit), 0);
        // $offset = ($number_of_pages - 1) * $limit + 1;

        return ['number_of_pages' => $number_of_pages, 'offset' => $offset, 'current_page' => $current_page];       

    }

    public function searchPost($keyword, $limit){    
        
        $data = DB::table('blog_posts')  
                ->leftjoin('blog_categories','blog_posts.category_id','=','blog_categories.id')
                ->leftjoin('blog_post_content', 'blog_post_content.post_id', '=', 'blog_posts.id')
                ->leftJoin('meta_titles', 'meta_titles.post_id', '=', 'blog_posts.id')
                ->where('blog_categories.name','like','%'.$keyword.'%')
                ->orWhere('blog_posts.title','like','%'.$keyword.'%')
                ->select('blog_post_content.content as content','blog_posts.id as post_id','blog_categories.name as category','blog_posts.title as title', 'blog_posts.description as description', 'blog_posts.post_date as post_date', 'meta_titles.title as slug')
                ->paginate($limit);
        
        $count = DB::table('blog_posts')  
                ->leftjoin('blog_categories','blog_posts.category_id','=','blog_categories.id')
                ->leftJoin('meta_titles', 'meta_titles.post_id', '=', 'blog_posts.id')
                ->where('blog_categories.name','like','%'.$keyword.'%')
                ->orWhere('blog_posts.title','like','%'.$keyword.'%')
                ->select('blog_posts.id as post_id')
                ->count();

        $postArray = array();
        
        $tempDataArray = [];                     

        foreach ($data as $data) {  

            $tagsArray = $this->fetchBlogTagsByID($data->post_id); 
            $imageArray = $this->fetchBlogAttachmentsByID($data->post_id);
            $postData = $this->postData($count, $limit);
            
            $tempDataArray['title'] = $data->title;
            $tempDataArray['slug'] = $data->slug;
            $tempDataArray['description'] = $data->description;
            $tempDataArray['post_date'] = $data->post_date;
            $tempDataArray['category'] = $data->category;
            $tempDataArray['content'] = htmlentities($data->content);

            if(count($tagsArray) > 0){
                $tempDataArray['tagsArray'] = $tagsArray;
            }

            if(count($imageArray) > 0){
                $tempDataArray['imagesArray'] = $imageArray;
            }
    
            array_push($postArray, $tempDataArray);
        }

        return response()->json([$postData, $postArray], 200);
    }//searchPost

    
    public function fetchBlogTagsByID($post_id){
        $data = DB::table('blog_post_tags')
                    ->leftjoin('blog_tag','blog_post_tags.tag_id','=','blog_tag.id')
                    ->where('blog_post_tags.post_id','=',$post_id)
                    ->select('blog_post_tags.tag_id','blog_tag.code AS code','blog_tag.name AS tagName')
                    ->get();

        $tagArray = array();
        foreach ($data as $key => $value) {
            array_push( $tagArray, [
                'tag' => $value->code,
                'name' => $value->tagName
            ] );
        }
         
        return $tagArray;
    }//fetchBlogTagsByID

    public function fetchBlogAttachmentsByID($post_id){
        $data = DB::table('blog_post_attachments')
                    ->leftjoin('blog_posts','blog_post_attachments.post_id','=','blog_posts.id')
                    ->where('blog_post_attachments.post_id','=',$post_id)
                    ->select('blog_post_attachments.media_type','blog_post_attachments.name')
                    ->get();

        $imageArray = array();
        foreach ($data as $key => $value) {
            $image = 'https://via.placeholder.com/150C/O';
            if ($value->name != null) {
                $image =  url('/').'/uploads/blogs/'.$value->name;
            }
            array_push( $imageArray, [
                'media_type' => $value->media_type,
                'name' => $image
            ]);
        }
         
        return $imageArray;
    }//fetchBlogAttachmentsByID


    /*
    |--------------------------------------------------------------------------
    | Blog Posts by Category
    |--------------------------------------------------------------------------*/

    public function blogPostsByCategory($category_code, $limit){
        
        $result = $this->categoryByCode($category_code);

        $category = DB::table('blog_categories')
                    ->where('id','=',$result->id)
                    ->select('name')
                    ->get();

        $query = DB::table('blog_posts')
                    ->leftjoin('blog_categories', 'blog_categories.id', '=', 'blog_posts.category_id')
                    ->leftjoin('blog_post_content', 'blog_post_content.post_id', '=', 'blog_posts.id')
                    ->leftJoin('meta_titles', 'meta_titles.post_id', '=', 'blog_posts.id')
                    ->where('blog_posts.category_id', '=', $result->id)
                    ->where('blog_posts.status', '=', 1)
                    ->select('blog_posts.id AS post_id','blog_posts.title','blog_posts.description',
                            'blog_categories.name AS categoryName',
                            'blog_posts.post_date','blog_post_content.content as content',
                            'meta_titles.title as slug')
                    ->paginate($limit);

        $count = DB::table('blog_posts')
                    ->leftjoin('blog_categories', 'blog_categories.id', '=', 'blog_posts.category_id')
                    ->where('blog_posts.category_id', '=', $result->id)
                    ->where('blog_posts.status', '=', 1)
                    ->select('blog_posts.id')
                    ->count();
        
        $postData = $this->postData($count, $limit);
        // if ($limit != null) {
        //     $data = $query
        // }
        
        // $data = $query->select('blog_posts.id AS post_id','blog_posts.title','blog_posts.description',
        //                 'blog_categories.name AS categoryName',
        //                 'blog_posts.post_date','blog_post_content.content AS content')
        //         ->get();
        $tempDataArray = [];
        
        $dataArray = array();
        foreach ($query as $key => $value) {
            
            $tagsArray = $this->fetchBlogTagsByID($value->post_id);
            $imageArray = $this->fetchBlogAttachmentsByID($value->post_id);
            
            $tempDataArray['title'] = $value->title;
            $tempDataArray['slug'] = $value->slug;
            $tempDataArray['description'] = $value->description;
            $tempDataArray['post_date'] = $value->post_date;
            $tempDataArray['category'] = $value->categoryName;
            $tempDataArray['content'] = htmlentities($value->content);

            if(count($tagsArray) > 0){
                $tempDataArray['tagsArray'] = $tagsArray;
            }

            if(count($imageArray) > 0){
                $tempDataArray['imagesArray'] = $imageArray;
            }

            array_push($dataArray, $tempDataArray);
        }

        $response = [
            'statusCode'=>200,
            'message'=>'Successfully fetched',
            'category'=>$category,
            'number_of_posts'=>$count,
            'posts'=>$dataArray,
            'pagination_data'=>$postData
            
           ];
        
        return ($response);

        // return response()->json([$postData, $dataArray], 200);
    }//blogPostsByCategory


    /*
    |--------------------------------------------------------------------------
    | Recent Posts
    |--------------------------------------------------------------------------*/

    public function recentPosts($no_of_posts){

        $data = DB::table('blog_posts')
                ->leftjoin('blog_categories', 'blog_categories.id', '=', 'blog_posts.category_id')
                ->leftjoin('blog_post_content', 'blog_post_content.post_id', '=', 'blog_posts.id')
                ->leftJoin('meta_titles', 'meta_titles.post_id', '=', 'blog_posts.id')
                ->where('blog_posts.status', '=', 1)
                ->orderBy('blog_posts.post_date','desc')
                ->take($no_of_posts)
                ->select('blog_posts.id AS post_id','blog_posts.title','blog_posts.description',
                        'blog_categories.name AS categoryName',
                        'blog_posts.post_date','blog_post_content.content AS content', 
                        'meta_titles.title as slug')
                ->get();
                
        $dataArray = array();
    
        $tempDataArray = [];
        
        foreach ($data as $data){
            $tagsArray = $this->fetchBlogTagsByID($data->post_id);
            $imageArray = $this->fetchBlogAttachmentsByID($data->post_id);
        
            $tempDataArray['title'] = $data->title;
            $tempDataArray['slug'] = $data->slug;
            $tempDataArray['description'] = $data->description;
            $tempDataArray['post_date'] = $data->post_date;
            $tempDataArray['category'] = $data->categoryName;
            $tempDataArray['content'] = htmlentities($data->content);

            if(count($tagsArray) > 0){
                $tempDataArray['tagsArray'] = $tagsArray;
            }
            
            if(count($imageArray) > 0){
                $tempDataArray['imagesArray'] = $imageArray;
            }
            
            array_push($dataArray, $tempDataArray);
        }
                
        return response()->json($dataArray, 200);

    }

    /*
    |--------------------------------------------------------------------------
    | Popular Posts
    |--------------------------------------------------------------------------*/

    public function popularPosts($limit){


        $data = DB::table('blog_posts')
                    ->leftjoin('blog_categories', 'blog_categories.id', '=', 'blog_posts.category_id')
                    ->leftjoin('blog_post_content', 'blog_post_content.post_id', '=', 'blog_posts.id')
                    ->leftJoin('meta_titles', 'meta_titles.post_id', '=', 'blog_posts.id')
                    ->where('blog_posts.popular', '=', 1)
                    ->where('blog_posts.status', '=', 1)
                    ->select('blog_posts.id AS post_id','blog_posts.title','blog_posts.description',
                            'blog_categories.name AS categoryName',
                            'blog_posts.post_date','blog_post_content.content AS content', 
                            'meta_titles.title as slug')
                    ->paginate($limit);      
        
        $count = DB::table('blog_posts')
                    ->leftjoin('blog_categories', 'blog_categories.id', '=', 'blog_posts.category_id')
                    ->leftjoin('blog_post_content', 'blog_post_content.post_id', '=', 'blog_posts.id')
                    ->leftJoin('meta_titles', 'meta_titles.post_id', '=', 'blog_posts.id')
                    ->where('blog_posts.popular', '=', 1)
                    ->where('blog_posts.status', '=', 1)
                    ->select('blog_posts.id')
                    ->count(); 

        $dataArray = array();
    
        $tempDataArray = [];
        
        foreach ($data as $data){
            $tagsArray = $this->fetchBlogTagsByID($data->post_id);
            $imageArray = $this->fetchBlogAttachmentsByID($data->post_id);
            $postData = $this->postData($count, $limit);
        
            $tempDataArray['title'] = $data->title;
            $tempDataArray['slug'] = $data->slug;
            $tempDataArray['description'] = $data->description;
            $tempDataArray['post_date'] = $data->post_date;
            $tempDataArray['category'] = $data->categoryName;
            $tempDataArray['content'] = htmlentities($data->content);

            if(count($tagsArray) > 0){
                $tempDataArray['tagsArray'] = $tagsArray;
            }
            
            if(count($imageArray) > 0){
                $tempDataArray['imagesArray'] = $imageArray;
            }
            
            array_push($dataArray, $tempDataArray);
        }
        
        $response = [
            'statusCode'=>200,
            'message'=>'Successfully fetched',
            'popular_posts'=>$dataArray,
            'pagination_data'=>$postData
           ];
        
        return ($response);

        // return response()->json([$postData, $dataArray], 200);

    }


    /*
    |--------------------------------------------------------------------------
    | Related Posts
    |--------------------------------------------------------------------------*/

    public function relatedPosts($current_post_slug){

        $category_code = DB::table('blog_posts')
                        ->join('blog_categories', 'blog_categories.id', '=', 'blog_posts.category_id')
                        ->leftJoin('meta_titles', 'meta_titles.post_id', '=', 'blog_posts.id')
                        ->where('meta_titles.title', '=', $current_post_slug)
                        ->select('blog_categories.code AS code')
                        ->get();

        foreach ($category_code as $category_code) {

            $data = DB::table('blog_posts')
                            ->leftjoin('blog_categories', 'blog_categories.id', '=', 'blog_posts.category_id')
                            ->leftjoin('blog_post_content', 'blog_post_content.post_id', '=', 'blog_posts.id')
                            ->leftJoin('meta_titles', 'meta_titles.post_id', '=', 'blog_posts.id')
                            ->where('blog_categories.code', '=', $category_code->code)
                            ->where('meta_titles.title','!=',$current_post_slug)
                            ->where('blog_posts.status', '=', 1)
                            ->select('blog_posts.id AS post_id','blog_posts.title','blog_posts.description',
                                    'blog_categories.name AS categoryName',
                                    'blog_posts.post_date','blog_post_content.content AS content',
                                    'meta_titles.title as slug')
                            ->get();
        }

        $dataArray = array();
    
        $tempDataArray = [];
                
        foreach ($data as $data){
            $tagsArray = $this->fetchBlogTagsByID($data->post_id);
            $imageArray = $this->fetchBlogAttachmentsByID($data->post_id);
                
            $tempDataArray['title'] = $data->title;
            $tempDataArray['slug'] = $data->slug;
            $tempDataArray['description'] = $data->description;
            $tempDataArray['post_date'] = $data->post_date;
            $tempDataArray['category'] = $data->categoryName;
            $tempDataArray['content'] = htmlentities($data->content);

            if(count($tagsArray) > 0){
                $tempDataArray['tagsArray'] = $tagsArray;
            }
                    
            if(count($imageArray) > 0){
                $tempDataArray['imagesArray'] = $imageArray;
            }
                    
            array_push($dataArray, $tempDataArray);
        }
        
        $response = [
            'statusCode'=>200,
            'message'=>'Successfully fetched',
            'post'=>$dataArray
           ];
        
        return ($response);

        // return response()->json($dataArray, 200);
    }//relatedPosts



    /*
    |--------------------------------------------------------------------------
    | Blog Posts by Tag
    |--------------------------------------------------------------------------*/

    public function blogPostsByTags($tag_code, $limit){
        $result = $this->tagByCode($tag_code);
        
        $tag = DB::table('blog_tag')
                ->where('id','=',$result->id)
                ->select('name')
                ->get();

        $query = DB::table('blog_posts')
                ->leftjoin('blog_categories', 'blog_categories.id', '=', 'blog_posts.category_id')
                ->leftjoin('blog_post_content', 'blog_post_content.post_id', '=', 'blog_posts.id')
                ->leftjoin('blog_post_tags', 'blog_post_tags.post_id', '=', 'blog_posts.id')
                ->leftJoin('meta_titles', 'meta_titles.post_id', '=', 'blog_posts.id')
                ->where('blog_post_tags.tag_id', '=', $result->id)
                ->where('blog_posts.status', '=', 1)
                ->select('blog_posts.id AS post_id','blog_posts.title','blog_posts.description',
                        'blog_categories.name AS categoryName',
                        'blog_posts.post_date','blog_post_content.content','meta_titles.title as slug')
                ->paginate($limit);
        
            $count = DB::table('blog_posts')
                ->leftjoin('blog_categories', 'blog_categories.id', '=', 'blog_posts.category_id')
                ->leftjoin('blog_post_content', 'blog_post_content.post_id', '=', 'blog_posts.id')
                ->leftjoin('blog_post_tags', 'blog_post_tags.post_id', '=', 'blog_posts.id')
                ->where('blog_post_tags.tag_id', '=', $result->id)
                ->where('blog_posts.status', '=', 1)
                ->select('blog_posts.id')
                ->count();

        // if ($limit != null) {
        //     $data = $query
        // }
        
        // $data = $query->select('blog_posts.id AS post_id','blog_posts.title','blog_posts.description',
        //                 'blog_categories.name AS categoryName',
        //                 'blog_posts.post_date','blog_post_content.content')
        //         ->get();

        $dataArray = array();
        foreach ($query as $key => $value) {
            $tempDataArray = [];
            $imageArray = $this->fetchBlogAttachmentsByID($value->post_id);
            $postData = $this->postData($count, $limit);

            $tempDataArray['title'] = $value->title;
            $tempDataArray['slug'] = $value->slug;
            $tempDataArray['description'] = $value->description;
            $tempDataArray['post_date'] = $value->post_date;
            $tempDataArray['category'] = $value->categoryName;
            $tempDataArray['content'] = htmlentities($value->content);

            if(count($imageArray) > 0){
                $tempDataArray['imagesArray'] = $imageArray;
            }

            array_push($dataArray, $tempDataArray);
        }

        $response = [
            'statusCode'=>200,
            'message'=>'Successfully fetched',
            'tag'=>$tag,
            'posts'=>$dataArray,
            'pagination_data'=>$postData
           ];
        
        return ($response);

        // return response()->json([$postData, $dataArray], 200);
    }//blogPosts

    
    public function blogCategories(){
        $categoryArray = array();
        
        $result = DB::table('blog_categories')
                ->leftJoin('blog_posts','blog_posts.category_id','=','blog_categories.id')
                ->select(DB::raw('count(blog_posts.id) as post_count'),'blog_categories.name', 'blog_categories.id','blog_categories.code')
                ->groupBy('blog_categories.name')
                ->groupBy('blog_categories.id')
                ->groupBy('blog_categories.code')
                ->get();

        // $result = DB::table('blog_categories')
        //         ->select('id','name','code')
        //         ->get();

        $count['number_of_categories'] = DB::table('blog_categories')
                                        ->select('id')
                                        ->count();

        foreach ($result as $key => $value) {
            array_push($categoryArray,[
                'id'=>$value->id,
                'code'=>$value->code,
                'name'=>$value->name,
                'post_count'=>$value->post_count
            ]);
        }
        
        $response = [
            'statusCode'=>200,
            'message'=>'Successfully fetched',
            'categories'=>$categoryArray,
            'post_count'=>$count
           ];
        
        return ($response);

        // return response()->json([$count, $categoryArray], 200);
    }//blogCategories
}
