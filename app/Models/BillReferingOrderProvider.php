<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\{City,State, BillingProvider, Taxonomy_code};

class BillReferingOrderProvider extends Model
{
    use HasFactory;
    public $table = "bill_refering_ordering";

    public function state(){
        return $this->belongsTo(state::class, 'state_id', 'id');
    }

    public function taxonomyCode(){
        return $this->hasOne(Taxonomy_code::class, 'id', 'taxonomy_code');
    }



}
