<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\ApiHandlerModel;
use App\Models\CommentsModel;
use App\Models\PostsModel;
use App\Models\PostTagsModel;
use App\Models\TagsModel;
use App\Models\User;
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

    public function getAllPosts(){
        return PostsModel::limit(48)->orderBy('created_at', 'DESC')->get();
    }

    public function getPostById($id){
        $post = PostsModel::get()->where("id", "=", $id)->all();
        foreach ($post as $key => $item){
            $postData = $item;
        }

        $user_id = $postData->user_id;
        $user = User::where("id", "=", $user_id)->get();
        $user_name = $user[0]->name;

        return array(["post" => $postData, "user_name" => $user_name, "user_id" => $user_id]) ;
    }

    public function getUserData($id) {
        $user = User::where("id", "=", $id)->get();
        $posts = PostsModel::where("user_id", "=", $id)->get()->all();
        return array($posts, $user[0]->name);
    }

    public function setComment(Request $req){
        $creat = Carbon::now()->format('Y-m-d H:i:s');

        CommentsModel::insert([
            'user_id' => $req->user_id,
            'post_id' => $req->post_id,
            'text' => $req->text,
            'like' => 0,
            'dislike' => 0,
            'created_at' => $creat,
            'updated_at' => $creat
        ]);
        return "success";
    }
    public function getComments($id){
        $comments = CommentsModel::where("post_id", "=", $id)
            ->orderBy('like', 'DESC')
            ->orderBy('created_at', 'DESC')
            ->orderBy('dislike', 'ASC')->get()->all();
        return $comments;
    }

    public function addLikeC(Request $request){
        CommentsModel::where("id", "=", $request->id)->update(['like' => $request->count]);
        return "success";
    }
    public function addDLikeC(Request $request){
        CommentsModel::where("id", "=", $request->id)->update(['dislike' => $request->count]);
        return "success";
    }
    public function likePost(Request $request){
        PostsModel::where("id", "=", $request->id)->update(['like' => $request->count]);
        return "success";
    }
    public function dislikePost(Request $request){
        PostsModel::where("id", "=", $request->id)->update(['dislike' => $request->count]);
        return "success";
    }

}
