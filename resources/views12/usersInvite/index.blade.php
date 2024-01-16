@extends('layouts.home-app')
@section('content')

<style>   
.deleteToggle{}

.deleteToggle  input[type=checkbox]{
	height: 0;
	width: 0;
	visibility: hidden;
}

.deleteToggle label {
	cursor: pointer;
	text-indent: -9999px;
	width: 30px;
	height: 15px;
	
	display: block;
	border-radius: 100px;
	position: relative;
  border: rgb(0, 198, 138) 1px solid;
}

.deleteToggle label:after {
	content: '';
	position: absolute;
	top: 1px;
	left: 2px;
	width: 11px;
	height: 11px;
	background: #fff; border: rgb(0, 198, 138) 1px solid;
	border-radius: 50px;
	transition: 0.3s;
}

.deleteToggle input:checked + label {
	background: rgb(0, 198, 138);
}

.deleteToggle input:checked + label:after {
	left: calc(100% - 5px);
	transform: translateX(-100%);
}

.deleteToggle label:active:after {
	width: 10px;
}
div.dataTables_wrapper div.dataTables_filter label {
    margin-top: 0;
}
</style>

 <!-- START: Breadcrumbs-->
    <div class="row mt-2">
         <div class="col-12  align-self-center">
            <div class="sub-header mt-0 py-3 px-2 align-self-center d-sm-flex w-100 rounded heading-background">
                <div class="w-sm-100 mr-auto margin05">
                   <h2><i class="fa-solid fa-id-card-clip"></i> Account Users</h2>
                </div>
                <div align="right" class="w-sm-100 ">
                    <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                    <li class="breadcrumb-item">
                     <a class="btn btn-primary" href="{{ route('inviteUser') }}"> Invite User</a>
                    </li>
                </ol>
                </div>
            </div>
        </div>
        
    </div>
    <!-- END: Breadcrumbs-->

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table layout-secondary dataTable table-striped table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                      <th scope="col">First Name</th>
                                      <th scope="col">Last Name</th>
                                      <th scope="col">Email</th>
                                      <th scope="col">Roles</th>
                                      <th scope="col">Date Activate</th>
                                      <th scope="col">Date Locked</th>
                                      <th scope="col">Billing Provider Access</th>
                                      <th scope="col">Last Sign In Date</th>
                                      <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @inject('userClass', 'App\Http\Controllers\UserInviteController')
                                    @if(count($accountUser))
                                    @foreach ($accountUser as $key => $user)
                                      @php   $isFoundBillingAcees = $userClass->checkBillingProviderAccess($user->id); @endphp
                                      <tr>
                                        <td><a href="{{url('/edit/profile',$user->id)}}" >{{ $user->name }}</a></td>
                                        <td>{{ $user->last_name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if(!empty($user->getRoleNames()))
                                              @foreach($user->getRoleNames() as $v)
                                                <label class="badge badge-success">{{ $v }}</label>
                                              @endforeach
                                            @endif
                                        </td>
                                        <td>{{ ($user->created_at) ? date('m-d-Y', strtotime($user->created_at)) : '' }}</td>
                                        <td>{{ ($user->deleted_at) ? date('m-d-Y', strtotime($user->deleted_at)) : '' }}</td>
                                        <td>
                                          @if($isFoundBillingAcees == 0)
                                          <span>Some
                                          @else
                                            <span>All</span>
                                          @endif
                                        </td>
                                        <td>{{ ($user->last_login_at) ? date('m-d-Y', strtotime($user->last_login_at)) : '' }}</td>
                                        <td class="deleteToggle">
                                          <input {{ ($user->is_active == 0 )  ? 'checked' : '' }} onChange="userDeactivate( {{$user->id}});" type="checkbox" id="switch_{{$user->id}}" />
                                          <label for="switch_{{$user->id}}">Toggle</label>  
                                        </td>
                                      </tr>
                                    @endforeach
                                    @else
                                    <tr class="jsgrid-row">
                                    <td class="jsgrid-cell">No Records Found.</td>
                                    </tr>
                                    @endif
                                </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if(count($inviteUser))
    <!-- START: Breadcrumbs-->
    <div class="row">
         <div class="col-12  align-self-center">
            <div class="sub-header mt-0 py-3 px-2 align-self-center d-sm-flex w-100 rounded heading-background">
                <div class="w-sm-100 mr-auto margin05">
                   <h2><i class="fa-solid fa-user-plus"></i> Invited Users</h2>
                </div>
            
            </div>
        </div>
        
    </div>
    <!-- END: Breadcrumbs-->
 
      <div class="row">
          <div class="col-12">
              <div class="card">
                  <div class="card-body customBoxHeight3">
                      <div class="table-responsive">
                          <table id="example" class="table layout-secondary dataTable table-striped table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Email</th>
                                      <th scope="col">Roles</th>
                                      <th scope="col">Invitation Sent On</th>
                                      <th scope="col">URL</th>
                                       <th scope="col">Number of resend</th>
                                      <th scope="col">Resend</th> 
                                      <th scope="col">Delete</th> 
                                    </tr>
                                </thead>
                                  <tbody>
                                      @inject('userClass', 'App\Http\Controllers\UserInviteController')
                                        @foreach ($inviteUser as $key => $user)
                                          @php 
                                          $isFoundBillingAcees = $userClass->checkBillingProviderAccess($user->id);
                                          @endphp
                                            <tr>
                                                <td>{{ $user->email }}</td>
                                              <td>
                                              <label class="badge badge-success">{{ ($user->getRoleInfo) ? $user->getRoleInfo->name : '' }}</label>
                                              </td>
                                              <td>{{ ($user->created_at) ? date('m-d-Y', strtotime($user->created_at)) : '' }}</td>
                                              <td>{{ $user->token_url }}</td>
                                              <td>{{ $user->resend_counter }}</td>
                                              <td onclick="resendInvite({{$user->id}});"><i  class="icon-refresh  showPointer"/></i> </td>
                                              <td onclick="deleteInvite({{$user->id}});"> <a class="text-danger" href="javascript:void(0)"><i  class="icon-trash showPointer"/></i></a> </td>
                                            </tr>
                                        @endforeach  
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
<script src="https://code.jquery.com/jquery-migrate-1.2.1.js"></script> 
<script>
 
function resendInvite(uId) { 
    swal.fire({
        title: 'Are you sure you want to re-invite this email address?',
        //text: "You won't be able to revert this!",
        showCancelButton: true,
        confirmButtonColor: '#3BAFDA',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Resend',
        customClass: {
            confirmButton: "btn btn-primary",
            cancelButton: "btn btn-danger",
            popup: 'swal-wide',
        }
    }).then((result) => { 
    // Use .then() to handle the user's response
        if (result.isConfirmed) { // Only proceed if the user clicked the confirm button
            let _url     = `/resend/invite`;
            $.ajax({
                url: _url,
                type: 'post',
                data: {
                    _token: token,
                    id:uId,
                    is_resend : 'Yes'
                },
                success: function(response) {
                    //console.log('#response',response);
                   swal.fire({
                        title: 'Invitation has been sent successfully', 
                        customClass: {
                            successButton: "btn btn-primary",
                            popup: 'swal-wide',
                        }
                    });
                    location.reload(); 
                },
                error: function(xhr, status, error) {
                  swal.fire(error);
                } 
            });
        }
    });
}
function deleteInvite(uId) { 
    swal.fire({
       title: 'Are you sure you want to delete?',
        text: "You won't be able to revert this!",
        showCancelButton: true,
        confirmButtonColor: '#3085D6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Delete it!',
        customClass: {
            confirmButton: "btn btn-primary",
            cancelButton: "btn btn-danger",
            popup: 'swal-wide',
        }
    }).then((result) => { // Use .then() to handle the user's response
        if (result.isConfirmed) { // Only proceed if the user clicked the confirm button
            let _url     = `/delete/invite`;
            $.ajax({
                url: _url,
                type: 'post',
                data: {
                    _token: token,
                    id:uId, 
                },
                success: function(response) {
                    //console.log('#response',response);
                   swal.fire({
                        title: 'Invitation has been deleted', 
                        customClass: {
                            successButton: "btn btn-primary",
                            popup: 'swal-wide',
                        }
                    });
                    location.reload(); 
                },
                error: function(xhr, status, error) {
                  swal.fire(error);
                } 
            });
        }
    });
}
function userDeactivate(userId, ){
let cheId = 'switch_'+userId;
let isChecked = document.getElementById(cheId).checked;
let isCheckedval = null; 
let title = '';
let sTitle = '';
console.log("Input is checked", isChecked);
  if(isChecked){
     console.log("Input is checked");
     isCheckedval = 0;
     title = 'Are you sure you want to delete this user?';
     sTitle = 'User has been deleted';
   } else {
     console.log("Input is NOT checked");
      isCheckedval = 1;
      title = 'Are you sure you want to restore this user?';
     sTitle = 'User has been restored';
   }
    swal.fire({
       title: 'Are you sure you want to delete?',
        text: "You won't be able to revert this!",
    showCancelButton: true,
        confirmButtonColor: '#3085D6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, Delete it!',
        customClass: {
            confirmButton: "btn btn-primary",
            cancelButton: "btn btn-danger",
            popup: 'swal-wide',
        }
    }).then((result) => { // Use .then() to handle the user's response
        if (result.isConfirmed) {

         }
    });
}
</script>
