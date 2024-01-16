@extends('layouts.home-new-app')
@section('content')
    <!-- START: Breadcrumbs-->
    <!-- END: Breadcrumbs-->
    
  <style>
      .dataTables_length
        {
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
    <div class="row mt-0">
        <div class="col-md-12 mt-0">
            <div class="card row-background customBoxHeight5">
                <!-- START: Breadcrumbs-->
                <div class="row ">
                    <div class="col-12  align-self-center">
                        <div class="sub-header py-3 px-1 align-self-center d-sm-flex w-100 rounded heading-background">
                            <div style="padding-top:5px" class="w-sm-100 mr-auto">
                                <h2 class="heading">Appointment Recurrenes</h2>
                            </div>
                             <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                             
                             <li class="breadcrumb-item">
                                <a class="btn btn-primary" id="myBtn" data-toggle="modal" data-target="#addModal"> Add Recurrene </a>
                            </li>
                             
                            <li class="breadcrumb-item">
                                <a class="btn btn-primary" href="{{ url('/billing/providers/setting', $providerId) }}"> Back</a>
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
                </div>
            </div>
            <div class="col-1 mt-4"></div>
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
<script src="https://code.jquery.com/jquery-migrate-1.2.1.js"></script>
<script src="{{ asset('js/bootstrap-inputmask.js') }}"></script>
<script src="{{ asset('js/controller/master_for_all.js') }}"></script>
<script></script>
