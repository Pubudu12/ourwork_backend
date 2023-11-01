<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class blog_posts extends Model
{
    use HasFactory;
    protected $table = 'blog_posts';

    public function attachments(){
        return  $this->hasMany(blog_post_attachments::class,'post_id');
    }

    public function content(): HasOne{
        return $this->hasOne(blog_post_content::class, 'post_id');
    }

    public function slug(): HasMany{
        return $this->hasMany(meta_title::class, 'post_id');
    }

    public function category(): BelongsTo{
        return $this->belongsTo(blog_category::class);
    }

    // public function tags(): BelongsTo{
    //     return $this->belongsTo(blog_tag::class);
    // }
}
