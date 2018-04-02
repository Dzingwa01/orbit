<aside id="leftsidebar" class="sidebar" style="margin-bottom: 3em;">
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
            {{--<li class="active open"> <a href="index.html"><i class="zmdi zmdi-home"></i><span>Dashboard</span></a></li>--}}
            {{--<li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-gamepad"></i><span>Schedule Management</span></a>--}}
                {{--<ul class="ml-menu">--}}
                    {{--<li><a href="#">Shifts</a></li>--}}
                    {{--<li><a href="#">Tasks</a></li>--}}
                {{--</ul>--}}
            {{--</li>--}}
            <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-apps"></i><span>Manage Teams</span></a>
                <ul class="ml-menu">
                    <li><a href="{{url('team')}}">Teams</a></li>
                    <li><a href="{{url('city')}}">Cities</a></li>
                    <li><a href="#">Swap Teams</a></li>
                </ul>
            </li>
            {{--<li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-swap-alt"></i><span>Communications</span></a>--}}
                {{--<ul class="ml-menu">--}}
                    {{--<li> <a href="#">Chat</a> </li>--}}
                    {{--<li> <a href="#">Announcements</a> </li>--}}
                    {{--<li> <a href="#">Share Files</a> </li>--}}
                {{--</ul>--}}
            {{--</li>--}}
            {{--<li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-widgets"></i><span>Manage Training</span></a>--}}
                {{--<ul class="ml-menu">--}}
                    {{--<li><a href="#">Training Material</a></li>--}}
                    {{--<li><a href="#">Onboarding Material</a></li>--}}
                {{--</ul>--}}
            {{--</li>--}}
            <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-widgets"></i><span>Manage Packages</span></a>
                <ul class="ml-menu">
                    <li><a href="{{url('package')}}">Packages</a></li>
                    <li><a href="#">Terms</a></li>
                </ul>
            </li>
            <li class="header">ACCESS MANAGEMENT</li>
            <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-assignment"></i><span>Users</span></a>
                <ul class="ml-menu">
                    <li><a href="{{url('user')}}">All Users</a> </li>
                    <li><a href="{{url('roles')}}">Roles</a> </li>
                    <li><a href="{{url('permissions')}}">Permissions</a> </li>

                </ul>
            </li>

        </ul>
    </div>
</aside>