<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SentBill extends Model
{
    use HasFactory;
    protected $table = 'sent_bill_information';
    protected $fillable = ['bil_id' , 'sent_by' , 'sent_date', 'sent_type', 'fax_type', 'fax_number', 'fax_attention', 'pdf_claim_admin_id', 'pdf_path', 'status_id', 'bill_type'];


    public function getBillInfo()
    {
        return $this->hasOne(InjuryBill::class, 'id', 'bil_id');
    }
}
