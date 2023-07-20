@extends('layouts.home-app')
@section('content')
        <script src="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/js/bootstrap-select.min.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.6.3/css/bootstrap-select.min.css" />
<!-- START: Breadcrumbs-->
    <div class="row ">
        <div class="col-12  align-self-center">
            <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                <div class="w-sm-100 mr-auto"><h4 class="mb-0">{{$title}}</h4></div>

                <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                    <li class="breadcrumb-item">
                        <a class="btn btn-primary" href="{{url('/injury/view')}}/{{$injuryId}}/{{$patientId}}"> Back</a>
                    </li>
                </ol>
            </div>
        </div>
    </div>
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
    <div class="row">
        <div class="col-9 mt-4">
            <div class="card row-background">
                <div class="card-content">
                    <div class="card-body">
                        <form action="{{url('/patientinjuries/create')}}" enctype="multipart/form-data" id="patientInjuryFrm" class="form-horizontal ladda-form'" method="POST">
                        @csrf
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    @include('patients.injury.patient_injury')

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
        <div class="col-3 mt-4 rightside">
        @include('patients.show-patient-info')
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




