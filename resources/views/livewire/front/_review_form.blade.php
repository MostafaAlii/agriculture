@if(Session::has('review_success'))
        <div>
           <center><h3 style="color:#bfa43c">{{Session::get('review_success')}}</h2></center>
           <br>
        </div>
    @endif
    <!-- start section -->
    <section class="section section--dark-bg">
        <div class="container">
            <div class="section-heading section-heading--center section-heading--white" data-aos="fade">
                <h2 class="__title">{{__('Admin/about.review_tit1')}} <span>{{__('Admin/about.review_tit2')}}</span></h2>

                <p>{{__('Admin/about.msg')}} </p>
            </div>

            <form class="contact-form" action="{{route('review.add')}}" data-aos="fade" id="ggg">
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="input-wrp">
                            <input class="textfield" name="name" value="{{old('name')}}" type="text" placeholder="{{__('Admin/about.name')}}" required/>
                            @error('name')
                               <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="input-wrp">
                            <input class="textfield" name="email" value="{{old('email')}}" type="text" placeholder="{{__('Admin/about.email')}}" required/>
                            @error('email')
                               <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="input-wrp">
                    <textarea class="textfield" name="message" placeholder="{{__('Admin/about.message')}}" required>{{old('message')}}</textarea>
                    @error('message')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>

                <button class="custom-btn custom-btn--medium custom-btn--style-3 wide" id="ccccc" type="submit" role="button">{{__('Admin/about.send')}}</button>

                <div class="form__note"></div>
            </form>
        </div>
    </section>
    <!-- end section -->
    <script>
        // var wage = document.getElementById("ccccc");
        // //alert(wage);
        //  wage.addEventListener("click", function (e) {
        //  //   document.getElementById("ccccc").disabled =true;
        // });

        $(document).ready(function () {
            $("#ggg").submit(function () {
               // alert('ggg');
                document.getElementById("ccccc").disabled =true;
               // $("#ccccc").attr("disabled", true);
                //return true;
            });
        });
    </script>