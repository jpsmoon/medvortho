@extends('layouts.home-new-app')


@section('content')
<!-- START: Breadcrumbs-->
<div class="row ">
        <div class="col-12  align-self-center">
            <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                <div class="w-sm-100 mr-auto"><h4 class="mb-0">Health Providers</h4></div>

                <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                    <li class="breadcrumb-item">
                    @can('HealthProvider-create')
                        <a class="btn btn-success" href="{{ route('healthproviders.create') }}"> Add New</a>
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
                                                <th class="jsgrid-header-cell jsgrid-header-sortable">No.</th>
                                                <th class="jsgrid-header-cell jsgrid-header-sortable">Name</th>
                                                <th class="jsgrid-header-cell jsgrid-header-sortable">NPI</th>
                                                <th class="jsgrid-header-cell jsgrid-header-sortable">Taxonomy Code</th>
                                                <th class="jsgrid-header-cell jsgrid-header-sortable">Status</th>
                                                <th class="jsgrid-header-cell jsgrid-header-sortable">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @if(count($health_providers))
                                                @foreach ($health_providers as $health_provider)
                                                <tr class="jsgrid-row" id="todo_{{$health_provider->id}}">
                                                    <td class="jsgrid-cell">{{ ++$i }}</td>
                                                    <td class="jsgrid-cell">{{ $health_provider->entity_type == 'Person' ? ($health_provider->first_name .' '.$health_provider->last_name) :($health_provider->entity_type == 'Non-Person' ? $health_provider->entity_name : 'NA' ) }}</td>
                                                    <td class="jsgrid-cell">{{ $health_provider->npi }}</td>
                                                    <td class="jsgrid-cell">{{ $health_provider->name. ' ('.$health_provider->code.')' }}</td>
                                                    <td class="jsgrid-cell">{{ $health_provider->is_active ? 'Active' : 'Block' }}</td>
                                                    <td class="jsgrid-cell">
                                                        @if($health_provider->is_active == '0' || $health_provider->deleted_at != '')
                                                            @can('HealthProvider-delete')
                                                                <a data-id="{{$health_provider->id}}" class="btn btn-success" onclick="restoreTodo({{$health_provider->id}})">Restore</a>
                                                            @endcan
                                                        @else
                                                            @can('HealthProvider-edit')
                                                                <a data-id="{{$health_provider->id}}" href="{{ route('healthproviders.edit',$health_provider->id) }}">
                                                                <input class="jsgrid-button jsgrid-edit-button" type="button" title="Edit" data-id="{{$health_provider->id}}">
                                                                </a>
                                                            @endcan
                                                            @can('HealthProvider-delete')
                                                                <a data-id="{{$health_provider->id}}" onclick="deleteHealthProvider({{$health_provider->id}})">
                                                                <input data-id="{{$health_provider->id}}" class="jsgrid-button jsgrid-delete-button" type="button"></input>
                                                                </a>

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
    {!! $health_providers->links() !!}

<script src="{{ asset('js/controller/healthproviders.js') }}"></script>
@endsection
