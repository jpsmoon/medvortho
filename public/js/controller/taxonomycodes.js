// Get the modal
var addModal = document.getElementById("addModal");
var editModal = document.getElementById("editModal");
// Get the button that opens the modal
var btn = document.getElementById("myBtn");
// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

function show_addmodal(){
    addModal.style.display = "block";
}
function show_editmodal(){
    editModal.style.display = "block";
}
function hide_modal(){
    addModal.style.display = "none";
    editModal.style.display = "none";
}

$('#SubmitForm').on('submit',function(e){
    e.preventDefault();
        var name = $('#name').val();
        var code = $('#code').val();
        let _url     = '/taxonomycodes';      //$('#SubmitForm').attr('action');
        let _token   = $('meta[name="csrf-token"]').attr('content');
        console.log('_token#',_token);
        $.ajax({
            url: _url,
            method: "POST",
            data: {
                name: name,
                code: code,
                _token: _token      //"{{ csrf_token() }}"
            },
            success: function(data) { 
                console.log('texonomyCode#',data);
                 location.reload();
            },
            error: function(response) {  
                alert(response.responseJSON.message);
            }
        });
});

function editTodo(item) { 
     $("#code_id").val(item.id);
    $("#editname").val(item.name);
    $("#editcode").val(item.code);
    //show_editmodal();
}


function updateTodo() {
    var name = $('#editname').val();
    var code = $('#editcode').val();
    var id = $('#code_id').val();
    let _url     = '/taxonomycodes/update';
    let _token   = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: _url,
        type: "POST",
        data: {
            name: name,
            code: code,
            code_id: id,
            _token: _token
        },
        success: function(data) {  
             location.reload();
        },
        error: function(response) {  
            alert(response.responseJSON.message);
        }
    });
}

function deleteTodo(id) {     
    let _url     = `/taxonomycodes/${id}`;
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
                $("#todo_"+id+" td:nth-child(4)").html('Block');
                $("#todo_"+id+" td:nth-child(5)").html(`<a data-id="${id}" class="btn btn-success" onclick="restoreTodo(${id})">Restore</a>`);
            },
            error: function(response) {  
                alert(response.responseJSON.message);
            }
        });
    }
}

function restoreTodo(id) {     
    let _url     = `/taxonomycodes/restore/${id}`;
    if(confirm("Are You sure ?")){   
        let token   = $('meta[name="csrf-token"]').attr('content');
        
        $.ajax({
            url: _url,
            type: 'POST',
            data: {
            _token: token
            },
            success: function(response) { console.log(response);
                $("#todo_"+id+" td:nth-child(4)").html('Active');                
                $("#todo_"+id+" td:nth-child(5)").html(`<a data-id="${id}" onclick="editTodo(${id})" class="btn btn-primary">Edit</a>
                <a data-id="${id}" class="btn btn-danger" onclick="deleteTodo(${id})">Delete</a>`);
            },
            error: function(response) {  
                alert(response.responseJSON.message);
            }
        });
    }
}
function deleteTCode(id) { 
    swal.fire({
        title: 'Are you sure you want to delete?',
        text: "You won't be able to revert this!",
        showCancelButton: true,
        confirmButtonColor: '#3085D6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Delete it!',
        customClass: {
            confirmButton: "btn btn-primary",
            cancelButton: "btn btn-danger",
            popup: 'swal-wide',
        }
    }).then((result) => { // Use .then() to handle the user's response
        if (result.isConfirmed) { // Only proceed if the user clicked the confirm button
            let _url     = `/taxonomycodes/delete`;
            $.ajax({
                url: _url,
                type: 'POST',
                data: {
                    _token: token,
                    id:id
                },
                success: function(response) {
                    swal.fire({
                        title: 'Taxonumy code has been deleted', 
                        customClass: {
                            successButton: "btn btn-primary",
                            popup: 'swal-wide',
                        }
                    });
                    location.reload();
                },
                error: function(response) {
                    swal.fire(response.responseJSON.message, '', 'error');
                }
            });
        }
    });
}
