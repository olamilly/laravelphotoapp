<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Photo;
use App\Models\User;
use Storage;
use Auth;
use Illuminate\Support\Facades\Http;
class HomeController extends Controller
{
    

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $r)
    {
        $myQuery=$r->get("query");
        $searchResults = Photo::search($myQuery)->paginate(5);
        return view('home',["posts"=>$searchResults]);
    }
    public function search(Request $r){
        $validator = $r->validate([
            'foreignQuery' => ['required', 'max:100'],
        ]);
        $myQuery=$r->get("foreignQuery");
        $response = Http::get('https://pixabay.com/api/', [
            'key' => '38456185-65391823b2f8de0ceea7e2c5e',
            'q' => $myQuery,
            'image_type'=>'photo',
        ]);
        $images = $response->object()->hits;
        /*'id' => $i->id,
                'pageURL' => $i->pageURL,
                'webformatURL' => $i->webformatURL,
                'user' => $i->user,
                'tags' => $i->tags,*/
        //dd($images[0]);
        return view('home', ['results'=>$images, 'q'=>$myQuery]);
    }
    public function download(Request $r){
        $user = User::find(Auth::User()->id);
        $url = $r->link;
        //date('YmdHi')
        $name = "download.".$r->id.".jpg";
        $imageContent = file_get_contents($url);
        Storage::disk('public')->put($name, $imageContent);

        $newData = new Photo;
        $newData->image = $name;
        $newData->caption=  $r->q;
        $newData->username=  Auth::User()->name;
        $user = $user->userPosts()->save($newData);
        return redirect()->route("home")->with('success', 'Image downloaded successfully');
    }
}
