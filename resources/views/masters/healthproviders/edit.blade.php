@extends('layouts.home-app')

@section('content')
<!-- START: Breadcrumbs-->
<div class="row ">
        <div class="col-12  align-self-center">
            <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                <div class="w-sm-100 mr-auto"><h4 class="mb-0">Edit Rendering Provider</h4></div>

                <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                    <li class="breadcrumb-item">
                    <a class="btn btn-primary" href="{{ route('healthproviders.index') }}"> Back</a>
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
                        <form action="{{ route('healthproviders.update',$healthprovider->id) }}" enctype="multipart/form-data" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="row">
                               <div class="col-12">

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="" style="float:left;">   NPI     </label>
                                        <input type="text" name="npi" value="{{ $healthprovider->npi }}" class="form-control" onkeypress="return isAlphaNumericKey(event)">
                                    </div>

                                    <div class="form-holder col-md-6">
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" name="entity_type"  {{ ($healthprovider->entity_type == 'Person') ? 'checked' : ''}}  id="flexRadioDefault1" value="Person" onclick="show_entity_type()"/>
                                            <label for="flexRadioDefault1" class="custom-control-label"  >   Person   </label>
                                        </div>
                                        <div class="custom-control custom-radio custom-control-inline">
                                            <input class="custom-control-input" type="radio" name="entity_type" {{ ($healthprovider->entity_type == 'Non-Person') ? 'checked' : ''}} id="flexRadioDefault2" value="Non-Person"  onclick="show_entity_type()"/>
                                            <label for="flexRadioDefault2" class="custom-control-label" >   Non-Person     </label>
                                        </div>
                                    </div>
                                </div>
                                    <!-- {{$displayPerson}} >> {{$displayNonperson}} -->
                                <div class="form-row" id="person_entity" {{$displayPerson}} >
                                    <div class="form-group col-md-6">
                                        <label for="" style="float:left;">    First Name <span class="required">* </span>     </label>
                                        <input type="text" name="first_name" value="{{ $healthprovider->first_name }}" class="form-control" onkeypress="return isAlpha(event)"  maxlength="100">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="" style="float:left;">    Last Name <span class="required">* </span>    </label>
                                        <input type="text" name="last_name" value="{{ $healthprovider->last_name }}" class="form-control" onkeypress="return isAlpha(event)"  maxlength="100">
                                    </div>
                                </div>
                               <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label for="" style="float:left;">    MI   </label>
                                            <input type="text" name="mi" value="{{ $healthprovider->mi }}" class="form-control" maxlength="25">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="" style="float:left;">    Suffix    </label>
                                            <input type="text" name="suffix" value="{{ $healthprovider->suffix }}" class="form-control" maxlength="15">
                                        </div>
                                </div>
                                <div class="form-row" id="nonperson_entity" {{$displayNonperson}}>
                                    <div class="form-group col-md-6">
                                        <label for="" style="float:left;">    Entity Name     </label>
                                        <input type="text" name="entity_name" value="{{ $healthprovider->entity_name }}" class="form-control">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="" style="float:left;">Taxonomy Code </label>
                                        <select name="taxonomy_code_id" id="taxonomy_code_id" class="form-control">
                                            <option value="" class="option">Select</option>
                                            @foreach ($taxonomy_codes as $taxonomy_code)
                                            <option value="{{$taxonomy_code->id}}" {{ ($taxonomy_code->id == $healthprovider->taxonomy_code_id) ? 'selected' : ''}} > {{$taxonomy_code->name }} {{$taxonomy_code->code}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @php
                                $k = 0; $total = count($health_provider_licenses);
                                @endphp
                                @if(count($health_provider_licenses) && !empty($health_provider_licenses))
                                @foreach ($health_provider_licenses as $health_provider_license)
                                    <div class="form-row" id="licenseDiv{{$k}}" >
                                        <div class="form-group col-md-6">
                                            <input type="hidden" name="details[id{{$health_provider_license->id}}][key]" value="{{$health_provider_license->id}}" class="form-control">
                                            <label for="" style="float:left;">    License No.      </label>
                                            <input type="text" name="details[id{{$health_provider_license->id}}][licenseno]" value="{{$health_provider_license->licenseno}}" class="form-control" placeholder="{{$k}} A">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="" style="float:left;"> State   </label>
                                            <select name="details[id{{$health_provider_license->id}}][state_id]" class="form-control">
                                                <option value="" class="option">Select</option>
                                                @foreach ($states as $state)
                                                <option value="{{$state->id}}" {{ ($state->id == $health_provider_license->state_id) ? 'selected' : ''}} > {{$state->state_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @if($k == 0)
                                        <div class="form-holder col-md-3" id="addOption">
                                            <label for="" style="float:left;"> &nbsp;   </label>
                                            <label for="" style="float:left;"><a href="javascript:void(0);" onclick="addLicenseCtrl({{$total}})"> + Add Another License Number  </a> </label>
                                        </div>
                                        @else
                                        <div class="form-group col-md-6">
                                            <label for="" style="float:left;"> &nbsp;   </label>
                                            <label for="" style="float:left;"><a href="javascript:void(0);" onclick="removeCtrl({{$k}})"> Remove  </a> </label>
                                        </div>
                                        @endif
                                    </div>
                                @php
                                $k++;
                                @endphp
                                @endforeach
                                @endif

                                @for($j = $total; $j <= 10; $j++)
                                    @if($j == 0)
                                    <div class="form-row">
                                    @else
                                    <div class="form-row" id="licenseDiv{{$j}}" style="display:none;">
                                    @endif
                                        <div class="form-group col-md-6">
                                            <input type="hidden" name="details[{{$j}}][key]" value="0" class="form-control">
                                            <label for="" style="float:left;">    License No.      </label>
                                            <input type="text" name="details[{{$j}}][licenseno]" placeholder="" class="form-control">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label for="" style="float:left;"> State   </label>
                                            <select name="details[{{$j}}][state_id]" class="form-control">
                                                <option value="" class="option">Select</option>
                                                @foreach ($states as $state)
                                                <option value="{{$state->id}}"> {{$state->state_name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @if($j == 0)
                                            <div class="form-holder col-md-3" id="addOption">
                                                <label for="" style="float:left;"> &nbsp;   </label>
                                                <label for="" style="float:left;"><a href="javascript:void(0);" onclick="addLicenseCtrl()"> + Add Another License Number  </a> </label>
                                            </div>
                                        @else
                                        <div class="form-group col-md-6">
                                            <label for="" style="float:left;"> &nbsp;   </label>
                                            <label for="" style="float:left;"><a href="javascript:void(0);" onclick="removeCtrl({{$j}})"> Remove  </a> </label>
                                        </div>
                                        @endif
                                    </div>
                                @endfor
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="" style="float:left;">Provider Type </label>
                                        <select name="provider_type" id="provider_type" class="form-control">
                                            <option value="" class="option">Select</option>
                                            <option value="Physician" class="option" {{ ($healthprovider->provider_type == 'Physician') ? 'selected' : ''}} >Physician</option>
                                            <option value="Non-Physician Practitioner" {{ ($healthprovider->provider_type == 'Non-Physician Practitioner') ? 'selected' : ''}}  class="option">Non-Physician Practitioner</option>
                                            <option value="Clinical Social Worker" {{ ($healthprovider->provider_type == 'Clinical Social Worker') ? 'selected' : ''}} class="option">Clinical Social Worker</option>
                                        </select>
                                    </div>
                                    <div class="form-holder col-md-6">
                                        <label for="" style="float:left;">Signature </label>
                                        <input type="file" name="signature" class="form-control">
                                    </div>
                                </div>

                                <div class="col-xs-12 col-sm-12 col-md-12 text-right">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script src="{{ asset('js/controller/healthproviders.js') }}"></script>
@endsection
