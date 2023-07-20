<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RenderinProvider extends Model
{
    use HasFactory;
    protected $table="bill_rendering_providers";
    protected $fillable = ['id', 'name', 'status','billing_provider_id'];
}
