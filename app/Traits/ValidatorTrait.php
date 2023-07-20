<?php
namespace App\Traits;

trait ValidatorTrait
{
    public function isValidDate($date){
        $dt = date('m-d-Y', strtotime($date));
        $dtArr = explode('-', $dt);
        return checkdate($dtArr[0], $dtArr[1], $dtArr[2]);
    }

    public function isValidZipcode($zipcode){
        //Here, zipcode should be check from database in future
        if(trim($zipcode) != ''){
            return true;
        }
        return false;
    }
    public function isValidSSN($ssn_no){
        //Here, ssn_no should be check from database or pattern format in future
        if(trim($ssn_no) != ''){
            return true;
        }
        return false;
    }
    public function isValidClaimNo($claim_no){
        //Here, ssn_no should be check from database or pattern format in future
        if(trim($claim_no) != ''){
            return true;
        }
        return false;
    }
}