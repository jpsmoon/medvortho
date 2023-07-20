<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\ClaimAdministrator;
use App\Models\ClaimStatus;
use App\Models\InjuryDiagnosis;
use App\Models\MedicalProvider;
use App\Models\State;

class InjuryClaim extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [ 'injury_id','employer_name','is_cumulative','start_date','end_date','claim_admin_id','no_any_claim','payer_id',
    'claim_no','claim_status_id','claim_status_id','medical_provider_id','medical_provider_id','adj_no','emp_address_line1','emp_address_line2',
    'emp_address_line2','emp_state_id','emp_zipcode','emp_zipcode','ins_subscriber','ins_subscriber','ins_deduct_amt','ins_deduct_amt',
    'ins_coins_amt','ins_authinfo','ins_no_of_visit','ins_no_of_visit','p_payer_name','p_law_officer_name','p_injury_date','p_injury_date','p_ssn_no',
'p_handle_attorn_individual','p_contact_no','p_others','p_others','p_others','p_others','p_state_id','p_state_id','is_active','is_employer_address_optional','practice_internal_id' ];

    public function patient_injury(){
        return $this->belongsTo(Patient_injury::class, 'injury_id', 'id');
    }
    public function getClaimAdmin(){
        return $this->hasOne(ClaimAdministrator::class, 'id', 'claim_admin_id');
    }
    public function getClaimStatus(){
        return $this->hasOne(ClaimStatus::class, 'id', 'claim_status_id');
    }
    public function getMedicalProvider(){
        return $this->hasOne(MedicalProvider::class, 'id', 'medical_provider_id');
    }
    public function getState(){
        return $this->hasOne(State::class, 'id', 'emp_state_id');
    }
    public function getInjuryDianoses(){
        return $this->hasMany(InjuryDiagnosis::class,  'injury_claim_id', 'id');
    }
}
