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
        var task = $('#name').val();
        let _url     = 'companytypes';      //$('#SubmitForm').attr('action');
        let _token   = $('meta[name="csrf-token"]').attr('content');
        
        $.ajax({
            url: _url,
            method: "POST",
            data: {
                name: task,
                _token: _token      //"{{ csrf_token() }}"
            },
            success: function(data) { //console.log(data);
                window.location.href = '/companytypes';
            },
            error: function(response) {  
                alert(response.responseJSON.message);
            }
        });
});

function editTodo(id) { 
    var todo  = $("#todo_"+id+" td:nth-child(2)").html();
    $("#companytype_id").val(id);
    $("#editname").val(todo);
    //show_editmodal();
}


function updateTodo() {
    // var task = $('#editname').val();
    // var id = $('#companytype_id').val();
    // let _url     = `/companytypes/${id}`;
    // let _token   = $('meta[name="csrf-token"]').attr('content');

    // $.ajax({
    //     url: _url,
    //     type: "PUT",
    //     data: {
    //         id: id,
    //         name: task,
    //         _token: _token
    //     },
    //     success: function(data) {  //
    //         console.log('updateTodo', data);
    //        window.location.href = '/companytypes';
    //     },
    //     error: function(response) {  
    //         alert(response.responseJSON.message);
    //     }
    // });
}

function deleteTodo(id) {     
    let _url     = `/companytypes/${id}`;
    if(confirm("Are You sure ?")){   
        let token   = $('meta[name="csrf-token"]').attr('content');
        
        $.ajax({
            url: _url,
            type: 'DELETE',
            data: {
            _token: token
            },
            success: function(response) { //console.log(response);
                window.location.href = '/companytypes';
            },
            error: function(response) {  
                alert(response.responseJSON.message);
            }
        });
    }
}

function restoreTodo(id) {     
    let _url     = `/companytypes/restore/${id}`;
    if(confirm("Are You sure ?")){   
        let token   = $('meta[name="csrf-token"]').attr('content');
        
        $.ajax({
            url: _url,
            type: 'POST',
            data: {
            _token: token
            },
            success: function(response) { //console.log(response);
                $("#todo_"+id+" td:nth-child(3)").html('Active');                
                $("#todo_"+id+" td:nth-child(4)").html(`<a data-id="${id}" onclick="editTodo(${id})" class="btn btn-primary">Edit</a>
                <a data-id="${id}" class="btn btn-danger" onclick="deleteTodo(${id})">Delete</a>`);
            },
            error: function(response) {  
                alert(response.responseJSON.message);
            }
        });
    }
}
