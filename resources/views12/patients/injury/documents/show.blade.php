@extends('layouts.home-app')
@section('content')
<style type="text/css">
.activeContent{ display: flex; }
.hiddenContent{ display: none; }
.flag-wrapper:after { padding-top: 0% !important;}
.setTpPaddeing{top:75px !important};
</style>
<!-- START: Modal popup css-->
<link rel="stylesheet" type="text/css" href="{{ url('new_assets/app-assets/css/modal-popup.css') }}">
<!-- END: Modal popup css-->

 <!-- START: Breadcrumbs-->
 <div class="row ">
        <div class="col-12  align-self-center">
            <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                <div class="w-sm-100 mr-auto col-9">
                    <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                        <li class="breadcrumb-item">
                        <h2><svg xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" viewBox="0 0 34 34" class="left"><title>icon_patient</title><path d="M20.983 16.793L19.32 23.2h-1.857c-.825.017-1.48.654-1.463 1.425l.005.21c.017.758.682 1.365 1.495 1.365h5.147c.977 0 1.829-.617 2.07-1.5l.269-.977a.392.392 0 0 0 .014-.104c0-.231-.2-.418-.448-.418h-.753l-1.085-6.853c.258.077.501.185.73.324.517.314.933.72 1.248 1.216.314.497.573 1.094.777 1.791.203.698.343 1.39.418 2.079.075.688.113 1.42.113 2.194 0 .993-.277 1.846-.83 2.557-.553.71-1.22 1.066-1.999 1.066H11.83c-.78 0-1.446-.355-1.999-1.066-.553-.711-.83-1.564-.83-2.557 0-.775.038-1.506.113-2.194.075-.689.215-1.381.418-2.079.204-.697.463-1.294.777-1.79.315-.497.73-.903 1.249-1.217.518-.315 1.113-.472 1.786-.472 1.16 1.167 2.546 1.75 4.157 1.75 1.31 0 2.472-.386 3.483-1.157zm-.58 6.623l1.423-5.602.791 5.602h-2.213zM22.5 12c0 1.38-.488 2.559-1.465 3.535C20.06 16.512 18.88 17 17.5 17c-1.38 0-2.559-.488-3.535-1.465C12.988 14.56 12.5 13.38 12.5 12c0-1.38.488-2.559 1.465-3.535C14.94 7.488 16.12 7 17.5 7c1.38 0 2.559.488 3.535 1.465C22.012 9.44 22.5 10.62 22.5 12z" fill="#3A3A3A" fill-rule="evenodd"></path></svg>
                        Injury Information</h2>
                        </li>
                    </ol>
                </div>
                <div align="right" class="w-sm-100 mr-auto col-3">
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <i class=""></i>
                            <a class="btn btn-primary" href="{{url('/edit/patients/injury/')}}/{{$injuryId}}">
                            <i class="icon-pencil"></i> Edit</a>
                        </li>
                        <li class="list-inline-item">
                            <a class="btn btn-primary" href="{{url('/patients/view',$patientId)}}"> Back</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Breadcrumbs-->

    <div class="row font">
            <div class="col-9 mt-4">
                <div class="card">
                    <div class="card-body height">
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12" id="patient_info">

                         <ul class="sub-menu list-inline chat-menu">
                        <li class="list-inline-item liItem billbutton">
                            <div class="text-center p-1 border">
                                 <div class="flag-wrapper bottom-border" style="width: 100% !important;">
                                    <div><a href="#" class="font-bold">Bills</a></div>
                                </div>
                                <ul class="sub-menu list-inline">
                                    <li class="list-inline-item liItem"><a class="bold" href="{{url('/add/injury/bill')}}/{{$injuryId}}/{{$patientId}}">Add</a></li>
                                    <li class="list-inline-item liItem">|</li>
                                    <li class="list-inline-item liItem"><a class="bold" href="{{url('/view/patient/injury/bill')}}/{{$injuryId}}/{{$patientId}}">View</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="list-inline-item liItem billbutton">
                            <div class="text-center p-1 border">
                                <div class="flag-wrapper bottom-border" style="width: 100% !important;">
                                    <div><a href="#" class="font-bold">RFAs</a></div>
                                </div>
                                <ul class="sub-menu list-inline">
                                    <li class="list-inline-item liItem"><a class="bold" href="javascript:void(0)" data-toggle="modal" data-target="#mycontactForm">Add</a></li>
                                    <li class="list-inline-item liItem ">|</li>
                                    <li class="list-inline-item liItem"><a class="bold" href="{{url('/view/patient/injury/bill')}}/{{$injuryId}}/{{$patientId}}">View</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="list-inline-item liItem billbutton">
                            <div class="text-center p-1 border">
                                 <div class="flag-wrapper bottom-border" style="width: 100% !important;">
                                    <div><a href="#" class="font-bold">Injury Notes</a></div>
                                </div>
                                <ul class="sub-menu list-inline">
                                    <li class="list-inline-item liItem"><a class="bold" href="javascript:void(0)" data-toggle="modal" data-target="#injurynotes">Add</a></li>
                                    <li class="list-inline-item liItem ">|</li>
                                    <li class="list-inline-item liItem"><a class="bold" href="{{url('/view/patient/injury/bill')}}/{{$injuryId}}/{{$patientId}}">View</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="list-inline-item liItem billbutton">
                            <div class="text-center p-1 border">
                                 <div class="flag-wrapper bottom-border" style="width: 100% !important;">
                                    <div><a href="#" class="font-bold">Injury Documents</a></div>
                                </div>
                                <ul class="sub-menu list-inline">
                                    <li class="list-inline-item liItem"><a class="bold" href="{{url('/add/injury/bill')}}/{{$injuryId}}/{{$patientId}}">Add</a></li>
                                    <li class="list-inline-item liItem ">|</li>
                                    <li class="list-inline-item liItem"><a class="bold" href="{{url('/view/patient/injury/bill')}}/{{$injuryId}}/{{$patientId}}">View</a></li>
                                </ul>
                            </div>
                        </li>
                        <li class="list-inline-item liItem billbutton">
                            <div class="text-center p-1 border">
                                 <div class="flag-wrapper bottom-border" style="width: 100% !important;">
                                    <div><a href="#" class="font-bold">Paper SBRs</a></div>
                                </div>
                                <ul class="sub-menu list-inline">
                                    <li class="list-inline-item liItem"><a class="bold" href="{{url('/add/injury/bill')}}/{{$injuryId}}/{{$patientId}}">Add</a></li>
                                    <li class="list-inline-item liItem ">|</li>
                                    <li class="list-inline-item liItem "><a class="bold" href="{{url('/view/patient/injury/bill')}}/{{$injuryId}}/{{$patientId}}">View</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>

                                 @if(isset($pInjuries->getInjuryClaim))
                                    <table class="table font">
                                                <tr>
                                                    <td width="10%"><b>Employer</b></td>
                                                    <td width="40%">{{($pInjuries->getInjuryClaim) ? $pInjuries->getInjuryClaim->employer_name : 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <td width="10%"><b>Employer Address</b></td>
                                                    <td width="40%">{{($pInjuries->getInjuryClaim) ? $pInjuries->getInjuryClaim->emp_address_line1 : 'N/A' }},
                                                    {{($pInjuries->getInjuryClaim) ? $pInjuries->getInjuryClaim->emp_address_line2 : 'N/A' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="10%"><b>DOI</b></td>
                                                    <td width="40%">
                                                        {{($pInjuries->getInjuryClaim) ? date('Y-m-d', strtotime($pInjuries->getInjuryClaim->start_date)) : 'N/A' }} -
                                                        {{($pInjuries->getInjuryClaim) ? date('Y-m-d', strtotime($pInjuries->getInjuryClaim->end_date)) : 'N/A' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="10%"><b>Claims Administrator</b></td>
                                                    <td width="40%">{{($pInjuries->getInjuryClaim->getClaimAdmin) ? $pInjuries->getInjuryClaim->getClaimAdmin->name : 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <td width="10%"><b>Payer</b></td>
                                                    <td width="40%">{{($pInjuries->getInjuryClaim) ? $pInjuries->getInjuryClaim->payer_id : 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <td width="10%"><b>Claim Number</b></td>
                                                    <td width="40%">{{($pInjuries->getInjuryClaim) ? $pInjuries->getInjuryClaim->claim_no : 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <td width="10%"><b>Claim Status</b></td>
                                                    <td width="40%">{{($pInjuries->getInjuryClaim->getClaimStatus) ? $pInjuries->getInjuryClaim->getClaimStatus->claim_status : 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <td width="10%"><b>Claim Status Date</b></td>
                                                    <td width="40%">{{($pInjuries->getInjuryClaim) ? date('Y-m-d', strtotime($pInjuries->getInjuryClaim->claim_status_date)) : 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <td width="10%"><b>ADJ Number</b></td>
                                                    <td width="40%">{{($pInjuries->getInjuryClaim) ? $pInjuries->getInjuryClaim->adj_no : 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <td width="10%"><b>Medical Provider Network</b></td>
                                                    <td width="40%">{{($pInjuries->getInjuryClaim->getMedicalProvider) ? $pInjuries->getInjuryClaim->getMedicalProvider->applicant_name : 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <td width="10%"><b>Diagnosis Codes</b></td>
                                                    <td width="40%">{{($pInjuries->getInjuryClaim) ? $pInjuries->getInjuryClaim->employer_name : 'N/A' }}</td>
                                                </tr>
                                                <tr>
                                                    <td width="10%"><b>State</b></td>
                                                    <td width="40%">{{($pInjuries->getInjuryClaim) ? $pInjuries->getInjuryClaim->emp_state_id : 'N/A' }}</td>
                                                </tr>

                                    </table>
                                @else
                                <table class="table">
                                    <tr><td>No injury claim data found<td></tr>
                                </table>
                                @endif
                            </div>

                            <hr>
                            <div class="col-xs-12 col-sm-12 col-md-12">

                                <div class="col-md-12">
                                    <div class="w-sm-100 mr-auto col-10">
                                        <ul class="list-inline">
                                            <li class="list-inline-item">
                                            <h2><svg xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" viewBox="0 0 34 34" class="left"><title>icon_patient</title><path d="M20.983 16.793L19.32 23.2h-1.857c-.825.017-1.48.654-1.463 1.425l.005.21c.017.758.682 1.365 1.495 1.365h5.147c.977 0 1.829-.617 2.07-1.5l.269-.977a.392.392 0 0 0 .014-.104c0-.231-.2-.418-.448-.418h-.753l-1.085-6.853c.258.077.501.185.73.324.517.314.933.72 1.248 1.216.314.497.573 1.094.777 1.791.203.698.343 1.39.418 2.079.075.688.113 1.42.113 2.194 0 .993-.277 1.846-.83 2.557-.553.71-1.22 1.066-1.999 1.066H11.83c-.78 0-1.446-.355-1.999-1.066-.553-.711-.83-1.564-.83-2.557 0-.775.038-1.506.113-2.194.075-.689.215-1.381.418-2.079.204-.697.463-1.294.777-1.79.315-.497.73-.903 1.249-1.217.518-.315 1.113-.472 1.786-.472 1.16 1.167 2.546 1.75 4.157 1.75 1.31 0 2.472-.386 3.483-1.157zm-.58 6.623l1.423-5.602.791 5.602h-2.213zM22.5 12c0 1.38-.488 2.559-1.465 3.535C20.06 16.512 18.88 17 17.5 17c-1.38 0-2.559-.488-3.535-1.465C12.988 14.56 12.5 13.38 12.5 12c0-1.38.488-2.559 1.465-3.535C14.94 7.488 16.12 7 17.5 7c1.38 0 2.559.488 3.535 1.465C22.012 9.44 22.5 10.62 22.5 12z" fill="#3A3A3A" fill-rule="evenodd"></path></svg>
                                            History</h2>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3 mt-4">
                <div class="card">
                @include('patients.show-patient-info')
                </div>
            </div>
        </div>
  <!-- START: Injury Notes Modal Popup -->    
  <div id="injurynotes" class="modal fade" role="dialog" style="padding-top:150px !important">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div id="injuryDiv" class="modal-content" style="width:584px; height:262px;">
      <div class="modal-header text-center">
       <div><h4 class="modal-title"><center>Add Injury Note</center></h4></div> 
        <div><button type="button" style="color:#FFFFFF" class="close" data-dismiss="modal">&times;</button></div>
      </div>
      <div class="modal-body">
          <div class="container-fluid">
            <section class="section">
                <div class="row">
                    <!--Grid column-->
                        <div class="col-md-11 col-xl-11" style="margin-left:5%">
                            <form method="post" name="contact" id="contactForm" action="contact-action/contact_action.php">
                                        <!-- service-form -->
                                        <div class="service-form">
                                            <div class="row">
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                    <span class="text-danger"  id="final_msg"></span>
                                                </div>
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                    <div class="form-group service-form-group">
                                                        <label for="ins_authinfo">Adjustor Name</label>
                                                        <textarea id="address" name="address" type="text" rows="4" class="form-control"></textarea>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                    <div class="form-group service-form-group" style="margin-top:12px;">
                                                       <input type="checkbox">
                                                       <label for="ins_authinfo">Bill History - Display Injury Note?</label>
                                                        
                                                    </div>
                                                </div>
                                                
                                                <div align="center" class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                <button type="button" name="submitbtn" id="submitbtn" class="btn btn-sm btn-primary btn-Font" 
                                                style="width: 100px;height: 50px">Add </button>
                                                
                                                <button type="button" class="btn btn-sm btn-primary btn-Font" style="width: 100px;height: 50px">Cancel</button>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                        </div>
                    <!--Grid column-->
                </div>
            </section>
        </div>
      </div>
      <!--<div class="modal-footer">-->
      <!--  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
      <!--</div>-->
    </div>

  </div>
</div>
  <!-- END: Injury Notes Modal Popup-->         
  <!-- START: RFAs Modal Popup -->    
  <div id="mycontactForm" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content" id="responsiveDiv" style="width: 584px; height: 480px;">
      <div class="modal-header text-center">
       <div><h4 class="modal-title"><center>RFA Claims Administrator Information</center></h4></div> 
        <div><button type="button" style="color:#FFFFFF" class="close" data-dismiss="modal">&times;</button></div>
      </div>
      <div class="modal-body">
          <div class="container-fluid">
            <section class="section">
                <div class="row">
                    <!--Grid column-->
                        <div class="col-md-11 col-xl-11" style="margin-left:5%">
                            <div style="padding: 10px;border-radius: 10px;border: 2px solid #818A91!important;">
                            <p class="section-description">Gallagher Bassett instructs providers to fax RFAs to the Adjustor.</p>
                            <p class="section-description"> If Adjustor unknown, contact Gallagher Bassett.</p>
                            <ul class="a" style="padding-left:0">
                            <li> <span>&#8226;</span> Main: (800) 370-0594</li>
                            <li> <span>&#8226;</span> Claim Inquiries: (800) 370-0594 x3</li>
                            <li> <span>&#8226;</span> Hours Of Operation: 08:00 AM - 08:00 PM PDT</li>
                            </ul>
                            </div><br>
                            <p class="section-description">Provide Adjustor Name and RFA Fax Number.</p>
                            <form method="post" name="contact" id="contactForm" action="contact-action/contact_action.php">
                                        <!-- service-form -->
                                        <div class="service-form">
                                            <div class="row">
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                    <span class="text-danger"  id="final_msg"></span>
                                                </div>
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                    <div class="form-group service-form-group">
                                                        <label for="ins_authinfo">Adjustor Name</label>
                                                        <input id="address" name="address" type="text" class="form-control">
                                                    </div>
                                                </div>
                                                
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                    <div class="form-group service-form-group">
                                                        <label for="ins_authinfo">RFA Fax Number</label>
                                                        <input id="address" name="address" type="text" data-mask="(999) 999-9999" class="form-control">
                                                    </div>
                                                </div>
                                                
                                                <div align="center" class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                <button type="sumit" name="submitbtn"  id="submitbtn" class="btn btn-sm btn-primary btn-Font" 
                                                style="width: 100px;height: 50px">Confirm </button>
                                                <button type="sumit" name="submitbtn"  id="submitbtn" class="btn btn-sm btn-primary btn-Font"
                                                style="width: 100px;height: 50px">Skip</button>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                        </div>
                    <!--Grid column-->
                </div>
            </section>
        </div>
      </div>
      <!--<div class="modal-footer">-->
      <!--  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
      <!--</div>-->
    </div>

  </div>
</div>
  <!-- END: RFAs Modal Popup-->   


  
</div>

<script src="{{ asset('js/controller/patient_injury.js') }}"></script>
@endsection
