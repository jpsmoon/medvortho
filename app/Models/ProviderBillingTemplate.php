<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProviderBillingTemplate extends Model
{
    use HasFactory;
    protected $table = "provider_billing_template";
    protected $fillable = ['id','provider_id','template_name','description','is_active','created_by'];

    public function getTemplateServiceItems()
     {
         return $this->hasMany(ProviderBillingTemplateServiceItem::class,  'template_id', 'id');
     }
    public function getBillCount()
    {
        return $this->hasMany(InjuryBill::class,  'template_id', 'id');
    }
}
