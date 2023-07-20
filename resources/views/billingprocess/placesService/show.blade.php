@extends('layouts.home-app')
@section('content')
    <style>
        .provider_heading_type {
            color: #858585;
            font-size: 14px;
            font-weight: 300;
            margin: -9px 0 10px;
        }

        .provider_heading {
            align-items: center;
            color: #3a3a3a;
            display: flex;
            font-size: 18px;
            font-weight: 600;
            line-height: normal;
            margin: 0;
            padding: 11px 0 9px;
        }
    </style>
@section('content')
    <div class="row">
        <div class="col-1 mt-4"></div>
        <div class="col-10 mt-4">
            <div class="card row-background">
                <!-- START: Breadcrumbs-->
                <div class="row">
                    <div class="col-12  align-self-center">
                        <div class="sub-header mt-3 py-3 px-1 align-self-center d-sm-flex w-100 rounded heading-background">
                            <div style="padding-top:10px; padding-left:10px" class="w-sm-100 mr-auto">
                                <h2 class="heading"> Show Place Of Service</h2>
                            </div>
                            <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                                <li class="breadcrumb-item">
                                    <a class="btn btn-primary" href=" "> Back</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- END: Breadcrumbs-->
                
                <div class="card-body" style="padding-left:30px">
                    <div class="row">
                        <div class="col-md-12">
                            <div style="padding-left:10px" class="w-sm-100 mr-auto">
                                <h2 class="heading"> {{ $placeOfService ? $placeOfService->location_name : '-' }}</h2>
                                <span>Place of Service</span>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <a href="{{ url('edit/places-of-service') }}/{{$placeOfService->billing_provider_id}}/{{$placeOfService->id}}" class="btn btn-primary"><i class="icon-note"></i> Edit</span></a>
                        </div>
                    </div>
                    <hr>
                       <div class="row"> 
                        <div class="col-md-12" style="padding-top:10px;">
                            <label for="rendering_provider_npi"> Name :-</label>
                            <span class="bold">
                                {{ $placeOfService ? $placeOfService->location_name : '-' }}
                            </span>
                        </div>

                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row" style="padding-left:10px">
                                <div class="col-md-3">
                                    <label for="rendering_provider_npi"> NPI :-</label>
                                    <span class="bold">{{ $placeOfService ? $placeOfService->npi : '-' }}</span>
                                </div>
                            </div>

                            <hr>

                            <div class="row" style="padding-left:10px">
                                <div class="col-md-3">
                                    <label for="rendering_provider_npi"> Place of Service Code :-</label>
                                    <span
                                        class="bold">{{ $placeOfService ? ($placeOfService->placeOfServiceCode ? $placeOfService->placeOfServiceCode->name : 'NA') : '-' }}</span>
                                </div>
                            </div>
                            <hr>
                            <div class="form-row mt-3" id="">
                                <div class="form-group col-md-3">
                                    <label for="signature_img">Address :-</label>
                                    <span class="bold">{{ $placeOfService ? $placeOfService->address_line1 : '-' }}
                                        {{ $placeOfService ? $placeOfService->city_id : '-' }}
                                        {{ $placeOfService ? $placeOfService->state_id : '-' }}
                                        {{ $placeOfService ? $placeOfService->zipcode : '-' }}</span>
                                </div>

                                <div class="col-md-3">
                                    <label for="rendering_provider_npi"> Active :-</label>
                                    <span><b>{{ $placeOfService ? ($placeOfService->is_active == 1 ? 'Yes' : 'No') : '-' }}</b></span>
                                </div>
                            </div>
                            <div class="row mt-3">
                                <h3>History</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-1 mt-4"></div>
    </div>
@endsection
