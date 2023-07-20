<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillPlaceService extends Model
{
    use HasFactory;
    protected $table="billing_place_of_services";
    protected $fillable = ['billing_provider_id', 'service_code_id','npi','location_name','nick_name','address_line1','address_line2','city_id','state_id','zipcode'];

    public function state(){
        return $this->belongsTo(state::class, 'state_id', 'id');
    }

}
