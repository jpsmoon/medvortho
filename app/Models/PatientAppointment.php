<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Patient;

class PatientAppointment extends Model
{
    use HasFactory;

    public function getPatient()
    {
        return $this->hasOne(Patient::class, 'id', 'patient_id');
    }
    public function getStatus()
    {
        return $this->hasOne(Status::class, 'id', 'status');
    }
    public function getBillingProvider()
    {
        return $this->hasOne(BillingProvider::class, 'id', 'billing_provider_id');
    }
    public function getRenderingProvider()
    {
        return $this->hasOne(BillReferingOrderProvider::class, 'id', 'rendering_provider_id');
    }
    public function getLocation()
    {
        return $this->hasOne(MasterPlaceOfService::class, 'id', 'location');
    }
    public function getResaons()
    {
        return $this->hasOne(AppointmentReason::class, 'id', 'appointment_reason');
    }
    public static function boot()
    {
        parent::boot();
         self::created(function($model){
            $appointNumber='PA'.$model->id.date('y').date('m').date('d');
            $model->appointment_no = $appointNumber;
            $model->update();
        });
    }

}
