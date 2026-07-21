<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContentItem extends Model
{
    use HasFactory;
    protected $fillable = ['section', 'title', 'subtitle', 'description', 'icon', 'image_path', 'project_url', 'price', 'meta', 'sort_order', 'is_active'];
    protected $casts = ['meta' => 'array', 'is_active' => 'boolean'];
}
