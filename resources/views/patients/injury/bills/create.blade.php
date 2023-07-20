@extends('layouts.home-app')
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
@section('content')

    <!-- START: Breadcrumbs-->
    <div class="row ">
        <div class="col-12  align-self-center">
            <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                <div class="w-sm-100 mr-auto">
                    <h4 class="mb-0">{{ $title }}</h4>
                </div>

                <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                    <li class="breadcrumb-item">
                        @if ($billId != null)
                            <a class="btn btn-primary" href="{{ url('/view/patient/injury/bill') }}/{{ $injuryId }}">
                                Back</a>
                        @else
                            <a class="btn btn-primary" href="{{ url('/injury/view') }}/{{ $injuryId }}"> Back</a>
                        @endif
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
    @if (session()->has('success'))
        <div class="alert alert-success">
            {{ session()->get('success') }}
        </div>
    @endif
    <div class="row">
        <div class="col-9 col-md-9 mt-4">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <form action="{{ url('/save/patients/injury/bill') }}" enctype="multipart/form-data"
                            id="patientInjuryFrm" class="form-horizontal ladda-form'" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    @include('patients.injury.bills.injury_bill')
                                </div>
                            </div>
                            <div class="row pt-1 pl-1">
                                <div class="col-xs-12 col-sm-12 col-md-12 text-right">
                                    <button type="submit" class="btn btn-primary ladda-button"><span
                                            class="ladda-label">Submit</span></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-3 col-md-3 mt-4">
        @include('patients.show-patient-info')
    </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://code.jquery.com/jquery-migrate-1.2.1.js"></script> 
<script src="{{ asset('js/controller/bills.js') }}"></script>
<script>
var  diagnosesType = $('input[name=diagnosis_code_type]').val(); 
console.log('#diagnosesType',diagnosesType);
var arrayFromPHP = <?php echo json_encode($diagnoses); ?>;
var cnt = 0; var arrayList =[];
//var token   = $('meta[name="csrf-token"]').attr('content');

<?php  $encodedArray = null;
if($injuryBillInfo){   ?>
    cnt =  '{{ ($referingOrderProviders && count ($referingOrderProviders) > 0) ? count ($referingOrderProviders) : [] }}';
    arrayList = <?php echo json_encode($referingOrderProviders); ?>;
<?php }?> 
var injuryId =  {{$injuryId}};
console.log('#injuryId',injuryId);
var diagnosesCodeArray = [];
function getReferningProvider(type,injuryId,divId,columDiv){
   // alert(type);
   $.ajax({
        url: '/get-referning-providers',
        type: 'POST',
        data: {
        _token: token, type:type, injuryId:injuryId,
        },
        success: function(response) {
            if(response) {
                var items = "";
                $("#" + columDiv + ' input[name="bill_provider_type[]"]').val(type);
                if($("#"+columDiv).hasClass("d-none")){
                    $("#"+columDiv).removeClass("d-none");
                }
                else{
                    $("#"+columDiv).addClass("d-none");
                }

                $("#"+divId).html(" ");
                $.each(response, function (i, item) {
                    items += `<option value="${item.id}">${item.referring_provider_first_name} ${item.referring_provider_last_name}</option>`;
                })
                $("#"+divId).html(items);
            }
        },
        error: function(response) {
            alert(response.responseJSON.message);
        }
    });
}
</script>
