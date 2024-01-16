<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillPaymentOther extends Model
{
    use HasFactory;
    public function getBillInfoForOtherPayment()
    {
        return $this->hasOne(InjuryBill::class, 'id', 'bill_id');
    }
    public function getPaymentInfo()
    {
        return $this->hasOne(BillPaymentInformation::class, 'id', 'bill_payment_id');
    }
}
