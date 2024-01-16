<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AllDocument extends Model
{
    use HasFactory, SoftDeletes; 
    
    protected $fillable = [ 'injury_id','reporting_type','description','injury_document','is_active','provider_id','added_by','doc_type','is_new_document', 'is_sbr_document', 'bill_service_procedure_id' ];

    public function getReportType(){
        return $this->hasOne(ReportType::class,  'id','reporting_type',);
    }
    public function getDianoses(){
        return $this->hasOne(Diagnosis_code::class, 'id', 'diagnosis_code_id');
    }
    public function getUser(){
        return $this->hasOne(User::class,  'id', 'added_by');
    }
}
