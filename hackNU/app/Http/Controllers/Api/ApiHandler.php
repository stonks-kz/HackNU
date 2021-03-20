<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ApiHandlerModel;
use App\Models\PostsModel;
use App\Models\PostTagsModel;
use App\Models\TagsModel;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;


class ApiHandler extends Controller{
    public function getTagList(){
        $result = TagsModel::all();
        return $result;
    }

    public function addPost(Request $request) {
        $creat = Carbon::now()->format('Y-m-d H:i:s');

        PostsModel::insert([
            "user_id" => $request->user_id,
            "like" => $request->like,
            "dislike" => $request->dislike,
            "status" => $request->status,
            "title" => $request->title,
            "text" => $request->text,
            'created_at' => $creat,
            'updated_at' => $creat
        ]);

        $post_id = PostsModel::where("user_id", "=", $request->user_id)
            ->where("title", "=", $request->title)
            ->where("created_at", "=", $creat)
            ->get("id");

        foreach($request->categories as $tag){
            PostTagsModel::insert([
                "post_id" => $post_id[0]->id,
                "tag_id" => $tag
            ]);
        }
        return response()->json(["error" => false]);
    }

    public function profileGetPosts(){
        return PostsModel::all();
    }
}
