<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MedicalProvider extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [ 'applicant_name', 'mpn_id', 'applicant_type' ];
}
