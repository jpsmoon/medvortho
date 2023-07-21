@extends('layouts.home-app')
@section('content')
<style>
        footer {
            position: fixed;
            bottom: 0;
            width: 100%;
        }

        .card-content {
            min-height: 490px;
        }

        .autoCompete-css {
            list-style: none;
            padding: 0px;
            width: 83%;
            position: absolute;
            margin: 0;
            top: 86%;
            border: solid 1px #a9bed6;
            z-index: 999999 !important;
            display: none;
        }

        .autoCompete-css li {
            background: #fff;
            padding: 9px;
        }

        .autoCompete-css li:nth-child(even) {
            background: #007bff;
            color: white;
        }

        .autoCompete-css li:hover,
        li b:hover {
            cursor: pointer;
        }

        #searchDrop-Down .dropdown-menu {
            font-size: 13px;
            min-width: 525px !important;
            border-top: none !important;
            border-top-left-radius: 0;
            border-top-right-radius: 0;
            margin-top: -1.5px;
            box-shadow: none;
        }

        .topSearch .select2-selection__arrow {
            display: none !important;
        }

        .swal-wide {
            width: 300px !important;
            height: 200px !important;
        }

        .swal2-container {
            top: -11% !important;
        }

        .swal2-button {
            border: 1px dashed #333;
        }

        /*  style cancel buttons */
        .swal2-button--cancel {
            color: #333;
        }

        .swal2-button--confirm {
            color: green
        }

        .swal2-button--danger {
            color: red;
        }
        .list-group-item 
        {
        position: relative;
        display: block;
        padding: 0.25rem;
        margin-bottom: -1px;
        background-color: #FFF;
        border: 1px solid #E4E7ED;
        }
        
        label
        {
         margin-bottom: 0.2rem;
        }
        .form-horizontal .form-group 
        {
        margin-left: 0;
        margin-right: 0;
        margin-bottom: 7px;
        }
        .modal-footer
        {
        display: -webkit-box;
        display: -webkit-flex;
        display: -moz-box;
        display: -ms-flexbox;
        -webkit-align-items: center;
        -moz-box-align: center;
        -ms-flex-align: center;
        -moz-box-pack: end;
        -ms-flex-pack: end;
        justify-content: center;
        border-top: 1px solid #ECEEEF;
        }
        
    </style>
    <!-- END: Breadcrumbs-->
    <div class="row">
        <div class="col-1 mt-4"></div>
        <div class="col-10 mt-4">
            <div class="card row-background">
                <!-- START: Breadcrumbs-->
                <div class="row ">
                    <div class="col-12  align-self-center">
                        <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded heading-background">
                            <div style="padding-top:10px" class="w-sm-100 mr-auto">
                                <h2 class="heading"> <svg xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" viewBox="0 0 34 34" class="left"><title>icon_patient</title><path d="M20.983 16.793L19.32 23.2h-1.857c-.825.017-1.48.654-1.463 1.425l.005.21c.017.758.682 1.365 1.495 1.365h5.147c.977 0 1.829-.617 2.07-1.5l.269-.977a.392.392 0 0 0 .014-.104c0-.231-.2-.418-.448-.418h-.753l-1.085-6.853c.258.077.501.185.73.324.517.314.933.72 1.248 1.216.314.497.573 1.094.777 1.791.203.698.343 1.39.418 2.079.075.688.113 1.42.113 2.194 0 .993-.277 1.846-.83 2.557-.553.71-1.22 1.066-1.999 1.066H11.83c-.78 0-1.446-.355-1.999-1.066-.553-.711-.83-1.564-.83-2.557 0-.775.038-1.506.113-2.194.075-.689.215-1.381.418-2.079.204-.697.463-1.294.777-1.79.315-.497.73-.903 1.249-1.217.518-.315 1.113-.472 1.786-.472 1.16 1.167 2.546 1.75 4.157 1.75 1.31 0 2.472-.386 3.483-1.157zm-.58 6.623l1.423-5.602.791 5.602h-2.213zM22.5 12c0 1.38-.488 2.559-1.465 3.535C20.06 16.512 18.88 17 17.5 17c-1.38 0-2.559-.488-3.535-1.465C12.988 14.56 12.5 13.38 12.5 12c0-1.38.488-2.559 1.465-3.535C14.94 7.488 16.12 7 17.5 7c1.38 0 2.559.488 3.535 1.465C22.012 9.44 22.5 10.62 22.5 12z" fill="#3A3A3A" fill-rule="evenodd"></path></svg>Schedular</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END: Breadcrumbs-->
                <div class="card-content" style="z-index: 0;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4 col-md-4">
                                <div class="row">
                                    <div class="col-12 col-md-12">
                                        <div>
                                            <div class="card-header  showButtonColor justify-content-between align-items-center">
                                                <h5 class="card-title text-warning">Current Month Calendar</h5>
                                            </div>
                                            <div class="card-body text-center border-primary table-responsive" id="sowPatintInfoRit">
                                                 <div id="datepicker-center">
                                                    <div id='calendar-month'></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-12">
                                        @if($patientInfo)
                                        <div class="card">
                                            <div class="card-header  showButtonColor justify-content-between align-items-center">
                                                <h5 class="card-title text-warning">Patient Summary</h5>
                                            </div>
                                            <div class="card-body border-primary table-responsive" id="sowPatintInfoRit">
                                                <ul class="list-inline">
                                                    <li class="list-inline-item liItem" style="width: 46%;"><b>Patient Name</b></li>
                                                    <li class="list-inline-item liItem">{{$patientInfo->first_name}} {{$patientInfo->last_name}}</li>
                                                </ul>
                                                <ul class="list-inline">
                                                    <li class="list-inline-item liItem" style="width: 46%;"><b>Patient ID</b></li>
                                                    <li class="list-inline-item liItem">{{$patientInfo->patient_no}}</li>
                                                </ul>
                                                <ul class="list-inline">
                                                    <li class="list-inline-item liItem" style="width: 46%;"><b>Medical Record Number</b></li>
                                                    <li class="list-inline-item liItem">{{($patientInfo->getPatientInjuries) ? ($patientInfo->getPatientInjuries->getInjuryClaim) ? $patientInfo->getPatientInjuries->getInjuryClaim->claim_no : 'NA' : 'NA'}}</li>
                                                </ul>
                                                <ul class="list-inline">
                                                    <li class="list-inline-item liItem" style="width: 46%;"><b>Patient Classes</b></li>
                                                    <li class="list-inline-item liItem">{{($patientInfo->getPatientInjuries) ? (($patientInfo->getPatientInjuries->financial_class == 1) ? 'Worker Comp.' : (($patientInfo->getPatientInjuries->financial_class == 2) ? 'Private / Government' : 'Personal Injury')) : 'N/A'}}</li>
                                                </ul>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-12 col-md-12">
                                         <div>
                                            <div class="card-header showButtonColor justify-content-between align-items-center">
                                                <h5 class="card-title text-warning">Patient List</h5>
                                            </div>
                                            <div class="border-primary table-responsive showOverFlow">
                                                <ul class="list-group">
                                                @if(count($patients))
                                                    @foreach ($patients as $patient)
                                                    <li class="list-group-item <?php if ($patientId == $patient->id) {echo 'active text-light  font-weight-bold';}?>">
                                                        <a class="<?php if ($patientId == $patient->id) {echo 'active text-light  font-weight-bold';}?>" href="{{route('addPatientSchedular', $patient->id)}}">{{ $patient->first_name.' '.$patient->last_name }}</a></li>
                                                    @endforeach
                                                @endif
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <div class="col-8 col-md-8">
                                <div class="row"> 
                                    <div class="col-12">
                                        <div id='calendar-div' class="h-100"> </div>
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
    <div id="calendarModal" class="modal fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form id="schedularFrm" action="{{ route('savePatientSchedular') }}" enctype="multipart/form-data" class="form-horizontal ladda-form'" method="POST">
                    <div class="modal-header">
                        <h4 align="center" id="modalTitle" class="modal-title">Add Appointment</h4>
                        <button type="button" onclick="hideModel();" class="close" data-dismiss="modal">&times;</button>                        
                    </div>
                    <div id="modalBody" class="modal-body" style="overflow-y: scroll !important; height:580px; ">
                        @csrf
                         <div class="row">
                            <div class="form-group col-md-6">
                                <label for="patientSearchId"> Patient<span class="required">* </span></label>
                                <input autocomplete="off"   type="hidden" name="patientId" id="showPatientId" class="form-control" >
                                <input autocomplete="off" placeholder="Enter patient name, patient id" type="text" name="patientSearchId" id="patientSearchId" class="form-control" data-validation-event="change" data-validation="required" data-validation-error-msg="">
                                <ul id="searchPatientDiv" class="autoCompete-css"></ul>
                                @if($errors->has('patientId'))
                                <span class="invalid-feedback" style="display:block" role="alert">
                                    <strong>{{ $errors->first('patientId') }}</strong>
                                </span>
                                @endif
                           </div>
                        </div> 
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="appointment_date"> Appointment Date</label>
                                    <input autocomplete="off"  placeholder="Select appointment date" type="text" name="appointment_date" id="appointment_date" class="form-control" data-validation-event="change" data-validation="required" data-validation-error-msg="">
                                    @if($errors->has('appointment_date'))
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong>{{ $errors->first('appointment_date') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="appointment_time"> Appointment Time</label>
                                    <input autocomplete="off" type="text" name="appointment_time" class="form-control timepicker" data-validation-event="change" data-validation="required" data-validation-error-msg="">
                                    @if($errors->has('appointment_time'))
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong>{{ $errors->first('appointment_time') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="appointment_provider">Billing Provider<span class="required">* </span></label>
                                    <select onchange="getProviderServiceLocation(this.value);" id="appointment_provider" name="appointment_provider" class="form-control 4col formcls" data-validation-event="change" data-validation="required" data-validation-error-msg="">
                                        
                                    </select>
                                    @if($errors->has('appointment_provider'))
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong>{{ $errors->first('appointment_provider') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="appointment_location"> Rendering Provider</label>
                                    <select id="apt_rendering_id" name="apt_rendering_id" class="form-control">
                                        <option value=''>-Select-</option>
                                    </select>

                                    @if($errors->has('appointment_location'))
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong>{{ $errors->first('appointment_location') }}</strong>
                                    </span>
                                    @endif
                                </div>                   
                            </div>
                            <div class="row"> 
                                <div class="form-group col-md-6">
                                    <label for="appointment_location"> Practice Location</label>
                                    <select id="apt_loc_id" name="appointment_location" class="form-control 4col formcls">
                                        <option value=''>-Select-</option>
                                    </select> 
                                    @if($errors->has('appointment_location'))
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong>{{ $errors->first('appointment_location') }}</strong>
                                    </span>
                                    @endif
                                </div> 
                                <div class="form-group col-md-6">
                                    <label for="appointment_resource"> Resource</label>
                                    <input autocomplete="off" type="text" name="appointment_resource" class="form-control">
                                    @if($errors->has('appointment_resource'))
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong>{{ $errors->first('appointment_resource') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="appointment_case">Case No</label>
                                    <select id="appointment_case_id" name="appointment_case" class="form-control 4col formcls">
                                        <option value=''>-Select-</option>  
                                </select>
                                    @if($errors->has('appointment_case'))
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong>{{ $errors->first('appointment_case') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="appointment_resource">Authorization</label>
                                    <input autocomplete="off" type="text" name="appointment_authorization" id="appointment_authorization" class="form-control">
                                    @if($errors->has('appointment_authorization'))
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong>{{ $errors->first('appointment_authorization') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="appointment_resason"> Reason</label>
                                    <select id="appointment_resason_id" name="appointment_resason" class="form-control 4col formcls" data-validation-event="change" data-validation="required" data-validation-error-msg="">
                                        <option value=''>-Select-</option> 
                                </select>
                                    @if($errors->has('appointment_reason'))
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong>{{ $errors->first('appointment_reason') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="appointment_meeting_Type"> Meeting Type</label>
                                    <select name="appointment_meeting_Type" class="form-control" data-validation-event="change" data-validation="required" data-validation-error-msg="">
                                        <option value=''>-Select-</option>
                                        @foreach ($meetingTypes as $meetingType)
                                            <option value="{{$meetingType['id'] }}">{{$meetingType['name'] }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('appointment_meeting_Type'))
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong>{{ $errors->first('appointment_meeting_Type') }}</strong>
                                    </span>
                                    @endif
                                </div> 
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="mi"> Duration</label>
                                    <select name="appointment_duration" class="form-control 4col formcls" data-validation-event="change" data-validation="required" data-validation-error-msg="">
                                        <option value=''>-Select-</option>
                                        <?PHP for ($j = 5; $j <= 200; $j += 5) {?>
                                        <option value="<?PHP echo $j; ?>">{{$j}}</option>
                                        <?php }?>
                                    </select>
                                    @if($errors->has('appointment_meeting_Type'))
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong>{{ $errors->first('appointment_meeting_Type') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="mi"> Status</label>
                                    <select name="appointment_status" class="form-control 4col formcls" data-validation-event="change" data-validation="required" data-validation-error-msg="">
                                        <option value=''>-Select-</option>
                                        @foreach ($status as $st)
                                            <option value="{{$st->id }}">{{$st->status_name }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('appointment_status'))
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong>{{ $errors->first('appointment_status') }}</strong>
                                    </span>
                                    @endif
                                </div> 
                            </div>
                            <div class="row">
                                <div class="form-group col-md-3">
                                    <label for="appointment_recurrene"></label>
                                    <input type="checkbox" class="largerCheckbox" name="appointment_recurrene"> <span style="vertical-align:top"> Recurrene</span>
                                    @if($errors->has('appointment_recurrene'))
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong>{{ $errors->first('appointment_recurrene') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="appointment_interpreter"></label>
                                    <input type="checkbox" class="largerCheckbox" name="is_interpreter"> <span style="vertical-align:top"> Interpreter</span>
                                    @if($errors->has('is_interpreter'))
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong>{{ $errors->first('is_interpreter') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="appointment_additionInfo">Addition Information</label>
                                     <textarea class="form-control" id="appointment_additionInfo" name="appointment_additionInfo" rows="4" cols="50"> </textarea> 
                                    @if($errors->has('appointment_additionInfo'))
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong>{{ $errors->first('appointment_additionInfo') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button  type="submit"  id="sendForm" class="btn btn-primary ladda-button"><span class="ladda-label">Schedule</span></button>
                        <button type="button" class="btn btn-default"  onclick="hideModel();">Cancle</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div id="fullCalModal" class="modal fade">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Appointment Information</h5>
                    <button type="button" class="close"  onClick="hideInfoModel();">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="table-responsive">
                        <table id="example" class="table layout-secondary dataTable table-striped table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Title</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Start Date</th>
                                    <th scope="col">Start Time</th>
                                    <th scope="col">End Date</th>
                                    <th scope="col">End Time</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead> 
                            <tbody>
                                <tr>
                                    <td><span id="modalID"></span></td>
                                    <td><span id="modalTitleLabel"></span></td>
                                    <td><span id="modalDescriptionDiv"></span></td>
                                    <td><span id="modalStartDate"></span></td>
                                    <td><span id="modalStartTime"></span></td>
                                    <td><span id="modalEndDate"></span></td>
                                    <td><span id="modalEndTime"></span></td>
                                    <td><span id="statusDiv"></span></td>
                                </tr>
                            </tbody>
                        </table> 
                     </div>   
                </div> 
            </div>
        </div>
    </div> 
@endsection
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<!-- START: Page Vendor JS-->
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
        <script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js" defer=""></script> 
        <style type="text/css">
            .ui-timepicker-container   { z-index:100000 !important;  }
        </style>

        <script>
    $(document).ready(function() { 
        $("#patientSearchId").keypress(function() {
        addPatientSearch();
    })
        let tDate = new Date();
        let dFDate = formatDate(tDate);
        let pId = '<?php echo $patientId;?>';
         
        fullCalendar(dFDate);
        console.log('see current Date',tDate)
        showDatePicker(tDate);
        $('#appointment_date').datepicker({
            dateFormat: 'mm/dd/yy',
             changeMonth: true, changeYear: true,
        })

        $('.timepicker').timepicker({
                timeFormat: 'HH:mm:ss',
                interval: 15,
                // minTime: '10',
                // maxTime: '6:00pm',
                defaultTime: '12',
                startTime: '12:00',
                dynamic: false,
                dropdown: true,
                scrollbar: true
        });
});         
function getMonthNumbner(month) {
    d = new Date().toString().split(" ")
    d[1] = month
    d = new Date(d.join(' ')).getMonth()+1
    if(!isNaN(d)) {
    return d
    }
    return -1;
} 
function formatDate(date) {
    var d = new Date(date),
    day = '' + d.getDate(),
    month = '' + (d.getMonth() + 1),
    year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    return [year,month,day].join('-');
}
function showAddSheduleModelShow(){
    console.log('checkModel Function');
    $("#calendarModal").addClass('modal fade show');
    $("#calendarModal").css("display", "block"); 
    var elem = document.createElement('div');
    elem.setAttribute('id', 'modalBdrop');
    elem.setAttribute('class', 'modal-backdrop fade show allModelDrop');
    var body_elems = document.getElementsByTagName('body');
    body_elems[body_elems.length - 1].appendChild(elem);
}
function hideModel(){
    $("#calendarModal").addClass('modal fade hide');
    $("#calendarModal").css("display", "none"); 
    $(".allModelDrop").removeClass('modal-backdrop fade hide');
    $(".allModelDrop").css("display", "none"); 
}
function fullCalendar(dFDate){
    $('#calendar-div').html('');
    var calendarEl = document.getElementById('calendar-div');
    if (calendarEl) {
    var calendar = new FullCalendar.Calendar(calendarEl, {
            plugins: ['interaction', 'dayGrid', 'timeGrid', 'list'],
            //defaultView: 'timeGridWeek',
            defaultView: 'timeGrid',
            slotDuration: '00:15:00',
            slotLabelInterval: 15,
            defaultDate: dFDate,
            initialDate:dFDate,
            //editable: true,
            eventLimit: true, // for all non-TimeGrid views
            views: {
                timeGrid: {
                eventLimit: 6 // adjust to 6 only for timeGridWeek/timeGridDay
                }
            },
            header: { 
                right: 'prevYear,prev,next,nextYear today', 
                center: 'title',
                left: 'addEventButton'
            },
            customButtons: {
                addEventButton: {
                    text: 'Add Appointment',
                    class: 'card-title text-warning',
                    click: function(event) {
                        $('#modalTitle').html(event.title);
                        showAddSheduleModelShow();
                        //$('#calendarModal').modal();
                        
                    }
                }
            },
            eventRender: function (info) {
                $(info.el).tooltip({
                    title: info.event.extendedProps.description,
                    placement: 'top',
                    trigger: 'hover',
                    container: 'body'
                });
            },
            //events: <?php //echo $pateintJsonData; ?>,
            events:  function(info, callback,failureCallback) {
                console.log('event date1# info',info);
            sEtNewDatePicker(info['start']);
                $.ajax({
                    url: "/ajaxViewEvents",
                    headers: {
                        'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                    },
                    method:"POST",
                    dataType: "json",
                    data: {
                    cDate:dFDate,
                    //patientId:"<?php echo $patientId;?>",
                    deviceType: 'web'
                    },
                    success: function(responseData){
                    console.log("responseDataEvent",responseData)
                    //successCallback(app.calendarParse(responseData));
                    callback(responseData);
                    }
                })
            },
            eventClick:  function(info) {
                console.log('#eventClick',info);
                var dateSettings = { "year": "numeric", "month": "2-digit", "day": "2-digit" };
                  var timeSettings = { "hour": "2-digit", "minute": "2-digit", "hour12": false };
                
                  var startdate = calendar.formatDate(info.event.start,  dateSettings);
                  var starttime = calendar.formatDate(info.event.start,  timeSettings);
                
                  var enddate; 
                  var endtime; 
                  if (info.event.end != null) {
                    enddate = calendar.formatDate(info.event.end, timeSettings );
                    endtime = calendar.formatDate(info.event.end, dateSettings );
                  } 
                  else {
                    enddate = startdate;
                    endtime = starttime;
                  }
                    $('#modalID').html(info.event.id);
                    $('#modalTitleLabel').html(info.event.title);
                    $('#modalDescriptionDiv').html(info.event.extendedProps.location);
                    $('#modalStartDate').html(startdate);
                    $('#modalStartTime').html(starttime);
                    $('#modalEndDate').html(enddate);
                    $('#modalEndTime').html(endtime);
                    //$('#fullCalModal').show(); //changed just for demo purposes
                    $("#fullCalModal").addClass('modal fade show');
                    $("#fullCalModal").css("display", "block"); 
    
            },
        });

        calendar.render();
    }
}
function showDatePicker(tDate){
    console.log('#showDatePicker',tDate);
    $('#calendar-month').datepicker({
        dateFormat:'yy-mm-dd',  changeMonth: true, changeYear: true,
        defaultDate: tDate,
        onSelect: function (date, datepicker) {
            if (date != "") {
                //alert("Selected Date: " + formatDate(date));
                fullCalendar(formatDate(date));
            }
        },
        onChangeMonthYear: function (year, month, inst) {
            let mm = (month > 9) ? month : '0'+month;
            let changedMonth = year +"-"+ mm +"-"+ "01";
            fullCalendar(formatDate(changedMonth));
        }
    })
}
function sEtNewDatePicker(tDate)
{
    $('#calendar-month').datepicker("setDate", tDate );
}
function getBillingProviderByPatientId(patientId,patName){
     $("#patientSearchId").val(patName);
    $("#showPatientId").val(patientId); 
    $.ajax({
        url: "/ajaxBillingProvider",
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        method:"POST",
        dataType: "json",
        data: {
        patientId:patientId
        },
        success: function(responseData){
            var items = "";
            items += "<option value=''>-Select-</option>";
            $.each(responseData, function(i, item) {
                if(responseData.length == 1){
                    getProviderServiceLocation(item.id);
                    items += "<option value='" + item.id + "' selected='selected'>" + item.professional_provider_name + "</option>";
                }
                else{
                    items += "<option value='" + item.id + "' >" + item.professional_provider_name + "</option>";
                }
                
            });
            $("#appointment_provider").html(items);
        }
    })

    $.ajax({
        url: "/ajaxPatientInjury",
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        method:"POST",
        dataType: "json",
        data: {
        patientId:patientId
        },
        success: function(responseData){
            var items = "";
            items += "<option value=''>-Select-</option>";
            $.each(responseData, function(i, item) {
                items += "<option value='" + item.id + "'>" + item.	description + "</option>";
            });
            $("#appointment_case_id").html(items);
        }
    })
    $('.autoCompete-css').hide();
}
function getProviderServiceLocation(providerid){
    $.ajax({
        url: "/ajaxBillingProviderLocations",
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        method:"POST",
        dataType: "json",
        data: {
        providerid:providerid
        },
        success: function(result){
        console.log('#result',result);
        var items = "";
            items += "<option value=''>-Select-</option>";
            $.each(result, function(i, item) {
                items += "<option value='" + item.id + "'>" + item.	nick_name + "</option>";
            });
            $("#apt_loc_id").html(items);
        }
    })
    $.ajax({
        url: "/ajaxBillingProviderRendering",
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        method:"POST",
        dataType: "json",
        data: {
        providerid:providerid
        },
        success: function(result){
        console.log('#result',result);
        var items = "";
            items += "<option value=''>-Select-</option>";
            $.each(result, function(i, item) {
            let fullName = '';
            if (typeof item.referring_provider_first_name !== 'undefined' && item.referring_provider_first_name !== null) {
              fullName += item.referring_provider_first_name;
            }
            
            if (typeof item.referring_provider_middle_name !== 'undefined' && item.referring_provider_middle_name !== null) {
              if (fullName !== '') {
                fullName += ' ';
              }
              fullName += item.referring_provider_middle_name;
            }
            
            if (typeof item.referring_provider_last_name !== 'undefined' && item.referring_provider_last_name !== null) {
              if (fullName !== '') {
                fullName += ' ';
              }
              fullName += item.referring_provider_last_name;
            }   
                items += "<option value='" + item.id + "'>" + fullName + "</option>";
            });
            $("#apt_rendering_id").html(items);
        }
    })
    
    $.ajax({
        url: "/ajaxBillingProviderReasons",
        headers: {
            'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
        },
        method:"POST",
        dataType: "json",
        data: {
        providerid:providerid
        },
        success: function(result){
        console.log('#result',result);
        var items = "";
            items += "<option value=''>-Select-</option>";
            $.each(result, function(i, item) {
                items += "<option value='" + item.id + "'>" + item.	name + "</option>";
            });
            $("#appointment_resason_id").html(items);
        }
    })
}
function addPatientSearch(){  
     let searchString = $('#patientSearchId').val();
        if (searchString.length >= 2) {
             $.ajax({
                url: '/get/search/patients',
                type: 'POST',
                data: {
                    _token: token,
                    searchString: searchString
                },
                success: function(data) {
                    //console.log('data#', data);
                    if (data.length > 0) {
                        $('.autoCompete-css').show();
                        var items = "";
                        items += "<li value=''>-Select-</li>";
                        $.each(data, function(i, item) {
                            //let pateintName = (item.first_name) + " " + (item.last_name);
                            let pateintName = item.full_name;

                            items +=
                                `<li onclick="getBillingProviderByPatientId(${item.id},'${pateintName}');" data-id-clicked="${item.id}"  id="${pateintName}">` +
                                pateintName + `</li>`;
                        });
                        $("#searchPatientDiv").html(items);
                    }
                    else{
                        //$('.autoCompete-css').hide();
                        $('.autoCompete-css').show();
                         $("#searchPatientDiv").html(`<li><a href='/patients/create/'>Add New Patient</a></li>`);
                    }
                },
            })
        } 
}  
    $(document).click(function(){ 
        if($('#searchPatientDiv:visible').length > 0)
        {
             $('.autoCompete-css').hide();
        } 
    });
    function hideInfoModel(){
        $("#fullCalModal").addClass('modal fade hide');
        $("#fullCalModal").css("display", "none"); 
        $(".allModelDrop").removeClass('modal-backdrop fade hide');
        $(".allModelDrop").css("display", "none"); 
    }
</script>  

    