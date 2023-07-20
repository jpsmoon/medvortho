<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TaskAssign extends Model
{
    use HasFactory;
    protected $fillable = [ 'job_no', 'user_id', 'task_id', 'step_id', 'task_step_id', 'status_id'];
}
