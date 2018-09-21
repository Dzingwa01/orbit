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

    <link href="getmishift.co.za/css/assets.min.css" rel="stylesheet">
    <link href="getmishift.co.za/css/style.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700%7CVarela+Round" rel="stylesheet">
</head>
<body>
<div class="preloader-container">
    <div class="loader"></div>
</div>
<header class="scrolled">
    <div class="container">
        <div class="row"><a href="/" class="logo"><img src="http://getmishift.co.za/img/mishift_logo.png" alt="Orbit" class="top-logo">
            </a><a href="#" class="menutoggle">
                <div class="bar"></div>
            </a>
            <ul class="menu">
                <li class="top-bar-wrap"><a href="/" class="close-icon-wrap">
                        <div class="close-icon"></div>
                    </a></li>
                <li class="active"><a href="/">Home</a>
                </li>
                <li><a href="#">Packages and Pricing</a>
                    <ul class="dropdown">
                        <li><a href="#">One column</a>
                            <ul class="dropdown">
                                <li><a href="blog-one-column-right-sidebar.html">Right sidebar</a></li>
                                <li><a href="blog-one-column-left-sidebar.html">Left sidebar</a></li>
                                <li><a href="blog-one-column-no-sidebar.html">No sidebar</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Two columns</a>
                            <ul class="dropdown">
                                <li><a href="blog-two-columns-right-sidebar.html">Right sidebar</a></li>
                                <li><a href="blog-two-columns-left-sidebar.html">Left sidebar</a></li>
                                <li><a href="blog-two-columns-no-sidebar.html">No sidebar</a></li>
                            </ul>
                        </li>
                        <li><a href="#">Single post</a>
                            <ul class="dropdown">
                                <li><a href="blog-single-post-right-sidebar.html">Right sidebar</a></li>
                                <li><a href="blog-single-post-left-sidebar.html">Left sidebar</a></li>
                                <li><a href="blog-single-post-no-sidebar.html">No sidebar</a></li>
                            </ul>
                        </li>
                    </ul>
                </li>
                <li><a href="#">About Us</a>

                </li>
                <li><a href="#">Contact Us</a>
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
        <div class="panel-heading"><h3>Registration Confirmed</h3></div>
        <div class="panel-body">
            <br/> Your Email is successfully verified. Please proceed and sign in to the <b>Orbit</b>. Click here to <a href="{{url('/login')}}"> Sign in</a>
            <br/>
            Kind regards,<br/>
            Orbit Team
        </div>
    </div>

</div>

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
                <div class="row text-align-center">© Copyright 2018 - <a href="https://orbit.co.za/"
                                                                         target="_blank">Orbit</a>.
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
<script src="http://18.220.238.181/js/assets.min.js"></script>
<script src="http://18.220.238.181/js/main.min.js"></script>
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
