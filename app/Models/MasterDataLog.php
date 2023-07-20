<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterDataLog extends Model
{
    use HasFactory;
    protected  $table = "master_data_log";
    protected $fillable = ['id','type','created_by','description','data_id','model_name'];
    
    public function getUser(){
        return $this->hasOne(User::class,  'id', 'created_by');
    }
}
