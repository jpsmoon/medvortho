<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillSecondSbr extends Model
{
    use HasFactory;
    protected  $table = "bill_second_sbr";
    protected $fillable = [ 'bill_id',  'bill_service_procedure_code_id', 'review_id', 'review_text', 'service_good', 'attched_document','sbr_name', 'sbr_path','sbr_status', 'document_id', 'is_active' ];

    public function getBillingProviderSecondReview(){
        return $this->hasOne(WriteOffReason::class, 'id', 'review_id');
    }
}
