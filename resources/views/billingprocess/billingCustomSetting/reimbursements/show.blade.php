@extends('layouts.home-new-app')
<style>
    .provider_heading_type {
        color: #858585;
        font-size: 14px;
        font-weight: 300;
        margin: -9px 0 10px;
    }

    .provider_heading {
        align-items: center;
        color: #3a3a3a;
        display: flex;
        font-size: 18px;
        font-weight: 600;
        line-height: normal;
        margin: 0;
        padding: 11px 0 9px;
    }
</style>
@section('content')
    <div class="row">
        <div class="col-1 mt-4"></div>
        <div class="col-10 mt-4">
            <div class="card row-background">
                <!-- START: Breadcrumbs-->
                <div class="row">
                    <div class="col-12  align-self-center">
                        <div class="sub-header mt-3 py-3 px-1 align-self-center d-sm-flex w-100 rounded heading-background">
                            <div style="padding-top:10px" class="w-sm-100 mr-auto">
                                <h2 class="heading" style="padding-left: 15px;"> Show Billing Rendering</h2>
                            </div>
                            <ol class="breadcrumb bg-transparent align-self-center m-0 p-0">
                                <li class="breadcrumb-item">
                                    <a class="btn btn-primary"
                                        href="{{ url('/billing/rendering', $bRenderings->billing_provider_id) }}">
                                        Back</a>
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                <!-- END: Breadcrumbs-->

                <div class="card-body" style="padding-left: 30px;">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="19" viewBox="0 0 25 19">
                                    <title>billing provider</title>
                                    <path
                                        d="M24.781 14.159c0 .78-.223 1.449-.67 2.007-.448.558-.986.838-1.616.838H17c-.216 0-.126-.8-.162-1.953-.035-1.14-.182-2.395-.732-3.797-1.067-2.723-2.835-2.682-2.615-2.812.419-.247.515-.37 1.06-.37.937.915 2.057 1.374 3.36 1.374 1.302 0 2.422-.459 3.36-1.375.544 0 1.025.124 1.444.37.418.248.755.566 1.009.956.254.39.463.86.628 1.407a9.26 9.26 0 0 1 .338 1.631c.061.54.091 1.115.091 1.724zM22.033 4.123c0 1.138-.403 2.11-1.208 2.914-.805.806-1.777 1.208-2.915 1.208-1.138 0-2.11-.402-2.914-1.208-.806-.805-1.208-1.776-1.208-2.914 0-1.138.402-2.11 1.208-2.915C15.8.403 16.772 0 17.91 0c1.138 0 2.11.403 2.915 1.208.805.805 1.208 1.777 1.208 2.915zM4.363 15.205c0 .26-.096.486-.286.676a.925.925 0 0 1-.677.286.925.925 0 0 1-.676-.286.925.925 0 0 1-.286-.676c0-.261.095-.487.286-.677a.925.925 0 0 1 .676-.286c.26 0 .486.096.677.286.19.19.286.416.286.677zm11.42.727c0 .955-.274 1.706-.82 2.25-.545.546-1.27.818-2.174.818H2.993c-.904 0-1.63-.272-2.175-.817C.273 17.638 0 16.887 0 15.932c0-.537.02-1.055.062-1.552.04-.498.13-1.043.269-1.635a7.72 7.72 0 0 1 .532-1.57c.217-.454.52-.86.908-1.22a2.93 2.93 0 0 1 1.345-.717c-.164.411-.247.885-.247 1.422v2.405c-.433.158-.78.434-1.042.83a2.33 2.33 0 0 0-.392 1.314c0 .632.209 1.169.627 1.611a2.02 2.02 0 0 0 1.525.664 2.02 2.02 0 0 0 1.524-.664c.419-.442.628-.98.628-1.611 0-.482-.133-.92-.398-1.315a2.112 2.112 0 0 0-1.037-.83V10.66c0-.49.094-.857.28-1.102.987.822 2.089 1.232 3.307 1.232s2.32-.41 3.307-1.232c.186.245.28.612.28 1.102v.758c-.792 0-1.468.296-2.029.889-.56.592-.84 1.307-.84 2.144v1.054a1.12 1.12 0 0 0-.36.841c0 .316.105.585.315.806.209.221.463.332.762.332s.553-.111.762-.332c.21-.221.314-.49.314-.806 0-.331-.12-.612-.359-.84V14.45c0-.41.142-.766.426-1.066.284-.3.62-.45 1.009-.45.388 0 .725.15 1.009.45.284.3.426.655.426 1.066v1.054a1.12 1.12 0 0 0-.36.841c0 .316.106.585.315.806.209.221.463.332.762.332s.553-.111.762-.332c.21-.221.314-.49.314-.806 0-.331-.12-.612-.359-.84V14.45c0-.537-.129-1.04-.386-1.51a2.907 2.907 0 0 0-1.048-1.108c0-.08.001-.247.005-.504.004-.256.004-.446 0-.568a12.29 12.29 0 0 0-.028-.492 3.8 3.8 0 0 0-.078-.557 3.147 3.147 0 0 0-.146-.474 2.93 2.93 0 0 1 1.345.717c.389.36.691.766.908 1.22.217.454.394.978.532 1.57.139.592.228 1.137.27 1.635.04.497.061 1.015.061 1.552zM12.433 4.806c0 1.256-.444 2.328-1.332 3.216-.889.889-1.961 1.333-3.217 1.333S5.557 8.91 4.67 8.022c-.889-.888-1.333-1.96-1.333-3.216 0-1.256.444-2.328 1.333-3.217C5.557.701 6.629.257 7.885.257c1.256 0 2.328.444 3.217 1.332.888.889 1.332 1.961 1.332 3.217z"
                                        fill="#3A3A3A" fill-rule="evenodd"></path>
                                </svg>
                            </label>
                            <span style="font-size:16px; font-weight:bold">
                                @if ($bRenderings->provider_type == 1)
                                    {{ $bRenderings->referring_provider_first_name }}
                                    {{ $bRenderings->referring_provider_last_name ? $bRenderings->referring_provider_last_name : '' }}
                                    {{ $bRenderings->referring_provider_middle_name ? $bRenderings->referring_provider_middle_name : '' }}
                                @else
                                    {{ $bRenderings->entity_name }}
                                @endif
                            </span>
                            <br>
                            <span
                                class="provider_heading_type">{{ $bRenderings->type == 1 ? 'Referring Provider' : ($bRenderings->type == 2 ? 'Supervising Provider' : 'Rendering Provider') }}</span>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                            <div class="col-md-12">
                                <a href="{{ url('/edit/billing/rendering') }}/{{ $bRenderings->billing_provider_id }}/{{ $bRenderings->id }}"
                                    class="btn btn-primary"><i class="icon-note"></i> Edit</span></a>
                            </div>
                            <div class="col-md-12" style="padding-top:10px;">
                                <label for="rendering_provider_npi"> Name :-</label>
                                <span class="bold">
                                    @if ($bRenderings->provider_type == 1)
                                        {{ $bRenderings->referring_provider_first_name }}
                                        {{ $bRenderings->referring_provider_last_name ? $bRenderings->referring_provider_last_name : '' }}
                                        {{ $bRenderings->referring_provider_middle_name ? $bRenderings->referring_provider_middle_name : '' }}
                                    @else
                                        {{ $bRenderings->entity_name }}
                                    @endif
                                </span>
                            </div>
                        
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row" style="padding-left:10px">
                                <div class="col-md-3">
                                    <label for="rendering_provider_npi"> NPI :-</label>
                                    <span class="bold">{{ $bRenderings->referring_provider_npi }}</span>
                                </div>
                                <div class="col-md-3">
                                    <label for="rendering_provider_npi"> Taxonomy Code :-</label>
                                    <span class="bold">{{ $bRenderings->taxonomyCode ? $bRenderings->taxonomyCode->code . ' ' . $bRenderings->taxonomyCode->name : '-' }}</span>
                                </div>
                            </div>
                            
                            <hr>
                            
                            <div class="row" style="padding-left:10px">
                                    <div class="col-md-3">
                                    <label for="rendering_provider_npi"> Provider Type :-</label>
                                    <span class="bold">{{ $bRenderings->provider_type == 1 ? 'Person' : 'Non Person' }}</span>
                                    </div>
                                </div>
                             <hr>   
                                
                            <!--<div class="form-row mt-4 d-none" id="personDiv">-->
                            <!--    <div class="form-group col-md-3">-->
                            <!--        <label for="fName"> First Name:-</label>-->
                            <!--        <span>{{ $bRenderings->referring_provider_first_name }}</span>-->
                            <!--    </div>-->
                            <!--    <div class="form-group col-md-3">-->
                            <!--        <label for="lName"> Last Name:-</label>-->
                            <!--        <span>{{ $bRenderings->referring_provider_last_name }}</span>-->
                            <!--    </div>-->
                            <!--    <div class="form-group col-md-3">-->
                            <!--        <label for="mName"> MI:-</label>-->
                            <!--        <span>{{ $bRenderings->referring_provider_middle_name }}</span>-->
                            <!--    </div>-->
                            <!--    <div class="form-group col-md-3">-->
                            <!--        <label for="suffix"> Suffix:-</label>-->
                            <!--        <span>{{ $bRenderings->referring_provider_suffix }}</span>-->
                            <!--    </div>-->
                            <!--</div>-->
                            
                            <!--<div class="form-row mt-6 d-none" id="nonPersonDiv">-->
                            <!--    <div class="form-group col-md-3">-->
                            <!--        <label for="entityName"> Entity Name:-</label>-->
                            <!--        <span>{{ $bRenderings->entity_name }}</span>-->
                            <!--    </div>-->
                            <!--</div>-->
                            
                            <div class="form-row mt-3" id="">
                                <div class="form-group col-md-3">
                                    <label for="signature_img">Signature :-</label>
                                </div>
                                
                                <div class="col-md-3">
                                    <label for="rendering_provider_npi"> Active? :-</label>
                                <span><b>Yes</b></span>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-1 mt-4"></div>
    </div>
@endsection
