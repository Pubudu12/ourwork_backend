<?php

namespace App\GraphQL\Queries;

use Illuminate\Support\Facades\DB;

class GalleryQuery
{
    /**
     * @param  null  $_
     * @param  array<string, mixed>  $args
     */
    public function __invoke($_, array $args)
    {
        // TODO implement the resolver
    }

    public function image_url($root, array $args){

        return url('/').'/uploads/gallery/';
       
    }
}
