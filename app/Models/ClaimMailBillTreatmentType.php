<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClaimMailBillTreatmentType extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [ 'claim_mail_id', 'bill_treatment_type_id' ];

    public function claim_mail_address(){
        return $this->belongsTo(ClaimMailAddress::class, 'claim_mail_id', 'id');
    }
    public function bill_treatment_type(){
        return $this->belongsTo(BillTreatmentType::class, 'bill_treatment_type_id', 'id');
    }
}
