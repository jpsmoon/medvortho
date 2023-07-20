function save_patient_injury(step, formIndex){
    //window.location.href = "/patients/1";   return
    let _url     = '/patientinjuries';
    let frmdata =  $('#'+formIndex).serialize();
    //console.log(frmdata);
    $.ajax({
        url: _url,
        method: "POST",
        data: frmdata,
        success: function(data) { //console.log(data);
            if(data.success == 1){
                alert(data.message);                    
                window.location.href = "/patients/"+data.patient_id;                
            }else{
                alert(data.message);                 
            }
        },
        error: function(response) { //console.log(response);
            alert(response.responseJSON.message);
        }            
    });
}

function view_patient_injury(injury_id){    //console.log('injury id '+injury_id);
    let _url     = '/patientinjuries/'+injury_id;
    $.ajax({
        url: _url,
        method: "GET",
        success: function(data) { //console.log(data);
            //alert(data.message);
            document.getElementById('view_injury_info').innerHTML = data.html;
            show_content('view_injury_info');               
            document.getElementById('injuryOptions').innerHTML = data.options;
            document.getElementById('injury_id').value = data.injury_id;
            document.getElementById('patient_id').value = data.patient_id;
            let i = 1;
            for( key in data.diagnoses ){
                $('#diagnose_code_id'+i).val(data.diagnoses[key].diagnosis_code_id);
                i++;
            }

        },
        error: function(response) { //console.log(response);
            alert(response.responseJSON.message);
        }            
    });
}
