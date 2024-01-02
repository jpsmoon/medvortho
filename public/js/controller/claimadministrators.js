var license_idx = rfa_idx = mail_idx =  0;
function addReviewCtrl(last_index = 1){
    if(license_idx){
        license_idx += 1;
    }else   license_idx += last_index;
    if(document.getElementById('row'+license_idx)){
        document.getElementById('row'+license_idx).style.display ='table-row';
    }    
    if(license_idx == 5){  
        document.getElementById('addOption').style.display ='none';
    }
}
function addRfaCtrl(last_index = 1){
    if(rfa_idx){
        rfa_idx += 1;
    }else  rfa_idx += last_index;
    if(document.getElementById('rfa'+rfa_idx)){
        document.getElementById('rfa'+rfa_idx).style.display ='table-row';
    }    
    if(rfa_idx == 5){        
        document.getElementById('addRfaOption').style.display ='none';
    }
}
function addMailCtrl(last_index = 1){
    if(mail_idx){
        mail_idx += 1;
    }else  mail_idx += last_index;
    if(document.getElementById('mail'+mail_idx)){
        document.getElementById('mail'+mail_idx).style.display ='table-row';
    }    
    if(mail_idx == 5){        
        document.getElementById('addMailOption').style.display ='none';
    }
}
function removeCtrl(idx){
    if(document.getElementById(idx)){
        // document.getElementById(idx).innerHTML ='';
        //document.getElementById(idx).style.display ='none';
        document.getElementById(idx).remove(); 
    }
}
function save_claim(step, formIndex){
    let _url     = '/claimadministrators';
    let frmdata =  $('#'+formIndex).serialize();
    //console.log(frmdata);
    $.ajax({
        url: _url,
        /*headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},*/
        method: "POST",
        data: frmdata,
        success: function(data) { console.log(data);
            window.location.href = '/claimadministrators';
            // if(step == 'nav-main'){
            //     document.getElementById('claim_admin_id').value = data.claim_admin_id;
            //     resetActive('', 0, 'bill-review',step,'bill-review-tab','nav-main-tab');

            // }else if(step == 'bill-review'){
            //     document.getElementById('claim_admin_step3').value = parseInt(data.claim_admin_id);
            //     resetActive('', 0, 'authorisation-tab', step, 'authorised-tab','bill-review-tab');

            // }else if(step == 'authorisation-tab'){
            //     document.getElementById('claim_admin_step4').value = parseInt(data.claim_admin_id);
            //     resetActive('', 0, 'mailing-address',step, 'mailing-address-tab','authorised-tab');
            // }else if(step == 'mailing-address'){
            //     alert(data.message);
            //     window.location.href = '/claimadministrators';
            // }
        },
        error: function(response) { console.log(response);
            alert(response.responseJSON.message);
        }            
    });
}
function edit_claim(step, formIndex){
    let id = $('#claimadministrator_id').val();
    let _url     = `/claimadministrators/${id}`;
    let frmdata =  $('#'+formIndex).serialize();
    //console.log(frmdata);

    $.ajax({
        url: _url,
        /*headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},*/
        method: "PUT",
        data: frmdata,
        success: function(data) { console.log(data);
            if(step == 'nav-main'){
                document.getElementById('claim_admin_id').value = data.claim_admin_id;
                resetActive('', 0, '2');

            }else if(step == 'bill-review'){
                document.getElementById('claim_admin_step3').value = parseInt(data.claim_admin_id);
                resetActive('', 0, '3');

            }else if(step == 'authorisation-tab'){
                document.getElementById('claim_admin_step4').value = parseInt(data.claim_admin_id);
                resetActive('', 0, '4');
            }else if(step == 'mailing-address'){
                alert(data.message);
                window.location.href = '/claimadministrators';
            }
        },
        error: function(response) { console.log(response);
            alert(response.responseJSON.message);
        }            
    });
}
function deleteTodo(id) {     
    let _url     = `/claimadministrators/${id}`;
    if(confirm("Are You sure ?")){   
        let token   = $('meta[name="csrf-token"]').attr('content');
        
        $.ajax({
            url: _url,
            type: 'DELETE',
            data: {
            _token: token
            },
            success: function(response) { console.log(response);
                window.location.href = '/claimadministrators';
            },
            error: function(response) {  
                alert(response.responseJSON.message);
            }
        });
    }
}

function restoreTodo(id) {     
    let _url     = `/claimadministrators/restore/${id}`;
    if(confirm("Are You sure ?")){   
        let token   = $('meta[name="csrf-token"]').attr('content');
        
        $.ajax({
            url: _url,
            type: 'POST',
            data: {
            _token: token
            },
            success: function(response) { console.log(response);
                $("#todo_"+id+" td:nth-child(6)").html('Active');                
                $("#todo_"+id+" td:nth-child(7)").html(`<a data-id="${id}" href="{{ route('claimadministrators.edit',$id) }}" class="btn btn-primary">Edit</a>
                <a data-id="${id}" class="btn btn-danger" onclick="deleteTodo(${id})">Delete</a>`);
            },
            error: function(response) {  
                alert(response.responseJSON.message);
            }
        });
    }
}


