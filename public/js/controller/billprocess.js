function save_bill_process(step, formIndex){
    let _url     = '/billprocess';
    let frmdata =  $('#'+formIndex).serialize();
    //console.log(frmdata);
    $.ajax({
        url: _url,
        /*headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},*/
        method: "POST",
        data: frmdata,
        success: function(data) { console.log(data);
            if(step == 'step1'){
                document.getElementById('patient_id').value = data.patient_id;
                resetActive('', 0, '2');

            }else if(step == 'step2'){
                document.getElementById('claim_admin_step3').value = parseInt(data.claim_admin_id);
                resetActive('', 0, '3');

            }else if(step == 'step3'){
                document.getElementById('claim_admin_step4').value = parseInt(data.claim_admin_id);
                resetActive('', 0, '4');
            }else if(step == 'step4'){
                alert(data.message);
                window.location.href = '/claimadministrators';
            }
        },
        error: function(response) { console.log(response);
            alert(response.responseJSON.message);
        }            
    });
}