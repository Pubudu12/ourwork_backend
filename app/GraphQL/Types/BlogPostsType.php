<?php

namespace App\GraphQL\Types;

use App\Models\blog_posts;

class BlogPostsType
{
    public function attachments(blog_posts $blog_posts){  

        // $image = $blog_posts->attachments()->get();

         
        return $blog_posts->attachments()->get();
    }
    
}