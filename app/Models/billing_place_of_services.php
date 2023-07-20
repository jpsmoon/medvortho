<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class billing_place_of_services extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [ '' ];
}
