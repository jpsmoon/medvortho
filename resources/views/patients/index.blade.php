@extends('layouts.home-app')
@section('content')

<!-- START: Breadcrumbs-->
    <div class="row ">
        <div class="col-12  align-self-center">
            <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                <div class="w-sm-100 mr-auto"><h4 class="mt-3">Patients</h4>
                <!--<ol class="breadcrumb">-->
                <!--  <li class="breadcrumb-item"><a href="index.html">Home</a>-->
                <!--  </li>-->
                <!--  <li class="breadcrumb-item"><a href="#">Navbars</a>-->
                <!--  </li>-->
                <!--  <li class="breadcrumb-item active">Fixed Navigation-->
                <!--  </li>-->
                <!--</ol>-->
                </div>
                
                <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                    <li class="breadcrumb-item">
                        @can('Patient-create')
                        <a class="btn btn-primary" href="{{ route('patients.create') }}"> Add Patient</a>
                        @endcan
                    </li>
                </ol>
            </div>
        </div>
    </div>
    <!-- END: Breadcrumbs-->
    <!-- <div class="row">
        <div class="col-12 mt-3">
            <div class="card">
                <div class="card-body">
                {!! Form::open(['class' => 'form-horizontal','id' => 'patientListFrm','method'=>"get"]) !!}
                <div class="row row-xs">
                        <div class="col-md-10 mt-3 mt-md-0" id="keywordDiv">
                            <input type="text" name="keyword" class="form-control" maxlength="200" id="keyword" placeholder="search by patient name, id" value="">
                        </div>

                        <div class="col-md-2">
                            <label for="">&nbsp;</label>
                            <button type="submit" id="patient_Btn" class="btn btn-primary filter_patient">Search</button>
                            <button type="reset" class="btn btn-primary reset_payslip_filter">Reset</button>
                        </div>
                    </div>
                {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div> -->

    <div class="row">
            <div class="col-12 mt-3">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                        <table id="example" class="table layout-secondary dataTable table-striped table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Patient ID</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">DOB</th>
                                        <th scope="col">SSN</th>
                                        <th scope="col">Claim Number</th>
                                        <th scope="col">Billing Provider Name</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                    <tbody>
                                        @if(count($patients))
                                        @inject('testPatientClass', 'App\Http\Controllers\PatientController')
                                            @foreach ($patients as $patient)
                                                <tr>
                                                    <td><a class="" href="{{url('/patients/view',$patient->id)}}">{{$patient->patient_no}}</a></td>
                                                    <td>{{ $patient->first_name.' '.$patient->last_name }}</td>
                                                    <td> {{ $testPatientClass->convertDateFormat($patient->dob)}}</td>
                                                    <td>{{ $patient->ssn_no }}</td>
                                                    <td>
                                                        @if($patient->getInjuries && count($patient->getInjuries) > 0)
                                                        @php $claimNumbers = [];
                                                        @endphp
                                                        @foreach($patient->getInjuries as $injury)
                                                            @if($injury->getInjuryClaim && $injury->getInjuryClaim->claim_no)
                                                               @php $claimNumbers[] = $injury->getInjuryClaim->claim_no; @endphp
                                                            @endif
                                                        @endforeach
                                                        {{implode(',',$claimNumbers)}}
                                                        @endif
                                                    </td>
                                                    <td>{{ ($patient->getBillingProvider) ? $patient->getBillingProvider->professional_provider_name : 'NA'}} </td>
                                                    <td>{{ $patient->is_active ? 'Active' : 'Block' }}</td>
                                                    <td> <a class="" data-id="{{$patient->id}}"  href="{{url('/patients/view',$patient->id)}}">
                                                        <i  class="icon-eye showPointer"/></i>
                                                    </a>
                                                    @can('Patient-edit')
                                                        <a class="text-info" data-id="{{$patient->id}}" href="{{url('/edit/patient')}}/{{$patient->id}}" >
                                                        <i  class="icon-pencil  showPointer"/></i>
                                                        </a>
                                                    @endcan
                                                            @if(count($patient->getInjuries) == 0)
                                                            @can('Patient-delete')
                                                                <a href="javascript:void(0)" class="text-danger" data-id="{{$patient->id}}" onclick="deleteTodo({{$patient->id}})">
                                                                <i  class="icon-trash showPointer"/></i>
                                                                </a>
                                                            @endcan
                                                        @endif
                                                    </td>
                                                </tr>
                                                @endforeach
                                            @else
                                            <tr>
                                                <td colspan="10">No Records Found.</td>
                                            </tr>
                                            @endif
                                        </tbody>
                                </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://code.jquery.com/jquery-migrate-1.2.1.js"></script> 
<script src="{{ asset('js/controller/patients.js') }}"></script>
