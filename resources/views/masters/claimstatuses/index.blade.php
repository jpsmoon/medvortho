@extends('layouts.home-app')


@section('content')
<!-- START: Breadcrumbs-->
<div class="row ">
        <div class="col-12  align-self-center">
            <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                <div class="w-sm-100 mr-auto"><h4 class="mb-0">ClaimStatus</h4></div>

                <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                    <li class="breadcrumb-item">
                    @can('ClaimStatus-create')
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
                                                <th class="jsgrid-header-cell jsgrid-header-sortable">o</th>
                                                <th class="jsgrid-header-cell jsgrid-header-sortable">ame</th>
                                                <th>Status</th>
                                                <th class="jsgrid-header-cell jsgrid-header-sortable">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @if(count($claimstatuses))
                                                @foreach ($claimstatuses as $claim)
                                                <tr  id="todo_{{$claim->id}}" class="jsgrid-row">
                                                    <td class="jsgrid-cell">{{ ++$i }}</td>
                                                    <td class="jsgrid-cell">{{ $claim->claim_status }}</td>
                                                    <td class="jsgrid-cell">{{ $claim->is_active ? 'Active' : 'Block' }}</td>
                                                    <td class="jsgrid-cell">

                                                        @if($claim->is_active == '0' || $claim->deleted_at != '')
                                                            @can('ClaimStatus-delete')
                                                            <a data-id="{{$claim->id}}" class="btn btn-success" onclick="restoreTodo({{$claim->id}})">Restore</a>
                                                            @endcan
                                                        @else
                                                            @can('ClaimStatus-edit')
                                                            <a data-id="{{$claim->id}}" onclick="editTodo({{$claim->id}})" data-toggle="modal" data-target="#editModal">
                                                            <input class="jsgrid-button jsgrid-edit-button" type="button" title="Edit" data-id="{{$claim->id}}">
                                                            </a>
                                                            @endcan
                                                            @can('ClaimStatus-delete')
                                                            <a data-id="{{$claim->id}}"  onclick="deleteTodo({{$claim->id}})">
                                                            <input data-id="{{$claim->id}}" class="jsgrid-button jsgrid-delete-button" type="button"></input>
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

<!-- Modal content -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="SubmitForm" >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add ClaimStatus</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Name:</strong>
                            <input type="text" name="claim_status" id="claim_status" class="form-control" placeholder="Name">
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
                    <h5 class="modal-title" id="editModalLabel">Edit ClaimStatus</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="claim_status_id" id="claim_status_id" class="form-control">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>Name:</strong>
                            <input type="text" name="editclaim_status" id="editclaim_status" class="form-control" placeholder="Name">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="updateTodo()">Submit</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Modal content -->


<script src="{{ asset('js/controller/claimstatus.js') }}"></script>
   <script>

</script>

@endsection
