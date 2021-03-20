<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostTagsModel extends Model
{

    protected $table = "post_tags";

    protected $fillable = [
        'post_id',
        'tag_id'
    ];


    use HasFactory;
}
