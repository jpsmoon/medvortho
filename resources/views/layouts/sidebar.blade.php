<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <!-- <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}"> -->
        <!-- Sidebar Toggler (Sidebar) -->
        <!-- <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">MERAKI RCM </div>
    </a> -->
    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
    @can('components')
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Components</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Components:</h6>
                <a class="collapse-item" href="{{ route('billingproviders.index') }}">Billing Providers</a>
                <a class="collapse-item" href="{{ route('healthproviders.index') }}">Health Providers</a>
                <a class="collapse-item" href="{{ route('patients.index') }}">Patient</a>
                <a class="collapse-item" href="{{ route('claimadministrators.index') }}">Claim Administrator</a>
                <a class="collapse-item" href="{{ route('medicalproviders.index') }}">Medical Provider</a>
                <!-- <a class="collapse-item" href="{{ route('billprocess.index') }}">Bill Process</a> -->

                <!-- <a class="collapse-item" href="{{ route('products.index') }}">Product</a> -->
            </div>
        </div>
    @endcan
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">
        Settings
    </div>
    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        @can('permissions')
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Permissions</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Utilities:</h6>
                <a class="collapse-item" href="{{ route('users.index') }}">Manage Users</a>
                <a class="collapse-item" href="{{ route('roles.index') }}">Manage Role</a>
                <!-- <a class="collapse-item" href="{{ route('usertasks.index') }}">Assign Task</a> -->
            </div>
        </div>
        @endcan
        @can('masters')
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseMasters"
            aria-expanded="true" aria-controls="collapseMasters">
            <i class="fas fa-fw fa-book"></i>
            <span>Masters</span>
        </a>
        <div id="collapseMasters" class="collapse" aria-labelledby="headingMasters"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <!-- <h6 class="collapse-header">Custom Utilities:</h6> -->

                <a class="collapse-item" href="{{ route('diagnosiscodes.index') }}">Diagnosis Codes</a>
                <a class="collapse-item" href="{{ route('taxonomycodes.index') }}">Taxonomy Codes</a>
                <a class="collapse-item" href="{{ route('servicecodes.index') }}">Place of Service Codes</a>
                <a class="collapse-item" href="{{ route('claimstatuses.index') }}">Claim Status</a>
                <a class="collapse-item" href="{{ route('companytypes.index') }}">CompanyType</a>
                <a class="collapse-item" href="{{ route('payertypes.index') }}">PayerType</a>
                <a class="collapse-item" href="{{ route('countries.index') }}">Country</a>
                <a class="collapse-item" href="{{ route('states.index') }}">State</a>
                <a class="collapse-item" href="{{ route('cities.index') }}">City</a>
                <a class="collapse-item" href="{{ route('tasks.index') }}">Task</a>
                <a class="collapse-item" href="{{ route('statuses.index') }}">Task's Status</a>
            </div>
        </div>
        @endcan
    </li>
    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">
</ul>
<!-- End of Sidebar -->
