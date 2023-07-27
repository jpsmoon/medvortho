@extends('layouts.home-app')

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

        /*.setMinheight {*/
        /*    min-height: 250px !important;*/
        /*}*/
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
    </style>

    <!-- START: Card Data-->
    <div class="row">
        <div class="col-12 col-sm-6 col-xl-3 mt-3">
            <div class="card">
                <div class="card-body">
                    <div class='d-flex px-0 px-lg-2 py-2 align-self-center bg-primary text-white dashboard-boxes'>
                        <!--<i class="icon-basket icons card-liner-icon mt-2"></i>-->
                        <div class='card-liner-content'>
                            <h2 class="card-liner-title">{{$totalBProviders}}</h2>
                            <h6 class="card-liner-subtitle">Total Billing Providers</h6>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3 mt-3">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('patients.index') }}">
                        <div class='d-flex px-0 px-lg-2 py-2 align-self-center text-white bg-warning dashboard-boxes'>
                            <!-- <i class="icon-user icons card-liner-icon mt-2"></i>-->
                            <div class='card-liner-content'>
                                <h2 class="card-liner-title">{{ $totalPatients }}</h2>
                                <h6 class="card-liner-subtitle">Total Patients</h6>
                            </div>
                        </div>

                    </a>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3 mt-3">
            <div class="card">
                <div class="card-body">
                    <div class='d-flex px-0 px-lg-2 py-2 align-self-center text-white bg-danger dashboard-boxes'>
                        <!--<i class="icon-bag icons card-liner-icon mt-2"></i>-->
                        <div class='card-liner-content'>
                            <h2 class="card-liner-title">{{$totalInjury}}</h2>
                            <h6 class="card-liner-subtitle">Total Injuries</h6>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3 mt-3">
            <div class="card">
                <div class="card-body">
                    <div class='d-flex px-0 px-lg-2 py-2 align-self-center bg-primary text-white dashboard-boxes'>
                        <!--<span class="card-liner-icon mt-1">$</span>-->
                        <div class='card-liner-content'>
                            <h2 class="card-liner-title">{{$totalBills}}</h2>
                            <h6 class="card-liner-subtitle">Total Bills</h6>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-12  col-md-12 ">
            <div class="card">
                <!-- <div class="card-header  bg-primary  justify-content-between align-items-center">
                        <h4 class="card-title text-warning">{{ __('Dashboard: My Tasks') }}</h4>
                    </div> -->
                <div class="card-body customBoxHeight2">
                    <div class="wizard mb-4">
                        <div class="connecting-line"></div>
                        <div class="row">
                            <div class="col-8  col-md-8 mt-3">
                                <nav>
                                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                        <a class="nav-item nav-link active" id="nav-task-tab" data-toggle="tab"
                                            href="#nav-task" role="tab" aria-controls="nav-task"
                                            aria-selected="true"><i class="fa-solid fa-list-check"></i> Task</a>
                                        <a class="nav-item nav-link" id="nav-stats-tab" data-toggle="tab" href="#nav-stats"
                                            role="tab" aria-controls="nav-stats" aria-selected="false"><i class="fa-solid fa-signal"></i> Stats</a>

                                        <!--<a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Contact</a>-->
                                        <!--<a class="nav-item nav-link" id="nav-about-tab" data-toggle="tab" href="#nav-about" role="tab" aria-controls="nav-about" aria-selected="false">About</a>-->
                                    </div>
                                </nav>
                                <div class="tab-content  " id="nav-tabContent">
                                    <div class="tab-pane fade show active" id="nav-task" role="tabpanel"
                                        aria-labelledby="nav-task-tab">
                                        <div id="accordion2" class="accordion-alt tabContentDiv" role="tablist">
                                            <?php $i = 1; ?>
                                            @foreach ($statuses as $status)
                                                <div class="col-md-12">
                                                    <h6 class="mb-0">
                                                        <a class="text-uppercase fw-bold d-block sowAccordianSelectBorder sowAccordianSelect"
                                                            data-toggle="collapse" href="#collapse_{{ $status->id }}"
                                                            aria-expanded="true"
                                                            aria-controls="collapse_{{ $status->id }}">
                                                            {{ $status->status_name }}
                                                        </a>
                                                    </h6>
                                                    <div id="collapse_{{ $status->id }}"
                                                        class="collapse scroll-h setMinheight {{ count($mytasks) > 0 && $i == 1 ? 'show' : '' }} "
                                                        role="tabpanel" data-parent="#accordion2">
                                                        <div class="card-body">
                                                            <table class="table">
                                                                @isset($mytasks)
                                                                    @inject('testClass', 'App\Http\Controllers\HomeController')
                                                                    @foreach ($mytasks as $task)
                                                                        @if ($task->status_id == $status->id)
                                                                            <tr>
                                                                                <td><b>{{ $testClass->changeUnderScoreToSpace($task->status_alias) }}</b>
                                                                                </td>
                                                                                <td>
                                                                                    <span>Task</span><br />
                                                                                    <b>{{ $task->total_task }}</b>
                                                                                </td>
                                                                                <td>
                                                                                    <span>Balance</span><br />
                                                                                    <b>0</b>
                                                                                </td>
                                                                            </tr>
                                                                        @endif
                                                                    @endforeach
                                                                @endisset
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php $i++; ?>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="nav-stats" role="tabpanel"
                                        aria-labelledby="nav-stats-tab">
                                        Meraki rcm stats
                                    </div>

                                </div>
                            </div>
                            <div class="col-4  col-md-4">
                                <div class="card mt-3">
                                    <div class="card-header  showButtonColor justify-content-between align-items-center">
                                        <h5 class="card-title text-warning"><i class="fa-solid fa-hospital-user"></i> Patients Appointment</h5>
                                    </div>
                                    <div class="card-body text-center border-primary table-responsive" id="sowPatintInfoRit">
                                            <div id="accordion23" class="accordion-alt scroll-h tabContentDiv" role="tablist">
                                                <?php $i=1;?>
                                                @foreach($patients as $patient)
                                                    <div class="col-md-12">
                                                        <h6 class="mb-0">
                                                            <a  class="text-uppercase fw-bold d-block sowAccordianSelectBorder sowAccordianSelect" data-toggle="collapse" href="#collapseSchedular_{{$patient->id}}" aria-expanded="true" aria-controls="collapseSchedular_{{$patient->id}}">
                                                            {{$patient->first_name}}
                                                            </a>
                                                        </h6>
                                                        <div id="collapseSchedular_{{$patient->id}}" class="collapse appointmentDiv setMinheight {{((count($mytasks) > 0) && $i==1) ? 'show' : ''}} " role="tabpanel" data-parent="#accordion23">
                                                            <table class="a">
                                                                <thead>
                                                                    <th>Date/Time</th>
                                                                    <th>Type</th>
                                                                    <th>Reason</th>
                                                                    <th>Duration</th>
                                                                    <th>Resource</th> 
                                                                </thead>
                                                                <tbody>
                                                                    @if($patient->getAppointments)
                                                                    @inject('testClass', 'App\Http\Controllers\HomeController')
                                                                    @foreach($patient->getAppointments as $appointment)
                                                                     <tr>
                                                                        <td>{{ ($appointment->appointment_date) ? date('m-d-Y', strtotime($appointment->appointment_date)) : '' }}/{{$appointment->appointment_time}}</td>
                                                                        <td>{{ ($appointment->meeting_type == 1) ? 'In Office' : 'On Phone' }}</td>
                                                                        <td>{{($appointment->appointment_reason) ? $testClass->getAppointReasonFromModel($appointment->appointment_reason) : ''}}</td>
                                                                        <td>{{($appointment->duration) ? $testClass->convertToHoursMins($appointment->duration, '%02d hours %02d minutes') : 0}}</td>
                                                                        <td>{{ ($appointment->resource) ? $appointment->resource : '' }}</td> 
                                                                    </tr>
                                                                    @endforeach
                                                                    @endif
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                    <?php $i++; ?>
                                                @endforeach
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
    <!-- END: Card DATA-->
@endsection
