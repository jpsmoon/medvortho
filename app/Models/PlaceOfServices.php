<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlaceOfServices extends Model
{
    use HasFactory;
    protected $table="billing_place_of_services";
    protected $fillable = ['billing_provider_id','npi','location_name','nick_name','city_id','state_id','zipcode','service_code_id'];

    public function state(){
        return $this->belongsTo(state::class, 'state_id', 'id');
    }
    public function placeOfServiceCode(){
        return $this->belongsTo(MasterPlaceOfService::class,'id', 'billing_provider_id'');
    }
}
