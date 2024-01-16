@extends('layouts.home-new-app')
@section('content')
<style type="text/css">
.activeTab{
    border-bottom: 2px solid blue;
}
.inactiveTab{
    border-bottom: none;
}
</style>
<!-- Modal content -->
<div id="addModal" class="modal">
 <div class="modal-content medium">
    <div class="modal-header">
      <div id="modal_title">+ Add Document</div>
      <span class="close" onclick="hide_modal()">&times;</span>
    </div>
    <div class="modal-body">
        <div class="row">
            <div class="row step">
                <div id="div1" class="col-sm-3 activeTab" onclick="show_content('1', '2');" style="text-align: center;">
                    <h4>Upload</h4>
                    <span class="fa fa-cloud-download"></span>
                </div>
                <div id="div2" class="col-sm-3" onclick="show_content('2', '1');" style="text-align: center;">
                    <h4>Library</h4>
                    <span class="fa fa-pencil"></span>
                </div>
            </div>
        </div>
        <div class="row" style="margin-top:10px;">
            <div class="row" id="step1">
                <form id="docForm" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="bill_id" id="bill_id" value="{{$bill_details->id}}">
                    <div class="form-row form-group">
                        <div class="form-holder col-md-6">
                            <strong>Document<span class="required">* </span>:</strong>
                            <input type="file" name="document_name" id="document_name" class="form-control">
                        </div>
                        <div class="form-holder col-md-6">
                            <strong>Report Type<span class="required">* </span>:</strong>
                            <select name="report_type_id" id="report_type_id" class="form-control" >
                                <option value="">Select</option>
                                @foreach($report_types as $type)
                                <option value="{{$type->id}}">{{$type->report_code}} - {{$type->report_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                        <button type="button" class="btn btn-primary" onclick="hide_modal()" >Close</button>
                        <button type="button" class="btn btn-primary" onclick="save_bill_document('docForm')" >Submit</button>
                    </div>
                </form>
            </div>
            <div class="row" id="step2" style="display:none;margin-left: 0px;">
                <table class="table">
                    <tr style="background-color:lavender;">
                        <th>Filename</th>
                        <th>Description</th>
                        <th>Uploaded On</th>
                    </tr>
                    <tbody id="LibraryDocspopup">
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
                <div class="col-xs-12 col-sm-12 col-md-12">
                    <button type="button" class="btn btn-primary" onclick="hide_modal()" >Close</button>
                </div>
            </div>
        </div>
    </div>
  </div>
</div>
<!-- Modal content -->
<div class="row">
    <div class="col-md-9">
        <h2>Bill's Info [#{{$bill_details->id}}]</h2>
    </div>
    <div class="col-md-3" style="text-align:right;">
        <a class="btn btn-primary" href="{{ route('patients.index') }}"> Back</a>
    </div>
</div>
<div class="row">
    <div class="row step">
        <div id="div1" class="col-md-3 activestep">
            <a class="" href="{{ route('patients.show',$bill_details->patient_id) }}" style="color: #858796;">
            <span class="fa fa-cloud-download"></span>
            <small><b>{{$bill_details->patient_name}}</b>
                <br>Patient<br><b>DOB</b>&nbsp;{{$bill_details->dob}}&nbsp;&nbsp;&nbsp;<b>SSN</b>&nbsp;{{$bill_details->ssn_no}}
            </small></a>
        </div>
        <div id="div2" class="col-md-3">
            <span class="fa fa-pencil"></span>
            <span><b>{{($bill_details->financial_class == 1) ? 'Worker Comp.' : (($bill_details->financial_class == 2) ? 'Private / Government' : 'Personal Injury')}}</b><br>{{$bill_details->injury_name}}</span>
        </div>
        <div id="injuryOptions" class="col-md-2"></div>
    </div>
</div>
    <div class="col-sm-7" style="float:left;padding: 10px;margin: 5px;">
        <div style="background-color: lavender;">
            <h4>Bill Information</h4>
        </div>
        <table>
            <tr>
                <td style="padding-bottom: 5px;"><b>DOS</b></td><td>{{$bill_details->start_dos}}</td>
            </tr>
            <tr>
                <td style="padding-bottom: 5px;"><b>Place of Service</b></td><td>{{$bill_details->place_of_service}}</td>
            </tr>
            <tr>
                <td style="padding-bottom: 5px;"><b>Place of Service Code</b></td><td>{{$bill_details->service_code}}</td>
            </tr>
            <tr>
                <td style="padding-bottom: 5px;"><b>Rendering Provider</b></td><td>{{$bill_details->render_provider_name}}</td>
            </tr>
            <tr>
                <td style="padding-bottom: 5px;"><b>Rendering Provider Type</b></td><td>{{$bill_providers[0]->bill_provider_type}}</td>
            </tr>
            <tr>
                <td style="padding-bottom: 5px;"><b>Supervising Provider</b></td><td>{{$bill_providers[0]->provider_name}}</td>
            </tr>
            <tr>
                <td style="padding-bottom: 5px;"><b>Admission Date</b></td><td>{{$bill_details->admission_date}}</td>
            </tr>
            <tr>
                <td style="padding-bottom: 5px;"><b>Diagnosis Codes</b></td><td>{{$bill_diagnoses->diagnosis_name}}</td>
            </tr>
            <tr>
                <td style="padding-bottom: 5px;"><b>Additional Information</b></td><td>{{$bill_details->description}}</td>
            </tr>
        </table>
    </div>
    <div class="col-sm-4" style="float:left;/*padding: 10px;margin: 5px;*/">
        <div class="col-sm-12" style="float:left;padding: 10px;margin: 5px;">
            <div style="background-color: lavender;">
                <h4>Patient Demographics</h4>
            </div>
            <table>
                <tr>
                    <td style="padding-bottom: 5px;"><b>Name</b></td><td>{{$bill_details->patient_name}}</td>
                </tr>
                <tr>
                    <td style="padding-bottom: 5px;"><b>DOB</b></td><td>{{$bill_details->dob}}</td>
                </tr>
                <tr>
                    <td style="padding-bottom: 5px;"><b>SSN</b></td><td>{{$bill_details->ssn_no}}</td>
                </tr>
            </table>
        </div>
        <div class="col-sm-12" style="float:left;padding: 10px;margin: 5px;">
            <div style="background-color: lavender;">
                <h4>Injury Information</h4>
            </div>
            <table>
                <tr>
                    <td style="padding-bottom: 5px;"><b>Financial Class</b></td><td>
                        {{($bill_details->financial_class == 1) ? 'Worker Comp.' : (($bill_details->financial_class == 2) ? 'Private / Government' : 'Personal Injury')}}</td>
                </tr>
                <tr>
                    <td style="padding-bottom: 5px;"><b>Employer</b></td><td>{{$bill_details->employer_name}}</td>
                </tr>
                <tr>
                    <td style="padding-bottom: 5px;"><b>DOI</b></td><td>{{$bill_details->start_date}}</td>
                </tr>
                <tr>
                    <td style="padding-bottom: 5px;"><b>Claims Administrator</b></td><td>{{$bill_details->claim_admin}}</td>
                </tr>
                <tr>
                    <td style="padding-bottom: 5px;"><b>Claim Number</b></td><td>{{$bill_details->claim_no}}</td>
                </tr>
                <tr>
                    <td style="padding-bottom: 5px;"><b>State</b></td><td>{{$bill_details->injury_state}}</td>
                </tr>
            </table>
        </div>
    </div>
    <div class="col-sm-12" style="float:left;padding: 10px;margin: 5px;">
        <table width="90%" class="table table-hovered">
            <tr style="background-color: lavender;">
                <th width="30%">Procedure Code</th>
                <th width="20%">Units</th>
                <th width="20%">Charge</th>
                <th>Expected Fee Schedule</th>
            </tr>
            @foreach($bill_prc_codes as $code)
            <tr>
                <td>{{$code->procedure_code}} :{{$code->modifier_code}}</td>
                <td>{{$code->unit}}</td>
                <td>N/A</td>
                <td>N/A</td>
            </tr>
            @endforeach
            <tr style="background-color: lightgray;">
                <td colspan="2">Bill Totals</td>
                <td></td>
                <td></td>
            </tr>
        </table>
    </div>
    <div class="col-sm-12" style="float:left;padding: 10px;margin: 5px;">
        <div>
            <h4>Documents
                <a class="btn btn-primary" id="myBtn" onclick="show_addmodal();"> + Add</a>
            </h4>
            <a href="/billinfos/printpdf/{{$bill_details->id}}" target="_blank">View CMS 1500</a>
        </div>
        <table width="90%" class="table table-hovered">
            <tr style="background-color: lavender;">
                <th width="30%">Filename</th>
                <th width="20%">Report</th>
                <th width="20%">Uploaded On</th>
                <th>Actions</th>
            </tr>
            <tbody id="billDocs">
            @foreach($bill_docs as $doc)
                <tr>
                    <td>{{$doc->document_name}}</td>
                    <td>{{$doc->report_code}}-{{$doc->report_name}}</td>
                    <td>{{$doc->uploaded_on}}</td>
                </tr>
            @endforeach
             </tbody>
        </table>
    </div>
    <div class="col-sm-12" style="float:left;padding: 10px;margin: 5px;">
        <div>
            <h4>RFAs & Utilization Review Decision</h4>
        </div>
        <table width="90%" class="table table-hovered">
            <tr style="background-color: lavender;">
                <th width="30%">Filename</th>
                <th width="20%">Report</th>
                <th width="20%">Uploaded On</th>
                <th>Actions</th>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
        </table>
    </div>
<script type="text/javascript">
    function show_content(step, nxt) {
        hideSteps();
        $('#div'+step).removeClass("inactiveTab");
        $('#div'+step).addClass("activeTab");
        document.getElementById('step'+nxt).style.display = 'none';
        document.getElementById('step'+step).style.display = 'flex';
    }

    function hideSteps() {
        $("div").each(function () {
            if ($(this).hasClass("activeTab")) {
                $(this).removeClass("activeTab");
                $(this).addClass("inactiveTab");
            }
        });
    }
</script>
<script src="{{ asset('js/controller/bills.js') }}"></script>
@endsection
