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
                                <h2 class="heading">Taxonomy Codes</h2>
                            </div>
                            <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                            <li class="breadcrumb-item">
                                @can('claim-admin-create')
                                    <a class="btn btn-primary" href="javascript:void(0)" id="myBtn"  data-toggle="modal" data-target="#addModalManual"> Add Taxonomy Code Import</a>
                                @endcan
                                @can('claim-admin-create')
                                <a class="btn btn-primary" href="javascript:void(0)" id="myBtn"  data-toggle="modal" data-target="#addModal"> Add Taxonomy Code Manual</a>
                                @endcan
                            </li>
                        </ol> 
                        </div>
                    </div>
                </div>
                <!-- END: Breadcrumbs-->
                <div class="card-content">
                    <div class="col-md-12 col-12">
                        @can('claim-admin-list')
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="table-responsive">
                                        <table id="example" class="table layout-secondary dataTable table-striped table-bordered">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th scope="col">No</th>
                                                        <th scope="col">Taxonomy Name</th>
                                                        <th scope="col">Code</th>
                                                        <th scope="col">Status</th> 
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if($taxonomy_codes && count($taxonomy_codes) > 0)
                                                    @php $i = 1; @endphp
                                                    @foreach ($taxonomy_codes as $taxonomy_code)
                                                            <tr>
                                                                <td>{{ $i++}}</a></td>
                                                                <td>{{ $taxonomy_code->name }}</td>
                                                                <td>{{ $taxonomy_code->code }}</td>
                                                                <td>{{ $taxonomy_code->is_active ? 'Active' : 'Block' }}</td>  
                                                                <td>
                                                                @if($taxonomy_code->is_active == 1)
                                                                    @can('TaxonomyCode-edit')
                                                                        <a class="text-info" data-id="{{$taxonomy_code->id}}" data-toggle="modal" data-target="#editModal" onclick="editTodo({{$taxonomy_code}})" >
                                                                        <i  class="icon-pencil  showPointer"/></i>
                                                                        </a>
                                                                    @endcan
                                                                        @can('TaxonomyCode-delete')
                                                                        <a href="javascript:void(0)" class="text-danger" data-id="{{$taxonomy_code->id}}" onclick="deleteTCode({{$taxonomy_code->id}})">
                                                                        <i  class="icon-trash showPointer"/></i>
                                                                        </a>
                                                                    @endcan 
                                                                @endif
                                                                </td>
                                                            </tr>
                                                            <!-- Modal content -->
                                                                 <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                                                        <div class="modal-dialog" role="document">
                                                                            <form id="EditForm" method="POST">
                                                                            @csrf
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title" id="editModalLabel">Edit Taxonomy Code</h5>
                                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                            <span aria-hidden="true">&times;</span>
                                                                                        </button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <input type="hidden" name="code_id" id="code_id" class="form-control" value="{{$taxonomy_code->id}}">
                                                                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                                                                            <div class="form-group">
                                                                                                <strong>Taxonomy Name:</strong>
                                                                                                <input value="{{$taxonomy_code->name}}" type="text" name="editname" id="editname" maxlength="100" class="form-control" placeholder="Name">
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-xs-12 col-sm-12 col-md-12">
                                                                                            <div class="form-group">
                                                                                                <strong>Code:</strong>
                                                                                                <input type="text" value="{{$taxonomy_code->code}}" name="editcode" id="editcode" maxlength="100" class="form-control" placeholder="Code">
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                                                        <button type="submit" class="btn btn-primary" onclick="updateTodo()">Submit</button>
                                                                                    </div>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div> 
                                                                <!-- Modal content -->
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
                    @endcan
                   </div>
                </div>
            </div>
            <div class="col-1 mt-4"></div>
        </div>
    </div>
    
    <!-- Modal -->
        <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form id="SubmitForm" method="POST" >
                @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Add Taxonomy Code</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Taxonomy Name:</strong>
                                    <input type="text" name="name" id="name" maxlength="100" class="form-control" data-validation="required" placeholder="Name">
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Code:</strong>
                                    <input type="text" name="code" id="code" maxlength="100" class="form-control" data-validation="required" placeholder="Code">
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
    
    <!-- Modal -->
        <div class="modal fade" id="addModalManual" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form id="SubmitFormImport" method="POST" action="{{ url('/taxonomycodes/importCode') }}"  enctype="multipart/form-data" >
                @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Import Taxonomy Code</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Import File:</strong>
                                    <input type="file" name="import_file" id="import_file"  class="form-control" placeholder="Upload file">
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Import</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    <!-- Modal content -->
@endsection

