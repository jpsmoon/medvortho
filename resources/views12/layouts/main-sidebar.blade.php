<div class="sidebar">
       <!-- START: Menu-->
            <ul id="side-menu" class="sidebar-menu">
                <li class="dropdown active" style="font-weight: 900; text-decoration: underline;"><a href="{{ route('home') }}">Dashboard</a>
                </li>
                @can('components')
                <li class="dropdown"><a href="#">Schedular</a>
                    <ul>
                        <li><a href="{{url('/patient/create/schedular')}}"><i class="icon-chart"></i>Schedular</a></li>
                    </ul>
                </li>
                <li class="dropdown"><a href="#">Component</a>
                        <ul>
                            <li class="dropdown"><a href="#"><i class="icon-chart"></i>Custom Components</a>
                                <ul class="sub-menu">
                                    <li><a href="{{ route('billingproviders.index') }}"><i class="icon-calendar"></i> Billing Providers</a></li>
                                    <li><a href="{{ route('healthproviders.index') }}"><i class="icon-calendar"></i>Health Providers</a></li>
                                    <li><a href="{{ route('patients.index') }}"><i class="icon-calendar"></i>Patient</a></li>
                                    <li><a href="{{ route('claimadministrators.index') }}""><i class="icon-calendar"></i>Claim Administrator</a></li>
                                    <li><a href="{{ route('medicalproviders.index') }}"><i class="icon-calendar"></i>Medical Provider</a></li>
                                </ul>
                            </li>
                        </ul>
                </li>
                @endcan
                @can('masters')
                <li class="dropdown"><a href="#">Masters</a>
                    <ul>
                        <li class="dropdown"><a href="#"><i class="icon-chart"></i>Custom Masters</a>
                            <ul class="sub-menu">
                                <li><a href="{{ route('diagnosiscodes.index') }}">Diagnosis Codes</a></li>
                                <li><a href="{{ route('taxonomycodes.index') }}">Taxonomy Codes</a>
                                <li><a href="{{ route('servicecodes.index') }}">Place of Service Codes</a></li>
                                <li><a href="{{ route('claimstatuses.index') }}">Claim Status</a></li>
                                <li><a href="{{ route('companytypes.index') }}">CompanyType</a></li>
                                <li><a href="{{ route('payertypes.index') }}">PayerType</a></li>
                                <li><a href="{{ route('countries.index') }}">Country</a></li>
                                <li><a href="{{ route('states.index') }}">State</a></li>
                                <li><a href="{{ route('cities.index') }}">City</a></li>
                                <li><a href="{{ route('tasks.index') }}">Task</a></li>
                                <li><a href="{{ route('statuses.index') }}">Task's Status</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                @endcan
                @can('permissions')
                <li class="dropdown"><a href="#">Permissions</a>
                    <ul>
                        <li class="dropdown"><a href="#"><i class="icon-chart"></i>Custom Utilities</a>
                            <ul class="sub-menu">
                                <li> <a class="collapse-item" href="{{ route('users.index') }}">Manage Users</a></li>
                                <li><a class="collapse-item" href="{{ route('roles.index') }}">Manage Role</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                @endcan
            </ul>
            <!-- END: Menu-->
        </div>
