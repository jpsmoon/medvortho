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

// When the user clicks anywhere outside of the modal, close it
// window.onclick = function(event) {
//   if (event.target == modal) {
//     modal.style.display = "none";
//   }
// }
$('#SubmitForm').on('submit',function(e){
    e.preventDefault();
        let mpn_no = $('#mpn_no').val();
        let applicant_name = $('#applicant_name').val();
        let applicant_type = $('#applicant_type').val();
        let mpn_name = $('#mpn_name').val();
        let approval_date = $('#approval_date').val();
        let mpn_status = $('#mpn_status').val();
        let website_url = $('#website_url').val();
        let _url     = 'medicalproviders';      //$('#SubmitForm').attr('action');
        let _token   = $('meta[name="csrf-token"]').attr('content');
        
        $.ajax({
            url: _url,
            method: "POST",
            data: {
                mpn_no: mpn_no,
                applicant_name: applicant_name,
                applicant_type: applicant_type,
                mpn_name: mpn_name,
                approval_date: approval_date,
                mpn_status: mpn_status,
                website_url: website_url,
                _token: _token      //"{{ csrf_token() }}"
            },
            success: function(data) { //console.log(data);
                    todo = data.records;
                    $('table tbody').append(`
                        <tr id="todo_${todo.id}">
                            <td>${todo.id}</td>
                            <td>${ todo.mpn_no }</td>
                            <td>${ todo.applicant_name }</td>
                            <td>${ todo.applicant_type }</td>
                            <td>${ todo.mpn_name }</td>
                            <td>${ todo.mpn_status }</td>
                            <td>${ todo.approval_date }</td>
                            <td>${ todo.website_url }</td>
                            <td>Active</td>
                            <td>
                                <a data-id="${ todo.id }" onclick="editTodo(${todo.id})" class="btn btn-primary">Edit</a>
                                <a data-id="${todo.id}" class="btn btn-danger" onclick="deleteTodo(${todo.id})">Delete</a>
                            </td>
                        </tr>
                    `);
                    //alert(data.message);
                    $('#mpn_no').val('');    
                    $('#applicant_name').val('');
                    $('#applicant_type').val('');
                    $('#mpn_name').val('');
                    $('#approval_date').val('');
                    $('#mpn_status').val('');
                    $('#website_url').val('');      
                    hide_modal();
            },
            error: function(response) {  
                alert(response.responseJSON.message);
            }
        });
});

function editTodo(id) {   
    $("#mpn_id").val(id); 
    let _url     = `/medicalproviders/${id}`;
    let _token   = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: _url,
        type: "GET",
        data: {
            _token: _token
        },
        success: function(data) {  console.log(data);
                todo = data.records;                
                $("#editmpn_no").val(todo.mpn_no);
                $("#editapplicant_name").val(todo.applicant_name);
                $("#editapplicant_type").val(todo.applicant_type);
                $("#editmpn_name").val(todo.mpn_name);
                $("#editmpn_status").val(todo.mpn_status);
                $("#editapproval_date").val(todo.approval_date);
                $("#editwebsite_url").val(todo.website_url);
                show_editmodal();
        },
        error: function(response) {  console.log(response);
            $('#mpn_id').val('');
            //$('#taskError').text(response.responseJSON.errors.todo);
        }
    });
}

function updateTodo() { 
    var id = $('#mpn_id').val();
    let mpn_no = $('#editmpn_no').val();
    let applicant_name = $('#editapplicant_name').val();
    let applicant_type = $('#editapplicant_type').val();
    let mpn_name = $('#editmpn_name').val();
    let mpn_status = $('#editmpn_status').val();
    let approval_date = $('#editapproval_date').val();
    let website_url = $('#editwebsite_url').val();

    let _url     = `/medicalproviders/${id}`;
    let _token   = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: _url,
        type: "PUT",
        data: {
            mpn_no: mpn_no,
            applicant_name: applicant_name,
            applicant_type: applicant_type,
            mpn_name: mpn_name,
            approval_date: approval_date,
            mpn_status: mpn_status,
            website_url: website_url,
            _token: _token
        },
        success: function(data) {  //console.log(data);
                todo = data.records;
                $("#todo_"+id+" td:nth-child(2)").html(todo.mpn_no);
                $("#todo_"+id+" td:nth-child(3)").html(todo.applicant_name);
                $("#todo_"+id+" td:nth-child(4)").html(data.applicant_type);
                $("#todo_"+id+" td:nth-child(5)").html(todo.mpn_name);
                $("#todo_"+id+" td:nth-child(6)").html(todo.mpn_status);
                $("#todo_"+id+" td:nth-child(7)").html(todo.approval_date);
                $("#todo_"+id+" td:nth-child(8)").html(todo.website_url);

                $('#mpn_id').val('');
                $('#editmpn_no').val('');    
                $('#editapplicant_name').val('');
                $('#editapplicant_type').val('');
                $('#editmpn_name').val('');
                $('#editapproval_date').val('');
                $('#editmpn_status').val('');
                $('#editwebsite_url').val(''); 
                //alert(data.message); 
                hide_modal();
        },
        error: function(response) {  
            alert(response.responseJSON.message);
        }
    });
}

function deleteTodo(id) {     
    let _url     = `/medicalproviders/${id}`;
    if(confirm("Are You sure ?")){   
        let token   = $('meta[name="csrf-token"]').attr('content');
        
        $.ajax({
            url: _url,
            type: 'DELETE',
            data: {
            _token: token
            },
            success: function(response) { //console.log(response);
                //alert(response.message);
                $("#todo_"+id+" td:nth-child(9)").html('Block');
                $("#todo_"+id+" td:nth-child(10)").html(`<a data-id="${id}" class="btn btn-success" onclick="restoreTodo(${id})">Restore</a>`);
            },
            error: function(response) {  
                alert(response.responseJSON.message);
            }
        });
    }
}

function restoreTodo(id) {     
    let _url     = `/medicalproviders/restore/${id}`;
    if(confirm("Are You sure ?")){   
        let token   = $('meta[name="csrf-token"]').attr('content');
        
        $.ajax({
            url: _url,
            type: 'POST',
            data: {
            _token: token
            },
            success: function(response) { //console.log(response);
                $("#todo_"+id+" td:nth-child(9)").html('Active');                
                $("#todo_"+id+" td:nth-child(10)").html(`<a data-id="${id}" onclick="editTodo(${id})" class="btn btn-primary">Edit</a>
                <a data-id="${id}" class="btn btn-danger" onclick="deleteTodo(${id})">Delete</a>`);
            },
            error: function(response) {  
                alert(response.responseJSON.message);
            }
        });
    }
}
