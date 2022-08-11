<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    //
    public function Register(Request $request)
    {
        /*
        $fields= $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|unique:user,email',
            'password'=> 'required|string|confirmed'
        ]);*/
        $user = new User();
        $user->name=$request->name;
        $user->email=$request->email;
        $user->password=bcrypt($request->password);
        $user->mobile=$request->mobile;
        $user->address='damas';
        $user->city='Damascus';
        $user->gender=$request->gender;
        $user->role_id=1;
        $user->birth=$request->birth;
        $user->image='https://i.stack.imgur.com/l60Hf.png';
        $user->save();
        if ($user){
            
            return response($user,201);
        }
        else{
            return response([
                'message'=>'Wronge In Register'
            ],400);
        }
    }

    public function logout(Request $request){
        $request->user()->currentAccessToken()->delete();
        return response([
            'message'=>'Logged out'
        ],201);
    }
    public function login(Request $request)
    {
       
        $user = User::where('email',$request->email)->first();

        if(!$user || !Hash::check($request->password,$user->password))
        {
            return response([
                'message'=>'wrong password or email'
            ],401);
        }
        $token =$user->createToken('projecttoken')->plainTextToken;

        $response= [
            'user' => $user,
            'token' => $token
        ];

        return response($response,201);
    }
}
