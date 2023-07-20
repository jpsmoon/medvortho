<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProviderBillingTemplateServiceItem extends Model
{
    use HasFactory;
    protected $table = "provider_billing_template_service_line_items";
    protected $fillable = ['id','provider_id','template_id','procedure_code','modifiers_id','units'];
}
