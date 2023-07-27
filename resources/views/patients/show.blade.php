@extends('layouts.home-app')
@section('content')
<style type="text/css">
.activeContent{ display: flex; }
.hiddenContent{ display: none; }
.injuryInfo{

}
.injuryInfo .headItem {
    width:27%;
    font-size:12px;
}

.card-title
{
  margin-bottom: 0rem; 
}

.card {
    margin-bottom: 0.875rem;
    border: none;
    -webkit-box-shadow: 0 2px 1px rgba(0,0,0,.05);
    box-shadow: 0 2px 1px rgba(0,0,0,.05);
}

ul {
    margin-bottom: 0rem !important;
}

.col-md-3 {
    position: relative;
    width: 100%;
    min-height: 1px;
    padding-right: 5px !important;
    padding-left: 14px !important;
}

.lineheight {
 line-height: 1.5;
}

.list-group-item {
    position: relative;
    display: block;
    padding: 0.25rem;
    margin-bottom: -1px;
    background-color: #FFF;
    border: 1px solid #E4E7ED;
}

h2
{
    margin-bottom: 0rem;
}

</style>
 <!-- START: Breadcrumbs-->
 <div class="row">
        <div class="col-12  align-self-center">
            <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                <div class="w-sm-100 mr-auto col-9">
                    <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                        <li class="breadcrumb-item">
                        <h2>
                        <svg xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" viewBox="0 0 34 34" class="left">
                        <title>icon_patient</title><path d="M20.983 16.793L19.32 23.2h-1.857c-.825.017-1.48.654-1.463 1.425l.005.21c.017.758.682 1.365 1.495 1.365h5.147c.977 0 1.829-.617 2.07-1.5l.269-.977a.392.392 0 0 0 .014-.104c0-.231-.2-.418-.448-.418h-.753l-1.085-6.853c.258.077.501.185.73.324.517.314.933.72 1.248 1.216.314.497.573 1.094.777 1.791.203.698.343 1.39.418 2.079.075.688.113 1.42.113 2.194 0 .993-.277 1.846-.83 2.557-.553.71-1.22 1.066-1.999 1.066H11.83c-.78 0-1.446-.355-1.999-1.066-.553-.711-.83-1.564-.83-2.557 0-.775.038-1.506.113-2.194.075-.689.215-1.381.418-2.079.204-.697.463-1.294.777-1.79.315-.497.73-.903 1.249-1.217.518-.315 1.113-.472 1.786-.472 1.16 1.167 2.546 1.75 4.157 1.75 1.31 0 2.472-.386 3.483-1.157zm-.58 6.623l1.423-5.602.791 5.602h-2.213zM22.5 12c0 1.38-.488 2.559-1.465 3.535C20.06 16.512 18.88 17 17.5 17c-1.38 0-2.559-.488-3.535-1.465C12.988 14.56 12.5 13.38 12.5 12c0-1.38.488-2.559 1.465-3.535C14.94 7.488 16.12 7 17.5 7c1.38 0 2.559.488 3.535 1.465C22.012 9.44 22.5 10.62 22.5 12z" fill="#3A3A3A" fill-rule="evenodd"></path></svg>
                                <b>{{$patient->suffix}} {{$patient->first_name}} {{$patient->last_name}}</b>
                        <span>#{{$patient->patient_no}}</span></h2>
                        <span class="pt=1">Patient Name</span>
                        </li>
                    </ol>
                </div>
                <div align="right" style="margin-right:-55px!important;" class="w-sm-100 mr-auto col-3">
                    <ul class="list-inline">
                        <li class="list-inline-item liItem">
                            <a class="btn btn-primary rounded ml-auto text-white" href="{{url('/edit/patient')}}/{{$patient->id}}"> <i  class="icon-pencil  showPointer"/></i> Edit</a>
                        </li>
                        <li class="list-inline-item liItem">
                            <a href="{{route('addPatientSchedular', $patient->id)}}" class="btn btn-primary rounded ml-auto text-white">
                                <i  class="ion ion-plus-round text-white"></i> <span class="d-none d-xl-inline-block">Add Schedular</span>
                            </a>
                        </li>
                        <li class="list-inline-item liItem">
                            <a class="btn btn-primary rounded ml-auto text-white" href="{{ route('patients.index') }}"> Back</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Breadcrumbs-->
     @inject('testPatientClass', 'App\Http\Controllers\PatientController')
    <div class="row" style="background-color:#FFFFFF">
            <div class="col-9 mt-4 row-background">
                <div class="row">
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">Patient Information - Required</div>
                                <table class="table">
                                        <tr>
                                            <td width="10%"><b>Name</b></td>
                                            <td width="40%">{{$patient->suffix}} {{$patient->first_name}} {{$patient->last_name}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>DOB</b></td>
                                            <td>{{$testPatientClass->convertDateFormat($patient->dob)}} </td>
                                        </tr>
                                        <tr>
                                            <td><b>SSN</b></td>
                                            <td>{{($patient->ssn_no) ? $patient->ssn_no : 'NA'}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Gender</b></td>
                                            <td>{{$patient->gender}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Address</b></td>
                                            <td>{{$patient->address_line1}} {{$patient->address_line2}} {{$patient->zipcode}}</td>
                                        </tr>
                                        <!--<tr>-->
                                        <!--    <td><b>Contact No.</b></td>-->
                                        <!--    <td{{($patient->contact_no) ? $patient->contact_no : 'NA'}}</td>-->
                                        <!--</tr> -->
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-6 col-sm-6 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-title">Patient Information - Optional</div>
                                <table class="table">
                                        <tr>
                                            <td><b>Mobile </b></td>
                                            <td> {{( $patient->contact_no) ? $patient->contact_no : 'NA'}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Telephone</b></td>
                                            <td> {{($patient->landline_no) ? $patient->landline_no : 'NA'}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Practice Internal ID</b></td>
                                            <td>{{($patient->practice_id) ? $patient->practice_id : 'NA'}}</td>
                                        </tr>
                                </table>
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
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"><path fill="#818598" fill-rule="evenodd" d="M14.828 3.515a4 4 0 0 1 5.657 5.657L17.657 12 12 6.343l2.828-2.828ZM7.404 10.94l3.535-3.536 5.657 5.657-3.535 3.535-5.657-5.656ZM6.344 12l-2.83 2.829a4 4 0 1 0 5.658 5.656L12 17.657 6.343 12Zm10.252-6.01a.75.75 0 1 0 1.06-1.06.75.75 0 0 0-1.06 1.06Zm2.475 1.414a.75.75 0 1 1-1.06-1.06.75.75 0 0 1 1.06 1.06Zm-2.475 1.414a.75.75 0 1 0 1.06-1.06.75.75 0 0 0-1.06 1.06Zm-.353-1.414a.75.75 0 1 1-1.061-1.06.75.75 0 0 1 1.06 1.06Zm-9.9 8.839a.75.75 0 1 0 1.06-1.06.75.75 0 0 0-1.06 1.06Zm2.475 1.414a.75.75 0 1 1-1.06-1.06.75.75 0 0 1 1.06 1.06Zm-2.475 1.414a.75.75 0 1 0 1.06-1.06.75.75 0 0 0-1.06 1.06Zm-.353-1.414a.75.75 0 1 1-1.061-1.06.75.75 0 0 1 1.06 1.06Z" clip-rule="evenodd"></path></svg>
                                            <b>Injuries</b>
                                        </div>
                                        <div class="col-xs-6 col-sm-6 col-md-6">
                                            <b><a class="link-primary" href="{{url('/create/patients/injury',$patient->id)}}">Add Injury</a></b>
                                        </div>
                                    </div>
                                </div>
                                @if($pInjuries)
                                    <div class="row">
                                        @foreach ($pInjuries as $injury)
                                            <div class="col-sm-6">
                                                <div class="card border lineheight">
                                                    <a  href="{{url('/injury/view/'.$injury->id)}}">
                                                        <div class="card-header  showButtonColor">
                                                            <h4 class="card-title text-warning">{{substr($injury->description, 0, 100)}}
                                                            &nbsp; <small><span style="text-align:right;float: right;padding-right: 5px; cursor: pointer;">
                                                                    View <i class="icon-eye"></i></span></small>
                                                            </h4>
                                                        </div>
                                                        <div class="card-body">
                                                            <ul class="list-group list-group-flush">
                                                                <li class="list-group-item">
                                                                    <ul class="list-inline injuryInfo">
                                                                        <li class="list-inline-item headItem"><b>Financial Class:</b></li>
                                                                        <li class="list-inline-item text-secondary">{{($injury->financial_class == 1) ? 'Worker Comp.' : (($injury->financial_class == 2) ? 'Private / Government' : 'Personal Injury')}}</li>
                                                                    </ul>
                                                                    <ul class="list-inline injuryInfo">
                                                                        <li class="list-inline-item headItem"><b>Employer:</b></li>
                                                                        <li class="list-inline-item text-secondary">{{($injury->getInjuryClaim) ? $injury->getInjuryClaim->employer_name : 'NA'}}</li>
                                                                    </ul>
                                                                    <ul class="list-inline injuryInfo">
                                                                        <li class="list-inline-item headItem"><b>DOI:</b></li>
                                                                        <li class="list-inline-item text-secondary">{{($injury->getInjuryClaim) ?  $testPatientClass->convertDateFormat($injury->getInjuryClaim->start_date)  : 'NA'}}</li>
                                                                    </ul>
                                                                    <ul class="list-inline injuryInfo">
                                                                        <li class="list-inline-item headItem"><b>Claim No.:</b></li>
                                                                        <li class="list-inline-item text-secondary"> {{($injury->getInjuryClaim) ? $injury->getInjuryClaim->claim_no : 'NA'}}</li>
                                                                    </ul>
                                                                    <ul class="list-inline injuryInfo">
                                                                        <li class="list-inline-item headItem"><b>Claims Administrator :</b></li>
                                                                        <li class="list-inline-item text-secondary"> {{($injury->getInjuryClaim  && $injury->getInjuryClaim->getClaimAdmin && $injury->getInjuryClaim->getClaimAdmin->name) ? ucfirst($injury->getInjuryClaim->getClaimAdmin->name) : 'NA' }}</li>
                                                                    </ul>
                                                                    
                                                                    <ul class="list-inline injuryInfo">
                                                                        <li class="list-inline-item headItem"><b>Payer :</b></li>
                                                                        <li class="list-inline-item text-secondary"> -</li>
                                                                    </ul>
                                                                </li>
                                                                
                                                                
                                                                
                                                                
                                                                <li class="list-group-item">
                                                                    <div class="row">
                                                                        @if(count($injury->getInjuryBills) > 0)
                                                                            <div class="col-md-9">
                                                                                <a  href="{{url('/view/patient/injury/bill/'.$injury->id)}}"> <h5> Bill Count - {{($injury->getInjuryBills) ? count($injury->getInjuryBills) : 0}} </h5>
                                                                                    View All 
                                                                                </a>
                                                                            </div>
                                                                         @endif
                                                                          <div class="col-md-{{ (count($injury->getInjuryBills) > 0) ? '3' : 12 }}">
                                                                          <a class="btn btn-outline-primary" href="{{url('/add/injury/bill',$injury->id)}}">Add Bill</a>
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
                                                                                 <div align="left"> <h5> RFA Count - 0 </h5><a href=""> View All </a></div>
                                                                             </div>
                                                                              <div class="col-md-3">
                                                                              <a class="btn btn-outline-primary" href="#">Add RFA</a>
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
                                <div class="row">
                                <div class="col-sm-12"> 
                                    @if ($patient && $patient->getPatientHistory && count($patient->getPatientHistory))
                                        <div class="card">
                                            <div class="card-header">
                                            <h2 onclick="myFunction()">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="30px" height="30px"
                                                    viewBox="0 0 34 34" class="left">
                                                    <title>icon_patient</title>
                                                    <path d="M20.983 16.793L19.32 23.2h-1.857c-.825.017-1.48.654-1.463 1.425l.005.21c.017.758.682 1.365 1.495 1.365h5.147c.977 0 1.829-.617 2.07-1.5l.269-.977a.392.392 0 0 0 .014-.104c0-.231-.2-.418-.448-.418h-.753l-1.085-6.853c.258.077.501.185.73.324.517.314.933.72 1.248 1.216.314.497.573 1.094.777 1.791.203.698.343 1.39.418 2.079.075.688.113 1.42.113 2.194 0 .993-.277 1.846-.83 2.557-.553.71-1.22 1.066-1.999 1.066H11.83c-.78 0-1.446-.355-1.999-1.066-.553-.711-.83-1.564-.83-2.557 0-.775.038-1.506.113-2.194.075-.689.215-1.381.418-2.079.204-.697.463-1.294.777-1.79.315-.497.73-.903 1.249-1.217.518-.315 1.113-.472 1.786-.472 1.16 1.167 2.546 1.75 4.157 1.75 1.31 0 2.472-.386 3.483-1.157zm-.58 6.623l1.423-5.602.791 5.602h-2.213zM22.5 12c0 1.38-.488 2.559-1.465 3.535C20.06 16.512 18.88 17 17.5 17c-1.38 0-2.559-.488-3.535-1.465C12.988 14.56 12.5 13.38 12.5 12c0-1.38.488-2.559 1.465-3.535C14.94 7.488 16.12 7 17.5 7c1.38 0 2.559.488 3.535 1.465C22.012 9.44 22.5 10.62 22.5 12z"
                                                        fill="#3A3A3A" fill-rule="evenodd"></path>
                                                </svg>History 
                                            </h2>
                                            </div>
                                            <div class="card-body" style="display:none" id="myDIV">
                                                <div class="table-responsive"> 
                                                    <table id="example" class="table layout-secondary dataTable table-striped table-bordered">
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
                                                                        <td>{{ $history->created_at  }}
                                                                        </td>
                                                                        <td>{{ $history->getUser ? $history->getUser->name : 'NA' }}
                                                                        </td>
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
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-3 mt-4 rightside" style="z-index: 0;" >
                <div class="card">
                @include('patients.show-patient-info')
                </div>
            </div>
        </div>

<script src="{{ asset('public/js/controller/patient_injury.js') }}"></script>
@endsection
