<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\BillPlaceService;
use App\Models\RenderinProvider;

class InjuryBill extends Model
{
    use HasFactory;

    public function getBillServices()
     {
         return $this->hasMany(InjuryBillService::class, 'bill_id', 'id');
     }
    public function getRenderinPlaceServices()
    {
        return $this->hasOne(BillPlaceService::class, 'id', 'bill_place_of_service');
    }
    public function getRenderinProvider()
    {
        return $this->hasOne(RenderinProvider::class, 'id', 'bill_rendering_provider');
    }
    
    public function getInjury()
    {
        return $this->hasOne(Patient_injury::class, 'id', 'injury_id');
    }
    public function getBillPlaceOfService(){
        return $this->hasOne(MasterPlaceOfService::class,  'id', 'bill_place_of_service'); 
    }
    public function getBillDocuments()
    {
        return $this->hasMany(AllDocument::class, 'injury_id', 'id');
    }
    public function getBillDiagnosis()
    {
        return $this->hasMany(BillDiagnosis::class, 'bill_id', 'id');
    }
    public function getBillHistory(){
        return $this->hasMany(MasterDataLog::class, 'data_id', 'id')->WhereIn('type', ['BILL_CREATED','BILL_ADD','BILL_DELETED']);
    }
    public function getBillRenderingOrderingProvider()
    {
        return $this->hasOne(BillReferingOrderProvider::class, 'id', 'bill_rendering_provider');
    }
    public function getPatientForBill()
    {
        return $this->hasOne(Patient::class, 'id', 'patient_id');
    }
    public function getStatus()
    {
        return $this->hasOne(Status::class, 'id', 'bill_status');
    }
}
