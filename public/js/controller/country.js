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
        var country_name = $('#country_name').val();
        let _url     = 'countries';      //$('#SubmitForm').attr('action');
        let _token   = $('meta[name="csrf-token"]').attr('content');
        
        $.ajax({
            url: _url,
            method: "POST",
            data: {
                country_name: country_name,
                _token: _token      //"{{ csrf_token() }}"
            },
            success: function(data) { //console.log(data);
                    todo = data.records;
                    $('table tbody').append(`
                        <tr id="todo_${todo.id}">
                            <td>${todo.id}</td>
                            <td>${ todo.country_name }</td>
                            <td>Active</td>
                            <td>
                                <a data-id="${ todo.id }" onclick="editTodo(${todo.id})" class="btn btn-primary">Edit</a>
                                <a data-id="${todo.id}" class="btn btn-danger" onclick="deleteTodo(${todo.id})">Delete</a>
                            </td>
                        </tr>
                    `);
                    //alert(data.message);
                    $('#country_name').val('');    hide_modal();
            },
            error: function(response) {  
                alert(response.responseJSON.message);
            }
        });
});

function editTodo(id) { 
    var todo  = $("#todo_"+id+" td:nth-child(2)").html();
    $("#country_id").val(id);
    $("#editcountry_name").val(todo);
    show_editmodal();
}


function updateTodo() {
    var task = $('#editcountry_name').val();
    var id = $('#country_id').val();
    let _url     = `/countries/${id}`;
    let _token   = $('meta[name="csrf-token"]').attr('content');

    $.ajax({
        url: _url,
        type: "PUT",
        data: {
            country_name: task,
            _token: _token
        },
        success: function(data) {  //console.log(data);
                todo = data.records;
                $("#todo_"+id+" td:nth-child(2)").html(todo.country_name);
                $('#country_id').val('');
                $('#editcountry_name').val('');
               
                //alert(data.message); 
                hide_modal();
        },
        error: function(response) {  
            alert(response.responseJSON.message);
        }
    });
}

function deleteTodo(id) {     
    let _url     = `/countries/${id}`;
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
                $("#todo_"+id+" td:nth-child(3)").html('Block');
                $("#todo_"+id+" td:nth-child(4)").html(`<a data-id="${id}" class="btn btn-success" onclick="restoreTodo(${id})">Restore</a>`);
            },
            error: function(response) {  
                alert(response.responseJSON.message);
            }
        });
    }
}

function restoreTodo(id) {     
    let _url     = `/countries/restore/${id}`;
    if(confirm("Are You sure ?")){   
        let token   = $('meta[name="csrf-token"]').attr('content');
        
        $.ajax({
            url: _url,
            type: 'POST',
            data: {
            _token: token
            },
            success: function(response) { console.log(response);
                $("#todo_"+id+" td:nth-child(3)").html('Active');                
                $("#todo_"+id+" td:nth-child(4)").html(`<a data-id="${id}" onclick="editTodo(${id})" class="btn btn-primary">Edit</a>
                <a data-id="${id}" class="btn btn-danger" onclick="deleteTodo(${id})">Delete</a>`);
            },
            error: function(response) {  console.log(response);
                alert(response.responseJSON.message);
            }
        });
    }
}
