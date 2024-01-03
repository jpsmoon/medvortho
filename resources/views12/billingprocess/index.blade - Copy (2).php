@extends('layouts.home-app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Bill Process</h2>
            </div>
            <div class="pull-right">
                @can('product-create')
                <!-- <a class="btn btn-success" href="{{ route('billprocess.stepForm') }}"> stepForm</a> -->
                @endcan
            </div>
        </div>
    </div>

    <link href="{{ asset('css/step-content.css') }}" rel="stylesheet">
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div  class="container" style="margin-top: 0px; margin-bottom: 10px; width:100%">
        <!-- <div class="row">
            <div class="progress" id="progress1">
                <div class="progress-bar" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 20%;">
                </div>
                <span class="progress-type">Overall Progress</span>
                <span class="progress-completed">20%</span>
            </div>
        </div> -->
        <div class="row">
            <div class="row step">
                <div id="div1" class="col-md-2 activestep" onclick="javascript: resetActive(event, 0, '1');">
                    <span class="fa fa-cloud-download"></span>
                    <p>Patient Info</p>
                </div>
                <div id="div2" class="col-md-2" onclick="javascript: resetActive(event, 20, '2');">
                    <span class="fa fa-pencil"></span>
                    <p>Financial Class</p>
                </div>
                <div id="div3" class="col-md-2" onclick="javascript: resetActive(event, 40, '3');">
                    <span class="fa fa-refresh"></span>
                    <p>Bill</p>
                </div>
                <div id="div4" class="col-md-2" onclick="javascript: resetActive(event, 60, '4');">
                    <span class="fa fa-dollar"></span>
                    <p>Document</p>
                </div>
                <div id="div5" id="last" class="col-md-2" onclick="javascript: resetActive(event, 100, '5');">
                    <span class="fa fa-cloud-upload"></span>
                    <p>Send Feedback</p>
                </div>
            </div>
        </div>
        <div class="row setup-content step activeStepInfo" id="step-1">
            <form id="frmClaim1" method="POST">
            @csrf
            <div class="col-xs-12">
                <div class="col-md-12 well text-center">
                    <section>
                    @include('patients.patient_info')
                    <div class="col-md-12">
                        <button type="button" class="btn btn-primary" onclick="save_patient('step1', 'frmClaim1')">Next</button>
                    </div>
                    </section>
                </div>
            </div>
            </form>
        </div>
        <div class="row setup-content step hiddenStepInfo" id="step-2">
            <div class="col-xs-12">
                <div class="col-md-12 well text-center">
                <section>
                        <div class="form-row form-group">
                            <div class="form-holder col-md-3" style="float:left;" >
                                <input class="form-check-input" checked type="radio" name="financial_class" id="flexRadioDefault1" value="1" onclick="show_form()"/>
                                <label for="flexRadioDefault1" style="cursor:hand;" >   Worker Comp.   </label>
                            </div>
                            <div class="form-holder col-md-3" >
                                <input class="form-check-input" type="radio" name="financial_class" id="flexRadioDefault2" value="2"  onclick="show_form()"/>
                                <label style="cursor:hand;" for="flexRadioDefault2">   Private / Government     </label>
                            </div>
                            <div class="form-holder col-md-3" >
                                <input class="form-check-input" type="radio" name="financial_class" id="flexRadioDefault3" value="3"  onclick="show_form()"/>
                                <label style="cursor:hand;" for="flexRadioDefault3" >   Personal Injury      </label>
                            </div>
                        </div>
                        <div class="form-row form-group">
                            <div class="form-holder col-md-9">
                                <label for="" style="float:left;">   Injury Description      </label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-holder col-md-3">
                                <label for="" style="float:left;">   State <span class="required">* </span>   </label>
                                <select name="" id="" class="form-control">
                                    <option value="" class="option">Select State</option>
                                </select>
                            </div>
                        </div>
                    <div id="financial_1">
                    @include('billingprocess.fin_worker_comp')
                    </div>
                    <div id="financial_2"  style="display:none;">
                    @include('billingprocess.fin_prv_gov')
                    </div>
                    <div id="financial_3"  style="display:none;">
                    @include('billingprocess.fin_personal_injury')
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <button type="button" class="btn btn-primary pull-left" onclick="resetActive(event, 0, '1')">Prev</button>
                        <button type="button" class="btn btn-primary pull-right" onclick="save_injury('step2', 'frmClaim2')">Next</button>
                    </div>
                    </section>
                </div>
            </div>
        </div>
        <div class="row setup-content step hiddenStepInfo" id="step-3">
            <div class="col-xs-12">
                <section>
                    <div class="col-md-12 well text-center">

                        <div class="form-row form-group">
                            <div class="form-holder col-md-3">
                                <label for="" style="float:left;">   Place of Services      </label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-holder col-md-3">
                                <label for="" style="float:left;">   Rendering Provider      </label>
                                <select name="" id="" class="form-control">
                                    <option value="" class="option">Select</option>
                                </select>
                            </div>
                            <div class="form-holder col-md-offset-1 col-md-3">
                                <label for="" style="float:left;">   Start DOS      </label>
                                <input type="date" class="form-control">
                            </div>
                        </div>
                        <div class="form-row form-group">
                            <div class="form-holder col-md-3">
                                <label for="" style="float:left;"> Authorization Number  </label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-holder col-md-3">
                                <label for="" style="float:left;"> Practice Bill ID  </label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-holder col-md-offset-1 col-md-3">
                                <label for="" style="float:left;">   Admission Date      </label>
                                <input type="date" class="form-control">
                            </div>
                            <div class="form-holder col-md-offset-1 col-md-3">
                                <label for="" style="float:left;"> DOS End    </label>
                                <input type="date" class="form-control">
                            </div>
                        </div>

                        <div class="form-row form-group">
                            <div class="form-holder col-md-3">
                                <label for="" style="float:left;"> Provider Type  </label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-holder col-md-3">
                                <label for="" style="float:left;"> Provider Name  </label>
                                <input type="text" class="form-control">
                            </div>
                        </div>
                        <div class="form-row form-group">
                            <div class="form-holder col-md-12" style="float:left;" >
                                <label for="" style="float:left;"> Diagnosis Codes  </label>
                            </div>
                            <div class="form-holder col-md-1" style="float:left;" >
                                <input class="form-check-input" checked type="radio" name="dcode" id="icd9" value="1" />
                                <label for="icd9" style="cursor:hand;" > ICD-9 </label>
                            </div>
                            <div class="form-holder col-md-1" style="float:left;" >
                                <input class="form-check-input" type="radio" name="dcode" id="icd10" value="2"/>
                                <label style="cursor:hand;" for="icd10">   ICD-10     </label>
                            </div>
                        </div>
                        <div class="form-row form-group">
                            <div class="form-holder col-md-3">
                                <select name="" id="" class="form-control">
                                    <option value="" class="option">Select</option>
                                </select>
                            </div>
                            <div class="form-holder col-md-3">
                                <select name="" id="" class="form-control">
                                    <option value="" class="option">Select</option>
                                </select>
                            </div>
                            <div class="form-holder col-md-3">
                                <select name="" id="" class="form-control">
                                    <option value="" class="option">Select</option>
                                </select>
                            </div>
                            <div class="form-holder col-md-3">
                                <select name="" id="" class="form-control">
                                    <option value="" class="option">Select</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row form-group">
                            <div class="form-holder col-md-12" style="float:left;" >
                                <label for="" style="float:left;">Service Line Items </label>
                            </div>
                            <div class="form-holder col-md-3">
                                <label for="" style="float:left;"> Procedure Code  </label>
                                <select name="" id="" class="form-control">
                                    <option value="" class="option">Select</option>
                                </select>
                            </div>
                            <div class="form-holder col-xs-2">
                                <label for="" style="float:left;"> Moddifiers  </label>
                                <select name="" id="" class="form-control">
                                    <option value="" class="option">Select</option>
                                </select>
                            </div>
                            <div class="form-holder col-xs-2">
                                <label for="" style="float:left;"> Unit  </label>
                                <select name="" id="" class="form-control">
                                    <option value="" class="option">Select</option>
                                </select>
                            </div>
                            <div class="form-holder col-md-5">
                                <label for="" style="text-align:left;"> Diag Codes  </label>
                                <div class="form-holder col-md-12">
                                    <select name="" id="" class="form-control col-md-3" style="float: left;">
                                        <option value="" class="option">Select</option>
                                    </select>
                                    <select name="" id="" class="form-control col-md-3" style="float: left;">
                                        <option value="" class="option">Select</option>
                                    </select>
                                    <select name="" id="" class="form-control col-md-3" style="float: left;">
                                        <option value="" class="option">Select</option>
                                    </select>
                                    <select name="" id="" class="form-control col-md-3">
                                        <option value="" class="option">Select</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <button type="button" class="btn btn-primary pull-left" onclick="resetActive(event, 0, '1')">Prev</button>
                        <button type="button" class="btn btn-primary pull-right" onclick="save_injury('step3', 'frmClaim3')">Next</button>
                    </div>
                    </div>
                </section>
            </div>
        </div>
        <div class="row setup-content step hiddenStepInfo" id="step-4">
            <div class="col-xs-12">
                <div class="col-md-12 well text-center">
                    <h1>STEP 4</h1>
                    <h3 class="underline">Instructions</h3>
                    Pay the application fee.
                    This can be done either by entering your card details, or by using Paypal.
                </div>
            </div>
        </div>
        <div class="row setup-content step hiddenStepInfo" id="step-5">
            <div class="col-xs-12">
                <div class="col-md-12 well text-center">
                    <h1>STEP 5</h1>
                    <h3 class="underline">Instructions</h3>
                    Upload the application.
                    This may require a confirmation email.
                </div>
            </div>
        </div>
        <div class="row setup-content step hiddenStepInfo" id="step-6">
            <div class="col-xs-12">
                <div class="col-md-12 well text-center">
                    <h1>STEP 6</h1>
                    <h3 class="underline">Instructions</h3>
                    Send us feedback on the overall process.
                    This step is not obligatory.
                </div>
            </div>
        </div>


    </div>

<script src="{{ asset('js/controller/patients.js') }}"></script>
<script type="text/javascript">
        function show_form(){
            var frmvalue = $('input[name="financial_class"]:checked').val();
            //alert(frmvalue);
            switch(frmvalue){
                case '1':
                    document.getElementById('financial_2').style.display = 'none';
                    document.getElementById('financial_3').style.display = 'none';
                    document.getElementById('financial_1').style.display = 'block';
                    break;
                case '2':
                    document.getElementById('financial_1').style.display = 'none';
                    document.getElementById('financial_3').style.display = 'none';
                    document.getElementById('financial_2').style.display = 'block';
                    break;
                case '3':
                    document.getElementById('financial_2').style.display = 'none';
                    document.getElementById('financial_1').style.display = 'none';
                    document.getElementById('financial_3').style.display = 'block';
                    break;
                default://  alert('do nothing');
            }
        }

    function resetActive(event, percent, step) {
        // $(".progress-bar").css("width", percent + "%").attr("aria-valuenow", percent);
        // $(".progress-completed").text(percent + "%");
        /*
        $("div").each(function () {
            if ($(this).hasClass("activestep")) {
                $(this).removeClass("activestep");
            }
        });

        if (event.target.className == "col-md-2") {
            $(event.target).addClass("activestep");
        }
        else {
            $(event.target.parentNode).addClass("activestep");
        }*/

        hideSteps();
        showCurrentStepInfo(step);
    }

    function hideSteps() {
        $("div").each(function () {
            if ($(this).hasClass("activeStepInfo")) {
                $(this).removeClass("activeStepInfo");
                $(this).addClass("hiddenStepInfo");
            }
        });
    }

    function showCurrentStepInfo(step) {
        var id = "#step-" + step;
        $(id).addClass("activeStepInfo");
        $("div").each(function () {
            if ($(this).hasClass("activestep")) {
                $(this).removeClass("activestep");
            }
        });
        $('#div'+step).addClass("activestep");
    }
</script>


@endsection
