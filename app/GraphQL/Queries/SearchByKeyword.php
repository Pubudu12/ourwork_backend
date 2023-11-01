<?php

namespace App\GraphQL\Queries;

use App\Models\blog_posts;

class SearchByKeyword
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        
        
    }

    public function search_posts($root, array $args){
        return blog_posts::where('title','like','%'.$args['text'].'%')
                            ->orWhere('description','like','%'.$args['text'].'%')
                            ->get();
    }
}
