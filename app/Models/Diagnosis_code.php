<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Diagnosis_code extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [ 'diagnosis_name', 'diagnosis_code' ];
}
