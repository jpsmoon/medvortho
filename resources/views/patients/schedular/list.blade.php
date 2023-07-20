@extends('layouts.home-app')
@section('content')

<style>
@import url(https://fonts.googleapis.com/css?family=Audiowide);
 .table td, .table th {
    border-bottom: 1px solid #E3EBF3;
    padding: 0.25rem 0.25rem;
}  
 
 
.toolTipDiv *, *:before, *:after {
    box-sizing: inherit;
} 
.toolTipDiv span {
    color: #e91e63;
    font-family: monospace;
    white-space: nowrap;
}

.toolTipDiv span:after {
    font-family: Arial, sans-serif;
    text-align: left;
    white-space: normal;
}

.toolTipDiv span:focus {
    outline: none;
}
 

/*== start of code for tooltips ==*/
.tool {
    cursor: help;
    position: relative;
    top:5px;
}


/*== common styles for both parts of tool tip ==*/
.tool::before,
.tool::after {
    left: 50%;
    opacity: 0;
    position: absolute;
    z-index: -100;
}

.tool:hover::before,
.tool:focus::before,
.tool:hover::after,
.tool:focus::after {
    opacity: 1;
    transform: scale(1) translateY(0);
    z-index: 100; 
}


/*== pointer tip ==*/
.tool::before {
    border-style: solid;
    border-width: 1em 0.75em 0 0.75em;
    border-radius:4%;
    border-color: #3E474F transparent transparent transparent;
    bottom: 100%;
    content: "";
    margin-left: -0.5em;
    transition: all .65s cubic-bezier(.84,-0.18,.31,1.26), opacity .65s .5s;
    transform:  scale(.6) translateY(-90%);
} 

.tool:hover::before,
.tool:focus::before {
    transition: all .65s cubic-bezier(.84,-0.18,.31,1.26) .2s;
}


/*== speech bubble ==*/
.tool::after {
    background: #3E474F;
    border-radius: .25em;
    bottom: 178%;
    color: #EDEFF0;
    content: attr(data-tip);
    line-height: 1.2;
    margin-left: -8.75em;
    padding: 1em;
    transition: all .65s cubic-bezier(.84,-0.18,.31,1.26) .2s;
    transform:  scale(.6) translateY(50%);  
    width: 17.5em;
}

.tool:hover::after,
.tool:focus::after  {
    transition: all .65s cubic-bezier(.84,-0.18,.31,1.26);
}

@media (max-width: 760px) {
  .tool::after { 
        font-size: .75em;
        margin-left: -5em;
        width: 10em; 
  }
}


</style>

<!-- START: Breadcrumbs-->
    <div class="row ">
        <div class="col-12  align-self-center">
            <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                <div class="w-sm-100 mr-auto"><h4 class="mt-3">Appointments</h4>
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
                        <a class="btn btn-primary"href="{{ url('/patient/create/schedular') }}"> Add Appointment</a>
                        @endcan
                    </li>
                </ol>
            </div>
        </div>
    </div>
    <!-- END: Breadcrumbs-->
    <div class="row">
        <div class="col-12 mt-3">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
     <div class="row">
        <div class="col-12 mt-3">
            <div class="card">
                <div class="card-body">
                {!! Form::open(['class' => 'form-horizontal','id' => 'patientAppointmentListFrm','method'=>"get"]) !!}
                <div class="row row-xs ml-1">
                        <div class="col-md-3 mt-2" id="keywordDiv">
                            <input type="text" value="{{$searchKey}}"   name="keyword" class="form-control" maxlength="200" id="keyword" placeholder="search by patient name, id" value="">
                            @if($errors->has('keyword'))
                        <span class="invalid-feedback" style="display:block" role="alert">
                            <strong>{{ $errors->first('keyword') }}</strong>
                        </span>
                        @endif
                        </div>
                        
                        <div class="col-md-2 mt-2" id="renderingDiv">
                            <select name="renderingProviderId" id="renderingProviderId" class="form-control">
                                <option value=''>-Select Rendering Provider-</option>
                                @foreach ($renderProviders as $renProvider)
                                    <option value="{{$renProvider->id }}" {{ ($srcRendering == $renProvider->id) ? 'selected' : ''}}>{{$renProvider->referring_provider_first_name }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('renderingProviderId'))
                                <span class="invalid-feedback" style="display:block" role="alert">
                                    <strong>{{ $errors->first('renderingProviderId') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-2 mt-2" id="locationDiv">
                            <select name="locationId" id="locationId" class="form-control">
                                <option value=''>-Select Location-</option>
                                @foreach ($locations as $location)
                                    <option value="{{$location->id }}" {{ ($srcLocation == $location->id) ? 'selected' : ''}}>{{$location->nick_name }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('locationId'))
                                <span class="invalid-feedback" style="display:block" role="alert">
                                    <strong>{{ $errors->first('locationId') }}</strong>
                                </span>
                            @endif
                        </div>
                        <div class="col-md-2 mt-2" id="datepickerDiv">
                         <input value="{{$durationDate}}" placeholder="Choose date"   autocomplete="off"  type="text" id="duration_date" name="duration_date" class="form-control" maxlength="100">
                            <i class="icon-calendar"></i>  
                            @if($errors->has('duration_date'))
                                <span class="invalid-feedback" style="display:block" role="alert">
                                    <strong>{{ $errors->first('duration_date') }}</strong>
                                </span>
                            @endif
                        </div>
                         <div class="col-md-1 mt-2" id="resaonDiv">
                             <select name="appointment_meeting_Type" class="form-control">
                                <option value=''>-Select Meeting Type-</option>
                                @foreach ($meetingTypes as $meetingT)
                                    <option value="{{$meetingT['id'] }}" {{ ($meetingType == $meetingT['id']) ? 'selected' : ''}}>{{$meetingT['name'] }}</option>
                                @endforeach
                            </select>
                            @if($errors->has('appointment_meeting_Type'))
                            <span class="invalid-feedback" style="display:block" role="alert">
                                <strong>{{ $errors->first('appointment_meeting_Type') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="col-md-2 mt-2">
                            <label for="">&nbsp;</label>
                            <button type="submit" id="patient_Btn" class="btn btn-primary filter_patient">Search</button>
                            <button type="button" onClick="resetFrm();" class="btn btn-primary reset_payslip_filter">Reset</button>
                        </div>
                    </div>
                {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>

    <div class="row">
            <div class="col-12 mt-3">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                        <table id="examplelist" class="table layout-secondary dataTable table-striped table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Visit ID</th>
                                        <th scope="col">Visit Date</th>
                                        <th scope="col">Visit Time</th>
                                        <th scope="col">Patient Name</th>
                                        <th scope="col">Patient Phone</th>
                                        <th scope="col">Provider Name</th>
                                        <th scope="col">Visit Type</th>
                                        <th scope="col">Visit Status</th>
                                        <th scope="col">Bill Status</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                    <tbody>
                                        @if(count($patientAppointment))
                                        @inject('testPatientClass', 'App\Http\Controllers\PatientController')
                                            @foreach ($patientAppointment as $appountment)
                                                <tr>
                                                    <td> <a  href="javascript:void(0)"  data-toggle="modal" data-target="#appointmentInfoModal_{{$appountment->id}}">
                                                             {{($appountment->appointment_no && $appountment->appointment_no != "") ? $appountment->appointment_no : ''}}
                                                             </a></td>
                                                    <td>{{ ($appountment->appointment_date) ? date('m-d-Y', strtotime($appountment->appointment_date)) : ''}}</td>
                                                    <td>{{ ($appountment->appointment_time) ? $appountment->appointment_time : ''}}</td>
                                                    <td class="toolTipDiv"><a class="" href="{{url('/patients/view',$appountment->getPatient->id)}}">{{($appountment->getPatient) ? $appountment->getPatient->first_name : ''}} {{($appountment->getPatient) ? $appountment->getPatient->mi : ''}} {{($appountment->getPatient) ? $appountment->getPatient->last_name : ''}} </a> 
                                                        @if($appountment->is_interpreter == 'on')
                                                            <span class="tool" data-tip="For this appointment need interpreter" tabindex="1"> 
                                                                <i class="fa fa-info-circle fa-larger "></i>
                                                            </span> 
                                                        @endif
                                                     </td>
                                                    <td>{{($appountment->getPatient && $appountment->getPatient->contact_no) ? $appountment->getPatient->contact_no : ''}}</td>
                                                    <td>{{ ($appountment->getBillingProvider) ? $appountment->getBillingProvider->professional_provider_name : ''}}</td>
                                                    
                                                    <td>{{ $testPatientClass->getMeetingType($appountment->meeting_type)}}</td>
                                                    
                                                    <!--<td><a class="" href="{{url('/patients/view',$appountment->getPatient->id)}}">-->
                                                    <!--<td>{{ ($appountment->getRenderingProvider) ? $appountment->getRenderingProvider->referring_provider_first_name : ''}}</td>-->
                                                    <!--<td>{{ ($appountment->getLocation) ? $appountment->getLocation->nick_name : ''}}</td>-->
                                                    
                                                     <!--<td>-->
                                                     <!--    @if($appountment->getBillingProvider && $appountment->getBillingProvider->getProviderReasons)-->
                                                     <!--    <select name="appointmentReason" id="appointmentReason_{{$appountment->id}}" class="form-control" -->
                                                     <!--    onchange="changeReason({{$appountment->id}}, this.value);">-->
                                                     <!--       <option value="">Please Select</option>-->
                                                     <!--       @foreach ($appountment->getBillingProvider->getProviderReasons as $reason)-->
                                                     <!--           <option value="{{ $reason->id }}" {{($appountment && $appountment->appointment_reason == $reason->id) ? 'selected' : ''  }}>{{ $reason->name }}</option>-->
                                                     <!--       @endforeach-->
                                                     <!--   </select>-->
                                                     <!--   @endIf-->
                                                     <!--</td>-->
                                                     <!--<td>{{$testPatientClass->catculateTotalHours($appountment->duration)}}</td>-->
                                                    <td>
                                                        @if($statuss)
                                                         <select name="appointmentReason" id="appointmentReason_{{$appountment->id}}" class="form-control" 
                                                         onchange="changeStatus({{$appountment->id}}, this.value);">
                                                            <option value="">Please Select</option>
                                                            @foreach ($statuss as $status)
                                                            <option value="{{ $status->id }}" {{ ($appountment && $appountment->status == $status->id) ? 'selected' : ''  }}>{{ $status->status_name }}</option>
                                                            @endforeach
                                                        </select>
                                                        @endIf
                                                    </td>
                                                    
                                                    <td>
                                                        @if($billStatus)
                                                         <select name="appointmentReason" id="appointmentReason_{{$appountment->id}}" class="form-control" 
                                                         onchange="changeBillStatus({{$appountment->id}}, this.value);">
                                                            <option value=''>-Select-</option>
                                                            @foreach ($billStatus as $bs)
                                                                <option value="{{$bs['id'] }}" {{ ($appountment && $appountment->bill_status == $bs['id']) ? 'selected' : ''  }}>{{$bs['name'] }}</option>
                                                            @endforeach
                                                        </select>
                                                        @endIf
                                                    </td>
                                                    
                                                    <td> 
                                                    @can('Patient-delete')
                                                    <a href="javascript:void(0)" class="text-danger" onclick="deleteApointment({{$appountment->id}})">
                                                        <i  class="icon-trash showPointer"/></i>
                                                    </a>
                                                    @endcan 
                                                    </td> 
                                                </tr>
                                                 <div id="appointmentInfoModal_{{$appountment->id}}" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="addModalLabel">Appointment Information</h5>
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true">&times;</span>
                                                            </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                 <div class="card">
                                                                    <div class="card-body"> 
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <ul class="list-group list-group-flush">
                                                                            <li class="list-group-item"><b>Visit ID</b> : {{($appountment->appointment_no && $appountment->appointment_no != "") ? $appountment->appointment_no : ''}}</li>
                                                                            <li class="list-group-item"><b>Visit Date</b> :{{ ($appountment->appointment_date) ? date('m-d-Y', strtotime($appountment->appointment_date)) : ''}}</li>
                                                                            <li class="list-group-item"><b>Visit Type</b> :{{ $testPatientClass->getMeetingType($appountment->meeting_type)}}</li>
                                                                            </ul>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <ul class="list-group list-group-flush">
                                                                            <li class="list-group-item"><b>Patient Name</b> : {{($appountment->getPatient) ? $appountment->getPatient->first_name : ''}} {{($appountment->getPatient) ? $appountment->getPatient->mi : ''}} {{($appountment->getPatient) ? $appountment->getPatient->last_name : ''}}</li>
                                                                            <li class="list-group-item"><b>Visit Time</b> :{{ ($appountment->appointment_time) ? $appountment->appointment_time : ''}}</li>
                                                                            <li class="list-group-item"><b>Provider Name</b> :{{ ($appountment->getBillingProvider) ? $appountment->getBillingProvider->professional_provider_name : ''}}</li>
                                                                            </ul>
                                                                        </div> 
                                                                    </div>
                                                                    </div> 
                                                                </div>
                                                            </div> 
                                                        </div>
                                                    </div>
                                                </div> 
                                                @endforeach
                                            @else
                                            <tr>
                                                <td colspan="12">No Records Found.</td>
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
<script>
$(document).ready(function () {
    $('#duration_date').datepicker({
        dateFormat: 'mm/dd/yy',changeMonth: true, changeYear: true,
    });
});
function resetFrm(){
    window.location.href='/patient/list/schedular';
}
function changeBillStatus(appointMentId, reasonId){ 
    swal.fire({
        title: 'Are you sure you want to change this?',
        //text: "You won't be able to revert this!",
        showCancelButton: true,
        confirmButtonColor: '#3085D6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Change it!',
        customClass: {
            confirmButton: "btn btn-primary",
            cancelButton: "btn btn-danger",
            popup: 'swal-wide',
        }
    }).then((result) => { 
        // Use .then() to handle the user's response
        if (result.isConfirmed) { 
            // Only proceed if the user clicked the confirm button
            let _url     = `/changeAppointmentBillStatus`;
            $.ajax({
                url: _url,
                type: 'POST',
                data: {
                    _token: token,
                    reasonId:reasonId,
                    appointMentId:appointMentId
                },
                success: function(response) {
                    swal.fire({
                        title: 'Bill status changed suceessfully', 
                        customClass: {
                            successButton: "btn btn-primary",
                            popup: 'swal-wide',
                        }
                    });
                   location.reload();
                },
                error: function(response) {
                    swal.fire(response.responseJSON.message, '', 'error');
                }
            });
        }
    });
}
function changeStatus(appointMentId, statusId){
    swal.fire({
        title: 'Are you sure you want to change this?',
       // text: "You won't be able to revert this!",
        showCancelButton: true,
        confirmButtonColor: '#3085D6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Change it!',
        customClass: {
            confirmButton: "btn btn-primary",
            cancelButton: "btn btn-danger",
            popup: 'swal-wide',
        }
    }).then((result) => { 
        // Use .then() to handle the user's response
        if (result.isConfirmed) { 
            // Only proceed if the user clicked the confirm button
            let _url     = `/changeAppointmentStatus`;
            $.ajax({
                url: _url,
                type: 'POST',
                data: {
                    _token: token,
                    statusId:statusId,
                    appointMentId:appointMentId
                },
                success: function(response) {
                    swal.fire({
                        title: 'Visit status changed suceessfully', 
                        customClass: {
                            successButton: "btn btn-primary",
                            popup: 'swal-wide',
                        }
                    });
                    location.reload();
                },
                error: function(response) {
                    swal.fire(response.responseJSON.message, '', 'error');
                }
            });
        }
    });
}
function deleteApointment(id){
    swal.fire({
        title: 'Are you sure you want to delete?',
        text: "You won't be able to revert this!",
        showCancelButton: true,
        confirmButtonColor: '#3085D6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Delete it!',
        customClass: {
            confirmButton: "btn btn-primary",
            cancelButton: "btn btn-danger",
            //popup: 'swal-wide',
        }
    }).then((result) => { // Use .then() to handle the user's response
        if (result.isConfirmed) { // Only proceed if the user clicked the confirm button
            let _url     = `/delete/Appointment`;
            $.ajax({
                url: _url,
                type: 'POST',
                data: {
                    _token: token,
                    id: id
                },
                success: function(response) {
                    swal.fire({
                        title: 'Appointment has been deleted', 
                        customClass: {
                            successButton: "btn btn-primary",
                            popup: 'swal-wide',
                        }
                    });
                    location.reload();
                },
                error: function(response) {
                    swal.fire(response.responseJSON.message, '', 'error');
                }
            });
        }
    });
}
</script>