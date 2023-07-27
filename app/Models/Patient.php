<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\MasterDataLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\SoftDeletes;


class Patient extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['id', 'billing_provider_id', 'first_name', 'dob', 'ssn_no', 'gender', 'address_line1', 'city_id', 'state_id','full_name' ];

    //define referning provider arrays for add bill
    protected $referingOrderProviders = array( array('id' => 1, 'name' => 'Referring'), array('id' => 2, 'name' => 'Supervising'),  array('id' => 3, 'name' => 'Ordering'));
    //define referning provider arrays for add bill

     //define location for appointment
     protected $appointmentReason = array( 
        array('id' => 1, 'name' => '1 ST DEMAND'), 
        array('id' => 2, 'name' => '2ND DEMAND'),  
        array('id' => 3, 'name' => 'DEPOSITION DR. SHAH'),
        array('id' => 4, 'name' => 'DOR FILED'),
        array('id' => 5, 'name' => 'DR. SHAH OFF'),
        array('id' => 6, 'name' => 'FILE DOR'),
        array('id' => 7, 'name' => 'FILE LIEN'),
        array('id' => 8, 'name' => 'FILE ON CALENDAR'),
        array('id' => 9, 'name' => 'FOLLOW UP'),
        array('id' => 10, 'name' => 'FOLLOW UP PHONE CALL'),
        array('id' => 11, 'name' => 'FOLLOW-UP (CHINESE, VIETNAMESE)'),
        array('id' => 12, 'name' => 'FOLLOW UP PHONE CALL'),
        array('id' => 13, 'name' => 'FOLLOW-UP SPANISH (LONG BEACH)'),
        array('id' => 14, 'name' => 'FOLLOW-UP(SPANISH)'),
        array('id' => 15, 'name' => 'INJECTION'),
        array('id' => 16, 'name' => 'INJECTION/NEW PATIENT'),
        array('id' => 17, 'name' => 'LASER/COSMETIC'),
        array('id' => 18, 'name' => 'LIEN FILED'),
        array('id' => 19, 'name' => 'MISSING APPOINTMENT REASON'),
        array('id' => 20, 'name' => 'NEW PATIENT'),
        array('id' => 21, 'name' => 'NOTES'),
        array('id' => 22, 'name' => 'REBILLING'),
        array('id' => 23, 'name' => 'SETTLED'),
        array('id' => 24, 'name' => 'SIRENA'),
        array('id' => 25, 'name' => 'TRIPLICATE'),
        array('id' => 26, 'name' => 'WCAB'),
    );
     //define location for appointment

     //define Meeting Type for appointment
     protected $meetingType = array( 
        array('id' => 1, 'name' => 'In Office'),
        array('id' => 2, 'name' => 'Telemedicine'),
     );
     //define Meeting Type for appointment
     public function getMeetingType()
     {
         return $this->meetingType;
     }
     
     //Define Bill Status Type for Appointment list
     protected $billStatus = array( 
        array('id' => 1, 'name' => 'Ready to bill'),
        array('id' => 2, 'name' => 'Billed'),
     );
     
     //Define Bill Status Type for Appointment list
     public function getBillStatus()
     {
         return $this->billStatus;
     }
     
     
    public function getAppointmentReason()
    {
        return $this->appointmentReason;
    }
    public function getReferingOrderProviders()
    {
        return $this->referingOrderProviders;
    }

    public function state(){
        return $this->belongsTo(state::class, 'state_id', 'id');
    }
    public function city(){
        return $this->belongsTo(city::class, 'city_id', 'id');
    }
     //get billing
     public function getBillingProvider()
     {
         return $this->hasOne(BillingProvider::class, 'id', 'billing_provider_id')->where('is_active', 1);
     }
     //get Referring
     public function getReferringProvider()
     {
         return $this->hasOne(BillingProvider::class, 'id', 'billing_provider_id')->where('is_active', 1);
     }
     //injury_claims
     public function getInjuries()
     {
         return $this->hasMany(Patient_injury::class, 'patient_id', 'id');
     }
     public function getPatientInjuries()
     {
         return $this->hasOne(Patient_injury::class, 'patient_id', 'id');
     }

     public static function boot()
    {
        
        parent::boot();
        // function called when object is creating
        // self::creating(function ($model) {
        //     $patientNumber='P0000'.$model->id.date('Y').date('m').date('d');
        //     $model->patient_no = $patientNumber;
        //     $model->update();
        //     if($model){
        //         //$this->addGlobalAllLog('PATIENT_ADD','App\Patient','Created Patient', $model->id);
        //         $history = new MasterDataLog();
        //         $history->type = 'PATIENT_ADD';
        //         $history->created_by = Auth::user()->id;
        //         $history->data_id = $model->id;
        //         $history->model_name = 'App\Patient';
        //         $history->description = 'Created Patient';
        //         $history->save();

        //     }
        // });
        self::created(function($model){
            $patientNumber='P'.$model->id.date('y').date('m').date('d');
            $model->patient_no = $patientNumber;
            $model->update();
            if($model){
                //$this->addGlobalAllLog('PATIENT_ADD','App\Patient','Created Patient', $model->id);
                $history = new MasterDataLog();
                $history->type = 'PATIENT_ADD';
                $history->created_by = Auth::user()->id;
                $history->data_id = $model->id;
                $history->model_name = 'App\Patient';
                $history->description = 'Created Patient';
                $history->save();

            }
        });
        self::updating(function ($model) {
            //dd('test for update');
           // $this->addGlobalAllLog('PATIENT_UPDATE','App\Patient','Updated Patient', $model->id);
           $history = new MasterDataLog();
                $history->type = 'PATIENT_UPDATE';
                $history->created_by = Auth::user()->id;
                $history->data_id = $model->id;
                $history->model_name = 'App\Patient';
                $history->description = 'Updated Patient';
                $history->save();
        });
       
    }
    //appointements
    public function getAppointments()
     {
         return $this->hasMany(PatientAppointment::class, 'patient_id', 'id');
     }
     //
     
     public function getPatientHistory(){
        return $this->hasMany(MasterDataLog::class, 'data_id', 'id')->WhereIn('type', ['PATIENT_UPDATE','PATIENT_ADD','PATIENT_DELETED']);
    }
}
