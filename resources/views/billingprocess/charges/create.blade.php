@extends('layouts.home-new-app')
@section('content')
    <!-- START: Breadcrumbs-->
    <!-- END: Breadcrumbs-->
    
<style>
#myDIV 
{
  width: 100%;
  padding: 10px 0;
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
    <div class="row mt-0 ">
        <div class="col-md-12 mt-0">
            <div class="card row-background customBoxHeight">
                <!-- START: Breadcrumbs-->
                <div class="row ">
                    <div class="col-12  align-self-center">
                        <div class="sub-header py-3 px-1 align-self-center d-sm-flex w-100 rounded heading-background">
                            <div style="padding-top:10px" class="w-sm-100 mr-auto">
                                @if($chargeType != 2)
                                    <h2 class="heading">% {{($providerInfo) ? $providerInfo->injury_state_id : '-'}} Fee Schedule Reimbursements</h2>
                                @else
                                    <h2 class="heading">$ Expected Reimbursements</h2>
                                @endif
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
                    <div class="col-md-12 col-12">
                        <div class="row">
                    <div class="col-12 mt-4">
                        <form action="{{ route('saveBillProviderCharge') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input type="hidden" name="billingProviderId" id="billingProviderId" value="{{ $providerId }}">
                            <input type="hidden" name="chargeId" id="chargeId" value="{{ $id }}">
                            <input type="hidden" name="stateId" id="stateId" value="{{ $stateCode }}">
                            
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-row col-md-12 border-bottom2" style="padding-bottom:15px; padding-top:15px;">
                                    <div class="form-row col-md-6">
                                    <label style="width:220px" for="physician_service">Physician Services : </label>
                                    <input type="text" value="{{($chargeVal) ? $chargeVal->physician_services  : 220}}" data-validation="number length" data-validation-length="1-10" style="width:100px; padding-left:8px" id="physician_service" name="physician_service"><span class="inputfill">%</span>
                                    </div>
                                    <div class="form-row col-md-6">
                                    <label style="width:220px" for="dmepos">DMEPOS : </label>
                                    <input value="{{($chargeVal) ? $chargeVal->dmepos : 220}}" type="text"  data-validation="number length"  data-validation-length="1-10" style="width:100px; padding-left:8px" id="dmepos" name="dmepos"><span class="inputfill">%</span>
                                    </div>  
                                    </div>
                                    <div class="form-row col-md-12 border-bottom2" style="padding-bottom:15px; padding-top: 10px;">
                                    <div class="form-row col-md-6">
                                    <label style="width:220px" for="fname">Pathology : </label>
                                    <input type="text" value="{{($chargeVal) ? $chargeVal->pathology_charge : 220}}"  data-validation="number length"  data-validation-length="1-10" style="width:100px; padding-left:8px" id="pathology" name="pathology"><span class="inputfill">%</span>
                                    </div>
                                    <div class="form-row col-md-6">
                                    <label style="width:220px" for="dispensed_pharmaceuticals">Dispensed Pharmaceuticals : </label>
                                    <input type="text" value="{{($chargeVal) ? $chargeVal->dispensed_pharmaceuticals : 220}}" data-validation="number length" data-validation-length="1-10"  style="width:100px; padding-left:8px" id="dispensed_pharmaceuticals" name="dispensed_pharmaceuticals"><span class="inputfill">%</span>
                                    </div>  
                                    </div> 
                                    <div class="form-row col-md-12 border-bottom2" style="padding-bottom:15px; padding-top: 10px;">
                                    <div class="form-row col-md-6">
                                    <label style="width:220px" for="med_legal">Med Legal : </label>
                                    <input type="text" value="{{($chargeVal) ? $chargeVal->med_legal : 220}}" data-validation="number length"  data-validation-length="1-10"  style="width:100px; padding-left:8px" id="med_legal" name="med_legal"><span class="inputfill">%</span>
                                    </div>
                                    <div class="form-row col-md-6">
                                    <label style="width:220px" for="copy_service">Copy Service : </label>
                                    <input type="text" value="{{($chargeVal) ? $chargeVal->copy_service : 220}}" data-validation="number length" data-validation-length="1-10" value="220" style="width:100px; padding-left:8px" id="copy_service" name="copy_service"><span class="inputfill">%</span>
                                    </div>  
                                    </div>
                                </div>
                                <div class="col-md-12 ">
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <button  type="submit" style="min-width: 120px" class="btn btn-primary ladda-button">
                                                    <span class="ladda-label buttonfont">Save </span></button>
                                            </div>
                                        </div>
                                </div>
                        </form>
                        <div class="col-md-12 ">
                            <div class="form-row col-md-12 border-bottom2">
                                <div class="form-row col-md-4">
                                    <a href="javascript:void(0)" onclick="myFunction()"><i class="fa fa-history" style="padding-top:4px;"></i>&nbsp;&nbsp;
                                    <label for="rendering_provider_npi">History </label>&nbsp;&nbsp;
                                    <i class="fa fa-angle-down" style="padding-top:2px; font-size: 18px;"></i></a>
                                    
                                    <div style="display:none" id="myDIV">
                                        <table>
                                            <tr>
                                            <td style="min-width:180px">Date</td>
                                            <td style="min-width:180px">User</td>
                                            <td style="min-width:200px">Details</td>    
                                            </tr>   
                                        </table>
                                    
                                    </div>
                                
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 ">
                            <div class="form-row col-md-12">
                                <div class="form-group col-md-4">
                                    <h4 class="bold"> <img style="width: 23px;" src="https://medvortho.com/public/new_assets/app-assets/images/file-icon1.png"> Practice Charges</h4>
                                </div>
                            </div>
                        </div>
                    </div> 
                </div>
                	

                    <div class="form-row col-md-12 border-bottom2 {{ ($chargeType == 2) ? 'mt-2' : '' }}">
                        <div class="col-md-12">
                            <div class="form-group col-md-4" style="padding-left:2px;">
                                <a href="{{url('/setting/billing/provider/add/practice/charge/'.$providerId."/".$chargeType)}}">
                                    <span class="btn btn-primary">Add Charges</span>
                                </a>
                                <a href="javascript:void(0)" data-toggle="modal" data-target="#addModalImportDiv">
                                    <span class="btn btn-primary">Import Charges</span>
                                </a>
                            </div>
                            <table class="table table-bordered">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Effective DOS</th>
                                        <th scope="col">Expiration DOS</th>
                                        <th scope="col">Procedure Code Count</th>
                                        <th scope="col">Active</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($providerCharges)>0)
                                        @foreach ($providerCharges as $charges)
                                        <tr>
                                            <td><a href="{{url('/settings/charges/'.$charges->id."/".$providerId)}}">{{($charges->practice_name) ? $charges->practice_name : '-' }}</a></td>
                                            <td>{{ $charges->effective_dos}}</td>
                                            <td>{{ $charges->expiration_dos}}</td>
                                            <td>{{($charges->getChargesProcedureCode) ? count($charges->getChargesProcedureCode) : 0 }}</td>
                                            <td>{{($charges->status && $charges->status == 1) ? 'Yse' : 'No' }}</td> 
                                        </tr>
                                        @endforeach
                                    @else
                                    <tr> <td colspan="10">No Records Found.</td> </tr>
                                    @endif
                                    <tr>
                                </tbody>
                            </table>
                        </div>
                    </div>      
                    
                </div>
                    </div>
                </div>
            </div>
            <div class="col-1 mt-4"></div>
        </div>
    </div>
    <!-- Modal -->
        <div class="modal fade" id="addModalImportDiv" tabindex="-1" role="dialog" aria-labelledby="modelChargeLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form id="SubmitFormImport" method="POST" action="{{ url('/billing/provider/practice/charge') }}"  enctype="multipart/form-data" >
                @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modelChargeLabel">Import Charge</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" name="providerId" id="providerId" value="{{$providerId}}">
                            <input type="hidden" name="chargeType" id="chargeType" value="{{$chargeType}}">
                             <div class="row">
                                <div class="form-group col-md-12">
                                    <label for=""> Practice Charge Name<span class="required">* </span> </label>
                                    <input type="text"  data-validation-event="change" data-validation="required" data-validation-error-msg="" id="practice_charge_name_import" name="practice_charge_name_import" class="form-control ">
                                    @if($errors->has('practice_charge_name'))
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong>{{ $errors->first('practice_charge_name') }}</strong>
                                    </span>
                                    @endif
                                </div> 
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for=""> Effective DOS<span class="required">* </span> </label>
                                    <input type="text" id="effective_dos_import"  data-validation-event="change" data-validation="required"data-validation-error-msg="" name="effective_dos_import" class="form-control">
                                    @if($errors->has('effective_dos_import'))
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong>{{ $errors->first('effective_dos_import') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group col-md-3">
                                    <label for=""> Expiration DOS<span class="required">* </span> </label>
                                    <input type="text" data-validation-event="change" data-validation="required" data-validation-error-msg="" id="expiration_dos_import" name="expiration_dos_import" class="form-control">
                                    @if($errors->has('expiration_dos_import'))
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong>{{ $errors->first('expiration_dos_import') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="form-group">
                                        <strong>Import File:</strong>
                                        <input type="file" name="import_file" id="import_file"  class="form-control" placeholder="Upload file">
                                    </div>
                                </div>
                            </div> 
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Import</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    <!-- Modal content -->
@endsection
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://code.jquery.com/jquery-migrate-1.2.1.js"></script>
<script src="{{ asset('js/bootstrap-inputmask.js') }}"></script>
<script src="{{ asset('js/controller/master_for_all.js') }}"></script>
<script>
$(document).ready(function () {
    $('#effective_dos_import').datepicker({ dateFormat: 'mm/dd/yy', changeMonth: true, changeYear: true,  });
    $('#expiration_dos_import').datepicker({ dateFormat: 'mm/dd/yy', changeMonth: true, changeYear: true,  });
});
</script>
