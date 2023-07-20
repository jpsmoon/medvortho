@extends('layouts.home-app')
@section('content')

<!-- START: Breadcrumbs-->
    <div class="row ">
        <div class="col-12  align-self-center">
            <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                <div class="w-sm-100 mr-auto"><h4 class="mt-3">Practice Contacts</h4>
                
                </div>
                
                <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                    <li class="breadcrumb-item">
                         <a class="btn btn-primary" href="{{url('/add/practice/contact',$providerId)}}">Add Practice Contact</a> 
                    </li>
                    <li class="breadcrumb-item">
                         <a class="btn btn-primary" href="{{url('/billing/providers/setting',$providerId)}}">Back</a> 
                    </li>
                </ol>
            </div>
        </div>
    </div>
    <!-- END: Breadcrumbs-->
    

    <div class="row">
            <div class="col-12 mt-3">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example" class="table layout-secondary dataTable table-striped table-bordered">
                                <thead class="thead-dark">
                                    <tr>
                                        <th scope="col">Name</th>
                                        <th scope="col">Telephone</th>
                                        <th scope="col">E-mail</th>
                                        <th scope="col">Active</th>
                                        <th scope="col">Action</th>
                                      </tr>
                                </thead>
                                <tbody>
                                    @if(count($practicecontacts)>0)
                                        @foreach ($practicecontacts as $practicecontactlist)
                                        <tr>
                                            <td style="width:30%">
                                            <a href="{{url('/show/practice/contact', $practicecontactlist->id)}}">{{$practicecontactlist->suffix_name." " .$practicecontactlist->first_name." " . $practicecontactlist->middle_name." " . $practicecontactlist->last_name }} </a></td>
                                            <td style="width:20%">{{$practicecontactlist->telephone}}</td>
                                            <td style="width:20%">{{$practicecontactlist->email}}</td>
                                            <td style="width:20%">{{ ($practicecontactlist->is_active == 1) ? 'Yes' : 'No'  }}</td>
                                            <td style="width:10%">
                                                <a class="text-info"  data-id="{{$practicecontactlist->id}}" href="{{url('/edit/practice/contact')}}/{{$practicecontactlist->billing_provider_id}}/{{$practicecontactlist->id}}">
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
@endsection 
