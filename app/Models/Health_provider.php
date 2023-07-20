<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Health_provider extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [ 'npi', 'entity_type', 'taxonomy_code_id', 'provider_type' ];

    public function taxonomy_code(){
        return $this->belongsTo(taxonomy_code::class, 'taxonomy_code_id', 'id');
    }
}
