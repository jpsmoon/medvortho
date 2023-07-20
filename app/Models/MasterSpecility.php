<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterSpecility extends Model
{
    use HasFactory;
    protected $table="master_specility";
    protected $fillable = ['master_specility','is_active'];
}
