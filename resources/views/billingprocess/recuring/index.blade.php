@extends('layouts.home-app')


@section('content')

<!-- START: Breadcrumbs-->
<div class="row ">
        <div class="col-12  align-self-center">
            <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                <div class="w-sm-100 mr-auto"><h4 class="mb-0">Appointment Recurrenes</h4></div>

                <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                    <li class="breadcrumb-item">
                    @can('CompanyType-create')
                        <a class="btn btn-success text-white" id="myBtn"   data-toggle="modal" data-target="#addModal"> Add Recurrene </a>
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
                                @if(count($appointmentResaon))
                                @inject('patientClass', 'App\Http\Controllers\BillingProviderController')
                                @php $i =1; @endphp
                                    @foreach ($appointmentResaon as $reason)
                                    <tr  id="todo_{{$reason->id}}">
                                        <td>{{ $i++ }}</td>
                                        <td>{{ ($reason->recurrence_date)  ?  $reason->recurrence_date : "" }}</td>
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
                                             <a data-id="{{$reason->id}}" onclick="deleteReason({{$reason->id}}, {{$reason->id, $reason->provider_id}})">
                                                    <i  class="icon-trash showPointer"/></i>
                                                </a>
                                            @endcan 
                                            @endif
                                        </td>
                                    </tr>
                                    <!-- Modal content -->
                                        <div class="modal fade" id="editModalCompanyType{{$reason->id}}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <form action="{{ url('/billing/save/recurence') }}" id="EditForm_{{$reason->id}}"  enctype="multipart/form-data" class="form-horizontal ladda-form'" method="POST">
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
                                                                    <strong>Days:</strong>
                                                                    <input type="hidden" name="provider_id" id="provider_id" value="{{$reason->provider_id}}" class="form-control">
                                                                    <input type="text" maxLength="2" name="recurrence_date" id="recurrence_date" value="{{ $reason->recurrence_date }}" class="form-control" placeholder="Name">
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
        <form action="{{ url('/billing/save/recurence') }}"  enctype="multipart/form-data" class="form-horizontal ladda-form'" method="POST">
         @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add Appointment Recurrene</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Days:</strong>
                            <input type="hidden" name="provider_id" id="provider_id" value="{{$providerId}}" class="form-control">
                            <input type="text" name="recurrence_date" id="recurrence_date" maxLength="2" class="form-control" placeholder="Recurrence Days">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Description:</strong>
                            <input type="text" name="description" id="description" class="form-control" placeholder="Description">
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
     function deleteReason(id, provider_id) { 
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
            let _url     = `/billing/delete/recurence`;
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
                        title: 'Recurrence has been deleted', 
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
// $(document).ready(function() { 
//     $('#recurrence_date').datepicker({
//         dateFormat: 'mm/dd/yy',
//          changeMonth: true, changeYear: true,
//         })
// })

</script>
