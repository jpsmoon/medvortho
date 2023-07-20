<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserTask extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [ 'user_id', 'task_id' ];

    public function user(){
        return $this->belongsTo(user::class, 'user_id', 'id');
    }
    public function task(){
        return $this->belongsTo(task::class, 'task_id', 'id');
    }

}
