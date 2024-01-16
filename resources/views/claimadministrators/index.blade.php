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
                                <h2 class="heading">Claim Administrator</h2>
                            </div>
                             <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                            <li class="breadcrumb-item">
                                @can('claim-admin-create')
                                <a class="btn btn-primary" href="{{ route('claimadministrators.create')}}"> Add Claim Administrator</a>
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
                                        <th scope="col">Name</th>
                                         <th scope="col">Type</th> 
                                        <th scope="col">Operation Hours</th>
                                        <th scope="col">Website</th>
                                        <th scope="col">Affiliated Entities</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($claims && count($claims))
                                        @foreach ($claims as $claim)
                                            <tr id="todo_{{ $claim->id }}">
                                                <td><a class="text-primary showPointer" href="javascript:void(0)"
                                                        data-toggle="modal"
                                                        data-target="#claimAdministratorModalId_{{ $claim->id }}">
                                                        {{ $claim->name }}
                                                    </a> 
                                                    <!-- START: Claim Administrator  Modal Popup -->
                                                        <div id="claimAdministratorModalId_{{ $claim->id }}"
                                                            class="modal fade bd-example-modal-lg" role="dialog"
                                                            style="padding-top:150px !important">
                                                            <div class="modal-dialog modal-lg">
                                                                <!-- Modal content-->
                                                                <div id="injuryDiv" class="modal-content">
                                                                    <div class="modal-header text-center">
                                                                        <div>
                                                                            <h4 class="modal-title">
                                                                                <center id="injuryNoteTitle">{{ $claim->name }}
                                                                                </center>
                                                                            </h4>
                                                                        </div>
                                                                        <div><button type="button" style="color:#FFFFFF"
                                                                                class="close" data-dismiss="modal">&times;</button>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        @include('claimadministrators.show-info')
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <!-- END: Claim Administrator  Modal Popup-->
                                                </td>
                                                 <td>{{ $claim->company_type }}</td> 
                                                <td> {{ ($claim->start_time) ? date('h:i A', strtotime($claim->start_time)) : ''}} 
                                                    {{ ($claim->end_time) ? date('h:i A', strtotime($claim->end_time)) : ''}}
                                                    {{$claim->time_zone_type}}
                                                </td>
                                                <td>{{ $claim->website }}</td>
                                                <td>{{ $claim->affiliated_entries}}</td>
                                                <td>{{ $claim->is_active ? 'Active' : 'Block' }}</td>
                                                <td>

                                                    @if ($claim->is_active == 1)
                                                        @can('claim-admin-edit')
                                                         <a data-id="{{ $claim->id }}" href="{{ route('claimadministrators.edit', $claim->id) }}">
                                                            <i  class="icon-pencil  showPointer"/></i>
                                                         </a>
                                                        @endcan
                                                        @can('claim-admin-delete')
                                                            @if ($claim->claimAdminInjury && count($claim->claimAdminInjury) == 0)
                                                                <a data-id="{{ $claim->id }}"
                                                                    onclick="deleteTodo({{ $claim->id }})">
                                                                    <i class="icon-trash showPointer" /></i>
                                                                </a>
                                                            @endif
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
                    @endcan
                   </div>
                </div>
            </div>
            <div class="col-1 mt-4"></div>
        </div>
    </div>
@endsection

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://code.jquery.com/jquery-migrate-1.2.1.js"></script> 
<script src="{{ asset('/js/controller/claimadministrators.js') }}"></script>