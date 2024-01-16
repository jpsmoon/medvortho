@extends('layouts.home-new-app')
@section('content')
    <style>
        nav>.nav.nav-tabs {
            border: none;
            color: #fff;
            background: #ccc;
            border-radius: 0;
            width:100%;
            font-size: 14px;
        }

        nav>div a.nav-item.nav-link {
            border: none;
            padding: 18px 25px;
            color: #fff;
            background: #ccc;
            border-radius: 0;
            border-right: 1px solid #fff;
            font-size: 14px;
        }

        nav>div a.nav-item.nav-link.active {
            border: none;
            padding: 18px 25px;
            color: #fff;
            background: #2A3F54;
            border-radius: 0;
            border-right: 1px solid #ccc;
            font-size: 14px;
            font-weight: 800;
            text-align:center;
        }

        nav>div a.nav-item.nav-link.active:after {
            content: "";
            position: relative;
            bottom: -47px;
            left: -7%;
            border: 15px solid transparent;
            border-top-color: #2A3F54;
        }

        .tab-content {
            background: #fdfdfd;
            line-height: 25px;
            border: 1px solid #2A3F54;
            border-top: 1 solid #b6efe7;
            /*border-bottom:3px solid #fff;*/
            padding: 11px 0px;
            min-height: 270px;
        }

        nav>div a.nav-item.nav-link:hover,
        nav>div a.nav-item.nav-link:focus {
            border: none;
            background: #2A3F54;
            color: #fff !important;
            border-radius: 0;
            transition: background 0.20s linear;
        }

        .sowAccordianSelect {
            text-align: left;
            padding-left: 10px;
            padding-top: 10px;
            background: #f3f3f3;
            color: #2A3F54;
        }

        .sowAccordianSelectBorder {
            border: 1px solid #2A3F54;
        }

        .diagCode .card-header {
            background-color: #FFFFFF !important;
        }
       .appointmentDiv table {
            width:100% !important;
            border-collapse: collapse;
            border: 1px solid rgba(33,40,50,.125);
        } 

       .appointmentDiv  th,td {
        border: 1px solid rgba(33,40,50,.125);
        }

       .appointmentDiv  table.a {
        table-layout: auto;  
        }
        .tabContentDiv {}
        
        .mb-4, .my-4 {
         margin-bottom: 0rem!important; 
        }
        
        .card {
            margin-bottom: 1rem;
            border: none;
            -webkit-box-shadow: 0 2px 1px rgba(0,0,0,.05);
            box-shadow: 0 2px 1px rgba(0,0,0,.05);
        }
         
        .input-icons-appointment { 
            width: 100%; 
            margin-bottom: 10px; 
        } 
         .input-icons-appointment i {
            position: absolute;
            right: 14px!important;
            top: 26px !important;
            transform: translateY(0);
        }

        .icon { 
            padding: 15px;
        } 

    </style>

    <!-- START: Card Data-->
    <div class="row">
        <div class="col-12 col-sm-6 col-xl-3 mt-3 pl-1 pr-1">
            <div class="card">
                <div class="card-body">
                    <div class='dashboard-boxes pb-0'>
                        <h4>Ready to Send</h4>
                        <div class="d-flex align-self-flex-end justify-content-space-between">
                        <div class='card-liner-content dashbox'>
                            <h6 class="card-liner-subtitle">Count</h6>
                            <h2 class="card-liner-title">0</h2>
                        </div>
                        <div class='card-liner-content dashbox'>
                            <h6 class="card-liner-subtitle">Amount</h6>
                            <h2 class="card-liner-title"><span class="card-liner-icon mt-1">$</span> 0</h2>
                        </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3 mt-3 pl-0 pr-1">
            <div class="card">
                <div class="card-body">
                     <div class='dashboard-boxes pb-0'>
                        <h4>Not posted</h4>
                        <div class="d-flex align-self-flex-end justify-content-space-between">
                        <div class='card-liner-content dashbox'>
                            <h6 class="card-liner-subtitle">Remittence</h6>
                            <h2 class="card-liner-title"><span class="card-liner-icon mt-1">$</span> 0</h2>
                        </div>
                        <div class='card-liner-content dashbox'>
                            <h6 class="card-liner-subtitle">Receipt</h6>
                            <h2 class="card-liner-title"><span class="card-liner-icon mt-1">$</span> 0</h2>
                        </div>
                        <div class='card-liner-content dashbox'>
                            <h6 class="card-liner-subtitle">Total</h6>
                            <h2 class="card-liner-title"><span class="card-liner-icon mt-1">$</span> 0</h2>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3 mt-3 pl-0 pr-1">
            <div class="card">
                <div class="card-body">
                     <div class='dashboard-boxes pb-0'>
                        <h4>Collection Today</h4>
                        <div class="d-flex align-self-flex-end justify-content-space-between">
                        <div class='card-liner-content dashbox'>
                            <h6 class="card-liner-subtitle">Copay</h6>
                            <h2 class="card-liner-title">0</h2>
                        </div>
                        <div class='card-liner-content dashbox'>
                            <h6 class="card-liner-subtitle">Remittence</h6>
                            <h2 class="card-liner-title"><span class="card-liner-icon mt-1">$</span> 0</h2>
                        </div>
                        <div class='card-liner-content dashbox'>
                            <h6 class="card-liner-subtitle">Receipt</h6>
                            <h2 class="card-liner-title"><span class="card-liner-icon mt-1">$</span> 0</h2>
                        </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3 mt-3 pl-0 pr-1">
            <div class="card">
                <div class="card-body">
                    <div class='dashboard-boxes pb-0 '>
                        <h4>Outstanding Claims</h4>
                        <div class="d-flex align-self-flex-end justify-content-space-between">
                        <div class='card-liner-content dashbox'>
                            <h6 class="card-liner-subtitle">Insurance</h6>
                            <h2 class="card-liner-title">0</h2>
                        </div>
                        <div class='card-liner-content dashbox'>
                            <h6 class="card-liner-subtitle">Patient</h6>
                            <h2 class="card-liner-title"><span class="card-liner-icon mt-1">$</span> 0</h2>
                        </div>
                        <div class='card-liner-content dashbox'>
                            <h6 class="card-liner-subtitle">Total</h6>
                            <h2 class="card-liner-title"><span class="card-liner-icon mt-1">$</span> 0</h2>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12  col-md-12 ">
            <div class="card">
                <div class="card-body customBoxHeight5">
                    <div class="wizard mb-1">
                        <div class="connecting-line"></div>
                        <div class="row">
                            <div class="col-12  col-md-12 mt-0">
                                <nav>
                                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                        <a class="nav-item nav-link active" id="nav-task-tab" data-toggle="tab"
                                            href="#nav-appointment" role="tab" aria-controls="nav-appointment"
                                            aria-selected="true"><i class="fa-solid fa-list-check"></i> Appointment</a>
                                        <a class="nav-item nav-link" id="nav-task-tab" data-toggle="tab" href="#nav-task"
                                            role="tab" aria-controls="nav-task" aria-selected="false"><i class="fa-solid fa-signal"></i> Task</a>

                                       <a class="nav-item nav-link" id="nav-task-tab" data-toggle="tab" 
                                       href="#nav-stats" role="tab" aria-controls="nav-stats" aria-selected="false"><i class="fa-solid fa-list-check"></i> Stats</a>
                                        <!--<a class="nav-item nav-link" id="nav-about-tab" data-toggle="tab" href="#nav-about" role="tab" aria-controls="nav-about" aria-selected="false">About</a>-->
                                    </div>
                                </nav>
                                <div class="tab-content  " id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-appointment" role="tabpanel" aria-labelledby="nav-task-tab">
                                         <div id="accordion2" class="accordion-alt tabContentDiv" role="tablist">
                                            <div class="row">
                                                <div class="form-group col-md-4">
                                                     <div id="datepicker-center">
                                                            <div id='calendar-month'></div>
                                                    </div>
                                                </div> 
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="table-responsive">
                                                        <table id="showTodayAppointments" class="table layout-secondary dataTable table-striped table-bordered">
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
                                                                </tr>
                                                            </thead>
                                                            <tbody></tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>  
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="nav-task" role="tabpanel" aria-labelledby="nav-task-tab">
                                        Meraki rcm Task
                                    </div>
                                    <div class="tab-pane fade" id="nav-stats" role="tabpanel" aria-labelledby="nav-task-tab">
                                        Meraki rcm stats
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
    <!-- END: Card DATA-->
@endsection
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://code.jquery.com/jquery-migrate-1.2.1.js"></script>
<script type="text/javascript">
function formatDate(date) {
    var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) 
        month = '0' + month;
    if (day.length < 2) 
        day = '0' + day;

    return [year, month, day].join('-');
} 
   var dataTable
$(document).ready(function () {  
    var todayDate = formatDate(new Date());  
    showDatePicker(todayDate);
})
function showDatePicker(tDate){
        $('#calendar-month').datepicker({
        dateFormat:'mm/dd/yy',  changeMonth: true, changeYear: true,
        //defaultDate: tDate,
        onSelect: function(selected,evnt) {
            getTodayAppointment(formatDate(selected), formatDate(selected)); 
        } 
    })
}

function getTodayAppointment(minDate, maxDate){
    table = $('#showTodayAppointments').DataTable(); 
    table.destroy(); 
    dataTable = $('#showTodayAppointments').DataTable({
        "processing": true,
        "serverSide": true,
        "filter": true,
        searching:false,
        "paging": false, // Initially enable paging
        "ajax": {
            "url": "/showTodayPatientAppointment",
            "type": "POST",
            "datatype": "json",
            data: function (d) {
                d._token = token,
                d.min = minDate;
                d.max = maxDate;
            },
            "dataSrc": function (response) {
                // Ensure the response is an object with a property named 'data'
                return response;
            },
        }, 
        "columns": [
                        { "data": "appointmentNo"}, 
                        { "data": "appointmentDate"}, 
                        { "data": "appointmentTime"}, 
                        { "data": "fullName"}, 
                        { "data": "contactNo"}, 
                        { "data": "providerName"}, 
                        { "data": "meetingType"}, 
                        { "data": "vistStatus"}, 
                        { "data": "billStatus"}, 
                    ], 
        "language": {
            "emptyTable": "No Data found"
        },
    }); 
    dataTable.draw(); 
    /////////////////////////////////////////////////////////
    
}
</script>
