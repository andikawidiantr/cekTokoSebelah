<!doctype html>
<html lang="en">

<head>
    <title>Dashboard | Pratikum Pemrogram Internet</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <!-- VENDOR CSS -->
    <link rel="stylesheet" href="{{asset('style/assets/vendor/bootstrap/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('style/assets/vendor/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('style/assets/vendor/linearicons/style.css')}}">
    <link rel="stylesheet" href="{{asset('style/assets/vendor/chartist/css/chartist-custom.css')}}">
    <!-- MAIN CSS -->
    <link rel="stylesheet" href="{{asset('style/assets/css/main.css')}}">
    <!-- FOR DEMO PURPOSES ONLY. You should remove this in your project -->
    <link rel="stylesheet" href="{{asset('style/assets/css/demo.css')}}">
    <!-- GOOGLE FONTS -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">
    <!-- ICONS -->
    <link rel="apple-touch-icon" sizes="76x76" href="{{asset('style/assets/img/gmbr.jpg')}}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{asset('style/assets/img/gmbr.jpg')}}">
    <!-- Css Select2-->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" /> 
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="{{asset('style/assets/vendor/bootstrap/js/bootstrap.min.js')}}"></script>
    @yield('head')
    <!-- scripts Select2-->


</head>

<body>
    <!-- WRAPPER -->
    <div id="wrapper">
        <!-- NAVBAR -->
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="brand">
                <a href="/"><img src="{{asset('style/assets/img/ser.jpg')}}" alt="Logo Toko"
                        class="img-responsive logo" width="100px" height="200px"></a>
            </div>
            <div class="container-fluid">
                <div class="navbar-btn">
                    <button type="button" class="btn-toggle-fullwidth"><i
                            class="lnr lnr-arrow-left-circle"></i></button>
                </div>
                <form class="navbar-form navbar-left">
                    <div class="input-group">
                        <input type="text" value="" class="form-control" placeholder="Search dashboard...">
                        <span class="input-group-btn"><button type="button" class="btn btn-primary">Go</button></span>
                    </div>
                </form>
                <!-- <div class="navbar-btn navbar-btn-right"> -->
                <!-- <a class="btn btn-success update-pro" href="https://www.themeineed.com/downloads/klorofil-pro-bootstrap-admin-dashboard-template/?utm_source=klorofil&utm_medium=template&utm_campaign=KlorofilPro" title="Upgrade to Pro" target="_blank"><i class="fa fa-rocket"></i> <span>UPGRADE TO PRO</span></a> -->
                <!-- </div> -->
                <div id="navbar-menu">
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle icon-menu" data-toggle="dropdown">
                                <i class="lnr lnr-alarm"></i>
                                @if ($notif->count() != 0)
                                <span class="badge bg-danger">
                                        
                                <!-- Counter - Alerts -->
                                @if ($notif->count() >= 5)
                                    {{ $notif->count() }}+
                                    
                                @else
                                    {{ $notif->count() }}
                                    
                                @endif
                            
                                
                                </span>
                                @endif
                                
                            </a>
                            <ul class="dropdown-menu notifications">
                            @foreach ($notif as $item)
                            @php
                                $data = json_decode($item->data);
                            @endphp
                                
                                <!-- <a class="dropdown-item d-flex align-items-center"  href="/admin/detail-transaksi/{{ $data->id }}/view" >
                                 -->
                                <!-- <div class="mr-3">
                                    <div class="icon-circle bg-primary">
                                        <i class="fas fa-file-alt text-white"></i>
                                    </div>
                                </div>
                                <div> -->
                                <li><a onclick="read('{{$item->id}}')" href="/admin/detail-transaksi/{{ $data->id }}" class="notification-item"><span class="dot bg-warning"></span>{{ $data->nama }} {{ $data->massage}}</a></li>
                                    <!-- <div class="small text-gray-500">{{ date("d F Y", strtotime($item->created_at)) }}</div>
                                    <li><a href="#" class="notification-item"><span class="dot bg-success"></span>{{ $data->nama }} {{ $data->massage}}</a></li> -->
                                    <!-- <span class="font-weight-bold">{{ $data->nama }} {{ $data->massage}}</span> -->
                                <!-- </div> -->
                            </a>
                            @endforeach

                            @if ($notif->count() != 0)
                            <li><a href="/admin/notifikasi" class="more">See all notifications</a></li>
                                
                            @endif
                                <!-- <li><a href="#" class="notification-item"><span class="dot bg-warning"></span>System
                                        space is almost full</a></li>
                                <li><a href="#" class="notification-item"><span class="dot bg-danger"></span>You have 9
                                        unfinished tasks</a></li>
                                <li><a href="#" class="notification-item"><span class="dot bg-success"></span>Monthly
                                        report is available</a></li>
                                <li><a href="#" class="notification-item"><span class="dot bg-warning"></span>Weekly
                                        meeting in 1 hour</a></li>
                                <li><a href="#" class="notification-item"><span class="dot bg-success"></span>Your
                                        request has been approved</a></li> -->

                            </ul>
                        </li>
                      
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><img
                                    src="{{asset('style/assets/img/user.png')}}" class="img-circle" alt="Avatar">
                                <span>Samuel</span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
                            <ul class="dropdown-menu">
                                <li><a href="#"><i class="lnr lnr-user"></i> <span>My Profile</span></a></li>
                                <li><a href="#"><i class="lnr lnr-envelope"></i> <span>Message</span></a></li>
                                <li><a href="#"><i class="lnr lnr-cog"></i> <span>Settings</span></a></li>
                                <li><a href="{{ route('admin.logout') }}"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
                                <!-- <li><a href="{{ route('admin.logout') }}"><i class="lnr lnr-exit"></i> <span>Logout</span> -->
                            </ul>
                        </li>
                        <!-- <li>
							<a class="update-pro" href="https://www.themeineed.com/downloads/klorofil-pro-bootstrap-admin-dashboard-template/?utm_source=klorofil&utm_medium=template&utm_campaign=KlorofilPro" title="Upgrade to Pro" target="_blank"><i class="fa fa-rocket"></i> <span>UPGRADE TO PRO</span></a>
						</li> -->
                    </ul>
                </div>
            </div>
        </nav>
        <!-- END NAVBAR -->
        <!-- LEFT SIDEBAR -->
        <div id="sidebar-nav" class="sidebar">
            <div class="sidebar-scroll">
                <nav>
                    <ul class="nav">
                        <li><a href="/admin" class="{{ request()->is('admin')?'active':''}}"><i class="lnr lnr-home"></i> <span>Dashboard</span></a>
                        </li>
                        <li><a href="/admin/product" class="{{ request()->is('product')?'active':''}}"><i class="fa fa-dropbox"></i> <span>Product</span></a></li>
                        <li><a href="/admin/category" class="{{ request()->is('category')?'active':''}}"><i class="fa fa-cubes"></i> <span>Product Category</span></a>
                        </li>
                        <li><a href="/admin/courier" class="{{ request()->is('courier')?'active':''}}"><i class="fa fa-truck"></i> <span>Courier</span></a></li>
                        <li><a href="/admin/discount" class="{{ request()->is('courier')?'active':''}}"><i class="fa fa-cut"></i> <span>Discount</span></a></li>
                        <li><a href="/admin/transaksi" class="{{ request()->is('courier')?'active':''}}"><i class="	fa fa-folder-open"></i> <span>Transaction</span></a></li>
                    </ul>
                </nav>
            </div>
        </div>
        <!-- END LEFT SIDEBAR -->
        <!-- MAIN -->
        <div class="main">
            <!-- MAIN CONTENT -->
            <div class="main-content">
                <main>
                    <div class="container-fluid">
                        @yield('header')
                        @yield('isi')
                    </div>
                </main>
                <!-- OVERVIEW -->

            </div>
        </div>
        <!-- END MAIN CONTENT -->
    </div>
    <!-- END MAIN -->
    <div class="clearfix"></div>
    <footer>
        <div class="container-fluid">
            <!-- <p class="copyright">Shared by <i class="fa fa-love"></i><a
                    href="https://bootstrapthemes.co">BootstrapThemes</a>
            </p> -->
        </div>
    </footer>
    </div>
    <!-- END WRAPPER -->
    <!-- Javascript -->
    <!-- <script src="{{asset('style/assets/vendor/jquery/jquery.min.js')}}"></script> -->
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="{{asset('style/assets/vendor/bootstrap/js/bootstrap.min.js')}}"></script> -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <!-- <script src="{{asset('style/assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
    <script src="{{asset('style/assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js')}}"></script>
    <script src="{{asset('style/assets/vendor/chartist/js/chartist.min.js')}}"></script>-->
    <script src="{{asset('style/assets/scripts/klorofil-common.js')}}"></script> 
    <script>
    
    function read(id) {
            $.ajax({
                url : '/admin/read-notif/'+id,
                method : 'GET',
                success : function (response) {
                    console.log(response);
                }
            });
        }
    
    </script>
    @yield('script')
    <script>

    </script>
</body>

</html>
