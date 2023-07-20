<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClaimAdministrator extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [ 'name', 'company_type_id' ];

    public function company_type(){
        return $this->belongsTo(company_type::class, 'company_type_id', 'id');
    }
    public function claimReview(){
        return $this->hasOne(ClaimBillReview::class, 'claim_admin_id', 'id');
    }
    public function claimAdminInjury(){
        return $this->hasMany(InjuryClaim::class, 'claim_admin_id', 'id');
    }
}
