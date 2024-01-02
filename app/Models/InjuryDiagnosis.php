<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InjuryDiagnosis extends Model
{
    use HasFactory;
    protected $table = 'injury_diagnoses';
    protected $fillable = [ 'injury_claim_id', 'diagnosis_code_id', 'is_active' ];

    public function injury_claim(){
        return $this->belongsTo(InjuryClaim::class, 'injury_claim_id', 'id');
    }
    public function getDianoses(){
        return $this->hasOne(Diagnosis_code::class, 'id', 'diagnosis_code_id');
    }
}
