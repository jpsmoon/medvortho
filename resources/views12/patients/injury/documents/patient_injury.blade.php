<style>
    #nav-stats {
    padding: 0px;
    background: #fff;
    margin:0px;
}
.tab-content{
    min-height:auto;
}
</style>
<div class="row">
<div class="col-12 col-md-12 mt-1">
    <nav>
        <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
            <a class="nav-item nav-link active" id="nav-task-tab" data-toggle="tab" href="#nav-task" role="tab" aria-controls="nav-task" aria-selected="true"><i class="fa-solid fa-list-check"></i> Upload</a>
            @if ($docType == 'Bill' && count($providerGallary) > 0)
                <a class="nav-item nav-link" id="nav-stats-tab" data-toggle="tab" href="#nav-stats" role="tab" aria-controls="nav-stats" aria-selected="false"><i class="fa-solid fa-signal"></i> Document Library</a>
            @endif
        </div>
    </nav>
    <div class="tab-content" id="nav-tabContent">
        <div class="tab-pane fade show active" id="nav-task" role="tabpanel" aria-labelledby="nav-task-tab">
            <div class="col-12">
                <div class="form-row">
                    <div class="form-group col-md-5">
                        <label for="description3"> Description <span class="required">* </span> </label>
                        <textarea data-validation-event="change" data-validation="required" data-validation-error-msg="" id="description3"
                            class="form-control" name="description3">{{ $documents && $documents->description ? $documents->description : '' }}</textarea>
                        @if ($errors->has('description3'))
                            <span class="invalid-feedback"
                                style="display:block" role="alert">
                                <strong
                                    class="invalid-feedback">{{ $errors->first('description3') }}</strong>
                            </span>
                        @endif
                    </div>
                    <div class="form-group col-md-5">
                        <label for="stateDD">Report Type <span class="required">* </span></label>
                        <select data-validation-event="change" data-validation="required" data-validation-error-msg="" name="injury_reporting_type"
                            class="form-control searcDrop"
                            id="injury_reporting_type">
                            <option value="" class="option">
                                Select</option>
                            @foreach ($reportType as $report)
                                <option value="{{ $report['id'] }}"
                                    {{ $documents && $documents->reporting_type == $report['id'] ? 'selected' : '' }}>
                                    {{ $report['report_code'] }} -
                                    {{ $report['report_name'] }}
                                </option>
                            @endforeach
                        </select>
                        @if ($errors->has('injury_reporting_type'))
                            <span class="invalid-feedback"
                                style="display:block" role="alert">
                                <strong
                                    class="invalid-feedback">{{ $errors->first('injury_reporting_type') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
                @if ($documents && $documents->injury_document)
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{ asset('/injury_document/' . $documents->injury_document) }}" target="_blank">
                                <img src="{{ asset('public/new_assets/app-assets/images/pdf-icon.png') }}" style="width: 5%; " alt="{{ asset('/injury_document/' . $documents->injury_document) }}" width="auto" height="auto" />
                                <!--{{ $documents->injury_document }}-->
                            </a>
                        </div>
                    </div>
                @endif
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <div class="img-zone text-center" id="img-zone">
                            <div class="img-drop">
                                <h2><i class="fa-solid fa-cloud-arrow-up"></i></h2>
                                <h2><small>Drag &amp; Drop File
                                        Here</small></h2>
                                <p><em>- or -</em></p>
                                <span class="btn btn-success btn-file">
                                    Click to Open File Browser<input
                                        type="file" name="myFile"
                                        accept="application/pdf/*">
                                </span>
                            </div>
                        </div>
                        <div class="progress hidden">
                            <div style="width: 0%" aria-valuemax="100"
                                aria-valuemin="0" aria-valuenow="0"
                                role="progressbar"
                                class="progress-bar progress-bar-success progress-bar-striped active">
                                <span class="sr-only">0% Complete</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        
         @if ($docType == 'Bill' && count($providerGallary) > 0)
        <div class="tab-pane fade" id="nav-stats" role="tabpanel" aria-labelledby="nav-stats-tab">
            <div class="col-12">
                <div class="table-responsive">
                            <table id="exampleGallary" class="table layout-secondary dataTable table-striped table-bordered">
                            <thead class="thead-dark">
                                <tr>
                                    <th scope="col">S.No#</th>
                                    <th scope="col">File Name</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Uploaded On</th> 
                                </tr>
                            </thead>
                                <tbody>
                                     @if(count($providerGallary))
                                     @php $i = 0; @endphp
                                        @foreach ($providerGallary as $gallary)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            <td> 
                                                <span>
                                                <input   type="checkbox" name="documentGallaryid[]" id="documentGallaryid_{{$i}}" value="{{$gallary->id}}">
                                                </span>
                                                {{$gallary->injury_document}} 
                                            </td>
                                            <td> {{$gallary->description}} </td>
                                            <td> {{$gallary->created_at}} </td>
                                        </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
            </div>
        </div>
        @endif
    </div>
</div>
</div>