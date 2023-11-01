<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class blog_tag extends Model
{
    protected $table = 'blog_tag';

    public function blog_post_tags(): HasMany{
        return $this->hasMany(blog_post_tags::class, 'tag_id');
    }

    // public function tag_posts(): HasMany{
    //     return $this->hasMany(blog_posts::class,'id'); 
    // }
}
