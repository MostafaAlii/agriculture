<div id="btn-to-top-wrap">
    <a id="btn-to-top" class="circled" href="javascript:void(0);" data-visible-offset="800"></a>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
{!! NoCaptcha::renderJs() !!}
{{-- bootstrap 4 ************************ --}}
{{-- <script type="text/javascript" src="{{ asset('frontassets/js2/jquery-1.12.4.minb8ff.js?ver=1.12.4') }}"></script>
<script src="{{ asset('frontassets/js2/jquery-1.12.4.minb8ff.js?ver=1.12.4')}}"></script>
<script src="{{ asset('frontassets/js2/jquery-ui-1.12.4.minb8ff.js?ver=1.12.4')}}"></script>
<script src="{{ asset('frontassets/js2/bootstrap.min.js')}}"></script>
<script src="{{ asset('frontassets/js2/jquery.flexslider.js')}}"></script>
<script src="{{ asset('frontassets/js2/owl.carousel.min.js')}}"></script>
<script src="{{ asset('frontassets/js2/jquery.countdown.min.js')}}"></script>
<script src="{{ asset('frontassets/js2/jquery.sticky.js')}}"></script>
<script src="{{ asset('frontassets/js2/functions.js')}}"></script> --}}

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
{{-- bootstrap 4 ************************ --}}

<script>window.jQuery || document.write('<script src="frontassets/js/jquery-2.2.4.min.js"><\/script>')</script>

<script type="text/javascript" src="{{ asset('frontassets/js/main.min.js') }}"></script>
<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
<script>
    (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
    function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
    e=o.createElement(i);r=o.getElementsByTagName(i)[0];
    e.src='https://www.google-analytics.com/analytics.js';
    r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
    ga('create','UA-XXXXX-X','auto');ga('send','pageview');
</script>
@livewireScripts
@stack('js')

