@extends('layouts.home-app')
@section('content')

<!-- START: Breadcrumbs-->
    <div class="row ">
        <div class="col-12  align-self-center">
            <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                <div class="w-sm-100 mr-auto"><h4 class="mt-3">Taxonomy Codes</h4> </div>
                
                <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                    <li class="breadcrumb-item">
                        @can('TaxonomyCode-create')
                        <a class="btn btn-primary" href="javascript:void(0)" id="myBtn"  data-toggle="modal" data-target="#addModal"> Add Taxonomy Code</a>
                        @endcan
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
                                    <th scope="col">No</th>
                                    <th scope="col">Taxonomy Name</th>
                                    <th scope="col">Code</th>
                                    <th scope="col">Status</th> 
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                                <tbody>
                                    @if(count($taxonomy_codes))
                                    @inject('testPatientClass', 'App\Http\Controllers\PatientController')
                                        @foreach ($taxonomy_codes as $taxonomy_code)
                                            <tr>
                                                <td>{{ ++$i }}</a></td>
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
                            <input type="text" name="name" id="name" maxlength="100" class="form-control" placeholder="Name">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Code:</strong>
                            <input type="text" name="code" id="code" maxlength="100" class="form-control" placeholder="Code">
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

@endsection 
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://code.jquery.com/jquery-migrate-1.2.1.js"></script>
<script src="{{ asset('js/controller/taxonomycodes.js') }}"></script>
