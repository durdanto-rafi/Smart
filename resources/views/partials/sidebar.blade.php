<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">MAIN OPTION</li>
            <li class="treeview {{ Request::is('company') ? 'active' : '' }}">
                <a href="{{ route('company.index') }}">
                    <i i class="fa fa-check-square-o"></i> <span>Company</span>
                    <span class="pull-right-container">
                </span>
                </a>
            </li>
            <li class="treeview {{ Request::is('subject') ? 'active' : '' }}">
                <a href="{{ route('subject.index') }}">
                    <i i class="fa fa-check-square-o"></i> <span>Subject</span>
                    <span class="pull-right-container">
                </span>
                </a>
            </li>
            <li class="treeview {{ Request::is('grade') ? 'active' : '' }}">
                <a href="{{ route('grade.index') }}">
                    <i i class="fa fa-check-square-o"></i> <span>Grade</span>
                    <span class="pull-right-container">
                </span>
                </a>
            </li>
            <li class="treeview {{ Request::is('contractPeriod') ? 'active' : '' }}">
                <a href="{{ route('contractPeriod.index') }}">
                    <i i class="fa fa-check-square-o"></i> <span>Contract Period</span>
                    <span class="pull-right-container">
                </span>
                </a>
            </li>
            <li class="treeview {{ Request::is('user') ? 'active' : '' }}">
                <a href="{{ route('user.index') }}">
                    <i i class="fa fa-check-square-o"></i> <span>User</span>
                    <span class="pull-right-container">
                </span>
                </a>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>