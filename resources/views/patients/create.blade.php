@extends('layouts.home-app')
@section('content')
<!-- START: Breadcrumbs-->
    <div class="row ">
        <div class="col-12">
            <div class="sub-header align-self-center mt-1 py-2 px-2 align-items-center d-sm-flex w-100 rounded">
                <div class="w-sm-100 mr-auto"><h4 class="mb-0">{{$title}}</h4></div>

                <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                    <li class="breadcrumb-item">
                        <a class="btn btn-primary" href="{{ route('patients.index') }}"> Back</a>
                    </li>
                </ol>
            </div>
        </div>
    </div>
    <!-- END: Breadcrumbs-->

    @if ($message = Session::get('flash_success_message'))
    <div class="alert alert-success alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
</div>
@endif

@if ($message = Session::get('flash_error_message'))
<div class="alert alert-danger alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
</div>
@endif

    <div class="row custom-form">
        <div class="col-9 mt-4">
            <div class="card row-background2">
                <div class="card-content">
                    <div class="card-body">
                        <h4 class="px-2 py-2"><i class="fa-solid fa-user"></i> Patient Information</h4>
                        <form action="{{ route('patients.store') }}" enctype="multipart/form-data" class="form-horizontal ladda-form'" method="POST">
                        @csrf
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                <input type="hidden" name="patient_id" value="{{ ($patientId) ? $patientId : null }}" class="form-control">
                                    @include('patients.patient_info')
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 text-left ">
                                            <button type="submit" class="btn btn-primary ladda-button mx-2 mt-1"><span class="ladda-label">Submit</span></button>
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
            <div id="billingInfoDiv"></div>
        </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://code.jquery.com/jquery-migrate-1.2.1.js"></script>
<script src="{{ asset('public/js/bootstrap-inputmask.js') }}"></script>
<script src="{{ asset('public/js/controller/master_for_all.js') }}"></script>
<script>
    $( document ).ready(function() {
        $('#dobId').datepicker({ dateFormat: 'mm/dd/yy', maxDate: new Date(), changeMonth: true, changeYear: true, });
    });
</script>
