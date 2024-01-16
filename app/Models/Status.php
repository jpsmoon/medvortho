<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Status extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [ 'status_name', 'display_order','status_type', 'slug_name' ];

    //define Aliase for status
    protected $aliaseNames = array( 
        array('id' => 1, 'name' => 'PATIENT_INCOMPLETE', 'type'=> 1),
        array('id' => 2, 'name' => 'PATIENT_COMPLETE', 'type'=> 1),
        array('id' => 3, 'name' => 'PATIENT_ACTIVE', 'type'=> 1),
        array('id' => 4, 'name' => 'PATIENT_INACTIVE', 'type'=> 1),
        //Patient end
        array('id' => 5, 'name' => 'INJURY_INCOMPLETE', 'type'=> 2),
        array('id' => 6, 'name' => 'INJURY_COMPLETE', 'type'=> 2),
        array('id' => 7, 'name' => 'INJURY_ACTIVE', 'type'=> 2),
        array('id' => 8, 'name' => 'INJURY_INACTIVE', 'type'=> 2),
        //Injury end
        array('id' => 9, 'name' => 'INCOMPLETE_BILL', 'type'=> 3),
        array('id' => 10, 'name' => 'PROCESS_BILL', 'type'=> 3),
        array('id' => 11, 'name' => 'SENT_BILL', 'type'=> 3),
        array('id' => 12, 'name' => 'FAILED_BILL', 'type'=> 3),
        array('id' => 13, 'name' => 'COMPLETE_BILL', 'type'=> 3),
        array('id' => 31, 'name' => 'REJECTED_BILL', 'type'=> 3),
        array('id' => 32, 'name' => 'CLOSED_BILL', 'type'=> 3),
        array('id' => 33, 'name' => 'LIEN_BILL', 'type'=> 3),
        array('id' => 34, 'name' => 'SEND_BILL', 'type'=> 3),
        array('id' => 44, 'name' => 'ACCEPTE_BILL', 'type'=> 3),
        array('id' => 45, 'name' => 'DEPOSIT_DATE_BILL', 'type'=> 3),
        //Bill end
        array('id' => 14, 'name' => 'INCOMPLETE_APPOINTMENT', 'type'=> 4),
        array('id' => 15, 'name' => 'PROCESS_APPOINTMENT', 'type'=> 4),
        //Appointment end
        array('id' => 16, 'name' => 'ACTICE_OTHER', 'type'=> 5),
        array('id' => 17, 'name' => 'INACTICE_OTHER', 'type'=> 5),
        array('id' => 18, 'name' => 'PENDING_OTHER', 'type'=> 5),
        array('id' => 19, 'name' => 'COMPLETED_OTHER', 'type'=> 5),
        //Other end
        array('id' => 20, 'name' => 'APPOINTMENT_BILL_STATUS_READY_TO_BILL', 'type'=> 6),
        array('id' => 21, 'name' => 'APPOINTMENT_BILL_STATUS_BILLED', 'type'=> 6),
        //Appointment Bill Status end 
        
         array('id' => 22, 'name' => 'APPOINTMENT_VISIT_STATUS_TENTATIVE', 'type'=> 7),
         array('id' => 23, 'name' => 'APPOINTMENT_VISIT_STATUS_CONFIRMED', 'type'=> 7),
         array('id' => 24, 'name' => 'APPOINTMENT_VISIT_STATUS_ARRIVED', 'type'=> 7),
         array('id' => 25, 'name' => 'APPOINTMENT_VISIT_STATUS_CANCELLED', 'type'=> 7),
         array('id' => 26, 'name' => 'APPOINTMENT_VISIT_STATUS_NO_SHOW', 'type'=> 7),
         array('id' => 27, 'name' => 'APPOINTMENT_VISIT_STATUS_COMPLETE', 'type'=> 7),
        //Appointment Visit Status end

        array('id' => 28, 'name' => 'TASK_COMPLETE', 'type'=> 8),
        array('id' => 29, 'name' => 'TASK_INCOMPLETE', 'type'=> 8),
        array('id' => 30, 'name' => 'TASK_PROCESS', 'type'=> 8), 

        // Bill Stage
        array('id' => 35, 'name' => 'INCOMPLETE_BILL', 'type'=> 9), 
        array('id' => 36, 'name' => 'DOCUMENT_REQUIRED', 'type'=> 9), 
        array('id' => 37, 'name' => 'SEND_BILL', 'type'=> 9), 
        array('id' => 38, 'name' => 'SENT_BILL', 'type'=> 9), 
        array('id' => 39, 'name' => 'FAIL_BILL', 'type'=> 9), 
        array('id' => 40, 'name' => 'CLOSE_BILL', 'type'=> 9), 
        array('id' => 41, 'name' => 'BR_BILL', 'type'=> 9), 
        array('id' => 42, 'name' => 'MR_BILL', 'type'=> 9), 
        array('id' => 43, 'name' => 'EOR_BILL', 'type'=> 9), 
       //Task end
    );
    //define Aliase function for status
    public function getAliaseNames()
    {
        return $this->aliaseNames;
    }

    public function getTasks()
    {
        return $this->hasMany(Task::class, 'status_id', 'id');
    }
}
