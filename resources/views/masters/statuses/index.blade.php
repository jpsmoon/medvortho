@extends('layouts.home-new-app')
@section('content')   
  <style>
      .dataTables_length
        {
          padding-top: 2%;  
        }  
        .mt-1, .my-1{
    margin-top:0.5rem!important;
}
  </style>  

    @if ($errors->any())
        <div class="row mt-2 customBox">
            <div align="center" class="col-12  align-self-center">
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif
    <div class="row mt-2 ">
        <div class="col-md-12 mt-4">
            <div class="card row-background customBoxHeight">
                <!-- START: Breadcrumbs-->
                <div class="row ">
                    <div class="col-12  align-self-center">
                        <div class="sub-header py-3 px-3 align-self-center d-sm-flex w-100 rounded heading-background">
                            <div class="w-sm-100 mr-auto margin05">
                                <h2 class="heading">Task's Status</h2>
                            </div>
                            <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                                <li class="breadcrumb-item">
                                    <a class="btn btn-primary" id="myBtn" data-toggle="modal" data-target="#addModal">
                                        Add New</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- END: Breadcrumbs-->
                <div class="card-content">
                    <div class="col-md-12 col-12">
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="table-responsive">
                                    <table id="example" class="table layout-secondary dataTable table-striped table-bordered">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Sort Order</th>
                                                    <th scope="col">Description</th>
                                                    <th scope="col">Type</th>
                                                    <th scope="col">Status</th>
                                                    <th scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (count($statuses))
                                                    @inject('statusClass', 'App\Http\Controllers\StatusController')
                                                    @foreach ($statuses as $status)
                                                        <tr id="todo_{{ $status->id }}" class="jsgrid-row">
                                                            <td>{{ ++$i }}</td>
                                                            <td>{{ $status->status_name }}</td>
                                                            <td>{{ $status->display_order }}</td>
                                                            <td>{{ $status->description }}</td>
                                                            <td>{{ $statusClass->returnStatusName($status->status_type) }}
                                                            </td> 
                                                            <td>{{ $status->is_active ? 'Active' : 'Block' }}</td>
                                                            <td> <i class="icon-pencil showPointer" data-id="{{ $status->id }}" " data-toggle="modal" data-target="#editModal_{{ $status->id }}"/></i>
                                                            <!--<i  class="icon-trash showPointer" onclick="deleteStatus({{ $status->id }})"/></i>-->
                                                            </td>
                                                        </tr>
                                                    <!-- Modal content -->
                                                    <div class="modal fade" id="editModal_{{ $status->id }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <form action="{{ url('/statuses/') }}"  enctype="multipart/form-data" class="form-horizontal ladda-form'" method="POST">
                                                                @csrf
                                                                <input type="hidden" value="{{ $status->id }}" name="editstatus_id" id="editstatus_id" maxlength="100" class="form-control" placeholder="Name">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="editModalLabel">Edit Status</h5>
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <input type="hidden" name="task_id" id="task_id" class="form-control">
                                                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                                                            <div class="form-group">
                                                                                <strong>Status Name:</strong>
                                                                                <input type="text" data-validation-event="change" data-validation="required" data-validation-error-msg="" value="{{ $status->status_name }}" name="status_name" id="status_name" maxlength="100" class="form-control" placeholder="Name">
                                                                                    @if ($errors->has('status_name'))
                                                                                <span class="invalid-feedback" style="display:block"
                                                                                    role="alert">
                                                                                    <strong
                                                                                        class="invalid-feedback">{{ $errors->first('status_name') }}</strong>
                                                                                </span>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                                                            <div class="form-group">
                                                                                <strong>Display Order:</strong>
                                                                                <input type="text" data-validation-event="change" data-validation="required"
                                                                                    data-validation-error-msg="" value="{{ $status->display_order }}"
                                                                                    name="display_order" id="display_order" maxlength="2" class="form-control"
                                                                                    placeholder="Display Order">
                                                                                @if ($errors->has('display_order'))
                                                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                                                        <strong
                                                                                            class="invalid-feedback">{{ $errors->first('display_order') }}</strong>
                                                                                    </span>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                                                            <div class="form-group">
                                                                                <strong>Description:</strong>
                                                                                <textarea class="form-control" style="resize:none" name="description" id="description">{{ $status->description }}</textarea>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary">Save changes</button>
                                                                    </div>
                                                                </div>
                                                            </form>

                                                        </div>
                                                    </div>
                                                    <!-- Modal content -->
                                                @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="12">No Records Found.</td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>

    <!-- Modal content -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form action="{{ url('/statuses') }}" enctype="multipart/form-data" class="form-horizontal ladda-form'"
                method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Add Status</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Status:</strong>
                                <input type="text" data-validation-event="change" data-validation="required"
                                    data-validation-error-msg="" name="status_name" id="status_name" maxlength="100"
                                    class="form-control" placeholder="Name">
                                @if ($errors->has('status_name'))
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong class="invalid-feedback">{{ $errors->first('status_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Display Order:</strong>
                                <input type="text" data-validation-event="change" data-validation="required"
                                    data-validation-error-msg="" name="display_order" id="display_order" maxlength="2"
                                    class="form-control" placeholder="Display Order">
                                @if ($errors->has('display_order'))
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong class="invalid-feedback">{{ $errors->first('display_order') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Type:</strong>
                                <select data-validation-event="change" data-validation="required"
                                    data-validation-error-msg="" name="status_type" id="status_type"
                                    class="form-control" onChange="getStatusAliase(this.value)";>
                                    <option value="">-Select-</option>
                                    <option value="1">Patient</option>
                                    <option value="2">Injury</option>
                                    <option value="3">Bill</option>
                                    <option value="4">Appointment</option>
                                    <option value="5">Other</option>
                                    <option value="6">Appointment Bill Status</option>
                                    <option value="7">Appointment Visit Status</option>
                                    <option value="8">Task</option>
                                    <option value="9">BIll Stage</option>
                                </select>
                                @if ($errors->has('status_type'))
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong class="invalid-feedback">{{ $errors->first('status_type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Aliase:</strong>
                                <select name="status_aliase" id="status_aliase" class="form-control"
                                    data-validation-event="change" data-validation="required"
                                    data-validation-error-msg="">
                                </select>
                                @if ($errors->has('status_aliase'))
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong class="invalid-feedback">{{ $errors->first('status_aliase') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Description:</strong>
                                <textarea class="form-control" style="resize:none" name="description" id="description"></textarea>
                                @if ($errors->has('description'))
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong class="invalid-feedback">{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal content -->

@endsection 
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://code.jquery.com/jquery-migrate-1.2.1.js"></script>
<script>
    function deleteStatus(id) {
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
                //popup: 'swal-wide',
            }
        }).then((result) => {
            // Use .then() to handle the user's response
            if (result.isConfirmed) {
                // Only proceed if the user clicked the confirm button
                let _url = `/statuses/${id}`;
                $.ajax({
                    url: _url,
                    type: 'DELETE',
                    data: {
                        _token: token
                    },
                    success: function(response) {
                        location.reload();
                    },
                    error: function(response) {
                        swal.fire(response.responseJSON.message, '', 'error');
                    }
                });
            }
        });
    }

    function getStatusAliase(val) {
        let _url = `/get/status/aliase`;
        $.ajax({
            url: _url,
            type: 'POST',
            data: {
                _token: token,
                statusType: val
            },
            success: function(response) {
                console.log('#response', response);
                var items = "";
                items += "<li value=''>-Select-</li>";
                $.each(response, function(i, item) {
                    items += `<option id="${item.id}" value="${item.name}">` + item.name +
                        `</option>`;
                });
                $("#status_aliase").html(items);
            },
            error: function(response) {
                swal.fire(response.responseJSON.message, '', 'error');
            }
        });
    }
</script>
