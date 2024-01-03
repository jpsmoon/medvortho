@extends('layouts.home-app')
@section('content')

<?php $billingId = 1;
if (isset($id)){
$billingId = $bRenderings->provider_type;
}
 ?>
 
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
                            <div style="padding-top:10px" class="w-sm-100 mr-auto">
                                <h2 class="heading">Add Practice Location</h2>
                            </div>
                             <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                            <li class="breadcrumb-item">
                                <a class="btn btn-primary" href="{{ url('/list/rfa/practice/locations', $billingProvider->id) }}"> Back</a>
                            </li>
                        </ol> 
                        </div>
                    </div>
                </div>
                <!-- END: Breadcrumbs-->
                <div class="card-content">
                    <div class="col-md-12 col-12">
                        <div class="row">
                            
                            <div class="col-12 mt-4">
                    <form action="{{ route('storePracticeLocation') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="billingProviderId" id="billingProviderId" value="{{ $billingProvider->id }}">
                        <input type="hidden" name="practiceLocationId" id="practiceLocationId" value="{{ $id }}">
                        
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 border-bottom2">
                                <div class="form-row col-md-12">
                                    
                                    <div class="form-group col-md-6">
                                        <label for="practice_name" class="paddingtop">Practice Name<span class="required">*
                                            </span></label>
                                        <input type="text" name="practice_name"
                                            data-validation="required"data-validation-error-msg=""
                                            class="form-control" maxlength="100"
                                            value="{{($billingProvider) ? $billingProvider->professional_provider_name : ''}}">
                                        @if ($errors->has('practice_name'))
                                            <span class="invalid-feedback" style="display:block" role="alert">
                                                <strong
                                                    class="invalid-feedback">{{ $errors->first('practice_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="nick_name" class="paddingtop">Nick Name<span class="required">*
                                            </span></label>
                                        <input type="text" data-validation="required" name="nick_name" class="form-control" maxlength="100"
                                            value="">
                                        @if ($errors->has('nick_name'))
                                            <span class="invalid-feedback" style="display:block" role="alert">
                                                <strong class="invalid-feedback">{{ $errors->first('nick_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-xs-12 col-sm-12 col-md-12 border-bottom2">
                                <div class="form-row col-md-12">
                                    
                                    <div class="form-group col-md-4">
                                        <label for="address1" class="paddingtop">Address Line 1 </label>
                                        <input type="text" name="address1" class="form-control" maxlength="100" value="">
                                        @if ($errors->has('address1'))
                                            <span class="invalid-feedback" style="display:block" role="alert">
                                                <strong
                                                    class="invalid-feedback">{{ $errors->first('address1') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    <div class="form-group col-md-4">
                                        <label for="address2" class="paddingtop">Address Line 2</label>
                                        <input type="text" name="address2" class="form-control" maxlength="100" value="">
                                        @if ($errors->has('address2'))
                                            <span class="invalid-feedback" style="display:block" role="alert">
                                                <strong
                                                    class="invalid-feedback">{{ $errors->first('address2') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-row col-md-12">
                                    
                                    <div class="form-group col-md-4">
                                        <label for="city_id" class="paddingtop">City</label>
                                       <input type="text" name="city_id" id="cityDD" class="form-control cityDD" maxlength="55">
                                        @if ($errors->has('city_id'))
                                            <span class="invalid-feedback" style="display:block" role="alert">
                                                <strong
                                                    class="invalid-feedback">{{ $errors->first('city_id') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                  <div class="form-group col-md-4">
                                    <label for="state_id" class="paddingtop"> State </label>
                                        <select name="state_id" class="form-control stateDD" id="stateDD">
                                            <option value="" class="option">Select</option>
                                            @foreach ($states as $state)
                                            <option value="{{$state["state_code"]}}"> {{$state["state_name"]}}</option>
                                            @endforeach
                                        </select>

                                        @if($errors->has('state_id'))
                                        <span class="invalid-feedback" style="display:block" role="alert">
                                            <strong>{{ $errors->first('state_id') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label for="zipCode" class="paddingtop">Zip Code</label>
                                        <input type="text" data-mask="99999-9999" name="rendering_provider_npi" class="form-control" maxlength="100"
                                            value="">
                                        @if ($errors->has('zipCode'))
                                            <span class="invalid-feedback" style="display:block" role="alert">
                                                <strong
                                                    class="invalid-feedback">{{ $errors->first('zipCode') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                            
                            <div class="col-md-12 border-bottom2">
                                <div class="form-row col-md-12">
                                    <div class="form-group col-md-4">
                                        <label for="telephone_num" class="paddingtop">Telephone</label>
                                        <input type="text" data-mask="(999) 999-9999" name="telephone_num"  class="form-control" maxlength="100"  value="">
                                        @if ($errors->has('telephone_num'))
                                            <span class="invalid-feedback" style="display:block" role="alert">
                                                <strong
                                                    class="invalid-feedback">{{ $errors->first('telephone_num') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-2 title">
                                    </div>
                                    <div class="form-row col-md-10">
                                        <div class="form-group col-md-4">
                                            <button type="submit" style="min-width: 120px" class="btn btn-primary ladda-button">
                                             <span class="ladda-label">Add</span></button>
                                            
                                            <button style="min-width: 120px" class="btn btn-primary ladda-button"><span
                                            class="ladda-label">Cancel</span></button>
                                            
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
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://code.jquery.com/jquery-migrate-1.2.1.js"></script>
<script src="{{ asset('js/bootstrap-inputmask.js') }}"></script>
<script src="{{ asset('js/controller/master_for_all.js') }}"></script>
<script></script>
