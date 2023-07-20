@extends('layouts.home-app')
@section('content')
<style>
.showPointer {cursor: :pointer !important;}
</style>
    <div class="row">
        <div class="col-1 mt-4"></div>
        <div class="col-10 mt-4">

            <div class="card row-background">
                <!-- START: Breadcrumbs-->
                <div class="row">
                    <div class="col-12  align-self-center">
                        <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded heading-background">
                            <div style="padding-top:10px" class="w-sm-100 mr-auto">
                                <h2 class="heading"> $ {{ $checkMasterCharge->practice_name }}</h2>
                                <span class="text-muted">{{ ($checkMasterCharge  && $checkMasterCharge->ctype == 2) ? 'Expected Reimbursement' : 'Practice Charge'}}</span>
                            </div>
                            <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                                <li class="breadcrumb-item"> <a class="btn btn-primary" href="javascript:void(0)" data-toggle="modal" data-target="#editProviderCharge"> Edit</a> </li>
                                <li class="breadcrumb-item">
                                    <a class="btn btn-primary"
                                        href="{{ url('setting/billing/provider/charge/add', $checkMasterCharge->provider_id) }}">
                                        Back</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- END: Breadcrumbs-->

                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table id="example" class="table layout-secondary dataTable table-striped table-bordered">
                                    <tbody>
                                        <tr class="table-info">
                                            <th scope="row">Name</th>
                                            <td>{{ $checkMasterCharge->practice_name }}</td>
                                        </tr>
                                        <tr class="table-info">
                                            <th scope="row">Effective DOS</th>
                                            <td>{{ $checkMasterCharge->effective_dos }}</td>
                                        </tr>
                                        <tr class="table-info">
                                            <th scope="row">Expiration DOS</th>
                                            <td>{{ $checkMasterCharge->expiration_dos }}</td>
                                        </tr>
                                        <tr class="table-info">
                                            <th scope="row">Active</th>
                                            <td>{{ $checkMasterCharge->status == 1 ? 'Yes' : 'No' }}</td>
                                        </tr>
                                        <tr class="table-info">
                                            <th scope="row">Injury States</th>
                                            <td>{{ $checkMasterCharge->states_code }}</td>
                                        </tr>
                                        <tr class="table-info">
                                            <th scope="row">Created</th>
                                            <td>{{ $checkMasterCharge->created_at }}</td>
                                        </tr>
                                        <tr class="table-info">
                                            <th scope="row">Created By</th>
                                            <td>{{ $checkMasterCharge->getCreatedBy ? $checkMasterCharge->getCreatedBy->name : 'NA' }}
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <hr class="mt-3">
                    @if($checkMasterCharge && count($checkMasterCharge->getChargeLog) > 0 ) 
                    <div class="row"> 
                        <div class="col-12">
                            <h4>History</h4>
                            <div class="table-responsive">
                                <table id="example" class="table layout-secondary dataTable table-striped table-bordered">
                                    <thead class="thead-dark">
                                        <tr>
                                            <th scope="col">Date</th>
                                            <th scope="col">User</th>
                                            <th scope="col">Details</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                     @foreach ($checkMasterCharge->getChargeLog as $log)
                                      <tr>
                                            <td>{{$log->created_at}}</td>
                                            <td>{{($log->getUser) ? $log->getUser->name : ''}}</td>
                                            <td>{{$log->description}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    @endif
                    <hr class="mt-3">
                    <div class="row">
                        <div class="form-group col-md-4">
                            <h4>Procedure Code</h4>
                        </div>
                        <div class="form-group col-md-8" style="text-align:right">
                            <span class="btn btn-primary" data-toggle="modal" data-target="#exampleModal"> Add Procedure
                                Code </span>
                        </div>
                        <div class="col-12">
                            <div class="table-responsive">
                                <table id="example" class="table layout-secondary dataTable table-striped table-bordered">
                                    <thead class="thead-dark">
                                        <tr role="row">
                                            <th scope="col">Procedure Code</th>
                                            <th scope="col">Modifier</th>
                                            <th scope="col">NDC Number</th>
                                            <th scope="col">Charge</th>
                                            <th scope="col">Active</th>
                                            <th scope="col">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($checkMasterCharge->getChargesProcedureCode && count($checkMasterCharge->getChargesProcedureCode) > 0)
                                       @php $chargeMasterLog = [];  @endphp
                                            @foreach ($checkMasterCharge->getChargesProcedureCode as $code)
                                                <tr>
                                                    <td>{{ $code->procedure_code }}</td>
                                                    <td>{{ $code->getChargeModifyer && $code->getChargeModifyer->name ? $code->getChargeModifyer->name : 'NA' }}</td>
                                                    <td>{{ $code->ndc_number }}</td>
                                                    <td>${{ $code->units }}</td>
                                                    <td>{{ $code->status == 1 ? 'Yes' : 'No' }}</td>
                                                    <td>
                                                    <i class="icon-pencil  showPointer" data-toggle="modal" data-target="#procedureCodeModal_{{$code->id}}" /></i>
                                                        <i class="icon-eye showPointer" onClick="deleteCPDCode({{$code->id}});" /></i>
                                                    </td>
                                                </tr>
                                                <div class="modal fade" id="procedureCodeModal_{{$code->id}}" tabindex="-1" role="dialog" aria-labelledby="procedureCodeLabel"
                                                aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="procedureCodeLabel">Update Procedure Code</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="col-12 mt-4">
                                                                <form action="{{ route('saveProcedureCode') }}" method="POST" enctype="multipart/form-data">
                                                                    @csrf
                                                                    <input type="text" name="practiceProcedureCodeId" id="practiceProcedureCodeId" value="{{ $code->id }}">
                                                                    <div class="row">
                                                                        <div class="form-group col-md-3">
                                                                            <label for=""> Procedure Code<span class="required">* </span> </label>
                                                                            <input type="text"   id="procedure_code" disabled value="{{ $code->procedure_code }}" name="procedure_code[]" class="form-control">
                                                                            @if ($errors->has('procedure_code'))
                                                                                <span class="invalid-feedback" style="display:block" role="alert">
                                                                                    <strong>{{ $errors->first('procedure_code') }}</strong>
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                        <div class="form-group col-md-3">
                                                                            <label for="bill_modifiers"> Modifiers </label>
                                                                            <select name="bill_modifiers[]" disabled class="form-control modefierCode"
                                                                                id="bill_modifiers">
                                                                                <option value>-Select-</option>
                                                                                @foreach ($modifiersArray as $modifiyer)
                                                                                    <option value="{{ $modifiyer->id }}" {{ ($code && $code->modifiers == $modifiyer->id) ? 'selected' : ''}}>{{ $modifiyer->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                            @if ($errors->has('bill_modifiers'))
                                                                                <span class="invalid-feedback" style="display:block" role="alert">
                                                                                    <strong
                                                                                        class="invalid-feedback">{{ $errors->first('bill_modifiers') }}</strong>
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                        <div class="form-group col-md-3">
                                                                            <label for="bill_units"> Units </label>
                                                                            <input autocomplete="off" id="bill_units" type="text" name="bill_units"
                                                                                value="{{$code->units}}" class="form-control" maxlength="10">
                                                                            @if ($errors->has('bill_units'))
                                                                                <span class="invalid-feedback" style="display:block" role="alert">
                                                                                    <strong class="invalid-feedback">{{ $errors->first('bill_units') }}</strong>
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="form-group col-md-3">
                                                                            <label for="charge_status"> Active</label>
                                                                            <label class="radio-inline">
                                                                                <input type="radio" id="charge_status1" name="charge_status"  {{ ($code->status == 1) ? 'checked' : ''}} value="1"> Yes
                                                                            </label>
                                                                            <label class="radio-inline">
                                                                                <input type="radio"  id="charge_status2" name="charge_status" {{ ($code->status == 0) ? 'checked' : ''}} value="2"> No
                                                                            </label>
                                                                            @if ($errors->has('charge_status'))
                                                                                <span class="invalid-feedback" style="display:block" role="alert">
                                                                                    <strong class="invalid-feedback">{{ $errors->first('charge_status') }}</strong>
                                                                                </span>
                                                                            @endif
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="form-row col-md-12">
                                                                            <div class="form-group col-md-4">
                                                                                <button type="submit" style="min-width: 120px" class="btn btn-primary ladda-button">
                                                                                    <span class="ladda-label buttonfont">Update</span></button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="8">No Records Found.</td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                     </div>
                    
                </div>
            </div>
        </div>
        <div class="col-1 mt-4"></div>
    </div>
@endsection


@if($checkMasterCharge)
<div class="modal fade" id="editProviderCharge" tabindex="-1" role="dialog" aria-labelledby="editProviderChargeLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProviderChargeLabel">{{ ($checkMasterCharge  && $checkMasterCharge->ctype == 2) ? 'Edit Expected Reimbursement' : 'Edit Practice Charge'}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-12 mt-4">
                    <form action="{{ route('savePracticeCharge') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="chargeId" id="chargeId" value="{{ $checkMasterCharge ? $checkMasterCharge->id : null }}">
                        <input type="hidden" name="ctype" id="ctype" value="{{ $checkMasterCharge->ctype }}">
                        <input type="hidden" name="billingProviderId" id="billingProviderId" value="{{ $checkMasterCharge->provider_id }}">
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label for=""> Practice Charge Name<span class="required">* </span> </label>
                                    <input value="{{ ($checkMasterCharge->practice_name ? $checkMasterCharge->practice_name : null)}}" type="text"  data-validation-event="change" data-validation="required" data-validation-error-msg="" id="practice_charge_name" name="practice_charge_name" class="form-control ">
                                    @if($errors->has('practice_charge_name'))
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong>{{ $errors->first('practice_charge_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group col-md-5">
                                    <label for=""> State<span class="required">* </span> </label>
                                    <select  data-validation-event="change" data-validation="required" data-validation-error-msg="" name="states_code[]"  multiple="multiple"
                                    class="form-control 4 colactive"  id="statesId" data-validation="required" data-validation-error-msg="">
                                        @foreach ($states as $state)
                                        <option value="{{$state["state_code"]}}"> {{$state["state_name"]}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('states_code'))
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong>{{ $errors->first('states_code') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group col-md-2">
                                    <label for=""> Effective DOS<span class="required">* </span> </label>
                                    <input type="text" value="{{ ($checkMasterCharge->effective_dos ? $checkMasterCharge->effective_dos : null)}}" id="effective_dos"  data-validation-event="change" data-validation="required"data-validation-error-msg="" name="effective_dos" class="form-control ">
                                    @if($errors->has('effective_dos'))
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong>{{ $errors->first('effective_dos') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group col-md-2">
                                    <label for=""> Expiration DOS<span class="required">* </span> </label>
                                    <input type="text" value="{{ ($checkMasterCharge->expiration_dos ? $checkMasterCharge->expiration_dos : null)}}" data-validation-event="change" data-validation="required" data-validation-error-msg="" id="expiration_dos" name="expiration_dos" class="form-control">
                                    @if($errors->has('expiration_dos'))
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong>{{ $errors->first('expiration_dos') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for="charge_status"> Active</label>
                                <label class="radio-inline">
                                    <input type="radio" id="charge_status1" name="p_charge_status"  {{ ($checkMasterCharge->status == 1) ? 'checked' : ''}} value="1"> Yes
                                </label>
                                <label class="radio-inline">
                                    <input type="radio"  id="charge_status2" name="p_charge_status" {{ ($checkMasterCharge->status == 0) ? 'checked' : ''}} value="2"> No
                                </label>
                                @if ($errors->has('p_charge_status'))
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong class="invalid-feedback">{{ $errors->first('p_charge_status') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                         <div class="row">
                            <div class="form-row col-md-12">
                                <div class="form-group col-md-4">
                                    <button type="submit"   class="btn btn-primary ladda-button"> <span class="ladda-label buttonfont">Update</span></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endif

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Procedure Code</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="col-12 mt-4">
                    <form action="{{ route('saveProcedureCode') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="practiceChargeId" id="practiceChargeId" value="{{ $checkMasterCharge ? $checkMasterCharge->id : null }}">
                        <input type="hidden" name="chargeId" id="chargeId" value="">
                        <div class="row">
                            <div class="form-group col-md-3">
                                <label for=""> Procedure Code<span class="required">* </span> </label>
                                <input type="text"  id="procedure_code" name="procedure_code[]"
                                    class="form-control ">
                                @if ($errors->has('procedure_code'))
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong>{{ $errors->first('procedure_code') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-md-4">
                                <label for="bill_modifiers"> Modifiers </label>
                                <select readonly name="bill_modifiers[]" class="form-control modefierCode searcDrop"
                                    id="bill_modifiers">
                                    <option value>-Select-</option>
                                    @foreach ($modifiersArray as $modifiyer)
                                        <option value="{{ $modifiyer->id }}">{{ $modifiyer->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('bill_modifiers'))
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong
                                            class="invalid-feedback">{{ $errors->first('bill_modifiers') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group col-md-3">
                                <label for="bill_units"> Units </label>
                                <input autocomplete="off" id="bill_units" type="text" name="bill_units[]"
                                    value="" class="form-control" maxlength="100">
                                @if ($errors->has('bill_units'))
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong class="invalid-feedback">{{ $errors->first('bill_units') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-row col-md-12">
                                <div class="form-group col-md-4">
                                    <button type="submit" style="min-width: 120px"
                                        class="btn btn-primary ladda-button">
                                        <span class="ladda-label buttonfont">Add</span></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://code.jquery.com/jquery-migrate-1.2.1.js"></script>
<script src="{{ asset('js/bootstrap-inputmask.js') }}"></script>
<script src="{{ asset('js/controller/master_for_all.js') }}"></script>
<!-- MDB -->
<link rel="stylesheet" type="text/css" href="{{ url('new_assets/app-assets/css/jquery.multiselect.css') }}">
<script src="{{ asset('new_assets/app-assets/js/jquery.multiselect.js') }}"></script>
<script>
function deleteCPDCode(id) { 
    console.log('checking function calling');
    let _url     = `/delete/procedure/code/${id}`;
    if(confirm("Are You sure ?")){   
        let token   = $('meta[name="csrf-token"]').attr('content');
        
        $.ajax({
            url: _url,
            type: 'POST',
            data: {
            _token: token
            },
            success: function(response) { 
            window.location.reload();
            },
            error: function(response) {  
                alert(response.responseJSON.message);
            }
        });
    }
}
$( document ).ready(function() { 
    $('#effective_dos').datepicker({ dateFormat: 'mm-dd-yy', maxDate: new Date() });
    $('#expiration_dos').datepicker({ dateFormat: 'mm-dd-yy', minDate: new Date() });
});
var jax = $.noConflict();
jax(document).ready(function() {   
    jax('select[multiple]').multiselect({
        columns: 2,
        selectAll : true,
        placeholder: 'Select State',
        unSelectAll : false,
        // allSelectedText: 'All',
        // includeSelectAllOption: true
    }); 
}); 
</script>
