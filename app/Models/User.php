<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;


class User extends Authenticatable
{
    use HasApiTokens,HasFactory, Notifiable;
    protected $table='users';
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public $timestamps=false;
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function appointment()
    {
        return $this->hasMany('App\Models\appointment','doctor_id');
    }    

    function getCheckUpDoctor()
    {
        return $this->hasMany('App\Models\clinic','doctor_id');
    }
    function getCheckUpPatient()
    {
        return $this->hasMany('App\Models\Clinic','patient_id');
    }
    public function patientLabReports(){
        return $this->hasMany('App\Models\Medicinec','patient_id');
    }

    


    public function getMessages()
    {
        $messages= array();
        $allmessages=$this->hasMany('App\Models\Message','reciver_id');
        $i=0;
        foreach ($allmessages as $message)
        {
            if($message->shown==false)
            {
                $messages[$i]=$messages;
                $i++;
            }
        }
        return $messages;
    }

    public function getFacility()
    {
        return $this->hasOne('App\Models\Facility','user_id');
    }
    
}
