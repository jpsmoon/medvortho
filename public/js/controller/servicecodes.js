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
        let code = $('#code').val();
        let name = $('#name').val();
        let nick_name = $('#nick_name').val();
        let npi = $('#npi').val();
        let countryDD = $('#countryDD').val();
        let stateDD = $('#stateDD').val();
        let cityDD = $('#cityDD').val();
        let zipcode = $('#zipcode').val();
        let address_line1 = $('#address_line1').val();
        let address_line2 = $('#address_line2').val();
        let _url     = 'servicecodes';      //$('#SubmitForm').attr('action');
        let _token   = $('meta[name="csrf-token"]').attr('content');
        
        $.ajax({
            url: _url,
            method: "POST",
            data: {
                code: code,
                place_of_service_name: name,
                nick_name: nick_name,
                npi: npi,
                country_id: countryDD,
                state_id: stateDD,
                city_id: cityDD,
                zipcode: zipcode,
                address_line1: address_line1,
                address_line2: address_line2,
                _token: _token      //"{{ csrf_token() }}"
            },
            success: function(data) { //console.log(data);
                    todo = data.records;
                    $('table tbody').append(`
                        <tr id="todo_${todo.id}">
                            <td>${todo.id}</td>
                            <td>${ todo.code }</td>
                            <td>${ todo.place_of_service_name }</td>
                            <td>${ todo.nick_name ? todo.nick_name : '' }</td>
                            <td>${ todo.npi }</td>
                            <td>${ todo.address_line1 ? todo.address_line1 : '' }</td>
                            <td>Active</td>
                            <td>
                                <a data-id="${ todo.id }" onclick="editTodo(${todo.id})" class="btn btn-primary">Edit</a>
                                <a data-id="${todo.id}" class="btn btn-danger" onclick="deleteTodo(${todo.id})">Delete</a>
                            </td>
                        </tr>
                    `);
                    //alert(data.message);
                    $('#name').val('');    
                    $('#code').val('');
                    $('#name').val('');
                    $('#nick_name').val('');
                    $('#npi').val('');
                    $('#stateDD').val('');
                    $('#cityDD').val('');
                    $('#zipcode').val('');
                    $('#address_line1').val('');
                    $('#address_line2').val('');       
                    hide_modal();
            },
            error: function(response) {  
                alert(response.responseJSON.message);
            }
        });
});

function editTodo(id) { 
    $("#service_code_id").val(id); 
    let _url     = `/servicecodes/${id}`;
    let _token   = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: _url,
        type: "GET",
        data: {
            _token: _token
        },
        success: function(data) {  //console.log(data);
                todo = data.records;
                
                $('#editcode').val(todo.code);
                $('#editname').val(todo.place_of_service_name);
                $('#editnick_name').val(todo.nick_name);
                $('#editnpi').val(todo.npi);
                if(todo.country_id && data.states.length){
                    $('#editstateDD').html('<option value="">Select State</option>'); 
                    $.each(data.states,function(key,value){
                        $("#editstateDD").append('<option value="'+value.id+'"  >'+value.state_name+'</option>');
                    });
                }
                if(todo.state_id && data.cities.length){
                    $('#editcityDD').html('<option value="">Select City</option>'); 
                    $.each(data.cities,function(key,value){
                        $("#editcityDD").append('<option value="'+value.id+'" >'+value.city_name+'</option>');
                    });
                }    
                
                $('#editcountryDD').val(todo.country_id);
                $('#editstateDD').val(todo.state_id);
                $('#editcityDD').val(todo.city_id);
                $('#editzipcode').val(todo.zipcode);
                $('#editaddress_line1').val(todo.address_line1);
                $('#editaddress_line2').val(todo.address_line2);
                show_editmodal();
        },
        error: function(response) {  console.log(response);
            //$('#taskError').text(response.responseJSON.errors.todo);
        }
    });
}

function updateTodo() { 
    var id = $('#service_code_id').val();
    let code = $('#editcode').val();
    let name = $('#editname').val();
    let nick_name = $('#editnick_name').val();
    let npi = $('#editnpi').val();
    let countryDD = $('#editcountryDD').val();
    let stateDD = $('#editstateDD').val();
    let cityDD = $('#editcityDD').val();
    let zipcode = $('#editzipcode').val();
    let address_line1 = $('#editaddress_line1').val();
    let address_line2 = $('#editaddress_line2').val();

    let _url     = `/servicecodes/${id}`;
    let _token   = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
        url: _url,
        type: "PUT",
        data: {
            code: code,
            place_of_service_name: name,
            nick_name: nick_name,
            npi: npi,
            country_id: countryDD,
            state_id: stateDD,
            city_id: cityDD,
            zipcode: zipcode,
            address_line1: address_line1,
            address_line2: address_line2,
            _token: _token
        },
        success: function(data) {  console.log(data);
                todo = data.records;
                $("#todo_"+id+" td:nth-child(2)").html(todo.code);
                $("#todo_"+id+" td:nth-child(3)").html(todo.place_of_service_name);
                $("#todo_"+id+" td:nth-child(4)").html(todo.nick_name);
                $("#todo_"+id+" td:nth-child(5)").html(todo.npi);
                $("#todo_"+id+" td:nth-child(6)").html(todo.address_line1);

                $('#service_code_id').val('');
                $('#editcode').val('');
                $('#editname').val('');
                $('#editnick_name').val('');
                $('#editnpi').val('');
                $('#editcountryDD').val('');
                $('#editstateDD').val('');
                $('#editcityDD').val('');
                $('#editzipcode').val('');
                $('#editaddress_line1').val('');
                $('#editaddress_line2').val('');   
               
                //alert(data.message); 
                hide_modal();
        },
        error: function(response) {  
            alert(response.responseJSON.message);
        }
    });
}

function deleteTodo(id) {     
    let _url     = `/servicecodes/${id}`;
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
                $("#todo_"+id+" td:nth-child(7)").html('Block');
                $("#todo_"+id+" td:nth-child(8)").html(`<a data-id="${id}" class="btn btn-success" onclick="restoreTodo(${id})">Restore</a>`);
            },
            error: function(response) {  
                alert(response.responseJSON.message);
            }
        });
    }
}

function restoreTodo(id) {     
    let _url     = `/servicecodes/restore/${id}`;
    if(confirm("Are You sure ?")){   
        let token   = $('meta[name="csrf-token"]').attr('content');
        
        $.ajax({
            url: _url,
            type: 'POST',
            data: {
            _token: token
            },
            success: function(response) { //console.log(response);
                $("#todo_"+id+" td:nth-child(7)").html('Active');                
                $("#todo_"+id+" td:nth-child(8)").html(`<a data-id="${id}" onclick="editTodo(${id})" class="btn btn-primary">Edit</a>
                <a data-id="${id}" class="btn btn-danger" onclick="deleteTodo(${id})">Delete</a>`);
            },
            error: function(response) {  
                alert(response.responseJSON.message);
            }
        });
    }
}
