<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class meta_title extends Model
{
    use HasFactory;
    protected $fillable = ['post_id','title'];

    public function post(): BelongsTo{
        return $this->belongsTo(blog_posts::class);
    }
}
