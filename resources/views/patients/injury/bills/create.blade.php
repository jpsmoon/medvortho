@extends('layouts.home-new-app')

@section('content')
 @php  $dcCodesDbArray = [];  @endphp
  @if($pInjuries->getInjuryClaim->getInjuryDianoses && count($pInjuries->getInjuryClaim->getInjuryDianoses))
    @foreach ($pInjuries->getInjuryClaim->getInjuryDianoses as $key =>  $dCode)
        @php   if($dCode->getDianoses && $dCode->getDianoses && $dCode->getDianoses->diagnosis_code && $dCode->getDianoses->diagnosis_code != 0) { $dcCodesDbArray[] = $dCode->getDianoses->diagnosis_code; }   @endphp
    @endforeach
 @endif 
   

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
        <div class="col-xl-12 col-lg-12 bg-white">
    <div class="row">
        <div class="col-9 col-md-9 mt-1 mb-1 row-background2">
             <!-- START: Breadcrumbs-->
    <div class="row mt-0">
        <div class="col-12  align-self-center">
            <div class="sub-header mt-0 py-3 px-3 align-self-center d-sm-flex w-100 rounded heading-background">
                <div class="w-sm-100 mr-auto  margin05">
                    <h2><i class="fa-solid fa-file-invoice"></i> {{ $title }}</h2>
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
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                        <form  action="{{ url('/save/patients/injury/bill') }}"  enctype="multipart/form-data" id="patientBillFrm" class="form-horizontal ladda-form'" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    @include('patients.injury.bills.injury_bill')
                                </div>
                            </div>
                            <div class="row pt-0 pl-0 ml-1 mt-1" style="margin-left:19px!important">
                                <div class="col-xs-12 col-sm-12 col-md-12 text-right">
                                    <button  type="submit" class="btn btn-primary ladda-button"><span
                                            class="ladda-label">Submit</span></button>
                                </div>
                            </div>
                        </form>
                    </div>
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

<script>
    var diagnosesType = $('input[name=diagnosis_code_type]').val();
    console.log('#diagnosesType', diagnosesType);
    var arrayFromPHP = <?php echo json_encode($diagnoses); ?>;
    var diCodeForEdit = <?php echo json_encode($diCodeForEdit); ?>; 
    //console.log('#diCodeForEdit#', diCodeForEdit);
    var cnt = 0;
    var arrayList = [];
    var dignosisCOdeArr = [];
    //var token   = $('meta[name="csrf-token"]').attr('content');

    <?php  $encodedArray = null;
    if($injuryBillInfo){   ?>
        cnt ='{{ $referingOrderProviders && count($referingOrderProviders) > 0 ? count($referingOrderProviders) : [] }}';
        arrayList = <?php echo json_encode($referingOrderProviders); ?>;
    <?php }?>
        var injuryId = {{ $injuryId }};
        console.log('#injuryId', injuryId);
        var diagnosesCodeArray = []; 
    $(document).ready(function() { 
            var billUnits = document.getElementsByClassName("bill_unit"); 
            for (var i = 0; i < billUnits.length; i++) {
                billUnits[i].value = 1; // Set the default value for each input element
            }
            var selectElements = $('input[name="work_dg_code_id[]"]');
            selectElements.each(function (index, selectElement) {
            var $selectElement = $(selectElement); // Wrap selectElement with jQuery
                setDignosisCodeByDivId($selectElement.attr('id'))
            });
            
            setModifiyerDop();
            addMoreInputsForProcedureCode();  
            hideRemoveIconFromFirstRowInPRocedureCode(); 
            callInLastDiagnosiCode();
            callAllDatePicker();  
            $('form').click(function(event) { 
                if($('.cloneDiv .procedure_code_ul:visible')){  
                    let divUlId = $('.cloneDiv .procedure_code_ul:visible').attr('id');
                    let ulInput =$('#'+divUlId).prev('.procedure_code_input').attr('id');
                    //$("#"+ ulInput).val('');
                    $("#"+ divUlId).hide(); 
                    setTimeout(function() {
                        setUnitCodeOnChangeProcedureCode(event, 0);
                    }, 3000); 
                } 
            }) 
             
            checkForDCMatchWithDiagonis();
            checkdcValWithDcDropDown();
            $("#patientBillFrm").on("input change click keyPress keyup", "input, select, radio, checkbox", function() {
                checkForDCMatchWithDiagonis();
                checkdcValWithDcDropDown();
            });  
    }); 
    function getReferningProvider(type, injuryId, divId, columDiv) {
        // alert(type);
        $.ajax({
            url: '/get-referning-providers',
            type: 'POST',
            data: {
                _token: token,
                type: type,
                injuryId: injuryId,
            },
            success: function(response) {
                if (response) {
                    var items = "";
                    $("#" + columDiv + ' input[name="bill_provider_type[]"]').val(type);
                    if ($("#" + columDiv).hasClass("d-none")) {
                        $("#" + columDiv).removeClass("d-none");
                    } else {
                        $("#" + columDiv).addClass("d-none");
                    }

                    $("#" + divId).html(" ");
                    $.each(response, function(i, item) {
                        items +=
                            `<option value="${item.id}">${item.referring_provider_first_name} ${item.referring_provider_last_name}</option>`;
                    })
                    $("#" + divId).html(items);
                }
            },
            error: function(response) {
                alert(response.responseJSON.message);
            }
        });
    }

     
    function callInLastDiagnosiCode(){
        var lastDignosiId = $('input[name="work_dg_code_id[]"]').last().attr('id');
         console.log('#lastDignosiId', lastDignosiId);
         $("#" + lastDignosiId).one("change", function() {
            console.log('#callInLastDiagnosiCode', lastDignosiId); 
            addMoreInputsDiagnosisCode();  
        });
    }

    function setUnitCodeOnChangeProcedureCode(event, length) {
        if (event.target.id) {
            console.log('#eventID==', event.target.id);  
            str = event.target.id.split('_');
            let lastId = str[3];
            if ($("#" + event.target.id).val().length > 0) {
                $("#addition_info_icon_" + lastId).removeClass('d-none');
            } else {
                $("#addition_info_icon_" + lastId).addClass('d-none');
                $("#addition_info_div_" + lastId).addClass('d-none'); 
            }
            parentDiv = $("#" + event.target.id).closest('div').parent('div .cloneDiv').attr('id');
            var data = checkprocedureCode(parentDiv);
            console.log('divId#', data.modefiyerId);  
            getCPDCodeBeforeSave(data.injuryId, data.modefiyer, data.prCode, data.divId);
        }
    } 

    function checkprocedureCode(divId) {
        console.log('divId',divId);
        var prCode = null;
        prCode = $("#" + divId + ' input[name="bill_procedure_code[]"]').val();
        prCodeId = $("#" + divId + ' input[name="bill_procedure_code[]"]').attr('id');
        var modefiyer = null;
        modefiyer = $("#" + divId + ' select[name="bill_modifiers[]"]').val();
        modefiyerId = $("#" + divId + ' select[name="bill_modifiers[]"]').attr('id');
        // Return the necessary data
        return {
            modefiyerId: modefiyerId,
            injuryId: injuryId,
            modefiyer: modefiyer,
            prCode: prCode,
            divId: divId
        };
    } 
    function addMoreInputsForProcedureCode() {
         var getLastDiId = $('div .cloneDiv:last').attr('id'); 
        $('.modefierCode').select2("destroy");
        var num = $('.cloneDiv').length;
        console.log('checkLength', num);
        var newNum = new Number(num + 1);
        var cloneId = 'input_' + newNum; 

        var clonedRow = $('div .cloneDiv:last').clone().attr('id', cloneId);
        clonedRow.find('.procedure_code_input').attr('id', 'bill_procedure_code_' + newNum);
        clonedRow.find('.procedure_code_input').one('click', function() {
            addMoreInputsForProcedureCode();
        }); 
        clonedRow.find('.modefierCode').attr('id', 'bill_modifiers' + newNum);
        clonedRow.find('.bill_unit').attr('id', 'bill_units' + newNum);
        clonedRow.find('.bill_diag_codes1').attr('id', 'bill_diag_codes1_' + newNum);
        clonedRow.find('.bill_diag_codes2').attr('id', 'bill_diag_codes2_' + newNum);
        clonedRow.find('.bill_diag_codes3').attr('id', '"bill_diag_codes3_' + newNum);
        clonedRow.find('.bill_diag_codes4').attr('id', 'bill_diag_codes4_' + newNum);

        clonedRow.find('.master_charge_found').attr('id', 'isMasterChargeFound_' + newNum);
        clonedRow.find('.master_charge').attr('id', 'bill_master_charge_id' + newNum); 
        clonedRow.find('.chargeAmt').attr('id', 'bill_master_charge_id' + newNum); 
        clonedRow.find('.addInfoDiv').attr('id', 'addition_info_div_' + newNum);  
        
        clonedRow.find('.procedure_code_ul').attr('id', 'search_bill_procedure_code_' + newNum);
        clonedRow.find('.error_msg').attr('id', 'showDiagCodeError_' + newNum);
        clonedRow.find('.removeBtn').attr('id', 'remove_item_icon_' + newNum);
        clonedRow.find('.removeBtn').on('click', function() {
            removeProcedureCode('remove_item_icon_' + newNum);
        }); 
        hideRemoveIconFromFirstRowInPRocedureCode();
        $('div .cloneDiv:last').after(clonedRow); 
        setModifiyerDop();
    }

    function showAdditionalInfoInput(divId) {
        if ($("#" + divId).hasClass("d-none")) {
            $("#" + divId).removeClass('d-none');
        } else {
            $("#" + divId).addClass('d-none');
        }
    } 
    function setModifiyerDop() {
        $('.select2-original').select2({
            //minimumInputLength: 1,
            width: '100%',
            placeholder: 'Select Modifier',
            search: true,
        })
    } 

    function formatResult(d) {
        if (d.loading) {
            return d.diagnosis_name;
        }
        // Creating an option of each id and text
        $d = $('<option/>').attr({
            'value': d.id
        }).text(d.diagnosis_code + "-" + d.diagnosis_name);
        return $d;
    }

    function formatRepoSelection(val) {
        if (val.text == "") {
            return val.diagnosis_code + "-" + val.diagnosis_name;
        }
    }  
    function checkLastDigonsisCodeForClone() { 
        if ($('#copyDiagnosisCodeId').is(':checked')) { 
            console.log('#diagnosesCodeArray.length', diagnosesCodeArray.length);
            if(diagnosesCodeArray.length > 0 ){
                 var dgCodeValues = $('input[name="work_dg_code_id[]"]').map(function(index, element) {
                    return $(element).val();
                }).get().slice(0, 4);
                console.log('#dgCodeValues', dgCodeValues);
                 $.each(diagnosesCodeArray, function(index, response) { 
                    if(response['diagnosis_code'] != ""){  
                        let dgIndex = dgCodeValues.findIndex(x => parseInt(x) === response['dc_id']);  
                        var inputFieldName = 'bill_diag_codes' + (dgIndex + 1) + '[]'; 
                        $('input[name="' + inputFieldName + '"]').prop('disabled', true); 
                        $('input[name="' + inputFieldName + '"]').val(response['diagnosis_code']);
                    }
                    else{
                        var inputFieldName = 'bill_diag_codes' + (dgIndex + 1) + '[]';
                        $('input[name="' + inputFieldName + '"]').prop('disabled', false);
                        $('input[name="' + inputFieldName + '"]').val("");
                    } 
                }) 
            } 
        } 
        else {
           // var inputFieldName = document.querySelectorAll('input[name^="bill_diag_codes"]');
            //$('input[name="' + inputFieldName + '"]').prop('disabled', false);
            //$('input[name="' + inputFieldName + '"]').val("");

            $('input[name^="bill_diag_codes"]').prop('disabled', false);
            $('input[name^="bill_diag_codes"]').val("");

        } 
    }
   function getAllDignosisCodeByCodeId(dgCodeValues){ 
        $.ajax({
            url: '/matchICDCOdeWithDiagCode',
            type: 'POST',
            data: {
                _token: token,
                dc: dgCodeValues
            },
            success: function(response) { 
                checkIfArrayDataExist(response);
                if ($('input[name=copyDiagnosisCode]').is(':checked')) { 
                  setTimeout(() => { checkLastDigonsisCodeForClone();  }, "1000"); 
                } 
            },
        })
    }

    
    function setUnitCodeOnChangeProcedureCode(event, length) {
        if (event.target.id) {
            //console.log('#setUnitCodeOnChangeProcedureCode', event.target.id);  
            str = event.target.id.split('_'); 
            let lastId =  str[3];
            if($("#"+event.target.id).val().length > 0){ 
                $("#addition_info_icon_" + lastId).removeClass('d-none');
            } 
            else{
                $("#addition_info_icon_" + lastId).addClass('d-none');
                $("#addition_info_div_" + lastId).addClass('d-none');
            }

            parentDiv = $("#" + event.target.id).closest('div').parent('div .cloneDiv').attr('id');
            var data = checkprocedureCode(parentDiv);
            console.log('divId#', data.modefiyerId);
            getCPDCodeBeforeSave(data.injuryId, data.modefiyer, data.prCode, data.divId);
        }
    }
    function checkprocedureCode(divId) {
        var prCode = null;
        prCode = $("#" + divId + ' input[name="bill_procedure_code[]"]').val();
        prCodeId = $("#" + divId + ' input[name="bill_procedure_code[]"]').attr('id'); 
        var modefiyer = null;
        modefiyer = $("#" + divId + ' select[name="bill_modifiers[]"]').val();
        modefiyerId = $("#" + divId + ' select[name="bill_modifiers[]"]').attr('id');
        // Return the necessary data
        return {
            modefiyerId: modefiyerId,
            injuryId: injuryId,
            modefiyer: modefiyer,
            prCode: prCode,
            divId: divId
        };
    }
    function getCPDCodeBeforeSave(injuryId, modefiyer, prCode, divId) {
        $.ajax({
            url: '/searchProcedureCodeForUnit',
            type: 'POST',
            dataType: 'json', // payload is json
            data: {
                _token: token,
                injuryId: injuryId,
                modefiyer: modefiyer,
                prCode: prCode
            },
            success: function (data) {
                if (data.length > 0) {
                    $("#" + divId + ' input[name="master_charge[]"]').removeClass('d-none');
                    $("#" + divId + ' input[name="master_charge_id[]"]').val(data[0]['id']);
                    $("#" + divId + ' input[name="master_charge[]"]').val(data[0]['units']);
                    $("#" + divId + ' input[name="isMasterChargeFound[]"]').val(0);

                } else {
                    $("#" + divId + ' input[name="master_charge[]"]').removeClass('d-none');
                    $("#" + divId + ' input[name="master_charge_id[]"]').val("");
                    //$("#" + divId + ' input[name="master_charge[]"]').val("");
                    $("#" + divId + ' input[name="isMasterChargeFound[]"]').val(1);
                }
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('AJAX Error:', textStatus, errorThrown);
            }

        })
    }
    function callAllDatePicker(){
        $('#bill_dos').bind('change',function(selected,evnt){
            //checkICDCode(injuryId);
        });
        $('#bill_dos').datepicker({
                dateFormat: 'mm/dd/yy',
                changeMonth: true, changeYear: true,
        });
        $('#bill_adminssion_date').datepicker({
            dateFormat: 'mm/dd/yy',
            changeMonth: true, changeYear: true,
        });
        $('#bill_dos_end_date').datepicker({
            dateFormat: 'mm/dd/yy',
            changeMonth: true, changeYear: true,
        });
        $('#dos_end').datepicker({
            dateFormat: 'mm/dd/yy',
            changeMonth: true, changeYear: true,
        });
    }

    function hideRemoveIconFromFirstRowInPRocedureCode(){
        var divLen = $('div .cloneDiv').length;
        var geFirstDiId = $('div .cloneDiv .removeBtn:first').attr('id');  
        if(divLen >= 2 ) {  $("#" + geFirstDiId).addClass('d-none');  } 
        else {  $("#" + geFirstDiId).removeClass('d-none'); }
    }
    function addMoreInputsDiagnosisCode() {   
        var cloneLength = $('.cloneDivDiagnosisCode .work_dg_original:input').length; 
        var newNum =  new Number(cloneLength + 1);
        var parentElement = $('.cloneDivDiagnosisCode:last'); 
        var clone = parentElement.clone().attr('id', 'dio_Code_'+newNum);
        clone.find('.work_dg_original').attr('id', 'work_dg_code_id_'+newNum);
        clone.find('.work_dg_original').select2("destroy");
        console.log('#parentElement', clone);
        clone.children().find('.work_dg_original').select2();
        //$select.select2('destroy').clone().select2(); 
        $('div .cloneDivDiagnosisCode:last').after(clone);
        var eleIdDC = $('input[name="work_dg_code_id[]"]').last().attr('id');
        //console.log('#eleIdDC#', eleIdDC); 
        $("#" + eleIdDC).one("change", function() {
            addMoreInputsDiagnosisCode();
        }); 
        setDignosisCodeByDivId(eleIdDC);
    } 
    
    function removeSelectedOption(event, val) {
        var selectElements = $('select[name="bill_provider_type[]"]');
        selectElements.each(function (index, selectElement) {
            var id = $(selectElement).attr('id');
            if (id !== event.target.id) {
                $("#" + id + " option[value='" + val + "']").remove();
            } else {
                $("#" + id + " option[value='" + val + "']").add();
            }
        })
    }
    function removeProcedureCode(removeIconId){
        console.log('check remoce pc', removeIconId); 
        var divLen = $('div .cloneDiv').length;
        console.log('#divLen', divLen);
        if(divLen > 2 ){ 
             $("#" + removeIconId).closest('div').parent('div').remove(); 
             //addMoreInputsForProcedureCode();
        }  
    } 
    function searchAutoForProcedureCode(e){
        //$('.autoCompete-css').show();  
        let searchPC = e.target.value;
        let searchPCId = e.target.id; 
        console.log('#searchPCId#', searchPCId); 
        $("#"+searchPCId).removeAttr('data-validation-event');
        $("#"+searchPCId).removeAttr('data-validation');  

        let ex = searchPCId.split("_");
        let lastItem = ex[ex.length - 1];
        console.log('#lastItem', lastItem); 
        var pcInputId = 'bill_procedure_code_' + lastItem;
        var ulLiId = 'search_bill_procedure_code_' + lastItem;  
         
         if($("#"+pcInputId).hasClass('error')){ 
            $("#"+pcInputId).removeAttr('data-validation-event');
            $("#"+pcInputId).removeAttr('data-validation'); 
        }

        if(searchPC.length >2){
            $.ajax({
                url: '/searchProcedureCodeForAutoSearch',
                type: 'POST',
                dataType: 'json', // payload is json
                data: {
                    _token: token,
                    injuryId: injuryId, 
                    str: searchPC,
                },
                success: function (data) { 
                    if (data.length > 0) { 
                        var items = "";
                        items += "<li value=''>-Select-</li>";
                        $.each(data, function(i, item) {
                            var pCode = item.procedure_code;
                            items += `<li onclick="chooseSelectedPrcedureCode(event, ${pcInputId},  ${ulLiId},  '${pCode}');" data-id-clicked="${item.id}"  id="${item.id}">` + item.procedure_code + `</li>`;
                        });
                        $("#"+ ulLiId).html(items);
                        $("#"+ ulLiId +'.autoCompete-css').show();  
                    } 
                },
                error: function (jqXHR, textStatus, errorThrown) {
                    console.error('AJAX Error:', textStatus, errorThrown);
                }

            })
        }
    }
    $(document).on('keyup keydown', ".procedure_code_input", function(e) {
        //searchAutoForProcedureCode(e);
    });
    function chooseSelectedPrcedureCode(event, selectedInput, ulLiId, procedure_code) { 
        var selectElementPC = $(selectedInput); 
        var selectElementUL = $(ulLiId);  
         
        $("#"+ selectElementPC.attr('id')).val(procedure_code); 
        $("#"+ selectElementUL.attr('id') +'.autoCompete-css').hide();  
         setTimeout(function() {
                setUnitCodeOnChangeProcedureCode(event, 0);
            }, 3000); 
    }
    function cloneForProviderType() {
        // Get all the div elements with class "providerTypeDiv"
        var $divs = $(".providerTypeDiv");
        // Loop through each div element
        for (var i = 0; i < $divs.length; i++) {
            if (i === 2) {
                $("#addButtonDiv").addClass('d-none');
            }
            // Check if the current div is hidden
            if ($divs.eq(i).hasClass('d-none')) {
                // Show the current div
                $divs.eq(i).removeClass('d-none');
                // Exit the loop
                break;
            }
        }
    } 
    
    function checkSelect2ExistOrNot(divId){
        if (!$("#" +divId).HasSelect2Initiatized){
            setDignosisCodeByDivId(divId);
        } 
    }
    function checkForDCMatchWithDiagonis(){ 
        $('input[name="bill_procedure_code[]"]').each(function (index, element) {
            if ($(element).val() !== '') {
                let selectPCID = $(element).attr('id');  
                let parentDIv = $("#"+selectPCID).parent('div').parent('div').attr('id'); 
                pcAmountId = $("#"+parentDIv).find('.chargeAmt').attr('id'); 
                applyValidationOnInput(pcAmountId, 1);
            } 
        }) 
    }
    function setDignosisCodeByDivId(DivId) { 
        var diagnosesType = $('input[name="diagnosis_code_type"]:checked').val(); 
         let newArr = [];
         if(diCodeForEdit.length > 0){
            for (let i = 0; i < diCodeForEdit.length; i++) { 
                newArr.push(diCodeForEdit[i]);
            }
         } 
         let str = 'Select Diagnosis Code'; 
        $("#" +DivId).select2({
                    width: '100%',
                    placeholder: str,
                    search: true,
                    delay: 250,
                   //data: newArr,
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
                                type: diagnosesType,
                                dcCodeID: <?php echo json_encode($diegonisCodeIDS);?>
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
                }).on('change', function (e) {
                    //var str = $(".work_dg_original .select2-choice span").text(); 
                    //console.log("check on select",this.value);
                    //console.log("check on select str",str); 
                    //console.log("check on e.added", e);
                    let diagnosisCode = 0;
                    if(e && e.added && e.added !== undefined && e.added.diagnosis_code && e.added.diagnosis_code !== undefined){
                        diagnosisCode =  e.added.diagnosis_code
                    }

                    if($.isNumeric(this.value)) {
                        //let parentDivId = $("#"+DivId).parent('div').attr('id');  
                        //let dcErrorId = $("#"+parentDivId).find('.dc_error').attr('id');
                        //if($("#"+dcErrorId).hasClass('help-block form-error')){
                        // $("#"+dcErrorId).removeClass('help-block form-error');
                            //$("#" +dcErrorId).text("");
                        //} 
                        if(diagnosisCode != 0) { dignosisCOdeArr.push(diagnosisCode); }
                    }  
        });  
          if(newArr.length > 0){
             newArr.map(item => {
                //console.error('newArrItem', item);
                 if (dignosisCOdeArr.indexOf(item.diagnosis_code) === -1) {
                     dignosisCOdeArr.push(item.diagnosis_code);
                }
                //$("#" + DivId).val(item.id).trigger('change');
            });
        }
         
    }  
 
    function checkDiagCodesForServices(event, val) { 
        if (val.length >= 1) { 
            console.log('#checkDiagCodesForServices#', dignosisCOdeArr); 
            let ex = event.target.id.split("_"); 
            if(dignosisCOdeArr.length > 0){
                if (ex.length > 0) {
                    console.log('#exexex#', ex);
                    if ($.inArray(val.toUpperCase(), dignosisCOdeArr.map((e) => e.toUpperCase())) == -1) {  
                        $("#showDiagCodeError_" + ex[3]).text("Sorry, this code does not match the ICD code!!!");
                    } else {
                        $("#showDiagCodeError_" + ex[3]).text(''); 
                    } 
                }
            }  
        } 
    }
    
    function applyValidationOnInput(inputId, checkDisplay){
        if($("#"+ inputId).val().trim() === ''){
            if(checkDisplay != null){
                if ($("#"+ inputId).hasClass('d-none')) {
                $("#"+inputId).removeClass('d-none');
                } 
            } 
            $("#"+inputId).attr('data-validation-event', 'change');
            $("#"+inputId).attr('data-validation','required');  
            //$("#"+inputId).attr('data-validation-regexp', '^(?:\d+|\d+\.\d+)$'); 
        }
        else{
            $("#"+inputId).removeAttr('data-validation-event');
            $("#"+inputId).removeAttr('data-validation'); 
            //$("#"+inputId).removeAttr('data-validation-regexp'); 
        }
    }

    function checkAndHandleInput(inputId) {
         if ($.inArray($("#" + inputId).val().toUpperCase(), dignosisCOdeArr.map((e) => e.toUpperCase())) == -1) {
            //$("#" + inputId).val('');
            applyValidationOnInput(inputId, null);
        } 
    }
    function checkdcValWithDcDropDown(){
        //checking for diogonis code inputs
         $('input[name="bill_procedure_code[]"]').each(function (index, element) {
            let selectPCID = $(element).attr('id');  
            let parentDIv = $("#"+selectPCID).parent('div').parent('div').attr('id'); 
            if ($(element).val() !== '') { 
                dcCode1 = $("#"+parentDIv).find('.bill_diag_codes1').attr('id');
                dcCode2 = $("#"+parentDIv).find('.bill_diag_codes2').attr('id');
                dcCode3 = $("#"+parentDIv).find('.bill_diag_codes3').attr('id');
                dcCode4 = $("#"+parentDIv).find('.bill_diag_codes4').attr('id');
                checkFourDcDoesNotMatch(dcCode1,dcCode2,dcCode3,dcCode4); 
                if(dignosisCOdeArr.length > 0){
                    checkAndHandleInput(dcCode1);
                    checkAndHandleInput(dcCode2);
                    checkAndHandleInput(dcCode3);
                    checkAndHandleInput(dcCode4);
                }  
            } 
        }) 
    }
    function checkFourDcDoesNotMatch(val1,val2,val3,val4){ 
        //console.log('checking for match values#checkFourDcDoesNotMatch');
        var values = [val1, val2, val3, val4];
        for (var i = 0; i < values.length; i++) {
            for (var j = i + 1; j < values.length; j++) {
                if ($("#" + values[i]).val() === $("#" + values[j]).val()) {
                   $("#" + values[i]).val('');
                    $("#" + values[j]).val('');
                }
            }
        }
    }
    function deleteDCCodeForThisBill(billId){
        $.ajax({
            url: '/delete/bill/diagonisis',
            type: 'POST',
             data: {
                _token: token,
                billId: billId, 
            },
            success: function (data) { 
                location.reload();
            },
            error: function (jqXHR, textStatus, errorThrown) {
                console.error('AJAX Error:', textStatus, errorThrown);
            }

        })
    }
</script>
