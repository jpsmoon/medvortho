<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{
    state,PlaceOfServiceCode
};

class MasterPlaceOfService extends Model
{
    use HasFactory;
    protected $table="master_place_of_services";
    protected $fillable = ['billing_provider_id','npi','location_name','nick_name','city_id','state_id','zipcode','service_code_id'];

    public function state(){
        return $this->belongsTo(state::class, 'state_id', 'id');
    }
    public function placeOfServiceCode(){
        return $this->belongsTo(PlaceOfServiceCode::class, 'service_code_id', 'id');
    }
}
