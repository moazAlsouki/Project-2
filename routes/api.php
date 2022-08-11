<?php

use App\Http\Controllers\AppointmentController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClinicController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FacilityController;
use App\Http\Controllers\LabController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\RoleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    
//route::get("listRole",[RoleController::class,'getRoles']);
    return $request->user();
});



//Auth
route::post("login",[AuthController::class,'login']);  
route::post("register",[AuthController::class,'Register']);

route::group(['middleware'=>['auth:sanctum']],function () {

    //Auth-logout
    route::post("logout",[AuthController::class,'logout']);  

    //Appointment
    route::post("getAppointments",[AppointmentController::class,'getAppointments']); 
    route::post("saveAppointment",[AppointmentController::class,'saveAppointment']); 
    route::get("getdate",[AppointmentController::class,'getdate']); 


    //clinic
    route::get("getCheckUpInfoForDoctor",[ClinicController::class,'getCheckUpInfoForDoctor']);
    route::get("getCheckUpInfoForPatient",[ClinicController::class,'getCheckUpInfoForPatient']);
    route::post("getCheckUpInfo",[ClinicController::class,'getCheckUpInfo']); 
    route::post("addCheckup",[ClinicController::class,'addCheckup']); 
    
    //Facility
    route::post("addFacility",[FacilityController::class,'addFacility']);  
    route::post("removeFacility",[FacilityController::class,'removeFacility']);  
    route::get("getAllFacilities",[FacilityController::class,'getAllFacilities']);  
    route::get("getFacilityInfo",[FacilityController::class,'getFacilityInfo']);  
    
    //Laboratory
    route::get("getLabReports",[LabController::class,'getLabReports']); 
    route::post("addReport",[LabController::class,'addReport']); 
    route::post("getOneReport",[LabController::class,'getOneReport']); 
    route::post("getPatientReport",[LabController::class,'getPatientReport']); 
    
    
    //Medicine
    route::post("addMedicine",[MedicineController::class,'addMedicine']);  
    route::post("getOneMedicine",[MedicineController::class,'getOneMedicine']);  
    route::get("getMedicines",[MedicineController::class,'getMedicines']);  

   
     //Message
    route::get("GetMessage/{recid}",[MessageController::class,'GetMessage']);  
    route::post("sendMessage",[MessageController::class,'sendMessage']);  
    route::get("reciveMessage",[MessageController::class,'reciveMessage']);  
    route::get("getAllMessages",[MessageController::class,'getAllMessages']);  
    

    //Role
    route::get("listRole",[RoleController::class,'getRoles']);

    //User
    route::get("getAllUsers",[UserController::class,'getAllUsers']); 
    route::get("getPersonalInfo",[UserController::class,'getPersonalInfo']); 
    route::post("deleteUser",[UserController::class,'deleteUser']);  
    route::post("SearchWithFilter",[UserController::class,'SearchWithFilter']);  
    route::get("addUser",[UserController::class,'addUser']);

    route::get("getStaff",[UserController::class,'getStaff']);
    route::get("getDoctors",[UserController::class,'getDoctors']);
    route::get("getPharmacies",[UserController::class,'getPharmacies']);
    route::get("getLaboratories",[UserController::class,'getLaboratories']);

    route::post("search",[UserController::class,'Search']);
    
    
});
