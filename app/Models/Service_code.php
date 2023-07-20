<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service_code extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [ 'code', 'place_of_service_name', 'npi' ];

    public function country(){
        return $this->belongsTo(country::class, 'country_id', 'id');
    }
    public function state(){
        return $this->belongsTo(state::class, 'state_id', 'id');
    }
    public function city(){
        return $this->belongsTo(city::class, 'city_id', 'id');
    }
       
}
