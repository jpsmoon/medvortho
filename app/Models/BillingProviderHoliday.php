<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingProviderHoliday extends Model
{
    use HasFactory;
    protected $table = 'billing_provider_holidays';
    protected $fillable = ['holiday_date' , 'holiday_id' , 'billing_provider_id', 'location_id', 'created_by', 'updated_by', 'is_active', 'holiday_start_time', 'holiday_end_time'];

    public function getHoliday(){
        return $this->hasOne(MasterHoliday::class, 'id', 'holiday_id');
    }
    public function getLocation(){
        return $this->hasOne(MasterPlaceOfService::class, 'id', 'holiday_id');
    }
}
