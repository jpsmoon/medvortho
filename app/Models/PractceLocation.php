<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PractceLocation extends Model
{
    use HasFactory;
    protected $table="master_practice_location";
    protected $fillable = ['billing_provider_id','practice_nick_name','address1','address2','city_id','state_id','zip_code',
    'telephone_no','is_active'];
    public function state(){
        return $this->belongsTo(state::class, 'state_id', 'id');
    }
    public function city(){
        return $this->belongsTo(city::class, 'city_id', 'id');
    }
    //get billing
    public function getBillingProvider()
    {
        return $this->hasOne(BillingProvider::class, 'id', 'billing_provider_id')->where('is_active', 1);
    }
}
