<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Facility;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FacilityController extends Controller
{
    //
    function getAllFacilities()
    {
        return Facility::all();
    }

    public function addFacility(Request $request){
       
        $user=Auth::user();
        if ($request->type=='add'){
            $facility=new Facility();
            $facility->user_id=$user->id;
            $facility->role_id=$user->role_id;
        }
        else{
            $facility=$user->getFacility;
        }
        $facility->name=$request->name;
        $facility->open_hour=$request->open_hour;
        $facility->close_hour=$request->close_hour;
        $facility->address=$request->address;
        $facility->phone=$request->phone;
        return $facility;
    }
    
    public function removeFacility(Request $request)
    {
        $user=Auth::user();
        if ($user->role_id == 6)
        {
            $facility = Facility::find($request->id);
        }
       else{
            $facility=$user->getFacility;
        }
        $facility->delete;
        return $facility;
    } 

    public function getFacilityInfo()
    {
        return Auth::user()->getFacility;
    }   
}
