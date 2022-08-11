<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DoctorController extends Controller
{
    //
   
/*
    getmypatients
    getonepatient
    addnewpatient

public function getmyCheckUpDoctor()
{
    $user =Auth::user();
    $checkup=$user->getCheckUpDoctor;
    return $checkup;
}

public function getmyCheckUpPatients()
{
    $user =Auth::user();
    $checkup=$user->getCheckUpPatient;
    return $checkup;
}
*/



 /*
    function getAllPatient()
    {
        $allpatient =User::where('role_id','1')->get();
       return view('ViewAllPatient',['Plist'=>$allpatient]);
    }
    function getPatient(Request $PId)
    {
        $patient = User::find($PId->id);
        if ($patient->role_id=='1')
        return view('ViewAllPatient',['Plist'=>$patient]);
        else return "404";
    }
    
    public function addP(Request $req)
    {
        $user =new User();
        $user->name=$req->name;
        $user->email=$req->email;
        $user->mobile=$req->mobile;
        $user->address=$req->address;
        $user->city=$req->city;
        $user->gender=$req->gender;
        $user->role_id=1;
        $user->password=Hash::make('0000');
        $user->save();
    
    }*/
}
