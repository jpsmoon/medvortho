@extends('layouts.home-app')
@section('content')
    <style type="text/css"> 
        .hiddenContent {
            display: none;
        }

        .flag-wrapper:after {
            padding-top: 0% !important;
        }

        .setTpPaddeing {
            top: 75px !important;
        }

        .input-icons i {
            position: absolute;
        }

        .input-icons input {
            width: 100%;
            margin-bottom: 10px;
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
            margin-bottom: 0.75rem;
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

        .diagCode .card-header {
            background-color: #FFFFFF !important;
        }

        .modal {
            pointer-events: none;
        }

        .modal-dialog {
            pointer-events: all;
        }
        
        .list-group-item
        {
        position: relative;
        display: block;
        padding: 0rem; 
        margin-bottom: -1px;
        background-color: #FFF;
        border: 1px solid #E4E7ED;
        }
    </style>
    <!-- START: Modal popup css-->
    <link rel="stylesheet" type="text/css" href="{{ url('new_assets/app-assets/css/modal-popup.css') }}">
    <!-- END: Modal popup css-->
    @inject('testPatientClass', 'App\Http\Controllers\PatientController')
    <!-- START: Breadcrumbs-->
    <div clas s="row ">
        <div class="col-12  align-self-center">
            <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                <div class="w-sm-100 mr-auto col-9">
                    <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                        <li class="breadcrumb-item">
                            <h2><svg xmlns="http://www.w3.org/2000/svg" width="30px" height="30px" viewBox="0 0 34 34"
                                    class="left">
                                    <title>icon_patient</title>
                                    <path
                                        d="M20.983 16.793L19.32 23.2h-1.857c-.825.017-1.48.654-1.463 1.425l.005.21c.017.758.682 1.365 1.495 1.365h5.147c.977 0 1.829-.617 2.07-1.5l.269-.977a.392.392 0 0 0 .014-.104c0-.231-.2-.418-.448-.418h-.753l-1.085-6.853c.258.077.501.185.73.324.517.314.933.72 1.248 1.216.314.497.573 1.094.777 1.791.203.698.343 1.39.418 2.079.075.688.113 1.42.113 2.194 0 .993-.277 1.846-.83 2.557-.553.71-1.22 1.066-1.999 1.066H11.83c-.78 0-1.446-.355-1.999-1.066-.553-.711-.83-1.564-.83-2.557 0-.775.038-1.506.113-2.194.075-.689.215-1.381.418-2.079.204-.697.463-1.294.777-1.79.315-.497.73-.903 1.249-1.217.518-.315 1.113-.472 1.786-.472 1.16 1.167 2.546 1.75 4.157 1.75 1.31 0 2.472-.386 3.483-1.157zm-.58 6.623l1.423-5.602.791 5.602h-2.213zM22.5 12c0 1.38-.488 2.559-1.465 3.535C20.06 16.512 18.88 17 17.5 17c-1.38 0-2.559-.488-3.535-1.465C12.988 14.56 12.5 13.38 12.5 12c0-1.38.488-2.559 1.465-3.535C14.94 7.488 16.12 7 17.5 7c1.38 0 2.559.488 3.535 1.465C22.012 9.44 22.5 10.62 22.5 12z"
                                        fill="#3A3A3A" fill-rule="evenodd"></path>
                                </svg>
                                Injury Information</h2>
                        </li>
                    </ol>
                </div>
                <div align="right" class="w-sm-100 mr-auto col-3">
                    <ul class="list-inline">
                        <li class="list-inline-item">
                            <i class=""></i>
                            <a class="btn btn-primary" href="{{ url('/edit/patients/injury/') }}/{{ $injuryId }}">
                                <i class="icon-pencil"></i> Edit</a>
                        </li>
                        <li class="list-inline-item">
                            <a class="btn btn-primary" href="{{ url('/patients/view', $patientId) }}"> Back</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Breadcrumbs-->

    <div class="row font">
        <div class="col-9 mt-4" style="padding-right: 0px;">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12" id="patient_info">
                            <ul class="sub-menu list-inline chat-menu">
                                <li class="list-inline-item liItem billbutton">
                                    <div class="text-center p-1 border">
                                        <div class="flag-wrapper bottom-border" style="width: 100% !important;">
                                            <div><a href="#" class="font-bold">Bills {{ ($pInjuries && $pInjuries->getInjuryBills) ? '( '.count($injury->getInjuryBills). ' )' : ''}}</a></div>
                                        </div>
                                        <ul class="sub-menu list-inline">
                                            <li class="list-inline-item liItem"><a class="bold"
                                                    href="{{ url('/add/injury/bill') }}/{{ $injuryId }}">Add</a></li>
                                            <li class="list-inline-item liItem">|</li>
                                            <li class="list-inline-item liItem"><a class="bold"
                                                    href="{{ url('/view/patient/injury/bill') }}/{{ $injuryId }}">View</a>
                                            </li> 
                                        </ul>
                                    </div>
                                </li>
                                <li class="list-inline-item liItem billbutton">
                                    <div class="text-center p-1 border">
                                        <div class="flag-wrapper bottom-border" style="width: 100% !important;">
                                            <div><a href="#" class="font-bold">RFAs</a></div>
                                        </div>
                                        <ul class="sub-menu list-inline">
                                            <li class="list-inline-item liItem"><a class="bold" href="javascript:void(0)"
                                                    data-toggle="modal" data-target="#mycontactForm">Add</a></li>
                                            <li class="list-inline-item liItem ">|</li>
                                            <li class="list-inline-item liItem"><a class="bold"
                                                    href="{{ url('/view/patient/injury/bill') }}/{{ $injuryId }}">View</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>

                                <li class="list-inline-item liItem billbutton">
                                    <div class="text-center p-1 border">
                                        <div class="flag-wrapper bottom-border" style="width: 100% !important;">
                                            <div><a href="#" class="font-bold">Paper SBRs</a></div>
                                        </div>
                                        <ul class="sub-menu list-inline">
                                            <li class="list-inline-item liItem"><a class="bold"
                                                    href="{{ url('/patients/injury/sbr') }}/{{ $injuryId }}">Add</a>
                                            </li>
                                            <li class="list-inline-item liItem ">|</li>
                                            <li class="list-inline-item liItem "><a class="bold"
                                                    href="{{ url('/view/patient/injury/bill') }}/{{ $injuryId }}">View</a>
                                            </li>
                                        </ul>
                                    </div>
                                </li>
                                @if($pInjuries && count($pInjuries->getInjuryBills) > 0)
                                 <li class="list-inline-item liItem billbutton">
                                    <div class="text-center p-1 border">
                                        <div class="flag-wrapper bottom-border" style="width: 100% !important;">
                                            <div><a href="#" class="font-bold">Letters</a></div>
                                        </div>
                                        <ul class="sub-menu list-inline">
                                            <li class="dropdown open"><a data-toggle="dropdown" class="dropdown-toggle" aria-expanded="true"> View<span class="caret"></span></a>
                                                <ul class="dropdown-menu" style="width:184px!important">
                                                    <li><a href="{{ url('/view/bill/letter/sbr') }}/{{ $patientId }}">SBR Letter</a></li>
                                                    <li><a href="{{ url('/view/bill/letter/rfa') }}/{{ $patientId }}">RFA Letter</a></li>
                                                    <li><a href="{{ url('/view/bill/letter/resubmission') }}/{{ $patientId }}">Re-Submission Letter</a></li>
                                                    <li><a href="{{ url('/view/bill/letter/pr2') }}/{{ $patientId }}">PR2 Letter</a></li>
                                                    <li><a href="{{ url('/view/bill/letter/demand') }}/{{ $patientId }}" data-toggle="dropdown" class="dropdown-toggle">Demands<span class="caret"></span></a> </li><li>
                                                    <li><a href="{{ url('/view/bill/letter/authorization') }}/{{ $patientId }}" data-toggle="dropdown" class="dropdown-toggle">AUTHORIZATION <span class="caret"></span></a></li>
                                                </ul>
                                            </li>
                                          </ul>
                                    </div>
                                </li>
                                @endif
                            </ul>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Injury Information - Required</h4>
                                        </div>
                                        @if (isset($pInjuries->getInjuryClaim))
                                            <table class="table font">
                                                <tr>
                                                    <td width="50%"><b>Employer</b></td>
                                                    <td width="50%">
                                                        {{ $pInjuries->getInjuryClaim->employer_name ? $pInjuries->getInjuryClaim->employer_name : 'NA' }}
                                                    </td>
                                                </tr>
                                                @if (isset($pInjuries->getInjuryClaim->emp_address_line1))
                                                    <tr>
                                                        <td width="50%"><b>Employer Address #{{ $fullAddress }}#</b>
                                                        </td>
                                                        <td width="50%">
                                                            {{ $pInjuries->getInjuryClaim->emp_address_line1 ? $pInjuries->getInjuryClaim->emp_address_line1 : '' }}
                                                            {{ $pInjuries->getInjuryClaim->emp_address_line2 ? $pInjuries->getInjuryClaim->emp_address_line2 : '' }}
                                                        </td>
                                                    </tr>
                                                @endif
                                                <tr>
                                                    <td width="50%"><b>DOI</b></td>
                                                    <td width="50%">
                                                        {{ $pInjuries->getInjuryClaim && $pInjuries->getInjuryClaim->start_date && $pInjuries->getInjuryClaim->start_date != ' ' ? date('m/d/Y', strtotime($pInjuries->getInjuryClaim->start_date)) : '' }}
                                                        {{ $pInjuries->getInjuryClaim && $pInjuries->getInjuryClaim->end_date && $pInjuries->getInjuryClaim->end_date != ' ' ? date('m/d/Y', strtotime($pInjuries->getInjuryClaim->end_date)) : '' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="50%"><b>Claim Number</b></td>
                                                    <td width="50%">
                                                        {{ $pInjuries->getInjuryClaim->claim_no ? $pInjuries->getInjuryClaim->claim_no : 'NA' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="50%"><b>Claims Administrator</b></td>
                                                    <td width="50%" <a class="text-primary showPointer" href="javascript:void(0)" id="myBtn"  data-toggle="modal" data-target="#claimAdministratorModalId">
                                                         {{ $pInjuries->getInjuryClaim->getClaimAdmin ? $pInjuries->getInjuryClaim->getClaimAdmin->name : 'NA' }}
                                                        </a>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="50%"><b>Payer</b></td>
                                                    <td width="50%">
                                                        {{ $pInjuries->getInjuryClaim->payer_id ? $pInjuries->getInjuryClaim->payer_id : 'NA' }}
                                                    </td>
                                                </tr>
                                                

                                                <!--<tr>-->
                                                <!--    <td width="50%"><b>Claim Status Date</b></td>-->
                                                <!--    <td width="50%">-->
                                                <!--        {{ $pInjuries->getInjuryClaim->claim_status_date ? date('m/d/Y', strtotime($pInjuries->getInjuryClaim->claim_status_date)) : 'NA' }}-->
                                                <!--    </td>-->
                                                <!--</tr>-->
                                                <tr>
                                                    <td width="50%"><b>Injury State</b></td>
                                                    <td width="50%">  {{ ($pInjuries->injury_state_id) ? strtoupper( substr( $pInjuries->injury_state_id, 0, 2 ) ) : 'NA' }}
                                                    </td>
                                                </tr>
                                            </table>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">Injury Information - Optional</h4>
                                        </div>
                                        @if (isset($pInjuries->getInjuryClaim))
                                            <?php $fullAddress = 'NA'; ?>
                                            @if (isset($pInjuries->getInjuryClaim->emp_address_line1))
                                                <?php $fullAddress = $pInjuries->getInjuryClaim->emp_address_line1; ?>
                                            @endif
                                            @if ($pInjuries->getInjuryClaim->emp_address_line1 != '' && $pInjuries->getInjuryClaim->emp_address_line2 != '')
                                                <?php $fullAddress = $pInjuries->getInjuryClaim->emp_address_line1 . ' , ' . $pInjuries->getInjuryClaim->emp_address_line2; ?>
                                            @endif
                                            <table class="table font">
                                                <tr>
                                                    <td width="50%"><b>ADJ Number</b></td>
                                                    <td width="50%">
                                                        {{ $pInjuries->getInjuryClaim->adj_no ? $pInjuries->getInjuryClaim->adj_no : 'NA' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="50%"><b>Claim Status</b></td>
                                                    <td width="50%">
                                                        {{ $pInjuries->getInjuryClaim ? $pInjuries->getInjuryClaim->claim_status_id : 'NA' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="50%"><b>Claim Status Date</b></td>
                                                    <td width="50%">
                                                        {{ $pInjuries->getInjuryClaim->claim_status_date ? date('m/d/Y', strtotime($pInjuries->getInjuryClaim->claim_status_date)) : 'NA' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="50%"><b>ADJ Number</b></td>
                                                    <td width="50%">
                                                        {{ $pInjuries->getInjuryClaim->adj_no ? $pInjuries->getInjuryClaim->adj_no : 'NA' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="50%"><b>Medical Provider Network</b></td>
                                                    <td width="50%">
                                                        {{ $pInjuries->getInjuryClaim->getMedicalProvider ? $pInjuries->getInjuryClaim->getMedicalProvider->applicant_name : 'NA' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="50%"><b>Practice Internal ID</b></td>
                                                    <td width="50%">
                                                        {{ $pInjuries->getInjuryClaim->newInjuryClaim ? $pInjuries->getInjuryClaim->newInjuryClaim : 'NA' }}
                                                    </td>
                                                </tr>

                                            </table>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    @if ($pInjuries->getInjuryClaim)
                                        <div class="card">
                                            <div class="card-header">Diagnosis Codes</div>
                                            <div class="card-body">
                                                <div class="row">
                                                    @foreach ($pInjuries->getInjuryClaim->getInjuryDianoses as $diagCode)
                                                        <div class="col-sm-4">
                                                            @if ($diagCode->getDianoses)
                                                                <div class="card diagCode">
                                                                    <div class="card-header">
                                                                        <div class="row">
                                                                            <div class="col-sm-10">
                                                                                {{ $diagCode->getDianoses->diagnosis_code }}
                                                                            </div>
                                                                            <div class="col-sm-2">
                                                                                <a href="javascript:void(0)"
                                                                                    onclick="passSelectedDignosisCOde({{ $diagCode->getDianoses }})"
                                                                                    data-toggle="modal"
                                                                                    data-target="#injuryDiagnosisCodeDiv{{ $diagCode->getDianoses->id }}">
                                                                                    <i
                                                                                        class="icon-pencil  showPointer" /></i></a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card-body">
                                                                        {{ $diagCode->getDianoses->diagnosis_name }}
                                                                    </div>
                                                                </div>
                                                                <!-- START: Diagonis Code Modal Popup -->
                                                                <div id="injuryDiagnosisCodeDiv{{ $diagCode->getDianoses->id }}"
                                                                    class="modal fade" role="dialog"
                                                                    style="padding-top:50px !important">
                                                                    <form method="post"
                                                                        action="{{ url('/patient/injury/diagnosis/code/add/update') }}"
                                                                        enctype="multipart/form-data"
                                                                        id="patientInjuryContactFrm">
                                                                        <div class="modal-dialog" role="document">
                                                                            <div class="modal-header text-center">
                                                                                <div>
                                                                                    <h4 class="modal-title">
                                                                                        <center>Update Diagnosis Code
                                                                                        </center>
                                                                                    </h4>
                                                                                </div>
                                                                                <div><button type="button"
                                                                                        style="color:#FFFFFF"
                                                                                        class="close"
                                                                                        data-dismiss="modal">&times;</button>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                @csrf
                                                                                <input type="hidden"
                                                                                    name="injury_claim_id"
                                                                                    id="injury_claim_id"
                                                                                    value="{{ $pInjuries->getInjuryClaim->id }}">
                                                                                <input type="hidden" name="injuryId"
                                                                                    id="injuryId"
                                                                                    value="{{ $injuryId }}">
                                                                                <input type="hidden" name="dignosisId"
                                                                                    id="dignosisId"
                                                                                    value="{{ $diagCode->id }}">
                                                                                <div class="col-md-12" id="">
                                                                                    <select name="work_dg_code_id"
                                                                                        class="form-control diagnosesCode"
                                                                                        id="work_dg_code_id_{{ $diagCode->getDianoses->id }}">

                                                                                    </select>
                                                                                    @if ($errors->has('work_dg_code_id'))
                                                                                        <span class="invalid-feedback"
                                                                                            style="display:block"
                                                                                            role="alert">
                                                                                            <strong
                                                                                                class="invalid-feedback">{{ $errors->first('work_dg_code_id') }}</strong>
                                                                                        </span>
                                                                                    @endif
                                                                                </div>
                                                                                <div class="col-md-12">
                                                                                    <div class="form-group col-md-4">
                                                                                        <button type="submit"
                                                                                            class="btn btn-primary ladda-button"><span
                                                                                                class="ladda-label">Submit</span></button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                                <!-- END: Diagonis Code Modal Popup-->
                                                            @endif
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-sm-12"> 
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        Notes
                                                        ({{ ($pInjuries && $pInjuries->getInjuryNotes && count($pInjuries->getInjuryNotes) > 0 )  ? count($pInjuries->getInjuryNotes) : 0 }})
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <a class="bold" href="javascript:void(0)" data-toggle="modal"
                                                            data-target="#injurynotes"
                                                            onclick="updateInjuryNote(null)">Add Note</a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-body">
                                                @if ($pInjuries && $pInjuries->getInjuryNotes && count($pInjuries->getInjuryNotes) > 0)
                                                    <div class="table-responsive">
                                                        <table id="example"
                                                            class="table layout-secondary dataTable table-striped table-bordered">
                                                            <thead class="thead-dark">
                                                                <tr>
                                                                    <th scope="col">Date</th>
                                                                    <th scope="col">User</th>
                                                                    <th scope="col">Note</th>
                                                                    <th scope="col">Bill History Display</th>
                                                                    <th>Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @if (count($pInjuries->getInjuryNotes))
                                                                    @foreach ($pInjuries->getInjuryNotes as $note)
                                                                        <tr>
                                                                            <td>{{ $note->created_at ? date('m-d-Y', strtotime($note->created_at)) : 'NA' }}
                                                                            </td>
                                                                            <td>{{ $note->getUser ? $note->getUser->name : 'NA' }}
                                                                            </td>
                                                                            <td>{{ $note->adjuster_name }}</td>
                                                                            <td>{{ $note->bill_history == 1 ? 'Yes' : 'No' }}
                                                                            </td>
                                                                            <td>
                                                                                <a href="javascript:void(0)"
                                                                                    data-toggle="modal"
                                                                                    data-target="#injurynotes"
                                                                                    onclick="updateInjuryNote({{ $note }})"><i
                                                                                        class="icon-pencil  showPointer" /></i></a>
                                                                                <a href="javascript:void(0)"
                                                                                onclick="deleteInjuryContact({{ $note->id }}, {{ $injuryId }}, 'NOTE')" ><i
                                                                                        class="icon-trash showPointer" /></i></a>
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
                                                @endif
                                            </div>
                                        </div> 
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-header">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    Documents
                                                    ({{ ($pInjuries && $pInjuries->getInjuryDocuments && count($pInjuries->getInjuryDocuments) > 0 ) ? count($pInjuries->getInjuryDocuments) : 0 }})
                                                </div>
                                                <div class="col-sm-6">
                                                    <a class="bold"
                                                        href="{{ url('/patients/injury/documents') }}/{{ $injuryId }}/Injury">Add
                                                        Documents</a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-body">
                                            @if (count($pInjuries->getInjuryDocuments))
                                            <div class="table-responsive">
                                                <table id="example" class="table layout-secondary dataTable table-striped table-bordered">
                                                        <thead class="thead-dark">
                                                            <tr>
                                                                <th scope="col">Date</th>
                                                                <th scope="col">User</th>
                                                                <th scope="col">Description</th>
                                                                <th scope="col">Document</th>
                                                                <th scope="col">Report Type</th>
                                                                <th scope="col">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody> 
                                                            @foreach ($pInjuries->getInjuryDocuments as $document)
                                                                <?php $i = 0;
                                                                $fileName = $document->injury_document; ?>
                                                                <tr>
                                                                    <td>{{ $document->created_at ? date('m-d-Y', strtotime($document->created_at)) : 'NA' }}
                                                                    </td>
                                                                    <td>{{ $document->getUser ? $document->getUser->name : 'NA' }}
                                                                    </td>
                                                                    <td>{{ $document->description }}</td>
                                                                    <td><a href="{{ asset('/injury_document/' . $document->injury_document) }}"
                                                                            target="_blank">{{ $fileName }}</a>
                                                                    </td>
                                                                    <td>{{ $document->getReportType ? $document->getReportType->report_name : '-' }}
                                                                    </td>
                                                                    <td>
                                                                        <a
                                                                            href="{{ url('/patients/injury/documents') }}/{{ $injuryId }}/Injury/{{ $document->id }}"><i
                                                                                class="icon-pencil  showPointer" /></i></a>
                                                                        <a href="javascript:void(0)" onclick="deleteInjuryContact({{ $document->id }}, {{ $injuryId }}, 'DOCUMENT')"><i
                                                                                class="icon-trash showPointer" /></i></a>
                                                                    </td>
                                                                </tr>
                                                            @endforeach  
                                                    </tbody>
                                                </table>
                                            </div>
                                            @endif
                                        </div>
                                    </div> 
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    @if ($pInjuries->getInjuryContacts)
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        Contacts
                                                        ({{ ($pInjuries  && $pInjuries->getInjuryContacts && count($pInjuries->getInjuryContacts) > 0 ) ? count($pInjuries->getInjuryContacts) : 0 }})
                                                    </div>
                                                    <div class="col-sm-6">
                                                        <a class="bold" href="javascript:void(0)" data-toggle="modal"
                                                            data-target="#injuryContactDiv">Add Contact</a>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="card-body">
                                                <div class="row">
                                                    @if ($pInjuries && $pInjuries->getInjuryContacts && count($pInjuries->getInjuryContacts))
                                                        @foreach ($pInjuries->getInjuryContacts as $contact)
                                                            @php
                                                                $filterBy = $contact->contact_role_id;
                                                                $key = array_search($filterBy, array_column($contactRoles, 'id'));
                                                                $selectedRole = $contactRoles[$key];
                                                            @endphp
                                                            <div class="col-sm-6">
                                                                <div class="card">
                                                                    <div class="card-header">
                                                                        <div class="row">
                                                                            <div class="col-sm-10">
                                                                                {{ ($selectedRole && count($selectedRole) > 0)  ? $selectedRole['name'] : '-' }}
                                                                            </div>
                                                                            <div class="col-sm-2">
                                                                                <a class="bold"
                                                                                    href="javascript:void(0)"
                                                                                    data-toggle="modal"
                                                                                    data-target="#injuryContactDiv"
                                                                                    onclick="updateContact({{ $contact }});"><i
                                                                                        class="icon-pencil  showPointer" /></i></a>
                                                                                <a href="javascript:void(0)" onclick="deleteInjuryContact({{ $contact->id }}, {{ $injuryId }}, 'CONTACT')"><i class="icon-trash showPointer" /></i></a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="card-body">
                                                                        @if ($contact->first_name)
                                                                            <ul class="list-inline">
                                                                                <li class="list-inline-item">
                                                                                    <b>First/Last Name</b>
                                                                                </li>
                                                                                <li class="list-inline-item">
                                                                                    {{ $contact->first_name . '  ' . $contact->last_name }}
                                                                                </li>
                                                                            </ul>
                                                                        @endif
                                                                        <ul class="list-inline">
                                                                            <li class="list-inline-item">
                                                                                <b>Company</b>
                                                                            </li>
                                                                            <li class="list-inline-item">
                                                                                {{ $contact->company }}
                                                                            </li>
                                                                        </ul>
                                                                        <ul class="list-inline">
                                                                            <li class="list-inline-item">
                                                                                <b>Email</b>
                                                                            </li>
                                                                            <li class="list-inline-item">
                                                                                {{ $contact->email }}
                                                                            </li>
                                                                        </ul>
                                                                        <ul class="list-inline">
                                                                            <li class="list-inline-item">
                                                                                <b>Phone Number</b>
                                                                            </li>
                                                                            <li class="list-inline-item">
                                                                                {{ $contact->phone_number }}
                                                                            </li>
                                                                        </ul>
                                                                        <ul class="list-inline">
                                                                            <li class="list-inline-item">
                                                                                <b>Fax</b>
                                                                            </li>
                                                                            <li class="list-inline-item">
                                                                                {{ $contact->fax_number }}
                                                                            </li>
                                                                        </ul>
                                                                        <ul class="list-inline">
                                                                            <li class="list-inline-item">
                                                                                <b>Address</b>
                                                                            </li>
                                                                            <li class="list-inline-item">
                                                                                {{ $contact->address_line1 . ' ' . $contact->address_line2 . ' ' . $contact->zip_code . ' ' . $contact->city . ' ' . $contact->state }}
                                                                            </li>
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12"> 
                                    @if ($pInjuries && $pInjuries->getInjuryHistory && count($pInjuries->getInjuryHistory))
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
                                                             @foreach ($pInjuries->getInjuryHistory as $history)
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
        <div class="col-3 mt-4" style="z-index: 0; padding-left: 0;padding-right: 0;">
            <div class="card">
                @include('patients.show-patient-info')
            </div>
        </div>
    </div>

    <!-- START: Injury Notes Modal Popup -->
    <div id="injurynotes" class="modal fade" role="dialog" style="padding-top:150px !important">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div id="injuryDiv" class="modal-content" style="width:584px; height:262px;">
                <div class="modal-header text-center">
                    <div>
                        <h4 class="modal-title">
                            <center id="injuryNoteTitle"></center>
                        </h4>
                    </div>
                    <div><button type="button" style="color:#FFFFFF" class="close"
                            data-dismiss="modal">&times;</button></div>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <section class="section">
                            <div class="row">
                                <!--Grid column-->
                                <div class="col-md-11 col-xl-11" style="margin-left:5%">
                                    <form method="post" action="{{ url('/patientinjuries/note/create') }}"
                                        enctype="multipart/form-data" id="patientInjuryNoteFrm">
                                        @csrf
                                        <input type="hidden" name="injuryNoteId" id="injuryNoteId" value="">
                                        <input type="hidden" name="injuryId" id="injuryId"
                                            value="{{ $injuryId }}">
                                        <!-- service-form -->
                                        <div class="service-form">
                                            <div class="row">
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                    <span class="text-danger" id="final_msg"></span>
                                                </div>
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                    <div class="form-group service-form-group">
                                                        <label for="ins_authinfo">Adjustor Name</label>
                                                        <textarea data-validation-event="change" data-validation="required" data-validation-error-msg="" id="address"
                                                            name="address" type="text" rows="4" class="form-control"></textarea>
                                                        @if ($errors->has('address'))
                                                            <span class="invalid-feedback" style="display:block"
                                                                role="alert">
                                                                <strong>{{ $errors->first('address') }}</strong>
                                                            </span>
                                                        @endif
                                                    </div>
                                                </div>

                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                    <div class="form-group service-form-group" style="margin-top:12px;">
                                                        <input type="checkbox" id="billHistory" name="billHistory"
                                                            value="1">
                                                        <label for="billHistory">Bill History - Display Injury
                                                            Note?</label>
                                                    </div>
                                                </div>

                                                <div align="center"
                                                    class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                    <button type="sumit" name="submitbtn" id="submitbtn"
                                                        class="btn btn-sm btn-primary btn-Font"
                                                        style="width: 100px;height: 50px">Add </button>

                                                    <button type="button" class="btn btn-sm btn-primary btn-Font"
                                                        style="width: 100px;height: 50px" class="close"
                                                        data-dismiss="modal">Cancel</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!--Grid column-->
                            </div>
                        </section>
                    </div>
                </div>
                <!--<div class="modal-footer">-->
                <!--  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                <!--</div>-->
            </div>

        </div>
    </div>
    <!-- END: Injury Notes Modal Popup-->
    <!-- START: RFAs Modal Popup -->
    <div id="mycontactForm" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content" id="responsiveDiv" style="width: 584px; height: 480px;">
                <div class="modal-header text-center">
                    <div>
                        <h4 class="modal-title">
                            <center>RFA Claims Administrator Information</center>
                        </h4>
                    </div>
                    <div><button type="button" style="color:#FFFFFF" class="close"
                            data-dismiss="modal">&times;</button></div>
                </div>
                <div class="modal-body">
                    <div class="container-fluid">
                        <section class="section">
                            <div class="row">
                                <!--Grid column-->
                                <div class="col-md-11 col-xl-11" style="margin-left:5%">
                                    <div style="padding: 10px;border-radius: 10px;border: 2px solid #818A91!important;">
                                        <p class="section-description">Gallagher Bassett instructs providers to fax RFAs to
                                            the Adjustor.</p>
                                        <p class="section-description"> If Adjustor unknown, contact Gallagher Bassett.</p>
                                        <ul class="a" style="padding-left:0">
                                            <li> <span>&#8226;</span> Main: (800) 370-0594</li>
                                            <li> <span>&#8226;</span> Claim Inquiries: (800) 370-0594 x3</li>
                                            <li> <span>&#8226;</span> Hours Of Operation: 08:00 AM - 08:00 PM PDT</li>
                                        </ul>
                                    </div><br>
                                    <p class="section-description">Provide Adjustor Name and RFA Fax Number.</p>
                                    <form method="post" name="contact" id="contactForm"
                                        action="contact-action/contact_action.php">
                                        <!-- service-form -->
                                        <div class="service-form">
                                            <div class="row">
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                    <span class="text-danger" id="final_msg"></span>
                                                </div>
                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                    <div class="form-group service-form-group">
                                                        <label for="ins_authinfo">Adjustor Name</label>
                                                        <input id="address" name="address" type="text"
                                                            class="form-control">
                                                    </div>
                                                </div>

                                                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                    <div class="form-group service-form-group">
                                                        <label for="ins_authinfo">RFA Fax Number</label>
                                                        <input id="address" name="address" type="text"
                                                            data-mask="(999) 999-9999" class="form-control">
                                                    </div>
                                                </div>

                                                <div align="center"
                                                    class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 ">
                                                    <button type="sumit" name="submitbtn" id="submitbtn"
                                                        class="btn btn-sm btn-primary btn-Font"
                                                        style="width: 100px;height: 50px">Confirm </button>
                                                    <button type="sumit" name="submitbtn" id="submitbtn"
                                                        class="btn btn-sm btn-primary btn-Font"
                                                        style="width: 100px;height: 50px">Skip</button>

                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <!--Grid column-->
                            </div>
                        </section>
                    </div>
                </div>
                <!--<div class="modal-footer">-->
                <!--  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>-->
                <!--</div>-->
            </div>

        </div>
    </div>
    <!-- END: RFAs Modal Popup-->

    </div>

    <!-- START: Contact Modal Popup -->
    <div id="injuryContactDiv" class="modal fade" role="dialog" style="padding-top:50px !important">
        <form method="post" action="{{ url('/patientinjuries/contact/create') }}" enctype="multipart/form-data"
            id="patientInjuryContactFrm">
            <div class="modal-dialog" role="document">
                <div class="modal-header text-center">
                    <div>
                        <h4 class="modal-title">
                            <center id="addTitleForContact">New Contact</center>
                        </h4>
                    </div>
                    <div><button type="button" onclick="refeshFormData();" style="color:#FFFFFF" class="close"
                            data-dismiss="modal">&times;</button>
                    </div>
                </div>
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="injuryId" id="injuryId" value="{{ $injuryId }}">
                    <input type="hidden" name="injuryContactId" id="injuryContactId" value="">
                    <div class="col-md-12" id="">
                        <div class="card" id="cardDivd1">
                            <div class="card-header" id="cardHeadId1">Contacts - Optional </div>
                            <div class="card-body" style="height: 150px; overflow-y: scroll; ">
                                <input type="hidden" class="contactRoleName" name="contactRoleName[]"
                                    id="contactRoleName_1" value="">
                                <div class="form-row" id="cloneContactRoleSelect1">
                                    <div class="form-group col-md-6">
                                        <label for="claim_admin_id"> Contact Role </label>
                                        <select name="contact_role[]" onChange="showcontactInfoBox(event,this.value);"
                                            class="form-control contactRole" id="contactRole_1">
                                            <option value="">-Select-</option>
                                            @foreach ($contactRoles as $c_role)
                                                <option value="{{ $c_role['id'] }}">
                                                    {{ $c_role['name'] }}</option>
                                            @endforeach
                                        </select>
                                        @if ($errors->has('contact_role'))
                                            <span class="invalid-feedback" style="display:block" role="alert">
                                                <strong
                                                    class="invalid-feedback">{{ $errors->first('contact_role') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-row d-none showSelectedNameDiv" id="showIdSelected_1">
                                    <div class="form-group col-md-12">
                                        <div class="form-row d-none showfirstLastName" id="showfirstLastName_1">
                                            <div class="form-group col-md-6">
                                                <label for="injury-end-date">First Name
                                                </label>
                                                <input data-validation-event="change" data-validation="custom"
                                                    data-validation-regexp="^[a-zA-Z]+(\s+[a-zA-Z]+)*$"
                                                    data-validation-optional="true" data-validation-error-msg=""
                                                    autocomplete="off" type="text" id="contact_first_name"
                                                    name="contact_first_name[]" value="" class="form-control"
                                                    maxlength="100">
                                                @if ($errors->has('contact_first_name'))
                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                        <strong
                                                            class="invalid-feedback">{{ $errors->first('contact_first_name') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="injury-end-date">Last
                                                    Name</label>
                                                <input data-validation-event="change" data-validation="custom"
                                                    data-validation-regexp="^[a-zA-Z]+(\s+[a-zA-Z]+)*$"
                                                    data-validation-optional="true" data-validation-error-msg=""
                                                    autocomplete="off" type="text" id="contact_last_name"
                                                    name="contact_last_name[]" value="" class="form-control"
                                                    maxlength="100">
                                                @if ($errors->has('contact_last_name'))
                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                        <strong
                                                            class="invalid-feedback">{{ $errors->first('contact_last_name') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="injury-end-date">Company
                                                </label>
                                                <input data-validation-optional="true" data-validation-event="change"
                                                    data-validation="required, alphanumeric"
                                                    data-validation-allowing="-_ " autocomplete="off" type="text"
                                                    id="contact_company_name" name="contact_company_name[]"
                                                    value="" class="form-control" maxlength="100">
                                                @if ($errors->has('contact_company_name'))
                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                        <strong
                                                            class="invalid-feedback">{{ $errors->first('contact_company_name') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-12">
                                                <label for="injury-end-date">Email </label>
                                                <input data-validation-event="change" data-validation-optional="true"
                                                    data-validation-error-msg="" data-validation="required, email"
                                                    autocomplete="off" type="email" id="contact_email_name"
                                                    name="contact_email_name[]" value="" class="form-control"
                                                    maxlength="100">
                                                @if ($errors->has('contact_email_name'))
                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                        <strong
                                                            class="invalid-feedback">{{ $errors->first('contact_email_name') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="injury-end-date">Phone Number
                                                </label>
                                                <input autocomplete="off" data-mask="(999) 999-9999 x9999999"
                                                    type="text" id="contact_phone_name" name="contact_phone_name[]"
                                                    value="" class="form-control" maxlength="100">
                                                @if ($errors->has('contact_phone_name'))
                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                        <strong
                                                            class="invalid-feedback">{{ $errors->first('contact_phone_name') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="injury-end-date">Fax </label>
                                                <input autocomplete="off" data-mask="999-999-9999" type="text"
                                                    id="contact_fax_name" name="contact_fax_name[]" value=""
                                                    class="form-control" maxlength="100">
                                                @if ($errors->has('contact_fax_name'))
                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                        <strong
                                                            class="invalid-feedback">{{ $errors->first('contact_fax_name') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="injury-end-date">Address Line 1
                                                </label>
                                                <input data-validation-optional="true" autocomplete="off" type="text"
                                                    id="contact_address1_name" name="contact_address1_name[]"
                                                    value="" class="form-control" maxlength="100">
                                                @if ($errors->has('contact_address1_name'))
                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                        <strong
                                                            class="invalid-feedback">{{ $errors->first('contact_address1_name') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="injury-end-date">Address Line 2
                                                </label>
                                                <input autocomplete="off" type="text" id="contact_address2_name"
                                                    name="contact_address2_name[]" value="" class="form-control"
                                                    maxlength="100">
                                                @if ($errors->has('contact_address2_name'))
                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                        <strong
                                                            class="invalid-feedback">{{ $errors->first('contact_address2_name') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-row">
                                            <div class="form-group col-md-4">
                                                <label for="contact_zip_name"> Zip code
                                                </label>
                                                <input autocomplete="off" type="text" id="contact_zip_name_1"
                                                    name="contact_zip_name[]" class="form-control zipCodeDop"
                                                    value="">
                                                @if ($errors->has('contact_zip_name'))
                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                        <strong>{{ $errors->first('contact_zip_name') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="contact_state_name">
                                                    State</label>
                                                <select name="contact_state_name[]" class="form-control stateDD stateName"
                                                    id="contact_state_name_1">
                                                    <option value="" class="option">
                                                        Select
                                                    </option>
                                                    @foreach ($states as $state)
                                                        <option value="{{ $state['state_name'] }}">
                                                            {{ $state['state_name'] }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                                @if ($errors->has('contact_state_name'))
                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                        <strong>{{ $errors->first('contact_state_name') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="form-group col-md-4">
                                                <label for="contact_city_name"> City
                                                </label>
                                                <input type="text" name="contact_city_name[]" id="contact_city_name_1"
                                                    class="form-control cityDD cityNameInput" value=""
                                                    maxlength="55">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group col-md-4">
                            <button type="submit" class="btn btn-primary ladda-button"><span
                                    class="ladda-label">Submit</span></button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <!-- END: Contact Modal Popup-->
    
    
     <!-- START: Claim Administrator  Modal Popup -->
        <div id="claimAdministratorModalId" class="modal fade bd-example-modal-lg" role="dialog" style="padding-top:150px !important">
            <div class="modal-dialog modal-lg">
                <!-- Modal content-->
                <div id="injuryDiv" class="modal-content">
                    <div class="modal-header text-center">
                        <div>
                            <h4 class="modal-title">
                                <center id="injuryNoteTitle">{{ ($pInjuries->getInjuryClaim && $pInjuries->getInjuryClaim->getClaimAdmin) ? $pInjuries->getInjuryClaim->getClaimAdmin->name : ''}}</center>
                            </h4>
                        </div>
                        <div><button type="button" style="color:#FFFFFF" class="close"
                                data-dismiss="modal">&times;</button></div>
                    </div>
                    <div class="modal-body"> 
                        @include('claimadministrators.show-info')  
                    </div> 
                </div> 
            </div>
        </div>
    <!-- END: Claim Administrator  Modal Popup-->

    <script src="{{ asset('js/controller/patient_injury.js') }}"></script>
    <script src="{{ asset('js/helper.js') }}"></script>
    <script>
        function updateInjuryNote(note) {
            if (note != null) {
                $("#submitbtn").text('Update');
                $("#injuryNoteId").val(note['id']);
                $("#injuryNoteTitle").text('Update Injury Note');
                $("#address").val(note['adjuster_name']);
                if (note['bill_history'] == 1) {
                    $("#billHistory").prop('checked', true);
                } else {
                    $("#billHistory").prop('checked', false);
                }
            } else {
                $("#submitbtn").text('Add');
                $("#injuryNoteTitle").text('Add Injury Note');
                $("#injuryNoteId").val("");
                $("#address").val("");
                $("#billHistory").prop('checked', false);
            }
        }

        function passSelectedDignosisCOde(selectedData) {
            console.log('selectedData#', selectedData);
            if (selectedData) {
                let array = [];
                array.push(selectedData);
                if (array.length > 0) {
                    $(".diagnosesCode ").select2({
                        width: '100%',
                        placeholder: 'Select',
                        closeOnSelect: true,
                        data: array,
                        ajax: {
                            url: "/searchDiagnosis",
                            //dataType: 'json',
                            type: "POST",
                            delay: 250,
                            data: function(params) {
                                return {
                                    q: params.term, // search term
                                    page: params.page,
                                    _token: token,
                                    type: 10,
                                };
                            },
                            processResults: function(data) {
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
                            },
                        },
                        cache: true,
                        templateResult: formatResult,
                        templateSelection: formatRepoSelection,
                    });
                }
            }
        }

        function formatResult(d) {
            if (d.loading) {
                return d.diagnosis_name;
            }

            // Creating an option of each id and text
            $d = $('<option/>').attr({
                'value': d.id
            }).text(d.diagnosis_name + " (" + d.diagnosis_code + " )");

            return $d;
        }

        function formatRepoSelection(val) {
            if (val.text == "") {
                return val.diagnosis_name + " (" + val.diagnosis_code + " )";
            }
        }

        function showcontactInfoBox(event, val) {
            //console.log('#val',val);
            var selectId = event.target.id;
            var el = document.getElementById(event.target.id);
            var cardDiv = el.closest(".card");
            var cardDivId = document.getElementById(cardDiv.id);
            var cardHeadId = $("#" + selectId).closest(".card").find('[class*="card-header"]').first().attr("id");
            var roleNameId = $("#" + selectId).closest('.card').find('[class*="contactRoleName"]').first().attr("id");
            var showfirstLastName = $("#" + selectId).closest('.card').find('[class*="showfirstLastName"]').first().attr(
                "id");
            var showIdSelected = $("#" + selectId).closest('.card').find('[class*="showSelectedNameDiv"]').first().attr(
                "id");
            //console.log('#showfirstLastName', showfirstLastName);
            // console.log('#roleNameId',roleNameId);
            if (val != "") {
                $("#" + showIdSelected).removeClass('d-none');
                $("#showCloneLink").removeClass('d-none');
                this.changeCardHeadTitle(event.target.id, cardHeadId, roleNameId);

                if (val == 1 || val == 4 || val == 5 || val == 6 || val == 7 || val == 8) {
                    $("#" + showfirstLastName).removeClass('d-none');
                } else {
                    $("#" + showfirstLastName).addClass('d-none');
                }
            } else {
                $("#" + showfirstLastName).addClass('d-none');
                $("#showCloneLink").addClass('d-none');
            }
        }

        function refeshFormData() {
            document.forms["patientInjuryContactFrm"].reset();
            if ($('#contactRole_1').val() == "") {
                $("#showIdSelected_1").addClass('d-none');
                $("#showCloneLink").addClass('d-none');
            }
        }

        function updateContact(contact) {
            console.log('updateContact#', contact);
            if (contact) {
                $("#injuryContactId").val(contact['id']);
                $("#addTitleForContact").text("Update Contact");
                $('#contactRole_1 option[value="' + contact['contact_role_id'] + '"]').attr('selected', 'selected');
                $('#contactRole_1').trigger('change');
                $('#contact_company_name').val(contact['company']);
                $('#contact_first_name').val(contact['first_name']);
                $('#contact_last_name').val(contact['last_name']);
                $('#contact_email_name').val(contact['email']);
                $('#contact_phone_name').val(contact['phone_number']);
                $('#contact_fax_name').val(contact['fax_number']);
                $('#contact_address1_name').val(contact['address_line1']);
                $('#contact_address2_name').val(contact['address_line2']);
                $('#contact_zip_name_1').val(contact['zip_code']);
                $('#contact_state_name_1').val(contact['state']);
                $('#contact_city_name_1').val(contact['city']);
            } else {
                $("#addTitleForContact").text("Add Contact");
            }
        }

        function deleteInjuryContact(contactId, injuryId, dType) {
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
                    let _url = `/patient/injury/contact/delete`;
                    $.ajax({
                        url: _url,
                        type: 'POST',
                        data: {
                            _token: token,
                            id: contactId,
                            injuryId: injuryId,
                            type: dType
                        },
                        success: function(response) {
                            //console.log('#response', response);
                            let title = capitalize(dType)+ " has been deleted";
                            swal.fire({
                            timer: 1000,
                            icon: 'info',
                            title: 'Success',
                            text: title,
                            showCancelButton: false,
                            showConfirmButton: false,
                            customClass: { popup: 'swal-wide' }
                            }).then((result) => {
                            console.log('check then function');
                                window.location.replace("/injury/view/" + injuryId);
                            });
                        },
                        error: function(response) {
                            swal.fire(response.responseJSON.message, '', 'error');
                        }
                    });
                }
            });
        }
        function capitalize(str) {
            strVal = '';
            str = str.split(' ');
            for (var chr = 0; chr < str.length; chr++) {
                strVal += str[chr].substring(0, 1).toUpperCase() + str[chr].substring(1, str[chr].length) + ' '
            }
            return strVal
        }
    </script>
@endsection
