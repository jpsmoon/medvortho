@extends('layouts.home-app')

@section('content')

<!-- START: Breadcrumbs-->
    <div class="row ">
        <div class="col-12  align-self-center">
            <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                <div class="w-sm-100 mr-auto"><h4 class="mb-0">States</h4></div>

                <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                    <li class="breadcrumb-item">
                    @can('state-create')
                    <a class="btn btn-success text-white" href="{{ route('states.create') }}"> Add New</a>
                    @endcan
                    </li>
                </ol>
            </div>
        </div>
    </div>
    <!-- END: Breadcrumbs-->
    
    <!-- @if ($message = Session::get('success')) -->
    <div class="row">
        <div class="col-12 mt-3">
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
                                                <th class="jsgrid-header-cell jsgrid-header-sortable">Code</th>
                                                <th class="jsgrid-header-cell jsgrid-header-sortable">Status</th>
                                                <th class="jsgrid-header-cell">Action</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                @if(count($states))
                                                    @foreach ($states as $state)
                                                    <tr class="jsgrid-row">
                                                        <td class ="jsgrid-cell">{{ ++$i }}</td>
                                                        <td class ="jsgrid-cell">{{ $state->country_name }}</td>
                                                        <td class ="jsgrid-cell">{{ $state->state_name }}</td>
                                                        <td class ="jsgrid-cell">{{ $state->state_code }}</td>
                                                        <td class ="jsgrid-cell">{{ $state->is_active ? 'Active' : 'Block' }}</td>
                                                        <td class ="jsgrid-cell">

                                                                @can('state-edit')
                                                                <a  href="{{ route('states.edit',$state->id) }}" style="
                                                                    float: left;   margin-right: 5px;">
                                                                     <button class="icon-pencil showPointer" type="button" title="Edit" data-id="{{$state->id}}"></button>
                                                                </a>
                                                                @endcan

                                                                @if($state->is_active == '0' || $state->deleted_at != '')
                                                                    <form action="{{ route('states.restore'), $state->id }}" method="POST">
                                                                    @csrf
                                                                    @method('POST')
                                                                    <input type="hidden" value="{{$state->id}}" name="id" />
                                                                    <button type="submit" class="btn btn-success">Restore</button>
                                                                @else
                                                                    <form action="{{ route('states.destroy',$state->id) }}" method="POST">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    @can('state-delete')
                                                                    <button data-id="{{$state->id}}" class="icon-trash showPointer" type="submit"></button>
                                                                    @endcan

                                                                @endif
                                                            </form>
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
