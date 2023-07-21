<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\post;
use Auth;

class apipostController extends Controller
{
    //
    public function create(Request $r){
        $newPost = new post;
        $newPost->username = Auth::User()->name;
        $newPost->image= $r->image;
        $newPost->caption = $r->caption;
        $newPost->save();
        return response()->json(["posts"=>post::paginate(3)]);
    }
    public function read(){
        return response()->json(["posts"=>post::paginate(3)]);
    }
    public function search(Request $r){
        $searchResult = post::where("caption",$r->q)->first();
        return response()->json($searchResult);
    }
    public function delete(string $id){
        $tbd = post::where("id",$id)->first();
        if($tbd->user_id != Auth::User()->id){
            //can't delete a post if its not yours
            return response()->json(["message"=>"You are not authorized to delete this post."]);
        }
        $tbd->delete();
        return response()->json(firstModel::all());
    }
    
}
