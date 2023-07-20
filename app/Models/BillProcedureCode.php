<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class BillProcedureCode extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [ 'bill_id', 'procedure_code_id', 'unit' ];
}
