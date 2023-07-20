<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlaceOfServiceCode extends Model
{
    use HasFactory;
    protected $table="bill_place_service_codes";
    protected $fillable = ['name','service_code'];

}
