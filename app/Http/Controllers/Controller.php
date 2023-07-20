<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Traits\{DataTrait, ValidatorTrait, PatientTrait, PatientinjuryTrait, InjuryclaimTrait, BillTrait, TaskTrait, StatusTrait, TaskAssignTrait};

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    use DataTrait, ValidatorTrait, PatientTrait, PatientinjuryTrait, InjuryclaimTrait, BillTrait, TaskTrait, StatusTrait, TaskAssignTrait; 
}
