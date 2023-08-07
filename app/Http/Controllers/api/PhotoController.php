<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller; 
use Illuminate\Http\Request;
use Auth;
use Image;
use Storage;
use App\Models\Photo;
use App\Models\User;
use Illuminate\Support\Facades\Response;

class PhotoController extends Controller
{
    //
    public function create(Request $newPost){
        //validate request username and image required and caption is nullable
        $newPost->validate([
            'username'=>'required',
            'image'=>'required|mimes:jpeg, jpg, png|max:2048'
        ]);
        $user = User::find(Auth::User()->id);

        //new instance of model
        $newData = new Photo;
        
        //store image locally
        $file= $newPost->file('image');
        $filename= "upload.".$file->getClientOriginalName();
        Storage::disk('public')->put($filename, file_get_contents($file));
        
        //store image in db through model
        $newData->image = $filename;
        $newData->caption=  $newPost->caption;
        $newData->username=  $newPost->username;
        $user = $user->userPosts()->save($newData);// user and photo have one to many rel so the tables are linked in the db
        
        //return redirect('/home'); ???
    }
    public function read(){
        //return response()->json(["posts"=>Photo::paginate(5)], 200, [], JSON_UNESCAPED_SLASHES);
        return response()->json(["posts"=>Photo::all()]);
    }
    public function getItem(string $id){
        $item = Photo::where("id",$id)->first();
        return response()->json($item);
    }
}
