<form id="bill_infofrm" method="POST">
@csrf            
<input type="hidden" name="step" value="step3" class="form-control">
<input type="hidden" name="injury_id" id="injury_id" value="" class="form-control">
<input type="hidden" name="patient_id" id="patient_id" value="" class="form-control">
<div class="col-md-12 well text-center">
<section>
    <div class="col-md-12 well text-center"> 
        <div class="col-md-6" style="float:left;">
            <div class="form-row form-group">
                <div class="form-holder col-md-6" style=" margin-bottom: 1rem;">
                    <label for="" style="float:left;">   Place of Services      </label>
                    <select name="service_code_id" id="service_code_id" class="form-control">
                        <option value="" class="option">Select</option>
                        @foreach ($service_codes as $service_code)
                        <option value="{{$service_code->id}}">{{$service_code->code }} {{$service_code->place_of_service_name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-holder col-md-6" style=" margin-bottom: 1rem;">
                    <label for="" style="float:left;">   Rendering Provider      </label>
                    <select name="health_provider_id" id="health_provider_id" class="form-control">
                        <option value="" class="option">Select</option>
                        @foreach ($render_providers as $render_provider)
                        <option value="{{$render_provider->id}}">{{$render_provider->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-holder col-md-6" style=" margin-bottom: 1rem;">
                    <label for="" style="float:left;">   Start DOS      </label>
                    <input type="date" name="start_dos" id="start_dos" class="form-control">
                </div>
            </div>
        </div>
        <div class="col-md-6" style="float:left;">
            <div class="form-row form-group">
                <div class="form-holder col-md-6" style=" margin-bottom: 1rem;">
                    <label for="" style="float:left;"> Authorization Number  </label>
                    <input type="text" name="authorization_no" id="authorization_no" class="form-control">
                </div>
                <div class="form-holder col-md-6" style=" margin-bottom: 1rem;">
                    <label for="" style="float:left;"> Practice Bill ID  </label>
                    <input type="text" name="practice_bill_id" id="practice_bill_id" class="form-control">
                </div>
                <div class="form-holder col-md-6" style=" margin-bottom: 1rem;">
                    <label for="" style="float:left;">   Admission Date      </label>
                    <input type="date" name="admission_date" id="admission_date" class="form-control">
                </div>
                <div class="form-holder col-md-6" style=" margin-bottom: 1rem;">
                    <label for="" style="float:left;"> DOS End    </label>
                    <input type="date" name="end_dos" id="end_dos" class="form-control">
                </div>
            </div>
            <div class="form-row form-group"  id="providerDiv0">
                <div class="form-holder col-md-6">
                    <label for="" style="float:left;"> Provider Type  </label>
                    <select name="bill_provider_type[0][type_id]" class="form-control">
                        <option value="" class="option">Select</option>
                        @foreach ($bill_provider_types as $type)
                        <option value="{{$type}}">{{$type}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-holder col-md-5">
                    <label for="" style="float:left;"> Provider Name  </label>
                    <input type="text" name="bill_provider_type[0][provider_name]" class="form-control">
                </div>
                <div class="form-holder col-md-1" id="addOption">
                    <label style="float:left;"><a href="javascript:void(0);" onclick="addCtrl()"> + Add </a> </label>
                </div>                
            </div>
            @for($j = 1; $j < 5; $j++)
            <div class="form-row form-group"  id="providerDiv{{$j}}" style="display:none;">
                <div class="form-holder col-md-6">
                    <label for="" style="float:left;"> Provider Type  </label>
                    <select name="bill_provider_type[{{$j}}][type_id]" class="form-control">
                        <option value="" class="option">Select</option>
                        @foreach ($bill_provider_types as $type)
                        <option value="{{$type}}">{{$type}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-holder col-md-5">
                    <label for="" style="float:left;"> Provider Name  </label>
                    <input type="text" name="bill_provider_type[{{$j}}][provider_name]" class="form-control">
                </div>
                <div class="form-holder col-md-1">
                    <label for="" style="float:left;"><a href="javascript:void(0);" onclick="removeCtrl('providerDiv{{$j}}')"> Remove  </a> </label>
                </div>                
            </div>
            @endfor
        </div>
    </div>    
    <div class="col-xs-12 well text-center" style="float:left;">
        <div class="form-row form-group" style="margin-left: 10px;">
            <div class="form-holder col-md-12" style="float:left;" >   
                <label for="" style="float:left;"> Diagnosis Codes  </label>
            </div>
            <div class="form-holder col-md-1" style="float:left;" >                            
                <input class="form-check-input" checked type="radio" name="diagnosis_code_type" id="icd9" value="1" />
                <label for="icd9" style="cursor:hand;" > ICD-9 </label>
            </div>
            <div class="form-holder col-md-1" style="float:left;" >
                <input class="form-check-input" type="radio" name="diagnosis_code_type" id="icd10" value="2"/>
                <label style="cursor:hand;" for="icd10">   ICD-10     </label>
            </div>                            
        </div>
        <div class="form-row form-group">
            <div class="form-holder col-md-3">
                <select name="diagnose_code_id[0][value]" id="diagnose_code_id1" class="form-control">
                    <option value="" class="option">Select</option>
                    @foreach ($diagnoses as $diagnosis)
                    <option value="{{$diagnosis->id}}">{{$diagnosis->diagnosis_code }} {{$diagnosis->diagnosis_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-holder col-md-3">
                <select name="diagnose_code_id[1][value]" id="diagnose_code_id2" class="form-control">
                    <option value="" class="option">Select</option>
                    @foreach ($diagnoses as $diagnosis)
                    <option value="{{$diagnosis->id}}">{{$diagnosis->diagnosis_code }}  {{$diagnosis->diagnosis_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-holder col-md-3">
                <select name="diagnose_code_id[2][value]" id="diagnose_code_id3" class="form-control">
                    <option value="" class="option">Select</option>
                    @foreach ($diagnoses as $diagnosis)
                    <option value="{{$diagnosis->id}}">{{$diagnosis->diagnosis_code }}  {{$diagnosis->diagnosis_name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-holder col-md-3">
                <select name="diagnose_code_id[3][value]" id="diagnose_code_id4" class="form-control">
                    <option value="" class="option">Select</option>
                    @foreach ($diagnoses as $diagnosis)
                    <option value="{{$diagnosis->id}}">{{$diagnosis->diagnosis_code }}  {{$diagnosis->diagnosis_name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-row form-group">
            <div class="form-holder col-sm-12" style="float:left;" > 
                <label for="" style="float:left;">Service Line Items </label>
            </div>
        </div>
        @for($k = 0; $k < 5; $k++)
        @if($k == 0)
        <div class="form-row form-group" id="prcd{{$k}}">
        @else
        <div class="form-row form-group" id="prcd{{$k}}" style="display:none;">
        @endif
            <div class="form-holder col-sm-3">
                <label for="" style="float:left;"> Procedure Code  </label>
                <select name="procedure[{{$k}}][code_id]" class="form-control" onchange="addprcdCtrl({{$k}})">
                    <option value="" class="option">Select</option>
                    @foreach ($procedure_codes as $pcode)
                    <option value="{{$pcode->id}}">{{$pcode->procedure_code}}  ({{$pcode->procedure_code_name}})</option>
                    @endforeach
                </select>
            </div>
            <div class="form-holder col-sm-2">
                <label for="" style="float:left;"> Moddifiers  </label>
                <select name="procedure[{{$k}}][modifier_id]" class="form-control">
                    <option value="" class="option">Select</option>
                    @foreach ($modifiers as $mod)
                    <option value="{{$mod->id}}">{{$mod->modifier_code}}  ({{$mod->modifier_name}})</option>
                    @endforeach
                </select>
            </div>
            <div class="form-holder col-sm-2">
                <label for="" style="float:left;"> Unit  </label>
                <input type="text" name="procedure[{{$k}}][unit]" placeholder="{{$k}}" class="form-control">
            </div>
            <div class="form-holder col-sm-5">
                <label for="" style="text-align:left;"> Diag Codes  </label>
                <div class="form-holder col-sm-12">
                    <select name="" id="" class="form-control col-sm-3" style="float: left;">
                        <option value="" class="option">Select</option>
                    </select>
                    <select name="" id="" class="form-control col-sm-3" style="float: left;">
                        <option value="" class="option">Select</option>
                    </select>
                    <select name="" id="" class="form-control col-sm-3" style="float: left;">
                        <option value="" class="option">Select</option>
                    </select>
                    <select name="" id="" class="form-control col-sm-3">
                        <option value="" class="option">Select</option>
                    </select>
                </div>
            </div>
        </div>
        @endfor
    </div>
    <div class="col-xs-12 col-sm-12" style="text-align: center; float: left;">
        <button type="button" class="btn btn-primary pull-left" onclick="show_content('patient_info')">Cancel</button>
        <button type="button" class="btn btn-primary pull-right" onclick="save_injury_bill('step2', 'bill_infofrm')">Save</button>
    </div>
    </section>
</div>
</form>
<script src="{{ asset('js/controller/bills.js') }}"></script>