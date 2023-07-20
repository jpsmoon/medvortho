var addModal = document.getElementById("addModal");
var btn = document.getElementById("myBtn");
var span = document.getElementsByClassName("close")[0];

function show_addmodal(){
    addModal.style.display = "block";
}
function hide_modal(){
    addModal.style.display = "none";
}

function deleteTodo(id) { 
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
            let _url     = `/patients/${id}`;
            $.ajax({
                url: _url,
                type: 'DELETE',
                data: {
                    _token: token
                },
                success: function(response) {
                    swal.fire({
                        title: 'Patient has been deleted', 
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

function restoreTodo(id) {     
    let _url     = `/patients/restore/${id}`;
    if(confirm("Are You sure ?")){   
        let token   = $('meta[name="csrf-token"]').attr('content');
        
        $.ajax({
            url: _url,
            type: 'POST',
            data: {
            _token: token
            },
            success: function(response) {// console.log(response);
                $("#todo_"+id+" td:nth-child(8)").html('Active');                
                $("#todo_"+id+" td:nth-child(9)").html(`<a data-id="${id}" href="{{ route('patients.edit',$id) }}" class="btn btn-primary">Edit</a>
                <a data-id="${id}" class="btn btn-danger" onclick="deleteTodo(${id})">Delete</a>`);
            },
            error: function(response) {  
                alert(response.responseJSON.message);
            }
        });
    }
}

$("#billing_provider").on("click", "a", function(e){
    e.preventDefault();
    var $this = $(this).parent();
    $this.addClass("select").siblings().removeClass("select");
    var t = $this.data("value");
    //alert('>> '+t);
    $("#billing_provider_id").val(t);
    $('#continue').prop('disabled', false);
});