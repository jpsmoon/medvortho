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
        <div class="row mt-1 customBox">
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
    <div class="row mt-1">
        <div class="col-md-12 mt-0">
            <div class="card row-background customBoxHeight5">
                <!-- START: Breadcrumbs-->
                <div class="row ">
                    <div class="col-12  align-self-center">
                        <div class="sub-header py-3 px-1 align-self-center d-sm-flex w-100 rounded heading-background">
                            <div style="padding-top:10px" class="w-sm-100 mr-auto">
                                <h2 class="heading">CMS 1500 Forms</h2>
                            </div>
                             <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                            <li class="breadcrumb-item">
                                <a class="btn btn-primary" href="{{ url('/billing/providers/setting', $providerId) }}"> Back</a>
                            </li>
                        </ol> 
                        </div>
                    </div>
                </div>
                <!-- END: Breadcrumbs-->
                <div class="card-content">
                    <div class="card-content">
                            <div class="card-body2">
                            <form method="GET" action="{{ route('viewBillingCMS', $providerId) }}"  id="formView">
                                    <div class="form-row">
                                        <div class="col-md-12">
                                            <div class="form-row">
                                                <div class="form-group col-md-3">
                                                    <label for="rendering_Id" class="paddingtop">Rendering Provider<span class="required">* </span></label>
                                                    <select name="rendering_Id" class="form-control" id="rendering_Id" data-validation-event="change" data-validation="required"
            data-validation-error-msg="">
                                                    <option value="">-Select-</option>
                                                    @foreach ($renderings as $refering)
                                                        <option value="{{ $refering->referring_provider_first_name }}">{{$refering->referring_provider_first_name}}</option>
                                                    @endforeach
                                                    </select>
                                                    @if ($errors->has('rendering_Id'))
                                                        <span class="invalid-feedback" style="display:block" role="alert">
                                                            <strong
                                                            class="invalid-feedback">{{ $errors->first('rendering_Id') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="place_of_services_Id" class="paddingtop">Place of Service<span class="required">*
                                                        </span></label>
                                                    <select name="place_of_services_Id" class="form-control" id="place_of_services_Id" data-validation-event="change" data-validation="required"
            data-validation-error-msg="">
                                                    <option value="">-Select-</option>
                                                    @foreach ($placeOfServices as $placeOfService)
                                                        <option value="{{ $placeOfService->nick_name }}">{{$placeOfService->nick_name}}</option>
                                                    @endforeach
                                                    </select>
                                                    @if ($errors->has('rendering_provider_npi'))
                                                        <span class="invalid-feedback" style="display:block" role="alert">
                                                            <strong
                                                            class="invalid-feedback">{{ $errors->first('rendering_provider_npi') }}</strong>
                                                        </span>
                                                    @endif
                                                </div> 
                                                <div class="form-group col-md-3">
                                                    <label for="refering_provider" class="paddingtop">Referring Provider</label>
                                                    <select name="refering_provider" class="form-control" id="refering_provider">
                                                    <option value="">-Select-</option>
                                                    @foreach ($bRenderings as $referingProvider)
                                                        <option value="{{ $referingProvider->referring_provider_first_name }}">{{$referingProvider->referring_provider_first_name}}</option>
                                                    @endforeach
                                                    </select>
                                                    @if ($errors->has('refering_provider'))
                                                        <span class="invalid-feedback" style="display:block" role="alert">
                                                            <strong
                                                            class="invalid-feedback">{{ $errors->first('refering_provider') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-3">
                                                    <label for="state_id" class="paddingtop">Injury State<span class="required">*
                                                        </span></label>
                                                    <select name="state_id" class="form-control" id="state_id" data-validation-event="change" data-validation="required"
            data-validation-error-msg="">
                                                    <option value="">-Select-</option>
                                                    @foreach ($states as $state)
                                                        <option value="{{$state['state_name']}}">{{$state['state_name']}}</option>
                                                    @endforeach
                                                    </select>
                                                    @if ($errors->has('state_id'))
                                                        <span class="invalid-feedback" style="display:block" role="alert">
                                                            <strong
                                                            class="invalid-feedback">{{ $errors->first('state_id') }}</strong>
                                                        </span>
                                                    @endif
                                                </div>
                                            </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-4">
                                                        <button type="submit" style="min-width: 120px" class="btn btn-primary ladda-button" data-style="expand-right">
                                                            <span class="ladda-label buttonfont">Preview CMS1500</span><span class="ladda-spinner"></span>
                                                         </button>
                                                    </div>
                                                </div>
                                            </div> 
                                        </div>
                                    </div>
                                    {!! Form::close() !!}
                                <div class="form-row col-md-12 ">
                                    <div class="form-row col-md-12 border-bottom2">
                                        <div class="form-row col-md-12">
                                            <a href="javascript:void(0)" onclick="myFunction()"><i class="fa fa-history" style="padding-top:4px;"></i>&nbsp;&nbsp;
                                            <label for="rendering_provider_npi">History </label>&nbsp;&nbsp;
                                            <i class="fa fa-angle-down" style="padding-top:2px; font-size: 18px;"></i></a>
                                            
                                            <div class="table-responsive" style="display:none" id="myDIV">
                                            <table id="example" class="table layout-secondary dataTable table-striped table-bordered">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th scope="col">Date</th>
                                                    <th scope="col">User</th>
                                                    <th scope="col">Details</th>
                                                </tr>
                                            </thead>
                                                <tbody>
                                                
                                                        <tr>
                                                            <td></td>
                                                            <td></td>
                                                            <td></td>
                                                        </tr>
                                                        
                                                <tr>
                                                <td colspan="10">No Records Found.</td>
                                                </tr>
                                                
                                                </tbody>
                                            </table>
                                    </div> 
                                </div>
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
