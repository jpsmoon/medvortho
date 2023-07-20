<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BillInfoProvider extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [ 'bill_id', 'bill_provider_type', 'provider_name' ];
}
