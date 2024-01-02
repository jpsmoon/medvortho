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
    <div class="row mt-2 ">
        <div class="col-md-12 mt-4">
            <div class="card row-background customBoxHeight">
                <!-- START: Breadcrumbs-->
                <div class="row ">
                    <div class="col-12  align-self-center">
                        <div class="sub-header py-3 px-3 align-self-center d-sm-flex w-100 rounded heading-background">
                            <div class="w-sm-100 mr-auto margin05">
                                <h2 class="heading">Permission Management</h2>
                            </div>
                             <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                            <li class="breadcrumb-item">
                                <a class="btn btn-primary" href="javascript:void(0)" data-toggle="modal" data-target="#permissionModal"> Create New Permission</a> 
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
                                        <th scope="col"> S.No#</th>
                                        <th scope="col">Name</th></th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($permissions))
                                    @inject('roleClass', 'App\Http\Controllers\RoleController')
                                    @foreach ($permissions as $key => $permission)
                                        <tr>
                                                <td>{{ ++$i }}</td>
                                                <td> {{ $permission->name }} </td>
                                            <td> 
                                            @can('role-edit')
                                                <a class="text-info" data-toggle="modal" data-target="#updatePermissionModal_{{$permission->id}}">
                                                <i  class="icon-pencil  showPointer"/></i>
                                                </a>
                                            @endcan
                                            @can('role-delete')
                                            @if(count ($roleClass->checkPermissionBeforeDelete($permission->id) ) == 0)
                                                <a class="text-danger" href="javascript:void(0)" data-id="{{$permission->id}}" onclick="deletePermission({{$permission->id}})"><i  class="icon-trash showPointer"/></i></a>
                                            @endif
                                            @endcan
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="updatePermissionModal_{{$permission->id}}" tabindex="-1" role="dialog" aria-labelledby="permissionLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="permissionLabel">Update Permission</h5>
                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="resetFormValue('editFrmId_{{$permission->id}}');">
                                                            <span aria-hidden="true">&times;</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="col-12 mt-4">
                                                            <form id="editFrmId_{{$permission->id}}" action="{{ route('savePermission') }}" enctype="multipart/form-data" class="form-horizontal ladda-form'" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="permissionId" id="permissionId" value="{{$permission->id}}">
                                                                <input type="text" name="guard_name" id="guard_name" value="web">
                                                                <div class="row">
                                                                    <div class="form-group col-md-8">
                                                                        <label for="">Permission<span class="required">* </span> </label>
                                                                        <input type="text" value="{{strtolower($permission->name)}}" id="permissionId" value="" name="name" class="form-control" data-validation-event="change" data-validation="required, custom" data-validation-regexp ="^[a-z-]*$"> 
                                                                        @if ($errors->has('name'))
                                                                            <span class="invalid-feedback" style="display:block" role="alert">
                                                                                <strong>{{ $errors->first('name') }}</strong>
                                                                            </span>
                                                                        @endif
                                                                    </div> 
                                                                    <div class="form-group col-md-4">
                                                                        <span class="text-muted">Only enter alphabetic string in small letter with dash don't use underscore, special character,number and capital letter </span>
                                                                    </div> 
                                                                </div>
                                                                <div class="row">
                                                                    <div class="form-group col-md-4 mt-2">
                                                                    <label for=""> </label>
                                                                        <button type="submit" style="min-width: 120px" class="btn btn-primary ladda-button">
                                                                            <span class="ladda-label buttonfont">Update</span></button>
                                                                    </div>
                                                                </div>  
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
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
                </div>
            </div>
            <div class="col-1 mt-4"></div>
        </div>
    </div>
    
    <div class="modal fade" id="permissionModal" tabindex="-1" role="dialog" aria-labelledby="permissionLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="permissionLabel">Add Permission</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="resetFormValue('addFrmId');">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-12 mt-4">
                            <form id="addFrmId" action="{{ route('savePermission') }}" enctype="multipart/form-data" class="form-horizontal ladda-form'" method="POST">
                                @csrf
                                <input type="hidden" name="permissionId" id="permissionId" value="">
                                <input type="hidden" name="guard_name" id="guard_name" value="web">
                                <div class="row">
                                    <div class="form-group col-md-8">
                                        <label for="">Permission<span class="required">* </span> </label>
                                        <input type="text" id="permissionId" value="" name="name" class="form-control" data-validation-event="change" data-validation="required, custom" data-validation-regexp ="^[a-z-]*$"> 
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" style="display:block" role="alert">
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                    </div> 
                                    <div class="form-group col-md-4">
                                        <span class="text-muted">Only enter alphabetic string in small letter with dash don't use underscore, special character,number and capital letter </span>
                                    </div>
                                </div> 
                                <div class="row">
                                    <div class="form-group col-md-4">
                                    <label for=""> </label>
                                        <button type="submit" style="min-width: 120px" class="btn btn-primary ladda-button">
                                            <span class="ladda-label buttonfont">Add</span></button>
                                    </div>
                                </div> 
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
@endsection
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://code.jquery.com/jquery-migrate-1.2.1.js"></script>
<script src="{{ asset('js/bootstrap-inputmask.js') }}"></script>
<script src="{{ asset('js/controller/master_for_all.js') }}"></script>
<script></script>
