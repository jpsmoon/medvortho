@extends('layouts.home-app')
@section('content')
<!-- START: Breadcrumbs-->
<div class="row ">
        <div class="col-12  align-self-center">
            <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                <div class="w-sm-100 mr-auto"><h4 class="mb-0">Edit City</h4></div>

                <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                    <li class="breadcrumb-item">
                        <a class="btn btn-primary" href="{{ route('cities.index') }}"> Back</a>
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
                                <form action="{{ route('cities.update',$city->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')

                                    <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Country:</strong>
                                        <select name="country_id" class="form-control" id="countryDD" onchange="getStateByCountry(this.value)">
                                            <option value="">Select Country</option>
                                            @foreach ($countries as $country)
                                            <option value="{{$country['country_name']}}" {{ ($country['country_name'] == $city->country_name) ? 'selected' : ''}}> {{$country['country_name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <strong>State:</strong>
                                        <select name="state_id" class="form-control stateDD" id="stateDD">
                                            <option value="">Select State</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <strong>City:</strong>
                                        <input type="text" name="city_name" class="form-control" placeholder="City Name" value = "{{$city->city_name}}" >
                                    </div>
                                    <div class="form-group">
                                        <strong>Zip Code:</strong>
                                        <input type="text" name="zip_code" class="form-control" placeholder="zip code" value = "{{$city->zip_code}}">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 text-right">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>

                                </form>
                            </div>
                    </div>
                </div>
            </div>

        </div>
@endsection
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://code.jquery.com/jquery-migrate-1.2.1.js"></script>
<script src="{{ asset('js/controller/master_for_all.js') }}"></script>
<script>
   // var statId
$(document).ready(function() {
    getStateByCountry('<?php echo $city->country_name?>');
    setTimeout(function() {
   showSelectedState();
  }, 400);
})
function showSelectedState(){
    var stateName = '<?php echo $city->state_name?>';
    var dd = document.getElementById('stateDD');
    for (var i = 0; i < dd.options.length; i++) {
        if (dd.options[i].text === stateName) {
            dd.selectedIndex = i;
            break;
        }else{
            dd.selectedIndex =  null
        }
    }
}
</script>
