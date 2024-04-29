<div class="sidebar">
    <nav class="sidebar-nav">

        <ul class="nav">
            @can('appointment_access')
            <li class="nav-item">
                <a href="{{ route("admin.appointments.index") }}" class="nav-link {{ request()->is('admin/bookings') || request()->is('admin/bookings/*') ? 'active' : '' }}">
                    <i class="fa fa-calendar-plus-o nav-icon" aria-hidden="true"></i>
                   Bookings
                </a>
            </li>
        @endcan
        <li class="nav-item">
            <a href="{{ route("admin.systemCalendar") }}" class="nav-link {{ request()->is('admin/system-calendar') || request()->is('admin/system-calendar/*') ? 'active' : '' }}">
                <i class="nav-icon fa-fw fas fa-calendar">

                </i>
                {{ trans('global.systemCalendar') }}
            </a>
        </li>
           
                       
                      
                       
                 
            @can('service_access')
                <li class="nav-item">
                    <a href="{{ route("admin.services.index") }}" class="nav-link {{ request()->is('admin/services') || request()->is('admin/services/*') ? 'active' : '' }}">
                        <i class="fa fa-road nav-icon" aria-hidden="true"></i>
                       Road Closure
                    </a>
                </li>
            @endcan
            
            @can('client_access')
                <li class="nav-item">
                    <a href="{{ route("admin.clients.index") }}" class="nav-link {{ request()->is('admin/clients') || request()->is('admin/clients/*') ? 'active' : '' }}">
                        <i class="fa fa-map-marker nav-icon" aria-hidden="true"></i>
                        Venues
                    </a>
                </li>
            @endcan
            @can('user_access')
            <li class="nav-item">
                <a href="{{ route("admin.users.index") }}" class="nav-link {{ request()->is('admin/users') || request()->is('admin/users/*') ? 'active' : '' }}">
                    <i class="fa-fw fas fa-user nav-icon">

                    </i>
                    {{ trans('cruds.user.title') }}
                </a>
            </li>
        @endcan
            
            <li class="nav-item">
                <a href="#" class="nav-link" onclick="event.preventDefault(); document.getElementById('logoutform').submit();">
                    <i class="nav-icon fas fa-fw fa-sign-out-alt">

                    </i>
                    {{ trans('global.logout') }}
                </a>
            </li>
        </ul>

    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>