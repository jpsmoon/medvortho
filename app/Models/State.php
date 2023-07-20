<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class State extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [ 'country_id ', 'state_name' ];
    public function country(){
        return $this->belongsTo(country::class, 'country_id', 'id');
    }
    
}
