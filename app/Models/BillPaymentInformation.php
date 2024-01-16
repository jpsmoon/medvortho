<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillPaymentInformation extends Model
{
    use HasFactory;

    
    public function getBillPaymentOtherInfo()
    {
        return $this->hasOne(BillPaymentOther::class, 'bill_payment_id', 'id');
    }
    public function getBillInfo()
    {
        return $this->hasOne(InjuryBill::class, 'id', 'bill_id');
    }
    public function getBillPaymentOthers()
    {
        return $this->hasMany(BillPaymentOther::class, 'bill_payment_id', 'id');
    }
    public function getBillPaymentMultipleClaimNumberInfo()
    {
        return $this->hasOne(BillPaymentMultipleClaimNumber::class, 'bill_payment_id', 'id');
    }
}
