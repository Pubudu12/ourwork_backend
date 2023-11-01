<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

use App\Models\blog_category as BlogCategoryTable;
use App\Models\blog_tag as BlogTagtable;
use App\Models\blog_posts as BlogPostsTable;
use App\Models\meta_title as MetaTitleTable;
use App\Models\blog_post_attachments as BlogPostAttachmentsTable;
use App\Models\blog_post_content as BlogPostContentTable;
use App\Models\blog_post_tags as BlogPostTagsTable;
use Ramsey\Uuid\Type\Integer;

use Illuminate\Support\Facades\DB;
use App\Models\blog_post_tags;
class BlogController extends Controller
{



    /*
    |--------------------------------------------------------------------------
    | Blog Categories - LIST
    |--------------------------------------------------------------------------*/
    
    public function getCategories(){
        $blogCategories = BlogCategoryTable::all();
        return view('blog/blogCategories/categories',['data'=>$blogCategories]);
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
            
            $BlogCategoryTable = new BlogCategoryTable;

            $BlogCategoryTable->name = $inputs['name'];
            $BlogCategoryTable->code = $code;
            $insert = $BlogCategoryTable->save();

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
        $data = BlogCategoryTable::find($categoryId);
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

            $data = BlogCategoryTable::find($request->id);

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
        $data = BlogCategoryTable::find($categoryId);
        
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
    
    /*
    |--------------------------------------------------------------------------
    | Blog Tags - LIST
    |--------------------------------------------------------------------------*/
    
    public function getTags(){
        $blogTags = BlogTagtable::all();
        return view('blog/blogTag/tags',['data'=>$blogTags]);
    } //getTags()


    /*
    |--------------------------------------------------------------------------
    | Tags - CREATE
    |--------------------------------------------------------------------------*/

    public function createBlogTag(Request $request){

        $message = 'Failed to create the blog tag';
        $value = 0;
        $redirect = '/blog/tags';

        $validation = Validator::make($request->all(), [
            'name' => ['required']
        ]);
        
        if ($validation->fails()) {
            $message = 'Please Enter Tag Name!';
        }else{

            $inputs = $request->all();
            $code = strtolower(trim($inputs['code']));
            if(empty($code)){
                $code = rand().Date("ymdhis");
            }
            
            $blogtagtable = new BlogTagtable;

             $blogtagtable->name = $inputs['name'];
             $blogtagtable->code = $code;

             $insert = $blogtagtable->save();

            if ($insert) {
                $message = 'Tag has been created successfully';
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
    | Tags - UPDATE
    |--------------------------------------------------------------------------*/

    public function getBlogtagById($categoryId){
        $data = BlogTagtable::find($categoryId);
        return view('blog/blogTag/updateTag',['data'=>$data]);
    } //getBlogCategoryById 


    public function updateBlogTag(Request $request){

        $message = 'Failed to update the blog category';
        $value = 0;
        $redirect = '/blog/tags';

        $validation = Validator::make($request->all(), [
            'name' => ['required'],
            'code' => ['required'],
            'id' => ['required'],
        ]);

        if ($validation->fails()) {
            $message = 'Please Enter Required Details!';

        }else{


            $data = BlogTagtable::find($request->id);

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
    | Tags - DELETE
    |--------------------------------------------------------------------------*/

    public function deleteBlogTag($categoryId){

        $message = 'Failed to delete the category';
        $value = 0;
        $redirect = '/blog/tags';
        $data = BlogTagtable::find($categoryId);
        
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


    /*
    |--------------------------------------------------------------------------
    | Blog - LIST
    |--------------------------------------------------------------------------*/

    public function getBlogs(){
        $blogsPosts = BlogPostsTable::orderBy('id', 'DESC')->get();
        return view('blog/blogs', ['data' => $blogsPosts]);
    } //getBlogs


    /*
    |--------------------------------------------------------------------------
    | Blog Post - CREATE
    |--------------------------------------------------------------------------*/

    public function getBlogCreate(){
        $BlogCategoryTable = BlogCategoryTable::all();
        $BlogTagtable = BlogTagtable::all();
        return view('blog/createBlog', ['categories' => $BlogCategoryTable, 'tags'=>$BlogTagtable]);
    } //getBlogCreate

    public function createBlog(Request $request){

        $message = 'Failed to create the blog post';
        $value = 0;
        $redirect = '/blog';

        $validation = Validator::make($request->all(), [
            'title' => ['required'],
            'category' => ['required'],
            'description' => ['required'],
            'tags' => ['required']
        ]);
        
        if ($validation->fails()) {
            $message = 'Please Enter required details!';
        }else{

            $popular = '0';
            if (isset($request->popular)) {
                $popular = '1';
            }
            $status = '0';
            if (isset($request->status)) {
                $status = '1';
            }

             $inputs = $request->all();
            
             $blogPostTable = new BlogPostsTable;

             $blogPostTable->title = $inputs['title'];
             $blogPostTable->category_id = $inputs['category'];
             $blogPostTable->description = $inputs['description'];
             $blogPostTable->post_date = Date("Y-m-d", strtotime($inputs['date']));
             $blogPostTable->highlight = '0';
             $blogPostTable->status = $status;
             $blogPostTable->popular = $popular;

             $insert = $blogPostTable->save();

             $lastPostId = $blogPostTable->id;

             $tagsIdArr = $inputs['tags'];

             $this->insertBlogPostTags($lastPostId, $tagsIdArr);

             $this->insertSlug($lastPostId, $blogPostTable->title);

            if ($insert) {
                $message = 'Blog post has been created successfully';
                $value = 1;
                $redirect = '/addBlogImage/'.$lastPostId;
            }

        }

        return back()->with( array(
            'message' => $message,
            'value' => $value,
            'redirect'=> $redirect
        ));

    } //createBlog


    // Blog Content
    public function Blogcontent($postId){

        
        $blogContent = DB::table('blog_posts')
                            ->leftJoin('blog_post_content', 'blog_posts.id', '=', 'blog_post_content.post_id')
                            ->where('blog_posts.id','=',$postId)
                            ->select('blog_post_content.*','blog_posts.title AS blogtitle', 'blog_posts.id AS blogId')
                            ->first();
        return view('blog/blogContent',['blogContent'=>$blogContent]);

    }

    public function UpdateBlogcontent(Request $request){
        $message = 'Failed to update the blog content';
        $value = 0;
        $redirect = '/blog';

        $validation = Validator::make($request->all(), [
            'content' => ['required'],
            'post_id' => ['required'],
        ]);

        if ($validation->fails()) {
            $message = 'Please Enter Required Details!';

        }else{


            $countSameId = DB::table('blog_post_content')->where( 'post_id', '=' ,$request->post_id)->count();
            if($countSameId > 0){
                // Update
                $response = DB::table('blog_post_content')->where('post_id',$request->post_id)->update(['content'=>$request->content]);
            }else{
                // Insert
                $response = DB::table('blog_post_content')->insert(['content'=>$request->content, 'post_id'=>$request->post_id]);
            }

            if ($response) {
                $message = 'Blog content has been updated successfully';
                $value = 1;
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
    | Blog Image - INSERT and UPDATE
    |--------------------------------------------------------------------------*/

    function fetchBlogDetails($id){
        $blogs = DB::table('blog_posts')
                            ->where('id','=',$id)
                            ->select('blog_posts.*')
                            ->first();
        return $blogs;
    }//fetchBlogDetails()

    function addBlogImage($id){

        $blogs = $this->fetchBlogDetails($id);
        $data = DB::table('blog_post_attachments')
                    ->where('post_id','=',$id)
                    ->where('media_type','=','image')
                    ->select('blog_post_attachments.*')
                    ->first();
        $video_data = DB::table('blog_post_attachments')
                    ->where('post_id','=',$id)
                    ->where('media_type','=','video')
                    ->select('blog_post_attachments.*')
                    ->first();
        
        return view('blog/addBlogImage', ['blogs' => $blogs,'data' => $data, 'video_data' => $video_data]);
    }//addBlogImage()


    function saveImage(Request $req){
        
        $message = '';
        $value = 0;
        $redirect = '';
        $res = '';
        $blog_image = new BlogPostAttachmentsTable;

        $data = DB::table('blog_post_attachments')
                    ->where('post_id','=',$req->id)
                    ->select('blog_post_attachments.*')
                    ->first();
        $validation = Validator::make($req->all(), [
            // 'file' => ['required'],
            'upload_type' => ['required']
        ]);
        
        if ($validation->fails()) {
            $message = 'Please select upload type!';
        }else{
            
            if ($req->file('file') !== null && $req->upload_type === 'image') {
                
                $data = DB::table('blog_post_attachments')
                        ->where('post_id','=',$req->id)
                        ->where('media_type','=','image')
                        ->select('blog_post_attachments.*')
                        ->first();

                if($data === null){
                
                    $image = $req->file('file');
                    $image_name = rand().'.'.$image->getClientOriginalExtension();

                    $image->move(public_path("/uploads/blogs/"),$image_name);
                    $blog_image->post_id = $req->post_id;
                    $blog_image->media_type = "image";
                    $blog_image->name = $image_name;
                    $res = $blog_image->save();
                    if ($res) {
                        $message = 'Upload Success!';
                        $value = 1;
                        $redirect = '/blog';
                    } else {
                        $message = 'Upload Failed!';
                    }
                }else {
                    $path = public_path().'/uploads/blogs/';
                    $file_old = $path.$data->name;
                    unlink($file_old);

                    $delete_image = BlogPostAttachmentsTable::where('post_id', $req->post_id)
                                                            ->where('media_type','image')
                                                            ->delete();
                    if ($req->file('file') !== null) {
                        $image = $req->file('file');
                        $image_name = rand().'.'.$image->getClientOriginalExtension();

                        $image->move(public_path("/uploads/blogs/"),$image_name);
                        $blog_image->post_id = $req->post_id;
                        $blog_image->media_type = "image";
                        $blog_image->name = $image_name;
                        $res = $blog_image->save();
                    }
                    if ($res) {
                        $message = 'Upload Success!';
                        $value = 1;
                        $redirect = '/blog';
                    } else {
                        $message = 'Upload Failed!';
                    }
                }
            } 
            
            if ($req->link !== null && $req->upload_type === 'video') {
              
                $data = DB::table('blog_post_attachments')
                        ->where('post_id','=',$req->id)
                        ->where('media_type','=','video')
                        ->select('blog_post_attachments.*')
                        ->first();

                if($data === null){
                    $blog_image->post_id = $req->post_id;
                    $blog_image->media_type = "video";
                    $blog_image->video = $req->link;

                    $res = $blog_image->save();
                    if ($res) {
                        $message = 'Upload Success!';
                        $value = 1;
                        $redirect = '/blog';
                    } else {
                        $message = 'Upload Failed!';
                    }
                }else{
                    $delete_video = BlogPostAttachmentsTable::where('post_id',$req->post_id)
                                                                ->where('media_type','video')
                                                                ->delete();
                    
                    $blog_image->post_id = $req->post_id;
                    $blog_image->media_type = "video";
                    $blog_image->video = $req->link;

                    $res = $blog_image->save();
                    if ($res) {
                        $message = 'Upload Success!';
                        $value = 1;
                        $redirect = '/blog';
                    } else {
                        $message = 'Upload Failed!';
                    }
                }
            }
        }

        return back()->with( array(
            'message' => $message,
            'value' => $value,
            'redirect'=> $redirect,
        ));    
        
    }//saveImage()

    public function insertBlogPostTags($postId, $TagsIdArray){

        $blogPosttags = BlogPostTagsTable::where('post_id', $postId)->get();
        if($blogPosttags->count() > 0){
            foreach ($blogPosttags as $key => $value) {
                $data = BlogPostTagsTable::find($value->id);
                $data->delete();
            }
        }

        if(count($TagsIdArray) > 0){
            foreach ($TagsIdArray as $key => $tagId) {
                $tagStatus = BlogPostTagsTable::insert(['post_id' => $postId, 'tag_id'=>$tagId]);
            }
        }

    } //insertBlogPostTags()


    public function insertSlug($postId, $title){
        
        $tiitle = Str::slug($title,'-');    
        $slug = '100'.$postId.'-'.$tiitle;
        MetaTitleTable::updateOrCreate(
            ['post_id' => $postId],
            ['title' => $slug]
        );  

    } //insertSlug()

    public function deleteSlug($postId){
        
        MetaTitleTable::where('post_id', $postId)->delete();

    } //deleteSlug()
   

    /*
    |--------------------------------------------------------------------------
    | Blog Post - UPDATE
    |--------------------------------------------------------------------------*/

    public function getBlogPostById($blogId){

        $blogCategories = DB::table('blog_categories')
                    ->get();
        
        $blogPostTags = DB::select('SELECT blog_tag.name AS name, blog_tag.id AS id  FROM blog_tag, blog_post_tags, blog_posts
                                        WHERE blog_tag.id = blog_post_tags.tag_id
                                        AND blog_posts.id = blog_post_tags.post_id
                                        AND blog_posts.id ='.$blogId);

        $blogTags = DB::table('blog_tag')
                        ->get();

        $data = BlogPostsTable::find($blogId);
        $this->insertSlug($blogId, $data->title);

        return view('blog/updateBlog',['data'=>$data, 'blogCategories' => $blogCategories, 'blogPostTags' => $blogPostTags, 'blogTags' => $blogTags]);

    } //getBlogPostById

    public function changeStatus(Request $request){
        $message = 'Status is not updated!';
        $value = 0;
        $redirect = '';
        $blogs = new BlogPostsTable;
        $blogs = BlogPostsTable::find($request->id);
        if ($blogs->status == '1') {
            $blogs->status = '0';
        } else {
            $blogs->status = '1';
        }
        $res = $blogs->save();
        if ($res == 1) {
            $message = 'Status Updated Successfully!';
            $value = 1;
        }

        return array('message'=>$message,'value'=>$value,'redirect'=> $redirect);
    }

    public function changePopularStatus(Request $request){
        $message = 'Status is not updated!';
        $value = 0;
        $redirect = '';
        $blogs = new BlogPostsTable;
        $blogs = BlogPostsTable::find($request->id);
        if ($blogs->popular == '1') {
            $blogs->popular = '0';
        } else {
            $blogs->popular = '1';
        }
        $res = $blogs->save();
        if ($res == 1) {
            $message = 'Status Updated Successfully!';
            $value = 1;
        }

        return array('message'=>$message,'value'=>$value,'redirect'=> $redirect);
    }

    public function changeHighlightStatus(Request $request){
        $message = 'Status is not updated!';
        $value = 0;
        $redirect = '';
        $blogs = new BlogPostsTable;
        $blogs = BlogPostsTable::find($request->id);
        if ($blogs->highlight == '1') {
            $blogs->highlight = '0';
        } else {
            $blogs->highlight = '1';
        }
        $res = $blogs->save();
        if ($res == 1) {
            $message = 'Status Updated Successfully!';
            $value = 1;
        }

        return array('message'=>$message,'value'=>$value,'redirect'=> $redirect);
    }

    public function updateBlog(Request $req){

        $message = '';
        $value = 0;
        $redirect = '';
        $data = BlogPostsTable::find($req->id);

        $validation = Validator::make($req->all(), [
            'title' => ['required'],
            'category' => ['required'],
            'description' => ['required']
        ]);

        if ($validation->fails()) {
            $message = 'Please Enter Category!';
        }else{
            $popular = '0';
            if (isset($req->popular)) {
                $popular = '1';
            }
            $status = '0';
            if (isset($req->status)) {
                $status = '1';
            }
            
            $data->title = $req->title;
            $data->category_id = $req->category;
            $data->post_date = $req->date;
            $data->description = $req->description;
            $data->status = $status;
            $data->popular = $popular;

            $data->save(); 
            
            $tagsIdArr = $req['tags'];

            if ($data) {
 
                $message = 'Blog updated successfully';
                $value = 1;
                $redirect = '/addBlogImage/'.$req->id;

                if(isset($tagsIdArr)){
                    $status = $this->insertBlogPostTags($req->id, $tagsIdArr);
                }

            }else{
                $message = 'Blog is not updated';
            }
        }
        return back()->with( array(
            'message' => $message,
            'value' => $value,
            'redirect'=> $redirect
        ));

    }//updateBlog()

    /*
    |--------------------------------------------------------------------------
    | Blog Post - DELETE
    |--------------------------------------------------------------------------*/
    
    function fetchBlogImage($id){
        $blog_image = DB::table('blog_posts')
                            ->leftjoin('blog_post_attachments', 'blog_posts.id', '=', 'blog_post_attachments.post_id')
                            ->where('blog_posts.id','=',$id)
                            ->select('blog_posts.*','blog_post_attachments.name AS blog_image')
                            ->first();
        return $blog_image;
    }//fetchBlogImage()

    function deleteBlog($id){

        $message = '';
        $value = 0;
        $redirect = '';
        $blogPost = BlogPostsTable::find($id);

        $blogPostTag = DB::table('blog_post_tags')
                            ->where('post_id', '=', $id);
        
        $blog_image = $this->fetchBlogImage($id);

        $path = public_path().'/uploads/blogs/';

        if($blog_image->blog_image != ''  && $blog_image->blog_image != null){                

            $file_old = $path.$blog_image->blog_image;

            if(file_exists($file_old)){
                unlink($file_old);
            }

        }
        
        $delete_image = BlogPostAttachmentsTable::where('post_id', $id)
                            ->delete();

        $deleteBlogPost = $blogPost->delete();
        $deleteBlogPostTag = $blogPostTag->delete();
       
        if($delete_image and $deleteBlogPost and $deleteBlogPostTag){
            
            $message = 'Blog deleted Successfully';
            $value = 1;
            $redirect = '/blog';

            $this->deleteSlug($id);

        }else {
            $message = 'Blog is not deleted';
        }
    
        return back()->with( array(
            'message' => $message,
            'value' => $value,
            'redirect'=> $redirect
        ));

    }//deleteBlog() 

} // Blog Controleer
