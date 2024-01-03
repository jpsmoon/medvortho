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
    
    @if ($errors->any())
        <div class="row mt-2 customBox">
            <div align="center" class="col-12  align-self-center">
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif
    <div class="row mt-2 ">
        <div class="col-md-12 mt-4">
            <div class="card row-background customBoxHeight">
                <!-- START: Breadcrumbs-->
                <div class="row ">
                    <div class="col-12  align-self-center">
                        <div class="sub-header py-3 px-3 align-self-center d-sm-flex w-100 rounded heading-background">
                            <div style="padding-top:10px" class="w-sm-100 mr-auto">
                                <h2 class="heading">Referring and Ordering Providers</h2>
                            </div>
                             <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                             <li class="breadcrumb-item">
                            
                            <a class="btn btn-primary"  href="{{url('/add-custom-referring-ordering-providers',$providerId)}}"> Add Referring Provider</a>
                           
                            </li>  
                                 
                            <li class="breadcrumb-item">
                                <a class="btn btn-primary" href="{{ url('/billing/providers/setting', $providerId) }}"> Back</a>
                            </li>
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
                                        <th scope="col">Name</th>
                                        <th scope="col">NPI</th>
                                         <th scope="col">Provider Type</th>
                                        <th scope="col">License No.</th>
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
                                                <td>{{ ($rendering->type== 1) ? "Referring" : (($rendering->type == 2) ? "Supervising" : "Ordering") }}</td>
                                                
                                                <td>{{ ($rendering->referring_provider_license_number) ? $rendering->referring_provider_license_number : '-'}}</td>
                                                
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
            </div>
            <div class="col-1 mt-4"></div>
        </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://code.jquery.com/jquery-migrate-1.2.1.js"></script>
<script src="{{ asset('js/bootstrap-inputmask.js') }}"></script>
<script src="{{ asset('js/controller/master_for_all.js') }}"></script>
<script></script>
