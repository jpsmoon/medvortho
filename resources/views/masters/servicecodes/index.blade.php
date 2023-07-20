@extends('layouts.home-app')


@section('content')

    <!-- START: Breadcrumbs-->
    <div class="row ">
        <div class="col-12  align-self-center">
            <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                <div class="w-sm-100 mr-auto"><h4 class="mb-0">Service Codes</h4></div>

                <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                    <li class="breadcrumb-item">
                        <a class="btn btn-success text-white" id="myBtn" onclick="show_addmodal();" data-toggle="modal" data-target="#addModal"> Add New</a>
                        @can('PlaceOfServiceCode-create')

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
                                            <th class="jsgrid-header-cell jsgrid-header-sortable">No</th>
                                            <th class="jsgrid-header-cell jsgrid-header-sortable">Code</th>
                                            <th class="jsgrid-header-cell jsgrid-header-sortable">Service Name</th>
                                            <th class="jsgrid-header-cell jsgrid-header-sortable">Nick Name</th>
                                            <th class="jsgrid-header-cell jsgrid-header-sortable">NPI</th>
                                            <th class="jsgrid-header-cell jsgrid-header-sortable">Address</th>
                                            <th class="jsgrid-header-cell jsgrid-header-sortable">Status</th>
                                            <th class="jsgrid-header-cell jsgrid-header-sortable">Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($service_codes))
                                            @foreach ($service_codes as $service_code)
                                            <tr  id="todo_{{$service_code->id}}" class="jsgrid-row">
                                                <td class ="jsgrid-cell">{{ ++$i }}</td>
                                                <td class ="jsgrid-cell">{{ $service_code->code }}</td>
                                                <td class ="jsgrid-cell">{{ $service_code->place_of_service_name }}</td>
                                                <td class ="jsgrid-cell">{{ $service_code->nick_name }}</td>
                                                <td class ="jsgrid-cell">{{ $service_code->npi }}</td>
                                                <td class ="jsgrid-cell">{{ $service_code->address_line1 }}&nbsp;{{ $service_code->address_line2 }}</td>
                                                <td class ="jsgrid-cell">{{ $service_code->is_active ? 'Active' : 'Block' }}</td>
                                                <td class ="jsgrid-cell">
                                                    @if($service_code->is_active == '0' || $service_code->deleted_at != '')
                                                        @can('PlaceOfServiceCode-delete')
                                                        <a data-id="{{$service_code->id}}" class="btn btn-success" onclick="restoreTodo({{$service_code->id}})">Restore</a>
                                                        @endcan
                                                    @else
                                                        @can('PlaceOfServiceCode-edit')
                                                        <a data-id="{{$service_code->id}}" onclick="editTodo({{$service_code->id}})" data-toggle="modal" data-target="#editModal">
                                                        <input class="jsgrid-button jsgrid-edit-button" type="button" title="Edit" data-id="{{$service_code->id}}">
                                                        </a>
                                                        @endcan
                                                        @can('PlaceOfServiceCode-delete')
                                                        <a data-id="{{$service_code->id}}" onclick="deleteTodo({{$service_code->id}})">
                                                        <input data-id="{{$service_code->id}}" class="jsgrid-button jsgrid-delete-button" type="button"></input>
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
    {!! $service_codes->links() !!}


<!-- Modal content -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="SubmitForm" >
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Add Service Code</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-row form-group">
                        <div class="form-holder col-md-4">
                            <strong>Code<span class="required">* </span>:</strong>
                            <input type="text" name="code" id="code" maxlength="55" class="form-control" placeholder="Code" onkeypress="return isAlphaNumericKey(event)">
                        </div>
                        <div class="form-holder col-md-4">
                            <strong>Place of Service<span class="required">* </span>:</strong>
                            <input type="text" name="name" id="name" maxlength="55" class="form-control" placeholder="Name" onkeypress="return isAlpha(event)">
                        </div>
                        <div class="form-holder col-md-4">
                            <strong>Nick Name:</strong>
                            <input type="text" name="nick_name" id="nick_name" maxlength="55" class="form-control" placeholder="Nick Name" onkeypress="return isAlpha(event)">
                        </div>
                    </div>
                    <div class="form-row form-group">
                        <div class="form-holder col-md-4">
                            <strong>NPI<span class="required">* </span>:</strong>
                            <input type="text" name="npi" id="npi" maxlength="15" class="form-control" placeholder="NPI" onkeypress="return isAlphaNumericKey(event)">
                        </div>
                    </div>
                    <div class="form-row form-group">
                        <div class="form-holder col-md-3">
                            <strong>Country:</strong>
                            <select name="country_id" class="form-control"  id="countryDD">
                                <option value="">Select</option>
                                @foreach ($countries as $country)
                                <option value="{{$country->id}}"> {{$country->country_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-holder col-md-3">
                            <strong>State:</strong>
                            <select name="state_id" class="form-control stateDD" id="stateDD">
                                <option value="">Select</option>
                            </select>
                        </div>
                        <div class="form-holder col-md-3">
                            <strong>City:</strong>
                            <select name="city_id" id="cityDD" class="form-control cityDD">
                                <option value="">Select</option>
                            </select>
                        </div>
                        <div class="form-holder col-md-3">
                            <strong>Zipcode:</strong>
                            <input type="text" name="zipcode" id="zipcode" class="form-control" maxlength="15" onkeypress="return isNumberKey(event)">
                        </div>
                    </div>
                    <div class="form-row form-group">
                        <div class="form-holder col-md-6">
                            <strong>Address Line1<span class="required">* </span>:</strong>
                            <textarea class="form-control" name="address_line1" id="address_line1" style="resize:none;"></textarea>
                        </div>
                        <div class="form-holder col-md-6">
                            <strong>Address Line2:</strong>
                            <textarea class="form-control" name="address_line2" id="address_line2" style="resize:none;"></textarea>
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
                    <h5 class="modal-title" id="editModalLabel">Edit Service Code</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="service_code_id" id="service_code_id" class="form-control">
                    <div class="form-row form-group">
                        <div class="form-holder col-md-4">
                            <strong>Code<span class="required">* </span>:</strong>
                            <input type="text" name="editcode" id="editcode" maxlength="55" class="form-control" placeholder="Code" onkeypress="return isAlphaNumericKey(event)">
                        </div>
                        <div class="form-holder col-md-4">
                            <strong>Place of Service<span class="required">* </span>:</strong>
                            <input type="text" name="editname" id="editname" maxlength="55" class="form-control" placeholder="Name" onkeypress="return isAlpha(event)">
                        </div>
                        <div class="form-holder col-md-4">
                            <strong>Nick Name:</strong>
                            <input type="text" name="editnick_name" id="editnick_name" maxlength="55" class="form-control" placeholder="Nick Name" onkeypress="return isAlpha(event)">
                        </div>
                    </div>
                    <div class="form-row form-group">
                        <div class="form-holder col-md-4">
                            <strong>NPI<span class="required">* </span>:</strong>
                            <input type="text" name="editnpi" id="editnpi" maxlength="15" class="form-control" placeholder="NPI" onkeypress="return isAlphaNumericKey(event)">
                        </div>
                    </div>
                    <div class="form-row form-group">
                        <div class="form-holder col-md-3">
                            <strong>Country:</strong>
                            <select name="editcountry_id" class="form-control"  id="editcountryDD">
                                <option value="">Select</option>
                                @foreach ($countries as $country)
                                <option value="{{$country->id}}"> {{$country->country_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-holder col-md-3">
                        <strong>State:</strong>
                            <select name="editstate_id" class="form-control" id="editstateDD">
                                <option value="">Select</option>
                            </select>
                        </div>
                        <div class="form-holder col-md-3">
                            <strong>City:</strong>
                            <select name="editcity_id" id="editcityDD" class="form-control">
                                <option value="">Select</option>
                            </select>
                        </div>
                        <div class="form-holder col-md-3">
                            <strong>Zipcode:</strong>
                            <input type="text" name="editzipcode" id="editzipcode" class="form-control" maxlength="15" onkeypress="return isNumberKey(event)">
                        </div>
                    </div>
                    <div class="form-row form-group">
                        <div class="form-holder col-md-6">
                            <strong>Address Line1<span class="required">* </span>:</strong>
                            <textarea class="form-control" name="editaddress_line1" id="editaddress_line1" style="resize:none;"></textarea>
                        </div>
                        <div class="form-holder col-md-6">
                            <strong>Address Line2:</strong>
                            <textarea class="form-control" name="editaddress_line2" id="editaddress_line2" style="resize:none;"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" onclick="updateTodo()">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!-- Modal content -->



<script src="{{ asset('js/controller/servicecodes.js') }}"></script>

@endsection
