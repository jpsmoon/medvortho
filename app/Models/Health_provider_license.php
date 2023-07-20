<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Health_provider_license extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [ 'health_provider_id', 'licenseno', 'state_id' ];

    public function health_provider(){
        return $this->belongsTo(health_provider::class, 'health_provider_id', 'id');
    }
    public function state(){
        return $this->belongsTo(state::class, 'state_id', 'id');
    }
}
