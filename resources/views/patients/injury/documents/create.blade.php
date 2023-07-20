@extends('layouts.home-app')
@section('content')
   <style>

.drop-zone {
  height: 500px;
  padding: 25px;
  display: flex;
  align-items: center;
  justify-content: center;
  text-align: center;
  font-family: "Quicksand", sans-serif;
  font-weight: 500;
  font-size: 20px;
  cursor: pointer;
  color: #cccccc;
  border:3px dashed grey;
  border-radius: 10px;
}
.drop-zone--over {
  border-style: solid;
}
.drop-zone__input {
  display: none;
}
.drop-zone__thumb {
  width: 100%;
  height: 100%;
  border-radius: 10px;
  overflow: hidden;
  background-color: #cccccc;
  background-size: cover;
  position: relative;
}
.drop-zone__thumb::after {
  content: attr(data-label);
  position: absolute;
  bottom: 0;
  left: 0;
  width: 100%;
  padding: 5px 0;
  color: #ffffff;
  background: rgba(0, 0, 0, 0.75);
  font-size: 14px;
  text-align: center;
}

/* css start with new change with progress background*/ 


   </style>
   
<style type="text/css">
    .btn-file {
        position: relative;
        overflow: hidden;
    }
    
    .btn-file input[type=file] {
        position: absolute;
        top: 0;
        right: 0;
        min-width: 100%;
        min-height: 100%;
        font-size: 100px;
        text-align: right;
        filter: alpha(opacity=0);
        opacity: 0;
        outline: none;
        background: white;
        cursor: inherit;
        display: block;
    }
    
    .img-zone {
        background-color: #F2FFF9;
        border: 5px dashed #303630;
        border-radius: 5px;
        padding: 20px;
    }
    
    .img-zone h2 {
        margin-top: 0;
    }
    
    .progress, #img-preview {
        margin-top: 15px;
    }
</style>

<!-- START: Breadcrumbs-->
    <div class="row ">
        <div class="col-12  align-self-center">
            <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                <div class="w-sm-100 mr-auto"><h4 class="mb-0">{{$title}}</h4></div>

                <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                    <li class="breadcrumb-item">
                        <a class="btn btn-primary" href="{{url($url)}}"> Back</a>
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
    @if(session()->has('success'))
    <div class="alert alert-success">
        {{ session()->get('success') }}
    </div>
@endif
    <div class="row">
        <div class="col-9 mt-4">
            <div class="card row-background">
                <div class="card-content">
                    <div class="card-body">
                        <form action="{{ route('storeInjuryBillDocument') }}" enctype="multipart/form-data" id="patientInjuryDocumentFrm" class="form-horizontal ladda-form'" method="POST">
                        @csrf
                        <input type="hidden" name="providerId" id="providerId" value="{{$providerId}}">
                        <input type="hidden" name="injuryId" id="injuryId" value="{{$injuryId}}">
                        <input type="hidden" name="injuryDocumentId" id="injuryDocumentId" value="{{$id}}">
                        <input type="hidden" name="docType" id="docType" value="{{$docType}}">
                        <input type="hidden" name="tempInjuryDocumentId" id="tempInjuryDocumentId" value="">
                        <input type="hidden" name="fileName" id="fileName" value="{{($documents && $documents->injury_document) ? $documents->injury_document : '' }}">
                            @include('patients.injury.documents.patient_injury')
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <button type="submit" id="sendBtn" class="btn btn-primary ladda-button disabled"><span class="ladda-label">Submit</span></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
       @if($docType != 'Provider')
        <div class="col-3 mt-4 rightside">
        @include('patients.show-patient-info')
        </div>
        @endif
    </div>
    @if($allDocuments)
    <div class="row">
        <div class="col-9 mt-4">
            <div class="card row-background">
                <div class="card-content">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table layout-secondary dataTable table-striped table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Id</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Document</th>
                                        <th scope="col">Reporting Type</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                    <tbody>
                                    @if(count($allDocuments))
                                     @php $i = 1 ; @endphp
                                            @foreach ($allDocuments as $document)
                                            <?php  $fileName = $document->injury_document;
                                            ?>
                                            <tr>
                                                <td>{{$i}}</td>
                                               <td>{{$document->description}}</td>
                                               <td><a href="{{ asset('/injury_document/'.$document->injury_document)}}" target="_blank">{{$fileName}}</a></td>
                                               <td>{{($document->getReportType) ? $document->getReportType->report_name : '-'	}}</td>
                                               <td><a  href="{{ url('/patients/injury/documents') }}/{{ $injuryId }}/{{$document->doc_type}}/{{$document->id}}">
                                               <i  class="icon-pencil  showPointer"/></i>
                                               </a>
                                               <i  class="icon-trash showPointer"/></i>
                                               </td>
                                            </tr>
                                            @php $i++; @endphp
                                                @endforeach
                                            @else
                                            <tr>
                                                        <td colspan="10">No Records Found.</td>
                                                </tr>
                                            @endif
                                    </tbody>
                                </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endif
@endsection
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.2.2/pdf.min.js"></script>-->
<!-- <script src="{{ asset('new_assets/app-assets/js/drag-drop-file-with-click.js') }}"></script>-->
<!-- BEGIN VENDOR JS-->
    <script>
    
jQuery(document).ready(function() {
    var img_zone = document.getElementById('img-zone'),
        collect = {
            filereader: typeof FileReader != 'undefined',
            zone: 'draggable' in document.createElement('span'),
            formdata: !!window.FormData
        },
        acceptedTypes = {
            'application/pdf': true, 
        };
        

    // Function to show messages
    function ajax_msg(status, msg) {
        var the_msg = '<div class="alert alert-' + (status ? 'success' : 'danger') + '">';
        the_msg += '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>';
        the_msg += msg;
        the_msg += '</div>';
        $(the_msg).insertBefore(img_zone);
    }

    // Function to upload image through AJAX
    function ajax_upload(files) {
    console.log('files#', files);

    let validExtensions = ["application/pdf"]; 
    let fileType = files[0].type; 
    console.log('fileType', fileType);

     if(!validExtensions.includes(fileType)){
         ajax_msg(false, 'This file type not allow upload pdf only file'); 
         setTimeout(function(){    $(".alert-danger").hide(); }, 2000); 
     }
     else{
          $('.progress').removeClass('hidden');
        $('.progress-bar').css({
            "width": "0%"
        });
        $('.progress-bar span').html('0% complete');

        var formData = new FormData();
        //formData.append('any_var', 'any value');
        let token   = $('meta[name="csrf-token"]').attr('content');
        for (var i = 0; i < files.length; i++) {
            //formData.append('img_file_' + i, files[i]); 
            formData.append('myFile', files[i]);
            formData.append('_token', token); 
            <?php if(isset($id)) {?>
            formData.append('injuryDocumentId', {{$id}}); 
            formData.append('fileName', '{{$documents->injury_document}}'); 
            <?php }?> 
        }

        $.ajax({
            url: "/patients/document", // Change name according to your php script to handle uploading on server
            type: 'POST',
            data: formData,
            //_token: token,
            //dataType: 'json',
            processData: false,
            contentType: false,
            error: function(request) {
                ajax_msg(false, 'An error has occured while uploading photo.');
            },
            success: function(json) {
                console.log('#json',json);
                if(json){
                    $("#tempInjuryDocumentId").val(json);
                    setTimeout(function(){  $("#sendBtn").removeClass('disabled');
                    ajax_msg(true, 'File upload successfully');
                    }, 2000); 
                }
            },
            progress: function(e) {
                if (e.lengthComputable) {
                    var pct = (e.loaded / e.total) * 100;
                    $('.progress-bar').css({
                        "width": pct + "%"
                    });
                    $('.progress-bar span').html(pct + '% complete');
                } else {
                    console.warn('Content Length not reported!');
                }
            }
        });
     } 
    }

    // Call AJAX upload function on drag and drop event
    function dragHandle(element) {
        element.ondragover = function() {
            return false;
        };
        element.ondragend = function() {
            return false;
        };
        element.ondrop = function(e) {
            e.preventDefault();
            ajax_upload(e.dataTransfer.files);
        }
    }

    if (collect.zone) {
        dragHandle(img_zone);
    } else {
        alert("Drag & Drop isn't supported, use Open File Browser to upload photos.");
    }

    // Call AJAX upload function on image selection using file browser button
    $(document).on('change', '.btn-file :file', function() {
        ajax_upload(this.files);
    });

    // File upload progress event listener
    (function($, window, undefined) {
        var hasOnProgress = ("onprogress" in $.ajaxSettings.xhr());

        if (!hasOnProgress) {
            return;
        }

        var oldXHR = $.ajaxSettings.xhr;
        $.ajaxSettings.xhr = function() {
            var xhr = oldXHR();
            if (xhr instanceof window.XMLHttpRequest) {
                xhr.addEventListener('progress', this.progress, false);
            }

            if (xhr.upload) {
                xhr.upload.addEventListener('progress', this.progress, false);
            }

            return xhr;
        };
    })(jQuery, window);
});
    </script>
<!-- BEGIN VENDOR JS-->




