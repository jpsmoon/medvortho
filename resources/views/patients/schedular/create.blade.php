<form id="schedularFrm" action="{{ route('savePatientSchedular') }}" enctype="multipart/form-data" class="form-horizontal ladda-form'" method="POST">
                    <div class="modal-header">
                        <h4 align="center" id="modalTitle" class="modal-title"><i class="fa-regular fa-calendar-plus"></i> Add Appointment</h4>
                        <button type="button" onclick="hideModel();" class="close" data-dismiss="modal">&times;</button>                        
                    </div>
                    <div id="modalBody" class="modal-body" >
                        @csrf
                        <input type="hidden" name="urlFrom" id="urlFrom" value="{{$urlFrom}}" >
                         <div class="row">
                            <div class="form-group col-md-12">
                                <label for="patientSearchId"> Patient<span class="required">* </span></label>
                                <input autocomplete="off" value="{{ ($patientInfo) ? $patientInfo->id : '' }}"   type="hidden" name="patientId" id="showPatientId" class="form-control" >
                                <input autocomplete="off" value="{{ ($patientInfo && $patientInfo->first_name) ? $patientInfo->first_name : '' }} {{ ($patientInfo && $patientInfo->last_name) ? $patientInfo->last_name : '' }}" placeholder="Enter patient name, patient id" type="text" name="patientSearchId" id="patientSearchId" class="form-control" data-validation-event="change" data-validation="required" data-validation-error-msg="">
                                <ul id="searchPatientDiv" class="autoCompete-css"></ul>
                                @if($errors->has('patientId'))
                                <span class="invalid-feedback" style="display:block" role="alert">
                                    <strong>{{ $errors->first('patientId') }}</strong>
                                </span>
                                @endif
                           </div>
                        </div> 
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="appointment_date"> Appointment Date</label>
                                    <input autocomplete="off"  placeholder="Select appointment date" type="text" name="appointment_date" id="appointment_date" class="form-control" data-validation-event="change" data-validation="required" data-validation-error-msg="">
                                    <span id="showHolidayError" class="" style="display:none" role="alert"><strong></strong> </span>
                                    @if($errors->has('appointment_date'))
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong>{{ $errors->first('appointment_date') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="appointment_time"> Appointment Time</label>
                                    <input autocomplete="off" type="text" name="appointment_time" class="form-control timepicker" data-validation-event="change" data-validation="required" data-validation-error-msg="">
                                    @if($errors->has('appointment_time'))
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong>{{ $errors->first('appointment_time') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="appointment_provider">Billing Provider<span class="required">* </span></label>
                                    <select onchange="getProviderServiceLocation(this.value);" id="appointment_provider" name="appointment_provider" class="form-control 4col formcls" data-validation-event="change" data-validation="required" data-validation-error-msg="">
                                        
                                    </select>
                                    @if($errors->has('appointment_provider'))
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong>{{ $errors->first('appointment_provider') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="appointment_location"> Rendering Provider</label>
                                    <select id="apt_rendering_id" name="apt_rendering_id" class="form-control">
                                        <option value=''>-Select-</option>
                                    </select>

                                    @if($errors->has('appointment_location'))
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong>{{ $errors->first('appointment_location') }}</strong>
                                    </span>
                                    @endif
                                </div>                   
                            </div>
                            <div class="row"> 
                                <div class="form-group col-md-6">
                                    <label for="appointment_location"> Practice Location</label>
                                    <select id="apt_loc_id" name="appointment_location" class="form-control 4col formcls">
                                        <option value=''>-Select-</option>
                                    </select> 
                                    @if($errors->has('appointment_location'))
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong>{{ $errors->first('appointment_location') }}</strong>
                                    </span>
                                    @endif
                                </div> 
                                <div class="form-group col-md-6">
                                    <label for="appointment_resource"> Resource</label>
                                    <input autocomplete="off" type="text" name="appointment_resource" class="form-control">
                                    @if($errors->has('appointment_resource'))
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong>{{ $errors->first('appointment_resource') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="appointment_case">Case No</label>
                                    <select id="appointment_case_id" name="appointment_case" class="form-control 4col formcls">
                                        <option value=''>-Select-</option>  
                                </select>
                                    @if($errors->has('appointment_case'))
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong>{{ $errors->first('appointment_case') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="appointment_resource">Authorization</label>
                                    <input autocomplete="off" type="text" name="appointment_authorization" id="appointment_authorization" class="form-control">
                                    @if($errors->has('appointment_authorization'))
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong>{{ $errors->first('appointment_authorization') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="appointment_resason"> Reason</label>
                                    <select id="appointment_resason_id" name="appointment_resason" class="form-control 4col formcls" data-validation-event="change" data-validation="required" data-validation-error-msg="">
                                        <option value=''>-Select-</option> 
                                </select>
                                    @if($errors->has('appointment_reason'))
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong>{{ $errors->first('appointment_reason') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="appointment_meeting_Type"> Meeting Type</label>
                                    <select name="appointment_meeting_Type" class="form-control" data-validation-event="change" data-validation="required" data-validation-error-msg="">
                                        <option value=''>-Select-</option>
                                        @foreach ($meetingTypes as $meetingType)
                                            <option value="{{$meetingType['id'] }}">{{$meetingType['name'] }}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->has('appointment_meeting_Type'))
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong>{{ $errors->first('appointment_meeting_Type') }}</strong>
                                    </span>
                                    @endif
                                </div> 
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="mi"> Duration</label>
                                    <select name="appointment_duration" class="form-control 4col formcls" data-validation-event="change" data-validation="required" data-validation-error-msg="">
                                        <option value=''>-Select-</option>
                                        <?PHP for ($j = 5; $j <= 200; $j += 5) {?>
                                        <option value="<?PHP echo $j; ?>">{{$j}}</option>
                                        <?php }?>
                                    </select>
                                    @if($errors->has('appointment_meeting_Type'))
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong>{{ $errors->first('appointment_meeting_Type') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                 <div class="form-group col-md-6">
                                     <div class="row" style="padding-top:29px; PADDING-LEFT: 10px;">
                                <div class="form-group col-md-3">
                                    <label for="appointment_recurrene"></label>
                                    <input type="checkbox" class="largerCheckbox" name="appointment_recurrene"> <span style="vertical-align:top"> Recurrene</span>
                                    @if($errors->has('appointment_recurrene'))
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong>{{ $errors->first('appointment_recurrene') }}</strong>
                                    </span>
                                    @endif
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="appointment_interpreter"></label>
                                    <input type="checkbox" class="largerCheckbox" name="is_interpreter"> <span style="vertical-align:top"> Interpreter</span>
                                    @if($errors->has('is_interpreter'))
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong>{{ $errors->first('is_interpreter') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                                     
                                </div>
                                
                            </div>
                            
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="appointment_additionInfo">Addition Information</label>
                                     <textarea class="form-control" id="appointment_additionInfo" name="appointment_additionInfo" rows="4" cols="50"> </textarea> 
                                    @if($errors->has('appointment_additionInfo'))
                                    <span class="invalid-feedback" style="display:block" role="alert">
                                        <strong>{{ $errors->first('appointment_additionInfo') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button  type="submit"  id="sendFormAppointment" class="btn btn-primary ladda-button"><span class="ladda-label">Schedule</span></button>
                        <button type="button" class="btn btn-default"  onclick="hideModel();">Cancle</button>
                    </div>
                </form>