<ul class="metismenu list-unstyled" id="side-menu">
    <li class="menu-title">Menu</li>

    <li>
        <a href="{{ route('dashboard') }}" class="waves-effect"><i class="mdi mdi-home-analytics"></i><span>Dashboard</span></a>
    </li>

    <li>
        <a href="javascript: void(0);" class="has-arrow waves-effect"><i class="feather-users"></i><span>Users Management</span></a>
        <ul class="sub-menu" aria-expanded="false">
            <li><a href="{{ route('users.index') }}"><span>Users</span></a></li>
            <li><a href="{{ route('roles.index') }}"><span>Roles</span></a></li>
        </ul>
    </li>

    <li>
        <a href="javascript: void(0);" class="has-arrow waves-effect"><i class="feather-map-pin"></i><span>Regions</span></a>
        <ul class="sub-menu" aria-expanded="false">
            <li><a href="{{ route('states.index') }}"><span>States</span></a></li>
            <li><a href="{{ route('districts.index') }}"><span>Districts</span></a></li>
            <li><a href="{{ route('subdistricts.index') }}"><span>Sub Districts</span></a></li>
            <!-- <li><a href=""><span>Villages</span></a></li> -->
        </ul>
    </li>

</ul>
