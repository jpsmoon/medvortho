  @inject('testPatientClass', 'App\Http\Controllers\PatientController')
  <div class="col-xs-12 col-sm-12 col-md-12">
      <div class="row">
          <div class="col-xs-6 col-sm-6 col-md-6">
              <div class="card">
                  <div class="card-body">
                      <div class="card-title">Patient Information - Required</div>
                      <ul class="list-inline injuryInfo">
                          <li class="list-inline-item headItem"><b>Name :</b></li>
                          <li class="list-inline-item text-secondary"> {{ $patient->suffix }} {{ $patient->first_name }}
                              {{ $patient->last_name }}</li>
                      </ul>
                      <ul class="list-inline injuryInfo">
                          <li class="list-inline-item headItem"><b>DOB :</b></li>
                          <li class="list-inline-item text-secondary">
                              {{ $testPatientClass->convertDateFormat($patient->dob) }}</li>
                      </ul>
                      <ul class="list-inline injuryInfo">
                          <li class="list-inline-item headItem"><b>SSN :</b></li>
                          <li class="list-inline-item text-secondary">
                              {{ $patient->ssn_no ? $patient->ssn_no : 'NA' }}</li>
                      </ul>
                      <ul class="list-inline injuryInfo">
                          <li class="list-inline-item headItem"><b>Gender :</b></li>
                          <li class="list-inline-item text-secondary"> {{ $patient->gender }}</li>
                      </ul>
                      <ul class="list-inline injuryInfo">
                          <li class="list-inline-item headItem"><b>Address :</b></li>
                          <li class="list-inline-item text-secondary"> {{ $patient->address_line1 }}
                              {{ $patient->address_line2 }} {{ $patient->zipcode }}</li>
                      </ul>
                  </div>
              </div>
          </div>
          <div class="col-xs-6 col-sm-6 col-md-6">
              <div class="card">
                  <div class="card-body">
                      <div class="card-title">Patient Information - Optional</div>
                      <ul class="list-inline injuryInfo">
                          <li class="list-inline-item headItem"><b>Mobile :</b></li>
                          <li class="list-inline-item text-secondary">
                              {{ $patient->contact_no ? $patient->contact_no : 'NA' }}</li>
                      </ul>
                      <ul class="list-inline injuryInfo">
                          <li class="list-inline-item headItem"><b>Telephone :</b></li>
                          <li class="list-inline-item text-secondary">
                              {{ $patient->landline_no ? $patient->landline_no : 'NA' }}</li>
                      </ul>
                      <ul class="list-inline injuryInfo">
                          <li class="list-inline-item headItem"><b>Practice Internal ID :</b></li>
                          <li class="list-inline-item text-secondary">
                              {{ $patient->practice_id ? $patient->practice_id : 'NA' }}</li>
                      </ul>
                  </div>
              </div>
          </div>
      </div>
      <div class="row">
          <div class="col-xs-12 col-sm-12 col-md-12">
              <div class="card">
                  <div class="card-body">
                      <div class="card-title">
                          <div class="row">
                              <div class="col-xs-6 col-sm-6 col-md-6">
                                  <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none">
                                      <path fill="#818598" fill-rule="evenodd"
                                          d="M14.828 3.515a4 4 0 0 1 5.657 5.657L17.657 12 12 6.343l2.828-2.828ZM7.404 10.94l3.535-3.536 5.657 5.657-3.535 3.535-5.657-5.656ZM6.344 12l-2.83 2.829a4 4 0 1 0 5.658 5.656L12 17.657 6.343 12Zm10.252-6.01a.75.75 0 1 0 1.06-1.06.75.75 0 0 0-1.06 1.06Zm2.475 1.414a.75.75 0 1 1-1.06-1.06.75.75 0 0 1 1.06 1.06Zm-2.475 1.414a.75.75 0 1 0 1.06-1.06.75.75 0 0 0-1.06 1.06Zm-.353-1.414a.75.75 0 1 1-1.061-1.06.75.75 0 0 1 1.06 1.06Zm-9.9 8.839a.75.75 0 1 0 1.06-1.06.75.75 0 0 0-1.06 1.06Zm2.475 1.414a.75.75 0 1 1-1.06-1.06.75.75 0 0 1 1.06 1.06Zm-2.475 1.414a.75.75 0 1 0 1.06-1.06.75.75 0 0 0-1.06 1.06Zm-.353-1.414a.75.75 0 1 1-1.061-1.06.75.75 0 0 1 1.06 1.06Z"
                                          clip-rule="evenodd"></path>
                                  </svg>
                                  <b>Injuries</b>
                              </div>
                              <div class="col-xs-6 col-sm-6 col-md-6">
                                  <b><a class="link-primary"
                                          href="{{ url('/create/patients/injury', $patient->id) }}">Add Injury</a></b>
                              </div>
                          </div>
                      </div>
                      @if ($patient->getInjuries)
                          <div class="row">
                              @foreach ($patient->getInjuries as $injury)
                                  <div class="col-sm-6">
                                      <div class="card border lineheight">
                                          <a href="{{ url('/injury/view/' . $injury->id) }}">
                                              <div class="card-header  showButtonColor">
                                                  <h4 class="card-title text-warning">
                                                      {{ substr($injury->description, 0, 100) }}
                                                      &nbsp; <small><span
                                                              style="text-align:right;float: right;padding-right: 5px; cursor: pointer;">
                                                              View <i class="icon-eye"></i></span></small>
                                                  </h4>
                                              </div>
                                              <div class="card-body">
                                                  <ul class="list-group list-group-flush">
                                                      <li class="list-group-item">
                                                          <ul class="list-inline injuryInfo">
                                                              <li class="list-inline-item headItem"><b>Financial
                                                                      Class:</b></li>
                                                              <li class="list-inline-item text-secondary">
                                                                  {{ $injury->financial_class == 1 ? 'Worker Comp.' : ($injury->financial_class == 2 ? 'Private / Government' : 'Personal Injury') }}
                                                              </li>
                                                          </ul>
                                                          <ul class="list-inline injuryInfo">
                                                              <li class="list-inline-item headItem"><b>Employer:</b>
                                                              </li>
                                                              <li class="list-inline-item text-secondary">
                                                                  {{ $injury->getInjuryClaim ? $injury->getInjuryClaim->employer_name : 'NA' }}
                                                              </li>
                                                          </ul>
                                                          <ul class="list-inline injuryInfo">
                                                              <li class="list-inline-item headItem"><b>DOI:</b></li>
                                                              <li class="list-inline-item text-secondary">
                                                                  {{ $injury->getInjuryClaim ? $testPatientClass->convertDateFormat($injury->getInjuryClaim->start_date) : 'NA' }}
                                                              </li>
                                                          </ul>
                                                          <ul class="list-inline injuryInfo">
                                                              <li class="list-inline-item headItem"><b>Claim No.:</b>
                                                              </li>
                                                              <li class="list-inline-item text-secondary">
                                                                  {{ $injury->getInjuryClaim ? $injury->getInjuryClaim->claim_no : 'NA' }}
                                                              </li>
                                                          </ul>
                                                          <ul class="list-inline injuryInfo">
                                                              <li class="list-inline-item headItem"><b>Claims
                                                                      Administrator :</b></li>
                                                              <li class="list-inline-item text-secondary">
                                                                  {{ $injury->getInjuryClaim && $injury->getInjuryClaim->getClaimAdmin && $injury->getInjuryClaim->getClaimAdmin->name ? ucfirst($injury->getInjuryClaim->getClaimAdmin->name) : 'NA' }}
                                                              </li>
                                                          </ul>

                                                          <ul class="list-inline injuryInfo">
                                                              <li class="list-inline-item headItem"><b>Payer :</b></li>
                                                              <li class="list-inline-item text-secondary"> -</li>
                                                          </ul>
                                                      </li>

                                                      <li class="list-group-item">
                                                          <div class="row">
                                                              @if (count($injury->getInjuryBills) > 0)
                                                                  <div class="col-md-9">
                                                                      <a
                                                                          href="{{ url('/view/patient/injury/bill/' . $injury->id) }}">
                                                                          <h5> Bill Count -
                                                                              {{ $injury->getInjuryBills ? count($injury->getInjuryBills) : 0 }}
                                                                          </h5>
                                                                          View All
                                                                      </a>
                                                                  </div>
                                                              @endif
                                                              <div
                                                                  class="col-md-{{ count($injury->getInjuryBills) > 0 ? '3' : 12 }}">
                                                                  <a class="btn btn-outline-primary"
                                                                      href="{{ url('/add/injury/bill', $injury->id) }}">Add
                                                                      Bill</a>
                                                              </div>
                                                          </div>
                                                          <div class="row">
                                                              <div class="col-xs-6 col-sm-6 col-md-3">Rejected</div>
                                                              <div class="col-xs-6 col-sm-6 col-md-3">No Response</div>
                                                              <div class="col-xs-6 col-sm-6 col-md-3">Rejected</div>
                                                              <div class="col-xs-6 col-sm-6 col-md-3">No Response</div>
                                                          </div>

                                                          <div class="row">
                                                              <div class="col-xs-6 col-sm-6 col-md-3">0</div>
                                                              <div class="col-xs-6 col-sm-6 col-md-3">0</div>
                                                              <div class="col-xs-6 col-sm-6 col-md-3">0</div>
                                                              <div class="col-xs-6 col-sm-6 col-md-3">0</div>
                                                          </div>
                                                      </li>
                                                      <li class="list-group-item">
                                                          <div class="row">
                                                              <div class="col-md-9">
                                                                  <div align="left">
                                                                      <h5> RFA Count - 0 </h5><a href=""> View
                                                                          All </a>
                                                                  </div>
                                                              </div>
                                                              <div class="col-md-3">
                                                                  <a class="btn btn-outline-primary"
                                                                      href="#">Add RFA</a>
                                                              </div>
                                                          </div>
                                                          <div class="row">
                                                              <div class="col-xs-6 col-sm-6 col-md-3">Rejected</div>
                                                              <div class="col-xs-6 col-sm-6 col-md-3">No Response</div>
                                                              <div class="col-xs-6 col-sm-6 col-md-3">Rejected</div>
                                                              <div class="col-xs-6 col-sm-6 col-md-3">No Response</div>
                                                          </div>
                                                          <div class="row">
                                                              <div class="col-xs-6 col-sm-6 col-md-3">0</div>
                                                              <div class="col-xs-6 col-sm-6 col-md-3">0</div>
                                                              <div class="col-xs-6 col-sm-6 col-md-3">0</div>
                                                              <div class="col-xs-6 col-sm-6 col-md-3">0</div>
                                                          </div>
                                                      </li>
                                                  </ul>
                                              </div>
                                          </a>
                                      </div>
                                  </div>
                              @endforeach
                          </div>
                      @endif
                  </div>
              </div>
          </div>
      </div>
  </div>
