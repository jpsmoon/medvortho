@extends('layouts.home-app')
@section('content')
    <!-- START: Breadcrumbs-->
    <!-- END: Breadcrumbs-->

    <style>
        .dataTables_length {
            padding-top: 2%;
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
    <div class="row mt-2 mb-2 ">
        <div class="col-md-12 mt-4">
            <div class="card row-background customBoxHeight">
                <!-- START: Breadcrumbs-->
                <div class="row ">
                    <div class="col-12  align-self-center">
                        <div class="sub-header py-3 px-3 align-self-center d-sm-flex w-100 rounded heading-background">
                            <div class="w-sm-100 mr-auto margin05">
                                <h2 class="heading">States List</h2>
                            </div>
                            <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                                <li class="breadcrumb-item" >
                                    @can('state-create')
                                        <a class="btn btn-primary" data-toggle="modal" data-target="#createModalState"> Add New State</a>
                                    @endcan
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- END: Breadcrumbs-->
                <div class="row">
                    <div class="col-12">
                        <div class="card p-1">
                            <div class="table-responsive">
                                <table id="example" class="table layout-secondary dataTable table-striped table-bordered">
                                    <thead class="thead-dark">
                                        <tr class="jsgrid-header-row">
                                            <th>No</th>
                                            <th>Country</th>
                                            <th>State</th>
                                            <th>Code</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (count($states))
                                            @foreach ($states as $state)
                                                <tr>
                                                    <td>{{ ++$i }}</td>
                                                    <td>{{ $state->country_name }}</td>
                                                    <td>{{ $state->state_name }}</td>
                                                    <td>{{ $state->state_code }}</td>
                                                    <td>{{ $state->is_active ? 'Active' : 'Block' }}</td>
                                                    <td>
                                                        <i data-toggle="modal"
                                                            data-target="#editModalState_{{ $state->id }}"
                                                            class="icon-pencil showPointer"></i>
                                                        <i class="icon-trash showPointer" data-id="{{$state->id}}" onclick="deleteState({{$state->id}})"></i>
                                                    </td>
                                                </tr> 
                                                <!-- Modal content -->
                                                <div class="modal fade" id="editModalState_{{ $state->id }}"
                                                    tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
                                                    aria-hidden="true">
                                                    <div class="modal-dialog modal-lg" role="document">
                                                        <form action="{{ route('states.update', $state->id) }}"
                                                            id="EditForm_{{ $state->id }}" enctype="multipart/form-data"
                                                            class="form-horizontal ladda-form'" method="POST">
                                                            @csrf
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="editModalLabel">Edit State
                                                                    </h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal" aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    @csrf
                                                                    @method('PUT')
                                                                    <div class="row">
                                                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                                                            <div class="form-group">
                                                                                <strong>Country:</strong>
                                                                                <select name="country_id"
                                                                                    class="form-control">
                                                                                    @foreach ($countries as $country)
                                                                                        <option value="{{ $country->id }}"
                                                                                            {{ $country->id == $state->country_id ? 'selected' : '' }}>
                                                                                            {{ $country->country_name }}
                                                                                        </option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <strong>Name:</strong>
                                                                                <input type="text" name="state_name"
                                                                                    value="{{ $state->state_name }}"
                                                                                    class="form-control" placeholder="Name">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit"
                                                                        class="btn btn-primary">Update</button>
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Close</button>

                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <!-- Modal content -->
                                            @endforeach
                                        @else
                                            <tr>
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
        </div>
    </div>
    <!-- Modal content -->
        <div class="modal fade" id="createModalState" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <form action="{{ route('states.store') }}" id="createForm"  enctype="multipart/form-data" class="form-horizontal ladda-form'" method="POST">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="createModalLabel">Add State</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            @csrf
                             <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Country:</strong>
                                        <select name="country_id" class="form-control">
                                            @foreach ($countries as $country)
                                            <option value="{{$country->id}}"> {{$country->country_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <strong>Name:</strong>
                                        <input type="text" name="state_name" value="" class="form-control" data-validation="required"  placeholder="Name">
                                    </div>
                                </div> 
                            </div>
                        </div>
                        <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" >Create</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    <!-- Modal content --> 
@endsection
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://code.jquery.com/jquery-migrate-1.2.1.js"></script>
<script src="{{ asset('js/bootstrap-inputmask.js') }}"></script>
<script src="{{ asset('js/controller/master_for_all.js') }}"></script>
<script>
 
function deleteState(id) { 
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
            let _url     = `/delete/state`;
            $.ajax({
                url: _url,
                type: 'POST',
                data: {
                    _token: token,
                    id:id
                },
                success: function(response) {
                    swal.fire({
                        title: 'State has been deleted', 
                        customClass: {
                            successButton: "btn btn-primary",
                            //popup: 'swal-wide',
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
</script>
