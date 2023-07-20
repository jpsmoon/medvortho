<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppointmentReason extends Model
{
    use HasFactory;
    protected $table =  'appointment_resaon';
    protected $fillable = [ 'name', 'description', 'is_active' ,'provider_id' ]; 
    
}
