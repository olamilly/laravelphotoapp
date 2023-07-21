<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class apiAuthController extends Controller
{
    //
    public function register(Request $request) 
    { 
        $validator = Validator::make($request->all(), [ 
            'name' => 'required', 
            'email' => 'required|email', 
            'password' => 'required', 
            'confirm_password' => 'required|same:password', 
        ]);
        if ($validator->fails()) { 
            return response()->json(['error'=>$validator->errors()], 401);            
        }
        $input = $request->all(); 
        $input['password'] = bcrypt($input['password']); 
        $user = User::create($input); 
        $success['token'] =  $user->createToken('user-token')-> plainTextToken; 
        $success['name'] =  $user->name;
        return response()->json(['success'=>$success], 200); 
    }

    public function login(Request $r){ 
        \Log::info($r);
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('user-token')-> plainTextToken; 
            return response()->json(['success' => $success], 200); 
        } 
        else{ 
            return response()->json(['error'=>'Credentials incorrect, Login Unauthorised. Register or check login data and try again'], 401); 
        } 
    }
}
