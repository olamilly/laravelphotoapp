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
    public function read(){
        //return response()->json(["posts"=>Photo::paginate(5)], 200, [], JSON_UNESCAPED_SLASHES);
        return response()->json(["posts"=>Photo::all()]);
    }
    public function getItem(string $id){
        $item = Photo::where("id",$id)->first();
        return response()->json($item);
    }
}
