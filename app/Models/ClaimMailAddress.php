<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClaimMailAddress extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [ 'claim_admin_id', 'address_line1' ];

    // public function claim_mail_submission(){
    //     return $this->belongsTo(ClaimMailBillSubmissionType::class, 'claim_mail_id', 'id');
    // }

}
