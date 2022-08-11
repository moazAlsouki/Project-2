<?php

namespace App\Http\Controllers;

use App\Models\Lab;
use App\Models\Req;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LabController extends Controller
{
    //
    public function getLabReports()
    {
        $user =Auth::user();
        $facility=$user->getfacility;
        return $facility->allLabReports();
    }

    public function addReport(Request $request)
    {
        $user =Auth::user();
        $facility=$user->getfacility;
        if ($request->type='add')
        {
            $analysis= new Lab();
            $analysis->lab_id=$facility->id;
            $analysis->patient_id=$request->patient_id;
        }
        else 
        {
            $analysis= Lab::find($request->analysis_id);
        }
        $analysis->information=$analysis->information;
        $analysis->date=$analysis->date;
        $analysis->save();
        return $analysis;
    }
    public function getOneReport(Request $request)
    {
        $analysis = Lab::find($request->id);
        return $analysis;
    }
    public function getPatientReport(Request $request)
    {
        $user=Auth::user();
        $facility=$user->getFacility;
        $analysis=DB::table('labs')
        ->where('lab_id','=',$facility->id)
        ->where('patient_id','=',$request->patient_id)
        ->get();
        return $analysis;
    }
}

