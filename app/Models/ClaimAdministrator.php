<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClaimAdministrator extends Model
{
    use HasFactory, SoftDeletes; 

    public function company_type(){
        return $this->belongsTo(Company_type::class, 'company_type_id', 'id');
    }
    
    public function claimAdminInjury(){
        return $this->hasMany(InjuryClaim::class, 'claim_admin_id', 'id');
    }
    public function getClaimReview(){
        return $this->hasMany(ClaimBillReview::class, 'claim_admin_id', 'id');
    }
    public function getClaimAuthContact(){
        return $this->hasMany(ClaimAuthContact::class, 'claim_admin_id', 'id');
    }
    public function getMailAddress(){
        return $this->hasMany(ClaimMailAddress::class, 'claim_admin_id', 'id');
    }
    public function getCompanyType(){
        return $this->belongsTo(Company_type::class, 'company_type_id', 'id');
    }
}
