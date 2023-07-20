<style type="text/css">
.card {
            position: relative;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-direction: column;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(0, 0, 0, .125);
            border-radius: .25rem;
            margin-bottom: 0.5rem;
    
        }
        a:hover
        {
          background-color:#e1e4e6;
        }

        .card-header:first-child {
            border-radius: calc(.25rem - 1px) calc(.25rem - 1px) 0 0;
        }

        .card-header {
            padding: .75rem 1.25rem;
            margin-bottom: 0;
            background-color: rgba(0, 0, 0, .03);
            border-bottom: 1px solid rgba(0, 0, 0, .125);
        }

        .card-body {
            -ms-flex: 1 1 auto;
            flex: 1 1 auto;
            padding: 1.25rem;
        }
        
        .list-inline-item:not(:last-child)
        {
            margin-right: 1.5rem;
        }

        </style>
         @inject('testPatientClass', 'App\Http\Controllers\PatientController')
                <div class="row ">
                    <div class="col-12">
                        <div>
                            <div class="card-header showButtonColor">
                                <h4 class="card-title showButtonColor">Patient</h4>
                            </div>
                            @if($patient)
                            <div class="card-body" style="padding:0px !important;">
                                <ul class="list-group list-group-flush">
                                    
                                    <li class="list-group-item">
                                        @if($patient->getBillingProvider)
                                        <div class="card">
                                        <a href="{{ url('/view/billing/provider/' . $patient->getBillingProvider->id) }}" style="color:#232526;">
                                            <div class="card-header">
                                               <div class="row">
                                                    <div class="col-12">
                                                    <h4 class="card-title"><b>{{($patient->getBillingProvider) ? ucfirst($patient->getBillingProvider->professional_provider_name) : 'NA' }} <span># {{ "BILL000".$patient->getBillingProvider->id }}</span></b> </h4> 
                                                    <span>Billing Provider</span> 
                                                    </div><br><br>
                                                    <div class="col-12">
                                                    <ul class="list-inline">
                                                    <li class="list-inline-item liItem">Tax ID
                                                    <br>
                                                    <span class="text-muted"><b>{{($patient->getBillingProvider) ? $patient->getBillingProvider->tax_id : 'NA' }}</b></span>
                                                    </li>
                                                    <li class="list-inline-item liItem">NPI
                                                    <br>
                                                    <span class="text-muted"><b>{{($patient->getBillingProvider) ? $patient->getBillingProvider->professional_npi : 'NA' }}</b></span>
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
                                                <div class="card-header">
                                                <div class="row">
                                                        <div class="col-12">
                                                        <h4 class="card-title"> <b>{{($patient->first_name) ? ucfirst($patient->first_name)." ".ucfirst($patient->last_name) : 'NA' }} <span># {{$patient->patient_no}}</span> </b></h4>
                                                        <span>Patient Name</span> 
                                                        </div><br><br>
                                                        <div class="col-12">
                                                          <ul class="list-inline">
                                                        <li class="list-inline-item liItem">DOB
                                                        <br>
                                                        <span class="text-muted">
                                                        <b>{{$testPatientClass->convertDateFormat($patient->dob)}} </b></span>
                                                        </li>
                                                        <li class="list-inline-item liItem">SSN
                                                        <br>
                                                        <span class="text-muted"><b>{{($patient->ssn_no) ? $patient->ssn_no: 'NA' }}</b></span>
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
                                                <div class="card-header">
                                                <div class="row">
                                                        <div class="col-12">
                                                        <h4 class="card-title"><b> {{  ($injury->description) ? ucfirst(substr($injury->description,0,18)).'...' : 'NA' }} <span># {{"Injury2023".$injury->id}}</span></b></h4>
                                                        <span>Injury Description</span> 
                                                        </div><br><br>
                                                        <div class="col-12">
                                                        <ul class="list-inline">
                                                        <li class="list-inline-item liItem">DOI
                                                        <br>
                                                        <span class="text-muted"><b>{{($injury->getInjuryClaim && $injury->getInjuryClaim->start_date) ? 
                                                        $testPatientClass->convertDateFormat($injury->getInjuryClaim->start_date) : 'NA' }}</b></span>
                                                        </li>
                                                        <li class="list-inline-item liItem">Claims Admin
                                                        <br>
                                                        <span class="text-muted"><b>{{($injury->getInjuryClaim && $injury->getInjuryClaim->getClaimAdmin && $injury->getInjuryClaim->getClaimAdmin->name) ? ucfirst(substr($injury->getInjuryClaim->getClaimAdmin->name,0,12)).'...' : 'NA' }}</b></span>
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
                                            <div class="card-header">
                                               <div class="row">
                                                    <div class="col-12">
                                                    <h4 class="card-title"><b><span> Bill Count # 2</span></b> </h4> 
                                                    <span>View All</span> 
                                                    </div><br><br>
                                                    <div class="col-12">
                                                    <ul class="list-inline">
                                                    <li class="list-inline-item liItem">Rejected
                                                    <br>
                                                    <span class="text-muted"><b>0</b></span>
                                                    </li>
                                                    <li class="list-inline-item liItem">No Response
                                                    <br>
                                                    <span class="text-muted"><b>0</b></span>
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
                                                <div class="card-header">
                                                <div class="row">
                                                        <div class="col-12">
                                                        <h4 class="card-title"> <b> <span>RFA Count # 0</span> </b></h4>
                                                        <span>View All</span> 
                                                        </div><br><br>
                                                        <div class="col-12">
                                                        <ul class="list-inline">
                                                        <li class="list-inline-item liItem">No Response
                                                        <br>
                                                        <span class="text-muted">
                                                        <b>0 </b></span>
                                                        </li>
                                                        <li class="list-inline-item liItem">Approve
                                                        <br>
                                                        <span class="text-muted"><b>0</b></span>
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
