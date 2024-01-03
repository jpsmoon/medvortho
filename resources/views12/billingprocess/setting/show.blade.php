@extends('layouts.home-app')
<style>
    .step .fa {
        padding-top: 13px !important;
        font-size: 18px !important;
    }

    .pointer {
        cursor: pointer;
    }
</style>
@section('content')
    <!-- START: Breadcrumbs-->
    <!-- END: Breadcrumbs--> 
    @if ($message = Session::get('success'))
        <div class="row mt-2 customBox">
            <div class="col-12 align-self-center">
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            </div>
        </div>
    @endif
    <div class="row mt-1">
        <div class="col-md-12 mt-0">
            <div class="card row-background customBoxHeight">
                <div class="row ">
                    <div class="col-md-12  align-self-center">
                        <div class="sub-header py-3 px-1 align-self-center d-sm-flex w-100 rounded heading-background">
                            <div style="padding-top:10px" class="w-sm-100 mr-auto">
                                <h2 class="heading">Billing Provider Setting</h2>
                            </div>
                            <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                                <li style="padding-bottom:10px" class="breadcrumb-item">
                                    <a class="btn btn-primary" href="{{url('/billing/providers/setting',$billingProviders->id)}}">Back</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="card-content">
                    <div class="card-body2 mt-2" style="padding-left: 30px;">
                        <div class="row">
                            <div class="col-md-4">
                                <h4 class="mb-0 bold text-capitalize">{{$billingProviders->professional_provider_name}}</h4>
                                <span>{{$billingProviders->bill_type." Billing Provider"}}</span>
                            </div>
                            <div class="col-md-8">
                                <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                                @can('billing-provider-edit')
                                    <li style="padding-bottom:10px" class="breadcrumb-item">
                                    <span>
                                    <a class="btn btn-primary" href="{{ url('/edit/billing/provider',$billingProviders->id)}}"><i class="icon-pencil"></i> Edit</a></span>
                                    </li>
                                @endcan
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
                                
                                <div class="col-md-4">
                                    <label class="bold" for="">Bill Type </label><br>
                                    <span>{{$billingProviders->bill_type}}</span>
                                </div>
                                
                            </div>
                             <hr>
                            <div class="row">
                                <div class="col-md-4">
                                    <label class="bold" for=""> Physical Address </label><br>
                                     <span>
                                        {{ ($billingProviders->professional_address1) ? $billingProviders->professional_address1 : ''}}
                                        {{ ($billingProviders->professional_address2) ? ', '.$billingProviders->professional_address2 : '' }}
                                        {{ ($billingProviders->professional_city1) ? ', '.$billingProviders->professional_city1 : ''}}
                                        {{ ($billingProviders->professional_state) ? ', '.strtoupper( substr( $billingProviders->professional_state, 0, 2 )) : ''}} 
                                        {{ $billingProviders->professional_zipcode1 }}
                                    </span>
                                   
                                </div>
                                <div class="col-md-4">
                                    <label class="bold" for=""> Pay To Address </label><br>
                                    <span>
                                   {{$billingProviders->professional_addres1}} - {{$billingProviders->professional_addres2}}
                                   {{$billingProviders->professional_city}}
                                   
                                   {{strtoupper( substr( $billingProviders->professional_state1, 0, 2 ) ) }}

                                   {{$billingProviders->professional_zip}}
                                   </span>
                                </div>
                                
                                <div class="col-md-4">
                                <label class="bold" for="">Active? </label><br>
                                <span>{{($billingProviders->is_active == 1) ? 'Yes' : 'No'}}</span>
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
        </div>
        </div>

        <script type="text/javascript">
            function resetActive(event, percent, step) {
                hideSteps();
                showCurrentStepInfo(step);
            }

            function hideSteps() {
                $("div").each(function() {
                    if ($(this).hasClass("activeStepInfo")) {
                        $(this).removeClass("activeStepInfo");
                        $(this).addClass("hiddenStepInfo");
                    }
                });
            }

            function showCurrentStepInfo(step) {
                console.log('#step', step);
                var id = "#step-" + step;
                $(id).addClass("activeStepInfo");
                $("div").each(function() {
                    if ($(this).hasClass("activestep")) {
                        $(this).removeClass("activestep");
                    }
                });
                $('#div' + step).addClass("activestep");
            }
        </script>
    @endsection
