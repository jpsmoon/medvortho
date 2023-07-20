@extends('layouts.home-app')
@section('content')
<style>
.fa {
    display: inline-block;
    font: normal normal normal 14px/1 FontAwesome;
    font-size: inherit;
    text-rendering: auto;
    -webkit-font-smoothing: antialiased;
    font-size: 18px!important;
}

.fa-angle-down:before{content:"\f107"};

#myDIV {
  width: 100%;
  padding: 10px 0;
  
}


</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<!-- START: Breadcrumbs-->

    <!-- END: Breadcrumbs-->

    <div class="row">
	<div class="col-1 mt-4"></div>
            <div class="col-10 mt-4">
                <div class="card">
                    <div class="card-body" style="padding-left: 30px;">
                        <div class="row">
                            <div class="col-md-10">
                                <h4 class="mb-0 bold text-capitalize"">{{$billingProviders->professional_provider_name}}</h4>
                                <span>{{$billingProviders->bill_type." Billing Provider"}}</span>
                                
                            </div>
                            <div class="col-md-2">
                            <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                                <li style="padding-bottom:10px" class="breadcrumb-item">
                                <span>
                                <a class="btn btn-primary" href="{{ url('/edit/billing/provider',$billingProviders->id)}}"><i class="icon-pencil"></i> Edit</a></span>
                                </li>
                                <li style="padding-bottom:10px" class="breadcrumb-item">
                                    <a class="btn btn-primary" href="{{url('/billing/providers/setting',$billingProviders->id)}}"> Back</a>
                                </li>

                            </ol>
                            </div>
                        </div>
                        <hr> 
                        <div class="row">
                          <div class="col-md-12">
                            <div class="row" style="padding-top: 10px;">
                                <div class="col-md-4">
                                    <label class="bold" for=""> Billing Provider ID </label><br>
                                    <span>{{$billingProviders->id}}</span>
                                </div>
                                <div class="col-md-4">
                                    <label class="bold" for=""> Billing Provider Name </label><br>
                                    <span>{{($billingProviders->professional_provider_name) ? $billingProviders->professional_provider_name : ''}}</span>
                                </div>
                                
                                <div class="col-md-4">
                                    <label class="bold" for=""> Nickname </label><br>
                                    <span>{{($billingProviders->professional_nick_name) ? $billingProviders->professional_nick_name : '-'}}</span>
                                </div>
                                
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="bold" for=""> NPI </label><br>
                                   <span>{{($billingProviders->professional_npi) ? $billingProviders->professional_npi : ''}}</span>
                                </div>
                                <div class="col-md-4">
                                    <label class="bold" for=""> Tax ID </label><br>
                                    <span>{{($billingProviders->tax_id) ? $billingProviders->tax_id : ''}}</span>
                                </div>
                                
                                <div class="col-md-4">
                                    <label class="bold" for=""> DOL Provider Number </label><br>
                                    <span>{{($billingProviders->dol_provider_name) ? $billingProviders->dol_provider_name : '-'}}</span>
                                </div>
                                
                            </div>
                            
                             <hr>   
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="bold" for=""> Telephone </label><br>
                                    <span>{{($billingProviders->professional_telephone) ? $billingProviders->professional_telephone : ''}}</span>
                                </div>
                                <div class="col-md-4">
                                    <label class="bold" for=""> Fax Number </label><br>
                                    <span>{{($billingProviders->professional_telephone) ? $billingProviders->professional_telephone : ''}}</span>
                                </div>
                                
                            </div>
                             <hr>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="bold" for=""> Physical Address </label><br>
                                     <span >{{$billingProviders->professional_address1}} - {{$billingProviders->professional_address2}}
                                    {{$billingProviders->professional_city1}}
                                   
                                   {{strtoupper( substr( $billingProviders->professional_state, 0, 2 ) ) }}
                                   
                                   {{$billingProviders->professional_zipcode1}}
                                    </span>
                                   
                                </div>
                                <div class="col-md-6">
                                    <label class="bold" for=""> Pay To Address </label><br>
                                    <span>
                                        {{$billingProviders->professional_addres1}} - {{$billingProviders->professional_addres2}}
                                   {{$billingProviders->professional_city}}
                                   
                                   {{strtoupper( substr( $billingProviders->professional_state1, 0, 2 ) ) }}

                                   {{$billingProviders->professional_zip}}
                                   </span>
                                   
                                    
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="bold" for="">Active? </label><br>
                                    <span>{{($billingProviders->is_active == 1) ? 'Yes' : 'No'}}</span>
                                   
                                </div>
                                <div class="col-md-4">
                                    <label class="bold" for="">Bill Type </label><br>
                                    <span>{{$billingProviders->bill_type}}</span>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="form-row col-md-4">
                                    <a href="javascript:void(0)" onclick="myFunction()"><i class="fa fa-history" style="padding-top:4px; font-size: 14px !important;"></i>&nbsp;
                                    <label for="">History </label>&nbsp;
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
                        </div>
                    </div>
                </div>
            </div>
	<div class="col-1 mt-4"></div>		
        </div>
        @endsection
        
<script>

</script>        
        