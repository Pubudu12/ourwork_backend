<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class career_images extends Model
{
    use HasFactory;
    protected $table = 'career_images';
    protected $fillable = ['career_image'];
}
