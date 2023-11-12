<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Meta data -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="Berkine">
    <meta name="keywords" content="{{ config('app.name') }}">
    <meta name="description" content="{{ config('app.name') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="yctIHtxvcEySqIllXj1ydM2Voalqin63OzkxhQw0">

    <!-- Title -->
    <title>{{ config('app.name') }}</title>

    <!--CSS Files -->
    <link href="{{URL::asset('plugins/slick/slick.css')}}" rel="stylesheet">
    <link href="{{URL::asset('plugins/slick/slick-theme.css')}}" rel="stylesheet">

    <!--Favicon -->
    <link rel="icon" href="{{URL::asset('img/brand/favicon.ico')}}" type="image/x-icon" />

    <!-- Animate -->
    <link href="{{URL::asset('css/animated.css')}}" rel="stylesheet" />

    <!-- Bootstrap 5 -->
    <link href="{{URL::asset('plugins/bootstrap-5.0.2/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Icons -->
    <link href="{{URL::asset('css/icons.css')}}" rel="stylesheet" />

    <!-- P-scrollbar -->
    <link href="{{URL::asset('plugins/p-scrollbar/p-scrollbar.css')}}" rel="stylesheet" />

    <!-- Simplebar -->
    <link href="{{URL::asset('plugins/simplebar/css/simplebar.css')}}" rel="stylesheet">

    <!-- Tippy -->
    <link href="{{URL::asset('plugins/tippy/scale-extreme.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('plugins/tippy/material.css')}}" rel="stylesheet" />

    <!-- Toastr -->
    <link href="{{URL::asset('toastr/toastr.css')}}" rel="stylesheet" />

    <link href="{{URL::asset('plugins/awselect/awselect.min.css')}}" rel="stylesheet" />

    <link href="{{URL::asset('plugins/slick/slick.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('plugins/slick/slick-theme.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('plugins/aos/aos.css')}}" rel="stylesheet" />

    <!-- All Styles -->
    <link href="{{URL::asset('css/app.css')}}" rel="stylesheet" />

    <!--Custom User CSS File -->


    <!--Google AdSense-->



    <script type="text/javascript" class="flasher-js">
    (function() {
        var rootScript = 'https://cdn.jsdelivr.net/npm/@flasher/flasher@1.3.1/dist/flasher.min.js';
        var FLASHER_FLASH_BAG_PLACE_HOLDER = {};
        var options = mergeOptions([], FLASHER_FLASH_BAG_PLACE_HOLDER);

        function mergeOptions(first, second) {
            return {
                context: merge(first.context || {}, second.context || {}),
                envelopes: merge(first.envelopes || [], second.envelopes || []),
                options: merge(first.options || {}, second.options || {}),
                scripts: merge(first.scripts || [], second.scripts || []),
                styles: merge(first.styles || [], second.styles || []),
            };
        }

        function merge(first, second) {
            if (Array.isArray(first) && Array.isArray(second)) {
                return first.concat(second).filter(function(item, index, array) {
                    return array.indexOf(item) === index;
                });
            }
            return Object.assign({}, first, second);
        }

        function renderOptions(options) {
            if (!window.hasOwnProperty('flasher')) {
                console.error('Flasher is not loaded');
                return;
            }
            requestAnimationFrame(function() {
                window.flasher.render(options);
            });
        }

        function render(options) {
            if ('loading' !== document.readyState) {
                renderOptions(options);
                return;
            }
            document.addEventListener('DOMContentLoaded', function() {
                renderOptions(options);
            });
        }
        if (1 === document.querySelectorAll('script.flasher-js').length) {
            document.addEventListener('flasher:render', function(event) {
                render(event.detail);
            });
        }
        if (window.hasOwnProperty('flasher') || !rootScript || document.querySelector('script[src="' + rootScript + '"]')) {
            render(options);
        } else {
            var tag = document.createElement('script');
            tag.setAttribute('src', rootScript);
            tag.setAttribute('type', 'text/javascript');
            tag.onload = function() {
                render(options);
            };
            document.head.appendChild(tag);
        }
    })();
    </script>
</head>

<body class="app sidebar-mini frontend-body ">


<div class="page">
					<div class="page-main">

						<section id="main-wrapper">
					
							<div class="relative flex items-top justify-center min-h-screen">
				
								<div class="container-fluid fixed-top" id="navbar-container">
				
									<div class="container">
										<div class="row">
				
											<nav class="navbar navbar-expand-lg navbar-light w-100" id="navbar-responsive">
												<a class="navbar-brand" href="{{ url('/') }}"><img id="brand-img"  src="{{ URL::asset('img/brand/logo-white.png') }}" alt=""></a>
												<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
													<span class="navbar-toggler-icon"></span>
												</button>
												<div class="collapse navbar-collapse section-links" id="navbarNav">
													<ul class="navbar-nav">
														<li class="nav-item">
															<a class="nav-link scroll active" href="#main-wrapper">{{ __('Home') }} <span class="sr-only">(current)</span></a>
														</li>		
															<li class="nav-item">
																<a class="nav-link scroll" href="#prices-wrapper">{{ __('Prices') }}</a>
															</li>
															<li class="nav-item">
																<a class="nav-link scroll" href="#blog-wrapper">{{ __('Blogs') }}</a>
															</li>
															<li class="nav-item">
																<a class="nav-link scroll" href="#faq-wrapper">{{ __('FAQs') }}</a>
															</li>
															<li class="nav-item">
																<a class="nav-link scroll" href="#contact-wrapper">{{ __('Contact Us') }}</a>
															</li>
														
														<li class="nav-item text-center frontend-buttons">
															@if (Route::has('login'))
																<div>
																	@auth
																		<a href="" class="action-button dashboard-button pl-5 pr-5">{{ __('Dashboard') }}</a>
																	@else
																		<a href="{{ route('login') }}" class="btn btn-primary special-action-button" id="login-button">{{ __('Login') }}</a>
				
																		<a href="{{ route('signup') }}" class="ml-2 action-button register-button pl-5 pr-5">{{ __('Sign Up') }}</a>
																	@endauth
																</div>
															@endif
														</li>
													</ul>
												</div>
											</nav>
				
										</div>
									</div>
				
									@include('layouts.flash')
				
								</div>
				
							</div>  
						</section>

						<!-- App-Content -->			
						<div class="main-content">
							<div class="side-app">

								@yield('content')

							</div>                   
						</div>
				
				</div>


        <!-- FOOTER SECTION
				========================================================-->
        <footer id="welcome-footer">

            <!-- FOOTER MAIN CONTENT -->
            <div id="footer" class="container text-center">

                <div class="row">

                    <!-- FOOTER TITLE -->
                    <div class="col-md-4 col-sm-12" id="footer-logo">

                        <img src="{{URL::asset('img/brand/logo-white.png')}}" alt="Brand Logo">

                        <p class="mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quasi ut culpa maiores maxime illo nostrum aut totam, porro dolore minima</p>

                        <div class="dropdown header-locale" id="frontend-local">
                            <a class="nav-link icon" data-bs-toggle="dropdown">
                                <span class="fs-17 fa fa-globe pr-2"></span><span class="fs-12" style="vertical-align:middle">EN</span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow animated">
                                <div class="local-menu">
                                    <a href="{{URL::asset('locale/es')}}" class="dropdown-item d-flex">
                                        <div class="text-info"><i class="flag flag-es mr-3"></i></div>
                                        <div>
                                            <span class="font-weight-normal fs-12">Español</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>

                    </div> <!-- END FOOTER TITLE & SOCIAL ICONS -->


                    <!-- FOOTER LINKS -->
                    <div class="col-md-8 col-sm-12" id="footer-links">

                        <div class="row w-100">

                            <!-- INFORMATION LINKS -->
                            <div class="col-md-3 col-sm-12">

                                <h5>Information</h5>

                                <ul class="list-unstyled">
                                    <li><a href="#" target="_blank">AI World</a></li>
                                </ul>

                            </div> <!-- END INFORMATION LINKS -->


                            <!-- SOLUTIONS LINKS -->
                            <div class="col-md-3 col-sm-12">

                                <h5>Site Pages</h5>

                                <ul class="list-unstyled">
                                    <li><a href="{{ route('login') }}">Login</a></li>
                                    <li><a href="{{ route('signup') }}">Register</a></li>
                                </ul>

                            </div> <!-- END SOLUTIONS LINKS -->


                            <!-- COMPANY LINKS -->
                            <div class="col-md-3 col-sm-12">

                                <h5>Company</h5>

                                <ul class="list-unstyled">
                                    <li><a href="{{URL::asset('terms-and-conditions')}}">Terms &amp; Conditions</a></li>
                                    <li><a href="{{URL::asset('privacy-policy')}}">Privacy Policy</a></li>
                                </ul>

                            </div> <!-- COMPANY LINKS -->


                            <!-- CONNECTION & NEWS LINKS -->
                            <div class="col-md-3 col-sm-12 footer-connect pr-0">

                                <h5>Social Media</h5>

                                <h6>Follow up on social media to find out the latest updates.</h6>

                                <ul id="footer-icons" class="list-inline">
                                    <a href="https://linkedin.com/" target="_blank">
                                        <li class="list-inline-item"><i class="footer-icon fa-brands fa-linkedin"></i></li>
                                    </a>
                                    <a href="https://twitter.com/" target="_blank">
                                        <li class="list-inline-item"><i class="footer-icon fa-brands fa-twitter"></i></li>
                                    </a>
                                    <a href="https://instagram.com/" target="_blank">
                                        <li class="list-inline-item"><i class="footer-icon fa-brands fa-instagram"></i></li>
                                    </a>
                                    <a href="https://facebook.com/" target="_blank">
                                        <li class="list-inline-item"><i class="footer-icon fa-brands fa-facebook"></i></li>
                                    </a>


                                </ul>

                                <h5 class="mt-6 mb-4">Get Started Today</h5>

                                <a href="{{ route('signup') }}" class="btn btn-primary pl-5 pr-5">Sign Up Now</a>

                            </div> <!-- END CONNECTION & NEWS LINKS -->

                        </div>


                    </div> <!-- END FOOTER LINKS -->


                </div> <!-- END ROW -->

            </div> <!-- END CONTAINER-->



            <!-- COPYRIGHT INFORMATION -->
            <div id="copyright" class="container">

                <p class="copyright-left">Copyright © 2023 <a href="{{ config('app.url') }}">{{ config('app.name') }}</a> All rights reserved</p>

                <div>
                    <p class="copyright-right"><a href="{{URL::asset('terms-and-conditions')}}" target="_blank">Terms &amp; Conditions</a></p>
                    <p class="copyright-right"><a href="{{URL::asset('privacy-policy')}}" target="_blank">Privacy Policy</a><span>|</span></p>
                </div>

                <!-- SCROLL TO TOP -->
                <a href="#top" id="back-to-top"><i class="fa fa-angle-double-up"></i></a>

            </div>

        </footer> <!-- END FOOTER -->




        <!-- JQuery-->
        <script src="{{URL::asset('plugins/jquery/jquery-3.6.0.min.js')}}"></script>

        <!-- Bootstrap 5-->
        <script src="{{URL::asset('plugins/bootstrap-5.0.2/js/bootstrap.bundle.min.js')}}"></script>

        <!-- Tippy JS -->
        <script src="{{URL::asset('plugins/tippy/popper.min.js')}}"></script>
        <script src="{{URL::asset('plugins/tippy/tippy-bundle.umd.min.js')}}"></script>

        <script src="{{URL::asset('plugins/slick/slick.min.js')}}"></script>
        <script src="{{URL::asset('plugins/aos/aos.js')}}"></script>
        <script src="{{URL::asset('plugins/typed/typed.min.js')}}"></script>
        <script src="{{URL::asset('js/frontend.js')}}"></script>
        <script type="text/javascript">
        $(function() {

            var typed = new Typed('#typed', {
                strings: ['<h1><span>Article Generator</span></h1>',
                    '<h1><span>Content Improver</span></h1>',
                    '<h1><span>Blog Sections</span></h1>',
                    '<h1><span>Blog Ideas</span></h1>',
                    '<h1><span>SEO Meta Descriptions</span></h1>',
                    '<h1><span>FAQ Answers</span></h1>',
                    '<h1><span>And Many More!</span></h1>'
                ],
                typeSpeed: 40,
                backSpeed: 40,
                backDelay: 2000,
                loop: true,
                showCursor: false,
            });

            AOS.init();

        });
        </script>


        <!-- Custom-->
        <script src="{{URL::asset('js/custom.js')}}"></script>

        <script>
        tippy('[data-tippy-content]', {
            animation: 'scale-extreme',
            theme: 'material',
        });
        </script>

        <!-- Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-148887469-1"></script>
        <script type="text/javascript">
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-148887469-1');
        </script>

        <!-- Live Chat -->
        <script type="text/javascript">
        let link = "https://tawk.to/chat/647b32c37c7b15544f3ec73d/1h20jsjkt";
        let embed_link = link.replace('https://tawk.to/chat/', 'https://embed.tawk.to/');

        var Tawk_API = Tawk_API || {},
            Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"),
                s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = embed_link;
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
        </script>

        <!-- Custom User JS File -->


</body>

</html>