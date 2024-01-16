@extends('layouts.home-new-app')
<style>
   .step {
     padding-top: 0px!important;
    }
    .step .fa {
        padding-top: 13px !important;
        font-size: 18px !important;
    }
    .pointer {
        cursor: pointer;
    }
    .mt-1, .my-1{
       margin-top:0.5rem!important;
    }
</style>
@section('content')
    <!-- START: Breadcrumbs-->
    <!-- END: Breadcrumbs-->
    @if ($message = Session::get('success'))
        <div class="row mt-2 customBox">
            <div class="col-12 align-self-center">
                <div class="alert alert-success">
                    <p>{{ $message }}</p>
                </div>
            </div>
        </div>
    @endif
    <div class="row mt-0">
        <div class="col-md-12 mt-0">
            <div class="card row-background customBoxHeight">
                <div class="row ">
                    <div class="col-md-12 align-self-center">
                        <div class="sub-header py-1 px-0 align-self-center d-sm-flex w-100 rounded heading-background">
                            <div style="padding-top:0px; padding-left:0px" class="w-sm-100 mr-auto">
                                <h2> <i class="fa-solid fa-user-doctor"></i>
                                    {{ $billingProviders->professional_provider_name ? $billingProviders->professional_provider_name : '' }}
                                </h2>
                                <span
                                    style="color: #aeb5b5;padding-left:25px;position:relative;top:-7px;font-size:16px; font-weight: 500;">Billing
                                    Provider</span>
                            </div>
                            <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                                <li style="padding-bottom:10px" class="breadcrumb-item">
                                    <a class="btn btn-primary" href="{{ route('billingproviders.index') }}">Back</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="card-content">
                    <div class="card-body2">
                        <div class="row">
                            <div class="col-md-12 pl-4">
                                <div class="row step">
                                    <div id="divTab_1" style="background-color:#f3f3f3;"
                                        class="col-md-3 otherStep activestep"
                                        onclick="javascript: resetActive(event, 0, 1);">
                                        <p class="bold pointer">Billing Settings - Required</p>
                                    </div>
                                    <div id="divTab_2" style="background-color:#f3f3f3;" class="col-md-3 otherStep"
                                        onclick="javascript: resetActive(event, 20, 2);">
                                        <p class="bold pointer">Billing Settings - Custom</p>
                                    </div>
                                    <div id="divTab_3" style="background-color:#f3f3f3;" class="col-md-3 otherStep"
                                        onclick="javascript: resetActive(event, 40, 3);">
                                        <p class="bold pointer">RFA Settings</p>
                                    </div>

                                    <!--<div id="divTab_4" style="background-color:#f3f3f3;" class="col-md-2 otherStep"-->
                                    <!--    onclick="javascript: resetActive(event, 60, 4);">-->

                                    <!--    <p class="bold pointer">Letters</p>-->
                                    <!--</div>-->

                                </div>
                            </div>

                            <div class="col-12 mt-4 ml-4 pl-4 step activeStepInfo" id="step-1">
                                <div class="row step">
                                    <div id="div1" class="col-md-2" onclick="javascript: resetActive(event, 0, 1">
                                        <a class="text-dark" href="{{ url('/view/billing/provider', $id) }}">
                                            <span class="fa fa-info-circle fa-larger"></span>
                                            <p class="bold margin-bottom">Billing Provider Info</p>
                                            <p class="bold">View <i class="icon-arrow-right-circle"></i></p>
                                        </a>
                                    </div>

                                    <div id="div2" class="col-md-2 otherStep">
                                        <a class="text-dark" href="{{ url('/billing/rendering', $id) }}">
                                            <span class="fa fa-user-md"></span>
                                            <p class="bold margin-bottom">Rendering Providers</p>
                                            <p class="bold">View <i class="icon-arrow-right-circle"></i></p>
                                        </a>
                                    </div>

                                    <div id="div3" class="col-md-2 otherStep">
                                        <span class="fa fa-map-marker"></span>
                                        <a class="text-dark" href="{{ url('/places-of-service', $id) }}">
                                            <p class="bold margin-bottom">Places of Service</p>
                                            <p class="bold">View <i class="icon-arrow-right-circle"></i></p>
                                        </a>
                                    </div>

                                    <div id="div4" class="col-md-2 otherStep">
                                        <span class="fa fa-file-text-o"></span>
                                        <a class="text-dark" href="{{ url('/billing/provider/cms-1500-form', $id) }}">
                                            <p class="bold margin-bottom">CMS 1500 Forms</p>
                                            <p class="bold">View <i class="icon-arrow-right-circle"></i></p>
                                        </a>
                                    </div>

                                    <div id="div5" class="col-md-2 otherStep">
                                        <span class="fa fa-usd"></span>
                                        <a class="text-dark" href="{{ url('/setting/billing/provider/charge/add', $id) }}">
                                            <p class="bold margin-bottom">Charges</p>
                                            <p class="bold">View <i class="icon-arrow-right-circle"></i></p>
                                        </a>
                                    </div>
                                </div>
                                <div class="row step">
                                    <div id="div6" class="col-md-2 otherStep">
                                        <span class="fa fa-info-circle fa-larger"></span>
                                        <a class="text-dark" href="{{ url('/billing/providers/recurence', $id) }}">
                                            <p class="bold margin-bottom">Recurrence</p>
                                            <p class="bold">View <i class="icon-arrow-right-circle"></i></p>
                                        </a>
                                    </div>
                                    <div id="div6" class="col-md-2 otherStep">
                                        <span class="fa fa-info-circle fa-larger"></span>
                                        <a class="text-dark" href="{{ url('/billing/providers/reasons', $id) }}">
                                            <p class="bold margin-bottom">Reasons</p>
                                            <p class="bold">View <i class="icon-arrow-right-circle"></i></p>
                                        </a>
                                    </div>
                                    <div id="div7" class="col-md-2 otherStep">
                                        <span class="fa fa-info-circle fa-larger"></span>
                                        <a class="text-dark" href="{{ url('/billing/providers/holidays', $id) }}">
                                            <p class="bold margin-bottom">Holidays</p>
                                            <p class="bold">View <i class="icon-arrow-right-circle"></i></p>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 mt-4 ml-4 pl-4 step hiddenStepInfo" id="step-2">

                                <div class="row">
                                    <div class="col-1 row paddingtop">
                                        <h4><b>Tasks</b></h4>
                                    </div>
                                    <div class="col-11"> </div>
                                    <div id="div1" class="col-md-2">
                                        <br>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px"
                                            viewBox="0 0 34 34">
                                            <title>icon_task</title>
                                            <path
                                                d="M9.857 10.429a.714.714 0 0 0-.714.714v15.714c0 .395.32.714.714.714h14.286c.394 0 .714-.32.714-.714V11.143a.714.714 0 0 0-.714-.714H9.857zm1.429-2.143v-.66a1 1 0 0 1 1-1h1.857C14.524 4.877 15.483 4 17.02 4c1.537 0 2.483.876 2.836 2.627h1.857a1 1 0 0 1 1 1v.659h1.429A2.857 2.857 0 0 1 27 11.143v15.714a2.857 2.857 0 0 1-2.857 2.857H9.857A2.857 2.857 0 0 1 7 26.857V11.143a2.857 2.857 0 0 1 2.857-2.857h1.429zm5.714 0a1.429 1.429 0 1 0 0-2.857 1.429 1.429 0 0 0 0 2.857zm-.806 12.136L12.5 17.397 11 19.15l5.278 4.416 6.901-7.295-1.51-1.557-5.475 5.708z"
                                                fill="#3A3A3A" fill-rule="nonzero"></path>
                                        </svg>
                                        <a onclick="javascript: resetActive(event, 20, 2);" class="text-dark"
                                            href="{{ url('/billing/provider/task/assignment/preferences', $id) }}">
                                            <p class="bold margin-bottom">Bill Task Preferences</p>
                                            <p class="bold">View <i class="icon-arrow-right-circle"></i></p>
                                        </a>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-1 row paddingtop">
                                        <h4><b>Library</b></h4>
                                    </div>
                                    <div class="col-11"> </div>
                                    <div id="div1" class="col-md-2">
                                        <a class="text-dark"
                                            href="{{ url('/patients/injury/documents/' . $id . '/Provider') }}">
                                            <span class="fa fa-file-text-o"></span>
                                            <p class="bold margin-bottom">Documents</p>
                                            <p class="bold">View <i class="icon-arrow-right-circle"></i></p>
                                        </a>
                                    </div>

                                    <div id="div2" class="col-md-2 otherStep">
                                        <a class="text-dark"
                                            href="{{ url('/provider-bill-write-off-reason/' . $id . '/1') }}">
                                            <span class="fa fa-file-text-o"></span>
                                            <p class="bold margin-bottom">Bill Write Off Reasons</p>
                                            <p class="bold">View <i class="icon-arrow-right-circle"></i></p>
                                        </a>
                                    </div>

                                    <div id="div3" class="col-md-2 otherStep">
                                        <span class="fa fa-file-text-o"></span>
                                        <a class="text-dark"
                                            href="{{ url('/provider-bill-write-off-reason/' . $id . '/2') }}">
                                            <p class="bold margin-bottom">Second Review Reasons</p>
                                            <p class="bold">View <i class="icon-arrow-right-circle"></i></p>
                                        </a>
                                    </div>

                                    <div id="div3" class="col-md-2 otherStep">
                                        <span class="fa fa-file-text-o"></span>
                                        <a class="text-dark"
                                            href="{{ url('/provider-bill-write-off-reason/' . $id . '/3') }}">
                                            <p class="bold margin-bottom">Box 19 Reasons</p>
                                            <p class="bold">View <i class="icon-arrow-right-circle"></i></p>
                                        </a>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-2 row paddingtop">
                                        <h4><b>Bill Settings</b></h4>
                                    </div>
                                    <div class="col-10"> </div>
                                    <div id="div1" class="col-md-2" onclick="javascript: resetActive(event, 0, 1);">
                                        <span class="fa fa-file-text-o"></span>
                                        <a class="text-dark" href="{{ url('/add-custom-billing-template', $id) }}">
                                            <p class="bold margin-bottom">Billing Templates</p>
                                            <p class="bold">View <i class="icon-arrow-right-circle"></i></p>
                                        </a>
                                    </div>

                                    <div id="div2" class="col-md-2 otherStep">

                                        <a class="text-dark"
                                            href="{{ url('/list-of-custom-referring-ordering-providers', $id) }}">
                                            <span class="fa fa-user-md"></span>
                                            <p class="bold margin-bottom">Referring and Ordering Providers</p>
                                            <p class="bold">View <i class="icon-arrow-right-circle"></i></p>
                                        </a>
                                    </div>

                                    <div id="div3" class="col-md-2 otherStep">
                                        <span class="fa fa-usd"></span>
                                        <a class="text-dark"
                                            href="{{ url('/settings/providers/expected/reimbursements/' . $id . '/2') }}">
                                            <p class="bold margin-bottom">Expected Reimbursements</p>
                                            <p class="bold">View <i class="icon-arrow-right-circle"></i></p>
                                        </a>
                                    </div>

                                    <div id="div3" class="col-md-2 otherStep">
                                        <span class="fa fa-usd"></span>
                                        <a class="text-dark" href="#">
                                            <p class="bold margin-bottom">Bill Close: Automatic</p>
                                            <p class="bold">View <i class="icon-arrow-right-circle"></i></p>
                                        </a>
                                    </div>

                                </div>

                            </div>

                            <div class="col-12 mt-4 ml-4 pl-4 step hiddenStepInfo" id="step-3">

                                <div class="row">
                                    <div class="col-3 row paddingtop">
                                        <h4><b>RFA Settings - Required</b></h4>
                                    </div>
                                    <div class="col-11"> </div>
                                    <div id="div1" class="col-md-2" onclick="javascript: resetActive(event, 0, 1);">
                                        <a class="text-dark" href="{{ url('/view/billing/provider', $id) }}">
                                            <span class="fa fa-info-circle"></span>
                                            <p class="bold margin-bottom">Billing Provider Info</p>
                                            <p class="bold">View <i class="icon-arrow-right-circle"></i></p>
                                        </a>
                                    </div>

                                    <div id="div2" class="col-md-2 otherStep">
                                        <a class="text-dark" href="{{ url('/list/rfa/requesting/physicians', $id) }}">
                                            <span class="fa fa-user-md"></span>
                                            <p class="bold margin-bottom">Requesting Physician</p>
                                            <p class="bold">View <i class="icon-arrow-right-circle"></i></p>
                                        </a>
                                    </div>

                                    <div id="div3" class="col-md-2 otherStep">
                                        <span class="fa fa-map-marker"></span>
                                        <a class="text-dark" href="{{ url('/list/rfa/practice/locations', $id) }}">
                                            <p class="bold margin-bottom">Practice Location</p <p class="bold">View <i
                                                class="icon-arrow-right-circle"></i></p>
                                        </a>
                                    </div>

                                    <div id="div3" class="col-md-2 otherStep">
                                        <span class="fa fa-address-card-o"></span>
                                        <a class="text-dark" href="{{ url('/list/practice/contact', $id) }}">
                                            <p class="bold margin-bottom">Practice Contact</p>
                                            <p class="bold">View <i class="icon-arrow-right-circle"></i></p>
                                        </a>
                                    </div>

                                    <div id="div3" class="col-md-2 otherStep">
                                        <span class="fa fa-fax center"></span>
                                        <a class="text-dark" href="{{ url('/places-of-service', $id) }}">
                                            <p class="bold margin-bottom">UR Decision Fax Preferences</p>
                                            <p class="bold">View <i class="icon-arrow-right-circle"></i></p>
                                        </a>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-3 row paddingtop">
                                        <h4><b>RFA Settings - Optional</b></h4>
                                    </div>
                                    <div class="col-11"> </div>
                                    <div id="div1" class="col-md-2" onclick="javascript: resetActive(event, 0, 1);">
                                        <br>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px"
                                            viewBox="0 0 34 34">
                                            <title>icon_task</title>
                                            <path
                                                d="M9.857 10.429a.714.714 0 0 0-.714.714v15.714c0 .395.32.714.714.714h14.286c.394 0 .714-.32.714-.714V11.143a.714.714 0 0 0-.714-.714H9.857zm1.429-2.143v-.66a1 1 0 0 1 1-1h1.857C14.524 4.877 15.483 4 17.02 4c1.537 0 2.483.876 2.836 2.627h1.857a1 1 0 0 1 1 1v.659h1.429A2.857 2.857 0 0 1 27 11.143v15.714a2.857 2.857 0 0 1-2.857 2.857H9.857A2.857 2.857 0 0 1 7 26.857V11.143a2.857 2.857 0 0 1 2.857-2.857h1.429zm5.714 0a1.429 1.429 0 1 0 0-2.857 1.429 1.429 0 0 0 0 2.857zm-.806 12.136L12.5 17.397 11 19.15l5.278 4.416 6.901-7.295-1.51-1.557-5.475 5.708z"
                                                fill="#3A3A3A" fill-rule="nonzero"></path>
                                        </svg>
                                        <p class="bold margin-bottom">RFA Task Preferences</p>
                                        <p class="bold">View <i class="icon-arrow-right-circle"></i></p>
                                    </div>

                                    <div id="div2" class="col-md-2 otherStep">
                                        <a class="text-dark" href="{{ url('/add/rfa/template', $id) }}">
                                            <span class="fa fa-file-text-o"></span>
                                            <p class="bold margin-bottom">RFA Templates</p>
                                            <p class="bold">View <i class="icon-arrow-right-circle"></i></p>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <!--<div class="col-12 mt-4 ml-4 pl-4 step hiddenStepInfo" id="step-4">-->

                            <!--    <div class="row">-->
                            <!--        <div class="col-3 row paddingtop">-->
                            <!--            <h4><b>Billing - Letters</b></h4>-->
                            <!--        </div>-->
                            <!--        <div class="col-11"> </div>-->
                            <!--        <div id="div1" class="col-md-2" onclick="javascript: resetActive(event, 0, 1);">-->
                            <!--            <a class="text-dark"-->
                            <!--                href="{{ url('/bill-submissions/letters/sbr-letter', $id) }}">-->
                            <!--                <span class="fa fa-regular fa-file-lines"></span>-->
                            <!--                <p class="bold margin-bottom">SBR Letter</p>-->
                            <!--                <p class="bold">View <i class="icon-arrow-right-circle"></i></p>-->
                            <!--            </a>-->
                            <!--        </div>-->

                            <!--        <div id="div2" class="col-md-2 otherStep">-->
                            <!--            <a class="text-dark"-->
                            <!--                href="{{ url('/bill-submissions/letters/rfa-letter', $id) }}">-->
                            <!--                <span class="fa fa-regular fa-file-lines"></span>-->
                            <!--                <p class="bold margin-bottom">RFA Letter</p>-->
                            <!--                <p class="bold">View <i class="icon-arrow-right-circle"></i></p>-->
                            <!--            </a>-->
                            <!--        </div>-->

                            <!--        <div id="div3" class="col-md-2 otherStep">-->
                            <!--            <span class="fa fa-regular fa-file-lines"></span>-->
                            <!--            <a class="text-dark"-->
                            <!--                href="{{ url('/bill-submissions/letters/pr2-letter', $id) }}">-->
                            <!--                <p class="bold margin-bottom">PR2 Letter</p <p class="bold">View <i-->
                            <!--                    class="icon-arrow-right-circle"></i></p>-->
                            <!--            </a>-->
                            <!--        </div>-->

                            <!--        <div id="div3" class="col-md-2 otherStep">-->
                            <!--            <span class="fa fa-regular fa-file-lines"></span>-->
                            <!--            <a class="text-dark"-->
                            <!--                href="{{ url('/bill-submissions/letters/resubmission-letter', $id) }}">-->
                            <!--                <p class="bold margin-bottom">Re-Submission Letter</p>-->
                            <!--                <p class="bold">View <i class="icon-arrow-right-circle"></i></p>-->
                            <!--            </a>-->
                            <!--        </div>-->

                            <!--        <div id="div3" class="col-md-2 otherStep">-->
                            <!--            <span class="fa fa-regular fa-file-lines"></span>-->
                            <!--            <a class="text-dark"-->
                            <!--                href="{{ url('/bill-submissions/letters/demand-letter', $id) }}">-->
                            <!--                <p class="bold margin-bottom">Demand Letter</p>-->
                            <!--                <p class="bold">View <i class="icon-arrow-right-circle"></i></p>-->
                            <!--            </a>-->
                            <!--        </div>-->
                            <!--    </div>-->

                            <!--    <div class="row">-->
                            <!--        <div class="col-3 row paddingtop">-->

                            <!--        </div>-->
                            <!--        <div class="col-11"> </div>-->
                            <!--        <div id="div1" class="col-md-2" onclick="javascript: resetActive(event, 0, 1);">-->
                            <!--            <span class="fa fa-regular fa-file-lines"></span>-->
                            <!--            <a class="text-dark"-->
                            <!--                href="{{ url('/bill-submissions/letters/authorization-letter', $id) }}">-->
                            <!--                <p class="bold margin-bottom">Authorization Letter</p>-->
                            <!--                <p class="bold">View <i class="icon-arrow-right-circle"></i></p>-->
                            <!--            </a>-->
                            <!--        </div>-->

                            <!--    </div>-->

                            <!--</div>-->

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        //
        $(document).ready(function() {
            if (localStorage.getItem("tabId") && typeof(localStorage.getItem("tabId")) != 'undefined') {
                showCurrentStepInfo(localStorage.getItem("tabId"));
            }
        });

        function resetActive(event, percent, step) {
            hideSteps();
            setTabDivIdInSession(step);
        }

        function hideSteps() {
            $("div").each(function() {
                if ($(this).hasClass("activeStepInfo")) {
                    $(this).removeClass("activeStepInfo");
                    $(this).addClass("hiddenStepInfo");
                }
            });
        }

        function showCurrentStepInfo(step) {
            console.log('#step', step);
            var id = "#step-" + step;
            $(id).addClass("activeStepInfo");
            $("div").each(function() {
                if ($(this).hasClass("activestep")) {
                    $(this).removeClass("activestep");
                }
            });
            $('#divTab_' + step).addClass("activestep");
        }

        function setTabDivIdInSession(step) {
            localStorage.setItem("tabId", step);
            console.log('#localStorage', localStorage.getItem("tabId"));
            showCurrentStepInfo(localStorage.getItem("tabId"));
        }
    </script>
@endsection
