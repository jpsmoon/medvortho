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
                        <a class="btn btn-primary text-white" id="myBtn"  data-toggle="modal" data-target="#addModal"> Add Holiday </a>
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
                                <th scope="col">Type</th>
                                <th scope="col">Name</th>
                                <th scope="col">Description</th>
                                <th scope="col">Date</th>
                                <th scope="col">Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @if(count($holidays))
                                 @php $i =1; @endphp
                                    @foreach ($holidays as $holiday)
                                    <tr  id="todo_{{$holiday->id}}">
                                        <td>{{ $i++ }}</td>
                                        <td>{{ ($holiday->holiday_type == 1) ? 'Gazetted' : 'Restricted' }}</td>
                                        <td>{{ $holiday->holiday_name }}</td>
                                        <td>{{ $holiday->description }}</td>
                                        <td>{{ date('m-d-Y', strtotime($holiday->holiday_date)) }}</td>
                                        <td>{{ $holiday->is_active ? 'Active' : 'Block' }}</td>
                                        <td>
                                            @if($holiday->is_active == 1)
                                            @can('CompanyType-edit')
                                                <a   data-toggle="modal" data-target="#editModalCompanyType{{$holiday->id}}">
                                                    <i  class="icon-pencil  showPointer"  /></i>
                                                </a>
                                            @endcan 
                                            @can('CompanyType-delete')
                                             <a data-id="{{$holiday->id}}" onclick="deleteHoliday({{$holiday->id}}, {{$holiday->id, $holiday->provider_id}})">
                                                    <i  class="icon-trash showPointer"/></i>
                                                </a>
                                            @endcan 
                                            @endif
                                        </td>
                                    </tr>
                                    <!-- Modal content -->
                                        <div class="modal fade" id="editModalCompanyType{{$holiday->id}}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <form action="{{ url('/save/holiday') }}" id="EditForm_{{$holiday->id}}"  enctype="multipart/form-data" class="form-horizontal ladda-form'" method="POST">
                                                    @csrf
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editModalLabel">Edit Holiday</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <input type="hidden" name="holiday_id" id="holiday_id" value="{{$holiday->id}}" class="form-control">
                                                             <div class="row">
                                                                <div class="col-xs-6 col-sm-6 col-md-6">
                                                                    <div class="form-group">
                                                                        <strong>Name:</strong>
                                                                        <input value="{{$holiday->holiday_name}}" type="text" name="name" id="name" class="form-control" placeholder="Name" data-validation-event="change" data-validation="required" data-validation-error-msg="">
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-6 col-sm-6 col-md-6">
                                                                    <div class="form-group">
                                                                        <strong>Description:</strong>
                                                                        <input type="text" value="{{$holiday->description}}" name="description" id="description" class="form-control" placeholder="Description" data-validation-event="change" data-validation="required" data-validation-error-msg="">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-xs-6 col-sm-6 col-md-6">
                                                                    <div class="form-group">
                                                                        <strong>Date:</strong>
                                                                        <input type="text" value="{{ date('m/d/Y', strtotime($holiday->holiday_date))}}" name="holiday_date" id="holiday_date" class="form-control" placeholder="Holiday Date" data-validation-event="change" data-validation="required" data-validation-error-msg="">
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-6 col-sm-6 col-md-6">
                                                                    <div class="form-group">
                                                                        <strong>Type:</strong><br>
                                                                        <input type="radio" value="1" {{ ($holiday->holiday_type == '1') ? 'checked' : ''}} class="largerCheckbox" name="holiday_type" id="holiday_type1" data-validation-event="change" data-validation="required" data-validation-error-msg=""> <span style="vertical-align:top"> Gazetted Holidays</span>
                                                                        <br>
                                                                            @if($errors->has('holiday_type'))
                                                                            <span class="invalid-feedback" style="display:block" role="alert">
                                                                                <strong>{{ $errors->first('holiday_type') }}</strong>
                                                                            </span>
                                                                            @endif
                                                                        <input type="radio" {{ ($holiday->holiday_type == '0') ? 'checked' : ''}} value="0" class="largerCheckbox" name="holiday_type" id="holiday_type2" data-validation-event="change" data-validation="required" data-validation-error-msg=""> <span style="vertical-align:top"> Restricted  Holidays</span>
                                                                            <br>
                                                                            @if($errors->has('holiday_type'))
                                                                            <span class="invalid-feedback" style="display:block" role="alert">
                                                                                <strong>{{ $errors->first('holiday_type') }}</strong>
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
    <div class="modal-dialog modal-lg" role="document">
        <form action="{{ url('/save/holiday') }}"  enctype="multipart/form-data" class="form-horizontal ladda-form'" method="POST">
         @csrf
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add Holiday</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>Name:</strong>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Name" data-validation-event="change" data-validation="required" data-validation-error-msg="">
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>Description:</strong>
                                <input type="text" name="description" id="description" class="form-control" placeholder="Description" data-validation-event="change" data-validation="required" data-validation-error-msg="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>Date:</strong>
                                <input type="text" name="holiday_date" id="holiday_date" class="form-control" placeholder="Holiday Date" data-validation-event="change" data-validation="required" data-validation-error-msg="">
                            </div>
                        </div>
                        <div class="col-xs-6 col-sm-6 col-md-6">
                            <div class="form-group">
                                <strong>Type:</strong><br>
                                 <input type="radio" value="1" class="largerCheckbox" name="holiday_type" id="holiday_type1" data-validation-event="change" data-validation="required" data-validation-error-msg=""> <span style="vertical-align:top"> Gazetted Holidays</span>
                                 <br>
                                    @if($errors->has('holiday_type'))
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong>{{ $errors->first('holiday_type') }}</strong>
                                    </span>
                                    @endif
                                <input type="radio" value="0" class="largerCheckbox" name="holiday_type" id="holiday_type2" data-validation-event="change" data-validation="required" data-validation-error-msg=""> <span style="vertical-align:top"> Restricted  Holidays</span>
                                    <br>
                                    @if($errors->has('holiday_type'))
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong>{{ $errors->first('holiday_type') }}</strong>
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
<script>
  $(document).ready(function() { 
    $('#holiday_date').datepicker({
        dateFormat: 'mm/dd/yy',
        changeMonth: true, changeYear: true,
    })
  })
  function deleteHoliday(id, provider_id) { 
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
                let _url     = `/delete/holiday`;
                $.ajax({
                    url: _url,
                    type: 'POST',
                    data: {
                        _token: token,
                        id: id, 
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
