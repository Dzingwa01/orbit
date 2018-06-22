<aside id="leftsidebar" class="sidebar theme-light-dark" style="margin-bottom: 3em;">
    <div class="menu">
        <ul class="list">
            <li>
                <div class="user-info m-b-20">
                    <div class="image"><a href="profile.html"><img src="/img/avatar.png" alt="User"></a></div>
                    <div class="detail">
                        <h4>{{Auth::user()->name . ' '. Auth::user()->surname}}</h4>
                        <p class="m-b-0">{{App\Role::where('id',Auth::user()->role_id)->first()->name}}</p>
                        <p class="m-b-0">{{Auth::user()->company_name}}</p>
                        <a href="#" title="Events"><i class="zmdi zmdi-calendar"></i></a>
                        <a href="#" title="Inbox"><i class="zmdi zmdi-email"></i></a>
                        <a href="#" title="Contact List"><i class="zmdi zmdi-account-box-phone"></i></a>
                    </div>
                </div>
            </li>
            <li class="header">MAIN</li>
            <li> <a href="{{url('home')}}"><i class="zmdi zmdi-home"></i><span>Dashboard</span></a></li>
            <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-time-countdown"></i><span>Schedule Management</span></a>
                <ul class="ml-menu">
                    <li><a href="{{url('/home')}}">Calendar</a></li>
                    <li><a href="{{url('/shifts')}}">Shift List</a></li>
                    <li><a href="{{url('/tasks')}}">Tasks</a></li>
                </ul>
            </li>
            <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-apps"></i><span>Manage Teams</span></a>
                <ul class="ml-menu">
                    <li><a href="{{url('/manager_teams')}}">Teams</a></li>
                    {{--<li><a href="#">Swap Teams</a></li>--}}
                </ul>
            </li>
            <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-swap-alt"></i><span>Communications</span></a>
                <ul class="ml-menu">
                    <li> <a href="#">Chat</a> </li>
                    <li> <a href="#">Announcements</a> </li>
                </ul>
            </li>
            <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-widgets"></i><span>Manage Training</span></a>
                <ul class="ml-menu">
                    <li><a href="{{url('training_materials')}}">Training Material</a></li>
                    <li><a href="{{url('onboarding_materials')}}">Onboarding Material</a></li>
                </ul>
            </li>
            <li class="header">EMPLOYEE MANAGEMENT</li>
            <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-accounts"></i><span>Employees</span></a>
                <ul class="ml-menu">
                    <li><a href="{{url('/employees')}}">Employees</a> </li>
                    <li><a href="{{URL('/employee_roles')}}">Employee Roles</a> </li>
                </ul>
            </li>

        </ul>
    </div>
</aside>