<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClaimMailBillSubmissionType extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [ 'claim_mail_id', 'bill_submission_type_id' ];

    public function claim_mail_address(){
        return $this->belongsTo(ClaimMailAddress::class, 'claim_mail_id', 'id');
    }
    public function bill_submission_type(){
        return $this->belongsTo(BillSubmissionType::class, 'bill_submission_type_id', 'id');
    }
}
