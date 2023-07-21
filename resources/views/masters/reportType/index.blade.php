@extends('layouts.home-app')


@section('content')

<!-- START: Breadcrumbs-->
<div class="row ">
        <div class="col-12  align-self-center">
            <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                <div class="w-sm-100 mr-auto"><h4 class="mb-0">Report Type</h4></div>

                <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                    <li class="breadcrumb-item">
                    @can('CompanyType-create')
                        <a class="btn btn-primary text-white" id="myBtn"  data-toggle="modal" data-target="#addModal"> Add Report Type </a>
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
                                <th scope="col">Code</th>
                                <th scope="col">Name</th>  
                                <th scope="col">Description</th>  
                                <th scope="col">Status</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @if(count($reportTypes))
                                 @php $i =1; @endphp
                                    @foreach ($reportTypes as $reportType)
                                    <tr  id="todo_{{$reportType->id}}">
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $reportType->report_code }}</td> 
                                        <td>{{ $reportType->report_name }}</td> 
                                        <td>{{ $reportType->description }}</td> 
                                        <td>{{ ($reportType->is_active == 1) ? 'Active' : 'Block' }}</td>
                                        <td>
                                            @if($reportType->is_active == 1)
                                            @can('CompanyType-edit')
                                                <a   data-toggle="modal" data-target="#editModalReportType{{$reportType->id}}">
                                                    <i  class="icon-pencil  showPointer"  /></i>
                                                </a>
                                            @endcan 
                                            @can('CompanyType-delete')
                                             <a data-id="{{$reportType->id}}" onclick="deleteReportType({{$reportType->id}}, {{$reportType->id, $reportType->provider_id}})">
                                                    <i  class="icon-trash showPointer"/></i>
                                                </a>
                                            @endcan 
                                            @endif
                                        </td>
                                    </tr>
                                    <!-- Modal content -->
                                        <div class="modal fade" id="editModalReportType{{$reportType->id}}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <form action="{{ url('/save/reprt/type') }}" id="EditForm_{{$reportType->id}}"  enctype="multipart/form-data" class="form-horizontal ladda-form'" method="POST">
                                                    @csrf
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editModalLabel">Edit Report Type</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <input type="hidden" name="report_type_id" id="report_type_id" value="{{$reportType->id}}" class="form-control">
                                                             <div class="row">
                                                                <div class="col-xs-6 col-sm-6 col-md-6">
                                                                    <div class="form-group">
                                                                        <strong>Name:</strong>
                                                                        <input value="{{ $reportType->report_name }}" type="text" name="name" id="name" class="form-control" placeholder="Name" data-validation-event="change" data-validation="required" data-validation-error-msg="">
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-6 col-sm-6 col-md-6">
                                                                    <div class="form-group">
                                                                        <strong>Report Code:</strong>
                                                                        <input type="text" value="{{ $reportType->report_code }}" name="report_code" id="report_code" class="form-control" placeholder="Report Code" data-validation-event="change" data-validation="required" data-validation-error-msg="">
                                                                    </div>
                                                                </div>
                                                                <div class="col-xs-12 col-sm-12 col-md-12">
                                                                    <div class="form-group">
                                                                        <strong>Description:</strong>
                                                                        <input type="text" value="{{ $reportType->report_name }}" name="description" id="description" class="form-control" placeholder="Description" data-validation-event="change" data-validation="required" data-validation-error-msg="">
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
        <form action="{{ url('/save/reprt/type') }}"  enctype="multipart/form-data" class="form-horizontal ladda-form'" method="POST">
         @csrf
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add Report Type</h5>
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
                                <strong>Report Code:</strong>
                                <input type="text" name="report_code" id="report_code" class="form-control" placeholder="Report Code" data-validation-event="change" data-validation="required" data-validation-error-msg="">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Description:</strong>
                                <input type="text" name="description" id="description" class="form-control" placeholder="Description" data-validation-event="change" data-validation="required" data-validation-error-msg="">
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
  function deleteReportType(id, provider_id) { 
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
                let _url     = `/delete/reprt/type`;
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
