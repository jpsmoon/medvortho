<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BillDiagnosis extends Model
{
    use HasFactory;
    protected $table = "bill_diagnoses";
    protected $fillable = [ 'bill_id','diagnose_code_id','is_active' ];
    public function getBillDiagnosisName()
    {
        return $this->hasOne(Diagnosis_code::class, 'id', 'diagnose_code_id');
    }
}
