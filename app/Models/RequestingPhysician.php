<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{state, MasterSpecility};


class RequestingPhysician extends Model
{
    use HasFactory;
    protected $table="requesting_physician";
    protected $fillable = ['billing_provider_id','npi','first_name','middle_name','last_name','suffix_name','specility_id',
    'physican_signature','physican_signature_canvas','telephone'];
    
    public function state(){
        return $this->belongsTo(state::class, 'state_id', 'id');
    }

    public function getSpecility(){
        return $this->belongsTo(MasterSpecility::class, 'specility_id', 'id');
    }
}
