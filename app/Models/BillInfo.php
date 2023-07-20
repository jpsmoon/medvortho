<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BillInfo extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [ 'injury_id', 'service_code_id', 'health_provider_id', 'start_dos', 'diagnosis_code_type' ];
}
