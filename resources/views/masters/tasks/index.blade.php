@extends('layouts.home-app')


@section('content')
 <!-- START: Breadcrumbs-->
 <div class="row ">
        <div class="col-12  align-self-center">
            <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                <div class="w-sm-100 mr-auto"><h4 class="mb-0">Tasks</h4></div>

                <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                    <li class="breadcrumb-item">
                    <a class="btn btn-success text-white" id="myBtn" onclick="show_addmodal();" data-toggle="modal" data-target="#addModal"> Add New </a>
                    </li>
                </ol>
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="row ">
            <div class="col-12  align-self-center">
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
                                                <th class="jsgrid-header-cell jsgrid-header-sortable">Task</th>
                                                <th class="jsgrid-header-cell jsgrid-header-sortable">Description</th>
                                                <th class="jsgrid-header-cell jsgrid-header-sortable">Status</th>
                                                <th class="jsgrid-header-cell jsgrid-header-sortable">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @if(count($tasks))
                                                @foreach ($tasks as $task)
                                                <tr  id="todo_{{$task->id}}" class="jsgrid-row">
                                                    <td class="jsgrid-cell">{{ ++$i }}</td>
                                                    <td class="jsgrid-cell">{{ $task->task_name }}</td>
                                                    <td class="jsgrid-cell">{{ $task->description }}</td>
                                                    <td class="jsgrid-cell">{{ $task->is_active ? 'Active' : 'Block' }}</td>
                                                    <td class="jsgrid-cell">

                                                        @if($task->is_active == '0' || $task->deleted_at != '')
                                                        <a data-id="{{$task->id}}" class="btn btn-success" onclick="restoreTodo({{$task->id}})">Restore</a>
                                                        @else
                                                        <a data-id="{{$task->id}}" onclick="editTodo({{$task->id}})" data-toggle="modal" data-target="#editModal">
                                                            <input class="jsgrid-button jsgrid-edit-button" type="button" title="Edit" data-id="{{$task->id}}">
                                                        </a>
                                                        <a data-id="{{$task->id}}"  onclick="deleteTodo({{$task->id}})">
                                                        <input data-id="{{$task->id}}" class="jsgrid-button jsgrid-delete-button" type="button">
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
                    <h5 class="modal-title" id="addModalLabel">Add Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Task Name:</strong>
                            <input type="text" name="task_name" id="task_name" maxlength="100" class="form-control" placeholder="Name" onkeypress="return isAlpha(event)">
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
                    <h5 class="modal-title" id="editModalLabel">Edit Task</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="task_id" id="task_id" class="form-control">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>Task Name:</strong>
                                <input type="text" name="edittask_name" id="edittask_name" maxlength="100" class="form-control" placeholder="Name" onkeypress="return isAlpha(event)">
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
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Modal content -->




<script src="{{ asset('js/controller/tasks.js') }}"></script>

@endsection
