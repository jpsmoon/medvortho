@extends('layouts.home-app')
@section('content')
<style>
#sig-canvas {
  border: 2px dotted #CCCCCC;
  border-radius: 15px;
  cursor: crosshair;
}
</style>
<!-- START: Breadcrumbs-->
<!-- END: Breadcrumbs-->
    @if ($errors->any())
        <div class="row ">
            <div align="center" class="col-12  align-self-center">
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-1 mt-4"></div>
        </div>
    @endif
    <div class="row">
        <div class="col-1 mt-4"></div>
        <div class="col-12 mt-4">
            <div class="card row-background" style="min-height: 565px;">
                <!-- START: Breadcrumbs-->
                <div class="row">
                    <div class="col-12  align-self-center">
                        <div class="sub-header mt-3 py-3 px-1 align-self-center d-sm-flex w-100 rounded heading-background">
                            <div style="padding-top:10px" class="w-sm-100 mr-auto">
                                <h2 class="heading"> {{$title}} </h2>
                            </div>
                            <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                                <li style="padding-bottom:10px" class="breadcrumb-item">
                                    <a class="btn btn-primary" href="{{ url('/list/rfa/requesting/physicians', $providerId) }}"> Back</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- END: Breadcrumbs-->
                <div class="col-12 mt-4">
                    <form action="{{ route('savePhysicianSetting') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="billingProviderId" id="billingProviderId" value="{{ $providerId }}">
                        <input type="hidden" name="physicianId" id="physicianId" value="{{ $id }}">
                        
                        <div class="row">
                            <div class="col-xs-12 col-sm-12 col-md-12 border-bottom2">
                                <div class="form-row col-md-12">
                                    
                                    <div class="form-group col-md-3">
                                        <label for="rendering_provider_npi" class="paddingtop">NPI<span class="required">*
                                            </span></label>
                                        <input type="text" name="rendering_provider_npi"
                                            data-validation="required, number"data-validation-error-msg=""
                                            class="form-control" maxlength="100"
                                            value="">
                                        @if ($errors->has('rendering_provider_npi'))
                                            <span class="invalid-feedback" style="display:block" role="alert">
                                                <strong
                                                    class="invalid-feedback">{{ $errors->first('rendering_provider_npi') }}</strong>
                                            </span>
                                        @endif
                                    </div>

                                    @if (!isset($id))
                                        <div class="form-group col-md-4 mt-1">
                                            <label for="rendering_provider_npi"></label>
                                            <div class="mt-1">
                                                <button type="button" class="btn btn-primary ladda-button"><span
                                                 class="ladda-label">Search</span></button>
                                            </div>
                                        </div>
                                    @endif
                                    
                                </div>
                            </div>
                            
                            <div class="col-xs-12 col-sm-12 col-md-12 border-bottom2">
                                <div class="form-row col-md-12">
                                    
                                    <div class="form-group col-md-4">
                                        <label for="first_name" class="paddingtop">First Name<span class="required">*
                                            </span></label>
                                        <input type="text" name="first_name"
                                            data-validation="required"data-validation-error-msg=""
                                            class="form-control" maxlength="100"
                                            value="">
                                        @if ($errors->has('first_name'))
                                            <span class="invalid-feedback" style="display:block" role="alert">
                                                <strong
                                                    class="invalid-feedback">{{ $errors->first('first_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    
                                    <div class="form-group col-md-1">
                                        <label for="middle_name" class="paddingtop">MI<span class="required">*
                                            </span></label>
                                        <input type="text" name="middle_name"
                                            data-validation="required"data-validation-error-msg=""
                                            class="form-control" maxlength="100"
                                            value="">
                                        @if ($errors->has('middle_name'))
                                            <span class="invalid-feedback" style="display:block" role="alert">
                                                <strong
                                                    class="invalid-feedback">{{ $errors->first('middle_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    

                                    <div class="form-group col-md-4">
                                        <label for="last_name" class="paddingtop">Last Name<span class="required">*
                                            </span></label>
                                        <input type="text" name="last_name"
                                            data-validation="required"data-validation-error-msg=""
                                            class="form-control" maxlength="100"
                                            value="">
                                        @if ($errors->has('last_name'))
                                            <span class="invalid-feedback" style="display:block" role="alert">
                                                <strong
                                                    class="invalid-feedback">{{ $errors->first('last_name') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    
                                    <div class="form-group col-md-1">
                                        <label for="suffix" class="paddingtop">Suffix<span class="required">*
                                            </span></label>
                                        <input type="text" name="suffix"
                                            data-validation="required"data-validation-error-msg=""
                                            class="form-control" maxlength="100"
                                            value="">
                                        @if ($errors->has('suffix'))
                                            <span class="invalid-feedback" style="display:block" role="alert">
                                                <strong
                                                    class="invalid-feedback">{{ $errors->first('suffix') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    
                                </div>
                                <div class="form-row col-md-12">
                                    <div class="form-group col-md-4">
                                        <label for="rendering_provider_npi" class="paddingtop">Specialty<span class="required">*
                                            </span></label>
                                        <select class="form-control searcDrop" name="specilityId" id="specilityId">
                                        <option value="" class="option">Select</option>
                                        @foreach ($masterSpecility as $specility)
                                        <option value="{{$specility->id}}"> {{$specility->name}}</option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('specilityId'))
                                            <span class="invalid-feedback" style="display:block" role="alert">
                                                <strong
                                                    class="invalid-feedback">{{ $errors->first('specilityId') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            
                            
                            <div class="col-md-12 border-bottom2">
                                <div class="form-row col-md-12">
                                    <div class="form-group">
                                        <label for="taxonomy_code">Signature (PNG format) </label>
                                        <input type="file" name="physican_signature" id="physican_signature"
                                            class="form-control" maxlength="100">
                                        @if ($errors->has('physican_signature'))
                                            <span class="invalid-feedback" style="display:block" role="alert">
                                                <strong
                                                    class="invalid-feedback">{{ $errors->first('physican_signature') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="col-md-2 title" style="cursor: pointer; pointer: cursor; padding-top:30px; padding-left:10px;" data-toggle="modal" data-target="#canvasModal"> Or Add signature  </div>
                                </div>
                            </div>
                            
                            <div class="col-md-12 border-bottom2">
                                <div class="form-row col-md-12">
                                    <div class="form-row col-md-10 pt-0">
                                        <div class="form-group col-md-4">
                                            <button type="submit" style="min-width: 120px" class="btn btn-primary ladda-button">
                                                <span class="ladda-label">Add</span></button>
                                            
                                            <button style="min-width: 120px" class="btn btn-primary ladda-button"><span
                                            class="ladda-label">Cancel</span></button>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-1 mt-4"></div>
    </div>
    </div>
<div class="modal fade" id="canvasModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Signature</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="col-md-12 border-bottom2">
            <div class="form-row col-md-12">
            <canvas id="sig-canvas" width="620" height="160"></canvas>
            </div>
        </div> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="sig-clearBtn">Clear Signature</button>
        <button type="button" class="btn btn-primary" id="sig-submitBtn" data-dismiss="modal">Save Signature</button>
      </div>
    </div>
  </div>
</div>

@endsection
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>

<script>
$( document ).ready(function() {
(function() {
  window.requestAnimFrame = (function(callback) {
    return window.requestAnimationFrame ||
      window.webkitRequestAnimationFrame ||
      window.mozRequestAnimationFrame ||
      window.oRequestAnimationFrame ||
      window.msRequestAnimaitonFrame ||
      function(callback) {
        window.setTimeout(callback, 1000 / 60);
      };
  })();

  var canvas = document.getElementById("sig-canvas");
  var ctx = canvas.getContext("2d");
  ctx.strokeStyle = "#222222";
  ctx.lineWidth = 4;

  var drawing = false;
  var mousePos = {
    x: 0,
    y: 0
  };
  var lastPos = mousePos;

  canvas.addEventListener("mousedown", function(e) {
    drawing = true;
    lastPos = getMousePos(canvas, e);
  }, false);

  canvas.addEventListener("mouseup", function(e) {
    drawing = false;
  }, false);

  canvas.addEventListener("mousemove", function(e) {
    mousePos = getMousePos(canvas, e);
  }, false);

  // Add touch event support for mobile
  canvas.addEventListener("touchstart", function(e) {

  }, false);

  canvas.addEventListener("touchmove", function(e) {
    var touch = e.touches[0];
    var me = new MouseEvent("mousemove", {
      clientX: touch.clientX,
      clientY: touch.clientY
    });
    canvas.dispatchEvent(me);
  }, false);

  canvas.addEventListener("touchstart", function(e) {
    mousePos = getTouchPos(canvas, e);
    var touch = e.touches[0];
    var me = new MouseEvent("mousedown", {
      clientX: touch.clientX,
      clientY: touch.clientY
    });
    canvas.dispatchEvent(me);
  }, false);

  canvas.addEventListener("touchend", function(e) {
    var me = new MouseEvent("mouseup", {});
    canvas.dispatchEvent(me);
  }, false);

  function getMousePos(canvasDom, mouseEvent) {
    var rect = canvasDom.getBoundingClientRect();
    return {
      x: mouseEvent.clientX - rect.left,
      y: mouseEvent.clientY - rect.top
    }
  }

  function getTouchPos(canvasDom, touchEvent) {
    var rect = canvasDom.getBoundingClientRect();
    return {
      x: touchEvent.touches[0].clientX - rect.left,
      y: touchEvent.touches[0].clientY - rect.top
    }
  }

  function renderCanvas() {
    if (drawing) {
      ctx.moveTo(lastPos.x, lastPos.y);
      ctx.lineTo(mousePos.x, mousePos.y);
      ctx.stroke();
      lastPos = mousePos;
    }
  }

  // Prevent scrolling when touching the canvas
  document.body.addEventListener("touchstart", function(e) {
    if (e.target == canvas) {
      e.preventDefault();
    }
  }, false);
  document.body.addEventListener("touchend", function(e) {
    if (e.target == canvas) {
      e.preventDefault();
    }
  }, false);
  document.body.addEventListener("touchmove", function(e) {
    if (e.target == canvas) {
      e.preventDefault();
    }
  }, false);

  (function drawLoop() {
    requestAnimFrame(drawLoop);
    renderCanvas();
  })();

  function clearCanvas() {
    canvas.width = canvas.width;
  }

  // Set up the UI
  var sigText = document.getElementById("sig-dataUrl");
  var sigImage = document.getElementById("sig-image");
  var clearBtn = document.getElementById("sig-clearBtn");
  var submitBtn = document.getElementById("sig-submitBtn");
  clearBtn.addEventListener("click", function(e) {
    clearCanvas();
     $("#dataUrlVal").val(" ");
  }, false);
  submitBtn.addEventListener("click", function(e) {
    var dataUrl = canvas.toDataURL();
    $("#dataUrlVal").val(dataUrl);
     $("#showSignture").attr("src",dataUrl);
  }, false);

})();
});
//sig-saveBtn
</script>
