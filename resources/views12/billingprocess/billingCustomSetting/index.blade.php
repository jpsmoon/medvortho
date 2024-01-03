@extends('layouts.home-app')
@section('content')

<style>
#myDIV {
  width: 100%;
  padding: 10px 0;
}
</style>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<?php $billingId = 1;
?>
<!-- START: Breadcrumbs-->
<!-- END: Breadcrumbs-->
    @if ($errors->any())
        <div class="row ">
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
            <div class="col-1 mt-4"></div>
        </div>
    @endif
    <div class="row">
        <div class="col-1 mt-4"></div>
        <div class="col-10 mt-4">
            <div class="card row-background" style="min-height: 565px;">
                <!-- START: Breadcrumbs-->
                <div class="row">
                    <div class="col-12  align-self-center">
                        <div class="sub-header mt-3 py-3 px-1 align-self-center d-sm-flex w-100 rounded heading-background">
                            <div style="padding-top:5px; padding-left:5px;" class="w-sm-100 mr-auto">
                                <li style="padding-bottom:10px" class="breadcrumb-item">
                                    <a class="btn btn-primary" href="{{ url('add-document-billing-custom-setting', $providerId) }}"> <b>Add Documents</b></a>
                                </li>
                                
                            </div>
                            <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                                <li style="padding-bottom:10px" class="breadcrumb-item">
                                    <a class="btn btn-primary" href="{{ url('/billing/providers/setting', $providerId) }}"> Back</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- END: Breadcrumbs-->
                
                <div class="row">
        <div class="col-12 mt-4">
            <div class="card">
                <div class="card-content">
                    <div class="table-responsive">
                        <table id="example" class="table layout-secondary table-striped table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Full Name</th>
                                        <th scope="col">Description</th>
                                        <th scope="col">Upload Date</th>
                                      </tr>
                                </thead>
                                    <tbody>
                                    @if(count($documents)>0)
                                            @foreach ($documents as $document)
                                            <tr>
                                                <td>
                                                    <a href="{{ Storage::url($document->injury_document) }}"  target="_blank">
                                                    <?php $ex = explode('/document/',$document->injury_document);
                                                    if(count($ex)){ echo $ex[1]; } ?>
                                                    </a>
                                                </td>
                                                <td>{{($document->getReportType) ? $document->getReportType->report_name : '-'	}}</td>
                                                <td>{{ date('m-d-Y',strtotime($document->created_at))}}</td>
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
        <div class="col-1 mt-4"></div>
    </div>
    </div>
@endsection
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://code.jquery.com/jquery-migrate-1.2.1.js"></script>
