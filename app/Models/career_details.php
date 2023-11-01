<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class career_details extends Model
{
    use HasFactory;
    protected $fillable = ['description', 'career_id', 'detail_sections_id'];
}
