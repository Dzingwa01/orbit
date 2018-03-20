<aside id="leftsidebar" class="sidebar theme-cyan" style="margin-bottom: 3em;">
    <div class="menu">
        <ul class="list">
            <li>
                <div class="user-info m-b-20">
                    <div class="image"><a><img src="/img/avatar.png" alt="User"></a></div>
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
            <li><a href="#"><i class="zmdi zmdi-time-countdown"></i><span>Current</span></a>
            <li><a href="#"><i class="zmdi zmdi-account-calendar"></i><span>Schedule</span></a>
            </li>
            <li><a href="#"><i class="zmdi zmdi-assignment"></i><span>Swap Teams</span></a></li>


        </ul>
    </div>
</aside>