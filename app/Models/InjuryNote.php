<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\User;

class InjuryNote extends Model
{
    use HasFactory, SoftDeletes; 

    public function getUser(){
        return $this->hasOne(User::class,  'id', 'added_by');
    }
}
