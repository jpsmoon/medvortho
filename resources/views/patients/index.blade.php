@extends('layouts.home-app')
@section('content')
    <!-- START: Breadcrumbs-->
    <!-- END: Breadcrumbs-->
    
  <style>
      .dataTables_length
        {
          padding-top: 2%;  
        }  
  </style>  
    
    @if ($errors->any())
        <div class="row mt-2 customBox">
            <div class="col-md-12  align-self-center">
                <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                    <div class="w-sm-100 mr-auto">
                        <h4 class="mb-0">Billing Providers List</h4>
                    </div>

                    <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                        <li class="breadcrumb-item">
                            <a class="btn btn-primary" href="{{ route('billingproviders.index') }}">Back</a>
                        </li>
                    </ol>
                </div>
            </div>
            <div align="center" class="col-12  align-self-center">
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif
    <div class="row mt-2 ">
        <div class="col-md-12 mt-4">
            <div class="card row-background customBoxHeight">
                <!-- START: Breadcrumbs-->
                <div class="row ">
                    <div class="col-12  align-self-center">
                        <div class="sub-header py-3 px-3 align-self-center d-sm-flex w-100 rounded heading-background">
                            <div style="padding-top:10px" class="w-sm-100 mr-auto">
                                <h2 class="heading">Patient List </h2>
                            </div>
                             <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                            <li class="breadcrumb-item">
                                <a class="btn btn-primary" href="{{ route('billingproviders.index') }}"> Back</a>
                            </li>
                        </ol> 
                        </div>
                    </div>
                </div>
                <!-- END: Breadcrumbs-->
                <div class="card-content">
                    <div class="col-md-12 col-12">
                        <div class="row">
            <div class="col-12">
                <div class="card">
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
                                                    @can('patient-edit')
                                                        <a class="text-info" data-id="{{$patient->id}}" href="{{url('/edit/patient')}}/{{$patient->id}}" >
                                                        <i  class="icon-pencil  showPointer"/></i>
                                                        </a>
                                                    @endcan
                                                            @if(count($patient->getInjuries) == 0)
                                                            @can('patient-delete')
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
                </div>
            </div>
            <div class="col-1 mt-4"></div>
        </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://code.jquery.com/jquery-migrate-1.2.1.js"></script>
<script src="{{ asset('js/bootstrap-inputmask.js') }}"></script>
<script src="{{ asset('js/controller/master_for_all.js') }}"></script>
<script></script>
