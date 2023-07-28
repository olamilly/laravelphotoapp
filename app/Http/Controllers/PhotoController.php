<?php

namespace App\Http\Controllers;

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
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('newpost');
    }
    public function create(Request $newPost)
    {
        $newPost->validate([
            'username'=>'required',
            'image'=>'required|mimes:jpeg, jpg, png|max:2048'
        ]);
        $user = User::find(Auth::User()->id);
        $newData = new Photo;
        
        $file= $newPost->file('image');
        $filename= "upload.".$file->getClientOriginalName();
        Storage::disk('public')->put($filename, file_get_contents($file));
        
        $newData->image = $filename;
        $newData->caption=  $newPost->caption;
        $newData->username=  $newPost->username;
        $user = $user->userPosts()->save($newData);
        return redirect('/home');
    }
    public function delete(Request $r){
        $tbd=Photo::find($r->post_id);
        if($tbd->user_id != Auth::User()->id){
            return redirect()->back()->with('error', 'Not Authorized to modify this post');
        }
        $tbd->delete();
        return redirect()->back()->with('success', 'Post Edited successfully');
    }
    public function update(Request $myData){
        $model = Photo::find($myData->id);
        if($model->user_id != Auth::User()->id){
            return redirect()->back()->with('error', 'Not Authorized to modify this post');
        }
        $model->caption = $myData->newCaption;
        $model->update();
        return redirect()->back()->with('success', 'Post Edited successfully');   
    }
}
