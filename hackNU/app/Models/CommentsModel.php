<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentsModel extends Model
{

    protected $table = "comments";

    protected $fillable = [
        "text",
        'like',
        'dislike'

    ];
    use HasFactory;
}
