<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZipCityState extends Model
{
    public $table = "zipcodes";

    use HasFactory;
}
