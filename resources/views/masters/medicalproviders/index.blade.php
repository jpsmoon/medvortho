@extends('layouts.home-app')


@section('content')
    <!-- START: Breadcrumbs-->
     <div class="row ">
        <div class="col-12  align-self-center">
            <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                <div class="w-sm-100 mr-auto"><h4 class="mb-0">Medical Providers</h4></div>

                <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                    <li class="breadcrumb-item">
                    @can('MedicalProvider-create')
                    <a class="btn btn-success text-white" id="myBtn" data-toggle="modal" data-target="#addModal" onclick="show_addmodal();"> Add New</a>
                        @endcan
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
                                                <th class="jsgrid-header-cell jsgrid-header-sortable">No.</th>
                                                <th class="jsgrid-header-cell jsgrid-header-sortable">MPN ID</th>
                                                <th class="jsgrid-header-cell jsgrid-header-sortable">Applicant Name</th>
                                                <th class="jsgrid-header-cell jsgrid-header-sortable">Applicant Type</th>
                                                <th class="jsgrid-header-cell jsgrid-header-sortable">MPN Name</th>
                                                <th class="jsgrid-header-cell jsgrid-header-sortable">MPN Status</th>
                                                <th class="jsgrid-header-cell jsgrid-header-sortable">Approval Date</th>
                                                <th class="jsgrid-header-cell jsgrid-header-sortable">Website</th>
                                                <th class="jsgrid-header-cell jsgrid-header-sortable">Status</th>
                                                <th class="jsgrid-header-cell jsgrid-header-sortable">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @if(count($medicalproviders))
                                                @foreach ($medicalproviders as $medicalprovider)
                                                <tr  id="todo_{{$medicalprovider->id}}" class="jsgrid-row">
                                                    <td class="jsgrid-cell">{{ ++$i }}</td>
                                                    <td class="jsgrid-cell">{{ $medicalprovider->mpn_no }}</td>
                                                    <td class="jsgrid-cell">{{ $medicalprovider->applicant_name }}</td>
                                                    <td class="jsgrid-cell">
                                                        @foreach($mdcl_provider_types as $type)
                                                        {{($type['id'] == $medicalprovider->applicant_type) ? $type['value'] : ''}}
                                                        @endforeach
                                                    </td>
                                                    <td class="jsgrid-cell">{{ $medicalprovider->mpn_name }}</td>
                                                    <td class="jsgrid-cell">{{ $medicalprovider->mpn_status }}</td>
                                                    <td class="jsgrid-cell">{{ $medicalprovider->approval_date }}</td>
                                                    <td class="jsgrid-cell">{{ $medicalprovider->website_url }}</td>
                                                    <td class="jsgrid-cell">{{ $medicalprovider->is_active ? 'Active' : 'Block' }}</td>
                                                    <td class="jsgrid-cell">
                                                        @if($medicalprovider->is_active == '0' || $medicalprovider->deleted_at != '')
                                                            @can('MedicalProvider-delete')
                                                            <a data-id="{{$medicalprovider->id}}" class="btn btn-success" onclick="restoreTodo({{$medicalprovider->id}})">Restore</a>
                                                            @endcan
                                                        @else
                                                            @can('MedicalProvider-edit')
                                                            <a data-id="{{$medicalprovider->id}}" data-toggle="modal" data-target="#editModal" onclick="editTodo({{$medicalprovider->id}})">
                                                                <input class="jsgrid-button jsgrid-edit-button" type="button" title="Edit" data-id="{{$medicalprovider->id}}">
                                                            </a>
                                                            @endcan
                                                            @can('MedicalProvider-delete')
                                                            <a data-id="{{$medicalprovider->id}}" onclick="deleteTodo({{$medicalprovider->id}})">
                                                            <input data-id="{{$medicalprovider->id}}" class="jsgrid-button jsgrid-delete-button" type="button"></input>
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
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModalModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="SubmitForm" >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalModalLabel">Add Medical Provider</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                        <div class="form-row form-group">
                            <div class="form-holder col-md-4">
                                <strong>MPN ID.<span class="required">* </span>:</strong>
                                <input type="text" name="mpn_no" id="mpn_no" maxlength="55" onkeypress="return isAlphaNumericKey(event)" class="form-control" placeholder="MPN ID">
                            </div>
                            <div class="form-holder col-md-4">
                                <strong>Applicant Name<span class="required">* </span>:</strong>
                                <input type="text" name="applicant_name" id="applicant_name" maxlength="155" class="form-control" placeholder="Applicant Name" onkeypress="return isAlpha(event)">
                            </div>
                            <div class="form-holder col-md-4">
                                <strong>Applicant Type<span class="required">* </span>:</strong>
                                <select name="applicant_type" id="applicant_type" class="form-control" >
                                    <option value="">Select</option>
                                    @foreach($mdcl_provider_types as $type)
                                    <option value="{{$type['id']}}">{{$type['value']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row form-group">
                            <div class="form-holder col-md-4">
                                <strong>MPN Name:</strong>
                                <input type="text" name="mpn_name" id="mpn_name" maxlength="155" class="form-control" placeholder="MPN Name" onkeypress="return isAlpha(event)">
                            </div>
                            <div class="form-holder col-md-4">
                                <strong>Approval Date:</strong>
                                <input type="date" name="approval_date" id="approval_date" maxlength="10" class="form-control" placeholder="Approval Date">
                            </div>
                            <div class="form-holder col-md-4">
                                <strong>MPN Status:</strong>
                                <select name="mpn_status" class="form-control"  id="mpn_status">
                                    <option value="">Select</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row form-group">
                            <div class="form-holder col-md-4">
                                <strong>Website:</strong>
                                <input type="text" name="website_url" id="website_url" maxlength="255" class="form-control" placeholder="Website">
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
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="EditForm" >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Medical Provider</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="mpn_id" id="mpn_id" class="form-control">
                    <div class="form-row form-group">
                        <div class="form-holder col-md-4">
                            <strong>MPN ID.<span class="required">* </span>:</strong>
                            <input type="text" name="editmpn_no" id="editmpn_no" maxlength="55" class="form-control" placeholder="MPN ID" onkeypress="return isAlphaNumericKey(event)">
                        </div>
                        <div class="form-holder col-md-4">
                            <strong>Applicant Name<span class="required">* </span>:</strong>
                            <input type="text" name="editapplicant_name" id="editapplicant_name" maxlength="155" class="form-control" placeholder="Applicant Name" onkeypress="return isAlpha(event)">
                        </div>
                        <div class="form-holder col-md-4">
                            <strong>Applicant Type<span class="required">* </span>:</strong>
                            <select name="editapplicant_type" id="editapplicant_type" class="form-control" >
                                <option value="">Select</option>
                                @foreach($mdcl_provider_types as $type)
                                <option value="{{$type['id']}}" >{{$type['value']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-row form-group">
                        <div class="form-holder col-md-4">
                            <strong>MPN Name:</strong>
                            <input type="text" name="editmpn_name" id="editmpn_name" maxlength="155" class="form-control" placeholder="MPN Name" onkeypress="return isAlpha(event)">
                        </div>
                        <div class="form-holder col-md-4">
                            <strong>Approval Date:</strong>
                            <input type="date" name="editapproval_date" id="editapproval_date" maxlength="10" class="form-control" placeholder="Approval Date">
                        </div>
                        <div class="form-holder col-md-4">
                            <strong>MPN Status:</strong>
                            <select name="editmpn_status" class="form-control"  id="editmpn_status">
                                <option value="">Select</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-row form-group">
                        <div class="form-holder col-md-4">
                            <strong>Website:</strong>
                            <input type="text" name="editwebsite_url" id="editwebsite_url" maxlength="255" class="form-control" placeholder="Website">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="updateTodo()" >Update</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Modal content -->
<script src="{{ asset('js/controller/medicalproviders.js') }}"></script>

@endsection
