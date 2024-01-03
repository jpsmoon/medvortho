@extends('layouts.home-app')
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
                                <h2 class="heading">Add New State</h2>
                            </div>
                             <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                            <li class="breadcrumb-item">
                                @can('state-create')
                                <a class="btn btn-primary text-white" href="{{ route('states.index') }}"> Back</a>
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
                        <form action="{{ route('states.store') }}" method="POST">
                                @csrf
                                <div class="row">
                                   <div class="col-12">
                                        <div class="row">
                                            <div class="col-xs-12 col-sm-12 col-md-12 mt-2">
                                                <div class="form-group">
                                                    <strong>Country:</strong>
                                                    <select name="country_id" class="form-control">
                                                        <option value="9"> United States </option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <strong>Enter State Name:</strong>
                                                    <input type="text" name="state_name" class="form-control" placeholder="Name">
                                                </div>
                                                <div class="form-group">
                                                    <strong>Enter State Code:</strong>
                                                    <input type="text" name="state_code" class="form-control" placeholder="state code">
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-sm-12 col-md-12 text-center">
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
            </div>
            <div class="col-1 mt-4"></div>
        </div>
    </div>
@endsection

