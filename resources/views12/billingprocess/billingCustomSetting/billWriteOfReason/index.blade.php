@extends('layouts.home-app')
@section('content')
    <!-- START: Breadcrumbs-->
    <!-- END: Breadcrumbs-->
    
  <style>
      .dataTables_length
        {
          padding-top: 2%;  
        } 
        .checkbox
        {
            width: 18px;
            height: 18px;
            
            position: relative;
            top: 5px;
        }
    
    
  </style>  
    
    @if ($errors->any())
        <div class="row mt-2 customBox">
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
        </div>
    @endif
    <div class="row mt-2 ">
        <div class="col-md-12 mt-4">
            <div class="card row-background customBoxHeight">
                <!-- START: Breadcrumbs-->
                <div class="row ">
                    <div class="col-12  align-self-center">
                        <div class="sub-header py-3 px-3 align-self-center d-sm-flex w-100 rounded heading-background">
                            <div style="padding-top:10px" class="w-sm-100 mr-auto">
                                <h2 class="heading">{{$title}}</h2>
                            </div>
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
                <div class="card-content">
                    <div class="col-md-12 col-12">
                        <div class="row">
            <div class="col-12 mt-3">
                <div class="card">
                    <div class="card-body2">
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
                                <textarea name="reason" id="message-text" data-validation="required, length"  data-validation-length="2-2000" rows="6" class="form-control"></textarea>
                            </div>
                            <div>
                             
                             <input type="checkbox" class="checkbox" id="1" name="for_all_providers" value="1">
                             <label for="vehicle1">For All Providers</label>

                            <button type="submit" class="btn btn-primary" style="min-width:100px;" id="sendBtn">Add</button>
                            <button type="button" class="btn btn-secondary closeBtn" data-dismiss="modal" style="min-width:100px;">Cancel</button>
                        </div>
                        </div> 
                    </form>
                </div>
              </div>
    </div>
                    </div>
                </div>
            </div>
            <div class="col-1 mt-4"></div>
        </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://code.jquery.com/jquery-migrate-1.2.1.js"></script>
<script src="{{ asset('js/bootstrap-inputmask.js') }}"></script>
<script src="{{ asset('js/controller/master_for_all.js') }}"></script>
<script></script>
