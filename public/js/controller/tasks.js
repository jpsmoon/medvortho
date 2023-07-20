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
        var task = $('#task_name').val();
        var description = $('#description').val();
        let _url     = 'tasks';      //$('#SubmitForm').attr('action');
        let _token   = $('meta[name="csrf-token"]').attr('content');
        
        $.ajax({
            url: _url,
            method: "POST",
            data: {
                task_name: task,
                description: description,
                _token: _token      //"{{ csrf_token() }}"
            },
            success: function(data) { //console.log(data);
                    todo = data.records;
                    $('table tbody').append(`
                        <tr id="todo_${todo.id}">
                            <td>${todo.id}</td>
                            <td>${ todo.task_name }</td>
                            <td>${ todo.description }</td>
                            <td>Active</td>
                            <td>
                                <a data-id="${ todo.id }" onclick="editTodo(${todo.id})" class="btn btn-primary">Edit</a>
                                <a data-id="${todo.id}" class="btn btn-danger" onclick="deleteTodo(${todo.id})">Delete</a>
                            </td>
                        </tr>
                    `);
                    //alert(data.message);
                    $('#task_name').val(''); $('#description').val('');   hide_modal();
            },
            error: function(response) {  
                alert(response.responseJSON.message);
            }
        });
});

function editTodo(id) { 
    var todo  = $("#todo_"+id+" td:nth-child(2)").html();
    var desc  = $("#todo_"+id+" td:nth-child(3)").html();
    $("#task_id").val(id);
    $("#edittask_name").val(todo);
    $("#editdescription").val(desc);
    show_editmodal();
}


function updateTodo() {
    var task = $('#edittask_name').val();
    var desc = $('#editdescription').val();
    var id = $('#task_id').val();
    let _url     = `/tasks/${id}`;
    let _token   = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: _url,
        type: "PUT",
        data: {
            task_name: task,
            description: desc,
            _token: _token
        },
        success: function(data) {  //console.log(data);
                todo = data.records;
                $("#todo_"+id+" td:nth-child(2)").html(task);
                $("#todo_"+id+" td:nth-child(3)").html(desc);
                $('#task_id').val('');
                $('#edittask_name').val(''); $('#editdescription').val('');
               
                //alert(data.message); 
                hide_modal();
                /*swal({
                    title:'Success!',
                    text:"{{Session::get('success')}}",
                    timer:5000,
                    type:'success'
                }).then((value) => {
                  //location.reload();
                }).catch(swal.noop);*/
        },
        error: function(response) {  
            alert(response.responseJSON.message);
        }
    });
}

function deleteTodo(id) {     
    let _url     = `/tasks/${id}`;
    if(confirm("Are You sure ?")){   
        let token   = $('meta[name="csrf-token"]').attr('content');
        
        $.ajax({
            url: _url,
            type: 'DELETE',
            data: {
            _token: token
            },
            success: function(response) { //console.log(response);
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
    let _url     = `/tasks/restore/${id}`;
    if(confirm("Are You sure ?")){   
        let token   = $('meta[name="csrf-token"]').attr('content');
        
        $.ajax({
            url: _url,
            type: 'POST',
            data: {
            _token: token
            },
            success: function(response) { //console.log(response);
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
