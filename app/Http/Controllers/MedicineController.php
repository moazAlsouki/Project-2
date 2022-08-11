<?php

namespace App\Http\Controllers;

use App\Models\Facility;
use App\Models\Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MedicineController extends Controller
{
    //

    public function addMedicine(Request $request)
    {
        $user=Auth::user();
        $facility=$user->getFacility;
        if ($request->type =='update'){
            $medicine=Medicine::find($request->id);
        }
        else{
            $medicine = new Medicine();
        }
        $medicine->pharmacy_id=$facility->id;
        $medicine->name=$request->name;
        $medicine->quantity=$request->quantity;
        $medicine->save();
        return $medicine;
    }
    public function getMedicines()
    {
        $user=Auth::user();
        $facility=$user->getFacility;
        $medicines = $facility->medicines();

        $emptymed=DB::table('medicines')
        ->where('pharmacy_id','=',$facility->id)
        ->where('quantity','=',0)
        ->get();

        return [
            'allMedicines' => $medicines,
            'emptyMedicines' => $emptymed
        ];
    }

    public function getOneMedicine(Request $request)
    {
        $medicine = Medicine::find($request->id);
            return $medicine;
    }
}
