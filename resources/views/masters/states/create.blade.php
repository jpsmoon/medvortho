@extends('layouts.home-app')


@section('content')
<!-- START: Breadcrumbs-->
<div class="row ">
        <div class="col-12  align-self-center">
            <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                <div class="w-sm-100 mr-auto"><h4 class="mb-0">Add New State</h4></div>

                <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                    <li class="breadcrumb-item">
                    <a class="btn btn-primary" href="{{ route('states.index') }}"> Back</a>
                    </li>
                </ol>
            </div>
        </div>
    </div>
    <!-- END: Breadcrumbs-->

    @if ($errors->any())
    <div class="row ">
        <div class="col-12  align-self-center">
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
    <div class="row">
        <div class="col-12 mt-4">
            <div class="card">
                    <div class="card-content">
                        <div class="card-body">
                            <form action="{{ route('states.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                   <div class="col-12">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12">
                                                <div class="form-group">
                                                    <strong>Country:</strong>
                                                    <select name="country_id" class="form-control">
                                                        @foreach ($countries as $country)
                                                        <option value="{{$country->id}}"> {{$country->country_name}}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <strong>Name:</strong>
                                                    <input type="text" name="state_name" class="form-control" placeholder="Name">
                                                </div>
                                                <div class="form-group">
                                                    <strong>Code:</strong>
                                                    <input type="text" name="state_code" class="form-control" placeholder="state code">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12 text-right">
                                                    <button type="submit" class="btn btn-primary">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection
