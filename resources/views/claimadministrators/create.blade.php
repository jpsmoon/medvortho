@extends('layouts.home-app')
@section('content')
 <style>
        nav>.nav.nav-tabs {
            border: none;
            color: #fff;
            background: #ccc;
            border-radius: 0;
            width: 100%;
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
                <div class="w-sm-100 mr-auto"><h4 class="mb-0">Add Claim Administrator</h4></div>

                <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                    <li class="breadcrumb-item">
                        <a class="btn btn-primary" href="{{ route('claimadministrators.index') }}"> Back</a>
                    </li>
                </ol>
            </div>
        </div>
    </div>
    <!-- END: Breadcrumbs-->

       @if ($errors->any())
    <div class="row ">
        <div class="col-12  align-self-center">
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
    @endif
 <link href="{{ asset('css/step-content.css') }}" rel="stylesheet">
    <div class="row">
        <div class="col-12 mt-4">
            <div class="card row-background">
                <div class="card-body">
                <nav>
                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                        <a class="nav-item nav-link active" id="nav-main-tab" data-toggle="tab" href="#nav-main" role="tab" aria-controls="nav-main" aria-selected="true">Main</a>
                        <a class="nav-item nav-link" id="bill-review-tab" data-toggle="tab" href="#bill-review" role="tab" aria-controls="bill-review" aria-selected="false">Bill Review</a>
                        <a class="nav-item nav-link" id="authorised-tab" data-toggle="tab" href="#authorisation-tab" role="tab" aria-controls="authorisation-tab" aria-selected="false">Authorization Info</a>
                        <a class="nav-item nav-link" id="mailing-address-tab" data-toggle="tab" href="#mailing-address" role="tab" aria-controls="mailing-address" aria-selected="false">Mailing Address</a>
                    </div>
                </nav>
                <div class="tab-content  " id="nav-tabContent">
                    <div class="tab-pane fade show active p-1" id="nav-main" role="tabpanel" aria-labelledby="nav-main-tab">
                        <form id="frmClaim1" method="POST">
                            @csrf
                            <input type="hidden" name="step" class="form-control" value="step1">
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="" style="float:left;"> Type  <span class="required">* </span> </label>
                                    <select name="company_type_id" class="form-control stateDD" id="stateDD">
                                        <option value="" class="option">Select</option>
                                        @foreach ($company_types as $company_type)
                                        <option value="{{$company_type->id}}"> {{$company_type->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="" style="float:left;">   DaisyBill Payer ID  <span class="required">* </span>  </label>
                                    <input type="text" name="payer_id" class="form-control" maxlength="25">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="" style="float:left;">  Payer  <span class="required">* </span>  </label>
                                    <input type="text" name="payer_name" class="form-control" maxlength="25">
                                </div>
                                <div class="form-holder col-md-4">
                                    <label for="" style="float:left;">  Name <span class="required">* </span>     </label>
                                    <input type="text" name="name" class="form-control"  maxlength="155" >
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="" style="float:left;"> Alias Name     </label>
                                    <input type="text" name="alias" class="form-control"  maxlength="25">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="" style="float:left;">  Contact No.       </label>
                                    <input type="text" name="contact_no" class="form-control" maxlength="25">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="" style="float:left;">  Website <span class="required">* </span>     </label>
                                    <input type="text" name="website" class="form-control"  maxlength="155">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="" style="float:left;">    Email ID     </label>
                                    <input type="text" name="email" class="form-control"  maxlength="55">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-md-4">
                                    <label for="" style="float:left;"> Start Time    </label>
                                    <input type="time" name="start_time" class="form-control"  maxlength="10">
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="" style="float:left;"> End Time    </label>
                                    <input type="time" name="end_time" class="form-control"  maxlength="10">
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-holder col-md-4">
                                    <label for="" style="float:left;"> Description  <span class="required">* </span>  </label>
                                    <textarea name="description" class="form-control" style="resize: none;"></textarea>
                                </div>
                                <div class="form-holder col-md-4">
                                    <label for="" style="float:left;"> Bill Process Flow Note     </label>
                                    <textarea name="bill_process_flow_note" class="form-control" style="resize: none;"></textarea>
                                </div>
                            </div>
                            <div class="col-xs-4 col-sm-4 col-md-4 text-right">
                                <button type="button" class="btn btn-primary" onclick="save_claim('nav-main', 'frmClaim1')">Next</button>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade p-1 " id="bill-review" role="tabpanel" aria-labelledby="bill-review-tab">
                        <form id="frmClaim2" enctype="multipart/form-data" method="POST">
                            @csrf
                            <input type="hidden" name="step" class="form-control" value="step2">
                            <input type="hidden" name="claim_admin_id" id="claim_admin_id" class="form-control" >

                            <table class="table table-bordered">
                                <tr>
                                    <th>Name</th>
                                    <th>Contact No.</th>
                                    <th>Website</th>
                                    <th>Email</th>
                                    <th>Fax</th>
                                    <th>Address</th>
                                    <th>Option</th>
                                </tr>
                                <tr>
                                    <td><input type="text" name="name[]" class="form-control"  maxlength="155"></td>
                                    <td><input type="text" name="contact_no[]" class="form-control"  maxlength="25"></td>
                                    <td><input type="text" name="website[]" class="form-control"  maxlength="155"></td>
                                    <td><input type="text" name="email[]" class="form-control"  maxlength="55"></td>
                                    <td><input type="text" name="fax_no[]" class="form-control"  maxlength="25"></td>
                                    <td><textarea name="address_line1[]" class="form-control" style="resize: none;"></textarea></td>
                                    <td><a id="addOption" href="javascript:void(0);" onclick="addReviewCtrl()"> + Add More  </a></td>
                                </tr>
                                @for($i = 1; $i <= 5; $i++)
                                <tr id="row{{$i}}"  style="display:none;">
                                    <td><input type="text" name="name[]" class="form-control"  maxlength="155"></td>
                                    <td><input type="text" name="contact_no[]" class="form-control"  maxlength="25"></td>
                                    <td><input type="text" name="website[]" class="form-control"  maxlength="55"></td>
                                    <td><input type="text" name="email[]" class="form-control"  maxlength="55"></td>
                                    <td><input type="text" name="fax_no[]" class="form-control"  maxlength="25"></td>
                                    <td><textarea name="address_line1[]" class="form-control" style="resize: none;"></textarea></td>
                                    <td><a href="javascript:void(0);" onclick="removeCtrl('row{{$i}}')"> Remove  </a> </td>
                                </tr>
                                @endfor
                            </table>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <button type="button" class="btn btn-primary pull-right" onclick="save_claim('bill-review', 'frmClaim2')">Next</button>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade p-1 " id="authorisation-tab" role="tabpanel" aria-labelledby="authorised-tab">
                        <form id="frmClaim3" enctype="multipart/form-data" method="POST">
                            @csrf
                            <input type="hidden" name="step" class="form-control" value="step3">
                            <input type="hidden" name="claim_admin_step3" id="claim_admin_step3" class="form-control" >                            <table class="table table-bordered">
                                <tr>
                                    <th>RFA Fax No.</th>
                                    <th>Contact No.</th>
                                    <th>Option</th>
                                </tr>
                                <tr>
                                    <td><input type="text" name="rfa_fax_no[]" class="form-control"  maxlength="25"></td>
                                    <td><input type="text" name="rfa_contact_no[]" class="form-control"  maxlength="25"></td>
                                    <td><a id="addRfaOption" href="javascript:void(0);" onclick="addRfaCtrl()"> + Add More  </a></td>
                                </tr>
                                @for($i = 1; $i <= 5; $i++)
                                <tr id="rfa{{$i}}"  style="display:none;">
                                    <td><input type="text" name="rfa_fax_no[]" class="form-control"  maxlength="25"></td>
                                    <td><input type="text" name="rfa_contact_no[]" class="form-control"  maxlength="25"></td>
                                    <td><a href="javascript:void(0);" onclick="removeCtrl('rfa{{$i}}')"> Remove  </a> </td>
                                </tr>
                                @endfor
                            </table>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <button type="button" class="btn btn-primary pull-right" onclick="save_claim('authorisation-tab', 'frmClaim3')" >Next</button>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade p-1" id="mailing-address" role="tabpanel" aria-labelledby="mailing-address-tab">
                        <form id="frmClaim4" enctype="multipart/form-data" method="POST">
                            @csrf
                            <input type="hidden" name="step" class="form-control" value="step4">
                            <input type="hidden" name="claim_admin_step4" id="claim_admin_step4" class="form-control" >

                            <table class="table table-bordered">
                                <tr>
                                    <th>Company</th>
                                    <th>Bill Treatment Type</th>
                                    <th>Bill Submission Type</th>
                                    <th>Address</th>
                                    <th>Notes</th>
                                    <th>Option</th>
                                </tr>
                                <tr>
                                    <td><input type="text" name="company_name[]" class="form-control"  maxlength="25"></td>
                                    <td>
                                        <select name="bill_treatment_type_id[]" class="form-control">
                                            <option value="" class="option">Select</option>
                                            @foreach ($bill_treatment_types as $treatment_type)
                                            <option value="{{$treatment_type->id}}"> {{$treatment_type->bill_treatment_type }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select name="bill_submission_type_id[0][]" class="form-control" multiple>
                                            <option value="" class="option">Select</option>
                                            @foreach ($bill_submission_types as $submission_type)
                                            <option value="{{$submission_type->id}}"> {{$submission_type->bill_submission_type }} </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td><textarea name="mail_address_line1[]" class="form-control" style="resize: none;"></textarea></td>
                                    <td><textarea name="notes[]" class="form-control" style="resize: none;"></textarea></td>
                                    <td><a id="addMailOption" href="javascript:void(0);" onclick="addMailCtrl()"> + Add More  </a></td>
                                </tr>
                                @for($i = 1; $i <= 5; $i++)
                                <tr id="mail{{$i}}"  style="display:none;">
                                    <td><input type="text" name="company_name[]" class="form-control"  maxlength="25"></td>
                                    <td>
                                        <select name="bill_treatment_type_id[]" class="form-control">
                                            <option value="" class="option">Select</option>
                                            @foreach ($bill_treatment_types as $treatment_type)
                                            <option value="{{$treatment_type->id}}"> {{$treatment_type->bill_treatment_type }}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td>
                                        <select name="bill_submission_type_id[{{$i}}][]" class="form-control" multiple>
                                            <option value="" class="option">Select</option>
                                            @foreach ($bill_submission_types as $submission_type)
                                            <option value="{{$submission_type->id}}"> {{$submission_type->bill_submission_type }} </option>
                                            @endforeach
                                        </select>
                                    </td>
                                    <td><textarea name="mail_address_line1[]" class="form-control" style="resize: none;"></textarea></td>
                                    <td><textarea name="notes[]" class="form-control" style="resize: none;"></textarea></td>
                                    <td><a href="javascript:void(0);" onclick="removeCtrl('mail{{$i}}')"> Remove  </a> </td>
                                </tr>
                                @endfor
                            </table>

                                <div class="col-xs-12 col-sm-12 col-md-12 text-right">
                                    <button type="button" class="btn btn-primary pull-right" onclick="save_claim('mailing-address', 'frmClaim4')">Submit</button>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="{{ asset('js/controller/claimadministrators.js') }}"></script>
<script>

</script>
<script type="text/javascript">
    function resetActive(event, percent, step, cStep, clickTab, removeClick) {
        $("#"+cStep).addClass('fade');
         $("#"+cStep).removeClass("active show");
        $("#"+step).addClass("active show");
        $("#"+step).removeClass('fade');
         $("#"+clickTab).addClass("active show");
         $("#"+removeClick).removeClass("active show");

    }
</script>