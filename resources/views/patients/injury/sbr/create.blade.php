@extends('layouts.home-new-app')
@section('content')
        
<!-- START: Breadcrumbs-->
    <!-- END: Breadcrumbs-->

    @if ($errors->any())
        <div class="row ">
            <div class="col-12  align-self-center">
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif
    @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
@endif

<div class="col-xl-12 col-lg-12 bg-white">
    <div class="row">
        <div class="col-9 mt-1">
             <div class="sub-header py-3 px-3 align-self-center d-sm-flex w-100 rounded heading-background">
               <div class="w-sm-100 mr-auto margin05">
                   <h2 class="heading">Add Second Review</h2>
                </div>
                <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                    <li class="breadcrumb-item" style="padding-bottom:10px">
                       <a class="btn btn-primary" href="{{url('/injury/view')}}/{{$injuryId}}/{{$patientId}}"> Back</a>
                    </li>
               </ol>
            </div>
            <div class="card row-background">
                <div class="card-content">
                    <div class="card-body">
                        <form action="{{url('/patientinjuries/create')}}" enctype="multipart/form-data" id="patientInjuryFrm" class="form-horizontal ladda-form'" method="POST">
                        @csrf
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12"> 
                                    <div class="row2 border-bottom2">
                                    <div class="col-12"> 
                                    <div class="form-row">
                                                <div class="form-group col-md-3">
                                                    <label for="description3"> DOS <span class="required">* </span> </label>
                                                   <input type="text" name="first_name" class="form-control" data-validation-event="change" data-validation="required, length" data-validation-length="2-100" >
                                                </div>
                                                 <?php //echo '<pre>' ; print_r($reportType); exit; ?>
                                                 
                                                <div class="form-group col-md-3">
                                                    <label for="stateDD">Rendering Provider <span class="required">* </span> </label>
                                                    <select name="injury_state_id3" class="form-control searcDrop" id="injury_state_id3" data-validation-event="change" data-validation="required" data-validation-error-msg="">
                                                        <option value="" class="option">Select</option>
                                                        @foreach ($reportType as $report)
                                                        <option value="{{$report["report_name"]}}"> {{$report["report_name"]}} ({{$report["report_code"]}})</option>
                                                        @endforeach
                                                    </select>
                                                    @if($errors->has('injury_state_id3'))
                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                        <strong class="invalid-feedback" >{{ $errors->first('injury_state_id3') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                                
                                                <div class="form-group col-md-3">
                                                    <label for="stateDD">Place of Service Type <span class="required">* </span> </label>
                                                    <select name="injury_state_id3" class="form-control searcDrop" id="injury_state_id3" data-validation-event="change" data-validation="required" data-validation-error-msg="">
                                                        <option value="" class="option">Select</option>
                                                        @foreach ($reportType as $report)
                                                        <option value="{{$report["report_name"]}}"> {{$report["report_name"]}} ({{$report["report_code"]}})</option>
                                                        @endforeach
                                                    </select>
                                                    @if($errors->has('injury_state_id3'))
                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                        <strong class="invalid-feedback" >{{ $errors->first('injury_state_id3') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                    </div>
                                    </div>
                                    
                                    <div class="2 border-bottom2">
                                    <div class="col-12">  
                                    <h2>Service Line Item #1</h2>
                                    <div class="form-row">                                        
                                                <div class="form-group col-md-3">
                                                    <label for="description3"> Procedure Code  </label>
                                                   <input type="text" name="first_name" class="form-control" data-validation-event="change" data-validation="required, length" data-validation-length="2-100" >
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="description3"> Modifiers </label>
                                                   <input type="text" name="first_name" class="form-control" data-validation-event="change" data-validation="required, length" data-validation-length="2-100" >
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label for="description3"> Units </label>
                                                   <input type="text" name="first_name" class="form-control" data-validation-event="change" data-validation="required, length" data-validation-length="2-100" >
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label for="description3"> Charge </label>
                                                   <input type="text" name="first_name" class="form-control" data-validation-event="change" data-validation="required, length" data-validation-length="2-100" >
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label for="description3"> Payment </label>
                                                   <input type="text" name="first_name" class="form-control" data-validation-event="change" data-validation="required, length" data-validation-length="2-100" >
                                                </div>
                                            </div>
                                        <div class="form-row">
                                                <div class="form-group col-md-8">
                                                    <label for="description3"> Reason for Requesting Appeal </label>
                                                   <input type="text" name="first_name" class="form-control" data-validation-event="change" data-validation="required, length" data-validation-length="2-100" >
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="description3">Authorized?</label>
                                                   <div class="form-control">
                                                       
                                                   <label class="radiobox-width" style="border-right: groove"> <input type="radio" name="radio1" checked> <span> Yes</span> </label> 
                                                    <label class="radiobox-width"> <input type="radio" name="optradio"> No</label> 
                                                   </div>
                                                </div>
                                            </div>
                                        <div class="form-row">
                                                <div class="form-group col-md-8">
                                                    <label for="description3"> Describe </label>
                                                   <textarea name="first_name" class="form-control" data-validation-event="change" data-validation="required, length" data-validation-length="2-100" ></textarea>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="description3">Supporting Document Attached?</label>
                                                   <div class="form-control">
                                                       
                                                   <label class="radiobox-width" style="border-right: groove"> <input type="radio" name="optradio" checked> <span> Yes</span> </label> 
                                                    <label class="radiobox-width"> <input type="radio" name="optradio"> No</label> 
                                                   </div>
                                                </div>
                                            </div><br>
                                    </div>        
                                    </div> 
                                    
                                    <div class="row2 border-bottom2">
                                    <div class="col-12">   
                                    <h2>Service Line Item #2</h2>
                                    <div class="form-row">
                                                <div class="form-group col-md-3">
                                                    <label for="description3"> Procedure Code  </label>
                                                   <input type="text" name="first_name" class="form-control" data-validation-event="change" data-validation="required, length" data-validation-length="2-100" >
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="description3"> Modifiers </label>
                                                   <input type="text" name="first_name" class="form-control" data-validation-event="change" data-validation="required, length" data-validation-length="2-100" >
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label for="description3"> Units </label>
                                                   <input type="text" name="first_name" class="form-control" data-validation-event="change" data-validation="required, length" data-validation-length="2-100" >
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label for="description3"> Charge </label>
                                                   <input type="text" name="first_name" class="form-control" data-validation-event="change" data-validation="required, length" data-validation-length="2-100" >
                                                </div>
                                                <div class="form-group col-md-2">
                                                    <label for="description3"> Payment </label>
                                                   <input type="text" name="first_name" class="form-control" data-validation-event="change" data-validation="required, length" data-validation-length="2-100" >
                                                </div>
                                            </div>
                                    <div class="form-row">
                                                <div class="form-group col-md-8">
                                                    <label for="description3"> Reason for Requesting Appeal </label>
                                                   <input type="text" name="first_name" class="form-control" data-validation-event="change" data-validation="required, length" data-validation-length="2-100" >
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="description3">Authorized?</label>
                                                   <div class="form-control">
                                                       
                                                   <label class="radiobox-width" style="border-right: groove"> <input type="radio" name="radio1" checked> <span> Yes</span> </label> 
                                                    <label class="radiobox-width"> <input type="radio" name="optradio"> No</label> 
                                                   </div>
                                                </div>
                                            </div>
                                    <div class="form-row">
                                                <div class="form-group col-md-8">
                                                    <label for="description3"> Describe </label>
                                                   <textarea name="first_name" class="form-control" data-validation-event="change" data-validation="required, length" data-validation-length="2-100" ></textarea>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="description3">Supporting Document Attached?</label>
                                                   <div class="form-control">
                                                       
                                                   <label class="radiobox-width" style="border-right: groove"> <input type="radio" name="optradio" checked> <span> Yes</span> </label> 
                                                    <label class="radiobox-width"> <input type="radio" name="optradio"> No</label> 
                                                   </div>
                                                </div>
                                               
                                            </div><br>
                                    </div>        
                                    </div> 
                                    
                                     <div class="row2 border-bottom2">
                                    <div class="col-12">   
                                    <h2>Service Line Item #2</h2>
                                    
                                    <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label for="description3"> EOR Date </label>
                                                   <input type="text" name="first_name" class="form-control" data-validation-event="change" data-validation="required, length" data-validation-length="2-100" >
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="description3">Payer Claim Control Number</label>
                                                   <input type="text" name="first_name" class="form-control" data-validation-event="change" data-validation="required, length" data-validation-length="2-100" >
                                                </div>
                                            </div>
                                    
                                    </div>        
                                    </div>
                                    
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                            <button type="submit" class="btn btn-primary ladda-button"><span class="ladda-label">Submit</span></button>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            </div>
        <div class="col-3 mt-1 rightside sticky">
            @if($patient)
                @include('patients.show-patient-info')
            @endIf
        </div>
      </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://code.jquery.com/jquery-migrate-1.2.1.js"></script>
<script src="{{ asset('js/bootstrap-inputmask.js') }}"></script>
<script src="{{ asset('js/controller/master_for_all.js') }}"></script>
<script>
$( document ).ready(function() {
    let divId = "<?php echo ($pInjuries) ? $pInjuries->financial_class : 1;?>";
    //console.log('divId',divId);
    showHideInjuryDiv(divId);
});
//showHideInjuryDiv(1)
   function showHideInjuryDate(val){
       console.log('value',val);
    if(val==2)
    {
        $("#injury-end-date-divId").addClass("d-none");
    }
    else{
        $("#injury-end-date-divId").removeClass("d-none");
    }
}
function showHideInjuryDiv(val){
    if(val==1)
    {
        $("#privateGovId").addClass("d-none");
        $("#personalDivId").addClass("d-none");
        $("#workerCompId").removeClass("d-none");
    }
    else if(val==2){
        $("#privateGovId").removeClass("d-none");
        $("#personalDivId").addClass("d-none");
        $("#workerCompId").addClass("d-none");
    }
    else if(val==3){
        $("#privateGovId").addClass("d-none");
        $("#personalDivId").removeClass("d-none");
        $("#workerCompId").addClass("d-none");
    }
}
$( document ).ready(function() {
    $( "#no_any_claim" ).click(function() {
        if($('#no_any_claim').is(':checked')){
            $("#claim_admin_id").attr('disabled', true);
        }
        else{
            $("#claim_admin_id").attr('disabled', false);
        }
    })
    $( "#no_any_network" ).click(function() {
        if($('#no_any_network').is(':checked')){
            $("#medical_provider_network").attr('disabled', true);
        }
        else{
            $("#medical_provider_network").attr('disabled', false);
        }

    })
    $('#start_date_injury').datepicker({ dateFormat: 'yy-mm-dd' });
    $('#injury-end-date').datepicker({ dateFormat: 'yy-mm-dd' });
    $('#claim_status_dateId').datepicker({ dateFormat: 'yy-mm-dd' });

});
</script>




