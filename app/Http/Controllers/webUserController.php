<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Photo;
use Auth;

class webUserController extends Controller
{
    //
    

    public function read(Request $r){
        $model=Photo::all();
        $username=User::where("id",$r->id)->first()->name;
        \Log::info($username);
        $e=[];
        foreach($model as $m){
            if ($m->user_id == $r->id){
                array_push($e,$m);
            }
        }
        return view('profile',['yourPosts'=>$e, 'len'=>count($e), 'id'=>$r->id, 'username'=>$username]);
    }
    public function editpage(string $id){
        $model = User::where("id",$id)->first();
        if(Auth::User()->id != $id){
            return redirect("home");
        }
        $name = $model->name;
        $email = $model->email;
        return view('edituser', ["name"=>$name, "email"=>$email, "id"=>$id]);
        
    }
    public function update(Request $r){
        \Log::info($r);
        if(Auth::User()->id == $r->id){
            $model = User::where("id",$r->id)->first();
            if($r->name){
                $model->name = $r->name;
            }
            if($r->email){
                $model->email = $r->email;
            }
            $model->update();
            return redirect('/user')->with('success', 'User Data updated Successfully');
        }
    }
    public function delete(Request $r){
        \Log::info($r);
        $model = User::where("id",$r->user_id)->first();
        if (Auth::User()->id == $model->id ){
            $model->delete();
            return redirect ("/login");
        }
    }
}
