@extends('layouts.home-new-app')
@section('content')
<style>
.mt-1, .my-1{
    margin-top:0.5rem!important;
}
</style>
    <!-- END: Breadcrumbs-->
    <div class="row mt-0">
        <div class="col-12">
                <!-- START: Breadcrumbs-->
                <div class="row">
                    <div class="col-md-12  align-self-center">
                        <div class="sub-header py-3 px-3 align-self-center d-sm-flex w-100 rounded heading-background">
                            <div style="padding-top:10px" class="w-sm-100 mr-auto">
                                <h2 class="heading"><i class="fa-solid fa-calendar-days"></i> Schedular</h2>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END: Breadcrumbs-->
                <div class="row">
                <div class="col-md-12 mt-0">
            <div class="card setMinheight p-0">
              <div class="card-body2"> 
                <div class="card-content" style="z-index: 0;">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4 col-md-3">
                                    <div class="col-12 col-md-12">
                                            <div class="card-header  showButtonColor justify-content-between align-items-center">
                                                <h5 class="card-title text-warning"><i class="fa-solid fa-calendar-week"></i> Current Month Calendar</h5>
                                            </div>
                                            <div class="card-body text-center border-primary table-responsive" id="sowPatintInfoRit">
                                                 <div id="datepicker-center">
                                                    <div id='calendar-month'></div>
                                                </div>
                                            </div>
                                    </div>
                            
                                    <div class="col-12 col-md-12">
                                        @if($patientInfo)
                                        <div class="card">
                                            <div class="card-header  showButtonColor justify-content-between align-items-center">
                                                <h5 class="card-title text-warning"><i class="fa-solid fa-hospital-user"></i> Patient Summary</h5>
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
                               
                                    <div class="col-12 col-md-12 mt-0">
                                         <div>
                                            <div class="card-header showButtonColor justify-content-between align-items-center">
                                                <h5 class="card-title text-warning"><i class="fa-regular fa-address-book"></i> Patient List</h5>
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
                            <div class="col-9 col-md-9">
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
            </div>
            </div>
            </div>
        </div>
    </div>
    <div id="calendarModal" class="modal fade">
        <div class="modal-dialog modal-lg  modal-dialog-centered">
            <div class="modal-content"> 
                @include('patients.schedular.create',['patientInfo' =>$patient, 'urlFrom'=>'2']);
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
                    <div class="card-body"> 
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="list-group list-group-flush">
                                <li class="list-group-item"><b>Visit ID</b> : <span id="appointmentNo"></span></li>
                                <li class="list-group-item"><b>Visit Date</b> : <span id="appointmentDate"></span> </li>
                                <li class="list-group-item"><b>Visit Type</b> : <span id="meetingType"></span></li>
                                <li class="list-group-item"><b>Rendering Provider</b> :<span id="renderingProvider"></span></li>
                                <li class="list-group-item"><b>Resource</b> : <span id="resource"></span> </li>
                                <li class="list-group-item"><b>Authorization</b> : <span id="authorised"></span> </li>
                                <li class="list-group-item"><b>Status</b> : <span id="statusDivId"></span> </li>
                                <li class="list-group-item"><b>Recurrene</b> : <span id="recurreneId"></span> </li>
                                </ul>
                            </div>
                            <div class="col-md-6">
                                <ul class="list-group list-group-flush">
                                <li class="list-group-item"><b>Patient Name</b> : <span id="patientNameId"></span></li>
                                <li class="list-group-item"><b>Visit Time</b> : <span id="appointmentTime"></span></li>
                                <li class="list-group-item"><b>Provider Name</b> : <span id="billingProvider"></span></li>
                                <li class="list-group-item"><b>Practice Location</b> : <span id="locationID"></span></li>
                                <li class="list-group-item"><b>Case No</b> :  <span id="claimNo"></span></li>
                                <li class="list-group-item"><b>Reason</b> : <span id="resaonsId"></span></li>
                                <li class="list-group-item"><b>Duration</b> : <span id="durationId"></span></li>
                                <li class="list-group-item"><b>Interpreter</b> : <span id="isInterpreterId"></span></li>
                                </ul>
                            </div> 
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><b>Addition Information</b> : <span id="additionInformationId"></span></li>
                                </ul>
                            </div> 
                        </div>
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
            <?php if($patientInfo) {
            $fullName = '';
            $fullName = $patientInfo->first_name;
            if($fullName != ''){
                $fullName .= ' ';
            }
            if($patientInfo->last_name != ''){
                $fullName .= $patientInfo->last_name;
            }
            ?>
            getBillingProviderByPatientId(<?php echo $patientInfo->id; ?>,'<?php echo $fullName; ?>')
            <?php }?>
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
                    onSelect: function(selectedDate, event) { 
                        checkHolidayForAppointment(selectedDate);
                    }
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
    function checkHolidayForAppointment(dateVal){     
        console.log('#dateVal', dateVal); 
        //let providerId = $("#appointment_provider").val();  
        //console.log('#providerId', providerId); 
        $.ajax({
            url: '/check/holiday/appointment',
            type: 'POST',
            data: {
                _token: token,
                rDate: dateVal,
                //providerid: providerId,
            },
            success: function(result) {
             console.log('#checkHolidayForAppointment', result['status']); 
                if(result['status'] == 2){
                 let msg = 'Are you sure you want to create appointment on this '+ result['holiday'] +  ' we have ' + result['hType'] + ' holiday';

                    swal.fire({
                        title: msg,
                        //text: "You won't be able to revert this!",
                        showCancelButton: true,
                        confirmButtonColor: '#3085D6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes!',
                        cancelButtonText: 'No',
                        customClass: {
                            confirmButton: "btn-sm btn-primary",
                            cancelButton: "btn-sm btn-danger",
                            popup: 'swal-wide',
                        }
                    }).then((result) => {
                    // Use .then() to handle the user's response
                        if (!result.isConfirmed) { // Only proceed if the user clicked the confirm button
                            $('#appointment_date').val(" ");  
                        } 
                    });
                }
            },
        })
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
                        let eventId = info.event.id;
                        console.log("eventId#",eventId)
                        $.ajax({
                            url: "/appointment/info",
                            headers: {
                                'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                            },
                            method:"POST",
                            //dataType: "json",
                            data: {
                            eventId:eventId, 
                            },
                            success: function(eventInfoData){
                                $("#appointmentNo").text(eventInfoData.appointmentNo);
                                $("#appointmentDate").text(eventInfoData.appointmentDate);
                                $("#meetingType").text(eventInfoData.meetingType);
                                $("#renderingProvider").text(eventInfoData.renderingProvider);
                                $("#resource").text(eventInfoData.resource);
                                $("#authorised").text(eventInfoData.authorised);
                                $("#statusDivId").text(eventInfoData.statusDivId);
                                $("#recurreneId").text(eventInfoData.recurreneId);
                                $("#patientNameId").text(eventInfoData.patientNameId);
                                $("#appointmentTime").text(eventInfoData.appointmentTime);
                                $("#billingProvider").text(eventInfoData.billingProvider);
                                $("#locationID").text(eventInfoData.locationID);
                                $("#claimNo").text(eventInfoData.claimNo);
                                $("#resaonsId").text(eventInfoData.resaonsId);
                                $("#durationId").text(eventInfoData.durationId);
                                $("#isInterpreterId").text(eventInfoData.isInterpreterId);
                                $("#additionInformationId").text(eventInfoData.additionInformationId); 

                                $("#fullCalModal").addClass('modal fade show');
                                $("#fullCalModal").css("display", "block"); 
                            }
                        })
                            
                    },
                });
                calendar.render();
            }
        }
</script>  

    