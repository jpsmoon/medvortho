<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class City extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [ 'state_id', 'city_name'  ];
    public function state(){
        return $this->belongsTo(state::class, 'state_id', 'id');
    }
}
