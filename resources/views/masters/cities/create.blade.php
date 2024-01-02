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
                                <h2 class="heading"> Add New City</h2>
                            </div>
                             <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                            <li class="breadcrumb-item">
                                @can('state-create')
                                <a class="btn btn-primary text-white" href="{{ route('cities.index') }}"> Back</a>
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
            <div class="col-12 col-md-12">
                <div class="card pt-2">
                        <form action="{{ route('cities.store') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Country:</strong>
                                        <select name="country_id" class="form-control" id="countryDD">
                                            <option value="">Select Country</option>
                                            @foreach ($countries as $country)
                                            <option value="{{$country['country_name']}}" {{($country['country_name'] == 'United States') ? 'selected' : ''}}> {{$country['country_name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <strong>State:</strong>
                                        <select name="state_id" class="form-control stateDD" id="stateDD">
                                        </select>
                                    </div>
                                    
                                    
                                    <div class="form-group">
                                        <strong>Enter City Name :</strong>
                                        <input type="text" name="city_name" class="form-control" placeholder="Name">
                                    </div>
                                    <div class="form-group">
                                        <strong>Enter Zip Code:</strong>
                                        <input type="text" name="zip_code" class="form-control" placeholder="zip code">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                <button type="submit" class="btn btn-primary">Submit</button>
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

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://code.jquery.com/jquery-migrate-1.2.1.js"></script>
<script src="{{ asset('public/js/controller/master_for_all.js') }}"></script>
<script>
$(document).ready(function() {
    californiaStateByCountry('United States');
});
</script>


