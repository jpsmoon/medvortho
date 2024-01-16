@inject('testPatientClass', 'App\Http\Controllers\PatientController')

<style>
    
/*.list-inline-item:not(:last-child)*/
/*{*/
/*    margin-right: 1.25rem;*/
/*}*/

ul li {
    line-height: 1.5;
}

.rightBox .card:hover .card-header2 {
    border: 1px solid #8ab8f3;
    background: #efefef;
}

</style>
<div class="row ">
    <div class="col-12">
            <!--<div class="sub-header py-3 px-3 align-content-center d-sm-flex w-100 rounded heading-background showButtonColor">-->
            <!--<h2 class="mb-0"><i class="fa-solid fa-user"></i> Patient</h2>-->
            <!--</div>-->
            @if ($patient)
                <div class="card-body2" style="padding:0px !important;">
                    <ul class="list-group list-group-flush rightBox">

                        <li class="list-group-item">
                            @if ($patient->billingProviderForPatientList)
                                <div class="card">
                                    <a href="{{ url('/view/billing/provider/' . $patient->billingProviderForPatientList->id) }}"
                                        style="color:#232526;">
                                        <div class="card-header2">
                                            <div class="row">
                                                <div class="col-12 padB05">
                                                    <h4 class="card-title">
                                                        {{ $patient->billingProviderForPatientList ? ucfirst($patient->billingProviderForPatientList->professional_provider_name) : 'NA' }}
                                                            <span>#
                                                                {{ 'BILL000' . $patient->billingProviderForPatientList->id }}</span>
                                                    </h4>
                                                    <span>Billing Provider</span>
                                                </div>
                                                <div class="col-12">
                                                    <ul class="list-inline">
                                                        <li class="list-inline-item liItem">Tax ID
                                                            <br>
                                                            <span
                                                                class="card-title">{{ $patient->billingProviderForPatientList ? $patient->billingProviderForPatientList->tax_id : 'NA' }}</span>
                                                        </li>
                                                        <li class="list-inline-item liItem">NPI
                                                            <br>
                                                            <span
                                                                class="card-title">{{ $patient->billingProviderForPatientList ? $patient->billingProviderForPatientList->professional_npi : 'NA' }}</span>
                                                        </li>
                                                        <li class="list-inline-item liItem">
                                                            <div>Bill Type</div>
                                                            
                                                            <span class="card-title">{{ $patient->billingProviderForPatientList ? $patient->billingProviderForPatientList->bill_type : 'NA' }}</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endif
                            <div class="card">
                                <a href="{{ url('/patients/view/' . $patient->id) }}" style="color:#232526;">
                                    <div class="card-header2">
                                        <div class="row">
                                            <div class="col-12 padB05">
                                                <h4 class="card-title text-dark">
                                                    {{ $patient->first_name ? ucfirst($patient->first_name) . ' ' . ucfirst($patient->last_name) : 'NA' }}
                                                        <span># {{ $patient->patient_no }}</span> </h4>
                                                <span>Patient Name</span>
                                            </div>
                                            <div class="col-12">
                                                <ul class="list-inline">
                                                    <li class="list-inline-item liItem">DOB
                                                        <br>
                                                        <span class="card-title"> {{ $testPatientClass->convertDateFormat($patient->dob) }} </span>
                                                    </li>
                                                    <li class="list-inline-item liItem">SSN
                                                        <br>
                                                        <span class="card-title">{{ $patient->ssn_no ? $patient->ssn_no : 'NA' }}</span>
                                                    </li>
                                                    <li class="list-inline-item liItem">Injury Count
                                                        <br>
                                                        <span class="card-title">{{ count($patient->getInjuries)}}</span>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            @if ($patient->getInjury)
                            @php  $injury = $patient->getInjury; @endphp
                                    <div class="card">
                                        <a href="{{ url('/injury/view/' . $injury->id) }}" style="color:#232526;">
                                            <div class="card-header2">
                                                <div class="row">
                                                    <div class="col-12 padB05">
                                                        <h4 class="card-title">
                                                                {{ $injury->description ? ucfirst(substr($injury->description, 0, 18)) . '...' : 'NA' }}
                                                                <span># {{ 'Injury2023' . $injury->id }}</span></h4>
                                                        <span>Injury Description</span>
                                                    </div>
                                                    <div class="col-12">
                                                        <ul class="list-inline">
                                                            <li class="list-inline-item liItem">DOI
                                                                <br>
                                                                <span class="card-title">{{ $injury->getInjuryClaim && $injury->getInjuryClaim->start_date
                                                                        ? $testPatientClass->convertDateFormat($injury->getInjuryClaim->start_date)
                                                                        : 'NA' }}</span>
                                                            </li>
                                                            <li class="list-inline-item liItem">Claims Admin
                                                                <br>
                                                                <span class="card-title">{{ $injury->getInjuryClaim && $injury->getInjuryClaim->getClaimAdmin && $injury->getInjuryClaim->getClaimAdmin->name ? ucfirst(substr($injury->getInjuryClaim->getClaimAdmin->name, 0, 12)) . '...' : 'NA' }}</span>
                                                            </li>
                                                            <li class="list-inline-item liItem">Claim Number
                                                                <br>
                                                                <span class="card-title">{{ $injury->getInjuryClaim && $injury->getInjuryClaim->claim_no ? $injury->getInjuryClaim->claim_no : 'NA' }}</span>
                                                            </li>
                                                        </ul>

                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                    @if ($injury && $injury->getInjuryBills)
                                    <div class="card">
                                            <div class="card-header2">
                                              <div class="row">
                                                    <div class="col-8">
                                                        <a href="{{ url('/view/patient/injury/bill/' . $injury->id) }}" style="color:#232526;">
                                                        <h4 class="card-title"><span> Bill Count # {{ $injury && $injury->getInjuryBills ? count($injury->getInjuryBills) : 0 }}</span> </h4>
                                                        <span>View All</span>
                                                        </a>
                                                    </div> 
                                                    @if($injury)
                                                        <div class="col-4 text-right"> 
                                                        <a class="btn btn-outline-primary" href="{{ url('/add/injury/bill', $injury->id) }}" style="padding:7px 15px;">Add Bill</a>
                                                        </div> 
                                                    @endif
                                                </div>
                                                <div class="row mt-1"> 
                                                    <div class="col-12">
                                                      <a href="{{ url('/view/patient/injury/bill/' . $injury->id) }}" style="color:#232526;"> 
                                                        <ul class="list-inline">
                                                            <li class="list-inline-item liItem">
                                                                <div>Unsend</div>
                                                                
                                                                <div align="center" class="card-title">{{ $injury && $injury->getInjuryUnsendBills ? count($injury->getInjuryUnsendBills) : 0 }}</div>
                                                            </li>
                                                            <li class="list-inline-item liItem">
                                                                <div>Sent</div>
                                                                
                                                                <div align="center" class="card-title"> {{ $injury && $injury->getInjurySentBills ? count($injury->getInjurySentBills) : 0 }}</div>
                                                            </li>
                                                            <li class="list-inline-item liItem">
                                                                <div>Rejected</div>
                                                                
                                                                <div align="center" class="card-title">0</div>
                                                            </li>
                                                            <li class="list-inline-item liItem">
                                                                <div>No Response</div>
                                                                <div align="center" class="card-title">0</div>
                                                            </li>
                                                            <li class="list-inline-item liItem">
                                                                
                                                                <div>Payment</div>
                                                                
                                                               <div align="center" class="card-title">0</div>
                                                            </li>
                                                            <li class="list-inline-item liItem">
                                                                
                                                                <div>Denials</div>
                                                                
                                                                <div align="center" class="card-title">0</div>
                                                            </li>
                                                        </ul>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                      
                                    </div>
                                    @endif
                                    <div class="card">
                                        <a href="{{ url('/patients/view/' . $patient->id) }}" style="color:#232526;">
                                            <div class="card-header2">
                                                <div class="row">
                                                    <div class="col-12 padB05">
                                                        <h4 class="card-title"> <span>RFA Count # 0</span></h4>
                                                        <span>View All</span>
                                                    </div>
                                                    <div class="col-12">
                                                        <ul class="list-inline">
                                                            <li class="list-inline-item liItem">
                                                                <div>No Response</div>
                                                                
                                                                <div align="center" class="card-title">0</div>
                                                            </li>
                                                            
                                                            <li class="list-inline-item liItem">
                                                                
                                                               <div>Approve</div>
                                                            
                                                                <div align="center" class="card-title">0</div>
                                                            </li>
                                                            <li class="list-inline-item liItem">
                                                                
                                                                <div>Deny</div>
                                                                
                                                                <div align="center" class="card-title">0</div>
                                                            </li>

                                                            <li class="list-inline-item liItem">
                                                                
                                                                <div>Modify</div>
                                                                
                                                                <div align="center" class="card-title">0</div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div> 
                            @endif 
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
