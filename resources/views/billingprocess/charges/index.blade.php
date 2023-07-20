@extends('layouts.home-app')

@section('content')
<!-- START: Breadcrumbs-->
    <div class="row ">
        <div class="col-12  align-self-center">
            <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                <div class="w-sm-100 mr-auto"><h4 class="mb-0">Fee Schedule Reimbursements</h4></div>

                <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                    <li class="breadcrumb-item">
                         <a class="btn btn-success"  href="{{url('/setting/billing/provider/charge/add',$providerId)}}"
                         >Add charge </a>
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
                                        <th scope="col">Provider Type</th>
                                        <th scope="col">NPI</th>
                                        <th scope="col">State License Number</th>
                                        <th scope="col">Active</th>
                                      </tr>
                                </thead>
                                    <tbody>
                                    @if(count($bRenderings)>0)
                                            @foreach ($bRenderings as $rendering)
                                            <tr>
                                                <td>
                                                    <a href="{{ url('/view/billing/referring/providers',$rendering->billing_provider_id)}}">
                                                   {{$rendering->referring_provider_first_name}}
                                                    {{ ($rendering->referring_provider_last_name) ? $rendering->referring_provider_last_name : ''}} {{ ($rendering->referring_provider_middle_name) ? $rendering->referring_provider_middle_name : ''}}
                                                </a></td>
                                                <td>{{$rendering->referring_provider_npi}}</td>
                                                <td>{{ ($rendering->taxonomyCode) ? $rendering->taxonomyCode->code." " .$rendering->taxonomyCode->name : '-'}}</td>
                                                <td>{{ ($rendering->type== 1) ? "Referring" : (($rendering->type == 2)  ? "Supervising" : "Ordering")
                                                 }}</td>
                                                 <td>{{ ($rendering->is_active == 1) ? 'Yes' : 'No'  }}</td>
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
