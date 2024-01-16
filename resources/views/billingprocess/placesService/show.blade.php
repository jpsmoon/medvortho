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
    <div class="row mt-0">
        <div class="col-md-12 mt-4">
            <div class="card row-background customBoxHeight">
                <!-- START: Breadcrumbs-->
                <div class="row ">
                    <div class="col-12  align-self-center">
                        <div class="sub-header py-3 px-3 align-self-center d-sm-flex w-100 rounded heading-background">
                            <div style="padding-top:10px" class="w-sm-100 mr-auto">
                                <h2 class="heading">View Place Of Service</h2>
                            </div>
                             <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                             
                            <li class="breadcrumb-item">
                                <a class="btn btn-primary" href="{{ url('/places-of-service') }}/{{$placeOfService->billing_provider_id}}"> Back</a>
                            </li>
                        </ol> 
                        </div>
                    </div>
                </div>
                <!-- END: Breadcrumbs-->
                <div class="card-content">
                    <div class="card-body2" style="padding-left:30px; margin-top: 1rem;">
                    <div class="row" style="padding-left:10px">
                        <div class="col-md-4">
                            <div class="w-sm-100 mr-auto">
                                <i class="fa-solid fa-location-dot"></i>
                                <span class="bold"> {{ $placeOfService ? $placeOfService->location_name : '-' }}</span><br>
                                <span>Place of Service</span>
                            </div> 
                        </div>
                        
                        <div class="col-md-4">
                            <a href="{{ url('edit/places-of-service') }}/{{$placeOfService->billing_provider_id}}/{{$placeOfService->id}}" class="btn btn-primary"><i class="icon-note"></i> Edit</span></a>
                        </div>
                    </div>
                    <hr>
                       <div class="row" style="padding-left:10px"> 
                        <div class="col-md-4">
                            <label class="bold" for="rendering_provider_npi">Location Name :-</label><br>
                            <span>
                                {{ $placeOfService ? $placeOfService->location_name : '-' }}
                            </span>
                        </div>
                        
                        <div class="col-md-4">
                            <label class="bold" for="rendering_provider_npi">Nickname :-</label><br>
                            <span>
                                {{ $placeOfService ? $placeOfService->location_name : '-' }}
                            </span>
                        </div>

                    </div>
                    <hr>
                    
                    <div class="row" style="padding-left:10px"> 
                        <div class="col-md-4">
                            <label class="bold" for="rendering_provider_npi">Place of Service Code :-</label><br>
                            <span>{{ $placeOfService ? ($placeOfService->placeOfServiceCode ? $placeOfService->placeOfServiceCode->name : 'NA') : '-' }}</span>
                        </div>
                        
                        <div class="col-md-4">
                            <label class="bold" for="rendering_provider_npi">NPI :-</label><br>
                            <span >{{ $placeOfService ? $placeOfService->npi : '-' }}</span>
                        </div>
                    </div>
                    <hr> 
                    
                    <div class="row" style="padding-left:10px"> 
                        <div class="col-md-4">
                            <label class="bold" for="signature_img">Address :-</label><br>
                            <span>
                            {{ ($placeOfService->address_line1) ? $placeOfService->address_line1 : ''}}
                            {{ ($placeOfService->address_line2) ? ', '.$placeOfService->address_line2 : '' }}
                            {{ ($placeOfService->city_id) ? ', '.$placeOfService->city_id : ''}}
                            {{ ($placeOfService->state_id) ? ', '.strtoupper( substr( $placeOfService->state_id, 0, 2 )) : ''}} 
                            {{ $placeOfService->zipcode }}
                            </span>
                        </div>
                        
                        <div class="col-md-4">
                            <label class="bold" for="rendering_provider_npi"> Active :-</label><br>
                                    <span>{{ $placeOfService ? ($placeOfService->is_active == 1 ? 'Yes' : 'No') : '-' }}</span>
                        </div>
                    </div>
                    <hr> 
                    <div class="row" style="padding-left:30px">
                          <h3>History</h3>
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
<script src="{{ asset('js/bootstrap-inputmask.js') }}"></script>
<script src="{{ asset('js/controller/master_for_all.js') }}"></script>
<script></script>
