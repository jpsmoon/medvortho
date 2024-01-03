
         @inject('testPatientClass', 'App\Http\Controllers\PatientController')
                <div class="row ">
                    <div class="col-12">
                        <div>
                            <div class="sub-header py-3 px-3 align-content-center d-sm-flex w-100 rounded heading-background showButtonColor">
                                <h2 class="showButtonColor">Patient</h2>
                            </div>
                            @if($patient)
                            <div class="card-body" style="padding:0px !important;">
                                <ul class="list-group list-group-flush rightBox">
                                    
                                    <li class="list-group-item">
                                        @if($patient->getBillingProvider)
                                        <div class="card">
                                        <a href="{{ url('/view/billing/provider/' . $patient->getBillingProvider->id) }}" style="color:#232526;">
                                            <div class="card-header2">
                                               <div class="row">
                                                    <div class="col-12">
                                                    <h4 class="card-title"><b>{{($patient->getBillingProvider) ? ucfirst($patient->getBillingProvider->professional_provider_name) : 'NA' }} <span># {{ "BILL000".$patient->getBillingProvider->id }}</span></b> </h4> 
                                                    <span>Billing Provider</span> 
                                                    </div>
                                                    <div class="col-12">
                                                    <ul class="list-inline">
                                                    <li class="list-inline-item liItem">Tax ID
                                                    <br>
                                                    <span class="text-dark"><b>{{($patient->getBillingProvider) ? $patient->getBillingProvider->tax_id : 'NA' }}</b></span>
                                                    </li>
                                                    <li class="list-inline-item liItem">NPI
                                                    <br>
                                                    <span class="text-dark"><b>{{($patient->getBillingProvider) ? $patient->getBillingProvider->professional_npi : 'NA' }}</b></span>
                                                    </li>
                                                    <li class="list-inline-item liItem">Bill Type
                                                    <br>
                                                    <b>{{($patient->getBillingProvider) ? $patient->getBillingProvider->bill_type : 'NA' }}</b></li>
                                                </ul> 
                                                </div>
                                               </div>
                                            </div>
                                        </a>
                                        </div>
                                        @endif
                                        <div class="card">
                                            <a  href="{{ url('/patients/view/' . $patient->id) }}" style="color:#232526;">
                                                <div class="card-header2">
                                                <div class="row">
                                                        <div class="col-12">
                                                        <h4 class="card-title"> <b>{{($patient->first_name) ? ucfirst($patient->first_name)." ".ucfirst($patient->last_name) : 'NA' }} <span># {{$patient->patient_no}}</span> </b></h4>
                                                        <span>Patient Name</span> 
                                                        </div>
                                                        <div class="col-12">
                                                          <ul class="list-inline">
                                                        <li class="list-inline-item liItem">DOB
                                                        <br>
                                                        <span class="text-dark">
                                                        <b>{{$testPatientClass->convertDateFormat($patient->dob)}} </b></span>
                                                        </li>
                                                        <li class="list-inline-item liItem">SSN
                                                        <br>
                                                        <span class="text-dark"><b>{{($patient->ssn_no) ? $patient->ssn_no: 'NA' }}</b></span>
                                                        </li>
                                                        <li class="list-inline-item liItem">Injury Count
                                                        <br>
                                                        <b>1</b></li>
                                                    </ul>
                                                   </div>
                                                </div>
                                                </div>
                                            </a>
                                        </div>
                                    @if($injury)
                                        <div class="card">
                                            <a  href="{{ url('/injury/view/' . $injury->id) }}" style="color:#232526;">
                                                <div class="card-header2">
                                                <div class="row">
                                                        <div class="col-12">
                                                        <h4 class="card-title"><b> {{  ($injury->description) ? ucfirst(substr($injury->description,0,18)).'...' : 'NA' }} <span># {{"Injury2023".$injury->id}}</span></b></h4>
                                                        <span>Injury Description</span> 
                                                        </div>
                                                        <div class="col-12">
                                                        <ul class="list-inline">
                                                        <li class="list-inline-item liItem">DOI
                                                        <br>
                                                        <span class="text-dark"><b>{{($injury->getInjuryClaim && $injury->getInjuryClaim->start_date) ? 
                                                        $testPatientClass->convertDateFormat($injury->getInjuryClaim->start_date) : 'NA' }}</b></span>
                                                        </li>
                                                        <li class="list-inline-item liItem">Claims Admin
                                                        <br>
                                                        <span class="text-dark"><b>{{($injury->getInjuryClaim && $injury->getInjuryClaim->getClaimAdmin && $injury->getInjuryClaim->getClaimAdmin->name) ? ucfirst(substr($injury->getInjuryClaim->getClaimAdmin->name,0,12)).'...' : 'NA' }}</b></span>
                                                        </li>
                                                        <li class="list-inline-item liItem">Claim Number
                                                        <br>
                                                        <b>{{($injury->getClaimAdmin && $injury->getInjuryClaim->claim_no) ? $injury->getInjuryClaim->claim_no : 'NA' }}</b>
                                                        </li>
                                                    </ul> 
                                                            
                                                      </div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    @endif
                                    
                                        @if($patient->getBillingProvider)
                                        <div class="card">
                                        <a href="{{ url('/view/billing/provider/' . $patient->getBillingProvider->id) }}" style="color:#232526;">
                                            <div class="card-header2">
                                               <div class="row">
                                                    <div class="col-12">
                                                    <h4 class="card-title"><b><span> Bill Count # 2</span></b> </h4> 
                                                    <span>View All</span> 
                                                    </div>
                                                    <div class="col-12">
                                                    <ul class="list-inline">
                                                    <li class="list-inline-item liItem">Rejected
                                                    <br>
                                                    <span class="text-dark"><b>0</b></span>
                                                    </li>
                                                    <li class="list-inline-item liItem">No Response
                                                    <br>
                                                    <span class="text-light"><b>0</b></span>
                                                    </li>
                                                    <li class="list-inline-item liItem">Payment
                                                    <br>
                                                    <b>0</b></li>
                                                    
                                                    <li class="list-inline-item liItem">Denials
                                                    <br>
                                                    <b>0</b></li>
                                                </ul> 
                                                </div>
                                               </div>
                                            </div>
                                        </a>
                                        </div>
                                        @endif
                                        <div class="card">
                                            <a  href="{{ url('/patients/view/' . $patient->id) }}" style="color:#232526;">
                                                <div class="card-header2">
                                                <div class="row">
                                                        <div class="col-12">
                                                        <h4 class="card-title"> <b> <span>RFA Count # 0</span> </b></h4>
                                                        <span>View All</span> 
                                                        </div>
                                                        <div class="col-12">
                                                        <ul class="list-inline">
                                                        <li class="list-inline-item liItem">No Response
                                                        <br>
                                                        <span class="text-dark">
                                                        <b>0 </b></span>
                                                        </li>
                                                        <li class="list-inline-item liItem">Approve
                                                        <br>
                                                        <span class="text-dark"><b>0</b></span>
                                                        </li>
                                                        <li class="list-inline-item liItem">Deny
                                                        <br>
                                                        <b>1</b></li>
                                                        
                                                        <li class="list-inline-item liItem">Modify
                                                        <br>
                                                        <b>0</b></li>
                                                    </ul>
                                                   </div>
                                                </div>
                                                </div>
                                            </a>
                                        </div>
                                    </li>
                                    
                                    <!--<li class="list-group-item">-->
                                    <!--<div class="card">-->
                                    <!--    <div class="card-header">-->
                                    <!--        <h4 class="card-title">History</h4>-->
                                    <!--     </div>-->
                                    <!--</div>-->
                                    <!--</li>-->
                                    
                                </ul>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
