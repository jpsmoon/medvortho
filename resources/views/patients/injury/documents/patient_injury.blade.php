                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12">
                                    <div class="col-12">
                                        @if($docType != 'Bill')
                                            <div class="form-row">
                                                <div class="form-group col-md-5">
                                                    <label for="description3"> Description <span class="required">* </span> </label>
                                                    <textarea data-validation-event="change" data-validation="required" data-validation-error-msg="" id="description3" 
                                                    class="form-control" name="description3" >{{($documents && $documents->description) ? $documents->description : ''}}</textarea>
                                                    @if($errors->has('description3'))
                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                        <strong class="invalid-feedback">{{ $errors->first('description3') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                                <div class="form-group col-md-5">
                                                    <label for="stateDD">Report Type </label>
                                                    <select name="injury_reporting_type" class="form-control searcDrop" id="injury_reporting_type">
                                                        <option value="" class="option">Select</option>
                                                        @foreach ($reportType as $report)
                                                        <option value="{{$report["id"]}}" {{($documents && $documents->reporting_type == $report["id"]) ? 'selected' : ''}}>{{$report["report_code"]}} - {{$report["report_name"]}}</option>
                                                        @endforeach
                                                    </select>
                                                    @if($errors->has('injury_reporting_type'))
                                                    <span class="invalid-feedback" style="display:block" role="alert">
                                                        <strong class="invalid-feedback" >{{ $errors->first('injury_reporting_type') }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                        @endif
                                            @if($documents && $documents->injury_document)
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <a href="{{ asset('/injury_document/'.$documents->injury_document)}}" target="_blank">
                                                    <img src="{{ asset('new_assets/app-assets/images/pdf-icon.png') }}" alt="{{ asset('/injury_document/'.$documents->injury_document)}}" width="5%"/>
                                                    <br>
                                                    {{$documents->injury_document}}
                                                    </a>
                                                </div>
                                            </div>
                                            @endif
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <!--<div class="drop-zone">
                                                        <span class="drop-zone__prompt">
                                                            Drap file here or click her
                                                        </span>
                                                        <input type="file" name="myFile" class="drop-zone__input">
                                                    </div>-->
                                                    <div class="img-zone text-center" id="img-zone">
                                                        <div class="img-drop">
                                                            <h2><small>Drag &amp; Drop File Here</small></h2>
                                                            <p><em>- or -</em></p>
                                                            <h2><i class="glyphicon glyphicon-camera"></i></h2>
                                                            <span class="btn btn-success btn-file">
                                                                Click to Open File Browser<input type="file"  name="myFile"   accept="application/pdf/*">
                                                            </span>
                                                        </div>
                                                    </div>
                                                    <div class="progress hidden">
                                                        <div style="width: 0%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="0" role="progressbar" class="progress-bar progress-bar-success progress-bar-striped active">
                                                            <span class="sr-only">0% Complete</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                          </div>
                                </div>
                            </div>