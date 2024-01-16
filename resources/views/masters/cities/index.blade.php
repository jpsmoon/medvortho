@extends('layouts.home-new-app')
@section('content')
    <!-- START: Breadcrumbs-->
    <!-- END: Breadcrumbs-->

    <style>
        .dataTables_length {
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
                                <h2 class="heading">Cities List</h2>
                            </div>
                            <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                                <li class="breadcrumb-item">
                                    @can('city-create')
                                        <a class="btn btn-primary" data-toggle="modal"
                                            onclick="californiaStateByCountry('United States');" data-target="#createModalCity">
                                            Add New </a>
                                    @endcan
                                </li>
                                <li class="breadcrumb-item">
                                    @can('city-create')
                                        <a class="btn btn-primary" href="{{ route('cities.index') }}"> Back</a>
                                    @endcan
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
                                        <table id="cityListTable"
                                            class="table layout-secondary dataTable table-striped table-bordered">
                                            <thead class="thead-dark">
                                                <tr class="jsgrid-header-row">
                                                    <th>No</th>
                                                    <th>Country</th>
                                                    <th>State</th>
                                                    <th>City</th>
                                                    <th>Zip code</th>
                                                    <th>Status</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

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
    <!-- Modal content -->
    <div class="modal fade" id="createModalCity" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form action="{{ route('cities.store') }}" id="createForm" enctype="multipart/form-data"
                class="form-horizontal ladda-form'" method="POST">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLabel">Add City</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Country:</strong>
                                    <select name="country_id" class="form-control" id="countryDD">
                                        @foreach ($countries as $country)
                                            <option value="{{ $country['country_name'] }}"
                                                {{ $country['country_name'] == 'United States' ? 'selected' : '' }}>
                                                {{ $country['country_name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <strong>State:</strong>
                                    <select name="state_id" class="form-control stateDD" id="stateDD">
                                        @foreach ($states as $state)
                                            <option value="{{ $state['state_code'] }}"
                                                {{ $state['state_code'] == 'CA' ? 'selected' : '' }}>
                                                {{ $state['state_name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <strong>Enter City Name :</strong>
                                    <input type="text" name="city_name" class="form-control" data-validation="required" placeholder="Name">
                                </div>
                                <div class="form-group">
                                    <strong>Enter Zip Code:</strong>
                                    <input type="text" name="zip_code" class="form-control" data-validation="required" placeholder="zip code">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Create</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal content -->
    <!-- Modal content -->
     <div class="modal fade" id="editModalCity" tabindex="-1" role="dialog" aria-labelledby="createModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form action="javascript:checkAction();" id="updateCityFrm" enctype="multipart/form-data"
                class="form-horizontal ladda-form'" method="POST">
                @csrf
                <input type="hidden" name="id" id="cityEditId">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLabel">Update City</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <strong>Country:</strong>
                                    <select name="country_id" class="form-control" id="countryDD">
                                        @foreach ($countries as $country)
                                            <option value="{{ $country['country_name'] }}"
                                                {{ $country['country_name'] == 'United States' ? 'selected' : '' }}>
                                                {{ $country['country_name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <strong>State:</strong>
                                    <select name="state_id" class="form-control stateDD" id="stateDD">
                                        @foreach ($states as $state)
                                            <option value="{{ $state['state_code'] }}"
                                                {{ $state['state_code'] == 'CA' ? 'selected' : '' }}>
                                                {{ $state['state_name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <strong>Enter City Name :</strong>
                                    <input type="text" name="city_name" id="city_nameID" class="form-control" placeholder="Name">
                                </div>
                                <div class="form-group">
                                    <strong>Enter Zip Code:</strong>
                                    <input type="text" name="zip_code" id="zip_codeID" class="form-control" placeholder="zip code">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div
    <!-- Modal content -->
@endsection
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://code.jquery.com/jquery-migrate-1.2.1.js"></script>
<script src="{{ asset('js/controller/master_for_all.js') }}"></script>
<script>
    var cityId = null;
    function checkAction(){ 
        var f = document.getElementById("updateCityFrm");
        var cityUrl = 'update/city';
        f.setAttribute('action',cityUrl); 
    } 
    $(document).ready(function() {
        californiaStateByCountry('United States');
    });
    function getCityById(cityId){
        console.log('#cityId', cityId);
        let newUrl = '/get/city/byId';
                $.ajax({
                    url: newUrl,
                    type: 'POST',
                    data: {
                        _token: token,
                        id: cityId
                    },
                    success: function(response) {
                        console.log('response', response);
                        cityId = response.id;
                        $("#cityEditId").val(response.id);
                        $('#city_nameID').val(response.city_name);
                        $('#zip_codeID').val(response.zip_code);
                        $('#stateDD option[value='+response.state_code+']').attr('selected', true);
                        checkAction();
                    },
                    error: function(response) {
                        swal.fire(response.responseJSON.message, '', 'error');
                    }
                });
    }
    function deleteCity(id) {
        swal.fire({
            title: 'Are you sure you want to delete?',
            text: "You won't be able to revert this!",
            showCancelButton: true,
            confirmButtonColor: '#3085D6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Delete it!',
            customClass: {
                confirmButton: "btn btn-primary",
                cancelButton: "btn btn-danger",
                popup: 'swal-wide',
            }
        }).then((result) => { // Use .then() to handle the user's response
            if (result.isConfirmed) { // Only proceed if the user clicked the confirm button
                let _url = `/delete/city`;
                $.ajax({
                    url: _url,
                    type: 'POST',
                    data: {
                        _token: token,
                        id: id
                    },
                    success: function(response) {
                        location.reload();
                    },
                    error: function(response) {
                        swal.fire(response.responseJSON.message, '', 'error');
                    }
                });
            }
        });
    }
</script>
<script>
    $(document).ready(function() {
        // DataTable
        $('#cityListTable').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                url: '/get-city-list'
            },
            columns: [{
                    data: 'id'
                },
                {
                    data: 'country_name'
                },

                {
                    data: 'state_name'
                },
                {
                    data: 'city_name'
                },
                {
                    data: 'zip_code'
                },
                {
                    data: 'status'
                },
                {
                    data: 'action'
                },
            ]
        });
    });
</script>
