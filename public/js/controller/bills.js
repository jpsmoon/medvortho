
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
//
$(document).ready(function () {
        checkICDCode(injuryId);

    $('#bill_dos').bind('change',function(selected,evnt){
    // someFunction();
     //setICDCheckBox($(this).val());
        checkICDCode(injuryId);
    });
    $('#bill_dos').datepicker({
            dateFormat: 'mm/dd/yy',
            changeMonth: true, changeYear: true,
        //     onSelect: function(selected,evnt) {
        //         setICDCheckBox(selected);
        //   },
        //   onClose:function(selected,evnt){             
        //      setICDCheckBox(selected);
        //  }
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
    $("#providerDiv_1").find("#removeDivId_1").remove();
    $("#input_1").find("#remove_item_icon_1").remove();
    for (var i = 0; i < cnt; i++) {
        //console.log('arrayList', arrayList[i]);
        var selectedVal = arrayList[i];
        getReferningProvider(selectedVal, injuryId, 'bill_provider_name_' + i, 'providerNameDiv_' + i);
    }
    $('.remove').on('click', function () {
        var num = $('.cloneDiv').length;
        $(this).closest('div').parent('div').remove();
        checkLastIdForProcedureCodeClone();
    });
    var lastCloneDCDivId = $('div .diagnosisCodeSelect:last').attr('id');
    console.log('lastCloneDCDivId', lastCloneDCDivId);
    $(document).on('change', "#" + lastCloneDCDivId, function () {
        checkLastDigonsisCodeForClone();
    });
})



$(document).on('click', '.remove', function () {
    $(this).closest('div').parent('div').remove();
});

window.onload = function afterWebPageLoad() {
    addSelect2InAddedFeilds();
    checkLastIdForProcedureCodeClone();
    checkLastDigonsisCodeForClone();
};

function checkLastDigonsisCodeForClone() {
    //new code for last select change
    //var totalSelects = $('.addedSelect').length;
    var totalSelects = $('.diagnosisCodeSelect').length;
    console.log('#totalSelects', totalSelects);
    var counter = 0;
    $('select[name="work_dg_code_id[]"]').each(function (index, item) {
        if (item && item.value !== "") {
            console.log('check item value', item.value);
            callDignosCos(item);
            counter++;
        }
    });
    if (counter === totalSelects) {
        console.log('match value selected', totalSelects);
        console.log('counter selected', counter);
        // Last select element has been changed within the loop
        addMoreInputsDiagnosisCode();
    }
}

function callDignosCos(item) {
    $.ajax({
        url: '/matchICDCOdeWithDiagCode',
        type: 'POST',
        data: {
            _token: token,
            dc: item.value
        },
        success: function (response) {
            diagnosesCodeArray.push(response);
        },
    })
}


function deleteProviderNameIndex(providerId) {
    var spanId = $(providerId).attr('id').split('_');
    if (spanId.length > 0) {
        $("#providerDiv_" + spanId[1]).remove();
        var num = $('.cloneDivProviderTypeDiv').length;
        if (num >= 2) {
            $("#addButtonDiv").addClass('d-none');
        }
        else {
            $("#addButtonDiv").removeClass('d-none');
        }
    }
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

//procedure clone code start here
function checkLastIdForProcedureCodeClone() {
    var lastCloneDivId = $('div .procedure_code_input:last').attr('id');
    console.log('#lastCloneDivId', lastCloneDivId);
    $("#" + lastCloneDivId).one("change", function () {
        addMoreInputsForProcedureCode();
    });
}
function addMoreInputsForProcedureCode() {
    var getLastDiId = $('div .cloneDiv:last').attr('id'); 
    let billProcedureCode = $("#" + getLastDiId + ' input[name="bill_procedure_code[]"]').val();
    let billModifiers = $("#" + getLastDiId + ' input[name="bill_modifiers[]"]').val();
    let billUnits = $("#" + getLastDiId + ' input[name="bill_units[]"]').val();
    let billDiagCodes1 = $("#" + getLastDiId + ' input[name="bill_diag_codes1[]"]').val();
    let billDiagCodes2 = $("#" + getLastDiId + ' input[name="bill_diag_codes2[]"]').val();
    let billDiagCodes3 = $("#" + getLastDiId + ' input[name="bill_diag_codes3[]"]').val();
    let billDiagCodes4 = $("#" + getLastDiId + ' input[name="bill_diag_codes4[]"]').val();

    if (billProcedureCode != "" && billModifiers != "" && billUnits != "" && billDiagCodes1 != "" &&
        billDiagCodes2 != "" && billDiagCodes3 != "" && billDiagCodes4 != "") {
        var num = $('.cloneDiv').length;
        var newNum = new Number(num + 1);
        var cloneId = 'input_' + newNum;
        var clonedRow = $('div .cloneDiv:last').clone().attr('id', cloneId);
        clonedRow.find('.procedure_code_input').attr('id', 'bill_procedure_code_' + newNum);
        clonedRow.find('.modefierCode').attr('id', 'billModifiersId_' + newNum);
        clonedRow.find('.bill_unit').attr('id', 'bill_units' + newNum);
        clonedRow.find('.bill_diag_codes1').attr('id', 'bill_diag_codes1' + newNum);
        clonedRow.find('.bill_diag_codes2').attr('id', 'bill_diag_codes2' + newNum);
        clonedRow.find('.bill_diag_codes3').attr('id', 'bill_diag_codes3' + newNum);
        clonedRow.find('.bill_diag_codes4').attr('id', 'bill_diag_codes4' + newNum);
        //clonedRow.find('input').attr('id', 'inputBox_' + newNum);

        //clonedRow.find('select').attr('id', 'inputModefier_' + newNum);
        // clonedRow.find("span.select2 ").remove();
        // clonedRow.find("select").select2();

        $('div .cloneDiv:last').after(clonedRow);
        var eleId = cloneId;
        $("#" + eleId + " .procedure_code_input").one("click", function () {
            addMoreInputsForProcedureCode();
        });
    }
}
function showAdditionalInfoInput(divId){ 
    if ( $("#"+divId).hasClass("d-none")) {
         $("#"+divId).removeClass('d-none');
   } 
   else{
     $("#"+divId).addClass('d-none');
   }
}
function setUnitCodeOnChangeProcedureCode(event, length) {
    if (event.target.id) {
        console.log('#eventID', event.target.id);
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
                $("#" + divId + ' input[name="master_charge[]"]').addClass('d-none');
                console.log('data found', data[0]['id']);
                $("#" + divId + ' input[name="master_charge_id[]"]').val(data[0]['id']);
                $("#" + divId + ' input[name="master_charge[]"]').val(data[0]['units']);
                $("#" + divId + ' input[name="isMasterChargeFound[]"]').val(0);

            } else {
                $("#" + divId + ' input[name="master_charge[]"]').removeClass('d-none');
                $("#" + divId + ' input[name="master_charge_id[]"]').val("");
                $("#" + divId + ' input[name="master_charge[]"]').val("");
                $("#" + divId + ' input[name="isMasterChargeFound[]"]').val(1);
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error('AJAX Error:', textStatus, errorThrown);
        }

    })
}
function checkDiagCodesForServices(event, val) {
    console.log('#event', event.target.id);
    if (val.length >= 2) {
        let arrayIndex = $.inArray(val.toLowerCase(), diagnosesCodeArray);
        // console.log('#arrayIndex', arrayIndex);
        // console.log('#diagnosesCodeArray', diagnosesCodeArray);
        let ex = event.target.id.split("_");
        if (arrayIndex === -1) {
            if (ex.length > 0) {
                $("#showDiagCodeError_" + ex[1]).text("Sorry, this code does not match the ICD code");
                // setTimeout(function () {
                //     $("#showDiagCodeError_" + ex[1]).text('');
                //     //$("#"+event.target.id).val(" ");
                // }, 3000);
            }
        }
        else{
            $("#showDiagCodeError_" + ex[1]).text('');
        }
    }
}
//procedure clone code end here

//Diagnosis codes clone code start here
// function addMoreInputsDiagnosisCode() {
//     var getLastDCDiId = $('div .cloneDivDiagnosisCode:last').attr('id');
//     console.log('#getLastDiId', getLastDCDiId);
//     var numDC = $('.cloneDivDiagnosisCode').length;
//     var newNumDC = new Number(numDC + 1);
//     var cloneDCId = 'dio_Code_' + newNumDC;
//     var clonedRowDC = $('div .cloneDivDiagnosisCode:last').clone().attr('id', cloneDCId);
//     clonedRowDC.children("select").select2("destroy");
//     clonedRowDC.find('select').attr('id', 'work_dg_code_id_' + newNumDC);
//     $('div .cloneDivDiagnosisCode:last').after(clonedRowDC);
//     var eleIdDC = cloneDCId;
//     console.log('#eleIdDC', eleIdDC);
//     $("#" + eleIdDC + " .diagnosisCodeSelect").one("change", function() {
//     addMoreInputsDiagnosisCode();
//     });
// }

///////////////////////////////////////////////////////////////////////////////////////

// function addMoreInputsDiagnosisCode() {
//     var getLastDCDiId = $('div .cloneDivDiagnosisCode:last').attr('id');
//     console.log('#getLastDiId', getLastDCDiId);
//     var numDC = $('.cloneDivDiagnosisCode').length;
//     var newNumDC = numDC + 1;
//     var cloneDCId = 'dio_Code_' + newNumDC;
//     var selectedTagId = 'work_dg_code_id_' + newNumDC;
//   }
  function addMoreInputsDiagnosisCode() {
    var numDC = $('.cloneDivDiagnosisCode').length;
    var newNumDC = numDC + 1;
    var selectedTagId = '#work_dg_code_id_' + newNumDC;
    var cloneDCId = 'dio_Code_' + newNumDC;
    var getLastDCDiId = $('div .cloneDivDiagnosisCode:last').attr('id');
    console.log('getLastDCDiId', getLastDCDiId);
    $('#diagnosesDiv3').append('<div class="form-group col-md-3 cloneDivDiagnosisCode" id="dio_Code_'+newNumDC+'">'+
    '  <label for="diagnoses_code1">   &nbsp;   </label>'+
    ' <select name="work_dg_code_id[]" class="form-control diagnosisCodeSelect diagnosesCode" id="work_dg_code_id_'+newNumDC+'">'+
    '</select></div>');
    //setSelect2ForFIlter();
    setSelect2ForFIlter(selectedTagId, []);
    var eleId = cloneDCId;
    console.log('#eleId', eleId);
    $("#" + eleId + " .diagnosisCodeSelect").one("change", function() {
    addMoreInputsDiagnosisCode();
    });
  }
  
  
  

//Diagnosis codes code end here


function addSelect2InAddedFeilds(){
    //console.log('#arrayFromPHP', arrayFromPHP);
    let idNum = 1;
    for (let i = 0; i < arrayFromPHP.length; i++) {
        let newArr = [];
        newArr.push(arrayFromPHP[i]);
        var selectedTagId = '#work_dg_code_id_' + idNum;
        setSelect2ForFIlter(selectedTagId, newArr);
        idNum++;
    }
 }
 
 function applyBillingTemplate(){
    let templateId = $("#bill_template").val();
    console.log("templateId", templateId);
    $.ajax({
        url: '/get/template/service/item',
        type: 'POST',
        data: {
            _token: token,
            templateId: templateId
        },
        success: function(data) {
            console.log('data#', data);
             if (data.length > 0) {
                var items = "";
                let fieldsetId = 'cloneDivStr'; // Replace with your actual fieldset ID
                let divIds = $('#' + fieldsetId).closest('div').find('.cloneDiv').map(function() {
                return this.id;
                }).get();  
                console.log('#divIds', divIds); 
                if(divIds.length != data.length){
                    let leftLength = data.length - divIds.length;
                    addMoreProcedureCodeDivBasedOnBillingTemplate(leftLength);
                }
                setTimeout(function() {
                    buindDataInProcedureCodesDiv(data);
                }, 2000); 

            }  
        },
    })
    function addMoreProcedureCodeDivBasedOnBillingTemplate(numberOfItem) {
        var getLastDiId = $('div .cloneDiv:last').attr('id');  
        for($i = 1 ; $i <= numberOfItem; $i++){
            var num = $('.cloneDiv').length;
            var newNum = new Number(num + 1);
            var cloneId = 'input_' + newNum;
            var clonedRow = $('div .cloneDiv:last').clone().attr('id', cloneId);
            clonedRow.find('.procedure_code_input').attr('id', 'bill_procedure_code_' + newNum);
            clonedRow.find('.modefierCode').attr('id', 'billModifiersId_' + newNum);
            clonedRow.find('.bill_unit').attr('id', 'bill_units' + newNum);
            clonedRow.find('.bill_diag_codes1').attr('id', 'bill_diag_codes1' + newNum);
            clonedRow.find('.bill_diag_codes2').attr('id', 'bill_diag_codes2' + newNum);
            clonedRow.find('.bill_diag_codes3').attr('id', 'bill_diag_codes3' + newNum);
            clonedRow.find('.bill_diag_codes4').attr('id', 'bill_diag_codes4' + newNum); 
            $('div .cloneDiv:last').after(clonedRow);
        } 
    }
    function buindDataInProcedureCodesDiv(data){
        let fieldsetId = 'cloneDivStr'; // Replace with your actual fieldset ID
            let divIds = $('#' + fieldsetId).closest('div').find('.cloneDiv').map(function() {
            return this.id;
        }).get();  

        divIds.map(function(divId, index) {
            $('#' + divId).find('.procedure_code_input').val(data[index]['procedure_code']);
            if(data[index]['modifiers_id']){
                $('#' + divId).find('.modefierCode option[value="' + data[index]['modifiers_id'] + '"]').prop('selected', true);
            } 
            $('#' + divId).find('.bill_unit').val(data[index]['units']);
        })
    } 
 }
 
// for select2 drop down code start here
function setSelect2ForFIlter(tagId= null, newArr = null){
    if(tagId != null){
        $(tagId).select2({
            width: '100%',
            placeholder: 'Select',
            closeOnSelect: true,
            data: newArr,
            ajax: {
                url: "/searchDiagnosis",
                //dataType: 'json',
                type: "POST",
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term, // search term
                        page: params.page,
                        _token: token,
                        type: $('input[name=diagnosis_code_type]:checked').val(),
                    };
                },
                processResults: function (data) {
                    // Tranforms the top-level key of the response object from 'items' to 'results'
                    var results = [];
                    //var arrayFromPHP = <?php echo json_encode($diagnoses); ?>;
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
                },
            },
            cache: true,
            templateResult: formatResult,
            templateSelection: formatRepoSelection,
        });
    }else{
         $(".diagnosesCode").select2({
            width: '100%',
            placeholder: 'Select',
            closeOnSelect: true,
            data: newArr,
            ajax: {
                url: "/searchDiagnosis",
                //dataType: 'json',
                type: "POST",
                delay: 250,
                data: function (params) {
                    return {
                        q: params.term, // search term
                        page: params.page,
                        _token: token,
                        type: $('input[name=diagnosis_code_type]:checked').val(),
                    };
                },
                processResults: function (data) {
                    // Tranforms the top-level key of the response object from 'items' to 'results'
                    var results = [];
                    //var arrayFromPHP = <?php echo json_encode($diagnoses); ?>;
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
                },
            },
            cache: true,
            templateResult: formatResult,
            templateSelection: formatRepoSelection,
        });
    }
}
// for select2 drop down code end here
function setICDCheckBox(selectedDate){
    console.log('#selectedDate',selectedDate);
    let previousDate =  '10/01/2015';
    if(new Date(selectedDate)  <= new Date(previousDate)){
        //CurrentDate is more than SelectedDate
        console.log('if condition');
        $("#icdId").text('ICD-9');
        $("input[name=diagnosis_code_type][value=" + '9' + "]").prop('checked', true);
    } else{
        $("#icdId").text('ICD-10');
        $("input[name=diagnosis_code_type][value=" + '10' + "]").prop('checked', true);
    }
    setSelect2ForFIlter( null, null);
}
function checkICDCode(injuryId){
    console.log('#injuryId', injuryId);
    var dos = $("#bill_dos").val();
     $.ajax({
        url: '/checkICDForBill',
        type: 'POST',
        data: { _token: token,  injuryId:injuryId, dos : dos },
        success: function(response) {
            console.log('#response', response['successStatus']);
            if(response['errorStatus'] == null){
                if(response['icdCode'] == 10){
                    $("#icdId").text('ICD-10');
                    $("input[name=diagnosis_code_type][value=" + '10' + "]").prop('checked', true);
                }
                else{
                    $("#icdId").text('ICD-9');
                    $("input[name=diagnosis_code_type][value=" + '9' + "]").prop('checked', true);
                }
            } 
            else{
                //$("#icdId").attr("data-validation","required");
                //$("#bill_dos").val(" ");
                $("#bill_dos").addClass("input-icons has-error");
                $("#showInjuryDateError").css("display", "block");
            }
        },
        error: function(response) {
            alert(response.responseJSON.message);
        }
    });
}