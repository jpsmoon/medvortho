<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MasterBillChargeSheet extends Model
{
    use HasFactory;
    protected $table = 'master_bill_charges_sheet'; 
    protected $fillable = ['procedure_code','base_charge','procedure_description','calculation_amount','procedure_year_2014','procedure_year_2015','procedure_year_2016','procedure_year_2017','procedure_year_2018','procedure_year_2019','procedure_year_2020','procedure_year_2021','procedure_year_2022','status'];
}
