<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{route('MICT-dash1')}}" class="brand-link">
        <img src="../../img/MCU.png"
             alt="MCU Logo"
             class="brand-image img-circle elevation-3"
             style="opacity: .8">
        <span class="brand-text font-weight-light">Ticketing System</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="../../img/user.png" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a class="d-block">{{Auth::user()->fname}}</a>
            </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-flat nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                <li class="nav-header">
                    MICT
                </li>
                {{--                {{ Request::routeIs('MICT-dash1') || Request::rousteIs('MICT-dash2') ? 'active' : '' }}--}}
                <li class="nav-item">
                    <a href="{{route('MICT-dash1')}}"
                       class="nav-link {{ Request::routeIs('MICT-dash1') ||  Request::routeIs('MICT-dash2') ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('MICT-Tickets.create')}}"
                       class="nav-link {{ Request::routeIs('MICT-Tickets.create') ? 'active' : '' }}">
                        <i class="nav-icon fal fa-plus-circle"></i>
                        <p>
                            Create Ticket
                        </p>
                    </a>
                </li>

                @if(Auth::user()->department == "Administrator" || Auth::user()->department == "MICT")
                    <li class="nav-item has-treeview {{ Request::routeIs('my.sort') || Request::routeIs('MICT-Tickets.index') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon fal fa-ticket-alt"></i>
                            <p>
                                Tickets
                                <i class="right fas fa-angle-left"></i>
                                <span class="right">
                                    @widget('my_ticket_counter')
                                    @widget('is_new_counter')
                                </span>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('MICT-Tickets.index')}}"
                                   class="nav-link {{ Request::routeIs('MICT-Tickets.index') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>All Tickets</p>
                                    <span class="right">@widget('is_new_counter')</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('my.sort')}}"
                                   class="nav-link {{ Request::routeIs('my.sort') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>My Tickets</p>
                                    <span class="right"> @widget('my_ticket_counter')</span>
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="nav-item has-treeview {{ Request::routeIs('census') || Request::routeIs('received.calls') ? 'menu-open' : '' }}">
                        <a href="#" class="nav-link">
                            <i class="nav-icon far fa-file-invoice"></i>
                            <p>
                                Reports
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <li class="nav-item">
                                <a href="{{route('received.calls')}}"
                                   class="nav-link {{ Request::routeIs('received.calls') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Department received calls</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{route('census')}}"
                                   class="nav-link {{ Request::routeIs('census') ? 'active' : '' }}">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>Cencus of tickets</p>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link">
                                    <i class="far fa-circle nav-icon"></i>
                                    <p>List of pending tickets</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="/MICT-Tickets" class="nav-link">
                            <i class="nav-icon fad fa-list-alt"></i>
                            <p>
                                My Ticket
                            </p>
                        </a>
                    </li>
                @endif

                <li class="nav-header">
                    ENGINEERING
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            Dashboard
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('Engineering-Tickets.create')}}" class="nav-link {{ Request::routeIs('Engineering-Tickets.create') ? 'active' : '' }}">
                        <i class="nav-icon fal fa-plus-circle"></i>
                        <p>
                            Create Ticket
                        </p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fal fa-ticket-alt"></i>
                        <p>
                            Tickets
                            <i class="right fas fa-angle-left"></i>
                            <span class="right">
                                    @widget('my_ticket_counter')
                                    @widget('is_new_counter')
                                </span>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('MICT-Tickets.index')}}" class="nav-link ">
                                <i class="far fa-circle nav-icon"></i>
                                <p>All Tickets</p>
                                <span class="right">@widget('is_new_counter')</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('my.sort')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>My Tickets</p>
                                <span class="right"> @widget('my_ticket_counter')</span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-header">
                    ENDORSEMENTS
                </li>
                <li class="nav-item">
                    <a href="{{route('Endorsement.create')}}"
                       class="nav-link {{ Request::routeIs('Endorsement.create') ? 'active' : '' }}">
                        <i class="nav-icon fal fa-file-plus"></i>
                        <p>
                            Create Endorsement
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('Endorsement.index')}}"
                       class="nav-link {{ Request::routeIs('Endorsement.index') ? 'active' : '' }}">
                        <i class="nav-icon far fa-building"></i>
                        <p>
                            Endorsements
                        </p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('Endorsement.sent')}}"
                       class="nav-link {{ Request::routeIs('Endorsement.sent') ? 'active' : '' }}">
                        <i class="nav-icon far fa-building"></i>
                        <p>
                            Sent Endorsements
                        </p>
                    </a>
                </li>

                <li class="nav-header">
                    SETTINGS
                </li>
                @if(Auth::user()->department == 'MICT' || Auth::user()->department == 'Administrator' )
                    <li class="nav-item">
                        <a href="{{route('users.index')}}"
                           class="nav-link {{ Request::routeIs('users.index') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-users"></i>
                            <p>
                                Users
                            </p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('departments.index')}}"
                           class="nav-link  {{ Request::routeIs('departments.index') ? 'active' : '' }}">
                            <i class="nav-icon far fa-building"></i>
                            <p>
                                Departments
                            </p>
                        </a>
                    </li>
                @endif
                <li class="nav-item" id="logout" style="cursor: pointer">
                    {{--                    <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault();--}}
                    {{--                                                 document.getElementById('logout-form').submit();">--}}
{{--                    <div id="logout"></div>--}}
                    <a class="nav-link"  @click.prevent="swalLogout">
                            <i class="nav-icon fas fa-power-off"></i>
                            <p>Logout</p>

                        </a>
                    {{--                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">--}}
                    {{--                        @csrf--}}
                    {{--                    </form>--}}
                </li>
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
