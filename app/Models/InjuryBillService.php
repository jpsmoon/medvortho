<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InjuryBillService extends Model
{
    use HasFactory;
    protected $table = "injury_bill_services";
    protected $fillable = [ 'bill_id','bill_procedure_code','bill_modifiers','bill_units','bill_diag_codes1','bill_diag_codes2','bill_diag_codes3','bill_diag_code4','master_unit_amount','master_procedure_code_charge_id','total_bill_amount','additional_information','is_master_found' ];

    public function getBillInfo(){
        return $this->hasOne(InjuryBill::class, 'id', 'bill_id');
    }
    public function getModifierInfo(){
        return $this->hasOne(BillModifier::class, 'id', 'bill_modifiers');
    }

}
