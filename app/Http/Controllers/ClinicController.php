<?php

namespace App\Http\Controllers;

use App\Models\clinic;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClinicController extends Controller
{

    //
    function getCheckUpInfoForDoctor()
    {
        $user= User::find(Auth::user()->id);
        return $user->getCheckUpDoctor;
    }
    function getCheckUpInfoForPatient()
    {
        $user= User::find(Auth::user()->id);
        return $user->getCheckUpPatient;
    }
    public function getCheckUpInfo(Request $request)
    {
        $users = DB::table('clinics')
                ->where('doctor_id','=',Auth::user()->id)
                ->where('patient_id','=',$request->patient_id)
                ->get();
                return $users;
    }
    public function addCheckup(Request $request)
    {
        $doctor=Auth::user();
        if ($request->type=="add")
        {
            $checkup= new clinic();
            $checkup->doctor_id=$doctor->id;
            $checkup->patient_id=$request->patient_id;
        }
        else{
            $checkup=clinic::find($request->checkup_id);
        }
        
        $checkup->information=$request->information;
        $checkup->date=$request->date;
        return $checkup;
    }
}
