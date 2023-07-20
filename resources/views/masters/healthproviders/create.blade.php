@extends('layouts.home-app')


@section('content')
<!-- START: Breadcrumbs-->
<div class="row ">
        <div class="col-12  align-self-center">
            <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                <div class="w-sm-100 mr-auto"><h4 class="mb-0">Add Rendering Provider</h4></div>

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
                                <form action="{{ route('healthproviders.store') }}" enctype="multipart/form-data" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-12">
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                   <label>   NPI     </label>
                                                        <input type="text" name="npi" class="form-control" onkeypress="return isAlphaNumericKey(event)">
                                                </div>
                                                <div class="form-group col-md-6 pr-2">
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input class="custom-control-input" type="radio" name="entity_type" checked id="flexRadioDefault1" value="Person" onclick="show_entity_type()"/>
                                                        <label for="flexRadioDefault1" class="custom-control-label">   Person   </label>
                                                    </div>
                                                    <div class="custom-control custom-radio custom-control-inline">
                                                        <input class="custom-control-input" type="radio" name="entity_type" id="flexRadioDefault2" value="Non-Person"  onclick="show_entity_type()"/>
                                                        <label class="custom-control-label" for="flexRadioDefault2">   Non-Person     </label>
                                                    </div>
                                                </div>
                                            </div>
                                                <div class="form-row" id="person_entity">
                                                     <div class="form-group col-md-6">
                                                        <label for="" style="float:left;">    First Name <span class="required">* </span>     </label>
                                                        <input type="text" name="first_name" class="form-control"  maxlength="100" onkeypress="return isAlpha(event)">
                                                    </div>
                                                     <div class="form-group col-md-6">
                                                        <label for="" style="float:left;">    Last Name <span class="required">* </span>    </label>
                                                        <input type="text" name="last_name" class="form-control"  maxlength="100" onkeypress="return isAlpha(event)">
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                        <div class="form-group col-md-6">
                                                            <label for="" style="float:left;">    MI   </label>
                                                            <input type="text" name="mi" class="form-control" maxlength="25">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="" style="float:left;">    Suffix    </label>
                                                            <input type="text" name="suffix" class="form-control" maxlength="15">
                                                        </div>
                                                </div>
                                                <div class="form-row" id="nonperson_entity" style="display:none;">
                                                     <div class="form-group col-md-6">
                                                        <label for="" style="float:left;">    Entity Name     </label>
                                                        <input type="text" name="entity_name" class="form-control">
                                                    </div>
                                                </div>

                                                @for($i = 1; $i <= 10; $i++)
                                                <div class="form-row" id="licenseDiv{{$i}}" style="display:none;">
                                                    <div class="form-group col-md-12">
                                                        <div class="form-group col-md-6">
                                                            <label for="" style="float:left;">    License No.      </label>
                                                            <input type="text" name="details[licenseno][]" placeholder="{{$i}}" class="form-control">
                                                        </div>
                                                        <div class="form-group col-md-6">
                                                            <label for="" style="float:left;"> State   </label>
                                                            <select name="details[state_id][]" class="form-control">
                                                                <option value="" class="option">Select</option>
                                                                @foreach ($states as $state)
                                                                <option value="{{$state->id}}"> {{$state->state_name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-row">
                                                            <div class="form-group col-md-6">
                                                                <label for="" style="float:left;"> &nbsp;   </label>
                                                                <label for="" style="float:left;"><a href="javascript:void(0);" onclick="removeCtrl({{$i}})"> Remove  </a> </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endfor
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label for="" style="float:left;">Provider Type </label>
                                                        <select name="provider_type" id="provider_type" class="form-control">
                                                            <option value="" class="option">Select</option>
                                                            <option value="Physician" class="option">Physician</option>
                                                            <option value="Non-Physician Practitioner" class="option">Non-Physician Practitioner</option>
                                                            <option value="Clinical Social Worker" class="option">Clinical Social Worker</option>
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
                                    </div>
                                </form>
                             </div>
                    </div>
                </div>
            </div>
        </div>

<script src="{{ asset('js/controller/healthproviders.js') }}"></script>
@endsection
