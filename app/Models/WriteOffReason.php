<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WriteOffReason extends Model
{
    use HasFactory;
    protected  $table = "provider_bill_write_off_reasopns";
    protected $fillable = [ 'description',  'reason_text', 'provider_id', 'for_all_providers' ];
}
