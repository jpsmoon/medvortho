<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class InjuryContact extends Model
{
    use HasFactory, SoftDeletes; 
    public $contactRoles = [
        array('id' =>1, 'name' => 'Adjustor'),
        array('id' =>2, 'name' => 'Claims Administrator'),
        array('id' =>3, 'name' => 'Bill Review'),
        array('id' =>4, 'name' => 'Applicant Attorney'),
        array('id' =>5, 'name' => 'Defense Attorney'),
        array('id' =>6, 'name' => 'RN Case Manager'),
        array('id' =>7, 'name' => 'PTP'),
        array('id' =>8, 'name' => 'Other')
    ];
    protected $fillable = ['injury_id','contact_role_id','contact_role_id','first_name','last_name','company','email','phone_number',
'fax_number','address_line1','address_line2','zip_code','city','state','created_by'];


}
