<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserBillingProvider extends Model
{
    use HasFactory;
    protected $table = "user_billing_providers";
    protected $fillable = ['id','provider_id','user_id','created_by', 'is_active'];

    public function getBillingProvider()
     {
         return $this->hasOne(BillingProvider::class,  'id', 'provider_id')->where('is_active', 1);
     }
    public function getProvidersPatient(){
        return $this->hasMany(Patient::class, 'billing_provider_id', 'provider_id');
    }
}
