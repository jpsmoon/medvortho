@extends('layouts.home-app')
@section('content')
    <style>
        nav>.nav.nav-tabs {
            border: none;
            color: #fff;
            background: #ccc;
            border-radius: 0;
            width: 30%;
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
        }

        nav>div a.nav-item.nav-link.active:after {
            content: "";
            position: relative;
            bottom: -47px;
            left: -16%;
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
            min-height: 350px;
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
            padding-left: 10px;
            padding-top: 10px;
            background: #b6efe7;
            color: #2A3F54;
        }

        .sowAccordianSelectBorder {
            border: 1px solid #2A3F54;
        }

        .setMinheight {
            min-height: 250px !important;
        }

        .card {
             position: relative;
            display: -ms-flexbox;
            display: flex;
            -ms-flex-direction: column;
            flex-direction: column;
            min-width: 0;
            word-wrap: break-word;
            background-color: #fff;
            background-clip: border-box;
            border: 1px solid rgba(0, 0, 0, .125);
            border-radius: .25rem;
        }
  .card-header:first-child {
            border-radius: calc(.25rem - 1px) calc(.25rem - 1px) 0 0;
        }

        .card-header {
            padding: .75rem 1.25rem;
            margin-bottom: 0;
            background-color: rgba(0, 0, 0, .03);
            border-bottom: 1px solid rgba(0, 0, 0, .125);
        }

        .card-body {
            -ms-flex: 1 1 auto;
            flex: 1 1 auto;
            padding: 1.25rem;
        }
        .tabContentDiv {}
    </style>
    <!-- START: Breadcrumbs-->
    <div class="row ">
        <div class="col-12  align-self-center">
            <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                <div class="w-sm-100 mr-auto col-10">
                    <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                        <li class="breadcrumb-item">
                            <h2><svg xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" viewBox="0 0 34 34"
                                    class="left">
                                    <title>icon_patient</title>
                                    <path
                                        d="M20.983 16.793L19.32 23.2h-1.857c-.825.017-1.48.654-1.463 1.425l.005.21c.017.758.682 1.365 1.495 1.365h5.147c.977 0 1.829-.617 2.07-1.5l.269-.977a.392.392 0 0 0 .014-.104c0-.231-.2-.418-.448-.418h-.753l-1.085-6.853c.258.077.501.185.73.324.517.314.933.72 1.248 1.216.314.497.573 1.094.777 1.791.203.698.343 1.39.418 2.079.075.688.113 1.42.113 2.194 0 .993-.277 1.846-.83 2.557-.553.71-1.22 1.066-1.999 1.066H11.83c-.78 0-1.446-.355-1.999-1.066-.553-.711-.83-1.564-.83-2.557 0-.775.038-1.506.113-2.194.075-.689.215-1.381.418-2.079.204-.697.463-1.294.777-1.79.315-.497.73-.903 1.249-1.217.518-.315 1.113-.472 1.786-.472 1.16 1.167 2.546 1.75 4.157 1.75 1.31 0 2.472-.386 3.483-1.157zm-.58 6.623l1.423-5.602.791 5.602h-2.213zM22.5 12c0 1.38-.488 2.559-1.465 3.535C20.06 16.512 18.88 17 17.5 17c-1.38 0-2.559-.488-3.535-1.465C12.988 14.56 12.5 13.38 12.5 12c0-1.38.488-2.559 1.465-3.535C14.94 7.488 16.12 7 17.5 7c1.38 0 2.559.488 3.535 1.465C22.012 9.44 22.5 10.62 22.5 12z"
                                        fill="#3A3A3A" fill-rule="evenodd"></path>
                                </svg>
                                Bill Information</h2>
                        </li>
                    </ol>
                </div>
                <div class="w-sm-100 mr-auto col-2">
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <a class="btn btn-primary"
                                href="{{ url('/edit/injury/bill') }}/{{ $injuryId }}/{{ $billId }}">
                                <i class="icon-pencil"></i> Edit</a>
                        </li>
                        <li class="list-inline-item">
                            <a class="btn btn-primary" href="{{ url('/view/patient/injury/bill/') }}/{{ $injuryId }}">
                                Back</a>
                        </li>
                    </ul>

                </div>
            </div>
        </div>
    </div>
    <!-- END: Breadcrumbs-->
    <div class="row">
        <div class="col-9 mt-4">
            <div class="card">
                <div class="card-body">
                    <div class="col-12  col-md-12 mt-3">
                        <nav>
                            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-task-tab" data-toggle="tab" href="#nav-task"
                                    role="tab" aria-controls="nav-task" aria-selected="true">Bill</a>
                                <a class="nav-item nav-link" id="nav-stats-tab" data-toggle="tab" href="#nav-stats"
                                    role="tab" aria-controls="nav-stats" aria-selected="false">Bill History</a>
                            </div>
                        </nav>
                        <div class="tab-content  " id="nav-tabContent">
                            <div class="tab-pane fade show active p-1" id="nav-task" role="tabpanel"
                                aria-labelledby="nav-task-tab">
                                <div class="row mt-2">
                                    <div class="col-sm-6">
                                        <div class="row mt-2">
                                            <div class="col-sm-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <b><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"><path fill="#818598" d="M19.23 6.1 15.4 2.27a.94.94 0 0 0-.66-.27h-.24v5h5v-.24c0-.24-.1-.48-.27-.66Zm-5.98 1.21V2H5.44a.94.94 0 0 0-.94.94v18.12c0 .52.42.94.94.94h13.12c.52 0 .94-.42.94-.94V8.25h-5.31a.94.94 0 0 1-.94-.94ZM7 4.81c0-.17.14-.31.31-.31h3.13c.17 0 .31.14.31.31v.63c0 .17-.14.31-.31.31H7.3a.31.31 0 0 1-.3-.31V4.8Zm0 3.13V7.3c0-.17.14-.31.31-.31h3.13c.17 0 .31.14.31.31v.63c0 .17-.14.31-.31.31H7.3a.31.31 0 0 1-.3-.3Zm5.63 10.3v.95c0 .17-.14.31-.32.31h-.62a.31.31 0 0 1-.31-.31v-.95a2.24 2.24 0 0 1-1.23-.44.31.31 0 0 1-.02-.48l.46-.44c.1-.1.27-.1.4-.03.14.1.31.15.5.15h1.1c.24 0 .45-.23.45-.52a.52.52 0 0 0-.34-.5l-1.76-.52a1.77 1.77 0 0 1-1.23-1.7c0-.95.74-1.73 1.66-1.76v-.94c0-.17.14-.31.32-.31h.62c.17 0 .31.14.31.31v.95c.45.02.87.18 1.23.44.15.12.16.35.02.48l-.46.44c-.1.1-.27.1-.4.03a.94.94 0 0 0-.5-.15h-1.1c-.25 0-.45.23-.45.52 0 .23.14.43.34.5l1.76.52c.72.22 1.23.91 1.23 1.7 0 .95-.74 1.73-1.66 1.76Z"></path></svg>
                                                        Bill Information</b>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="table-responsive">
                                                            <table id="billInformation" class="table layout-secondary dataTable table-striped">
                                                                <tbody>
                                                                <tr>
                                                                    <th scope="row">DOS</th>
                                                                    <td>{{date('Y-m-d',strtotime($injuryBillInfo->dos))}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Place of Service</th>
                                                                    <td>{{($injuryBillInfo->getBillPlaceOfService) ? $injuryBillInfo->getBillPlaceOfService->nick_name : 'NA' }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Place of Service Code</th>
                                                                    <td>{{($injuryBillInfo->getBillPlaceOfService->placeOfServiceCode) ? $injuryBillInfo->getBillPlaceOfService->placeOfServiceCode->service_code. " - ".$injuryBillInfo->getBillPlaceOfService->placeOfServiceCode->name : 'NA' }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Rendering Provider</th>
                                                                    <td>{{($injuryBillInfo->getRenderinProvider) ? $injuryBillInfo->getRenderinProvider->name : 'NA' }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Authorization Number</th>
                                                                    <td>{{$injuryBillInfo->bill_authorization_number}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Additional Information</th>
                                                                    <td>{{$injuryBillInfo->bill_additiona_information_box}}</td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-sm-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <b>Diagnosis Codes</b>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="table-responsive">
                                                            <table id="diagnosisCode" class="table layout-secondary dataTable table-striped">
                                                                <tbody>
                                                                <tr>
                                                                    <th scope="row">{{($injuryBillInfo->diagnosis_code_type === 9) ? 'ICD9' : 'ICD10'}}</th>
                                                                    <td>{{$diagnos}}</td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="row mt-2">
                                            <div class="col-sm-12">
                                                 <div class="card">
                                                    <div class="card-header"> 
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"><path d="M14.085 2.468A4.96 4.96 0 0 0 12 2a4.996 4.996 0 0 0-4.63 3.125h3.172l3.543-2.657Zm2.544 2.657a4.988 4.988 0 0 0-1.425-1.934l-2.58 1.934h4.005ZM12 12a5 5 0 0 0 5-5c0-.214-.037-.418-.063-.625H7.063C7.037 6.582 7 6.785 7 7a5 5 0 0 0 5 5Zm-5.625 1.707V22h5.01L7.54 13.347a5.188 5.188 0 0 0-1.164.36ZM3.25 20.125C3.25 21.16 4.09 22 5.125 22v-7.49c-1.138.962-1.875 2.383-1.875 3.99v1.625Zm10-1.875h-2.163L12.754 22h.496a1.877 1.877 0 0 0 1.875-1.875 1.877 1.877 0 0 0-1.875-1.875Zm2.25-5h-.653a6.821 6.821 0 0 1-2.847.625 6.821 6.821 0 0 1-2.847-.625h-.288L10.532 17h2.718a3.129 3.129 0 0 1 3.125 3.125c0 .706-.244 1.351-.641 1.875h3.141c1.035 0 1.875-.84 1.875-1.875V18.5c0-2.9-2.35-5.25-5.25-5.25Z" fill="#818598"></path></svg>
                                                        <b>Patient Demographics</b>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="table-responsive">
                                                            @if($injuryBillInfo->getInjury->patient)
                                                                <table id="patientDemographics" class="table layout-secondary dataTable table-striped">
                                                                    <tbody>
                                                                    <tr>
                                                                        <th scope="row">Name</th>
                                                                        <td>{{$injuryBillInfo->getInjury->patient->first_name. " ". $injuryBillInfo->getInjury->patient->last_name}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th scope="row">DOB</th>
                                                                        <td> {{ ($injuryBillInfo->getInjury->patient->dob) ? date('m-d-Y', strtotime($injuryBillInfo->getInjury->patient->dob)) : 'NA'}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th scope="row">SSN</th>
                                                                        <td>{{ $injuryBillInfo->getInjury->patient->ssn_no}}</td>
                                                                    </tr>
                                                                    </tbody>
                                                                </table>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-sm-12">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <b><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none"><path fill="#818598" fill-rule="evenodd" d="M14.828 3.515a4 4 0 0 1 5.657 5.657L17.657 12 12 6.343l2.828-2.828ZM7.404 10.94l3.535-3.536 5.657 5.657-3.535 3.535-5.657-5.656ZM6.344 12l-2.83 2.829a4 4 0 1 0 5.658 5.656L12 17.657 6.343 12Zm10.252-6.01a.75.75 0 1 0 1.06-1.06.75.75 0 0 0-1.06 1.06Zm2.475 1.414a.75.75 0 1 1-1.06-1.06.75.75 0 0 1 1.06 1.06Zm-2.475 1.414a.75.75 0 1 0 1.06-1.06.75.75 0 0 0-1.06 1.06Zm-.353-1.414a.75.75 0 1 1-1.061-1.06.75.75 0 0 1 1.06 1.06Zm-9.9 8.839a.75.75 0 1 0 1.06-1.06.75.75 0 0 0-1.06 1.06Zm2.475 1.414a.75.75 0 1 1-1.06-1.06.75.75 0 0 1 1.06 1.06Zm-2.475 1.414a.75.75 0 1 0 1.06-1.06.75.75 0 0 0-1.06 1.06Zm-.353-1.414a.75.75 0 1 1-1.061-1.06.75.75 0 0 1 1.06 1.06Z" clip-rule="evenodd"></path></svg> 
                                                        Injury Information</b>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="table-responsive">
                                                        @if($injuryBillInfo->getInjury)
                                                            <table id="injuryInformation" class="table layout-secondary dataTable table-striped">
                                                                <tbody>
                                                                <tr>
                                                                    <th scope="row">Employer</th>
                                                                    <td>{{($injuryBillInfo->getInjury->getInjuryClaim) ? $injuryBillInfo->getInjury->getInjuryClaim->employer_name : 'NA'}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">DOI</th>
                                                                    <td>{{($injuryBillInfo->getInjury->getInjuryClaim) ? $injuryBillInfo->getInjury->getInjuryClaim->start_date : 'NA'}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Claim Number</th>
                                                                    <td>{{($injuryBillInfo->getInjury->getInjuryClaim) ? $injuryBillInfo->getInjury->getInjuryClaim->claim_no : 'NA'}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Claims Administrator</th>
                                                                    <td>{{($injuryBillInfo->getInjury->getInjuryClaim && $injuryBillInfo->getInjury->getInjuryClaim->getClaimAdmin) ? $injuryBillInfo->getInjury->getInjuryClaim->getClaimAdmin->name : 'NA'}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <th scope="row">Injury State</th>
                                                                    <td>{{($injuryBillInfo->getInjury) ? $injuryBillInfo->getInjury->injury_state_id : 'NA'}}</td>
                                                                </tr>
                                                                </tbody>
                                                            </table>
                                                        @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-sm-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <b>Procedure Code Detail</b>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table id="procedureCodeDetail"
                                                        class="table layout-secondary dataTable table-striped table-bordered">
                                                        <thead class="thead-dark">
                                                            <tr>
                                                                <th scope="col">Procedure Code</th>
                                                                <th scope="col">Units</th>
                                                                <th scope="col">Charge</th>
                                                                <th scope="col">Expected Fee Schedule</th>
                                                                <th scope="col">Calculated BR Reduction</th>
                                                                <th scope="col">Original Submission Payment</th>
                                                                <th scope="col">Bill Payment Total</th>
                                                                <th scope="col">Write Off Amount</th>
                                                                <th scope="col">Balance Due</th>
                                                                <th scope="col">Expected Fee Schedule %</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @php $totCharAmt = 0; $totPaymentAmt = 0; $blcDue = 0; $expectedAmt = 0;
                                                            $calculateBrAmt = 0;
                                                            $originSubAmt = 0;
                                                            $billPaymentAmt = 0;
                                                            $writeOffAmt = 0;
                                                            $blcDueAmt = 0;
                                                            $expectedFeeSAmt = 0;
                                                            @endphp
                                                            @if(count($injuryBillInfo->getBillServices))
                                                            @foreach ($injuryBillInfo->getBillServices as $bill)
                                                                @php
                                                                $totCharAmt += $bill->master_unit_amount;
                                                                $totPaymentAmt += $bill->total_bill_amount;
                                                                @endphp
                                                            <tr>
                                                                <td><a href="{{url('/view/patient/injury/bill/info')}}/{{$bill->billId}}">{{$bill->bill_procedure_code}}</a></td>
                                                                <td>{{$bill->bill_units}}</td>
                                                                <td>{{($bill->bill_units * $bill->master_unit_amount)}}</td>
                                                                <td>{{$bill->master_unit_amount}}</td>
                                                                <td>-</td>
                                                                <td>-</td>
                                                                <td>-</td>
                                                                <td>-</td>
                                                                <td>-</td>
                                                                <td>-</td>
                                                            </tr>
                                                            @endforeach
                                                            @endif
                                                        </tbody>
                                                        <tfoot>
                                                            <tr>
                                                                <td scope="row"><b>Bill Totals</b></td>
                                                                <td>&nbsp;</td>
                                                                <td>{{$totPaymentAmt}}</td>
                                                                <td>{{$totCharAmt}}</td>
                                                                <td>{{$calculateBrAmt}}</td>
                                                                <td>{{$originSubAmt}}</td>
                                                                <td>{{$billPaymentAmt}}</td>
                                                                <td>{{$writeOffAmt}}</td>
                                                                <td>{{$blcDueAmt}}</td>
                                                                <td>{{$expectedFeeSAmt}}</td>
                                                            </tr>
                                                        </tfoot>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-sm-12">
                                        <div class="card">
                                            <div class="card-header">
                                                <b>Documents Sent with Original Bill</b>
                                            </div>
                                            <div class="card-body">
                                                <p class="card-text">With supporting text below as a natural
                                                    lead-in to additional content.</p>
                                            </div>
                                            <div class="card-footer">
                                            <div class="row mt-2">
                                                <div class="col-sm-4">(e-Bill)</div>
                                                <div class="col-sm-4">
                                                <a href="{{ url('/billing/provider/view-cms-1500-form', $billId) }}"
                                                    target="_blank">View CMS 1500 PDF</a>
                                                    </div>
                                                <div class="col-sm-4"> <a target="_blank" href="https://daisybill-production.s3.amazonaws.com/attachments/documents/023/101/403/original/original_cover_letter_7651239.pdf?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=AKIA2WZ7DPQIEPX4SAFD%2F20230425%2Fus-east-1%2Fs3%2Faws4_request&X-Amz-Date=20230425T100039Z&X-Amz-Expires=10&X-Amz-SignedHeaders=host&X-Amz-Signature=c98af4592267614efd2b8ba69923d9ca78dc353dc4c63d7f7104786afe2955ae">
                                                View Submission Coversheet</a></div>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="card">
                                            <div class="card-header" style="padding: 10px 0px 0px 16px !important;">
                                                <ul class="list-inline">
                                                    <li class="list-inline-item">
                                                        <b>Documents
                                                            ({{ count($injuryBillInfo->getBillDocuments) }})</b>
                                                    </li>
                                                    <li class="list-inline-item">
                                                        <a class=""
                                                            href="{{ url('/patients/injury/documents') }}/{{ $billId }}/Bill">
                                                            Add Document</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <table id="documentsInfo"
                                                        class="table layout-secondary dataTable table-striped table-bordered">
                                                        <thead class="thead-dark">
                                                            <tr>
                                                                <th scope="col">Id</th>
                                                                <th scope="col">Description</th>
                                                                <th scope="col">Document</th>
                                                                <th scope="col">Reporting Type</th>
                                                                <th scope="col">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @if (count($injuryBillInfo->getBillDocuments))
                                                                @foreach ($injuryBillInfo->getBillDocuments as $document)
                                                                    <?php $i = 0;
                                                                    $fileName = $document->injury_document;
                                                                    ?>
                                                                    <tr>
                                                                        <td>{{ $i + 1 }}</td>
                                                                        <td>{{ $document->description }}</td>
                                                                        <td><a href="{{ asset('/injury_document/' . $document->injury_document) }}"
                                                                                target="_blank">{{ $fileName }}</a>
                                                                        </td>
                                                                        <td>{{ $document->getReportType ? $document->getReportType->report_name : '-' }}
                                                                        </td>
                                                                        <td>
                                                                            <i class="icon-pencil  showPointer" /></i>
                                                                            <i class="icon-trash showPointer" /></i>
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
                            <div class="tab-pane fade p-1" id="nav-stats" role="tabpanel" aria-labelledby="nav-stats-tab">
                                <div class="table-responsive">
                                @inject('testClass', 'App\Http\Controllers\PatientController')
                                    <table id="billsLogs" class="table layout-secondary dataTable table-striped table-bordered">
                                        <thead class="thead-dark">
                                            <tr>
                                                <th scope="col">Date</th>
                                                <th scope="col">Action</th>
                                                <th scope="col">User</th>
                                                <th scope="col">Details</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if(count($billLogs) > 0)
                                            @foreach ($billLogs as $log)
                                            <tr>
                                                <td>{{ date('m-d-Y', strtotime($log->created_at))}}</td>
                                                <td>{{ $testClass->changeUnderScoreToSpace($log->type)}}</td>
                                                <td>{{ $log->getUser->name}}</td>
                                                <td>{{$testClass->changeUnderScoreToSpace($log->description)}}</td>
                                            </tr>
                                            @endforeach
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
        <div class="col-3 mt-4">
            @include('patients.show-patient-info')
        </div>
    </div>
@endsection
