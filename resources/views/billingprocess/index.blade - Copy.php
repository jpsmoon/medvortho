@extends('layouts.home-app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Products</h2>
            </div>
            <div class="pull-right">
                @can('product-create')
                <a class="btn btn-success" href="{{ route('products.create') }}"> Create New Product</a>
                @endcan
            </div>
        </div>
    </div>

    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            <p>{{ $message }}</p>
        </div>
    @endif

    <div class="container" style="margin-top: 100px; margin-bottom: 100px;">
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
                <div id="div1" class="col-md-2 activestep" onclick="javascript: resetActive(event, 0, 'step-1');">
                    <span class="fa fa-cloud-download"></span>
                    <p>Patient</p>
                </div>
                <div class="col-md-2" onclick="javascript: resetActive(event, 20, 'step-2');">
                    <span class="fa fa-pencil"></span>
                    <p>Financial Class</p>
                </div>
                <div class="col-md-2" onclick="javascript: resetActive(event, 40, 'step-3');">
                    <span class="fa fa-refresh"></span>
                    <p>Bill</p>
                </div>
                <div class="col-md-2" onclick="javascript: resetActive(event, 60, 'step-4');">
                    <span class="fa fa-dollar"></span>
                    <p>Document</p>
                </div>
                <div class="col-md-2" onclick="javascript: resetActive(event, 80, 'step-5');">
                    <span class="fa fa-cloud-upload"></span>
                    <p>Submit Application</p>
                </div>
                <div id="last" class="col-md-2" onclick="javascript: resetActive(event, 100, 'step-6');">
                    <span class="fa fa-star"></span>
                    <p>Send Feedback</p>
                </div>
            </div>
        </div>
        <div class="row setup-content step activeStepInfo" id="step-1">
            <div class="col-xs-12">
                <div class="col-md-12 well text-center">
                    <h1>STEP 1</h1>
                    <h3 class="underline">Instructions</h3>
                    Download the application form from our repository.
                    This may require logging in.
                </div>
            </div>
        </div>
        <div class="row setup-content step hiddenStepInfo" id="step-2">
            <div class="col-xs-12">
                <div class="col-md-12 well text-center">
                    <h1>STEP 2</h1>
                    <h3 class="underline">Instructions</h3>
                    Fill out the application.
                    Make sure to leave no empty fields.
                </div>
            </div>
        </div>
        <div class="row setup-content step hiddenStepInfo" id="step-3">
            <div class="col-xs-12">
                <div class="col-md-12 well text-center">
                    <h1>STEP 3</h1>
                    <h3 class="underline">Instructions</h3>
                    Check to ensure that all data entered is valid.
                </div>
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
    <script type="text/javascript">
    function resetActive(event, percent, step) {
        // $(".progress-bar").css("width", percent + "%").attr("aria-valuenow", percent);
        // $(".progress-completed").text(percent + "%");

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
        }

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
        var id = "#" + step;
        $(id).addClass("activeStepInfo");
    }
</script>

@endsection
