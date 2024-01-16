<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClaimBillReview extends Model
{
    use HasFactory;
    protected $fillable = [ 'claim_admin_id', 'name' ];
    
}
