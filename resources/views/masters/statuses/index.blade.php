@extends('layouts.home-app')


@section('content')

    <!-- START: Breadcrumbs-->
    <div class="row ">
        <div class="col-12  align-self-center">
            <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                <div class="w-sm-100 mr-auto"><h4 class="mb-0">Task's Status</h4></div>

                <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                    <li class="breadcrumb-item">
                       <a class="btn btn-success text-white" id="myBtn" data-toggle="modal" data-target="#addModal"> Add New </a>
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
                                                    <th class="jsgrid-header-cell jsgrid-header-sortable">Task's  Status</th>
                                                    <th class="jsgrid-header-cell jsgrid-header-sortable">Sort Order</th>
                                                    <th class="jsgrid-header-cell jsgrid-header-sortable">Description</th>
                                                    <th class="jsgrid-header-cell jsgrid-header-sortable">Status</th>
                                                    <th class="jsgrid-header-cell jsgrid-header-sortable">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if(count($statuses))
                                                @foreach ($statuses as $status)
                                                <tr  id="todo_{{$status->id}}" class="jsgrid-row">
                                                    <td class="jsgrid-cell">{{ ++$i }}</td>
                                                    <td class="jsgrid-cell">{{ $status->status_name }}</td>
                                                    <td class="jsgrid-cell">{{ $status->display_order }}</td>
                                                    <td class="jsgrid-cell">{{ $status->description }}</td>
                                                    <td class="jsgrid-cell">{{ $status->is_active ? 'Active' : 'Block' }}</td>
                                                    <td class="jsgrid-cell">

                                                        @if($status->is_active == '0' || $status->deleted_at != '')
                                                        <a data-id="{{$status->id}}" class="btn btn-success" onclick="restoreTodo({{$status->id}})">Restore</a>
                                                        @else
                                                        <a data-id="{{$status->id}}" onclick="editTodo({{$status->id}})" data-toggle="modal" data-target="#editModal">
                                                            <input class="jsgrid-button jsgrid-edit-button" type="button" title="Edit" data-id="{{$status->id}}">
                                                        </a>
                                                        <a data-id="{{$status->id}}"  onclick="deleteTodo({{$status->id}})">
                                                            <input data-id="{{$status->id}}" class="jsgrid-button jsgrid-delete-button" type="button">
                                                        </a>
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



<!-- Modal content -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="SubmitForm" >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add Task Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Task Status:</strong>
                            <input type="text" name="status_name" id="status_name" maxlength="100" class="form-control" placeholder="Name" onkeypress="return isAlpha(event)">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Display Order:</strong>
                            <input type="text" name="display_order" id="display_order" maxlength="2" class="form-control" onkeypress="return isNumberKey(event)" placeholder="Display Order">
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Description:</strong>
                            <textarea class="form-control" style="resize:none" name="description" id="description"></textarea>
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
                    <h5 class="modal-title" id="editModalLabel">Edit Task Status</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <input type="hidden" name="task_id" id="task_id" class="form-control">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Task Status Name:</strong>
                                <input type="text" name="editstatus_name" id="editstatus_name" maxlength="100" class="form-control" placeholder="Name" onkeypress="return isAlpha(event)">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Display Order:</strong>
                                <input type="text" name="editdisplay_order" id="editdisplay_order" maxlength="2" class="form-control" onkeypress="return isNumberKey(event)" placeholder="Display Order">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Description:</strong>
                                <textarea class="form-control" style="resize:none" name="editdescription" id="editdescription"></textarea>
                            </div>
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" onclick="updateTodo()"  class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Modal content -->
<script src="{{ asset('js/controller/statuses.js') }}"></script>

@endsection
