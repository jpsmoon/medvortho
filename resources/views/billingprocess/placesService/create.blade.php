@extends('layouts.home-app')
@section('content')
<!-- START: Breadcrumbs-->
   
    <!-- END: Breadcrumbs-->
    @if ($errors->any())
    <div class="row ">
        <div class="col-1 mt-4"></div>
        <div class="col-10  align-self-center">
            <div class="sub-header mt-3 py-3 px-1 align-self-center d-sm-flex w-100 rounded">
                <div class="w-sm-100 mr-auto"><h4 class="mb-0">Place of Service</h4></div>

                <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                    <li class="breadcrumb-item">
                        <a class="btn btn-primary" href="{{url('/billing/rendering',$providerId)}}"> Back</a>
                    </li>
                </ol>
            </div>
        </div>
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
        <div class="col-1 mt-4"></div>
    </div>
    @endif
    <div class="row">
        <div class="col-1 mt-4"></div>
        <div class="col-10 mt-4">
                <div class="card row-background">
            <!-- START: Breadcrumbs-->
    <div class="row ">
        <div class="col-12  align-self-center">
            <div class="sub-header mt-3 py-3 px-1 align-self-center d-sm-flex w-100 rounded heading-background">
                <div style="padding-top:10px" class="w-sm-100 mr-auto"><h2 class="heading">{{$title}} </h2></div>
                <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                    <li style="padding-bottom:10px" class="breadcrumb-item">
                        <a class="btn btn-primary"  href="{{url('/places-of-service',$providerId)}}"> Back</a>
                    </li>
                </ol>
            </div>
        </div>
    </div>
    <!-- END: Breadcrumbs-->
                 <div class="card-content">
                 <div class="card-body">
                        <form action="{{ route('saveBillPlaceOfService') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="billingProviderId" id="billingProviderId" value="{{ $providerId }}">
                            <input type="hidden" name="placeOfServiceId" id="placeOfServiceId" value="{{ $id }}">

                            <div class="row">
                               <div class="col-xs-12 col-sm-12 col-md-12 border-bottom2">
                                    <div class="form-row col-md-12">
                                        <div class="col-md-2 title">
                                        <label>CMS 1500 Box 32</label>
                                        </div>
                                            <div class="form-group col-md-4">
                                                <label for="">Location Name <span class="required">* </span> </label>
                                                <input  data-validation-event="change" data-validation="alphanumeric" data-validation-allowing="-_ " data-validation-error-msg="" type="text" name="location_name" id="location_name" class="form-control"  value="{{($bPlaceService) ? $bPlaceService->location_name : null}}">
                                                @if($errors->has('location_name'))
                                                <span class="invalid-feedback" style="display:block" role="alert">
                                                    <strong>{{ $errors->first('location_name') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="">Nickname <span class="required">* </span> </label>
                                                <input type="text" data-validation-event="change"  data-validation="alphanumeric" data-validation-allowing="-_ " data-validation-error-msg="" name="nick_name" id="nick_name" class="form-control" value="{{($bPlaceService) ? $bPlaceService->nick_name : null}}">
                                                @if($errors->has('nick_name'))
                                                <span class="invalid-feedback" style="display:block" role="alert">
                                                    <strong>{{ $errors->first('nick_name') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        
                                    <div class="form-row col-md-12">
                                        <div class="col-md-2 title">
                                        
                                        </div>
                                            <div class="form-group col-md-4">
                                                <label for="">Address Line 1 <span class="required">* </span> </label>
                                                <input type="text" data-validation-event="change" data-validation="required"  data-validation-error-msg="" name="address_one" id="address_one" class="form-control"  value="{{($bPlaceService) ? $bPlaceService->address_line1 : null}}">
                                                @if($errors->has('address_one'))
                                                <span class="invalid-feedback" style="display:block" role="alert">
                                                    <strong>{{ $errors->first('address_one') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                            
                                            <div class="form-group col-md-4">
                                                <label for="">Address Line 2</label>
                                                <input type="text"  data-validation-optional="true" data-validation-event="change" data-validation="alphanumeric" data-validation-allowing="-_ " data-validation-error-msg="" name="address_two" id="address_two" class="form-control" value="{{($bPlaceService) ? $bPlaceService->address_line2 : null}}">
                                                @if($errors->has('address_two'))
                                                <span class="invalid-feedback" style="display:block" role="alert">
                                                    <strong>{{ $errors->first('address_two') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>    
                                    
                                    <div class="form-row col-md-12">
                                        <div class="col-md-2 title">
                                        
                                        </div>
                                            <div class="form-group col-md-4">
                                                <label for="">City </label>
                                                <input type="text" name="city_name" id="city_name" class="form-control" value="{{($bPlaceService) ? $bPlaceService->city_id : null}}">
                                                @if($errors->has('city_name'))
                                                <span class="invalid-feedback" style="display:block" role="alert">
                                                    <strong>{{ $errors->first('city_name') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                            
                                            <div class="form-group col-md-2">
                                                <?php //echo "<pre>";
                                                //print_r($bPlaceService);exit;?>
                                                <label for="">State <span class="required">* </span> </label>
                                                <select id="state_id"  name="state_id" class="form-control searcDrop" data-validation="required" data-validation-error-msg="">
                                                    <option value="" class="option">Select</option>
                                                    @foreach ($states as $state)
                                                    <option value="{{$state["state_name"]}}" {{($bPlaceService) ? ($bPlaceService->state_id == $state["state_name"]) ? 'selected' : '' : ''}}> {{$state["state_name"]}}</option>
                                                    @endforeach
                                                </select>
                                                @if($errors->has('tax_id'))
                                                <span class="invalid-feedback" style="display:block" role="alert">
                                                    <strong>{{ $errors->first('state_id') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                            
                                            <div class="form-group col-md-2">
                                                <label for="">Zip Code <span class="required">* </span> </label>
                                                <input type="text" name="zip_code" id="zip_code" class="form-control" data-mask="99999-9999" value="{{($bPlaceService) ? $bPlaceService->zipcode : null}}">
                                                @if($errors->has('zip_code'))
                                                <span class="invalid-feedback" style="display:block" role="alert">
                                                    <strong>{{ $errors->first('zip_code') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                            
                                        </div>
                                        
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 border-bottom2">
                                    <div class="form-row col-md-12">
                                        <div class="col-md-2 title">
                                        <label>CMS 1500 Box 32-a</label>
                                        </div>
                                            <div class="form-group col-md-2">
                                                <label for=""> NPI  <span class="required">* </span> </label>
                                                <input type="text" value="{{($bPlaceService) ? $bPlaceService->npi : null}}" name="tax_id" id="tax_id" class="form-control">
                                                @if($errors->has('tax_id'))
                                                <span class="invalid-feedback" style="display:block" role="alert">
                                                    <strong>{{ $errors->first('tax_id') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                </div>
                                <div class="col-xs-12 col-sm-12 col-md-12 border-bottom2">
                                    <div class="form-row col-md-12">
                                        <div class="col-md-2 title">
                                        <label>CMS 1500 Box 24-b</label>
                                        </div>
                                            <div class="form-group col-md-2">
                                                <label for="">Place of Service Code<span class="required">* </span> </label>
                                                <select id="place_of_service_code"  name="place_of_service_code" class="form-control searcDrop" data-validation="required" data-validation-error-msg="">
                                                    <option value="">Please Select</option>
                                                    @foreach ($placeOfServiceCOde as $code)
                                                        <option value="{{$code->id }}" {{($bPlaceService) ? ($bPlaceService->service_code_id ==$code->id) ? 'selected' : ''  : ''}}>{{$code->service_code." - ".$code->name }}</option>
                                                    @endforeach
                                                </select>

                                                @if($errors->has('place_of_service_code'))
                                                <span class="invalid-feedback" style="display:block" role="alert">
                                                    <strong>{{ $errors->first('place_of_service_code') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                </div>
                            </div>
                            <!-- professhionalDiv end-->
                            @if($bPlaceService)
                            <div class="col-xs-12 col-sm-12 col-md-12 border-bottom2">
                                    <div class="form-row col-md-12">
                                        <div class="col-md-2 title">
                                            <label>Status</label>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <input class="" type="radio" name="place_status" id="place_status1"
                                                {{ $bPlaceService && $bPlaceService->is_active == 1 ? 'checked' : '' }}
                                                value="1" />&nbsp;&nbsp;
                                            <label for="trauma1"> Yes </label>
                                            <input class="" type="radio" name="place_status"  id="place_status2"
                                                {{ $bPlaceService && $bPlaceService->is_active == 0 ? 'checked' : '' }}
                                                value="0" />
                                            <label for="trauma2" style="cursor:hand;"> No </label>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            
                            <div class="form-row col-12">
                                    <div class="form-group col-md-2">
                                    <label for="">  <span class="required"></span> </label>
                                    </div>
                                    <div class="form-group col-md-2">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="reset" class="btn btn-secondary">Cancel</button>
                                </div>
                            </div>
                            
                            
                        </form>
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

