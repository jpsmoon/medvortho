<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PatientInjuryBillog extends Model
{
    use HasFactory;
    protected  $table = "patient_injury_bills_log";

    public function getUser(){
        return $this->hasOne(User::class,  'id', 'created_by');
    }
}
