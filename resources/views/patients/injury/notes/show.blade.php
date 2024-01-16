@extends('layouts.home-new-app')
@section('content')
    <style type="text/css">
        .activeContent {
            display: flex;
        }

        .hiddenContent {
            display: none;
        }

        .flag-wrapper:after {
            padding-top: 0% !important;
        }

        .setTpPaddeing {
            top: 75px !important
        }

        ;
    </style>
    <!-- START: Modal popup css-->
    <link rel="stylesheet" type="text/css" href="{{ url('new_assets/app-assets/css/modal-popup.css') }}">
    <!-- END: Modal popup css-->
    <style>
        #t1 td {
            border-bottom: 1px solid #E3EBF3;
            padding: 0.5rem 1rem !important;
        }
    </style>

    <!-- START: Breadcrumbs-->
    <div class="row ">
        <div class="col-12  align-self-center">

        </div>
    </div>
    <!-- END: Breadcrumbs-->

    <div class="row font">
        <div class="col-9 mt-4">
            <div class="card">
                <div class="card-body height">
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-12" id="patient_info">
                            <div class="sub-header align-self-center d-sm-flex w-100 rounded">
                                <div class="w-sm-100 mr-auto col-9">
                                    <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                                        <li class="breadcrumb-item">
                                            <h2><svg xmlns="http://www.w3.org/2000/svg" width="30px" height="30px"
                                                    viewBox="0 0 34 34" class="left">
                                                    <title>icon_patient</title>
                                                    <path
                                                        d="M20.983 16.793L19.32 23.2h-1.857c-.825.017-1.48.654-1.463 1.425l.005.21c.017.758.682 1.365 1.495 1.365h5.147c.977 0 1.829-.617 2.07-1.5l.269-.977a.392.392 0 0 0 .014-.104c0-.231-.2-.418-.448-.418h-.753l-1.085-6.853c.258.077.501.185.73.324.517.314.933.72 1.248 1.216.314.497.573 1.094.777 1.791.203.698.343 1.39.418 2.079.075.688.113 1.42.113 2.194 0 .993-.277 1.846-.83 2.557-.553.71-1.22 1.066-1.999 1.066H11.83c-.78 0-1.446-.355-1.999-1.066-.553-.711-.83-1.564-.83-2.557 0-.775.038-1.506.113-2.194.075-.689.215-1.381.418-2.079.204-.697.463-1.294.777-1.79.315-.497.73-.903 1.249-1.217.518-.315 1.113-.472 1.786-.472 1.16 1.167 2.546 1.75 4.157 1.75 1.31 0 2.472-.386 3.483-1.157zm-.58 6.623l1.423-5.602.791 5.602h-2.213zM22.5 12c0 1.38-.488 2.559-1.465 3.535C20.06 16.512 18.88 17 17.5 17c-1.38 0-2.559-.488-3.535-1.465C12.988 14.56 12.5 13.38 12.5 12c0-1.38.488-2.559 1.465-3.535C14.94 7.488 16.12 7 17.5 7c1.38 0 2.559.488 3.535 1.465C22.012 9.44 22.5 10.62 22.5 12z"
                                                        fill="#3A3A3A" fill-rule="evenodd"></path>
                                                </svg>
                                                Injury Notes Information</h2>
                                        </li>
                                    </ol>
                                </div>
                                <div align="right" class="w-sm-100 mr-auto col-3">
                                    <ul class="list-inline">
                                        <li class="list-inline-item">

                                            <a class="btn btn-primary" href="javascript:void(0)" data-toggle="modal"
                                                data-target="#injurynotes"> Add </a>
                                        </li>
                                        <li class="list-inline-item">
                                            <a class="btn btn-primary"  href="{{ url('/injury/view/')}}/{{ $injuryId }}">Back</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <table id="example" class="table layout-secondary dataTable table-striped table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Date</th>
                                        <th scope="col">User</th>
                                        <th scope="col">Note</th>
                                        <th scope="col">Bill History Display</th>
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

                        <hr>

                    </div>
                </div>
            </div>
        </div>
        <div class="col-3 mt-4">
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
                            <center>Add Injury Note</center>
                        </h4>
                    </div>
                    <div><button type="button" style="color:#FFFFFF" class="close" data-dismiss="modal">&times;</button>
                    </div>
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
                                        <input type="hidden" name="injuryId" id="injuryId" value="{{ $injuryId }}">
                                        <input type="hidden" name="id" id="id" value="{{$id}}">
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
                                                        style="width: 100px;height: 50px">Cancel</button>
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

    <script src="{{ asset('js/controller/patient_injury.js') }}"></script>
@endsection
