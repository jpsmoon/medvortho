@extends('layouts.home-app')


@section('content')

    <!-- START: Breadcrumbs-->
    <div class="row ">
        <div class="col-12  align-self-center">
            <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                <div class="w-sm-100 mr-auto"><h4 class="mb-0">Task's Status</h4></div>

                <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                    <li class="breadcrumb-item">
                       <a class="btn btn-success text-white" id="myBtn" data-toggle="modal" data-target="#addModal"> Add New </a>
                    </li>
                </ol>
            </div>
        </div>
    </div>
    <!-- END: Breadcrumbs-->

    @if ($message = Session::get('success'))
    <div class="row">
        <div class="col-12 mt-3">
            <div class="alert alert-success">
                <p> {{ $message }}</p>
            </div>
        </div>
    </div>
    @endif 
<div class="row">
    <div class="col-12 mt-3">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="exampleStatus" class="table layout-secondary dataTable table-striped table-bordered">
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
                                @if(count($statuses))
                                @inject('statusClass', 'App\Http\Controllers\StatusController')
                                @foreach ($statuses as $status)
                                <tr  id="todo_{{$status->id}}" class="jsgrid-row">
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $status->status_name }}</td>
                                    <td>{{ $status->display_order }}</td>
                                    <td>{{ $status->description }}</td>
                                    <td>{{ $statusClass->returnStatusName($status->status_type)}}</td>
                                    <td class="d-none">{{ $status->status_type}}</td>
                                    <td>{{ $status->is_active ? 'Active' : 'Block' }}</td>
                                    <td>
                                        <a data-id="{{$status->id}}"   data-toggle="modal" data-target="#editModal_{{$status->id}}">
                                            <i  class="icon-pencil  showPointer"/></i>
                                        </a>
                                        <a data-id="{{$status->id}}"  onclick="deleteStatus({{$status->id}})">
                                            <i  class="icon-trash showPointer"/></i>
                                        </a>
                                    </td>
                                    </tr>
                                    <!-- Modal content -->
                                    <div class="modal fade" id="editModal_{{$status->id}}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <form action="{{ url('/statuses/') }}"  enctype="multipart/form-data" class="form-horizontal ladda-form'" method="POST">
                                            @csrf
                                            <input type="hidden" value="{{$status->id}}" name="editstatus_id" id="editstatus_id" maxlength="100" class="form-control" placeholder="Name">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="editModalLabel">Edit Task Status</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                            <input type="hidden" name="task_id" id="task_id" class="form-control">
                                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                                <div class="form-group">
                                                                    <strong>Task Status Name:</strong>
                                                                    <input type="text" value="{{$status->status_name}}" name="status_name" id="status_name" maxlength="100" class="form-control" placeholder="Name">
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                                <div class="form-group">
                                                                    <strong>Display Order:</strong>
                                                                    <input type="text" value="{{$status->display_order}}" name="display_order" id="display_order" maxlength="2" class="form-control"  placeholder="Display Order">
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                            <div class="form-group">
                                                                <strong>Type:</strong>
                                                                <select name="status_type" id="status_type" class="form-control">
                                                                        <option>-Select-</option> 
                                                                        <option value="1" {{ ($status->status_type == 1) ? 'selected' : ''}}>Patient</option>
                                                                        <option value="2" {{ ($status->status_type == 2) ? 'selected' : ''}}>Injury</option>
                                                                        <option value="3" {{ ($status->status_type == 3) ? 'selected' : ''}}>Bill</option>
                                                                        <option value="4" {{ ($status->status_type == 4) ? 'selected' : ''}}>Appointment</option>
                                                                        <option value="5" {{ ($status->status_type == 5) ? 'selected' : ''}}>Other</option>
                                                                        <option value="6" {{ ($status->status_type == 6) ? 'selected' : ''}}>Appointment Bill Status</option>
                                                                        <option value="7" {{ ($status->status_type == 7) ? 'selected' : ''}}>Appointment Visit Status</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                                <div class="form-group">
                                                                    <strong>Description:</strong>
                                                                    <textarea class="form-control" style="resize:none" name="description" id="description">{{$status->description}}</textarea>
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
                                    <tr class="jsgrid-row">
                                            <td>No Records Found.</td>
                                    </tr>
                                    @endif
                            </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>  
<!-- Modal content -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
         <form action="{{ url('/statuses') }}"  enctype="multipart/form-data" class="form-horizontal ladda-form'" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add Task Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Status:</strong>
                            <input type="text" name="status_name" id="status_name" maxlength="100" class="form-control" placeholder="Name">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Display Order:</strong>
                            <input type="text" name="display_order" id="display_order" maxlength="2" class="form-control" placeholder="Display Order">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Type:</strong>
                            <select name="status_type" id="status_type" class="form-control">
                                    <option>-Select-</option> 
                                    <option value="1">Patient</option>
                                    <option value="2">Injury</option>
                                    <option value="3">Bill</option>
                                    <option value="4">Appointment</option>
                                    <option value="5">Other</option>
                                    <option value="6">Appointment Bill Status</option>
                                    <option value="7">Appointment Visit Status</option>
                            </select> 
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Description:</strong>
                            <textarea class="form-control" style="resize:none" name="description" id="description"></textarea>
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
                let _url     = `/statuses/${id}`;
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
</script>
