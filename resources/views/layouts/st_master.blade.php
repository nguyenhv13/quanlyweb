<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>{{ $title }} </title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ URL::to('assets/images/logo.png') }}">
    <!-- Datatable -->
    <link href="{{ URL::to('assets/vendor/datatables/css/jquery.dataTables.min.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="{{ URL::to('assets/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="{{ URL::to('assets/css/style.css') }}">
	<link rel="stylesheet" href="{{ URL::to('assets/css/skin.css') }}">
    <!-- Pick date -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.0/themes/base/jquery-ui.css">
    {{-- message toastr --}}
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    <script src="{{ URL::to('/ckeditor/ckeditor.js') }}"></script>
    <livewire:styles />
</head>
<body>
    <!-- Preloader start -->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!-- Preloader end -->
    <!-- Main wrapper start -->
    <div id="main-wrapper">
        <!-- Nav header start -->
        <div class="nav-header">
            <a href="{{ route('home') }}" class="brand-logo">
                <img class="logo-abbr" src="{{ URL::to('assets/images/logo-white-2.png') }}" alt="">
            </a>
            <div class="nav-control">
                <div class="hamburger">
                    <span class="line"></span><span class="line"></span><span class="line"></span>
                </div>
            </div>
        </div>
        <!-- Nav header end -->

        <!-- Header start -->
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                            <div class="search_bar dropdown">

                            </div>
                        </div>

                        <ul class="navbar-nav header-right">
                            <li class="nav-item dropdown notification_dropdown">
                                <a class="nav-link bell ai-icon" href="#" role="button" data-toggle="dropdown">
                                    <svg id="icon-user" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewbox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-bell">
										<path d="M18 8A6 6 0 0 0 6 8c0 7-3 9-3 9h18s-3-2-3-9"></path>
										<path d="M13.73 21a2 2 0 0 1-3.46 0"></path>
									</svg>
                                    @if (Auth::user()->unreadNotifications->count())
                                    <span class="badge badge-danger">
                                        {{ Auth::user()->unreadNotifications->count() }}
                                    </span>
                                    @endif
                                </a>
                                   {{-- <span class="notify-time">3:20 am</span> --}}
                                <div class="dropdown-menu dropdown-menu-right">
                                    <ul class="list-unstyled">
                                        @if (Auth::user()->unreadNotifications->count())
                                        @foreach (Auth::user()->unreadNotifications as $notification)
                                        <li class="media dropdown-item">
                                            <div class="media-body">
                                                <a href="{{ route('boarding.readNotice') }}">
                                                    <p><strong>
                                                       {{ $notification->data['title'] }}
                                                       </strong>
                                                    </p>
                                                    <small class="text-danger"> {{ $notification->created_at }}</small>
                                                </a>
                                            </div>
                                        </li>
                                        @endforeach
                                        @else
                                        <li class="media dropdown-item">
                                           Không có thông báo
                                        </li>
                                        @endif
                                    </ul>
                                    <a class="all-notification" href="{{ route('boarding.readNotice') }}">
                                        Xem tất cả thông báo <i class="ti-arrow-right"></i></a>
                                </div>
                            </li>

                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="#" role="button" data-toggle="dropdown">
                                    <img class="img-fluid rounded-circle"
                                     width="35" src="{{ URL::to('/images/'. Auth::user()->avatar) }}"
                                      alt="{{ Auth::user()->avatar }}">
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                     <a href="app-profile.html" class="dropdown-item ai-icon">
                                        <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg"
                                        width="18" height="18" viewbox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path><circle cx="12" cy="7" r="4"></circle></svg>
                                        <span class="ml-2">Profile </span>
                                    </a>

                                    <a href="{{ route('logout') }}" class="dropdown-item ai-icon">
                                        <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg"
                                        width="18" height="18" viewbox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round" class="feather feather-log-out">
                                        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                        <polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                                        <span class="ml-2">Đăng xuất </span>
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!-- Header end ti-comment-alt -->


        @yield('content')
        <livewire:scripts />
    </div>

    <!-- Required vendors -->
    <script src="{{ URL::to('assets/vendor/global/global.min.js') }}"></script>
	<script src="{{ URL::to('assets/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>
	<script src="{{ URL::to('assets/js/custom.min.js') }}"></script>
    <!-- Chart Morris plugin files -->
     <script src="{{ URL::to('assets/vendor/raphael/raphael.min.js') }}"></script>
    <script src="{{ URL::to('assets/vendor/morris/morris.min.js') }}"></script>
	<!-- Chart piety plugin files -->
    <script src="{{ URL::to('assets/vendor/peity/jquery.peity.min.js') }}"></script>
	<!-- Demo scripts -->
     <script src="{{ URL::to('assets/js/dashboard/dashboard-2.js') }}"></script>
    <!-- Datatable -->
    <script src="{{ URL::to('assets/vendor/datatables/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ URL::to('assets/js/plugins-init/datatables.init.js') }}"></script>
	<!-- Svganimation scripts -->
    <script src="{{ URL::to('assets/vendor/svganimation/vivus.min.js') }}"></script>
    <script src="{{ URL::to('assets/vendor/svganimation/svg.animation.js') }}"></script>
    {{-- <script src="{{ URL::to('assets/js/styleSwitcher.js') }}"></script> --}}
    <!-- pickdate -->
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
    <script>
        $( function() {
            $( ".datepicker" ).datepicker({
                dateFormat:"yy-mm-dd",
                changeMonth: true,
                changeYear: true,
            });
        });
    </script>
    <script>
        window.livewire.on('alert',param => {
           toastr[param['type']](param['message'],param['type']);
        });
    </script>
</body>
</html>
