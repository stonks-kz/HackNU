<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostsModel extends Model
{

    protected $table = "posts";

    protected $fillable = [
        'user_id',
        'title',
        'text',
        'status',
        'like',
        'dislike',
        'created_at',
        'updated_at'
    ];
    use HasFactory;
}
