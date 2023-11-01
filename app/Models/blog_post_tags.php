<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class blog_post_tags extends Model
{
    protected $table = 'blog_post_tags';

    public function blog_posts(): BelongsTo{
        return $this->belongsTo(blog_posts::class, 'post_id');
    }
}
