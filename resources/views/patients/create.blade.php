@extends('layouts.home-new-app')
@section('content')
<style>
     /*css for page 30-10-23*/
.mt-1, .my-1{
    margin-top:0.5rem!important;
}
.sticky {
    position: -webkit-sticky!important;
    position: sticky!important;
    top: 72px;
    height:100px;
}
.sticky2 {
    position: -webkit-sticky!important;
    position: sticky!important;
    top: 0px;
    height:60px;
    z-index:99;
}
.injuryBox .card {
    margin-bottom: 0.5rem;
}
.rightside{
    padding-left:7px!important;
}

.scroll-new{
   height:86vh;
   overflow-y:scroll;
   scrollbar-width: thin;
   scrollbar-color: #cccccc3c #c1c1c1;
   position:relative;
   padding-right:5px;
   overflow-x:hidden;
}
.scroll-new::-webkit-scrollbar {
  width: 6px;
  border-radius: 3px;
}
.scroll-new::-webkit-scrollbar-track {
  background-color: #cccccc3c;
}
.scroll-new::-webkit-scrollbar-thumb {
  background-color: #c1c1c1;
}
.rightside #billingInfobydefault {
     box-shadow: 0 0rem 0rem #21283226; 
     border:0px solid rgba(33,40,50,.125); 
     border-radius: 0rem; 
     background: #ffffff00; 
}
 /*css for page 30-10-23*/
    
</style>
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
<div class="col-xl-12 col-lg-12 bg-white">
    <div class="row custom-form">
   <div class="col-9 scroll-new">
    <!-- START: Breadcrumbs-->        
     <div class="row mt-0">
        <div class="col-12">
            <div class="sub-header py-3 px-3 align-self-center d-sm-flex w-100 rounded heading-background">
                <div class="w-sm-100 mr-auto margin05">
                  <h2 class="mb-0 heading">{{ $title }}</h2>
                </div>
                <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                    <li class="breadcrumb-item">
                        <a class="btn btn-primary" href="{{ route('patients.index') }}"> {{ trans('billLabel.back') }}</a>
                    </li>
                </ol>
            </div>
        </div>
    </div>
     <!-- END: Breadcrumbs-->       
            <div class="card row-background2">
                <div class="card-content">
                    <div class="card-body">
                        <h4 class="px-2 py-2"><i class="fa-solid fa-user"></i> {{ trans('billLabel.patient_information') }}</h4>
                        <form action="{{ route('patients.store') }}" enctype="multipart/form-data"
                            class="form-horizontal ladda-form'" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <input type="hidden" name="patient_id" value="{{ $patientId ? $patientId : null }}"
                                        class="form-control">
                                    @include('patients.patient_info')
                                    <div class="row">
                                        <div class="col-xs-12 col-sm-12 col-md-12 text-left ">
                                            <button type="submit" class="btn btn-primary ladda-button mx-2 mt-1"><span class="ladda-label">{{ trans('billLabel.save') }}</span></button>
                                            @if(!$patientId)
                                                <button type="reset" class="btn btn-secondary mx-2 mt-1"><span class="ladda-label">{{ trans('billLabel.cancel') }} </span></button>
                                            @endif
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
            @else
            <!--<div id="billingInfobydefault">-->
            <!--    <div class="mb-1">-->
            <!--        <h6 class="mb-0">-->
            <!--            <a class="redial-dark d-block border redial-border-light">-->
            <!--                <i class="fa-solid fa-file-invoice-dollar"></i> {{ trans('billLabel.billing_provider_head') }}</a>-->
            <!--        </h6>-->
            <!--        <div id="" class=" setCollapseBorder" role="tabpanel">-->
            <!--            <div class="card-body">-->
            <!--                <span class="font-weight-bold pr-1"> {{ trans('billLabel.name') }} :</span>-->
            <!--                <span class="text-muted font-weight-bold">{{ trans('billLabel.billing_provider_defaul_name') }}</span>-->
            <!--                <br>-->
            <!--                <br>-->
            <!--                <span class="font-weight-bold pr-1">{{ trans('billLabel.tax_id') }} :</span>-->
            <!--                <span class="text-muted font-weight-bold">{{ trans('billLabel.billing_provider_defaul_tax_id') }}</span>-->
            <!--                <br>-->
            <!--                <br>-->
            <!--                <span class="font-weight-bold pr-1">{{ trans('billLabel.npi') }} :</span>-->
            <!--                <span class="text-muted font-weight-bold">{{ trans('billLabel.billing_provider_defaul_npi') }}</span>-->
            <!--                <br>-->
            <!--                <br>-->
            <!--            </div>-->
            <!--        </div>-->
            <!--    </div>-->
            <!--</div>-->

            <div id="billingInfoDiv">
            </div>
            @endif
        </div>
    </div>
    
</div>
@endsection
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://code.jquery.com/jquery-migrate-1.2.1.js"></script>
<script src="{{ asset('js/bootstrap-inputmask.js') }}"></script>
<script src="{{ asset('js/controller/master_for_all.js') }}"></script>
<script src="{{ asset('js/controller/patients.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#dobId').datepicker({
            dateFormat: 'mm/dd/yy',
            maxDate: new Date(),
            changeMonth: true,
            changeYear: true,
        });
    });
</script>
