@extends('layouts.home-app')
@section('content')
<!-- START: Breadcrumbs-->
    <div class="row ">
        <div class="col-12  align-self-center">
            <div class="sub-header mt-3 py-3 px-1 align-self-center d-sm-flex w-100 rounded">
                <div class="w-sm-100 mr-auto"><h4 class="mb-0">Rendering Providers</h4></div>

                <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                    <li class="breadcrumb-item">
                         <a class="btn btn-success" href="{{url('/add-reimbursements',$providerId)}}">Add Reimbursements </a>
                    </li>
                    <li class="breadcrumb-item">
                         <a class="btn btn-success" href="{{url('/billing/providers/setting',$providerId)}}"
                         >Back </a>
                    </li>
                </ol>
            </div>
        </div>
    </div>
    <!-- END: Breadcrumbs-->

    <link href="{{ asset('css/step-content.css') }}" rel="stylesheet">
    @if ($message = Session::get('success'))
    <div class="row ">
        <div class="col-12  align-self-center">
            <div class="alert alert-success">
                <p>{{ $message }}</p>
            </div>
        </div>
    </div>
    @endif
    <div class="row">
        <div class="col-12 mt-4">
            <div class="card">
                <div class="card-content">
                    <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="table layout-secondary dataTable table-striped table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Effective DOS</th>
                                        <th scope="col">Expiration DOS</th>
                                        <th scope="col">Procedure Code Count</th>
                                        <th scope="col">Active</th>
                                      </tr>
                                </thead>
                                    <tbody>
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                            <td colspan="10">No Records Found.</td>
                                        </tr>
                                    
                                    </tbody>
                                </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
