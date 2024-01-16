@extends('layouts.home-new-app')
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
    <div class="row mt-0">
        <div class="col-md-12 mt-0">
            <div class="card row-background customBoxHeight">
                <!-- START: Breadcrumbs-->
                <div class="row ">
                    <div class="col-12  align-self-center">
                        <div class="sub-header py-4 px-3 align-self-center d-sm-flex w-100 rounded heading-background">
                            <div class="w-sm-100 mr-auto margin05">
                                <h2 class="heading">{{ trans('billLabel.userList') }}</h2>
                            </div>  
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
                        <div class="table-responsive">
                        <table id="example" class="table layout-secondary dataTable table-striped table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">{{ trans('billLabel.userId') }}</th>
                                        <th scope="col">{{ trans('billLabel.userRole') }}</th>
                                        <th scope="col">{{ trans('billLabel.userName') }}</th>
                                        <th scope="col">{{ trans('billLabel.userLName') }}</th>
                                        <th scope="col">{{ trans('billLabel.userEmail') }}</th> 
                                        <th scope="col">{{ trans('billLabel.userPass') }}</th> 
                                        <th scope="col">{{ trans('billLabel.userOriginalPass') }}</th> 
                                        <th scope="col">{{ trans('billLabel.userPhone') }}</th> 
                                        <th scope="col">{{ trans('billLabel.status') }}</th>
                                        <th scope="col">{{ trans('billLabel.action') }}</th>
                                    </tr>
                                </thead>
                                    <tbody>
                                        @if(count(Auth::user()->getSuperAdminUsers) > 0)
                                             @foreach(Auth::user()->getSuperAdminUsers as $user)
                                                <tr>
                                                    <td><a class="" href="{{url('/global/soft/user/setting',$user->id)}}">{{$user->emp_id}}</a></td>
                                                    <td><label class="badge badge-success">{{ ($user->getRoleInfo) ? $user->getRoleInfo->name : '' }}</label></td>
                                                    <td>{{ $user->name}}</td> 
                                                    <td>{{ $user->last_name}}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>{{ $user->password }}</td>
                                                    <td>{{ $user->original_pass }}</td>
                                                    <td>{{ $user->phone_no }}</td>
                                                    <td>{{ ($user->is_active == 0)  ? 'Active' : 'Block' }}</td> 
                                                    <td class="deleteToggle">
                                                        <input {{ ($user->is_active == 0 )  ? 'checked' : '' }} onChange="userDeactivate( {{$user->id}});" type="checkbox" id="switch_{{$user->id}}" />
                                                        <label for="switch_{{$user->id}}">Toggle</label> 
                                                    </td>
                                                </tr>
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
<script>
function userDeactivate(userId ){
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
            //console.log('#userId#', userId);
            $.ajax({
                url: '/delete/user',
                type: 'POST',
                data: {
                    _token: token,
                    id: userId, 
                },
                success: function(response) {
                        location.reload();
                },
                error: function(response) {
                    swal.fire(response.responseJSON.message, '', 'error');
                }
            });
         }
    });
}
</script>
