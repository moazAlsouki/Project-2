<?php

use App\Http\Controllers\DoctorController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
route::get("ViewAllPatient",[DoctorController::class,'getAllPatient']);

Route::get('/', function () {
    return view('welcome');
});



route::get("patient/{Pid}",[DoctorController::class,'getPatient']);

route::view("search","searchParient");
route::post("search",[DoctorController::class,'getPatient']);

route::get("Viewpa",[DoctorController::class,'getpa']);

route::view("addpatient","addPatient");
route::post("addpatient",[DoctorController::class,'addP']);