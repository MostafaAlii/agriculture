<footer id="footer" class="footer--style-1">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-auto">
                <div class="footer__item">
                    <a class="site-logo" href="index.html">
                        <img class="img-fluid  lazy" src="{{ asset('frontassets/img/blank.gif') }}" data-src="{{ asset('frontassets/img/site_logo.png') }}" alt="demo" />
                    </a>
                </div>
            </div>

            <div class="col-12 col-sm">
                <div class="row align-items-md-center no-gutters">
                    <div class="col-12 col-md">
                        <div class="footer__item">
                            <address>
                                <p>
                                    <span>{{ \App\Models\setting::first()->address }}</span>
                                </p>

                                <p>
                                    {{  \App\Models\setting::first()->primary_phone }},
                                    {{  \App\Models\setting::first()->secondery_phone }} <br>
                                    <a href="#">{{  \App\Models\setting::first()->message_maintenance }}</a>
                                </p>
                            </address>
                        </div>
                    </div>

                    <div class="col-12 col-md-auto">
                        <div class="footer__item">
                            <div class="social-btns">
                                <a class="fontello-twitter" href="{{  \App\Models\setting::first()->twitter }}"></a>
                                <a class="fontello-facebook" href="{{  \App\Models\setting::first()->facebook }}"></a>
                                <a class="fontello-linkedin-squared" href="{{  \App\Models\setting::first()->inestegram }}"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-5 col-xl-4 offset-xl-1">
                <div class="footer__item">
                    <h5 class="h6">Get a newslatter</h5>

                    <form class="form--horizontal" action="#">
                        <div class="input-wrp">
                            <input class="textfield" name="s" type="text" placeholder="Your E-mail" />
                        </div>

                        <button class="custom-btn custom-btn--medium custom-btn--style-1" type="submit" role="button">subscribe</button>
                    </form>
                </div>
            </div>
        </div>

        <div class="row flex-lg-row-reverse">
            <div class="col-12 col-lg-6">
                <div class="footer__item">
                    <nav id="footer__navigation" class="navigation  text-lg-right">
                        <ul>
                            <li class="active"><a href="index.html">Home</a></li>
                            <li><a href="#">About</a></li>
                            <li><a href="#">Pages</a></li>
                            <li><a href="#">Gallery</a></li>
                            <li><a href="#">Blog</a></li>
                            <li><a href="#">Contacts</a></li>
                        </ul>
                    </nav>
                </div>
            </div>

            <div class="col-12 col-lg-6">
                <div class="footer__item">
                    <span class="__copy">© 2019 Agro. All rights reserved. Created by <a class="__dev" href="https://themeforest.net/user/artureanec" target="_blank">Artureanec</a></span>
                </div>
            </div>
        </div>
    </div>
</footer>
