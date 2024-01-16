<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class BillingProvider extends Model
{
    use HasFactory, SoftDeletes;
    
    protected $fillable = [ 'injury_state_id', 'bill_type', 'provider_type', 'tax_id', 'npi', 'name', 'contact_no',
    'address_line1', 'city_id', 'state_id', 'zipcode',
    'provider_type',
    'professional_provider_name',
    'professional_nick_name',
    'professional_telephone',
    'professional_addres1',
    'professional_addres2',
    'professional_city',
    'professional_state',
    'professional_zip',
    'professional_npi',
    'professional_address1',
    'professional_state1',
    'professional_zipcode1',
    'professional_file',
    'professional_user_with_access',
    'professional_fax_number',
    'pharmacy_tax_id',
    'pharmacy_npi',
    'institution_taxonomy',
    'institution_county_name',
    'institution_facility_type',
    'pharmacy_billing_file','professional_user_with_access','professional_fax_number'
];

    public function state(){
        return $this->belongsTo(state::class, 'injury_state_id', 'id');
    }
    
    public function getPlaceOfService(){
        return $this->hasMany(MasterPlaceOfService::class, 'billing_provider_id', 'id');
    }
    public function getProviderCharges(){
        return $this->hasOne(MasterProviderCharge::class, 'provider_id', 'id');
    }
    public function getCharges(){
        return $this->hasMany(BillingProviderCharge::class, 'provider_id', 'id');
    }
    
    public function getPatientsByProviderId(){
        return $this->hasMany(Patient::class, 'billing_provider_id', 'id');
    }
    public function getProviderReasons(){
        return $this->hasMany(AppointmentReason::class, 'provider_id', 'id');
    }
    
    //define Reasons for billing provider
     protected $providerReasons = array( 
        array('id' => 1, 'name' => 'PTP New Patient'),
        array('id' => 2, 'name' => 'PTP New Patient'),
        array('id' => 3, 'name' => 'PTP New Patient'),
        array('id' => 4, 'name' => 'PTP Follow up (Interpreter Required)'),
        array('id' => 5, 'name' => 'Second Treat New Patient'),
        array('id' => 6, 'name' => 'Second Treat Follow up'),
        array('id' => 7, 'name' => 'Chiropractic'),
        array('id' => 8, 'name' => 'Acupuncture'),
        array('id' => 9, 'name' => 'QME Appointment'),
        array('id' => 10, 'name' => 'PQME Appointment'),
     );
     
     public function getProviderResaons()
     {
         return $this->providerReasons;
     }
     public function getProviderSecondReviewReasons(){
        return $this->hasMany(WriteOffReason::class, 'provider_id', 'id')->where('type', 2)->orWhere('for_all_providers', 1);
    }
    public function getProviderWriteOfReasons(){
        return $this->hasMany(WriteOffReason::class, 'provider_id', 'id')->where('type', 1)->orWhere('for_all_providers', 1);
    }
}
