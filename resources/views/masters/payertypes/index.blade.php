@extends('layouts.home-app')


@section('content')
<!-- START: Breadcrumbs-->
    <div class="row ">
        <div class="col-12  align-self-center">
            <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                <div class="w-sm-100 mr-auto"><h4 class="mb-0">Payer Types</h4></div>

                <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                    <li class="breadcrumb-item">
                        @can('payertype-create')
                            <a class="btn btn-success text-white" id="myBtn" onclick="show_addmodal();" data-toggle="modal" data-target="#addModal"> Add New </a>
                        @endcan
                    </li>
                </ol>
            </div>
        </div>
    </div>
    <!-- END: Breadcrumbs-->

        @if ($message = Session::get('success'))
        <div class="row ">
            <div class="col-12  align-self-center">
                <div class="alert alert-success">
                    <p> {{ $message }}</p>
                </div>
            </div>
        </div>
        @endif

    @if(Session::has('message'))
        <div class="row ">
            <div class="col-12  align-self-center">
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
                            <div class="jsgrid">
                                <div class="jsgrid-grid-header jsgrid-header-scrollbar">
                                    <table id="example" class="table layout-secondary dataTable table-striped table-bordered">
                                        <thead class="thead-dark">
                                            <tr class="jsgrid-header-row">
                                                <th class="jsgrid-header-cell jsgrid-header-sortable">No</th>
                                                <th class="jsgrid-header-cell jsgrid-header-sortable">Name</th>
                                                <th class="jsgrid-header-cell jsgrid-header-sortable">Status</th>
                                                <th class="jsgrid-header-cell jsgrid-header-sortable">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @if(count($payer_types))
                                                @foreach ($payer_types as $payer_type)
                                                    <tr class="jsgrid-row"  id="todo_{{$payer_type->id}}">
                                                        <td class="jsgrid-cell">{{ ++$i }}</td>
                                                        <td class="jsgrid-cell">{{ $payer_type->payer_type_name }}</td>
                                                        <td class="jsgrid-cell">{{ $payer_type->is_active ? 'Active' : 'Block' }}</td>
                                                        <td class="jsgrid-cell">

                                                            @if($payer_type->is_active == '0' || $payer_type->deleted_at != '')
                                                                @can('payertype-delete')
                                                                <a data-id="{{$payer_type->id}}" class="btn btn-success" onclick="restoreTodo({{$payer_type->id}})">Restore</a>
                                                                @endcan
                                                            @else
                                                                @can('payertype-edit')
                                                                <a data-id="{{$payer_type->id}}" onclick="editTodo({{$payer_type->id}})" data-toggle="modal" data-target="#editModal">
                                                                <input class="jsgrid-button jsgrid-edit-button" type="button" title="Edit" data-id="{{$payer_type->id}}">
                                                                </a>
                                                                @endcan
                                                                @can('payertype-delete')
                                                                <a data-id="{{$payer_type->id}}"  onclick="deleteTodo({{$payer_type->id}})">
                                                                    <input data-id="{{$payer_type->id}}" class="jsgrid-button jsgrid-delete-button" type="button"></input>
                                                                </a>
                                                                @endcan
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                    @else
                                                    <tr class="jsgrid-row">
                                                            <td class="jsgrid-cell">No Records Found.</td>
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
                    {!! $payer_types->links() !!}



<!-- Modal content -->
    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="SubmitForm" >
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addModalLabel">Add PayerType</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Name:</strong>
                                <input type="text" name="payer_type_name" id="payer_type_name" class="form-control" placeholder="Name" onkeypress="return isAlpha(event)">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<!-- Modal content -->

<!-- Modal content -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="EditForm" >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit PayerType</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="payertype_id" id="payertype_id" class="form-control">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Name:</strong>
                            <input type="text" name="editpayer_type_name" id="editpayer_type_name" class="form-control" placeholder="Name" onkeypress="return isAlpha(event)">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" onclick="updateTodo()">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="{{ asset('js/controller/payertype.js') }}"></script>

@endsection
