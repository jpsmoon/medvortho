@extends('layouts.home-app')


@section('content')

<!-- START: Breadcrumbs-->
<div class="row ">
        <div class="col-12  align-self-center">
            <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                <div class="w-sm-100 mr-auto"><h4 class="mb-0">Show State</h4></div>

                <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                    <li class="breadcrumb-item">
                        <a class="btn btn-primary" href="{{ route('states.index') }}"> Back11</a>
                    </li>
                </ol>
            </div>
        </div>
    </div>
    <!-- END: Breadcrumbs-->
    <div class="row">
            <div class="col-12 mt-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                <strong>Country Name:</strong>
                                    {{ $state->country_name }}
                                &nbsp;&nbsp;<strong>State:</strong>
                                    {{ $state->state_name }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
