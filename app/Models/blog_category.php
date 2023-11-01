<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class blog_category extends Model
{
    protected $table = 'blog_categories';

    public function posts(): HasMany{
        return $this->hasMany(blog_posts::class, 'category_id');
    }
}
