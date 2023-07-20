<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PracticeContact extends Model
{
    use HasFactory;
    protected $table="practic_contact";
    protected $fillable = ['billing_provider_id','first_name','middle_name','last_name','suffix_name','telephone','email','is_active'];
    
    public function getBillingProvider()
    {
        return $this->hasOne(BillingProvider::class, 'id', 'billing_provider_id')->where('is_active', 1);
    }
    
}
