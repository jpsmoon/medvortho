@extends('layouts.home-new-app')
@section('content')

<style>
.searcDrop{
    position:relative!important;
}    
</style>
<!-- START: Breadcrumbs-->
<div class="row mt-0">
        <div class="col-12">
                <!-- START: Breadcrumbs-->
                <div class="row">
                   <div class="col-12  align-self-center">
                        <div class="sub-header py-3 px-1 align-self-center d-sm-flex w-100 rounded heading-background">
                            <div style="padding-top:5px" class="w-sm-100 mr-auto">
                                <h2 class="heading"><i class="fa-solid fa-id-card-clip"></i> Bill Task Preferences</h2>
                            </div>
                            
                            <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                                    <li class="breadcrumb-item">
                                    <a class="btn btn-primary" href="{{ url('/billing/providers/setting', $providerId) }}">Back</a>
                                </li>
                            </ol>
                            
                            <!--<a class="btn btn-primary" href="{{ url('/billing/providers/setting', $providerId) }}"> Back</a>-->
                            
                            
                            <!--<ol class="breadcrumb bg-transparent align-self-center m-0 p-0">-->
                            <!--    <li class="breadcrumb-item">-->
                            <!--    @can('CompanyType-create')-->
                            <!--        <a class="btn btn-success text-white" id="myBtn" onclick="show_addmodal();" data-toggle="modal" data-target="#addModal"> Add Reason </a>-->
                            <!--    @endcan-->
                            <!--    </li>-->
                            <!-- </ol>-->
                        </div>
                    </div>
                </div>
            <!-- END: Breadcrumbs--> 
</div>
</div>


    @if ($message = Session::get('success'))
    <div class="row">
        <div class="col-12">
            <div class="alert alert-success">
                <p> {{ $message }}</p>
            </div>
        </div>
    </div>
    @endif
    @if(Session::has('message'))
     <div class="row">
        <div class="col-12">
            <div class="alert alert-success">
            <p class="alert{{ Session::get('alert-class', 'alert-info') }}">{{Session::get('message') }}</p>
            </div>
        </div>
    </div>
    @endif
<div class="row mb-2">
    <div class="col-12">
        <div class="card">
            <div class="card-body p-1">
            
            @if(count($billStatuss))
               @foreach ($billStatuss as $key => $status)
                 <div class="card"> 
                    <!--<div class="card-header p-1">-->
                    <!--    {{$status->status_name}}-->
                    <!--</div>-->
                    
                       
                    <div class="card-body2">
                        <div class="row">
                    <div class="col-2 pr-0 custom-width">
                    <ul class="timeline">
        				<li>
        					<h5 style="font-weight:500;">{{$status->status_name}}</h5>
        				</li>
			        	</ul>
                    </div>
                        <div class="col-10 custom-width2 pl-0">
                        <div class="table-responsive">
                            <table id="exampleTask" class="table layout-secondary dataTable table-striped table-bordered">
                                <thead class="thead-dark">
                                    <tr class="jsgrid-header-row">
                                        <th width="60%" scope="col">Task</th>
                                        <th width="20%" scope="col"></th>
                                        <th width="20%" scope="col">User</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($status->getTasks)
                                        @foreach ($status->getTasks as $key => $task)
                                            <tr>
                                                <td>{{$task->task_name}}</td>
                                                <td>
                                                <a   data-toggle="modal" data-target="#showTaskAssignModel_{{$task->id}}">
                                                    <i  class="icon-pencil  showPointer"  /></i>
                                                </a>
                                                </td>
                                                <td></td>
                                            </tr>
                                            <!-- Modal content -->
                                        <div class="modal fade" id="showTaskAssignModel_{{$task->id}}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <form action="{{ url('/assign/task/to/user') }}" id="assign_task_{{$task->id}}"  enctype="multipart/form-data" class="form-horizontal ladda-form'" method="POST">
                                                    @csrf
                                                    <input type="hidden" name="providerId" id="providerId" value="{{$providerId}}">
                                                    <input type="hidden" name="task_id" id="task_id" value="{{$task->id}}">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="editModalLabel">{{$task->task_name}} Task</h5>
                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                <span aria-hidden="true" class="text-white">&times;</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="form-row">
                                                                        <div class="form-group col-md-12">
                                                                            <h5>Type</h5>
                                                                            <ul class="list-inline">
                                                                                <li class="list-inline-item liItem"">
                                                                                    <input type="radio" onclick="showUserRoleDiv(this.value, {{$task->id}})" name = "task_assign_type" value="1"  data-validation-event="change" data-validation="required" data-validation-error-msg=""> Role
                                                                                </li>
                                                                                <li class="list-inline-item liItem"">
                                                                                    <input onclick="showUserRoleDiv(this.value, {{$task->id}})"  type="radio" name = "task_assign_type" value="2" data-validation-event="change" data-validation="required" data-validation-error-msg=""> User 
                                                                                </li>
                                                                            </ul> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row d-none" id="rolesDiv_{{$task->id}}">
                                                                        <div class="form-group col-md-12">
                                                                            <h5>Roles</h5>
                                                                            <ul class="list-inline">
                                                                             @if(count($roles))
                                                                                @foreach ($roles as $key => $role)
                                                                                <li class="list-inline-item liItem"">
                                                                                    <input type="radio" id="role_name_{{$role->id}}" name = "assign_role_name" value="{{$role->id}}"> {{$role->name}} 
                                                                                </li> 
                                                                                @endforeach
                                                                             @endif
                                                                            </ul> 
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-row d-none" id="usersDiv_{{$task->id}}">
                                                                       <div class="form-group  col-md-12">
                                                                            <label for="injury_state_id"><h5>Users</h5></label>
                                                                            <select name="user_id" class="form-control searcDrop" id="injury_state_id">
                                                                                <option value="" class="option">Select</option>
                                                                                @if(count($users))
                                                                                    @foreach ($users as $key => $user)
                                                                                        <option value="{{$user->id}}"> {{$user->name}}</option>
                                                                                    @endforeach
                                                                                @endif
                                                                            </select> 
                                                                        </div>
                                                                       
                                                                    </div>
                                                                </div>
                                                            </div> 
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary" >Done</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- Modal content --> 
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                </div>
        </div> 
                @endforeach
            @endif
        
           
            
            </div>
        </div>
    </div>
</div> 
 

@endsection
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script> 
function showUserRoleDiv(val, index){
    if(val == 1){
        $("#rolesDiv_"+index).removeClass('d-none');
        $("#usersDiv_"+index).addClass('d-none');
    }
    else if(val == 2){
        $("#rolesDiv_"+index).addClass('d-none');
        $("#usersDiv_"+index).removeClass('d-none');
    }
}
</script>
 
