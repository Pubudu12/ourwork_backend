<?php

namespace App\GraphQL\Queries;

use Illuminate\Support\Facades\DB;

class BlogPostsQuery
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        // TODO implement the resolver
    }

    public function byPopular($root, array $args){
        return \App\Models\blog_posts::query()
            ->where('popular', $args['popular'])
            ->get();
    }

    public function bySlug($root, array $args){
        return \App\Models\blog_posts::query()
            ->join('meta_titles','meta_titles.post_id','=','blog_posts.id')
            ->where('meta_titles.title', $args['slug'])
            ->get();
    }

    public function tags($root, array $args){

        return \App\Models\blog_posts::query()
            ->leftjoin('blog_post_tags','blog_post_tags.post_id','=','blog_posts.id')
            ->leftjoin('blog_tag','blog_post_tags.tag_id','=','blog_tag.id')
            ->where('blog_post_tags.post_id','=',$root['id'])
            ->get();
    }

    public function tag_posts($root, array $args){

        return \App\Models\blog_posts::query()
            ->leftjoin('blog_post_tags','blog_post_tags.post_id','=','blog_posts.id')
            ->leftjoin('blog_tag','blog_post_tags.tag_id','=','blog_tag.id')
            ->where('blog_tag.id','=',$root['id'])
            ->get();
    }

    public function post_tags($root, array $args){

        $data = DB::table('blog_posts')
                ->leftjoin('blog_post_tags', 'blog_post_tags.post_id', '=', 'blog_posts.id')
                ->leftjoin('blog_tag', 'blog_post_tags.tag_id', '=', 'blog_tag.id')
                ->leftjoin('meta_titles','meta_titles.post_id','=','blog_posts.id')
                ->where('blog_tag.name', '=', $args)
                ->get();

        return $data;
    }

    public function image_url($root, array $args){

        return url('/').'/uploads/blogs/';
       
    }

    public function blog_videos($root, array $args){

        return \App\Models\blog_posts::query()
            ->join('blog_post_attachments','blog_post_attachments.post_id','=','blog_posts.id')
            ->where('blog_posts.id','=',$root['post_id'])
            ->get();
    }
    
}
