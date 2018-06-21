<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Orbit - Manage Share &amp; Communicate</title>
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
        <div class="row"><a href="/" class="logo"><img src="img/orbit_logo_new.png" alt="Orbit" class="top-logo">
            </a><a href="#" class="menutoggle">
                <div class="bar"></div>
            </a>
            <ul class="menu">
                <li class="top-bar-wrap"><a href="/" class="close-icon-wrap">
                        <div class="close-icon"></div>
                    </a></li>
                <li ><a href="/">Home</a>
                </li>

                <li><a href="#">About Us</a>

                </li>
                <li class="active"><a href="#">Contact Us</a>
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
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
<!--                <div class="panel-heading"><header class="center"><h4>Contact Us</h4></header></div>-->
                <h4 style="margin-left:10em;">Send us an email</h4>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="">
                        <input value={{ csrf_field() }} hidden>
                        <div class="form-group">

                            <label for="item_number" class="col-md-4 control-label">Full Name</label>
                            <div class="col-md-6">
                                <input id="full_name" type="text" class="form-control" name="full_name" value="" placeholder="Enter full name" required autofocus>

                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-md-4 control-label">Cellphone Number</label>
                            <div class="col-md-6">
                                <input id="cell_number" type="tel" class="form-control" name="cell_number" value="" placeholder="Cellphone Number" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="item_description" class="col-md-4 control-label">Message</label>
                            <div class="col-md-6">
                                <textarea id="message" name="message" class="form-control materialize-textarea" value="" required rows="4" col="5" placeholder="Enter your message here"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="rocket-btn">
                                    Send
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
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
<script src="js/assets.min.js"></script>
<script src="js/main.min.js"></script>

</body>
</html>
