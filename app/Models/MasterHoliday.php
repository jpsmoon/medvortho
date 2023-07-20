<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterHoliday extends Model
{
    use HasFactory;
    protected $table = "master_holidays"; 
    protected $fillable = ['holiday_date' , 'holiday_name' , 'holiday_month', 'holiday_year', 'created_by', 'description', 'updated_by', 'holiday_type','is_active'];
}
