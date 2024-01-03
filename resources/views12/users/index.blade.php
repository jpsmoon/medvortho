@extends('layouts.home-app')
@section('content')

<!-- START: Breadcrumbs-->
    <div class="row ">
        <div class="col-12  align-self-center">
            <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                <div class="w-sm-100 mr-auto"><h4 class="mt-3">Account Users</h4></div>
                <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                    <li class="breadcrumb-item">
                      <a class="btn btn-primary" href="javascript:void(0)"> Invite User</a>
                    </li>
                </ol>
            </div>
        </div>
    </div>
    <!-- END: Breadcrumbs-->
    <!-- <div class="row">
        <div class="col-12 mt-3">
            <div class="card">
                <div class="card-body">
                {!! Form::open(['class' => 'form-horizontal','id' => 'patientListFrm','method'=>"get"]) !!}
                <div class="row row-xs">
                        <div class="col-md-10 mt-3 mt-md-0" id="keywordDiv">
                            <input type="text" name="keyword" class="form-control" maxlength="200" id="keyword" placeholder="search by patient name, id" value="">
                        </div>

                        <div class="col-md-2">
                            <label for="">&nbsp;</label>
                            <button type="submit" id="patient_Btn" class="btn btn-primary filter_patient">Search</button>
                            <button type="reset" class="btn btn-primary reset_payslip_filter">Reset</button>
                        </div>
                    </div>
                {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div> -->

    <div class="row">
            <div class="col-12 mt-3">
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
                                    @inject('userClass', 'App\Http\Controllers\UserController')
                                        @if(count($data))
                                                @foreach ($data as $key => $user)
                                                @php 
                                                $isFoundBillingAcees = $userClass->checkBillingProviderAccess($user->id);
                                                @endphp
                                                  <tr>
                                                    <td>{{ $user->name }}</td>
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
                                                    <span>Some <i  class="icon-pencil  showPointer"/></i></span>
                                                    @else
                                                     <span>All</span>
                                                    @endif
                                                    </td>
                                                    <td>{{ ($user->last_login_at) ? date('m-d-Y', strtotime($user->last_login_at)) : '' }}</td>
                                                    <td>
                                                      <a class="text-primary"  href="{{ route('users.show',$user->id) }}"> <i  class="icon-eye showPointer"/></i></a>
                                                      <a class="text-info" href="{{ route('users.edit',$user->id) }}"><i  class="icon-pencil  showPointer"/></i></a>
                                                      <a class="text-danger" href="javascript:void(0)"><i  class="icon-trash showPointer"/></i></a>
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
@endsection
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://code.jquery.com/jquery-migrate-1.2.1.js"></script> 
<script src="{{ asset('js/controller/patients.js') }}"></script>
