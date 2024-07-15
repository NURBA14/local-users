<div class="sidebar-collapse">
    <ul class="nav metismenu" id="side-menu">
        <li class="nav-header">
            <div class="dropdown profile-element">
                <h1 class="text-light text-center">Users</h1>
            </div>
            <div class="logo-element">
                Users
            </div>
        </li>
        <li class="">
            <a href="{{ route('home') }}"><i class="fa fa-home"></i> <span class="nav-label">Home</span></a>
        </li>
        <li class="">
            <a href="{{ route('statistic') }}">
                <i class="fa fa-pie-chart"></i>
                <span class="nav-label">Statistic</span></a>
        </li>
        <li class="">
            <a href="{{ route('docs.index') }}">
                <i class="fa fa-code"></i>
                <span class="nav-label">Docs</span></a>
        </li>
        <li>
            <a href="#"><i class="fa fa-th-large"></i> <span class="nav-label">List</span>
                <span class="fa arrow"></span></a>
            <ul class="nav nav-second-level collapse">
                <li><a href="#">Users</a></li>
                <li><a href="#">Accounts</a></li>
                <li><a href="#">Profiles</a></li>
            </ul>
        </li>
    </ul>
</div>
