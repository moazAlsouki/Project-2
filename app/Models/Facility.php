<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Facility extends Model
{
    use HasFactory;
    public function medicines()
    {
        return $this->hasMany('App\Models\Medicinec','pharmacy_id');
    }
    public function allLabReports(){
        return $this->hasMany('App\Models\Medicinec','lab_id');
    }
    
}
