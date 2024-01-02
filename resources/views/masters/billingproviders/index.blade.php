@extends('layouts.home-new-app')
@section('content')
    <!-- START: Breadcrumbs-->
    <!-- END: Breadcrumbs-->
    @if ($errors->any())
        <div class="row mt-2 customBox">
            <div class="col-md-12  align-self-center">
                <div class="sub-header mt-3 py-3 px-3 align-self-center d-sm-flex w-100 rounded">
                    <div class="w-sm-100 mr-auto">
                        <h4 class="mb-0">Billing Providers List</h4>
                    </div>
                    <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                        <li class="breadcrumb-item">
                            <a class="btn btn-primary" href="{{ route('billingproviders.index') }}">Back</a>
                        </li>
                    </ol>
                </div>
            </div>
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
    <div class="row mt-0">
        <div class="col-md-12 mt-0">
            <div class="card row-background customBoxHeight">
                <!-- START: Breadcrumbs-->
                <div class="row ">
                    <div class="col-12  align-self-center">
                        <div class="sub-header py-3 px-3 align-self-center d-sm-flex w-100 rounded heading-background">
                            <div class="w-sm-100 mr-auto">
                                <h2 class="heading"> Billing Providers</h2>
                            </div>
                            <!-- <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                            <li style="padding-bottom:10px" class="breadcrumb-item">
                                <a class="btn btn-primary" href="{{ route('billingproviders.index') }}"> Back</a>
                            </li>
                        </ol> -->
                        </div>
                    </div>
                </div>
                <!-- END: Breadcrumbs-->
                <div class="card-content">
                    <div class="col-md-12 col-12 boxControl">
                        <div class="row">
                            @can('billing-provider-list')
                                @if (count($billingproviders))
                                    @foreach ($billingproviders as $billing_provider)
                                        <div class="col-3 col-lg-3 mt-3">
                                            <div class="card">
                                                <div class="box custom-billing-box">
                                                    <a href="{{ url('/billing/providers/setting/' . $billing_provider->id) }}">
                                                        <table width="100%" class="innerbox">
                                                            <tr>
                                                                <td class="billin-icon">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="25"
                                                                        height="19" viewBox="0 0 25 19" class="center">
                                                                        <title>billing provider</title>
                                                                        <path
                                                                            d="M24.781 14.159c0 .78-.223 1.449-.67 2.007-.448.558-.986.838-1.616.838H17c-.216 0-.126-.8-.162-1.953-.035-1.14-.182-2.395-.732-3.797-1.067-2.723-2.835-2.682-2.615-2.812.419-.247.515-.37 1.06-.37.937.915 2.057 1.374 3.36 1.374 1.302 0 2.422-.459 3.36-1.375.544 0 1.025.124 1.444.37.418.248.755.566 1.009.956.254.39.463.86.628 1.407a9.26 9.26 0 0 1 .338 1.631c.061.54.091 1.115.091 1.724zM22.033 4.123c0 1.138-.403 2.11-1.208 2.914-.805.806-1.777 1.208-2.915 1.208-1.138 0-2.11-.402-2.914-1.208-.806-.805-1.208-1.776-1.208-2.914 0-1.138.402-2.11 1.208-2.915C15.8.403 16.772 0 17.91 0c1.138 0 2.11.403 2.915 1.208.805.805 1.208 1.777 1.208 2.915zM4.363 15.205c0 .26-.096.486-.286.676a.925.925 0 0 1-.677.286.925.925 0 0 1-.676-.286.925.925 0 0 1-.286-.676c0-.261.095-.487.286-.677a.925.925 0 0 1 .676-.286c.26 0 .486.096.677.286.19.19.286.416.286.677zm11.42.727c0 .955-.274 1.706-.82 2.25-.545.546-1.27.818-2.174.818H2.993c-.904 0-1.63-.272-2.175-.817C.273 17.638 0 16.887 0 15.932c0-.537.02-1.055.062-1.552.04-.498.13-1.043.269-1.635a7.72 7.72 0 0 1 .532-1.57c.217-.454.52-.86.908-1.22a2.93 2.93 0 0 1 1.345-.717c-.164.411-.247.885-.247 1.422v2.405c-.433.158-.78.434-1.042.83a2.33 2.33 0 0 0-.392 1.314c0 .632.209 1.169.627 1.611a2.02 2.02 0 0 0 1.525.664 2.02 2.02 0 0 0 1.524-.664c.419-.442.628-.98.628-1.611 0-.482-.133-.92-.398-1.315a2.112 2.112 0 0 0-1.037-.83V10.66c0-.49.094-.857.28-1.102.987.822 2.089 1.232 3.307 1.232s2.32-.41 3.307-1.232c.186.245.28.612.28 1.102v.758c-.792 0-1.468.296-2.029.889-.56.592-.84 1.307-.84 2.144v1.054a1.12 1.12 0 0 0-.36.841c0 .316.105.585.315.806.209.221.463.332.762.332s.553-.111.762-.332c.21-.221.314-.49.314-.806 0-.331-.12-.612-.359-.84V14.45c0-.41.142-.766.426-1.066.284-.3.62-.45 1.009-.45.388 0 .725.15 1.009.45.284.3.426.655.426 1.066v1.054a1.12 1.12 0 0 0-.36.841c0 .316.106.585.315.806.209.221.463.332.762.332s.553-.111.762-.332c.21-.221.314-.49.314-.806 0-.331-.12-.612-.359-.84V14.45c0-.537-.129-1.04-.386-1.51a2.907 2.907 0 0 0-1.048-1.108c0-.08.001-.247.005-.504.004-.256.004-.446 0-.568a12.29 12.29 0 0 0-.028-.492 3.8 3.8 0 0 0-.078-.557 3.147 3.147 0 0 0-.146-.474 2.93 2.93 0 0 1 1.345.717c.389.36.691.766.908 1.22.217.454.394.978.532 1.57.139.592.228 1.137.27 1.635.04.497.061 1.015.061 1.552zM12.433 4.806c0 1.256-.444 2.328-1.332 3.216-.889.889-1.961 1.333-3.217 1.333S5.557 8.91 4.67 8.022c-.889-.888-1.333-1.96-1.333-3.216 0-1.256.444-2.328 1.333-3.217C5.557.701 6.629.257 7.885.257c1.256 0 2.328.444 3.217 1.332.888.889 1.332 1.961 1.332 3.217z"
                                                                            fill="#3A3A3A" fill-rule="evenodd"></path>
                                                                    </svg>
                                            
                                                    
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center">
                                                                    <b>{{ $billing_provider->professional_provider_name }}</b>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center">
                                                                    <b>FEIN:</b>
                                                                    {{ $billing_provider->professional_npi ? $billing_provider->professional_npi : '-' }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center">
                                                                    <b>NPI:</b>
                                                                    {{ $billing_provider->tax_id ? $billing_provider->tax_id : '-' }}
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td align="center" class="pb-1"><a href="{{ url('/billing/providers/setting/' . $billing_provider->id) }}">Manage
                                                                        &nbsp;<i class="icon-arrow-right-circle"></i></a>
                                                                        <i class="icon-close" ></i>
                                                                        </td>
                                                            </tr>
                                                        </table>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            @endcan
                            @can('billing-provider-create')
                                <div class="col-3 col-lg-3 mt-3">
                                    <div class="card">
                                        <div class="box custom-billing-box">
                                            <table width="100%" class="innerbox">
                                                <tr>
                                                    <td class="billin-icon">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="25"
                                                                height="19" viewBox="0 0 25 19">
                                                                <title>billing provider</title>
                                                                <path
                                                                    d="M24.781 14.159c0 .78-.223 1.449-.67 2.007-.448.558-.986.838-1.616.838H17c-.216 0-.126-.8-.162-1.953-.035-1.14-.182-2.395-.732-3.797-1.067-2.723-2.835-2.682-2.615-2.812.419-.247.515-.37 1.06-.37.937.915 2.057 1.374 3.36 1.374 1.302 0 2.422-.459 3.36-1.375.544 0 1.025.124 1.444.37.418.248.755.566 1.009.956.254.39.463.86.628 1.407a9.26 9.26 0 0 1 .338 1.631c.061.54.091 1.115.091 1.724zM22.033 4.123c0 1.138-.403 2.11-1.208 2.914-.805.806-1.777 1.208-2.915 1.208-1.138 0-2.11-.402-2.914-1.208-.806-.805-1.208-1.776-1.208-2.914 0-1.138.402-2.11 1.208-2.915C15.8.403 16.772 0 17.91 0c1.138 0 2.11.403 2.915 1.208.805.805 1.208 1.777 1.208 2.915zM4.363 15.205c0 .26-.096.486-.286.676a.925.925 0 0 1-.677.286.925.925 0 0 1-.676-.286.925.925 0 0 1-.286-.676c0-.261.095-.487.286-.677a.925.925 0 0 1 .676-.286c.26 0 .486.096.677.286.19.19.286.416.286.677zm11.42.727c0 .955-.274 1.706-.82 2.25-.545.546-1.27.818-2.174.818H2.993c-.904 0-1.63-.272-2.175-.817C.273 17.638 0 16.887 0 15.932c0-.537.02-1.055.062-1.552.04-.498.13-1.043.269-1.635a7.72 7.72 0 0 1 .532-1.57c.217-.454.52-.86.908-1.22a2.93 2.93 0 0 1 1.345-.717c-.164.411-.247.885-.247 1.422v2.405c-.433.158-.78.434-1.042.83a2.33 2.33 0 0 0-.392 1.314c0 .632.209 1.169.627 1.611a2.02 2.02 0 0 0 1.525.664 2.02 2.02 0 0 0 1.524-.664c.419-.442.628-.98.628-1.611 0-.482-.133-.92-.398-1.315a2.112 2.112 0 0 0-1.037-.83V10.66c0-.49.094-.857.28-1.102.987.822 2.089 1.232 3.307 1.232s2.32-.41 3.307-1.232c.186.245.28.612.28 1.102v.758c-.792 0-1.468.296-2.029.889-.56.592-.84 1.307-.84 2.144v1.054a1.12 1.12 0 0 0-.36.841c0 .316.105.585.315.806.209.221.463.332.762.332s.553-.111.762-.332c.21-.221.314-.49.314-.806 0-.331-.12-.612-.359-.84V14.45c0-.41.142-.766.426-1.066.284-.3.62-.45 1.009-.45.388 0 .725.15 1.009.45.284.3.426.655.426 1.066v1.054a1.12 1.12 0 0 0-.36.841c0 .316.106.585.315.806.209.221.463.332.762.332s.553-.111.762-.332c.21-.221.314-.49.314-.806 0-.331-.12-.612-.359-.84V14.45c0-.537-.129-1.04-.386-1.51a2.907 2.907 0 0 0-1.048-1.108c0-.08.001-.247.005-.504.004-.256.004-.446 0-.568a12.29 12.29 0 0 0-.028-.492 3.8 3.8 0 0 0-.078-.557 3.147 3.147 0 0 0-.146-.474 2.93 2.93 0 0 1 1.345.717c.389.36.691.766.908 1.22.217.454.394.978.532 1.57.139.592.228 1.137.27 1.635.04.497.061 1.015.061 1.552zM12.433 4.806c0 1.256-.444 2.328-1.332 3.216-.889.889-1.961 1.333-3.217 1.333S5.557 8.91 4.67 8.022c-.889-.888-1.333-1.96-1.333-3.216 0-1.256.444-2.328 1.333-3.217C5.557.701 6.629.257 7.885.257c1.256 0 2.328.444 3.217 1.332.888.889 1.332 1.961 1.332 3.217z"
                                                                    fill="#3A3A3A" fill-rule="evenodd"></path>
                                                            </svg>

                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18"
                                                                height="19" viewBox="0 0 18 19">
                                                                <title>icon-pharmacy</title>
                                                                <path
                                                                    d="M10.681 1.234c1.846-1.2 3.571-1.125 5.177.223 1.606 1.347 1.978 3.033 1.118 5.059L7.791 17.462c-1.908 1.491-3.72 1.518-5.432.081-1.712-1.436-2-3.224-.862-5.363L10.68 1.234zm.859.72L7.19 7.139l4.577 3.841 4.351-5.185c.557-1.371.247-2.551-.93-3.54-1.178-.987-2.394-1.088-3.648-.301z"
                                                                    fill="#3A3A3A" fill-rule="evenodd"></path>
                                                            </svg>

                                                            <svg xmlns="http://www.w3.org/2000/svg" width="18"
                                                                height="20" viewBox="0 0 18 20">
                                                                <title>icon-institutional</title>
                                                                <path
                                                                    d="M17.442 19.219V20H0v-.781c0-.26.21-.469.467-.469h.779V4.687c0-.517.418-.937.934-.937h3.426V.937c0-.517.419-.937.935-.937h4.36c.516 0 .935.42.935.938V3.75h3.426c.516 0 .934.42.934.938V18.75h.779c.258 0 .467.21.467.469zM11.992 7.5h-1.558a.468.468 0 0 0-.467.469V9.53c0 .26.209.469.467.469h1.557c.258 0 .467-.21.467-.469V7.97a.468.468 0 0 0-.467-.469zM5.45 10h1.557c.258 0 .467-.21.467-.469V7.97a.468.468 0 0 0-.467-.469H5.45a.468.468 0 0 0-.468.469V9.53c0 .26.21.469.468.469zM9.5 15H7.942a.468.468 0 0 0-.467.469v3.281h2.492v-3.281A.468.468 0 0 0 9.5 15zm2.491-3.75h-1.557a.468.468 0 0 0-.467.469v1.562c0 .26.209.469.467.469h1.557c.258 0 .467-.21.467-.469V11.72a.468.468 0 0 0-.467-.469zm-4.516.469a.468.468 0 0 0-.467-.469H5.45a.468.468 0 0 0-.468.469v1.562c0 .26.21.469.468.469h1.557c.258 0 .467-.21.467-.469V11.72zm-.39-7.969h1.013v1.016c0 .13.105.234.234.234h.778a.234.234 0 0 0 .234-.234V3.75h1.012a.234.234 0 0 0 .234-.234v-.782a.234.234 0 0 0-.234-.234H9.344V1.484a.234.234 0 0 0-.234-.234h-.778a.234.234 0 0 0-.234.234V2.5H7.086a.234.234 0 0 0-.234.234v.782c0 .13.105.234.234.234z"
                                                                    fill="#3A3A3A" fill-rule="nonzero"></path>
                                                            </svg>
                                                        <br><br>
                                                        <a class="text-success"href="{{ route('billingproviders.create') }}"><b style="font-weight:800"> Add Billing Provider </b></a>
                                                    </td>
                                                </tr>
                                            
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endcan
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
