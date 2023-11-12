<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>@yield('title')</title>

    <link rel="stylesheet" href="{{asset('toastr/toastr.css')}}">

    <link rel="stylesheet" href="{{asset('css/adminlte.min.css')}}">

    <link rel="stylesheet" href="{{asset('css/custom.css')}}">

    <link rel="stylesheet" href="{{asset('front/vendor/animate/animate.css')}}">

    <link rel="stylesheet" href="{{asset('front/css/bootstrap.css')}}">

    <link rel="stylesheet" href="{{asset('front/css/maicons.css')}}">

    <link rel="stylesheet" href="{{asset('front/vendor/owl-carousel/css/owl.carousel.css')}}">

    <link rel="stylesheet" href="{{asset('front/css/theme.css')}}">

    <link rel="shortcut icon" href="{{asset('uploads/'.get_settings('app_favicon'))}}" type="image/x-icon">
    @yield('extra-css')
</head>
<body>

<!-- Back to top button -->
<div class="back-to-top"></div>

<header>
    <nav class="navbar navbar-expand-lg navbar-light navbar-float">
        <div class="container">
            <a href="{{route('front.index')}}" class="navbar-brand">
                <img class="layout-logo" src="{{asset('uploads/'.get_settings('app_logo'))}}" alt="">
            </a>

            <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarContent" aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="navbar-collapse collapse" id="navbarContent">
                <ul class="navbar-nav ml-lg-4 pt-3 pt-lg-0">
                    <li class="nav-item {{isSidebarActive('front.index*')}}">
                        <a href="{{route('front.index')}}" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item {{isSidebarActive('front.about*')}}">
                        <a href="{{route('front.about')}}" class="nav-link">About</a>
                    </li>
                    <li class="nav-item {{isSidebarActive('front.features*')}}">
                        <a href="{{route('front.features')}}" class="nav-link">Features</a>
                    </li>
                    <li class="nav-item {{isSidebarActive('front.contact*')}}">
                        <a href="{{route('front.contact')}}" class="nav-link">Contact</a>
                    </li>
                    @foreach(get_pages('header') as $key => $page)
                        <li class="nav-item">
                            <a class="nav-link" href="{{url($page->url)}}">{{$page->name}}</a>
                        </li>
                    @endforeach
                </ul>

                <div class="ml-auto">
                    <a href="{{route('login')}}" class="btn btn-outline rounded-pill">Get Started</a>
                </div>
            </div>
        </div>
    </nav>
</header>
@yield('content')

@php $template = json_decode(get_settings('template')); @endphp
<footer class="page-footer">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-4 py-3">
                <a href="{{route('front.index')}}" class="navbar-brand">
                    <img class="layout-logo" src="{{asset('uploads/'.get_settings('app_logo'))}}" alt="">
                </a>
                <p>{{isset($template->sec_thr_description)?$template->sec_thr_description:''}}</p>

                <p><a href="#" >{{isset($template->email)?$template->email:''}}</a></p>
                <p><a href="#">{{isset($template->phone_number)?$template->phone_number:''}}</a></p>
            </div>
            <div class="col-lg-4 py-3">
                <h5>Quick Links</h5>
                <ul class="footer-menu">
                    @foreach(get_pages('footer') as $page)
                        <li><a href="{{url($page->url)}}">{{$page->name}}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="col-lg-4 py-3">
                <h5>Subscribe</h5>
                <form action="{{route('front.subscribe.store')}}" method="post">
                    @csrf
                    <input type="hidden" name="subscribe" value="yes">
                    <div class="row">
                        <div class="col-lg-8">
                            <input type="email" name="email" class="form-control" placeholder="Enter your mail.." autocomplete="off">
                        </div>
                        <div class="col-lg-4">
                            <button type="submit" class="btn btn-primary custom-btn">Subscribe</button>
                        </div>
                    </div>
                </form>

                <div class="sosmed-button mt-4">
                    @if(get_settings('facebook_link'))
                        <a href="{{get_settings('facebook_link')}}"><span class="mai-logo-facebook-f"></span></a>
                    @endif
                    @if(get_settings('twitter_link'))
                        <a href="{{get_settings('twitter_link')}}"><span class="mai-logo-twitter"></span></a>
                    @endif
                    @if(get_settings('google_link'))
                        <a href="{{get_settings('google_link')}}"><span class="mai-logo-google"></span></a>
                    @endif
                    @if(get_settings('linkedin_link'))
                        <a href="{{get_settings('linkedin_link')}}" class="media-a"><span class="mai-logo-linkedin"></span></a>
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12 text-center">
                <p id="copyright">&copy; 2022 <a href=""{{route('front.index')}}">{{get_settings('app_name')}}</a>. All rights reserved</p>
            </div>
        </div>
    </div> <!-- .container -->
</footer> <!-- .page-footer -->


<script src="{{asset('front/js/jquery-3.5.1.min.js')}}"></script>

<script src="{{asset('front/js/bootstrap.bundle.min.js')}}"></script>

<script src="{{asset('front/vendor/wow/wow.min.js')}}"></script>

<script src="{{asset('front/vendor/owl-carousel/js/owl.carousel.min.js')}}"></script>

<script src="{{asset('front/vendor/waypoints/jquery.waypoints.min.js')}}"></script>

<script src="{{asset('front/vendor/animateNumber/jquery.animateNumber.min.js')}}"></script>

<script src="{{asset('front/js/google-maps.js')}}"></script>

<script src="{{asset('front/js/theme.js')}}"></script>

<script src="{{asset('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>

<script src="{{asset('js/adminlte.min.js')}}"></script>

<script src="{{asset('js/custom.js')}}"></script>

@if(session()->has('success') || session()->has('fail') || count($errors)>0)
    <x-alert :type="session()->get('success')?'success':'danger'" :is-errors="$errors"
             :message="session()->get('success')??session()->get('fail')"/>
@endif
@yield('extra-scripts')

</body>
</html>
