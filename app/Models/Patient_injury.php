<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\InjuryClaim;
use App\Models\InjuryNote;

class Patient_injury extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = [ 'patient_id', 'financial_class', 'injury_state_id', 'description' ];

    public function patient(){
        return $this->belongsTo(Patient::class, 'patient_id', 'id');
    }
    public function getInjuryClaim(){
        return $this->hasOne(InjuryClaim::class, 'injury_id', 'id');
    }

    public function getInjuryDocuments(){
        return $this->hasMany(AllDocument::class, 'injury_id', 'id')->where('doc_type','Injury');
    }

    public function getInjuryNotes(){
        return $this->hasMany(InjuryNote::class, 'injury_id', 'id');
    }
    public function getUser(){
        return $this->hasOne(User::class,  'id', 'added_by');
    }
    public function getInjuryHistory(){
        return $this->hasMany(MasterDataLog::class, 'data_id', 'id')->whereIn('type', ['INJURY_DOCUMENT_CREATED','INJURY_DOCUMENT_UPDATED','INJURY_CREATED', 'INJURY_UPDATED', 'INJURY_NOTE_DELETED']);
    }
    public function getInjuryContacts(){
        return $this->hasMany(InjuryContact::class, 'injury_id', 'id');
    }
    public function getInjuryBills(){
        return $this->hasMany(InjuryBill::class, 'injury_id', 'id');
    }
    public function getInjuryUnsendBills(){
        return $this->hasMany(InjuryBill::class, 'injury_id', 'id')->whereIn('bill_status',[1,2,20]);
    }
    public function getInjurySentBills(){
        return $this->hasMany(InjuryBill::class, 'injury_id', 'id')->where('bill_status',3);
    }
    
    
}
