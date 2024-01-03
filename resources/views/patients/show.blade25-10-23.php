@extends('layouts.home-new-app')
@section('content')
<style>
.collapsible {
  background-color:#f4f4f6cc;
  border: 0px solid #c9c9c9;
    color: #000000;
    font-weight: 600;
  cursor: pointer;
  padding: 18px;
  width: 100%;
  text-align: left;
  outline: none;
  font-size:1.12rem;
}
button:focus {
    outline: dotted 0px;
    outline: -webkit-focus-ring-color auto 0px;
}
.collapsible:hover {
  background-color: #f4f4f6;
  border:0px solid #c9c9c9;
}

.collapsible:after {
     font-family: FontAwesome;
  content: '\f107';
  color: #000;
  font-weight: bold;
  float: right;
  margin-left: 5px;
}

.card .card-title{ 
    letter-spacing: 0.0rem;
}
table.dataTable {
    margin-top:0px !important;
    margin-bottom:0px !important;
}

.accordion {
  background-color:#f4f4f6;
  color: #444;
  cursor: pointer;
  padding:10px 18px;
  width: 100%;
  border: none;
  text-align: left;
  outline: none;
  font-size: 15px;
  transition: 0.4s;
  border:1px solid #c9c9c9cc;
  -webkit-transition: all 0.2ms ease;
-moz-transition: all 0.2ms ease;
-ms-transition: all 0.2ms ease;
-o-transition: all 0.2ms ease;
transition: all 0.2ms ease;
}
.active, .accordion:hover {
  background-color: #ccc;
}

.accordion:after {
  font-family: FontAwesome;
  content: '\f107';
  color: #777;
  font-weight: bold;
  float: right;
  margin-left: 5px;
  font-size:14px;
}
.active:after {
 content:'\f077';
}
.panel {
  padding: 0 0px;
  background-color: white;
  max-height: 0;
  overflow: hidden;
  transition: max-height 0.2s ease-out;
}
 </style>

    <!-- START: Breadcrumbs-->
    <div class="row mt-2">
        <div class="col-12  d-flex align-self-center">
            <div class="sub-header py-3 px-1  w-100 rounded heading-background">
                <div class="row">
                    <div class="col-lg-8">
                        <ol class="breadcrumb bg-transparent align-self-center m-0 p-0 ">
                            <li class="breadcrumb-item">
                                <h2>
                                    <i class="fa-solid fa-user-injured"></i>
                                    <title>icon_patient</title>
                                    {{ $patient->suffix }} {{ $patient->first_name }} {{ $patient->last_name }}
                                    <span>#{{ $patient->patient_no }}</span>
                                </h2>
                                <span class="pt-1 subtittle">Patient Name</span>
                            </li>
                        </ol>
                    </div>
                    <div class="col-lg-4 d-flex justify-content-end align-content-center">
                        <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                            <li class="breadcrumb-item2">
                                <a class="btn btn-primary rounded ml-auto text-white mr-1"
                                    href="{{ url('/edit/patient') }}/{{ $patient->id }}"> <i
                                        class="icon-pencil  showPointer" /></i> Edit</a>
                            </li>
                            <li class="breadcrumb-item2">
                                <a href="{{ route('addPatientSchedular', $patient->id) }}"
                                    class="btn btn-primary rounded ml-auto text-white mr-1">
                                    <i class="ion ion-plus-round text-white"></i> <span class="d-none d-xl-inline-block">Add
                                        Schedular</span></a>
                            </li>
                            <li class="breadcrumb-item2">
                                <a class="btn btn-primary rounded ml-auto text-white" href="{{ route('patients.index') }}">
                                    Back</a>
                            </li>
                        </ol>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Breadcrumbs-->
    @inject('testPatientClass', 'App\Http\Controllers\PatientController')
    <div class="row">
        <div class="col-xl-9 col-lg-8 mt-4 injuryBox">
            <div class="row mt-2">
                <div class="col-xs-6 col-sm-6 col-md-6 padR-0">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">Patient Information - Required</div>
                            <table class="table">
                                <tr>
                                    <td width="10%"><b>Name</b></td>
                                    <td width="40%">{{ $patient->suffix }} {{ $patient->first_name }}
                                        {{ $patient->last_name }}</td>
                                </tr>
                                <tr>
                                    <td><b>DOB</b></td>
                                    <td>{{ $testPatientClass->convertDateFormat($patient->dob) }} </td>
                                </tr>
                                <tr>
                                    <td><b>SSN</b></td>
                                    <td>{{ $patient->ssn_no ? $patient->ssn_no : 'NA' }}</td>
                                </tr>
                                <tr>
                                    <td><b>Gender</b></td>
                                    <td>{{ $patient->gender }}</td>
                                </tr>
                                <tr>
                                    <td><b>Address</b></td>
                                    <td>
                                    {{($patient->address_line1) ? trim($patient->address_line1) : ''}}
                                    {{($patient->address_line2) ? ','.trim($patient->address_line2) : '' }}
                                    {{($patient->city_id)?','.$patient->city_id : ''}}
                                    {{($patient->state_id)?','.strtoupper( substr( $patient->state_id, 0, 2 )) : ''}} 
                                    {{$patient->zipcode }}
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div> 
                <div class="col-xs-6 col-sm-6 col-md-6 padL-0">
                    <div class="card">
                        <div class="card-body">
                            <div class="card-title">Patient Information - Optional</div>
                            <table class="table">
                                <tr>
                                    <td><b>Mobile </b></td>
                                    <td> {{ $patient->contact_no ? $patient->contact_no : 'NA' }}</td>
                                </tr>
                                <tr>
                                    <td><b>Telephone</b></td>
                                    <td> {{ $patient->landline_no ? $patient->landline_no : 'NA' }}</td>
                                </tr>
                                <tr>
                                    <td><b>Practice Internal ID</b></td>
                                    <td>{{ $patient->practice_id ? $patient->practice_id : 'NA' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            
             <div class="row only-title">
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <div class="card">
                        <div class="card-body2">
                            <div class="card-title d-flex justify-content-between ">
                                <span><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none">
                                        <path fill="#818598" fill-rule="evenodd"
                                            d="M14.828 3.515a4 4 0 0 1 5.657 5.657L17.657 12 12 6.343l2.828-2.828ZM7.404 10.94l3.535-3.536 5.657 5.657-3.535 3.535-5.657-5.656ZM6.344 12l-2.83 2.829a4 4 0 1 0 5.658 5.656L12 17.657 6.343 12Zm10.252-6.01a.75.75 0 1 0 1.06-1.06.75.75 0 0 0-1.06 1.06Zm2.475 1.414a.75.75 0 1 1-1.06-1.06.75.75 0 0 1 1.06 1.06Zm-2.475 1.414a.75.75 0 1 0 1.06-1.06.75.75 0 0 0-1.06 1.06Zm-.353-1.414a.75.75 0 1 1-1.061-1.06.75.75 0 0 1 1.06 1.06Zm-9.9 8.839a.75.75 0 1 0 1.06-1.06.75.75 0 0 0-1.06 1.06Zm2.475 1.414a.75.75 0 1 1-1.06-1.06.75.75 0 0 1 1.06 1.06Zm-2.475 1.414a.75.75 0 1 0 1.06-1.06.75.75 0 0 0-1.06 1.06Zm-.353-1.414a.75.75 0 1 1-1.061-1.06.75.75 0 0 1 1.06 1.06Z"
                                            clip-rule="evenodd"></path>
                                    </svg>
                                    Injuries
                                </span>
                                <span>
                                    <a class="link-primary" href="{{ url('/create/patients/injury', $patient->id) }}">Add Injury</a>
                                </span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        
        @if ($patient->getInjuries)
            <div class="row mb-2">
                @foreach ($patient->getInjuries as $injury)
                <div class="col-xs-6 col-sm-6 col-md-6 pManage" id="history">
                    <div class="card"> 
                        <div class="card-body"> 
                            <a href="{{ url('/injury/view/' . $injury->id) }}">
                                <div class="card-title d-flex justify-content-between align-item-center">
                                    <span>{{ substr($injury->description, 0, 100) }}
                                    </span>
                                    <span> View <i class="icon-eye"></i></span>
                                </div>
                            </a>
                            <table class="table">
                                <tr>
                                    <td width="10%"><b>Financial Class:</b></td>
                                    <td width="40%">
                                        {{ $injury->financial_class == 1 ? 'Worker Comp.' : ($injury->financial_class == 2 ? 'Private / Government' : 'Personal Injury') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Employer:</b></td>
                                    <td>{{ $injury->getInjuryClaim ? $injury->getInjuryClaim->employer_name : 'NA' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>DOI:</b></td>
                                    <td>{{ $injury->getInjuryClaim ? $testPatientClass->convertDateFormat($injury->getInjuryClaim->start_date) : 'NA' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Claim No.:</b></td>
                                    <td>{{ $injury->getInjuryClaim ? $injury->getInjuryClaim->claim_no : 'NA' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Claims Administrator :</b></td>
                                    <td>{{ $injury->getInjuryClaim && $injury->getInjuryClaim->getClaimAdmin && $injury->getInjuryClaim->getClaimAdmin->name ? ucfirst($injury->getInjuryClaim->getClaimAdmin->name) : 'NA' }}
                                    </td>
                                </tr>

                            </table>
                            @if (count($injury->getInjuryBills) > 0)
                                <ul class="list-group list-group-flush m-1">
                                    <li class="list-group-item">
                                        <div
                                            class="card-title row d-flex align-content-center align-items-center custom-title">

                                            <div class="col-md-8 col-xl-8">
                                                <a href="{{ url('/view/patient/injury/bill/' . $injury->id) }}">
                                                    <h4> Bill Count -
                                                        {{ $injury->getInjuryBills ? count($injury->getInjuryBills) : 0 }}
                                                    </h4>
                                                </a>
                                            </div>
                                            <div
                                                class="col-md-4 col-xl-4 d-flex align-content-center justify-content-between">
                                                <div align="left">
                                                    <a class="btn btn-outline-primary"
                                                        href="{{ url('/view/patient/injury/bill/' . $injury->id) }}">
                                                        View All
                                                    </a>
                                                </div>

                                                <a class="btn btn-outline-primary"
                                                    href="{{ url('/add/injury/bill', $injury->id) }}">Add Bill</a>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <table class="table billtab">
                                                <tr>
                                                    <td align="center">
                                                        <b>Unsend</b>
                                                    </td>

                                                    <td align="center">
                                                        <b>Rejected</b>
                                                    </td>
                                                    <td align="center">
                                                        <b>No Response</b>
                                                    </td>
                                                    <td align="center">
                                                        <b>Payments</b>
                                                    </td>
                                                    <td align="center">
                                                        <b>Denials</b>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="center">
                                                        {{ $injury && $injury->getInjuryBills ? count($injury->getInjuryBills) : 0 }}
                                                    </td>
                                                    <td align="center">0</td>
                                                    <td align="center">0</td>
                                                    <td align="center">0</td>
                                                    <td align="center">0</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </li>
                                    <li class="list-group-item">
                                        <div
                                            class="card-title row d-flex align-content-center align-items-center custom-title">
                                            <div class="col-md-8 col-xl-8">
                                                <div align="left">
                                                    <h4> RFA Count - 01 </h4>
                                                </div>
                                            </div>
                                            <div
                                                class="col-md-4 col-xl-4 d-flex align-content-center justify-content-between">
                                                <div align="left">
                                                    <a class="btn btn-outline-primary" href="#"> View All</a>
                                                </div>

                                                <a class="btn btn-outline-primary" href="#">Add RFA</a>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <table class="table billtab">
                                                <tr>
                                                    <td align="center">
                                                        <b>Unsend</b>
                                                    </td>

                                                    <td align="center">
                                                        <b>Rejected</b>
                                                    </td>
                                                    <td align="center">
                                                        <b>No Response</b>
                                                    </td>
                                                    <td align="center">
                                                        <b>Payments</b>
                                                    </td>
                                                    <td align="center">
                                                        <b>Denials</b>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td align="center">0</td>
                                                    <td align="center">0</td>
                                                    <td align="center">0</td>
                                                    <td align="center">0</td>
                                                    <td align="center">0</td>
                                                </tr>
                                            </table>
                                        </div>
                                    </li>
                                </ul>
                            @endif
                         
                        </div> 
                    </div>
                </div>
                @endforeach
            </div>
             @endif    
            
             <div class="row mt-0 mb-4">
                <div class="col-sm-12">
                     @if ($patient && $patient->getPatientHistory && count($patient->getPatientHistory))
                    <button class="accordion"><i class="fa-solid fa-clock-rotate-left"></i> History</button>
                      <div class="panel">
                           <div class="card-body2">
                              <div class="table-responsive"> 
                                    <table id="Table" class="table layout-secondary dataTable table-striped table-bordered" style="width:100%;">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th scope="col">Date</th>
                                                <th scope="col">User</th>
                                                <th scope="col">Details</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($patient->getPatientHistory as $history)
                                                    <tr>
                                                        <td>{{ $history->created_at }}</td>
                                                        <td>{{ $history->getUser ? $history->getUser->name : 'NA' }}</td>
                                                        <td>{{ $history->description }}</td>
                                                    </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                        </div>
                      </div>
                      @endif


                    
                    
                   
                </div>
            </div>

        </div>   
         <div class="col-xl-3 col-lg-4 mt-2 rightside sticky">
            <div class="card">
                @include('patients.show-patient-info')
            </div>
        </div>     
    </div>        

    <script src="{{ asset('public/js/controller/patient_injury.js') }}"></script>


<script>
var acc = document.getElementsByClassName("accordion");
var i;
for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var panel = this.nextElementSibling;
    if (panel.style.maxHeight) {
      panel.style.maxHeight = null;
    } else {
      panel.style.maxHeight = panel.scrollHeight + "px";
    } 
  });
}
</script>

@endsection


