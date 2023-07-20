<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BillTreatmentType extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [ 'bill_treatment_type' ];
}
