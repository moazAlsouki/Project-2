<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Database\Console\DbCommand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AppointmentController extends Controller
{
    //
    public function getAppointments(Request $request)
    {
        $user=Auth::user();
        $patients = DB::table('appointments')
        ->where('doctor_id','=',$user->id)
        ->where('date','=',$request->date)
        ->get();
        return $patients;
    }

    public function saveAppointment(Request $request)
    {
        $appointment= new Appointment();
        
        $user=Db::table('users')
        ->where('email','=',$request->doctor_email)->get()->first();
        $doctor=User::find($user->id);
        $facility = $doctor->getFacility;
        
        if($doctor->role_id=='2'){
            $appoint=DB::table('appointments')
                    ->where('date','=',$request->date)
                    ->get()->last();
        if(!$appoint){
                $appointment->doctor_id= $user->id;
                $appointment->patient_id=Auth::user()->id;
                $appointment->Period=1;
                $appointment->date=$request->date;
                $appointment->save();
                return response( $appointment,201);
                }
        else if ($appoint->Period<$facility->close_hour-$facility->open_hour)
        {
            $appointment->doctor_id= $user->id;
            $appointment->patient_id=Auth::user()->id;
            $appointment->Period=$appoint->Period+1;
            $appointment->date=$request->date;
            $appointment->save();
            return response( $appointment,201);
        } 
     
            else {
                return response([
                    'message'=>'unAvailable period in this date'
                ],400);    
            }
        }
        else {
            return response([
                'message'=>'the id send not for doctor'
            ],400);

    }
    }
    public function addAppointment(Request $request)
    {
        $user=Auth::user();
        $doctor = DB::table('users')
                ->where('id','=',$request->doctor_id)
                ->where('role_id','=',2)
                ->get()
                ->first(); 
        $request->patient_id=$user->id;
        $period=$doctor->appointment->last();
        $date=$period->date;
        
    }
    public function getdate()
    {
        $appoint=DB::table('appointments')
        ->where('patient_id','=',Auth::user()->id)
        ->get();
        if($appoint)
        {
            return response($appoint,201);
        }
        else 
            return response([
            'message'=>'no period'
        ],201);
    }
}
