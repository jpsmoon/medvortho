@extends('layouts.home-app')
@section('content')

<style>
#myDIV {
  width: 100%;
  padding: 10px 0;
  
}
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<?php $billingId = 1;
?>
<!-- START: Breadcrumbs-->
<!-- END: Breadcrumbs-->
    @if ($errors->any())
        <div class="row ">
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
            <div class="card row-background" style="min-height: 565px;">
                <!-- START: Breadcrumbs-->
                <div class="row">
                    <div class="col-12  align-self-center">
                        <div class="sub-header mt-3 py-3 px-1 align-self-center d-sm-flex w-100 rounded heading-background">
                            <div style="padding-top:10px; padding-left:20px;" class="w-sm-100 mr-auto">
                                <h2 class="heading">% {{($providerInfo) ? $providerInfo->injury_state_id : '-'}} Fee Schedule Reimbursements</h2>
                            </div>
                            <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                                <li style="padding-bottom:10px" class="breadcrumb-item">
                                    <a class="btn btn-primary" href="{{ url('/billing/providers/setting', $providerId) }}"> Back</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- END: Breadcrumbs-->
                <div class="col-12 mt-4">
                    <form action="{{ route('saveBillProviderCharge') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="billingProviderId" id="billingProviderId" value="{{ $providerId }}">
                        <input type="hidden" name="chargeId" id="chargeId" value="{{ $id }}">
                        <input type="hidden" name="stateId" id="stateId" value="{{ $stateCode }}">
                        
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-row col-md-12 border-bottom2" style="padding-bottom:15px; padding-top: 10;">
                                 <div class="form-row col-md-6">
                                 <label style="width:200px" for="physician_service">Physician Services : </label>
                                 <input type="text" value="{{($chargeVal) ? $chargeVal->physician_services  : 200}}" data-validation="number length" data-validation-length="1-10" style="width:100px; padding-left:8px" id="physician_service" name="physician_service"><span class="inputfill">%</span>
                                 </div>
                                <div class="form-row col-md-6">
                                <label style="width:200px" for="dmepos">DMEPOS : </label>
                                <input value="{{($chargeVal) ? $chargeVal->dmepos : 200}}" type="text" value="200" data-validation="number length"  data-validation-length="1-10" style="width:100px; padding-left:8px" id="dmepos" name="dmepos"><span class="inputfill">%</span>
                                </div>  
                                </div>
                                <div class="form-row col-md-12 border-bottom2" style="padding-bottom:15px; padding-top: 10;">
                                 <div class="form-row col-md-6">
                                 <label style="width:200px" for="fname">Pathology : </label>
                                 <input type="text" value="{{($chargeVal) ? $chargeVal->pathology : 200}}" value="200" data-validation="number length"  data-validation-length="1-10" style="width:100px; padding-left:8px" id="pathology" name="pathology"><span class="inputfill">%</span>
                                 </div>
                                <div class="form-row col-md-6">
                                <label style="width:200px" for="dispensed_pharmaceuticals">Dispensed Pharmaceuticals : </label>
                                <input type="text" value="{{($chargeVal) ? $chargeVal->dispensed_pharmaceuticals : 200}}" data-validation="number length" data-validation-length="1-10" value="200" style="width:100px; padding-left:8px" id="dispensed_pharmaceuticals" name="dispensed_pharmaceuticals"><span class="inputfill">%</span>
                                </div>  
                                </div> 
                                <div class="form-row col-md-12 border-bottom2" style="padding-bottom:15px; padding-top: 10;">
                                 <div class="form-row col-md-6">
                                 <label style="width:200px" for="med_legal">Med Legal : </label>
                                 <input type="text" data-validation="number length"  data-validation-length="1-10" value="200" style="width:100px; padding-left:8px" id="med_legal" name="med_legal"><span class="inputfill">%</span>
                                 </div>
                                <div class="form-row col-md-6">
                                <label style="width:200px" for="copy_service">Copy Service : </label>
                                <input type="text" value="{{($chargeVal) ? $chargeVal->copy_service : 200}}" data-validation="number length" data-validation-length="1-10" value="200" style="width:100px; padding-left:8px" id="copy_service" name="copy_service"><span class="inputfill">%</span>
                                </div>  
                                </div>
                            </div>
                            <div class="col-md-12 ">
                                    <div class="form-row col-md-12">
                                        <div class="form-group col-md-4">
                                            <button {{($chargeVal) ? (
                                            $chargeVal->physician_services !=null &&   $chargeVal->pathology != null &&  $chargeVal->med_legal != null &&  $chargeVal->dmepos !=null &&   $chargeVal->dispensed_pharmaceuticals != null &&  $chargeVal->copy_service != null ) ? 'disabled' : '' : ''}}  type="submit" style="min-width: 120px" class="btn btn-primary ladda-button">
                                                <span class="ladda-label buttonfont">Save</span></button>
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
                            
                    <div class="form-row col-md-12 border-bottom2">
                                    <div class="col-md-12">
                                        <div class="form-group col-md-4" style="padding-left:17px;">
                                        <a href="{{url('/setting/billing/provider/add/practice/charge',$providerId)}}">
                                            <span class="btn btn-primary">Add Charges</span>
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
                                                        <td>{{($charges->practice_name) ? $charges->practice_name : '-' }}</td>
                                                        <td>{{($charges->effective_dos) ? date('m-d-Y', strtotime($charges->effective_dos)) : '-' }}</td>
                                                        <td>{{($charges->expiration_dos) ? date('m-d-Y', strtotime($charges->expiration_dos)) : '-' }}</td>
                                                        <td>{{($charges->procedure_code) ? $charges->procedure_code : '-' }}</td>
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
        <div class="col-1 mt-4"></div>
    </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://code.jquery.com/jquery-migrate-1.2.1.js"></script>
<script src="{{ asset('js/bootstrap-inputmask.js') }}"></script>
<script src="{{ asset('js/controller/master_for_all.js') }}"></script>

<script>
$( document ).ready(function() {
var type = '<?php echo $billingId;?>';
    //console.log('##type',type);
    showOtherDIv(type);
});
function showOtherDIv(val){
    if(val == 1){
        $('#personaleDiv').removeClass('d-none');
        $('#nonPersonaleDiv').addClass('d-none');
    }
    else{
        $('#personaleDiv').addClass('d-none');
        $('#nonPersonaleDiv').removeClass('d-none');
    }
}
</script>
<script>
function myFunction() {
  var x = document.getElementById("myDIV");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
</script>


