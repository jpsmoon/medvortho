@extends('layouts.home-app')

@section('content')
<!-- START: Breadcrumbs-->
    <div class="row ">
        <div class="col-12  align-self-center">
            <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                <div class="w-sm-100 mr-auto"><h4 class="mb-0">Practice Locations</h4></div>

                <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                    <li class="breadcrumb-item">
                         <a class="btn btn-primary"  href="{{url('/add/rfa/practice/locations',$providerId)}}"
                         >Add Practice Location </a>
                    </li>
                    
                    <li style="padding-bottom:10px" class="breadcrumb-item">
                        <a class="btn btn-primary" href="{{ url('billing/providers/setting', $providerId) }}"> Back</a>
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
                                        <th scope="col">Practice Name</th>
                                        <th scope="col">Nick Name</th>
                                        <th scope="col">Address</th>
                                        <th scope="col">Telephone</th>
                                        <th scope="col">Active</th>
                                        <th scope="col">Action</th>
                                      </tr>
                                </thead>
                                    <tbody>
                                    @if(count($bRenderings)>0)
                                            @foreach ($bRenderings as $rendering)
                                            <tr>
                                                <td>
                                                    <a href="{{ url('/view/billing/referring/providers',$rendering->billing_provider_id)}}">
                                                    {{$rendering->practice_name}}
                                                   </a></td>
                                                <td>{{$rendering->practice_nick_name}}</td>
                                                <td>{{$rendering->address1}} {{$rendering->address2}}</td>
                                                <td>{{$rendering->telephone_no}}</td>
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


@endsection
