<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use App\models\Photo;
use App\models\User;
use Auth;

class PhotoController extends Controller
{
    //
    public function create(Request $r){
        $r->validate([
            'image'=>'required|mimes:jpeg, jpg, png|max:2048'
        ]);
        $user = User::find(Auth::User()->id);
        $newPost = new Photo;
        if($r->username){
            $newPost->username = $r->username;
        }
        else{
            $newPost->username = Auth::User()->name;
        }
        

        $file= $r->file('image');
        $filename= date('YmdHi').$file->getClientOriginalName();
        $file-> move(public_path('public/Image'), $filename);
        $newPost->image = $filename;
      
        $newPost->caption = $r->caption;
        $user = $user->userPosts()->save($newPost);
        return response()->json(["posts"=>Photo::paginate(5)], 200, [], JSON_UNESCAPED_SLASHES);
    }
    public function read(){
        return response()->json(["posts"=>Photo::paginate(5)], 200, [], JSON_UNESCAPED_SLASHES);
    }
    public function delete(string $id){
        $tbd = Photo::where("id",$id)->first();
        if($tbd->user_id != Auth::User()->id){
            //can't delete a post if its not yours
            return response()->json(["message"=>"You are not authorized to delete this post."]);
        }
        $tbd->delete();
        return response()->json(["posts"=>Photo::paginate(5)], 200, [], JSON_UNESCAPED_SLASHES);
    }
    public function update(string $id, Request $r){
        $tbe = Photo::where("id",$id)->first();
        if($tbd->user_id != Auth::User()->id){
            //can't edit a post if its not yours
            return response()->json(["message"=>"You are not authorized to modify this post."]);
        }
        $tbe->caption = $r->caption;
        $tbe->update();
        return response()->json($tbe, 200, [], JSON_UNESCAPED_SLASHES);
    }
    public function getItem(string $id){
        $item = Photo::where("id",$id)->first();
        return response()->json($item);
    }
    
}
