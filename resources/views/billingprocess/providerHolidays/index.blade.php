@extends('layouts.home-app')


@section('content')

<!-- START: Breadcrumbs-->
<div class="row ">
        <div class="col-12  align-self-center">
            <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                <div class="w-sm-100 mr-auto"><h4 class="mb-0">Holidays</h4></div>

                <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                    <li class="breadcrumb-item">
                    @can('CompanyType-create')
                        <a class="btn btn-success text-white" id="myBtn" data-toggle="modal" data-target="#addModal"> Add Holiday </a>
                    @endcan
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
    @if(Session::has('message'))
     <div class="row">
        <div class="col-12 mt-3">
            <div class="alert alert-success">
            <p class="alert{{ Session::get('alert-class', 'alert-info') }}">{{Session::get('message') }}</p>
            </div>
        </div>
    </div>
    @endif
<div class="row">
    <div class="col-12 mt-3">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="table layout-secondary dataTable table-striped table-bordered">
                        <thead class="thead-dark">
                            <tr class="jsgrid-header-row">
                                <th scope="col">No</th>
                                <th scope="col">Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @if(count($providerHolidays))
                                @inject('patientClass', 'App\Http\Controllers\BillingProviderController')
                                @php $i =1; @endphp
                                    @foreach ($providerHolidays as $reason)
                                    <tr  id="todo_{{$reason->id}}">
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $reason->name }}</td>
                                        <td>{{ $reason->description }}</td>
                                        <td>{{ $reason->is_active ? 'Active' : 'Block' }}</td>
                                        <td>
                                            @if($reason->is_active == 1)
                                            @can('CompanyType-edit')
                                                <a   data-toggle="modal" data-target="#editModalCompanyType{{$reason->id}}">
                                                    <i  class="icon-pencil  showPointer"  /></i>
                                                </a>
                                            @endcan 
                                            @can('CompanyType-delete')
                                             <a data-id="{{$reason->id}}" onclick="deleteProviderHoliday({{$reason->id}}, {{$reason->id, $reason->provider_id}})">
                                                    <i  class="icon-trash showPointer"/></i>
                                                </a>
                                            @endcan 
                                            @endif
                                        </td>
                                    </tr>
                                    <!-- Modal content -->
                                        <div class="modal fade" id="editModalCompanyType{{$reason->id}}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <form action="{{ url('/billing/save/reasons') }}" id="EditForm_{{$reason->id}}"  enctype="multipart/form-data" class="form-horizontal ladda-form'" method="POST">
                                                    @csrf
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editModalLabel">Edit Reason</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <input type="hidden" name="resaon_id" id="resaon_id" value="{{$reason->id}}" class="form-control">
                                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                                <div class="form-group">
                                                                    <strong>Name:</strong>
                                                                    <input type="hidden" name="provider_id" id="provider_id" value="{{$reason->provider_id}}" class="form-control">
                                                                    <input type="text" name="name" id="name" value="{{ $reason->name }}" class="form-control" placeholder="Name">
                                                                </div>
                                                            </div>
                                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                                <div class="form-group">
                                                                    <strong>Description:</strong>
                                                                    <input type="text" name="description" id="description" value="{{ $reason->description }}" class="form-control" placeholder="Name">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary" >Update</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- Modal content --> 
                                    @endforeach
                                    @else
                                    <tr>
                                            <td colspan="9">No Records Found.</td>
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
        <form action="{{ url('/billing/save/reasons') }}"  enctype="multipart/form-data" class="form-horizontal ladda-form'" method="POST">
         @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add Appointment Reason</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Name:</strong>
                                <input type="hidden" name="provider_id" id="provider_id" value="{{$providerId}}" class="form-control">
                                <select name="holiday_id" class="form-control" id="holiday_id" data-validation-event="change" data-validation="required"
                                    data-validation-error-msg="">
                                    <option value="" class="option">Select</option>
                                    @foreach ($holidays as $holiday)
                                        <option value="{{ $holiday->id }}"> {{ $holiday->holiday_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Description:</strong>
                                <input type="text" name="description" id="description" class="form-control" placeholder="Description">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>Start Time:</strong>
                                <input autocomplete="off" type="text" name="holiday_start_time" class="form-control timepicker" data-validation-event="change" data-validation="required" data-validation-error-msg="">
                                @if($errors->has('holiday_start_time'))
                                <span class="invalid-feedback" style="display:block" role="alert">
                                    <strong>{{ $errors->first('holiday_start_time') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>End Time:</strong>
                                <input autocomplete="off" type="text" name="holiday_end_time" class="form-control timepicker" data-validation-event="change" data-validation="required" data-validation-error-msg="">
                                @if($errors->has('holiday_end_time'))
                                <span class="invalid-feedback" style="display:block" role="alert">
                                    <strong>{{ $errors->first('holiday_end_time') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Modal content --> 

@endsection
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<!-- START: Page Vendor JS-->
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js" defer=""></script> 
<style type="text/css">
    .ui-timepicker-container   { z-index:100000 !important;  }
</style>

<script>
     function deleteProviderHoliday(id, provider_id) { 
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
        }).then((result) => {
        // Use .then() to handle the user's response
            if (result.isConfirmed) { // Only proceed if the user clicked the confirm button
                let _url     = `/billing/delete/holiday`;
                $.ajax({
                    url: _url,
                    type: 'POST',
                    data: {
                        _token: token,
                        id: id,
                        provider_id: provider_id
                    },
                    success: function(response) {
                        swal.fire({
                            title: 'Reason has been deleted', 
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
    $(document).ready(function() { 
        $('.timepicker').timepicker({
            timeFormat: 'HH:mm:ss',
            interval: 15,
            // minTime: '10',
            // maxTime: '6:00pm',
            defaultTime: '12',
            startTime: '12:00',
            dynamic: false,
            dropdown: true,
            scrollbar: true
        });
    });
</script>
