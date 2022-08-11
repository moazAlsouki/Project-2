<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\User;
use Facade\FlareClient\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    //
    function getAllUsers()
    {
        return User::all();
    }
    

    public function deleteUser(Request $request)
    {
        $user = User::find($request->id);
        return $user->delete();
    }

    
    public function getPersonalInfo()
    {
        return Auth::user();
    }
    
    
    public function SearchWithFilter(Request $request)
    {
        
        if ($request->city){
            $city=$request->city;
        }
        else{
            $city =Auth::user()->city;
        }

        $doctors = DB::table('users')
            ->where('role_id','=',2)
            ->where('city','=',$city)
            ->get();  
        $Pharmacies = DB::table('users')
            ->where('role_id','=',3)
            ->where('city','=',$city)
                ->get();
        $laboratories = DB::table('users')
                ->where('role_id','=',3)
                ->where('city','=',$city)
                ->get();
        return [
           'doctors'=> $doctors,
           'Pharmacies' => $Pharmacies,
           'laboratories' =>$laboratories
        ];
    }

    public function addUser(Request $request)
    {
        if ($request->type=='update'){
            $user=User::find(Auth::user()->id);
            $user->name=$request->name;
            $user->email=$request->email;
            $user->password=bcrypt($request->password);
            $user->mobile=$request->mobile;
            $user->address=$request->address;
            $user->city=$request->city;
            $user->save();
            return $user;
        }
        else if(Auth::user()->role_id='6') {
            $user= new User();
            $user->name=$request->name;
            $user->email=$request->email;
            $user->password=bcrypt($request->password);
            $user->mobile=$request->mobile;
            $user->address=$request->address;
            $user->city=$request->city;
            $user->role_id=$request->role_id;
            $user->save();
            return $user;
        }
        else 
        return [
            'message' => 'cant do this operation .'
        ];
    }


    public function getStaff()
    {
        $doctors = DB::table('users')
            ->where('role_id','=',2)
            ->get();  
        $Pharmacies = DB::table('users')
            ->where('role_id','=',3)
                ->get();
        $laboratories = DB::table('users')
                ->where('role_id','=',3)
                ->get();
        return Response([
           'doctors'=> $doctors,
           'pharmacies' => $Pharmacies,
           'laboratories' =>$laboratories
        ],201);
    }
    public function getDoctors()
    {
        $doctors = DB::table('users')
            ->where('role_id','=',2)
            ->get();  
            return response($doctors,201);
    }
    public function getPharmacies()
    {
        $pharmacies = DB::table('users')
            ->where('role_id','=',3)
            ->get();  
            return response($pharmacies,201);
    }
    public function getLaboratories()
    {
        $laboratories = DB::table('users')
            ->where('role_id','=',4)
            ->get();  
            return response($laboratories,201);
    }

    public function Search(Request $request)
    {
        $doctors = DB::table('users')
        ->where('name','=',$request->name)
        ->where('role_id','=',$request->role_id)
        ->get(); 
        return response($doctors,201);
    }


}
