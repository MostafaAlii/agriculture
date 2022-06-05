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

{{-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script> --}}


{{-- bootstrap 4 ************************ --}}

{{-- <script>
     window.jQuery || document.write('<script src="frontassets/js/jquery-2.2.4.min.js"></script>')
</script> --}}
{{-- <script src="{{ asset('frontassets/js/jquery-2.2.4.min.js') }}"></script> --}}

<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@if(session('status'))
    <script>
          swal("{{ session('status') }}");
    </script>
@endif
@if(session('error'))
    <script>
          swal("{{ session('error') }}");
    </script>
@endif

<script type="text/javascript" src="{{ asset('frontassets/js/main.min.js') }}"></script>

@include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"
integrity="sha384-fQybjgWLrvvRgtW6bFlB7jaZrFsaBXjsOMm/tB9LTS58ONXgqbR9W8oWht/amnpF" crossorigin="anonymous"></script>
<!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->

<script>
    (function(b,o,i,l,e,r){b.GoogleAnalyticsObject=l;b[l]||(b[l]=
    function(){(b[l].q=b[l].q||[]).push(arguments)});b[l].l=+new Date;
    e=o.createElement(i);r=o.getElementsByTagName(i)[0];
    e.src='https://www.google-analytics.com/analytics.js';
    r.parentNode.insertBefore(e,r)}(window,document,'script','ga'));
    ga('create','UA-XXXXX-X','auto');ga('send','pageview');
</script>
{{-- filter price --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.5.1/nouislider.min.js" integrity="sha512-T5Bneq9hePRO8JR0S/0lQ7gdW+ceLThvC80UjwkMRz+8q+4DARVZ4dqKoyENC7FcYresjfJ6ubaOgIE35irf4w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

@stack('js')

<script src="{{ URL::asset('/js/search.js') }}"></script>
<script src="{{ URL::asset('/js/myFun.js') }}"></script>


<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function() {
        $(".save-data").click(function(e) {
            e.preventDefault();
            // let email = $("input[name=email]").val();
            let email = $('#email').val();
            console.log(email);
            $.ajax({
                method: "POST",
                url: "/sendmails",
                data: {
                    email: email,
                },
                success: function(response) {
                    swal(response.status);
                    $("#ajaxform")[0].reset();
                },
                error: function(response) {
                    swal(response.error);
                }
            });
        });
    });
</script>
@livewireScripts

