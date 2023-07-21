@extends('layouts.home-app')


@section('content')

<!-- START: Breadcrumbs-->
<div class="row ">
        <div class="col-12  align-self-center">
            <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                <div class="w-sm-100 mr-auto"><h4 class="mb-0">Holidays</h4></div>
                <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                    <li class="breadcrumb-item">
                        @can('Patient-create')
                        <a class="btn btn-primary text-white" id="myBtn" data-toggle="modal" data-target="#addModal"> Add Holiday </a>
                        @endcan
                    </li>
                    <li class="breadcrumb-item">
                         <a class="btn btn-primary" href="{{ url('/billing/providers/setting', $providerId) }}">Back </a>
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
                                <th scope="col">Holiday</th>
                                <th scope="col">Type</th>
                                <th scope="col">Location</th>
                                <th scope="col">Description</th>
                                <th scope="col">Date</th>
                                <th scope="col">Open Time</th>
                                <th scope="col">Close Time</th> 
                                <th scope="col">Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @if(count($providerHolidays))
                                @inject('patientClass', 'App\Http\Controllers\BillingProviderController')
                                @php $i =1; @endphp
                                    @foreach ($providerHolidays as $bPHoliday)
                                    <tr  id="todo_{{$bPHoliday->id}}">
                                        <td>{{ $i++ }}</td>
                                        <td>{{ ($bPHoliday->getHoliday && $bPHoliday->getHoliday->holiday_name) ? $bPHoliday->getHoliday->holiday_name : ''  }}</td>
                                        <td>{{ ($bPHoliday->getHoliday && $bPHoliday->getHoliday->holiday_type && $bPHoliday->getHoliday->holiday_type ==1) ? 'Gazetted' : 'Restricted'  }}</td>
                                        <td>{{ ($bPHoliday->getLocation && $bPHoliday->getLocation->nick_name) ? $bPHoliday->getLocation->nick_name : ''  }}</td>
                                        <td>{{ $bPHoliday->description }}</td>
                                        <td>{{ ($bPHoliday->getHoliday && $bPHoliday->getHoliday->holiday_date) ? date('m-d-Y', strtotime($bPHoliday->getHoliday->holiday_date)) : ''  }}</td>
                                        <td>{{ $bPHoliday->holiday_start_time }}</td>
                                        <td>{{ $bPHoliday->holiday_end_time }}</td>
                                        <td>{{ ($bPHoliday->getHoliday && $bPHoliday->getHoliday->is_active) ? 'Active' : 'Block'  }}</td> 
                                        <td>
                                             @can('CompanyType-edit')
                                                <a   data-toggle="modal" data-target="#editModalCompanyType{{$bPHoliday->id}}">
                                                    <i  class="icon-pencil  showPointer"  /></i>
                                                </a>
                                            @endcan 
                                            @can('CompanyType-delete')
                                             <a data-id="{{$bPHoliday->id}}" onclick="deleteProviderHoliday({{$bPHoliday->id}}, {{$bPHoliday->id, $bPHoliday->provider_id}})">
                                                    <i  class="icon-trash showPointer"/></i>
                                                </a>
                                            @endcan  
                                        </td>
                                    </tr>
                                    <!-- Modal content -->
                                        <div class="modal fade" id="editModalCompanyType{{$bPHoliday->id}}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <form action="{{ url('/billing/save/holiday') }}" id="EditForm_{{$bPHoliday->id}}"  enctype="multipart/form-data" class="form-horizontal ladda-form'" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="bp_holiday_id" id="bp_holiday_id" value="{{$bPHoliday->id}}" class="form-control">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editModalLabel">Edit Holiday</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body"> 
                                                            <div class="row">
                                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                                    <div class="form-group">
                                                                        <strong>Holiday:</strong>
                                                                        <input type="hidden" name="provider_id" id="provider_id" value="{{$providerId}}" class="form-control">
                                                                        <select name="holiday_id" class="form-control" id="holiday_id" data-validation-event="change" data-validation="required"
                                                                            data-validation-error-msg="">
                                                                            <option value="" class="option">Select</option>
                                                                            @foreach ($holidays as $holiday)
                                                                                <option value="{{ $holiday->id }}" {{$bPHoliday->holiday_id == $holiday->id ? 'selected' : ''}}> {{ $holiday->holiday_name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                                    <div class="form-group">
                                                                        <strong>Location:</strong>
                                                                        <select name="holiday_location_id" class="form-control" id="holiday_location_id" data-validation-event="change" data-validation="required"
                                                                            data-validation-error-msg="">
                                                                            <option value="" class="option">Select</option>
                                                                            @foreach ($placeOfServices as $location)
                                                                                <option value="{{ $location->id }}" {{$bPHoliday->location_id == $location->id ? 'selected' : ''}}> {{ $location->nick_name }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                                    <div class="form-group">
                                                                        <strong>Description:</strong>
                                                                        <input type="text" value="{{$bPHoliday->description}}" name="description" id="description" class="form-control" placeholder="Description">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-xs-6 col-sm-6 col-md-6">
                                                                    <div class="form-group">
                                                                        <strong>Start Time:</strong>
                                                                        <input autocomplete="off" value="{{$bPHoliday->holiday_start_time}}"  type="text" name="holiday_start_time" class="form-control timepicker" data-validation-event="change" data-validation="required" data-validation-error-msg="">
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
                                                                        <input autocomplete="off" value="{{$bPHoliday->holiday_end_time}}" type="text" name="holiday_end_time" class="form-control timepicker" data-validation-event="change" data-validation="required" data-validation-error-msg="">
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
        <form action="{{ url('/billing/save/holiday') }}"  enctype="multipart/form-data" class="form-horizontal ladda-form'" method="POST">
         @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add Holiday</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Holiday:</strong>
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
                                <strong>Location:</strong>
                                <select name="holiday_location_id" class="form-control" id="holiday_location_id" data-validation-event="change" data-validation="required"
                                    data-validation-error-msg="">
                                    <option value="" class="option">Select</option>
                                    @foreach ($placeOfServices as $location)
                                        <option value="{{ $location->id }}"> {{ $location->nick_name }}</option>
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
                //popup: 'swal-wide',
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
