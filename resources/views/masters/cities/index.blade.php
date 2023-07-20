@extends('layouts.home-app')
@section('content')
<!-- START: Breadcrumbs-->
<div class="row ">
        <div class="col-12  align-self-center">
            <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                <div class="w-sm-100 mr-auto"><h4 class="mb-0">Cities</h4></div>

                <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                    <li class="breadcrumb-item">
                    @can('city-create')
                        <a class="btn btn-success" href="{{ route('cities.create') }}"> Add New</a>
                    @endcan
                    </li>
                </ol>
            </div>
        </div>
    </div>
    <!-- END: Breadcrumbs-->


    <!-- @if ($message = Session::get('success')) -->
    <div class="row ">
        <div class="col-12  align-self-center">
            <div class="alert alert-success">
                <p> {{ $message }}</p>
            </div>
        </div>
    </div>
    <!-- @endif -->


    <div class="row">
            <div class="col-12 mt-3">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <div class="jsgrid">
                                <div class="jsgrid-grid-header jsgrid-header-scrollbar">
                                    <table id="example" class="table layout-secondary dataTable table-striped table-bordered">
                                        <thead class="thead-dark">
                                            <tr class="jsgrid-header-row">
                                                <th class="jsgrid-header-cell jsgrid-header-sortable">No</th>
                                                <th class="jsgrid-header-cell jsgrid-header-sortable">Country</th>
                                                <th class="jsgrid-header-cell jsgrid-header-sortable">State</th>
                                                <th class="jsgrid-header-cell jsgrid-header-sortable">City</th>
                                                <th class="jsgrid-header-cell jsgrid-header-sortable">Zip code</th>
                                                <th class="jsgrid-header-cell jsgrid-header-sortable">Status</th>
                                                <th class="jsgrid-header-cell jsgrid-header-sortable">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if(count($cities) > 0)
                                                @foreach ($cities as $city)
                                                <tr class="jsgrid-row">
                                                    <td class="jsgrid-cell">{{ ++$i }}</td>
                                                    <td class="jsgrid-cell">{{ $city->country_name }}</td>
                                                    <td class="jsgrid-cell">{{ $city->state_name }}</td>
                                                    <td class="jsgrid-cell">{{ $city->city_name }}</td>
                                                    <td class="jsgrid-cell">{{ $city->zip_code }}</td>
                                                    <td class="jsgrid-cell">{{ $city->is_active ? 'Active' : 'Block' }}</td>
                                                    <td class="jsgrid-cell">

                                                        <!-- <a class="btn btn-info" href="{{ route('cities.show',$city->id) }}">Show</a> -->
                                                        @can('city-edit')
                                                        <a href="{{ route('cities.edit',$city->id) }}"style="
                                                            float: left;   margin-right: 5px;">
                                                            <i  class="icon-pencil  showPointer"/></i>
                                                        </a>
                                                        @endcan

                                                        @if($city->is_active == '0' || $city->deleted_at != '')
                                                            <form action="{{ route('cities.restore'), $city->id }}" method="POST">
                                                            @csrf
                                                            @method('POST')
                                                            <input type="hidden" value="{{$city->id}}" name="id" />
                                                            <button type="submit" class="btn btn-success">Restore</button></form>
                                                        @else
                                                            <form action="{{ route('cities.destroy',$city->id) }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            @can('city-delete')
                                                            <button type="submit" data-id="{{$city->id}}" class="icon-trash showPointer"></button></form>
                                                            @endcan
                                                        @endif

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
            </div>
        </div>
@endsection
