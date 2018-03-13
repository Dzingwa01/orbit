<aside id="leftsidebar" class="sidebar theme-cyan">
    <div class="menu">
        <ul class="list">
            <li>
                <div class="user-info m-b-20">
                    <div class="image"><a href="profile.html"><img src="/assets/images/profile_av.jpg" alt="User"></a></div>
                    <div class="detail">
                        <h4>{{Auth::user()->name}}</h4>
                        <p class="m-b-0">Manager</p>
                        <a href="events.html" title="Events"><i class="zmdi zmdi-calendar"></i></a>
                        <a href="mail-inbox.html" title="Inbox"><i class="zmdi zmdi-email"></i></a>
                        <a href="contact.html" title="Contact List"><i class="zmdi zmdi-account-box-phone"></i></a>
                    </div>
                </div>
            </li>
            <li class="header">MAIN</li>
            {{--<li class="active open"> <a href="index.html"><i class="zmdi zmdi-home"></i><span>Dashboard</span></a></li>--}}
            <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-gamepad"></i><span>Schedule Management</span></a>
                <ul class="ml-menu">
                    <li><a href="#">Shifts</a></li>
                    <li><a href="#">Tasks</a></li>
                </ul>
            </li>
            <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-apps"></i><span>Teams</span></a>
                <ul class="ml-menu">
                    <li><a href="{{url('team')}}">Team Management</a></li>
                    <li><a href="#">Swap Teams</a></li>
                </ul>
            </li>
            <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-swap-alt"></i><span>Communications</span></a>
                <ul class="ml-menu">
                    <li> <a href="#">Chat</a> </li>
                    <li> <a href="#">Announcements</a> </li>
                    <li> <a href="#">Share Files</a> </li>
                </ul>
            </li>
            <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-widgets"></i><span>Training</span></a>
                <ul class="ml-menu">
                    <li><a href="#">Training Material</a></li>
                    <li><a href="#">Onboarding Material</a></li>
                </ul>
            </li>
            <li><a href="javascript:void(0);" class="menu-toggle"><i class="zmdi zmdi-widgets"></i><span>Packages</span></a>
                <ul class="ml-menu">
                    <li><a href="{{url('package')}}">Package Management</a></li>
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