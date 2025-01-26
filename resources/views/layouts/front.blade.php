
<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title')</title>
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" type="image/x-icon" href="{{asset("assets/images/favicon.svg")}}" />

    <!-- ========================= CSS here ========================= -->
    <link rel="stylesheet" href="{{asset("assets/css/bootstrap.min.css")}}" />
    <link rel="stylesheet" href="{{asset("assets/css/LineIcons.3.0.css")}}" />
    <link rel="stylesheet" href="{{asset("assets/css/tiny-slider.css")}}" />
    <link rel="stylesheet" href="{{asset("assets/css/glightbox.min.css")}}" />
    <link rel="stylesheet" href="{{asset("assets/css/main.css")}}" />
    @stack('styles')
</head>

<body>
    <!--[if lte IE 9]>
      <p class="browserupgrade">
        You are using an <strong>outdated</strong> browser. Please
        <a href="https://browsehappy.com/">upgrade your browser</a> to improve
        your experience and security.
      </p>
    <![endif]-->

    <!-- Preloader -->
    <div class="preloader">
        <div class="preloader-inner">
            <div class="preloader-icon">
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- /End Preloader -->

    <!-- Start Header Area -->
     @include('layouts.partials.front.header.header')
    <!-- End Header Area -->

    <!-- Start Breadcrumbs -->
     @include('layouts.partials.front.breadcrumb')
    <!-- End Breadcrumbs -->

    @yield('content')

    <!-- Start Footer Area -->
    @include('layouts.partials.front.footer.footer')
    <!--/ End Footer Area -->

    <!-- ========================= scroll-top ========================= -->
    <a href="#" class="scroll-top">
        <i class="lni lni-chevron-up"></i>
    </a>

    <!-- ========================= JS here ========================= -->
    <script  src="{{asset("assets/js/bootstrap.min.js")}}"></script>
    <script  src="{{asset("assets/js/tiny-slider.js")}}"></script>
    <script  src="{{asset("assets/js/glightbox.min.js")}}"></script>
    <script  src="{{asset("assets/js/main.js")}}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    @vite( 'resources/js/cart.js')
    @stack('scripts')
</body>

</html>
