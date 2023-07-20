<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingProviderRecurrence extends Model
{
    use HasFactory;
    protected $table =  'billing_provider_recurrence';
    protected $fillable = [ 'recurrence_date', 'provider_id', 'description', 'is_active' ]; 
}
