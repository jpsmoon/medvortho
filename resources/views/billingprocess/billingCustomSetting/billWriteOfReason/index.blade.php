@extends('layouts.home-app')
@section('content')
<style>
#myDIV {
  width: 100%;
  padding: 10px 0;
}
#exampleModalBill .close
{
         border:none !important;
         outline: none!important;
}
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<?php $billingId = 1;
?>
<!-- START: Breadcrumbs-->
    <div class="row ">
        <div class="col-12  align-self-center">
            <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                <div class="w-sm-100 mr-auto"><h4 class="mt-3">{{$title}}</h4> </div>
                    <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                        <li class="breadcrumb-item">
                            <a class="btn btn-primary" href="javascript:void(0)" data-toggle="modal" data-target="#exampleModalBill"> {{$btnHeading}}</a>
                        </li>
                        <li class="breadcrumb-item">
                        <a class="btn btn-primary" href="{{ url('/billing/providers/setting', $providerId) }}"> Back</a>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    <!-- END: Breadcrumbs-->
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
    </div>
    <div class="row">
            <div class="col-12 mt-3">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table layout-secondary table-striped table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Description</th>
                                        <th scope="col">Text</th>
                                        <th scope="col">Active</th>
                                        <th scope="col">Edit</th>
                                        <th scope="col">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if(count($reasons)>0)
                                    @foreach ($reasons as $reason)
                                        <tr>
                                            <td>{{($reason->description) ? $reason->description : '-'}}</td>
                                            <td>{{($reason->reason_text) ? $reason->reason_text : '-'}}</td>
                                            <td>{{ ($reason->is_active == 1) ? 'Yes' : 'No' }}</td>
                                            <td><a class="text-info" data-toggle="modal" data-target="#exampleModalBill" href="javascript:void(0)" 
                                            onclick="setValForUpdate({{$reason}})"> <i class="icon-pencil showPointer"/></i></a></td>
                                            <td><a class="text-danger" data-id="" href="javascript:void(0)"><i class="icon-trash showPointer"/></i></a></td>
                                        </tr>
                                    @endforeach
                                @else
                                <tr><td colspan="10">No Records Found.</td></tr>
                                @endif 
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <div class="modal fade" id="exampleModalBill" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
             <div class="modal-dialog" role="document">
                <div class="modal-content" style="width: 425px; padding: 8px;">
                <form action="{{ route('saveBillWriteOfReason') }}" id="reasonFrmId" method="POST" enctype="multipart/form-data">
                   @csrf
                        <div class="modal-header">
                            <h5 align="center" class="modal-title bold" id="exampleModalLabel">{{$btnHeading}}</h5>
                            <button class="close closeBtn" data-dismiss="modal">
                            <span aria-hidden="true" style="font-size: larger">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" style="padding-top: 0px;padding-bottom: 0px;">
                                <input type="hidden" name="providerId" id="providerId" value="{{ $providerId }}">
                                <input type="hidden" name="reasonId" id="reasonId" value="">
                                <input type="hidden" name="reasonType" id="reasonType" value="{{ $type }}">
                            <div>
                                <label for="recipient-name" name="description" class="col-form-label">Description:</label>
                                <input type="text" data-validation="required, length"  data-validation-length="2-100" id="description"  name="description" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Text:</label>
                                <textarea name="reason" id="message-text" data-validation="required, length"  data-validation-length="2-100" rows="6" class="form-control"></textarea>
                            </div>
                            <div>
                            <button type="submit" class="btn btn-primary" style="min-width:100px;" id="sendBtn">Add</button>
                            <button type="button" class="btn btn-secondary closeBtn" data-dismiss="modal" style="min-width:100px;">Cancel</button>
                        </div>
                        </div> 
                    </form>
                </div>
              </div>
    </div>

@endsection
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://code.jquery.com/jquery-migrate-1.2.1.js"></script>
<script src="{{ asset('js/bootstrap-inputmask.js') }}"></script>
<script src="{{ asset('js/controller/master_for_all.js') }}"></script>

<script>
var reasonType = '';
var reasonBtn = 'Add';
<?php if($type == 1){?>
reasonType = 'Add Bill Write Off Reason'; 
<?php } if($type == 2){?>
reasonType = 'Add Second Review Reasons'; 
<?php } if($type == 3){?>
reasonType = 'Add Box 19 Reasons';
<?php }?>

function setValForUpdate(data){
    <?php if($type == 1){?>
    reasonType = 'Update Bill Write Off Reason'; 
    <?php } if($type == 2){?>
    reasonType = 'Update Second Review Reasons'; 
    <?php } if($type == 3){?>
    reasonType = 'Update Box 19 Reasons';
    <?php }?>
    $("#reasonId").val(data.id);
    $("#sendBtn").text('Update');
    $("#exampleModalLabel").text(reasonType);
    $("#description").val(data.description);
    $("#message-text").val(data.reason_text);
}
$(document).ready(function() {
  $(".closeBtn").on("click", function() {
        $("#reasonFrmId").trigger('reset');
        $("#sendBtn").text('Add');
        $("#exampleModalLabel").text(reasonType);
  });
});
</script>
