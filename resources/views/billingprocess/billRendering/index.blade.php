@extends('layouts.home-app')
@section('content')

<!-- START: Breadcrumbs-->
    <div class="row ">
        <div class="col-12  align-self-center">
            <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                <div class="w-sm-100 mr-auto"><h4 class="mt-3">Rendering Providers</h4> </div>
                
                <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                    <li class="breadcrumb-item">
                        @can('Patient-create')
                        <a class="btn btn-primary"  href="{{url('/add/billing/rendering',$id)}}"> Add Rendering Provider</a>
                        @endcan
                    </li>
                    <li class="breadcrumb-item">
                         <a class="btn btn-primary" href="{{url('/billing/providers/setting',$id)}}">Back </a>
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
                                        <th scope="col">Name</th>
                                        <th scope="col">NPI</th>
                                        <th scope="col">Taxomony Code</th>
                                        <th scope="col">Type</th>
                                        <th scope="col">Active</th>
                                    </tr>
                                </thead>
                                    <tbody>
                                            @if(count($bRenderings)>0)
                                                @foreach ($bRenderings as $rendering)
                                                <tr>
                                                    <td>
                                                        <a href="{{ url('/view/billing/rendering',$rendering->id)}}">
                                                        {{$rendering->referring_provider_first_name}} {{ ($rendering->referring_provider_last_name) ? $rendering->referring_provider_last_name : ''}} {{ ($rendering->referring_provider_middle_name) ? $rendering->referring_provider_middle_name : ''}}
                                                    </a></td>
                                                    <td>{{$rendering->referring_provider_npi}}</td>
                                                    <td>{{ ($rendering->taxonomyCode) ? $rendering->taxonomyCode->code." " .$rendering->taxonomyCode->name : '-'}}</td>
                                                    <td>Rendering</td>
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
@endsection 
