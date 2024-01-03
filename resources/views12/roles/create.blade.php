@extends('layouts.home-app')
@section('content')
    <!-- START: Breadcrumbs-->
    <!-- END: Breadcrumbs-->
    
  <style>
      .dataTables_length
        {
          padding-top: 2%;  
        }  
  </style>  
    
   @if ($message = Session::get('flash_success_message'))
    <div class="alert alert-success alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
</div>
@endif

@if ($message = Session::get('flash_error_message'))
<div class="alert alert-danger alert-block">
	<button type="button" class="close" data-dismiss="alert">×</button>
        <strong>{{ $message }}</strong>
</div>
@endif 

    <div class="row mt-2 ">
        <div class="col-md-12 mt-4">
            <div class="card row-background customBoxHeight">
                <!-- START: Breadcrumbs-->
                <div class="row ">
                    <div class="col-12  align-self-center">
                        <div class="sub-header py-3 px-3 align-self-center d-sm-flex w-100 rounded heading-background">
                            <div class="w-sm-100 mr-auto margin05">
                                <h2 class="heading">Create New Role</h2>
                            </div>
                             <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                             
                             <li class="breadcrumb-item">
                                <a class="btn btn-primary" href="{{ route('roles.index') }}"> Back</a>
                            </li>    
                                 
                            <!--<li class="breadcrumb-item">-->
                            <!--    <a class="btn btn-primary" href="{{ route('billingproviders.index') }}"> Back</a>-->
                            <!--</li>-->
                        </ol> 
                        </div>
                    </div>
                </div>
                <!-- END: Breadcrumbs-->
                <div class="card-content">
                    <div class="col-md-12 col-12">
                        <div class="row">
            <div class="col-12">
                <div class="card">
                   <div class="card-content">
                    <div class="card-body2">
                        {!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
                        @csrf
                            <div class="row">
                                <div class="form-group mt-2 col-md-4">
                                        <label for="name"> Name <span class="required">* </span> </label>
                                        <input type="text" name="name" value=" " class="form-control" data-validation-event="change" data-validation="required, length"
                                            data-validation-length="2-100">
                                        @if ($errors->has('name'))
                                            <span class="invalid-feedback" style="display:block" role="alert">
                                                <strong class="invalid-feedback">{{ $errors->first('name') }}</strong>
                                            </span>
                                        @endif
                                </div>
                            </div>
                            
                            <div class="form-row">
                                <div class="form-group col-md-12">
                                    <label  for="billing_provider_ids"> Permission<span class="required">* </span></label>
                                    <label id="selectAllCheckBoxes"><input type="checkbox" id="checkAll"  class="checkAll"/> Select / Unselect All</label>
                                    <ul class="list-inline">
                                        @foreach($permission as $value)
                                            <li class="list-inline-item liItem col-md-3">
                                                {{ Form::checkbox('permission[]', $value->id, false, array('class' => 'name')) }}
                                                <span style="position: relative; bottom: 3px;"> {{ $value->name }} </span>
                                            </li>
                                        @endforeach 
                                    </ul> 
                                    @if ($errors->has('permission'))
                                        <span class="invalid-feedback" style="display:block" role="alert">
                                            <strong class="invalid-feedback">{{ $errors->first('permission') }}</strong>
                                        </span>
                                    @endif
                                </div> 
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                                    <button type="submit" class="btn btn-primary ladda-button"><span class="ladda-label">Submit</span></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>     
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
<script>
    //selectAllCheckBoxes
    $(document).ready(function() {
       $('.checkAll').click(function(){
          var checked = !$(this).data('checked');
          $('input:checkbox').prop('checked', checked);
          $(this).val(checked ? 'uncheck all' : 'check all' )
          $(this).data('checked', checked);
    });
    })
      
</script>
