<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Cek Toko Sebelah</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="{{asset('template_user/vendor/bootstrap/css/bootstrap.min.css')}}">
    <!-- Lightbox-->
    <link rel="stylesheet" href="{{asset('template_user/vendor/lightbox2/css/lightbox.min.css')}}">
    <!-- Range slider-->
    <link rel="stylesheet" href="{{asset('template_user/vendor/nouislider/nouislider.min.css')}}">
    <!-- Bootstrap select-->
    <link rel="stylesheet" href="{{asset('template_user/vendor/bootstrap-select/css/bootstrap-select.min.css')}}">
    <!-- Owl Carousel-->
    <link rel="stylesheet" href="{{asset('template_user/vendor/owl.carousel2/assets/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('template_user/vendor/owl.carousel2/assets/owl.theme.default.css')}}">
    <!-- Google fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Libre+Franklin:wght@300;400;700&amp;display=swap">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Martel+Sans:wght@300;400;800&amp;display=swap">
    <!-- theme stylesheet-->
    <link rel="stylesheet" href="{{asset('template_user/css/style.default.css')}}" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="{{asset('template_user/css/custom.css')}}">
    <!-- Favicon-->
    <link rel="shortcut icon" href="{{asset('template_user/img/favicon.png')}}">
    <!-- Tweaks for older IEs--><!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script><![endif]-->
  </head>
  <body>
    <div class="page-holder">
      <!-- navbar-->
      <header class="header bg-white">
        <div class="container px-0 px-lg-3">
          <nav class="navbar navbar-expand-lg navbar-light py-3 px-lg-0"><a class="navbar-brand" href="/"><span class="font-weight-bold text-uppercase text-dark">Cek Toko Sebelah</span></a>
            <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
              <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                  <!-- Link--><a class="nav-link active" href="/home">Home</a>
                </li>
                <li class="nav-item">
                  <!-- Link--><a class="nav-link" href="/shop">Shop</a>
                </li>
                
                <!-- <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" id="pagesDropdown" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Pages</a>
                  <div class="dropdown-menu mt-3" aria-labelledby="pagesDropdown"><a class="dropdown-item border-0 transition-link" href="index.html">yol</a><a class="dropdown-item border-0 transition-link" href="shop.html">Category</a><a class="dropdown-item border-0 transition-link" href="detail.html">Product detail</a><a class="dropdown-item border-0 transition-link" href="cart.html">Shopping cart</a><a class="dropdown-item border-0 transition-link" href="checkout.html">Checkout</a></div>
                </li> -->
              </ul>
              <ul class="navbar-nav ml-auto">               
                <li class="nav-item"><a class="nav-link" href="/shop/cart"> <i class="fas fa-dolly-flatbed mr-1 text-gray"></i></a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle icon-menu" data-toggle="dropdown">
                        <i class="	fas fa-bell mr-1 text-gray"></i>
                        @if ($notif->count() != 0)
                        <span class="badge badge-danger badge-counter">
                                
                        <!-- Counter - Alerts -->
                        @if ($notif->count() >= 5)
                            {{ $notif->count() }}+
                            
                        @else
                            {{ $notif->count() }}
                            
                        @endif
                    
                        
                        </span>
                        @endif
                        <!-- <span class="badge bg-danger">5</span> -->
                    </a>
                    <ul class="dropdown-menu notifications">
                    @foreach ($notif as $item)
                    @php
                        $data = json_decode($item->data);
                    @endphp
                        
                        <a class="dropdown-item d-flex align-items-center" onclick="read('{{$item->id}}')" href="/shop/uploadbukti/{{$data->id}} " >
                        
                        <div class="mr-3">
                            <div class="icon-circle bg-primary">
                                <i class="fas fa-file-alt text-white"></i>
                            </div>
                        </div>
                        <div>
                            <div class="small text-gray-500">{{ date("d F Y", strtotime($item->created_at)) }}</div>
                            <span class="font-weight-bold">{{ $data->nama }} {{ $data->massage}}</span>
                        </div>
                    </a>
                    @endforeach

                    @if ($notif->count() != 0)
                    <a class="dropdown-item text-center small text-gray-500" href="/notifikasi">Show All Notification</a>
                        
                    @endif
                        
                    </ul>
                </li>
                <!-- <li class="nav-item"><a class="nav-link" href="#"> <i class="	fas fa-bell mr-1 text-gray"></i>Notif</a></li> -->
                <li class="nav-item"><a class="nav-link" href="/transaksi"> <i class="	fas fa-truck mr-1 text-gray"></i></a></li>
                <!-- <li class="nav-item"><a class="nav-link" href="#"> <i class="fas fa-user-alt mr-1 text-gray"></i>Login</a></li> -->
                @guest
                <li class="fas fa-user-alt mr-1 text-gray">
                            
                            <a data-toggle="dropdown" href="{{ route('login') }}">{{ __('Login') }} <i class="fas fa-user-alt mr-1 text-gray"></i></a>
                            <!-- <div class="dropdown-menu mt-3" aria-labelledby="pagesDropdown"><a class="dropdown-item border-0 transition-link" href="index.html">Homepage</a> -->
                        </li>
                        @if (Route::has('register'))
                        <li class="fas fa-user-alt mr-1 text-gray">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}<i class="fas fa-user-alt mr-1 text-gray"></i></a>
                        </li>
                        @endif
                        @else
                        <li class="fas fa-user-alt mr-1 text-gray"></i>
                            <!-- <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a> -->
                                
                            <a href="/admin"  class="dropdown-toggle" data-toggle="dropdown">{{ Auth::user()->name }}
                                <i class="icon-submenu lnr lnr-chevron-down"></i></a>

                            <div class="dropdown-menu dropdown-menu-right"  aria-labelledby="navbarDropdown">
                                <a class="lnr lnr-exit" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                    @endguest
                    </li>
              </ul>
            </div>
          </nav>
        </div>
      </header>
        @yield('header')
        @yield('isi')
      <footer class="bg-dark text-white">
        <div class="container py-4">
          <div class="row py-5">
            <div class="col-md-4 mb-3 mb-md-0">
              <h6 class="text-uppercase mb-3">Customer services</h6>
              <ul class="list-unstyled mb-0">
                <li><a class="footer-link" href="#">Help &amp; Contact Us</a></li>
                <li><a class="footer-link" href="#">Returns &amp; Refunds</a></li>
                <li><a class="footer-link" href="#">Online Stores</a></li>
                <li><a class="footer-link" href="#">Terms &amp; Conditions</a></li>
              </ul>
            </div>
            <div class="col-md-4 mb-3 mb-md-0">
              <h6 class="text-uppercase mb-3">Company</h6>
              <ul class="list-unstyled mb-0">
                <li><a class="footer-link" href="#">What We Do</a></li>
                <li><a class="footer-link" href="#">Available Services</a></li>
                <li><a class="footer-link" href="#">Latest Posts</a></li>
                <li><a class="footer-link" href="#">FAQs</a></li>
              </ul>
            </div>
            <div class="col-md-4">
              <h6 class="text-uppercase mb-3">Social media</h6>
              <ul class="list-unstyled mb-0">
                <li><a class="footer-link" href="#">Twitter</a></li>
                <li><a class="footer-link" href="#">Instagram</a></li>
                <li><a class="footer-link" href="#">Tumblr</a></li>
                <li><a class="footer-link" href="#">Pinterest</a></li>
              </ul>
            </div>
          </div>
         
        </div>
      </footer>
      <!-- JavaScript files-->
      <script src="{{asset('template_user/vendor/jquery/jquery.js')}}"></script>
      <script src="{{asset('template_user/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
      <script src="{{asset('template_user/vendor/lightbox2/js/lightbox.min.js')}}"></script>
      <script src="{{asset('template_user/vendor/nouislider/nouislider.min.js')}}"></script>
      <script src="{{asset('template_user/vendor/bootstrap-select/js/bootstrap-select.min.js')}}"></script>
      <script src="{{asset('template_user/vendor/owl.carousel2/owl.carousel.min.js')}}"></script>
      <script src="{{asset('template_user/vendor/owl.carousel2.thumbs/owl.carousel2.thumbs.min.js')}}"></script>
      <script src="{{asset('template_user/js/front.js')}}"></script>
      <script>

        function read(id) {
            $.ajax({
                url : '/shop/read-notif/'+id,
                method : 'GET',
                success : function (response) {
                    console.log(response);
                }
            });
        }

  
        // ------------------------------------------------------- //
        //   Inject SVG Sprite - 
        //   see more here 
        //   https://css-tricks.com/ajaxing-svg-sprite/
        // ------------------------------------------------------ //
        function injectSvgSprite(path) {
        
            var ajax = new XMLHttpRequest();
            ajax.open("GET", path, true);
            ajax.send();
            ajax.onload = function(e) {
            var div = document.createElement("div");
            div.className = 'd-none';
            div.innerHTML = ajax.responseText;
            document.body.insertBefore(div, document.body.childNodes[0]);
            }
        }
        // this is set to BootstrapTemple website as you cannot 
        // inject local SVG sprite (using only 'icons/orion-svg-sprite.svg' path)
        // while using file:// protocol
        // pls don't forget to change to your domain :)
        injectSvgSprite('https://bootstraptemple.com/files/icons/orion-svg-sprite.svg'); 
        
      </script>
      <!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
      <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    </div>
  </body>
  @yield('script')
</html>