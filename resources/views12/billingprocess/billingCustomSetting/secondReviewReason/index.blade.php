@extends('layouts.home-app')
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<?php $billingId = 1;
?>
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
        <div class="col-10 mt-4">
            <div class="card row-background" style="min-height: 565px;">
                <!-- START: Breadcrumbs-->
                <div class="row">
                    <div class="col-12  align-self-center">
                        <div class="sub-header mt-3 py-3 px-1 align-self-center d-sm-flex w-100 rounded heading-background">
                            <div class="w-sm-100 mr-auto">
                                <li class="btn btn-primary" style="padding-bottom:10px" class="breadcrumb-item" data-toggle="modal" data-target="#exampleModalBill">
                                     <b>Add Second Review Reason</b>
                                </li>
                            </div>
                            <div class="w-sm-100 mr-auto"><h4 class="mb-0 bold" style="font-size: 25px; padding-top: 5px; font-family: initial;">Second Review Reasons</h4></div>
                            <div>
                            <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                                <li style="padding-bottom:10px" class="breadcrumb-item">
                                    <a class="btn btn-primary" href="{{ url('/billing/providers/setting', $providerId) }}"> Back</a>
                                </li>
                            </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END: Breadcrumbs-->
                
                <div class="row">
        <div class="col-12 mt-4">
            <div class="card">
                <div class="card-content">
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
                
        </div>
        <div class="col-1 mt-4"></div>
    </div>
    </div>
    <div class="modal fade" id="exampleModalBill" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
             <div class="modal-dialog" role="document">
                <div class="modal-content" style="width: 425px; padding: 8px;">
                <form action="{{ route('saveSecondReviewOfReason') }}" method="POST" enctype="multipart/form-data">
                   @csrf
                        <div class="modal-header">
                            <h5 align="center" class="modal-title bold" id="exampleModalLabel">Add Second Review Reason</h5>
                            <button class="close" data-dismiss="modal">
                            <span aria-hidden="true" style="font-size: larger">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" style="padding-top: 0px;padding-bottom: 0px;">
                                <input type="hidden" name="providerId" id="providerId" value="{{ $providerId }}">
                                <input type="hidden" name="reasonId" id="reasonId" value="">
                            <div>
                                <label for="recipient-name" name="description" class="col-form-label">Description:</label>
                                <input type="text" data-validation="required, length"  data-validation-length="2-100" id="description"  name="description" class="form-control" >
                            </div>
                            <div class="form-group">
                                <label for="message-text" class="col-form-label">Text:</label>
                                <textarea name="reason" id="message-text" data-validation="required, length"  data-validation-length="2-100" rows="6" class="form-control"></textarea>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" class="checkbox" id="1" name="for_all_providers" value="1">
                                <label for="vehicle1">For All Providers</label>
                            </div>
                            
                            <div>
                            <button type="submit" class="btn btn-primary" style="min-width:100px;">Add</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" style="min-width:100px;">Cancel</button>
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
function setValForUpdate(data){
    $("#reasonId").val(data.id);
    $("#description").val(data.description);
    $("#message-text").val(data.reason_text);
}
</script>
