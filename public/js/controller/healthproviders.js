function show_entity_type(){
    var frmvalue = $('input[name="entity_type"]:checked').val();  
    //alert(frmvalue);
    switch(frmvalue){
        case 'Person':
            document.getElementById('nonperson_entity').style.display = 'none';
            document.getElementById('person_entity').style.display = 'flex';
            break;
        case 'Non-Person':
            document.getElementById('person_entity').style.display = 'none';
            document.getElementById('nonperson_entity').style.display = 'flex';
            break;
        default://  alert('do nothing');
    }    
}
var license_idx = 0;
function addLicenseCtrl(last_index = 1){
    if(license_idx){
        license_idx += 1;
    }else license_idx += last_index;
    if(document.getElementById('licenseDiv'+license_idx)){
        document.getElementById('licenseDiv'+license_idx).style.display ='flex';
    }    
    if(license_idx == 10){        
        document.getElementById('addOption').style.display ='none';
    }
}
function removeCtrl(idx){
    if(document.getElementById('licenseDiv'+idx)){
        document.getElementById('licenseDiv'+idx).innerHTML ='';
        document.getElementById('licenseDiv'+idx).style.display ='none';
    }
}
function deleteTodo(id) {     
    let _url     = `/healthproviders/${id}`;
    if(confirm("Are You sure ?")){   
        let token   = $('meta[name="csrf-token"]').attr('content');
        
        $.ajax({
            url: _url,
            type: 'DELETE',
            data: {
            _token: token
            },
            success: function(response) { console.log(response);
                //$("#todo_"+id).remove();
                //alert(response.message);
                $("#todo_"+id+" td:nth-child(5)").html('Block');
                $("#todo_"+id+" td:nth-child(6)").html(`<a data-id="${id}" class="btn btn-success" onclick="restoreTodo(${id})">Restore</a>`);
            },
            error: function(response) {  
                alert(response.responseJSON.message);
            }
        });
    }
}

function restoreTodo(id) {     
    let _url     = `/healthproviders/restore/${id}`;
    if(confirm("Are You sure ?")){   
        let token   = $('meta[name="csrf-token"]').attr('content');
        
        $.ajax({
            url: _url,
            type: 'POST',
            data: {
            _token: token
            },
            success: function(response) { console.log(response);
                $("#todo_"+id+" td:nth-child(5)").html('Active');                
                $("#todo_"+id+" td:nth-child(6)").html(`<a data-id="${id}" href="{{ route('healthproviders.edit',$id) }}" class="btn btn-primary">Edit</a>
                <a data-id="${id}" class="btn btn-danger" onclick="deleteTodo(${id})">Delete</a>`);
            },
            error: function(response) {  
                alert(response.responseJSON.message);
            }
        });
    }
}

$('#SubmitForm').on('submit',function(e){
    e.preventDefault();
        var diagnosis_name = $('#diagnosis_name').val();
        var diagnosis_code = $('#diagnosis_code').val();
        let _url     = 'diagnosiscodes';      //$('#SubmitForm').attr('action');
        let _token   = $('meta[name="csrf-token"]').attr('content');
        
        $.ajax({
            url: _url,
            method: "POST",
            data: {
                diagnosis_name: diagnosis_name,
                diagnosis_code: diagnosis_code,
                _token: _token      //"{{ csrf_token() }}"
            },
            success: function(data) { //console.log(data);
                    todo = data.records;
                    $('table tbody').append(`
                        <tr id="todo_${todo.id}">
                            <td>${todo.id}</td>
                            <td>${ todo.diagnosis_name }</td>
                            <td>${ todo.diagnosis_code }</td>
                            <td>Active</td>
                            <td>
                                <a data-id="${ todo.id }" onclick="editTodo(${todo.id})" class="btn btn-primary">Edit</a>
                                <a data-id="${todo.id}" class="btn btn-danger" onclick="deleteTodo(${todo.id})">Delete</a>
                            </td>
                        </tr>
                    `);
                    //alert(data.message);
                    $('#diagnosis_name').val(''); $('#diagnosis_code').val('');    hide_modal();
            },
            error: function(response) { console.log(response);
                alert(response.responseJSON.message);
               // $('#taskError').text(response.responseJSON.errors.todo);
            }
        });
});

function updateTodo() {
    var diagnosis_name = $('#editdiagnosis_name').val();
    var diagnosis_code = $('#editdiagnosis_code').val();
    var id = $('#diagnosis_code_id').val();
    let _url     = `/diagnosiscodes/${id}`;
    let _token   = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: _url,
        type: "PUT",
        data: {            
            diagnosis_name: diagnosis_name,
            diagnosis_code: diagnosis_code,
            _token: _token
        },
        success: function(data) {  //console.log(data);
                todo = data.records;
                $("#todo_"+id+" td:nth-child(2)").html(todo.diagnosis_name);
                $("#todo_"+id+" td:nth-child(3)").html(todo.diagnosis_code);
                $('#diagnosis_code_id').val('');
                $('#editdiagnosis_name').val('');
                $('#editdiagnosis_code').val('');
               
                //alert(data.message); 
                hide_modal();
        },
        error: function(response) {  console.log(response);
            alert(response.responseJSON.message);
            //$('#taskError').text(response.responseJSON.errors.todo);
        }
    });
}