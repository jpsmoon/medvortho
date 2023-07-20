@extends('layouts.home-app')
@section('content')

<!-- START: Breadcrumbs-->
    <div class="row ">
        <div class="col-12  align-self-center">
            <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                <div class="w-sm-100 mr-auto"><h4 class="mt-3">Role Management</h4>
                 
                </div>
                
                <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                    <li class="breadcrumb-item">
                         <a class="btn btn-primary" href="{{ route('roles.create') }}"> Create New Role</a> 
                    </li>
                </ol>
            </div>
        </div>
    </div>
    <!-- END: Breadcrumbs-->
    <!-- <div class="row">
        <div class="col-12 mt-3">
            <div class="card">
                <div class="card-body">
                {!! Form::open(['class' => 'form-horizontal','id' => 'patientListFrm','method'=>"get"]) !!}
                <div class="row row-xs">
                        <div class="col-md-10 mt-3 mt-md-0" id="keywordDiv">
                            <input type="text" name="keyword" class="form-control" maxlength="200" id="keyword" placeholder="search by patient name, id" value="">
                        </div>

                        <div class="col-md-2">
                            <label for="">&nbsp;</label>
                            <button type="submit" id="patient_Btn" class="btn btn-primary filter_patient">Search</button>
                            <button type="reset" class="btn btn-primary reset_payslip_filter">Reset</button>
                        </div>
                    </div>
                {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div> -->

    <div class="row">
            <div class="col-12 mt-3">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                        <table id="example" class="table layout-secondary dataTable table-striped table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col"> S.No#</th>
                                        <th scope="col">Name</th></th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                    <tbody>
                                         @if(count($roles))
                                          @inject('roleClass', 'App\Http\Controllers\RoleController')
                                           @foreach ($roles as $key => $role)
                                                <tr>
                                                     <td>{{ ++$i }}</td>
                                                     <td> {{ $role->name }} </td>
                                                    <td> 
                                                    @can('role-edit')
                                                        <a class="text-info" data-id="{{$role->id}}" href="{{ route('roles.edit',$role->id) }}" >
                                                        <i  class="icon-pencil  showPointer"/></i>
                                                        </a>
                                                    @endcan
                                                    @can('role-delete')
                                                    @if(count ($roleClass->checkRoleBeforeDelete($role->id) ) == 0)
                                                        <a class="text-danger" href="javascript:void(0)" data-id="{{$role->id}}" onclick="deleteRole({{$role->id}})"><i  class="icon-trash showPointer"/></i></a>
                                                    @endif
                                                    @endcan
                                                    
                                                    </td>
                                                </tr>
                                                @endforeach
                                            @else
                                            <tr>
                                                <td colspan="10">No Records Found.</td>
                                            </tr>
                                            @endif
                                        </tbody>
                                </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {!! $roles->render() !!}
@endsection 
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://code.jquery.com/jquery-migrate-1.2.1.js"></script>
<script>
function resetFormValue(frmId){
    $('#'+frmId).trigger("reset");
}
function deleteRole(id) { 
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
            let _url     = `/delete/role/${id}`;
            $.ajax({
                url: _url,
                type: 'post',
                data: {
                    _token: token
                },
                success: function(response) {
                    console.log('#response',response);
                    swal.fire({
                        title: 'Role has been deleted', 
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
</script>
