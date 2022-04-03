
    <title>@yield('title')</title>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <meta name="viewport" content="initial-scale=1.0, user-scalable=no" />
    <meta name="viewport" content="user-scalable=no, width=device-width, height=device-height, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui" />

    <meta name="theme-color" content="#FCDB5A" />
    <meta name="msapplication-navbutton-color" content="#FCDB5A" />
    <meta name="apple-mobile-web-app-status-bar-style" content="#FCDB5A" />

    <!-- Favicons
    ================================================== -->
    <link rel="shortcut icon" href="{{ asset('frontassets/img/favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('frontassets/img/apple-touch-icon.png') }}">
    <link rel="apple-touch-icon" sizes="72x72" href="{{ asset('frontassets/img/apple-touch-icon-72x72.png') }}">
    <link rel="apple-touch-icon" sizes="114x114" href="{{ asset('frontassets/img/apple-touch-icon-114x114.png') }}">

    {{-- bootstrap 4 ************************ --}}
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('frontassets/css2/animate.css') }}"> --}}
	{{-- <link rel="stylesheet" type="text/css" href="{{ asset('frontassets/css2/font-awesome.min.css') }}"> --}}
	{{-- <link rel="stylesheet" type="text/css" href="{{ asset('frontassets/css2/bootstrap.min.css') }}"> --}}
	{{-- <link rel="stylesheet" type="text/css" href="{{ asset('frontassets/css2/owl.carousel.min.css') }}"> --}}
    {{-- <link rel="stylesheet" type="text/css" href="{{ asset('frontassets/css2/flexslider.css') }}"> --}}
	{{-- <link rel="stylesheet" type="text/css" href="{{ asset('frontassets/css2/color-01.css') }}"> --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
    integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
        {{-- bootstrap 4 ************************ --}}
    {{-- font cairo --}}
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

          <link href="https://fonts.googleapis.com/css?family=Cairo&display=swap" rel="stylesheet">
          <!-- END: Page CSS-->
          <style> body {font-family: 'Cairo', sans-serif !important;} </style>
    {{-- font cairo --}}

    <!-- Critical styles
    ================================================== -->
    <link rel="stylesheet" href="{{ asset('frontassets/css/critical.min.css') }}" type="text/css">

    <!-- Load google font
    ================================================== -->
    <script type="text/javascript">
        WebFontConfig = {
            google: { families: [ 'Open+Sans:300,400,500,600,700,800', 'Raleway:100,400,400i,500,500i,700,700i,900'] }
        };
        (function() {
            var wf = document.createElement('script');
            wf.src = ('https:' == document.location.protocol ? 'https' : 'http') + '://ajax.googleapis.com/ajax/libs/webfont/1.6.26/webfont.js';
            wf.type = 'text/javascript';
            wf.async = 'true';
            var s = document.getElementsByTagName('script')[0];
            s.parentNode.insertBefore(wf, s);
        })();
    </script>

    <!-- Load other scripts
    ================================================== -->
    <script type="text/javascript">
        var _html = document.documentElement,
            isTouch = (('ontouchstart' in _html) || (navigator.msMaxTouchPoints > 0) || (navigator.maxTouchPoints));

        _html.className = _html.className.replace("no-js","js");
        _html.classList.add( isTouch ? "touch" : "no-touch");
    </script>
    {{-- filter price --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.5.1/nouislider.min.css" integrity="sha512-qveKnGrvOChbSzAdtSs8p69eoLegyh+1hwOMbmpCViIwj7rn4oJjdmMvWOuyQlTOZgTlZA0N2PXA7iA8/2TUYA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <script type="text/javascript" src="{{ asset('frontassets/js/device.min.js') }}"></script>
    @yield('css')
    @livewireStyles
