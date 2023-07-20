<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class BillingProviderCharge extends Model
{
    use HasFactory;
    protected  $table = "master_billing_provider_charge";
    protected $fillable = ['ctype','status','provider_id','charge_id','practice_name','states_code','effective_dos','expiration_dos','created_by'];

    public function getChargesProcedureCode(){
        return $this->hasMany(BillingProviderChargeProcedureCode::class, 'billing_provider_charge_id', 'id');
    }
    public function getCreatedBy(){
        return $this->hasOne(User::class, 'id', 'created_by');
    }
    public static function boot()
    {
        parent::boot();
        self::created(function($model){
            // $patientNumber='P00'.$model->id.date('y').date('m').date('d');
            // $model->patient_no = $patientNumber;
            // $model->update();
            if($model){
                 $history = new MasterDataLog();
                $history->type = 'PRACTICE_CHARGE_ADD';
                $history->created_by = Auth::user()->id;
                $history->data_id = $model->id;
                $history->model_name = 'App\BillingProviderCharge';
                $history->description = 'Created Practice Charge';
                $history->save();

            }
        });
        self::updating(function ($model ) {
             // $history->wasChanged(['practice_name','states_code','effective_dos','expiration_dos']);
              $changedColumns = $model->getDirty(); 
            foreach ($changedColumns as $columnName => $newValue) {
                $description = "Column " .$columnName. " was changed.";
                $history = new MasterDataLog();
                $history->type = 'PRACTICE_CHARGE_UPDATE';
                $history->created_by = Auth::user()->id;
                $history->data_id = $model->id;
                $history->model_name = 'App\BillingProviderCharge';
                $history->description = $description;
                $history->save(); 
            } 
        });
        
    }

    public function getChargeLog(){
        return $this->hasMany(MasterDataLog::class, 'data_id', 'id');
    } 

}
