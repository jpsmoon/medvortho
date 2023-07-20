@extends('layouts.home-app')

@section('content')
<!-- START: Breadcrumbs-->
    <div class="row ">
        <div class="col-12  align-self-center">
            <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                <div class="w-sm-100 mr-auto"><h4 class="mb-0">Requesting Physicians</h4></div>

                <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                    <li class="breadcrumb-item">
                         <a class="btn btn-success"  href="{{url('/add/rfa/requesting/physicians',$providerId)}}">Add Requesting Physicians </a>
                    </li>
                    <li class="breadcrumb-item">
                         <a class="btn btn-success"  href="{{url('/billing/providers/setting',$providerId)}}">Back</a>
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
                                        
                                        <th scope="col">NPI</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Specialty</th>
                                        <th scope="col">Active</th>
                                        <th scope="col">Action</th>
                                      </tr>
                                </thead>
                                    <tbody>
                                    @if(count($bRenderings)>0)
                                    @foreach ($bRenderings as $rendering)
                                    <tr>
                                        <td>{{$rendering->npi}}</td>
                                        <td><a href="#">
                                           {{ ($rendering->first_name) ? $rendering->first_name : ''}}
                                           {{ ($rendering->middle_name) ? $rendering->middle_name : ''}}
                                           {{ ($rendering->last_name) ? $rendering->last_name : ''}}
                                        </a></td>
                                        <td>{{($rendering->getSpecility) ? $rendering->getSpecility->name : '-'}}</td>
                                        <td>{{ ($rendering->is_active == 1) ? 'Yes' : 'No'  }}</td>
                                        <td style="width:10%">

                                        <a class="text-info" data-id="" href="">
                                          <i class="icon-pencil showPointer"/></i>
                                        </a>
                                                            
                                        <a class="text-danger" data-id="" onclick="">
                                            <i class="icon-trash showPointer"/></i>
                                        </a>
                                                           
                                        </td>
                                                    
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


@endsection
