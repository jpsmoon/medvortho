@extends('layouts.home-new-app')
@section('content')
    <style>
        .showLoad {}

        .showLoad .progress {
            position: relative;
            height: 10px;
            width: 100%;
            border: 3px solid #f4a261;
            border-radius: 15px;
        }

        .progress .color {
            position: absolute;
            background-color: green;
            width: 0px;
            height: 10px;
            border-radius: 15px;
            animation: progres 4s infinite linear;
        }

        @keyframes progres {
            0% {
                width: 0%;
            }

            25% {
                width: 50%;
            }

            50% {
                width: 75%;
            }

            75% {
                width: 85%;
            }

            100% {
                width: 100%;
            }
        }

        .table .main-head td {
            color: #3C4244;
            background-color: #ccc;
            border-color: #3C4244;
        }

        .table .thead-dark th {
            color: #3C4244;
            background-color: #ccc;
            border-color: #3C4244;
        }

        .table thead th {
            vertical-align: bottom;
            border-bottom: 1px solid #E3EBF3;
            border-top: 0px solid #E3EBF3;
        }

        .tab-content,
        .border-primary {
            border: 0px solid rgba(33, 40, 50, .125) !important;
        }

        .table-bordered thead td,
        .table-bordered thead th {
            border-bottom-width: 1px;
        }

        #multi-step-form-container ul.form-stepper {
            counter-reset: section;
            margin-bottom: 0.5rem;
        }
    </style>

    <div class="row">
        <div class="col-xl-12 col-lg-12 bg-white">
            <div class="row">
                <div class="col-xl-9 col-lg-8 mt-0 scroll-new row-background2 bill-information">
                    <div class="row mt-1">
                        <div class="col-12  align-self-center">
                            <div
                                class="sub-header mt-0 py-3 px-3 align-self-center d-sm-flex w-100 rounded heading-background">
                                <div class="w-sm-100 mr-auto margin05">
                                    <h2><i class="fa-solid fa-id-card-clip"></i> Bill Information</h2>
                                </div>
                                <div align="right" class="w-sm-100 ">
                                    <ol class="list-inline breadcrumb bg-transparent align-self-center m-0 p-0">
                                        @if ($taskAssignInfo)
                                            @if (
                                                ($taskAssignInfo->status_alias && $taskAssignInfo->status_alias == 'DOCUMENT_REQUIRED') ||
                                                    $taskAssignInfo->status_alias == 'BILL_FAILED_REVIEW' ||
                                                    $taskAssignInfo->status_alias == 'SEND_BILL')
                                                <li class="list-inline-item">
                                                    <a href="javascript:void(0)" class="btn btn-primary"
                                                        onclick="deleteBillInfo({{ $injuryBillInfo->id }},{{ $injuryBillInfo->injury_id }})">
                                                        <i class="fa-solid fa-trash-can"></i> Delete
                                                    </a>
                                                </li>
                                            @endif
                                        @endif
                                        <li class="list-inline-item">
                                            <a class="btn btn-primary"
                                                href="{{ url('/edit/injury/bill') }}/{{ $injuryBillInfo->getInjury ? $injuryBillInfo->getInjury->id : '' }}/{{ $billId }}">
                                                <i class="icon-pencil"></i> Edit</a>
                                        </li>
                                        <li class="list-inline-item">
                                            @if ($injuryBillInfo && $injuryBillInfo->getInjury)
                                                <a class="btn btn-primary"
                                                    href="{{ url('/view/patient/injury/bill/') }}/{{ $injuryBillInfo->getInjury->id }}">
                                                    Back</a>
                                            @endif
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="card">
                        <div class="card-body px-0">
                            <div class="col-12 col-md-12 mt-0 mb-0 pt-0">
                                <nav>
                                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                        <a class="nav-item nav-link active" id="nav-task-tab" data-toggle="tab"
                                            href="#nav-task" role="tab" aria-controls="nav-task" aria-selected="true"><i
                                                class="fa-solid fa-list-check"></i> Bill</a>
                                        <a class="nav-item nav-link" id="nav-stats-tab" data-toggle="tab" href="#nav-stats"
                                            role="tab" aria-controls="nav-stats" aria-selected="false"><i
                                                class="fa-solid fa-file-invoice-dollar"></i> Bill History</a>
                                        <a class="nav-item nav-link" id="nav-stats-tab" data-toggle="tab"
                                            href="#nav-letters" role="tab" aria-controls="nav-stats"
                                            aria-selected="false"><i class="fa-solid fa-file-invoice-dollar"></i> Bill
                                            Letters</a>
                                    </div>
                                </nav>
                                <div class="tab-content" id="nav-tabContent" style="border:0px solid #333">
                                    <div class="tab-pane fade show active p-1" id="nav-task" role="tabpanel"
                                        aria-labelledby="nav-task-tab">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="row">
                                                    <div class="col-sm-12 pr-0 pl-0">

                                                        <div class="card mb-0">
                                                            <div class="card-header">
                                                                <h5 class="card-title text-warning"><i
                                                                        class="fa-solid fa-file-invoice"></i> Bill
                                                                    Information</h5>
                                                            </div>
                                                            <div class="card-body2">
                                                                <div class="table-responsive">
                                                                    <table id="billInformation"
                                                                        class="table layout-secondary table-striped">
                                                                        <tbody>
                                                                            <tr>
                                                                                <th scope="row">DOS</th>
                                                                                <td>{{ date('m/d/Y', strtotime($injuryBillInfo->dos)) }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Place of Service</th>
                                                                                <td>{{ $injuryBillInfo && $injuryBillInfo->getBillPlaceOfService ? $injuryBillInfo->getBillPlaceOfService->nick_name : 'NA' }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Place of Service Code
                                                                                </th>
                                                                                <td>{{ $injuryBillInfo && $injuryBillInfo->getBillPlaceOfService && $injuryBillInfo->getBillPlaceOfService->placeOfServiceCode && $injuryBillInfo->getBillPlaceOfService->placeOfServiceCode->service_code ? $injuryBillInfo->getBillPlaceOfService->placeOfServiceCode->service_code . ' - ' . $injuryBillInfo->getBillPlaceOfService->placeOfServiceCode->name : 'NA' }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Rendering Provider</th>
                                                                                <td>
                                                                                    {{ $injuryBillInfo->getRenderinProvider && $injuryBillInfo->getRenderinProvider->referring_provider_first_name ? $injuryBillInfo->getRenderinProvider->referring_provider_first_name : '' }}
                                                                                    {{ $injuryBillInfo->getRenderinProvider && $injuryBillInfo->getRenderinProvider->referring_provider_last_name ? $injuryBillInfo->getRenderinProvider->referring_provider_last_name : '' }}
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Authorization Number</th>
                                                                                <td>{{ $injuryBillInfo->bill_authorization_number ? $injuryBillInfo->bill_authorization_number : '-' }}
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <th scope="row">Additional Information
                                                                                </th>
                                                                                <td>{{ $injuryBillInfo->bill_additiona_information_box ? $injuryBillInfo->bill_additiona_information_box : '-' }}
                                                                                </td>
                                                                            </tr>
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12 pr-0 pl-0">
                                                        <div class="card mb-1">
                                                            <div class="card-header">
                                                                <div class="row">
                                                                    <div class="col-sm-8">
                                                                        <h5 class="card-title text-warning"><i
                                                                                class="fa-solid fa-stethoscope"></i>
                                                                            Diagnosis Codes</h5>
                                                                    </div>
                                                                    @if($taskAssignInfo)
                                                                    @if($taskAssignInfo->status_alias && $taskAssignInfo->status_alias == 'SEND_BILL'  || $taskAssignInfo->status_alias == 'INCOMPLETE_BILL'  || $taskAssignInfo->status_alias == 'PROCESS_BILL')
                                                                    <div class="col-sm-4">
                                                                        <h6 class="card-title text-warning showPointer"
                                                                            data-toggle="modal" data-target="#addDCModel"><i
                                                                                class="fa fa-plus-circle"></i> Diagnosis
                                                                            Code</h6>
                                                                    </div>
                                                                    @endif
                                                                     @endif
                                                                </div>
                                                            </div>
                                                            <div class="card-body2">
                                                                <div class="table-responsive">
                                                                    <table id="diagnosisCode"
                                                                        class="table layout-secondary table-striped">
                                                                        <tbody>
                                                                            <tr>
                                                                                <th scope="row">
                                                                                    {{ $injuryBillInfo->diagnosis_code_type === 9 ? 'ICD9' : 'ICD10' }}
                                                                                </th>
                                                                                <td>{{ $diagnos }}</td>
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
                                                <div class="row">
                                                    <div class="col-sm-12 pr-0">
                                                        <div class="card mb-0">
                                                            <div class="card-header">
                                                                <h5 class="card-title text-warning"><i
                                                                        class="fa-solid fa-hospital-user"></i> Patient
                                                                    Demographics</h5>
                                                            </div>
                                                            <div class="card-body2">
                                                                <div class="table-responsive">
                                                                    @if ($injuryBillInfo->getInjury && $injuryBillInfo->getInjury->patient)
                                                                        <table id="patientDemographics"
                                                                            class="table layout-secondary table-striped">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <th scope="row">Name</th>
                                                                                    <td>{{ $injuryBillInfo->getInjury->patient->first_name }}{{ $injuryBillInfo->getInjury->patient->last_name ? ' ' . $injuryBillInfo->getInjury->patient->last_name : '' }}
                                                                                        {{ $injuryBillInfo->getInjury->patient->mi ? ' ' . $injuryBillInfo->getInjury->patient->mi : '' }}
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th scope="row">DOB</th>
                                                                                    <td> {{ $injuryBillInfo->getInjury->patient->dob ? date('m/d/Y', strtotime($injuryBillInfo->getInjury->patient->dob)) : 'NA' }}
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th scope="row">SSN</th>
                                                                                    <td>{{ $injuryBillInfo->getInjury->patient->ssn_no }}
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12 pr-0">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <h5 class="card-title text-warning"><i
                                                                        class="fa-solid fa-user-injured"></i> Injury
                                                                    Information</h5>
                                                            </div>
                                                            <div class="card-body2">
                                                                <div class="table-responsive">
                                                                    @if ($injuryBillInfo && $injuryBillInfo->getInjury)
                                                                        <table id="injuryInformation"
                                                                            class="table layout-secondary table-striped">
                                                                            <tbody>
                                                                                <tr>
                                                                                    <th scope="row">Employer</th>
                                                                                    <td>{{ $injuryBillInfo->getInjury->getInjuryClaim ? $injuryBillInfo->getInjury->getInjuryClaim->employer_name : 'NA' }}
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th scope="row">DOI</th>
                                                                                    <td>{{ $injuryBillInfo->getInjury->getInjuryClaim && $injuryBillInfo->getInjury->getInjuryClaim->start_date ? date('m/d/Y', strtotime($injuryBillInfo->getInjury->getInjuryClaim->start_date)) : 'NA' }}
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th scope="row">Claim Number</th>
                                                                                    <td>{{ $injuryBillInfo->getInjury->getInjuryClaim ? $injuryBillInfo->getInjury->getInjuryClaim->claim_no : 'NA' }}
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th scope="row">Claims Administrator
                                                                                    </th>
                                                                                    <td>{{ $injuryBillInfo->getInjury->getInjuryClaim && $injuryBillInfo->getInjury->getInjuryClaim->getClaimAdmin ? $injuryBillInfo->getInjury->getInjuryClaim->getClaimAdmin->name : 'NA' }}
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <th scope="row">Injury State</th>
                                                                                    <td>{{ $injuryBillInfo->getInjury ? $injuryBillInfo->getInjury->injury_state_id : 'NA' }}
                                                                                    </td>
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
                                        <div class="row">
                                            <div class="col-sm-12 pl-0 pr-0">
                                                <div class="card mb-1">
                                                    <div class="card-header">
                                                        <div class="row">
                                                            <div class="col-sm-10">
                                                                <h5 class="card-title text-warning"><i
                                                                        class="fa-solid fa-network-wired"></i> Procedure
                                                                    Code Detail</h5>
                                                            </div>
                                                             @if($taskAssignInfo)
                                                            @if($taskAssignInfo && $taskAssignInfo->status_alias && $taskAssignInfo->status_alias == 'SEND_BILL'  || $taskAssignInfo->status_alias == 'INCOMPLETE_BILL'  || $taskAssignInfo->status_alias == 'PROCESS_BILL')
                                                            <div class="col-sm-2">
                                                                <h6 class="card-title text-warning showPointer"
                                                                    data-toggle="modal" data-target="#addPCModel"><i
                                                                        class="fa fa-plus-circle"></i> Procedure Code</h6>
                                                            </div>
                                                            @endif
                                                            @endif
                                                        </div>
                                                    </div>
                                                    <div class="card-body2">
                                                        <div class="table-responsive2">
                                                            <table id="procedureCodeDetail"
                                                                class="table layout-secondary table-striped table-bordered">
                                                                <thead class="thead-dark main-head">
                                                                    <tr>
                                                                        @if (
                                                                            $injuryBillInfo->getStatus &&
                                                                                $injuryBillInfo->getStatus->slug_name &&
                                                                                $injuryBillInfo->getStatus->slug_name == 'SENT_BILL')
                                                                            <td> <label class="mb-0"><input
                                                                                        type="checkbox" id="checkAll" />
                                                                                    Select All</label></td>
                                                                        @endif
                                                                        <td>Procedure Code</td>
                                                                        <td>Units</td>
                                                                        <td>Charge</td>
                                                                        <td>Expected Fee Schedule</td>
                                                                        <td>Calculated BR Reduction</td>
                                                                        <td>Original Submission Payment</td>
                                                                        <td>Bill Payment Total</td>
                                                                        <td>Write Off Amount</td>
                                                                        <td>Balance Due</td>
                                                                        <td>Expected Fee Schedule %</td>
                                                                    </tr>

                                                                </thead>
                                                                <tbody>
                                                                    @php $totCharAmt = 0;
                                                                        $totPaymentAmt = 0;
                                                                        $blcDue = 0;
                                                                        $expectedAmt = 0;
                                                                        $calculateBrAmt = 0;
                                                                        $originSubAmt = 0;
                                                                        $billPaymentAmt = 0;
                                                                        $writeOffAmt = 0;
                                                                        $blcDueAmt = 0;
                                                                        $expectedFeeSAmt = 0;
                                                                        $totalUnit = 0;
                                                                    @endphp
                                                                    @if ($injuryBillInfo && count($injuryBillInfo->getBillServices))
                                                                        @foreach ($injuryBillInfo->getBillServices as $bill)
                                                                            @php
                                                                                $expectedAmt = 0;
                                                                                $pcUnit = 0;
                                                                                $pcExpected = 0;
                                                                                $totCharAmt += $bill->getMasterBillCPDCodeCharge && $bill->getMasterBillCPDCodeCharge->units ? $bill->getMasterBillCPDCodeCharge->units : 0;
                                                                                $totalUnit += $bill->bill_units;
                                                                                if ($bill->getMasterBillCPDCodeCharge && $bill->getMasterBillCPDCodeCharge->omfs_unit && $bill->getMasterBillCPDCodeCharge->units) {
                                                                                    $expectedAmt = $bill->getMasterBillCPDCodeCharge->units - $bill->getMasterBillCPDCodeCharge->omfs_unit;
                                                                                }
                                                                                if ($bill->getMasterBillCPDCodeCharge && $bill->getMasterBillCPDCodeCharge->units) {
                                                                                    $pcUnit = $bill->getMasterBillCPDCodeCharge && $bill->getMasterBillCPDCodeCharge->units ? $bill->getMasterBillCPDCodeCharge->units : 0;
                                                                                }
                                                                                if ($bill->getMasterBillCPDCodeCharge && $bill->getMasterBillCPDCodeCharge->omfs_unit) {
                                                                                    $pcExpected = $bill->getMasterBillCPDCodeCharge && $bill->getMasterBillCPDCodeCharge->omfs_unit ? $bill->getMasterBillCPDCodeCharge->omfs_unit : 0;
                                                                                }

                                                                                $calculateBrAmt += $bill->getMasterBillCPDCodeCharge && $bill->getMasterBillCPDCodeCharge->omfs_unit && $bill->getMasterBillCPDCodeCharge->units ? $bill->getMasterBillCPDCodeCharge->units - $bill->getMasterBillCPDCodeCharge->omfs_unit : 0;
                                                                            @endphp
                                                                            <tr>
                                                                                @if (
                                                                                    $injuryBillInfo->getStatus &&
                                                                                        $injuryBillInfo->getStatus->slug_name &&
                                                                                        $injuryBillInfo->getStatus->slug_name == 'SENT_BILL')
                                                                                    <td>
                                                                                        <label><input class="chk"
                                                                                                type="checkbox"
                                                                                                name=billCheckId[]
                                                                                                value="{{ $bill->id }}"
                                                                                                onClick="showSecondReviewDiv(this.value, {{ $bill->id }});" />
                                                                                        </label>
                                                                                    </td>
                                                                                @endif
                                                                                <td><a
                                                                                        href="{{ url('/view/patient/injury/bill/info') }}/{{ $bill->billId }}">{{ $bill->bill_procedure_code }}</a>
                                                                                </td>
                                                                                <td>{{ $bill->bill_units }}</td>
                                                                                <td>{{ $pcUnit }}</td>
                                                                                <td>{{ $pcExpected }}</td>
                                                                                <td>{{ $expectedAmt }}</td>
                                                                                <td>-</td>
                                                                                <td>-</td>
                                                                                <td>-</td>
                                                                                <td>-</td>
                                                                                <td>-</td>
                                                                            </tr>
                                                                            @if ($bill && $bill->getBillProcedureSBR)
                                                                                <tr>
                                                                                    <td colspan="12">
                                                                                        <h3>Bill Second Review<h3>
                                                                                                <table
                                                                                                    id="procedureCodeSbr"
                                                                                                    class="table">
                                                                                                    <thead
                                                                                                        class="thead-dark">
                                                                                                        <tr>
                                                                                                            <th>Reason Text
                                                                                                            </th>
                                                                                                            <th>Reason
                                                                                                                Description
                                                                                                            </th>
                                                                                                            <th>Service Good
                                                                                                            </th>
                                                                                                            <th>New Attached
                                                                                                                Document
                                                                                                            </th>
                                                                                                        </tr>
                                                                                                    </thead>

                                                                                                    <tbody>
                                                                                                        <td> {{ $bill->getBillProcedureSBR->getBillingProviderSecondReview ? substr_replace($bill->getBillProcedureSBR->getBillingProviderSecondReview->description, '...', 50) : '' }}
                                                                                                        </td>
                                                                                                        <td> {{ $bill->getBillProcedureSBR->review_text ? substr_replace($bill->getBillProcedureSBR->review_text, '...', 50) : '' }}
                                                                                                        </td>
                                                                                                        <td> {{ $bill->getBillProcedureSBR->service_good && $bill->getBillProcedureSBR->service_good == 1 ? $bill->getBillProcedureSBR->service_good : '' }}
                                                                                                        </td>
                                                                                                        <td> {{ $bill->getBillProcedureSBR->attched_document && $bill->getBillProcedureSBR->attched_document == 1 ? $bill->getBillProcedureSBR->attched_document : '' }}
                                                                                                        </td>
                                                                                                    </tbody>
                                                                                                    <tfoot>
                                                                                                        <tr>
                                                                                                            <td
                                                                                                                colspan="6">
                                                                                                                <span
                                                                                                                    class="btn btn-primary">Edit</span>
                                                                                                            </td>
                                                                                                        </tr>
                                                                                                    </tfoot>
                                                                                                </table>
                                                                                    </td>
                                                                                </tr>
                                                                            @endif
                                                                            <tr id="showSecondReviewDiv_{{ $bill->id }}"
                                                                                class="d-none">
                                                                                <input type="hidden"
                                                                                    name="secondReviewBillId[]"
                                                                                    id="secondReviewBillId_{{ $bill->id }}"
                                                                                    value>
                                                                                <td colspan="12">
                                                                                    <div class="card mb-0">
                                                                                        <div class="card-body">
                                                                                            <div class="row">
                                                                                                <div
                                                                                                    class="col-xs-6 col-sm-6 col-md-6">
                                                                                                    <label
                                                                                                        for="secondReview{{ $bill->id }}">
                                                                                                        Resaon for second
                                                                                                        review </label>
                                                                                                    <select
                                                                                                        onChange="onchangeGetSecondReviewText(this.value, {{ $bill->id }})"
                                                                                                        name="secondReviewDescription[]"
                                                                                                        class="form-control modefierCode"
                                                                                                        id="secondReview_{{ $bill->id }}">
                                                                                                        <option
                                                                                                            value="">
                                                                                                            -Select-
                                                                                                        </option>
                                                                                                        @foreach ($secondReviews as $seReview)
                                                                                                            <option
                                                                                                                value="{{ $seReview->id }}">
                                                                                                                {{ $seReview->description }}
                                                                                                            </option>
                                                                                                        @endforeach
                                                                                                    </select>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="row">
                                                                                                <div
                                                                                                    class="col-xs-6 col-sm-6 col-md-6">
                                                                                                    <label
                                                                                                        for="resoanForDescription">
                                                                                                    </label>
                                                                                                    <textarea name="secondReviewText[]" id="secondReviewText_{{ $bill->id }}" class="form-control"
                                                                                                        style="resize: none;"></textarea>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="row">
                                                                                                <div
                                                                                                    class="col-xs-6 col-sm-6 col-md-6">
                                                                                                    <label
                                                                                                        for="serviceGood">
                                                                                                        Service/Good
                                                                                                        Authorized </label>
                                                                                                    <div
                                                                                                        class="custom-control custom-radio custom-control-inline">
                                                                                                        <input
                                                                                                            type="radio"
                                                                                                            class="serviceGood"
                                                                                                            name="service_good[]"
                                                                                                            id="service_good1_{{ $bill->id }}"
                                                                                                            value="1">
                                                                                                        Yes
                                                                                                        <input
                                                                                                            type="radio"
                                                                                                            class="serviceGood"
                                                                                                            name="service_good[]"
                                                                                                            id="service_good2_{{ $bill->id }}"
                                                                                                            checked
                                                                                                            value="2">
                                                                                                        No
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                            <div class="row">
                                                                                                <div
                                                                                                    class="col-xs-6 col-sm-6 col-md-6">
                                                                                                    <label
                                                                                                        for="newDocumentAttached">
                                                                                                        New Documents
                                                                                                        Attached </label>
                                                                                                    <div
                                                                                                        class="custom-control custom-radio custom-control-inline">
                                                                                                        <input
                                                                                                            type="radio"
                                                                                                            class="newDocument"
                                                                                                            data-toggle="modal"
                                                                                                            data-target="#showUploadDocumentDiv"
                                                                                                            name="new_documen_atttched[]"
                                                                                                            onClick="showNewDocumentDiv({{ $bill->id }})"
                                                                                                            id="new_documen_atttched1_{{ $bill->id }}"
                                                                                                            value="1">
                                                                                                        Yes
                                                                                                        <input
                                                                                                            type="radio"
                                                                                                            class="newDocument"
                                                                                                            name="new_documen_atttched[]"
                                                                                                            id="new_documen_atttched2_{{ $bill->id }}"
                                                                                                            checked
                                                                                                            value="2">
                                                                                                        No
                                                                                                    </div>
                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                        @endforeach
                                                                    @endif
                                                                </tbody>
                                                                <tfoot>
                                                                    <tr>
                                                                        <td scope="row"><b>Bill Totals</b></td>
                                                                        @if (
                                                                            $injuryBillInfo->getStatus &&
                                                                                $injuryBillInfo->getStatus->slug_name &&
                                                                                $injuryBillInfo->getStatus->slug_name == 'SENT_BILL')
                                                                            <td>&nbsp;</td>
                                                                        @endif
                                                                        <td>{{ $totalUnit }}</td>
                                                                        <td>{{ $totCharAmt }}</td>
                                                                        <td>{{ $calculateBrAmt }}</td>
                                                                        <td>{{ $originSubAmt }}</td>
                                                                        <td>{{ $billPaymentAmt }}</td>
                                                                        <td>{{ $writeOffAmt }}</td>
                                                                        <td>{{ $blcDueAmt }}</td>
                                                                        <td>{{ $expectedFeeSAmt }}</td>
                                                                        <td>-</td>
                                                                    </tr>
                                                                    <tr id="sendBtnDiv" class="d-none">
                                                                        <td colspan="12">
                                                                            <div class="col-md-12">
                                                                                <div class="form-group col-md-6">
                                                                                    <button type="button"
                                                                                        onClick="storeSecondReview();"
                                                                                        class="btn btn-primary">Submit</button>
                                                                                    <button type="button"
                                                                                        class="btn btn-secondary">Canel</button>
                                                                                </div>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </tfoot>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 pl-0 pr-0">
                                                <div class="card mb-1 mt-1">
                                                    <div class="card-header">
                                                        <h5 class="card-title text-warning"><i
                                                                class="fa-solid fa-file-invoice"></i> Documents Sent with
                                                            Original Bill</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <p class="card-text">With supporting text below as a natural
                                                            lead-in to additional content.</p>
                                                    </div>
                                                    <div class="card-header2">
                                                        <div class="row mt-2">
                                                            <!--<div class="col-sm-4">(e-Bill)</div>-->
                                                            @if ($isFoundCMS)
                                                                <div class="col-sm-4">
                                                                    <a href="{{ asset('/bills/cms/' . $isFoundCMS->temp_document_name) }} "
                                                                        target="_blank">View CMS 1500 PDF</a>
                                                                </div>
                                                            @endif
                                                            @if ($isFoundCover)
                                                                <div class="col-sm-4">
                                                                    <a target="_blank"
                                                                        href="{{ asset('/bills/coverSheet/' . $isFoundCover->temp_document_name) }} ">View
                                                                        Submission Coversheet</a>
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 pl-0 pr-0">
                                                <div class="card mb-0">
                                                    <div class="card-header p-1">
                                                        <ul class="list-inline mb-0">
                                                            <li class="list-inline-item">
                                                                <h5 class="text-warning">Documents
                                                                    ({{ count($injuryBillInfo->getBillDocuments) }})
                                                                </h5>
                                                            </li>
                                                            <li class="list-inline-item">
                                                                <h5 class="text-warning"><a
                                                                        href="{{ url('/patients/injury/documents') }}/{{ $billId }}/Bill">
                                                                        Add Document
                                                                    </a></h5>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    <div class="card-body2">
                                                        <div class="table-responsive">
                                                            <table id="documentsInfo"
                                                                class="table layout-secondary table-striped table-bordered">
                                                                <thead class="thead-dark">
                                                                    <tr>
                                                                        <th scope="col">Id</th>
                                                                        <th scope="col">Description</th>
                                                                        <th scope="col">Document</th>
                                                                        <th scope="col">Reporting Type</th>
                                                                        <th scope="col">Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody id="showBillDocuments">

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @if($injuryBillInfo && $injuryBillInfo->getBillPaymentInfo)
                                        <div class="row">
                                            <div class="col-sm-6 pl-0 pr-0">
                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5 class="card-title text-warning">Bill Submission</h5>
                                                    </div> 
                                                    <div class="card-body"> 
                                                        <table id="example1" class="table layout-secondary dataTable table-striped table-bordered">
                                                             <tr>
                                                                <th scope="col">Details</th>
                                                                <td>
                                                                    <ul class="list-inline mb-0">
                                                                        <li class="list-inline-item">
                                                                            <h5 class="text-warning">Type:</h5>
                                                                        </li> 
                                                                        <li class="list-inline-item">
                                                                            {{ ($injuryBillInfo->getBillPaymentInfo->payment_type && $injuryBillInfo->getBillPaymentInfo->payment_type == 1) ? 'Original Bill' : 'Second Review' }}
                                                                        </li>
                                                                        <br>
                                                                        <li class="list-inline-item">
                                                                            <h5 class="text-warning">Delivery:</h5>
                                                                        </li>
                                                                        <li class="list-inline-item">
                                                                            e-Bill (837)
                                                                        </li>
                                                                        <br>
                                                                        <li class="list-inline-item">
                                                                            <h5 class="text-warning">837 Sent:</h5>
                                                                        </li>
                                                                        <li class="list-inline-item">
                                                                            {{ ($injuryBillInfo->getSendBillDate && $injuryBillInfo->getSendBillDate->sent_date) ? date('m/d/Y', strtotime($injuryBillInfo->getSendBillDate->sent_date)) : '' }}
                                                                        </li>
                                                                        <br>
                                                                        <li class="list-inline-item">
                                                                            <h5 class="text-warning">Control Number:</h5>
                                                                        </li>
                                                                        <li class="list-inline-item">
                                                                            {{ ($injuryBillInfo->getBillPaymentInfo->getBillPaymentMultipleClaimNumberInfo && $injuryBillInfo->getBillPaymentInfo->getBillPaymentMultipleClaimNumberInfo->payer_claim_control_cumber) ? $injuryBillInfo->getBillPaymentInfo->getBillPaymentMultipleClaimNumberInfo->payer_claim_control_cumber : ' ' }}
                                                                        </li>
                                                                    </ul> 
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="col">Post Date</th>
                                                                <td>{{ ($injuryBillInfo->getBillPaymentInfo->created_at) ? date('m/d/Y', strtotime($injuryBillInfo->getBillPaymentInfo->created_at)) : '' }}</td>
                                                            </tr>
                                                             <tr>
                                                                <th scope="col">Payment Amount</th>
                                                                <td>{{ ($injuryBillInfo->getBillPaymentInfo->payment_amount) ? $injuryBillInfo->getBillPaymentInfo->payment_amount : '' }}</td>
                                                            </tr>
                                                        </table> 
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 pl-2 pr-0">
                                                 <div class="card">
                                                    <div class="card-header">
                                                        <h5 class="card-title text-warning">Payment Information</h5>
                                                    </div>  
                                                    <div class="card-body">
                                                        <table id="example1" class="table layout-secondary dataTable table-striped table-bordered">
                                                             <tr>
                                                                <th scope="col">Source</th>
                                                                <td> Paper EOR</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="col">Payment Method</th>
                                                                 <td>{{ ($injuryBillInfo->getBillPaymentInfo->payment_amount) ? $injuryBillInfo->getBillPaymentInfo->payment_amount : '' }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="col">Amount</th>
                                                                 <td>
                                                                        @php $paymentFrom = null;
                                                                        if($injuryBillInfo->getBillPaymentInfo->payment_from){
                                                                            if($injuryBillInfo->getBillPaymentInfo->payment_from && $injuryBillInfo->getBillPaymentInfo->payment_from == 'paper_check'){
                                                                                $paymentFrom = 'Check';
                                                                            }
                                                                            else if($injuryBillInfo->getBillPaymentInfo->payment_from && $injuryBillInfo->getBillPaymentInfo->payment_from == 'eft'){
                                                                                $paymentFrom = 'EFT';
                                                                            }
                                                                            else if($injuryBillInfo->getBillPaymentInfo->payment_from && $injuryBillInfo->getBillPaymentInfo->payment_from == 'virtual_credit_card'){
                                                                                $paymentFrom = 'Credit Card';
                                                                            }
                                                                        }
                                                                        @endphp
                                                                        {{$paymentFrom}}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="col">Refence Number</th>
                                                                <td>{{ ($injuryBillInfo->getBillPaymentInfo->refence_number) ? $injuryBillInfo->getBillPaymentInfo->refence_number : '' }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="col">Effective Date</th>
                                                                <td>{{ ($injuryBillInfo->getBillPaymentInfo->payment_effective_date) ? date('m/d/Y', strtotime($injuryBillInfo->getBillPaymentInfo->payment_effective_date)) : '' }}</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="col">Deposit Date </th>
                                                                <td>@if($injuryBillInfo->getBillPaymentInfo->payment_deposite && $injuryBillInfo->getBillPaymentInfo->payment_deposite == 1){{ ($injuryBillInfo->getBillPaymentInfo->payment_deposit_date) ? date('m/d/Y', strtotime($injuryBillInfo->getBillPaymentInfo->payment_deposit_date)) : '' }}@endif</td>
                                                            </tr>
                                                            <tr>
                                                                <th scope="col">Explanation Of Review</th>
                                                                 <td>
                                                                    @if ($injuryBillInfo && $injuryBillInfo->getBillDocForPayment && $injuryBillInfo->getBillDocForPayment->injury_document)
                                                                        <a href="{{ asset('/injury_document/'.$injuryBillInfo->getBillDocForPayment->injury_document) }}" target="_blank">
                                                                            <span>Paper EOR #1<span><br>
                                                                            <span>Upload Paper EOR<span>
                                                                            <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                                                                        </a>
                                                                    @endif 
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                        <div class="row">
                                            <div class="col-sm-12 pl-0 pr-0">
                                                <div class="card mt-2 mb-0 pb-0">
                                                    <div class="card-body"> 
                                                         <div id="multi-step-form-container">
                                                                <!-- Form Steps / Progress Bar -->
                                                                <span class="bill_overdue_days {{ $txtColor }}">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="25px"
                                                                        height="25px" viewBox="0 0 34 34">
                                                                        <title>icon_task</title>
                                                                        <path
                                                                            d="M9.857 10.429a.714.714 0 0 0-.714.714v15.714c0 .395.32.714.714.714h14.286c.394 0 .714-.32.714-.714V11.143a.714.714 0 0 0-.714-.714H9.857zm1.429-2.143v-.66a1 1 0 0 1 1-1h1.857C14.524 4.877 15.483 4 17.02 4c1.537 0 2.483.876 2.836 2.627h1.857a1 1 0 0 1 1 1v.659h1.429A2.857 2.857 0 0 1 27 11.143v15.714a2.857 2.857 0 0 1-2.857 2.857H9.857A2.857 2.857 0 0 1 7 26.857V11.143a2.857 2.857 0 0 1 2.857-2.857h1.429zm5.714 0a1.429 1.429 0 1 0 0-2.857 1.429 1.429 0 0 0 0 2.857zm-.806 12.136L12.5 17.397 11 19.15l5.278 4.416 6.901-7.295-1.51-1.557-5.475 5.708z"
                                                                            fill="#3A3A3A" fill-rule="nonzero"></path>
                                                                    </svg>
                                                                    <span>{{ $totalDays }} </span>
                                                                </span>
                                                                <ul class="form-stepper form-stepper-horizontal text-center mx-auto pl-0"> 
                                                                    @if (count($billStatuss) > 0)
                                                                        @php $i=1;@endphp
                                                                        @foreach ($billStatuss as $status)
                                                                            <!-- Step 1 -->
                                                                            <li class="{{ $injuryBillInfo->bill_stage == $status->id ? 'form-stepper-active' : 'form-stepper-unfinished' }} text-center form-stepper-list"
                                                                                step="1">
                                                                                <a class="mx-2">
                                                                                    <span class="form-stepper-circle">
                                                                                        <span>{{$i}}</span>
                                                                                    </span>
                                                                                    <div
                                                                                        class="label {{ $injuryBillInfo->bill_stage == $status->id ? ' ' : 'text-muted' }}">
                                                                                        {{ strtoupper($status->status_name) }}
                                                                                    </div>
                                                                                </a>
                                                                            </li>
                                                                            @php $i++; @endphp
                                                                        @endforeach
                                                                    @endif
                                                                </ul>
                                                                @if($taskAssignInfo)
                                                                    <ul
                                                                        class="form-stepper form-stepper-horizontal text-center mx-auto pl-0">
                                                                        <li class="form-stepper-active">
                                                                            <h3>
                                                                            <span class="bill_overdue_days bill_overdue_days_90"> 
                                                                                <span>{{ str_replace('_', ' ', trim($taskAssignInfo->status_alias)) }}</span>
                                                                            </span>
                                                                            </h3>
                                                                        </li>
                                                                    </ul>
                                                                     @if($taskAssignInfo->status_alias == 'SEND_BILL')
                                                                        <div class="row">
                                                                            <div class="col-12 ">
                                                                                <button type="button"
                                                                                    class="btn btn-primary ladda-button"
                                                                                    data-toggle="modal"
                                                                                    data-target="#addSubmissionModal"
                                                                                    id="billSentBtn">Send</button>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                    @if($taskAssignInfo->status_alias == 'SENT_BILL')
                                                                        <div class="row">
                                                                            <div class="col-9">
                                                                                <span class="muted-text">Explanations of Review Posted</span><br>
                                                                                <span class="btn btn-outline-secondary"><a href="{{ url('/bill/payment/postings/new/first/'.$injuryBillInfo->id) }}">Post Paper EOR</a></span>
                                                                            </div>
                                                                            <div class="col-3">
                                                                                <button type="button"
                                                                                    class="btn btn-secondary ladda-button"
                                                                                    data-toggle="modal"
                                                                                    data-target="#addWriteOfLetterrForCloseBillModal"
                                                                                    id="billCloseBtn">Close Bill</button>
                                                                            </div>
                                                                        </div>
                                                                    @endif
                                                                    @if($taskAssignInfo->status_alias == 'BILL_FAILED_REVIEW' && $taskAssignInfo->description == "Payment deposit date missing")
                                                                        @if($injuryBillInfo)
                                                                            @if($injuryBillInfo->getBillPaymentInfo && $injuryBillInfo->getBillPaymentInfo->payment_tab_id)
                                                                            <div class="col-9">
                                                                                <span class="muted-text">Explanations of Review Posted</span><br>
                                                                                <span class="btn btn-outline-secondary"><a href="{{ url('/bill/payment/postings/new/')}}/{{$injuryBillInfo->getBillPaymentInfo->payment_tab_id}}/{{$injuryBillInfo->id}}/{{$injuryBillInfo->getBillPaymentInfo->id}}" >Update EOR</a></span>
                                                                            </div>
                                                                            @endif
                                                                        @endif
                                                                     @endif 
                                                                @endif
                                                                @if ($injuryBillInfo->getStatus->slug_name == 'CLOSED_BILL')
                                                                    <div class="row">
                                                                        <div class="col-6">
                                                                            <div class="col-4">
                                                                                <button type="button"
                                                                                    class="btn btn-secondary ladda-button"
                                                                                    id="billOpenBtn">Open Bill</button>
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

                                    <div class="tab-pane fade pr-0 pl-0" id="nav-stats" role="tabpanel"
                                        aria-labelledby="nav-stats-tab" style="background:#fff; margin:0 0;">
                                        <div class="table-responsive">
                                            @inject('testClass', 'App\Http\Controllers\PatientController')
                                            <table id="billsLogs"
                                                class="table layout-secondary dataTable table-striped table-bordered">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th scope="col">Date</th>
                                                        <th scope="col">Action</th>
                                                        <th scope="col">User</th>
                                                        <th scope="col">Details</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if (count($billLogs) > 0)
                                                        @foreach ($billLogs as $log)
                                                            <tr>
                                                                <td>{{ date('m/d/Y', strtotime($log->created_at)) }}</td>
                                                                <td>{{ $testClass->changeUnderScoreToSpace($log->type) }}
                                                                </td>
                                                                <td>{{ $log->getUser->name }}</td>
                                                                <td>{{ $testClass->changeUnderScoreToSpace($log->description) }}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade  pr-0 pl-0" id="nav-letters" role="tabpanel"
                                        aria-labelledby="nav-stats-tab" style="background:#fff; margin:0 0;">
                                        <div class="table-responsive">
                                            <table id="billsLogs"
                                                class="table layout-secondary dataTable table-striped table-bordered">
                                                <thead class="thead-dark">
                                                    <tr>
                                                        <th scope="col">S.No#</th>
                                                        <th scope="col">Letter</th>
                                                        <th scope="col">URL</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    <tr>
                                                        <td>1.</td>
                                                        <td>SBR-Letter</td>
                                                        <td><a class="text-dark"
                                                                href="{{ url('/bill-submissions/letters/sbr-letter', $injuryBillInfo->id) }}">View</a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>2.</td>
                                                        <td>RFA Letter</td>
                                                        <td><a class="text-dark"
                                                                href="{{ url('/bill-submissions/letters/rfa-letter', $injuryBillInfo->id) }}">View</a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>3.</td>
                                                        <td>PR2 Letter</td>
                                                        <td><a class="text-dark"
                                                                href="{{ url('/bill-submissions/letters/pr2-letter', $injuryBillInfo->id) }}">View</a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>4.</td>
                                                        <td>Re-Submission Letter</td>
                                                        <td><a class="text-dark"
                                                                href="{{ url('/bill-submissions/letters/resubmission-letter', $injuryBillInfo->id) }}">View</a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>5.</td>
                                                        <td>Demand Letter</td>
                                                        <td><a class="text-dark"
                                                                href="{{ url('/bill-submissions/letters/demand-letter', $injuryBillInfo->id) }}">View</a>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>6.</td>
                                                        <td>Authorization Letter</td>
                                                        <td><a class="text-dark"
                                                                href="{{ url('/bill-submissions/letters/authorization-letter', $injuryBillInfo->id) }}">View</a>
                                                        </td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-4 mt-0 rightside sticky"
                    style="padding-left:5px!important; padding-right:5px!important; top:70px">
                    @include('patients.show-patient-info')
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Modal content -->
    <div class="modal fade" id="addDCModel" role="dialog" aria-labelledby="addDCModelLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <input type="hidden" name="bill_procesure_code_id" id="bill_procesure_code_id" value="">
            <form method="POST" action="{{ route('addDiagnosisCode') }}">
                @csrf
                <input type="hidden" name="billId" class="" id="billId_1" value="{{ $injuryBillInfo->id }}">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addDCModelLabel">Add Diagnosis Code</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row cloneDCDiv">
                            <div class="form-group col-md-6 cloneDivDiagnosisCode" id="dio_Code_1">
                                <label for="work_dg_code_id_1"> &nbsp; </label>
                                <input type="text" name="work_dg_code_id[]" class="work_dg_original"
                                    id="work_dg_code_id_1">
                                @if ($errors->has('work_dg_code_id'))
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong class="invalid-feedback">{{ $errors->first('work_dg_code_id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal content -->
    <!-- Modal content -->
    <div class="modal fade" id="addSubmissionModal" tabindex="-1" role="dialog"
        aria-labelledby="addSubmissionModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="billSendFrm" enctype="multipart/form-data" class="form-horizontal ladda-form'" method="POST">
                @csrf
                <input type="hidden" name="bill_id" id="bill_id" value="{{ $injuryBillInfo->id }}">
                <div class="modal-content ">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addSubmissionModalLabel">Bill Submission</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <h5>Delivery Method</h5>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="form-group">
                                    <input type="radio" class="sendType" onclick="showFaxOptionDiv(this.value);"
                                        name = "delivery_Method" value="1" checked data-validation-event="change"
                                        data-validation="required" data-validation-error-msg=""> Send e-bill </br>
                                    <input type="radio" class="sendType" onclick="showFaxOptionDiv(this.value);"
                                        name = "delivery_Method" value="2" data-validation-event="change"
                                        data-validation="required" data-validation-error-msg=""> Send via fax </br>
                                    <input type="radio" class="sendType" onclick="showFaxOptionDiv(this.value);"
                                        name = "delivery_Method" value="3" data-validation-event="change"
                                        data-validation="required" data-validation-error-msg=""> Download Packet</br>
                                </div>
                            </div>
                        </div>
                        <div class="row d-none" id="faxDiv">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-12 col-md-12">
                                        <select id="fax_type"
                                            onchange="getClaimAdminInfo({{ $injuryBillInfo->id }}, this.value);"
                                            name="fax_type" class="form-control">
                                            <option value="">Please Select</option>
                                            <option value="1">Custom</option>
                                            <option value="2">Adjustor</option>
                                        </select>
                                        @if ($errors->has('fax_type'))
                                            <span class="invalid-feedback" style="display:block" role="alert">
                                                <strong class="invalid-feedback">{{ $errors->first('fax_type') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="first_name"> Fax Number </label>
                                        <input value="{{ $claimFaxNumber }}" type="text" data-mask="999-999-9999"
                                            id="name="fax_number"" name="fax_number" value=""
                                            class="form-control" data-validation-event="change"
                                            data-validation="required" data-validation-length="2-100">
                                        @if ($errors->has('fax_number'))
                                            <span class="invalid-feedback" style="display:block" role="alert">
                                                <strong
                                                    class="invalid-feedback">{{ $errors->first('fax_number') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="first_name"> Attention </label>
                                        <input type="text" id="name="fax_attention"" name="fax_attention"
                                            value="" class="form-control" data-validation-event="change"
                                            data-validation="required" data-validation-length="2-100">
                                        @if ($errors->has('fax_attention'))
                                            <span class="invalid-feedback" style="display:block" role="alert">
                                                <strong
                                                    class="invalid-feedback">{{ $errors->first('fax_attention') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row d-none" id="downloadPDFDiv">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <select onchange="checkAction();" id="claimAdminDownloadPdf" name="claimAdminDownloadPdf"
                                    class="form-control">
                                    <option value="">Please Select</option>
                                    <option
                                        value="{{ $injuryBillInfo->getInjury && $injuryBillInfo->getInjury->getInjuryClaim && $injuryBillInfo->getInjury && $injuryBillInfo->getInjury->getInjuryClaim->claim_admin_id ? $injuryBillInfo->getInjury->getInjuryClaim->claim_admin_id : null }}">
                                        {{ $injuryBillInfo->getInjury && $injuryBillInfo->getInjury->getInjuryClaim && $injuryBillInfo->getInjury->getInjuryClaim->getClaimAdmin && $injuryBillInfo->getInjury->getInjuryClaim->getClaimAdmin->admin_address ? $injuryBillInfo->getInjury->getInjuryClaim->getClaimAdmin->admin_address : '' }}
                                    </option>
                                </select>
                                @if ($errors->has('claimAdminDownloadPdf'))
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong
                                            class="invalid-feedback">{{ $errors->first('claimAdminDownloadPdf') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <span id="showPdfUrLoad" class="showLoad d-none">
                                    <div class="progress">
                                        <div class="color"></div>
                                    </div>
                                </span>
                                <span><a id="showPdfUrl" class="d-none" target="_blank"></a></span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" id="sendBtnId" onClick="submitPacketPdf();"; disabled
                            class="btn btn-primary">Send</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal content -->
    <!-- Modal content -->
    <div class="modal fade" id="showUploadDocumentDiv" tabindex="-1" role="dialog"
        aria-labelledby="showUploadDocumentLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <input type="hidden" name="bill_procesure_code_id" id="bill_procesure_code_id" value="">
            <form id="billProcedureDocumentFrm" enctype="multipart/formdata">
                <div class="modal-content ">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addSubmissionModalLabel">Bill Document</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-row">
                            <div class="form-group col-md-12">
                                <div class="img-zone text-center" id="img-zone">
                                    <div class="img-drop">
                                        <h2><i class="glyphicon glyphicon-camera"></i> </h2>
                                        <span class="btn btn-success btn-file">
                                            Click to Open File Browser<input type="file" name="billDocFile"
                                                id="billDocFile" accept="application/pdf/*">
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" onClick="saveProcedureDocument();" data-dismiss="modal"
                            class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal content -->
    <!-- Modal content -->
    <div class="modal fade" id="addPCModel" role="dialog" aria-labelledby="addPCModelLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <input type="hidden" name="bill_procesure_code_id" id="bill_procesure_code_id" value="">
            <form method="POST" action="{{ route('addProcedureCode') }}" id="addProcesureCOde">
                @csrf
                <input type="hidden" name="billId" class="" id="billId_1" value="{{ $injuryBillInfo->id }}">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addPCModelLabel">Add Procedure Code</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row cloneDiv bg-light p-2 pt-0" id="input_1">
                            <div class=" col-md-2">
                                <label for="bill_procedure_code"> Procedure Code </label>
                                <input onkeyup='searchAutoForProcedureCode(event);' placeholder="Procedure Code"
                                    data-validation-event="change" data-validation="custom"
                                    data-validation-regexp ="^[a-zA-Z0-9]+(\s+[a-zA-Z0-9]+)*$"
                                    data-validation-optional="true" data-validation-error-msg=""
                                    id="bill_procedure_code_1" autocomplete="off" type="text"
                                    name="bill_procedure_code[]" value="" class="form-control procedure_code_input"
                                    maxlength="100">
                                <ul id="search_bill_procedure_code_1"
                                    class="autoCompete-css procedure_code_ul"></ul>
                                @if ($errors->has('bill_procedure_code'))
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong
                                            class="invalid-feedback">{{ $errors->first('bill_procedure_code') }}</strong>
                                    </span>
                                @endif
                                <div class=" col-md-1  cus-plus d-none" id="addition_info_icon_1"
                                    style="max-width: 2%;">
                                    <span><i class="icon-plus showPointer"
                                            onClick="showAdditionalInfoInput('addition_info_div_1');"></i></span>
                                </div>
                            </div>

                            <div class=" col-md-3">
                                <label for="bill_modifiers"> Modifiers </label>
                                <select name="bill_modifiers[]" multiple
                                    onChange='setUnitCodeOnChangeProcedureCode(event, 1)'
                                    class=" select2-original modefierCode" id="bill_modifiers1">
                                    <option value="">-Select-</option>
                                    @foreach ($modifiersArray as $modifiyer)
                                        <option value="{{ $modifiyer->id }}">{{ $modifiyer->name }}</option>
                                    @endforeach
                                </select>
                                @if ($errors->has('bill_modifiers'))
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong class="invalid-feedback">{{ $errors->first('bill_modifiers') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class=" col-md-1">
                                <label for="bill_units"> Units </label>
                                <input placeholder="Units" data-validation-event="change" data-validation="custom"
                                    data-validation-regexp ="^[0-9]+(\s+[0-9]+)*$" data-validation-optional="true"
                                    data-validation-error-msg="" autocomplete="off" id="bill_units1"
                                    type="text" name="bill_units[]" value="1" class="form-control bill_unit"
                                    maxlength="5">
                                @if ($errors->has('bill_units'))
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong class="invalid-feedback">{{ $errors->first('bill_units') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class=" col-md-6" id="childPt">
                                <label for="bill_units"> Diag Codes </label>
                                <table>
                                    <tr>
                                        <td><input placeholder="Diag Code 1" autocomplete="off" type="text"
                                                id="billDiagCodes1_1" name="bill_diag_codes1[]"
                                                value="" class="form-control bill_diag_codes1" maxlength="50"></td>
                                        <td><input placeholder="Diag Code 2" autocomplete="off" type="text"
                                                id="billDiagCodes2_1" name="bill_diag_codes2[]"
                                                value="" class="form-control bill_diag_codes2" maxlength="50"></td>
                                        <td><input placeholder="Diag Code 3" autocomplete="off" type="text"
                                                id="billDiagCodes3_1" name="bill_diag_codes3[]"
                                                value="" class="form-control bill_diag_codes3" maxlength="50"></td>
                                        <td><input placeholder="Diag Code 4" autocomplete="off" type="text"
                                                id="billDiagCodes4_1" name="bill_diag_codes4[]"
                                                value="" class="form-control bill_diag_codes4" maxlength="50"></td>
                                        <td class='removeBtn' id="remove_item_icon_1"><a
                                                href='javascript:void(0);'><i class='icon-trash'></i></a></td>
                                    </tr>
                                    <tr>
                                        <td colspan="6" class="error_msg"
                                            id="showDiagCodeError_1">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-2 pt-1 pl-0 d-none" id="addition_info_div_1">
                                <input type="text" placeholder="Additional Information" class="form-control"
                                    name="additional_information[]" id="additional_information_1"
                                    data-validation-optional="true" data-validation-event="change"
                                    data-validation="alphanumeric" data-validation-allowing="-_ ">
                                @if ($errors->has('additional_information'))
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong
                                            class="invalid-feedback">{{ $errors->first('additional_information') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="col-md-2 pt-1 pl-0">
                                <input type="text" class="form-control d-none" name="isMasterChargeFound[]"
                                    id="isMasterChargeFound1" value="">
                                <input placeholder="Unit Amount" type="text" class="form-control d-none"
                                    name="master_charge[]" id="bill_master_charge1" value="">
                            </div>
                            <div class="col-md-2 pt-1 pl-0">
                                <input type="text" class="form-control d-none" name="master_charge_id[]"
                                    id="bill_master_charge_id1" value="">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal content -->
    <!-- Modal content -->
    <div class="modal fade" id="addWriteOfLetterrForCloseBillModal" role="dialog"
        aria-labelledby="addWriteOfLetterrForCloseBillModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <form method="POST" action="{{ route('addbillWriteOfReasonForCloseBill') }}"
                id="addbillWriteOfReasonForCloseBillId">
                @csrf
                <input type="hidden" name="billId" class="" id="billId_1" value="{{ $injuryBillInfo->id }}">
                <input type="text" name="taskId" class="" id="taskIdDiv"
                    value="{{ $taskAssignInfo ? $taskAssignInfo->id : '' }}">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addWriteOfLetterrForCloseBillModalLabel">Add Reason For Bill Close
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class=" col-md-9">
                                <label for="writeOfReason">Library Bill Write Off Reason<span class="required">*
                                    </span></label>
                                <select name="bill_provider_write_of_reason" class="form-control"
                                    data-validation-event="change" data-validation="required"
                                    data-validation-error-msg="">
                                    <option value="">-Select-</option>
                                    @foreach ($providerReasonForCloseBill as $writeReason)
                                        <option value="{{ $writeReason->id }}">
                                            {{ $writeReason->reason_text ? substr($writeReason->reason_text, 0, 80) : '' }}
                                        </option>
                                    @endforeach
                                </select>
                                @if ($errors->has('bill_provider_write_of_reason'))
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong
                                            class="invalid-feedback">{{ $errors->first('bill_provider_write_of_reason') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class=" col-md-9">
                                <label for="write_of_reason_description">Description <span class="required">*
                                    </span></label>
                                <textarea id="write_of_reason_description" data-validation-event="change" data-validation="required"
                                    data-validation-error-msg="" class="form-control" rows="10" name="write_of_reason_description"> </textarea>
                                @if ($errors->has('description2'))
                                    <span class="invalid-feedback" style="display:block" role="alert"><strong
                                            class="invalid-feedback">{{ $errors->first('write_of_reason_description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Close This BIll</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- Modal content -->

@endsection

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://code.jquery.com/jquery-migrate-1.2.1.js"></script>
<script src="{{ asset('/js/bootstrap-inputmask.js') }}"></script>
<script src="{{ asset('/js/controller/master_for_all.js') }}"></script>
<script>
    $(document).ready(function() {
        showAllBillDocuments();
        callInLastDiagnosiCode();
        addMoreInputsForProcedureCode();
        hideRemoveIconFromFirstRowInPRocedureCode();
        setDignosisCodeByDivId('work_dg_code_id_1');
        $("#checkAll").change(function() {
            $("input:checkbox").prop('checked', $(this).prop("checked"));
            selectAllProcedureCode();
        });
        $('.chk').on('click', function() {
            if ($('.chk:checked').length == $('.chk').length) {
                $('#checkAll').prop('checked', true);
            } else {
                $('#checkAll').prop('checked', false);
            }
        });
        $('#addProcesureCOde').click(function(event) {
            console.log('check click in view page');
            if ($('.cloneDiv .procedure_code_ul:visible')) {
                let divUlId = $('.cloneDiv .procedure_code_ul:visible').attr('id');
                let ulInput = $('#' + divUlId).prev('.procedure_code_input').attr('id');
                //$("#"+ ulInput).val('');
                $("#" + divUlId).hide();
            }
        })
    });


    function showFaxOptionDiv(val) {
        if (val == 2) {
            $("#faxDiv").removeClass('d-none');
            $("#downloadPDFDiv").addClass('d-none');
        } else if (val == 3) {
            $("#faxDiv").addClass('d-none');
            $("#downloadPDFDiv").removeClass('d-none');
        }
    }

    function onchangeGetSecondReviewText(secondReviewId, divId) {
        $.ajax({
            url: '/get-second-review-text-by-id',
            type: 'POST',
            data: {
                _token: token,
                secondReviewId: secondReviewId
            },
            success: function(response) {
                // console.log('response',response.cities); 
                $("#secondReviewText_" + divId).html(response['reason_text']);
            },
            error: function(response) {
                alert(response.responseJSON.message);
            }
        });
    }

    function showSecondReviewDiv(billId, divId) {
        if ($("#showSecondReviewDiv_" + divId).hasClass('d-none')) {
            $("#showSecondReviewDiv_" + divId).removeClass('d-none');
            var billDivId = "#showSecondReviewDiv_" + divId;
            $(billDivId + ' input[name="secondReviewBillId[]"]').val(billId);
        } else {
            $("#showSecondReviewDiv_" + divId).addClass('d-none');
        }
        showSaveBtn();
    }

    function selectAllProcedureCode() {
        var searchIDs = $('.chk:checked').map(function() {
            return $(this).val();
        }).get();
        var lastEl = searchIDs[searchIDs.length - 1];
        console.log('#selectAllProcedureCode', lastEl);
        if ($("#showSecondReviewDiv_" + lastEl).hasClass('d-none')) {
            $("#showSecondReviewDiv_" + lastEl).removeClass('d-none');
            var billDivId = "#showSecondReviewDiv_" + lastEl;
            $(billDivId + ' input[name="secondReviewBillId[]"]').val(lastEl);
            showSaveBtn();
        } else {
            $("#showSecondReviewDiv_" + lastEl).addClass('d-none');
        }

    }

    function showSaveBtn() {
        if ($('.chk:checked').length > 0) {
            $("#sendBtnDiv").removeClass('d-none');
        } else {
            $("#sendBtnDiv").addClass('d-none');
        }
    }

    function storeSecondReview() {
        var billSbrArray = [];
        if ($('.chk:checked').length == $('.chk').length) {
            var searchIDS = $('.chk:checked').map(function() {
                return $(this).val();
            }).get();
            var lastEl = searchIDS[searchIDS.length - 1];
            $.each(searchIDS, function(key, val) {
                $("#showSecondReviewDiv_" + lastEl).each(function() {
                    var billReviewDescr = $(this).find('select[name="secondReviewDescription[]"]')
                .val();
                    var billReviewText = $(this).find('textarea[name="secondReviewText[]"]').val();
                    console.log('#billReviewText', billReviewText);
                    var serviceGood = $(this).find('input[name="service_good[]"]:checked').val();
                    var newDocumenAtttched = $(this).find(
                        'input[name="new_documen_atttched[]"]:checked').val();
                    billSbrArray.push({
                        'billId': <?php echo $injuryBillInfo->id; ?>,
                        'procesureCodeId': (val) ? parseInt(val) : null,
                        'billReviewText': billReviewText,
                        'billReviewDescr': billReviewDescr,
                        'serviceGood': serviceGood,
                        'newDocumenAtttched': newDocumenAtttched
                    });
                })
            })
        } else {
            $('tr[id^="showSecondReviewDiv_"]').each(function() {
                var billId = $(this).find('input[name="secondReviewBillId[]"]').val();
                var billReviewDescr = $(this).find('select[name="secondReviewDescription[]"]').val();
                var billReviewText = $(this).find('textarea[name="secondReviewText[]"]').val();
                console.log('#billReviewText', billReviewText);
                var serviceGood = $(this).find('input[name="service_good[]"]:checked').val();
                var newDocumenAtttched = $(this).find('input[name="new_documen_atttched[]"]:checked').val();
                billSbrArray.push({
                    'billId': <?php echo $injuryBillInfo->id; ?>,
                    'procesureCodeId': (billId) ? parseInt(billId) : null,
                    'billReviewText': billReviewText,
                    'billReviewDescr': billReviewDescr,
                    'serviceGood': serviceGood,
                    'newDocumenAtttched': newDocumenAtttched
                });
            })
        }
        console.log('#billSbrArray', billSbrArray);
        if (billSbrArray && billSbrArray.length > 0) {
            $.ajax({
                url: '/storeBillSbr',
                type: 'POST',
                data: {
                    _token: token,
                    billSbrArray: billSbrArray,
                    selectedBillId: <?php echo $injuryBillInfo->id; ?>
                },
                success: function(response) {
                    location.reload();
                    //console.log('#response', response);
                },
                error: function(response) {
                    alert(response.responseJSON.message);
                    //console.log('#responseJSON', response.responseJSON.message);
                }
            });
        }
    }

    function showNewDocumentDiv(val, billProcedureCodeId) {
        console.log('#bill_procesure_code_id', val);
        $("#bill_procesure_code_id").val(val);
    }

    function showAllBillDocuments() {
        $.ajax({
            url: "/showAllBillDocuments",
            type: "POST",
            data: {
                billId: {{ $injuryBillInfo->id }},
                _token: token
            },
            beforeSend: function() {
                $("#showBillDocuments").text('Loading');
            },
            success: function(result) {
                console.error("result", result);
                $("#showBillDocuments").html(result);
            },
            error: function(jqXHR, textStatus, errorThrown) {
                // Handle any errors here
                console.error("File upload failed:", errorThrown);
            }
        });
    }

    function pageRedirect() {
        location.reload();
    }

    function callInLastDiagnosiCode() {
        var lastDignosiId = $('input[name="work_dg_code_id[]"]').last().attr('id');
        console.log('lastDignosiId', lastDignosiId);
        $("#" + lastDignosiId).one("change", function() {
            console.log('#callInLastDiagnosiCode', lastDignosiId);
            addMoreInputsDiagnosisCode();
        });
    }

    function addMoreInputsDiagnosisCode() {
        var newNum = new Number($('.cloneDCDiv .work_dg_original:input').length + 1);
        var parentElement = $('.cloneDivDiagnosisCode:last');
        var clone = parentElement.clone().attr('id', 'dio_Code_' + newNum);
        clone.find('.work_dg_original').attr('id', 'work_dg_code_id_' + newNum);
        clone.find('.work_dg_original').select2("destroy");
        console.log('#parentElement', clone);
        clone.children().find('.work_dg_original').select2();
        //$select.select2('destroy').clone().select2(); 
        $('div .cloneDivDiagnosisCode:last').after(clone);
        var eleIdDC = $('input[name="work_dg_code_id[]"]').last().attr('id');
        $("#" + eleIdDC).one("change", function() {
            addMoreInputsDiagnosisCode();
        });
        setDignosisCodeByDivId(eleIdDC);
    }

    function setDignosisCodeByDivId(DivId) {
        console.log('#setDignosisCodeByDivId', DivId);
        $("#" + DivId).select2({
            width: '100%',
            placeholder: 'Select Diagnosis Code',
            search: true,
            ajax: {
                url: "/searchDiagnosis",
                //dataType: 'json',
                type: "POST",
                quietMillis: 50,
                data: function(term, page) {
                    return {
                        q: term, // Pass the search term as 'q' parameter
                        page: page,
                        _token: token,
                        type: 10,
                    };
                },
                processResults: function(data) {
                    if (data && data.length > 0) {
                        // Tranforms the top-level key of the response object from 'items' to 'results'
                        var results = [];
                        data.forEach(e => {
                            results.push({
                                id: e.id,
                                diagnosis_name: e.diagnosis_name,
                                diagnosis_code: e.diagnosis_code
                            });
                        });
                        return {
                            results: results,
                        };
                    }
                },
            },
            cache: true,
            formatResult: formatResult,
            formatSelection: function(item) {
                return item.diagnosis_code + "-" + item
                    .diagnosis_name; // Display the 'name' property in the input field
            },
        })
    }

    function formatResult(d) {
        if (d.loading) {
            return d.diagnosis_name;
        }
        // Creating an option of each id and text
        $d = $('<option/>').attr({
            'value': d.id
        }).text(d.diagnosis_code + "-" + d.diagnosis_name);
        return $d;
    }

    function formatRepoSelection(val) {
        if (val.text == "") {
            return val.diagnosis_code + "-" + val.diagnosis_name;
        }
    }

    function addMoreInputsForProcedureCode() {
        var getLastDiId = $('div .cloneDiv:last').attr('id');
        $('.modefierCode').select2("destroy");
        var num = $('.cloneDiv').length;
        var newNum = new Number(num + 1);
        var cloneId = 'input_' + newNum;
        var clonedRow = $('div .cloneDiv:last').clone().attr('id', cloneId);
        clonedRow.find('.procedure_code_input').attr('id', 'bill_procedure_code_' + newNum);
        clonedRow.find('.procedure_code_input').one('click', function() {
            addMoreInputsForProcedureCode();
        });
        clonedRow.find('.modefierCode').attr('id', 'bill_modifiers' + newNum);
        clonedRow.find('.bill_unit').attr('id', 'bill_units' + newNum);
        clonedRow.find('.bill_diag_codes1').attr('id', 'billDiagCodes1_' + newNum);
        clonedRow.find('.bill_diag_codes2').attr('id', 'billDiagCodes2_' + newNum);
        clonedRow.find('.bill_diag_codes3').attr('id', '"billDiagCodes3_' + newNum);
        clonedRow.find('.bill_diag_codes4').attr('id', 'billDiagCodes4_' + newNum);

        clonedRow.find('.master_charge_found').attr('id', 'isMasterChargeFound_' + newNum);
        clonedRow.find('.master_charge').attr('id', 'bill_master_charge_id' + newNum);

        clonedRow.find('.procedure_code_ul').attr('id', 'search_bill_procedure_code_' + newNum);
        clonedRow.find('.error_msg').attr('id', 'showDiagCodeError_' + newNum);
        clonedRow.find('.removeBtn').attr('id', 'remove_item_icon_' + newNum);
        clonedRow.find('.removeBtn').on('click', function() {
            removeProcedureCode('remove_item_icon_' + newNum);
        });
        hideRemoveIconFromFirstRowInPRocedureCode();
        $('div .cloneDiv:last').after(clonedRow);
        setModifiyerDop();
    }

    function hideRemoveIconFromFirstRowInPRocedureCode() {
        var divLen = $('div .cloneDiv').length;
        var geFirstDiId = $('div .cloneDiv .removeBtn:first').attr('id');
        if (divLen >= 2) {
            $("#" + geFirstDiId).addClass('d-none');
        } else {
            $("#" + geFirstDiId).removeClass('d-none');
        }
    }

    function setModifiyerDop() {
        $('.select2-original').select2({
            //minimumInputLength: 1,
            width: '100%',
            placeholder: 'Select Modifier',
            search: true,
        })
    }

    function searchAutoForProcedureCode(e) {
        //$('.autoCompete-css').show();  
        let searchPC = e.target.value;
        let searchPCId = e.target.id;
        console.log('#searchPCId#', searchPCId);
        let ex = searchPCId.split("_");
        let lastItem = ex[ex.length - 1];
        console.log('#lastItem', lastItem);
        var pcInputId = 'bill_procedure_code_' + lastItem;
        var ulLiId = 'search_bill_procedure_code_' + lastItem;

        console.log('#pcInputId#', pcInputId);
        console.log('#ulLiId#', ulLiId);
        if (searchPC.length > 2) {
            $.ajax({
                url: '/searchProcedureCodeForAutoSearch',
                type: 'POST',
                dataType: 'json', // payload is json
                data: {
                    _token: token,
                    injuryId: {{ $injuryBillInfo->getInjury ? $injuryBillInfo->getInjury->id : null }},
                    str: searchPC,
                },
                success: function(data) {
                    if (data.length > 0) {
                        var items = "";
                        items += "<li value=''>-Select-</li>";
                        $.each(data, function(i, item) {
                            var pCode = item.procedure_code;
                            items +=
                                `<li onclick="chooseSelectedPrcedureCode(event, ${pcInputId},  ${ulLiId},  '${pCode}');" data-id-clicked="${item.id}"  id="${item.id}">` +
                                item.procedure_code + `</li>`;
                        });
                        $("#" + ulLiId).html(items);
                        $("#" + ulLiId + '.autoCompete-css').show();
                    }

                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.error('AJAX Error:', textStatus, errorThrown);
                }

            })
        }
    }

    function chooseSelectedPrcedureCode(event, selectedInput, ulLiId, procedure_code) {
        var selectElementPC = $(selectedInput);
        var selectElementUL = $(ulLiId);
        $("#" + selectElementPC.attr('id')).val(procedure_code);
        $("#" + selectElementUL.attr('id') + '.autoCompete-css').hide();
        setTimeout(function() {
            setUnitCodeOnChangeProcedureCode(event, 0);
        }, 3000);
    }

    function setUnitCodeOnChangeProcedureCode(event, length) {
        if (event.target.id) {
            console.log('#eventID', event.target.id);
            str = event.target.id.split('_');
            let lastId = str[3];
            if ($("#" + event.target.id).val().length > 0) {
                $("#addition_info_icon_" + lastId).removeClass('d-none');
            } else {
                $("#addition_info_icon_" + lastId).addClass('d-none');
                $("#addition_info_div_" + lastId).addClass('d-none');
            }
            parentDiv = $("#" + event.target.id).closest('div').parent('div .cloneDiv').attr('id');
            var data = checkprocedureCode(parentDiv);
            console.log('divId#', data.modefiyerId);
            getCPDCodeBeforeSave(data.injuryId, data.modefiyer, data.prCode, data.divId);
        }
    }

    function checkprocedureCode(divId) {
        var prCode = null;
        prCode = $("#" + divId + ' input[name="bill_procedure_code[]"]').val();
        prCodeId = $("#" + divId + ' input[name="bill_procedure_code[]"]').attr('id');
        var modefiyer = null;
        modefiyer = $("#" + divId + ' select[name="bill_modifiers[]"]').val();
        modefiyerId = $("#" + divId + ' select[name="bill_modifiers[]"]').attr('id');
        // Return the necessary data
        return {
            modefiyerId: modefiyerId,
            injuryId: {{ $injuryBillInfo->getInjury ? $injuryBillInfo->getInjury->id : null }},
            modefiyer: modefiyer,
            prCode: prCode,
            divId: divId
        };
    }

    function getCPDCodeBeforeSave(injuryId, modefiyer, prCode, divId) {
        $.ajax({
            url: '/searchProcedureCodeForUnit',
            type: 'POST',
            dataType: 'json', // payload is json
            data: {
                _token: token,
                injuryId: injuryId,
                modefiyer: modefiyer,
                prCode: prCode
            },
            success: function(data) {
                if (data.length > 0) {
                    $("#" + divId + ' input[name="master_charge[]"]').removeClass('d-none');
                    $("#" + divId + ' input[name="master_charge_id[]"]').val(data[0]['id']);
                    $("#" + divId + ' input[name="master_charge[]"]').val(data[0]['units']);
                    $("#" + divId + ' input[name="isMasterChargeFound[]"]').val(0);

                } else {
                    $("#" + divId + ' input[name="master_charge[]"]').removeClass('d-none');
                    $("#" + divId + ' input[name="master_charge_id[]"]').val("");
                    $("#" + divId + ' input[name="master_charge[]"]').val("");
                    $("#" + divId + ' input[name="isMasterChargeFound[]"]').val(1);
                }
            },
            error: function(jqXHR, textStatus, errorThrown) {
                console.error('AJAX Error:', textStatus, errorThrown);
            }

        })
    }

    function checkAction() {
        console.log('#checkAction');
        var checkedRadio = $('.sendType:checked').map(function() {
            return $(this).val();
        }).get();
        let actionUrl = '';
        if (checkedRadio[0] == 1 || checkedRadio[0] == 2) {
            actionUrl = '/bill/sent/to/provider';
        } else {
            actionUrl = '/genrateAndDownloadBillPacketForSend';
        }
        $.ajax({
            url: actionUrl,
            type: "POST",
            data: $("#billSendFrm").serialize(),
            beforeSend: function() {
                $("#showPdfUrLoad").removeClass('d-none');
            },
            success: function(pdfUrl) {
                $("#showPdfUrLoad").addClass('d-none')
                $("#showPdfUrl").removeClass('d-none').attr("href", pdfUrl).append(pdfUrl).addClass(
                    'showPointer');
                $("#sendBtnId").removeAttr("disabled");

            },
            error: function(jqXHR, textStatus, errorThrown) {
                // Handle any errors here
                console.error("File upload failed:", errorThrown);
            }
        });
    }

    function submitPacketPdf() {
        var pdfFileURL = $("#showPdfUrl").attr("href");
        console.log('#pdfFileURL', pdfFileURL);
        $.ajax({
            url: '/downloadPdfForBill',
            type: "POST",
            data: $("#billSendFrm").serialize(),
            beforeSend: function() {
                $("#showPdfUrLoad").removeClass('d-none');
            },
            success: function(pdfUrl) {
                var $downloadLink = $('<a></a>').attr('href', pdfFileURL).attr('download', new Date()
                    .getTime() + ".pdf").css('display', 'none');
                // Append the anchor element to the document body.
                $('body').append($downloadLink);
                // Trigger a click event on the hidden anchor link.
                $downloadLink[0].click();
                // Remove the anchor element from the DOM (optional).
                $downloadLink.remove();
                window.setTimeout(function() {
                    //$('#addSubmissionModal').modal('hide');
                    location.reload();
                }, 500);

            },
            error: function(jqXHR, textStatus, errorThrown) {
                // Handle any errors here
                console.error("File upload failed:", errorThrown);
            }
        });
        // Create a hidden anchor element with the PDF file URL.
    }

    function deleteBillInfo(billId, injuryId) {
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
                popup: 'swal-wide',
            }
        }).then((result) => { // Use .then() to handle the user's response
            if (result.isConfirmed) { // Only proceed if the user clicked the confirm button
                let _url = '/patient/bill/delete';
                $.ajax({
                    url: _url,
                    type: 'POST',
                    data: {
                        _token: token,
                        id: billId
                    },
                    success: function(response) {
                        window.location.replace("/injury/view/" + injuryId);
                    },
                    error: function(response) {
                        swal.fire(response.responseJSON.message, '', 'error');
                    }
                });
            }
        });
    }
</script>
