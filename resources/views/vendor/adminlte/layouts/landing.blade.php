<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>MiShift - Manage Share &amp; Communicate</title>
    <meta name="description" content="">
    <meta name="author" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1">
    <link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
    <link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
    <link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
    <link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
    <link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
    <link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
    <link rel="icon" type="image/png" sizes="192x192" href="/android-icon-192x192.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
    <link rel="manifest" href="/manifest.json">
    <meta name="msapplication-TileColor" content="#ffffff">
    <meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
    <meta name="theme-color" content="#ffffff">
    <link href="css/assets.min.css" rel="stylesheet">
    <link href="css/style.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700%7CVarela+Round" rel="stylesheet">
</head>
<body>
<div class="preloader-container">
    <div class="loader"></div>
</div>
<header class="scrolled">
    <div class="container">
        <div class="row"><a href="/" class="logo"><img src="img/mishift_logo.png" alt="Orbit" class="top-logo">
            </a><a href="#" class="menutoggle">
                <div class="bar"></div>
            </a>
            <ul class="menu">
                <li class="top-bar-wrap"><a href="/" class="close-icon-wrap">
                        <div class="close-icon"></div>
                    </a></li>
                <li class="active"><a href="/">Home</a>
                </li>

                <li><a href="#">About Us</a>

                </li>
                <li><a href="{{url('contact_us')}}">Contact Us</a>
                </li>
                <li>
                    <a href="{{url('login')}}"
                      >Sign in</a></li>
            </ul>
        </div>
    </div>
</header>
<div class="container">
    <div class="row" style="margin-top: 6em;">
        <center><h2  class="section-title">Welcome to MiShift</h2></center>
    </div>
    <div class="row" >
        <div class="col-sm-4 col-md-4 text-section">
            <div class="typed-strings" style="display: none"><p>Share!</p>
                <p>Communicate!</p>
                <p>Manage!</p></div>
            <h4 class="hero-header">Best application<br>for you to <span class="typed">site!</span></h4>
            <p class="hero-text">Create an account for your organisation!</p>
            <div class="button-block">
                <button class="rocket-btn" data-toggle="modal" data-target="#packages_modal">Sign up now
                </button>
            </div>
        </div>

        <div class="col-sm-4 col-md-4 text-section">
            <h4 class="hero-header">Orbit features</h4>
            <li>Managers can create weekly employee schedules/shifts and associated tasks</li>
            <li>Employees can swap shifts, offer shifts and submit leave requests</li>
            <li>Team chat and direct messaging</li>
            <li>Upload and view training material for employees</li>
            <a  href="#">Read more</a>
        </div>
        <div class="col-sm-4 col-md-4 text-section " >
            <h4 class="hero-header">Mobile Apps</h4>
            <p class="hero-text">Increasing employee engagement is easy when you give your staff access to their work schedules - anytime, anywhere. Download application today.</p>
            <div class="button-block"><a
                        href="#"
                        class="rocket-btn rocket-btn-animated-icon rocket-btn-fixed-width" target="_blank"><span
                            class="rocket-btn-icon-wrap"><i class="fa fa-rocket" aria-hidden="true"></i></span>
                    <span class="rocket-btn-text-wrap">Download Now</span></a></div>
        </div>

    </div>


</div>
{{--<main>--}}
    {{--<section class="light-section pricing-section animated-section">--}}
        <div class="container" style="margin-top:2em;">
            <div class="row">
                <div class="section-header">
                    <center>
                    <p class="section-subtitle">If you are a company choose any one of our Packages that suits your team size and complete the
                        registration.</p></center>
                    <hr>
                </div>
            </div>
            <div id="packages" class="row">
               @foreach($packages as $package)
                <div class="col-sm-12 col-md-4">
                    <div class="pricing" data-anim-queue="2" data-anim-type="fadeInUp">
                        <div class="plan-title"><span class="plan">{{$package->package_name}}</span></div>
                        <div class="price"><span class="currency">R </span> <span class="amount">{{$package->package_prices}}</span> <span
                                    class="period">/mo</span></div>
                        <div class="pricing-content">
                            <ul class="collection">
                                <li class="collection-item"><b>Team Size: </b>{{$package->number_of_members}}</li>
                                <li class="collection-item"><b>Discount: </b>{{$package->discount}}</li>
                                <li class="collection-item">{{$package->package_description}}</li>
                            </ul>
                        </div>
                        <div class="plan-signup-btn"><a href="{{url('register')}}"
                                                        class="rocket-btn rocket-btn-fixed-width rocket-btn-animated-icon" onclick="passToReg('{{$package->id}}')" id="{{$package->package_name}}"><span
                                        class="rocket-btn-icon-wrap"><i class="fa fa-sign-in"
                                                                        aria-hidden="true"></i></span> <span
                                        class="rocket-btn-text-wrap">Sign Up</span></a></div>
                    </div>
                </div>
                   @endforeach
            </div>

        </div>
<div id="packages_modal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Please select the package you want to register for.</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                @foreach($packages as $package)
                    <div class="col-sm-12 col-md-4">
                        <div class="pricing" data-anim-queue="2" data-anim-type="fadeInUp">
                            <div class="plan-title"><span class="plan">{{$package->package_name}}</span></div>
                            <div class="price"><span class="currency">R </span> <span class="amount">{{$package->package_prices}}</span> <span
                                        class="period">/mo</span></div>
                            <div class="pricing-content">
                                <ul class="collection">
                                    <li class="collection-item"><b>Team Size: </b>{{$package->number_of_members}}</li>
                                    <li class="collection-item"><b>Discount: </b>{{$package->discount}}</li>

                                </ul>
                            </div>
                            <div class="plan-signup-btn"><a href="{{url('register')}}"
                                                            class="rocket-btn rocket-btn-fixed-width rocket-btn-animated-icon" onclick="passToReg('{{$package->id}}')" id="{{$package->package_name}}"><span
                                            class="rocket-btn-icon-wrap"><i class="fa fa-sign-in"
                                                                            aria-hidden="true"></i></span> <span
                                            class="rocket-btn-text-wrap">Sign Up</span></a></div>
                        </div>
                    </div>
                @endforeach
                </div>
            </div>
            <div class="modal-footer">
                {{--<button type="button" class="rocket-btn" data-dismiss="modal">Close</button>--}}
            </div>
        </div>
    </div>
</div>
    {{--</section>--}}
{{--</main>--}}
<footer>
    <div class="footer-wrapper">
        <div class="main-footer">
            <div class="container">
                <div class="row text-align-center">
                    <ul class="inline-list center-align">
                        <li><a class="social-icon" href="#"><i class="fa fa-facebook"></i></a></li>
                        <li><a class="social-icon" href="#"><i class="fa fa-twitter"></i></a></li>
                        <li><a class="social-icon" href="#"><i class="fa fa-paper-plane"></i></a></li>
                        <li><a class="social-icon" href="#"><i class="fa fa-instagram"></i></a></li>
                        <li><a class="social-icon" href="#"><i class="fa fa-globe"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="bottom-bar">
            <div class="container">
                <div class="row text-align-center">© Copyright 2018 - <a href="https://getmishift.co.za/"
                                                                         target="_blank">MiShift</a>.
                    All Rights Reserved.
                </div>
            </div>
        </div>
    </div>
</footer>
<div id="scrollToTop" class="scrollToTop">
    <div class="scrollToTop-circle">
        <div class="scrollToTop-icon"></div>
    </div>
</div>
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script src="js/assets.min.js"></script>
<script src="js/main.min.js"></script>
<script>
    function passToReg(package_id){
        if (typeof(Storage) !== "undefined") {
            // Code for localStorage/sessionStorage.
            sessionStorage.setItem("package_id",package_id);

        } else {
            // Sorry! No Web Storage support..
            alert("You are using an outdated browser!!");
        }
    }

</script>
</body>
<!-- Mirrored from neonunicorns.com/html/rocket/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 01 Mar 2018 15:46:34 GMT -->
</html>
