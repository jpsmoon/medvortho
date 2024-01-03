@extends('layouts.home-app')

@section('content')

    

    @if ($errors->any())
        <div class="row custom-form">
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
        <div class="col-xl-12 col-lg-12 bg-white">
    <div class="row">
        <div class="col-9 mt-1 mb-1 scroll-new">
            <!-- START: Breadcrumbs-->
    <div class="row mt-0">
        <div class="col-12  align-self-center">
            <div class="sub-header py-3 px-1 align-self-center d-sm-flex w-100 rounded heading-background">
                <div class="w-sm-100 mr-auto margin05">
                    <h2 class="mb-0"><i class="fa-solid fa-hand-holding-medical"></i> {{ $title }}</h2>
                </div>

                <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                    <li class="breadcrumb-item">
                        @if ($injuryId != null)
                            <a class="btn btn-primary" href="{{ url('/injury/view/' . $injuryId) }}"> Back</a>
                        @else
                            <a class="btn btn-primary" href="{{ url('/patients/view/' . $patientId) }}"> Back</a>
                        @endif
                    </li>
                </ol>
            </div>
        </div>
    </div>
    <!-- END: Breadcrumbs-->
            
            <div class="card row-background2">
                <div class="card-content">
                    <div class="card-body myh">
                        <form action="{{ url('/patientinjuries/create') }}" enctype="multipart/form-data"
                            id="patientInjuryFrm" class="form-horizontal ladda-form'" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <input autocomplete="off" type="hidden" name="patient_id" value="{{ $patientId }}"
                                        class="form-control">
                                    <input autocomplete="off" type="hidden" name="injuryId" value="{{ $injuryId }}"
                                        class="form-control">
                                    @include('patients.injury.patient_injury')

                                    <div class="row mt-1">
                                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                            <button type="submit" class="btn btn-primary ladda-button"><span
                                                    class="ladda-label">Submit</span></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
         <div class="col-3 col-md-3 mt-0 rightside sticky" style="padding-left:5px!important; padding-right:5px!important; top:70px">
            @include('patients.show-patient-info')
        </div>
    </div>
    </div>
    </div>

@endsection
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://code.jquery.com/jquery-migrate-1.2.1.js"></script>

<script src="{{ asset('public/js/bootstrap-inputmask.js') }}"></script>
<script src="{{ asset('public/js/controller/master_for_all.js') }}"></script>
<script src="{{ asset('public/js/helper.js') }}"></script>
<script>
    $(document).ready(function() {
        var selectElements = $('input[name="work_dg_code_id[]"]');
        selectElements.each(function (index, selectElement) {
            var $selectElement = $(selectElement); // Wrap selectElement with jQuery
            setDignosisCodeByDivId($selectElement.attr('id'))
        });
            let divId = "<?php echo $pInjuries ? $pInjuries->financial_class : 1; ?>";
            console.log('divId',divId);
            showHideInjuryDiv(divId);
            //
            var isShowAddess = '<?php echo ($pInjuries && $pInjuries->getInjuryClaim && $pInjuries->getInjuryClaim->is_employer_address_optional == 1) ? true : false; ?>';
            if (isShowAddess) {
                $('#showEmployerAddressDiv').removeClass('d-none');
            } else {
                $('#showEmployerAddressDiv').addClass('d-none');
            }

            $("#employer_name_address").click(function() {
                if ($('#employer_name_address').is(':checked')) {
                    $('#showEmployerAddressDiv').removeClass('d-none');
                } else {
                    $('#showEmployerAddressDiv').addClass('d-none');
                }
            });
 
            $("#no_any_claim_id").click(function() {
                if ($('#no_any_claim_id').is(':checked')) {
                    $("#claim_admin_id").attr('disabled', true);
                } else {
                    $("#claim_admin_id").attr('disabled', false);
                }
            })
            $("#no_any_network_id").click(function() {
                if ($('#no_any_network_id').is(':checked')) {
                    $('#labelMedicalNetworkList').css('pointer-events','none');
                    $('#labelMedicalNetworkList').attr('disabled','disabled');
                    $("#medical_provider_name").text("");
                    $("#medical_provider_network").val(null);
    
                } else {
                    $("#labelMedicalNetworkList").attr('disabled', false);
                    $('#labelMedicalNetworkList').css('pointer-events','');
                }
    
            })
            $('#start_date_injury').datepicker({
                dateFormat: 'mm/dd/yy',
                changeMonth: true, changeYear: true,
                // onSelect: function( selectedDate ) {
                // console.log('#selectedDate',selectedDate);
                // $( "#injury-end-date" ).datepicker( "option",{ minDate: new Date(selectedDate), dateFormat: 'mm/dd/yy'} );
                //}
            });
            $('#injury-end-date').datepicker({
                dateFormat: 'mm/dd/yy',changeMonth: true, changeYear: true,
            });
    
            $('#claim_status_dateId').datepicker({
                dateFormat: 'mm/dd/yy',changeMonth: true, changeYear: true,
            });
    
            $(document).on("keyup", "input[type='text'][name='contact_zip_name[]']", function(e) {
                let zipCode = $(this).val();
                var selectedZip = e.target.id;
                var stateSelect = $("#" + selectedZip).closest(".card").find('[class*="stateName"]').first()
                    .attr("id");
                var citySelect = $("#" + selectedZip).closest('.card').find('[class*="cityNameInput"]')
                    .first().attr("id");
                getStatesByZipCode(zipCode, stateSelect, citySelect);
            });
    });

 //showHideInjuryDiv(1)
    function showHideInjuryDate(val) {
        if (val == 2) {
            $("#injury-end-date-divId").addClass("d-none");
        } else {
            $("#injury-end-date-divId").removeClass("d-none");
        }
    }

    function showHideInjuryDiv(val) {
        if (val == 1) {
            $("#privateGovId").addClass("d-none");
            $("#personalDivId").addClass("d-none");
            $("#workerCompId").removeClass("d-none");
        } else if (val == 2) {
            $("#privateGovId").removeClass("d-none");
            $("#personalDivId").addClass("d-none");
            $("#workerCompId").addClass("d-none");
        } else if (val == 3) {
            $("#privateGovId").addClass("d-none");
            $("#personalDivId").removeClass("d-none");
            $("#workerCompId").addClass("d-none");
        }
    } 
    function cloneNewContact() {
        var num = $('.clonedWrapper').length;
        var newNum = new Number(num + 1);
        var clonedRow = $('div .clonedWrapper:last').clone().attr('id', 'input_' + newNum);
        clonedRow.find('.card-header').attr('id', 'cardHeadId' + newNum);
        clonedRow.find('.contactRole').attr('id', 'contactRole_' + newNum);
        clonedRow.find('.contactRoleName').attr('id', 'contactRoleName_' + newNum);
        clonedRow.find('.contactRoleName').val("");
        clonedRow.find('.showSelectedNameDiv').attr('id', 'showIdSelected_' + newNum);
        clonedRow.find('.showfirstLastName').attr('id', 'showfirstLastName_' + newNum);
        clonedRow.find('.showSelectedNameDiv').addClass('d-none');
        clonedRow.find('.showfirstLastName').addClass('d-none');
        let zipCodeId = 'contact_zip_name_' + newNum;
        let stateId = 'contact_state_name_' + newNum;
        let cityId = 'contact_city_name_' + newNum;
        clonedRow.find('.zipCodeDop').attr('id', zipCodeId);
        clonedRow.find('.stateName').attr('id', stateId);
        clonedRow.find('.cityNameInput').attr('id', cityId);
        $('div .clonedWrapper:last').after(clonedRow);
    }

    function showcontactInfoBox(event, val) {
        //console.log('#val',val);
        var selectId = event.target.id;
        var el = document.getElementById(event.target.id);
        var cardDiv = el.closest(".card");
        var cardDivId = document.getElementById(cardDiv.id);
        var cardHeadId = $("#" + selectId).closest(".card").find('[class*="card-header"]').first().attr("id");
        var roleNameId = $("#" + selectId).closest('.card').find('[class*="contactRoleName"]').first().attr("id");
        var showfirstLastName = $("#" + selectId).closest('.card').find('[class*="showfirstLastName"]').first().attr(
            "id");
        var showIdSelected = $("#" + selectId).closest('.card').find('[class*="showSelectedNameDiv"]').first().attr(
            "id");
        //console.log('#showfirstLastName', showfirstLastName);
        // console.log('#roleNameId',roleNameId);
        if (val != "") {
            $("#" + showIdSelected).removeClass('d-none');
            $("#showCloneLink").removeClass('d-none');
            this.changeCardHeadTitle(event.target.id, cardHeadId, roleNameId);

            if (val == 1 || val == 4 || val == 5 || val == 6 || val == 7 || val == 8) {
                $("#" + showfirstLastName).removeClass('d-none');
            } else {
                $("#" + showfirstLastName).addClass('d-none');
            }
        } else {
            $("#" + showfirstLastName).addClass('d-none');
            $("#showCloneLink").addClass('d-none');
        }
    }

    function formatResult(d) {
        if (d.loading) {
            return d.diagnosis_name;
        }

        // Creating an option of each id and text
        $d = $('<option/>').attr({
            'value': d.id
        }).text(d.diagnosis_name + " (" + d.diagnosis_code + " )");

        return $d;
    }

    function formatRepoSelection(val) {
        if (val.text == "") {
            return val.diagnosis_name + " (" + val.diagnosis_code + " )";
        }
    }

    
    function chooseMedicalProviderNetwork(medicalNetworkInfo){
        $("#medical_provider_name").text(medicalNetworkInfo['applicant_name']);
        $("#medical_provider_network").val(medicalNetworkInfo['id']);
    }
function setDignosisCodeByDivId(DivId) {
        $("#" +DivId).select2({
                width: '100%',
                placeholder: 'Select Diagnosis Code',
                search: true,
                ajax: {
                    url: "/searchDiagnosis",
                    //dataType: 'json',
                    type: "POST",
                    quietMillis: 50,
                    data: function(term, page) {
                        return {
                            q: term, // Pass the search term as 'q' parameter
                            page: page,
                            _token: token,
                            type: 10,
                        };
                    },
                    processResults: function(data) {
                        if (data && data.length > 0) {
                            // Tranforms the top-level key of the response object from 'items' to 'results'
                            var results = [];
                            data.forEach(e => {
                                results.push({
                                    id: e.id,
                                    diagnosis_name: e.diagnosis_name,
                                    diagnosis_code: e.diagnosis_code
                                });
                            });
                            return {
                                results: results,
                            };
                        } 
                    },
                },
                cache: true,
                formatResult: formatResult,
                formatSelection: function(item) {
                    return item.diagnosis_code + "-" + item
                    .diagnosis_name; // Display the 'name' property in the input field
                },
            }); 
    }  
  
</script> 
