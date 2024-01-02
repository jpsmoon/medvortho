<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class BillingProviderChargeProcedureCode extends Model
{
    use HasFactory;
    protected $table = 'billing_provider_charge_procedure_code'; 
    protected $fillable = ['billing_provider_charge_id', 'procedure_code','modifiers','units','status','ndc_number', 'description' ,'omfs_unit' ,'ndc_number'];

    public function getChargeModifyer(){
        return $this->hasOne(BillModifier::class, 'id', 'modifiers');
    }
    
}
