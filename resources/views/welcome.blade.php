<!DOCTYPE html>
<html lang="en-US">
<head>
    <x-head></x-head>
</head>
<body id="top">
<!-- Navbar-->
<x-MainHeader/>
<!-- Intro Section-->
<section class="view hm-gradient" id="intro">
    <div class="site-bg-img d-flex align-items-center">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-md-10 col-lg-6 text-center text-md-left margins">
                    <div class="white-text">
                        <div class="wow fadeInLeft" data-wow-delay="0.3s">
                            <h1 class="h1-responsive font-weight-bold mt-sm-5">Your Success is Our Mission.</h1>
                        </div>
                        <br>
                        <div class="wow fadeInLeft" data-wow-delay="0.3s"><a
                                class="btn btn-white dark-grey-text font-weight-bold ml-0"
                                href="{{ route('login') }}">Login</a><a class="btn btn-outline-white"
                                                                        href="{{ route('register') }}">Register</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
</body>
</html>
