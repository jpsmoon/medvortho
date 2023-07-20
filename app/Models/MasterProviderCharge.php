<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterProviderCharge extends Model
{
    use HasFactory;
    protected  $table = "provider_charge";
    protected $fillable = [ 'provider_id',  'type', 'state_id','physician_services','pathology_charge','med_legal','dmepos','dispensed_pharmaceuticals','copy_service','status'];
    
    public function getProviders(){
        return $this->belongsTo(BillingProvider::class, 'id', 'provider_id')->where('is_active', 1);
    }
}
