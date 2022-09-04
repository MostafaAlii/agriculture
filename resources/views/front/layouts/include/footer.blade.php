	<!-- start footer -->
    <footer id="footer" class="footer footer--style-4">
				<div class="container">
					<div class="row">
						<div class="col-12 col-sm-4 col-md-3 col-lg-2">
							<div class="footer_cont_item">
								<a class="site-logo" href="{{ route('front') }}">
									@if(app()->getLocale()=='ar')
										<img class="img-logo  img-fluid  lazy"
											 src="{{ setting()->ar_site_logo ?
                        URL::asset('Dashboard/img/settingArLogo/'.setting()->ar_site_logo) :
                        URL::asset('Dashboard/img/Default/logo_ar.png')}}"  alt=""
											 style="left: 45%;    width: 200px;height: 260px;  "/>
									@elseif(app()->getLocale()=='ku')
										<img class="img-logo  img-fluid  lazy"
											 src="{{setting()->ku_site_logo ?
                        URL::asset('Dashboard/img/settingKuLogo/'.setting()->ku_site_logo) :
                        URL::asset('Dashboard/img/Default/logo_ku.png')}}"
											 alt="" style="left: 45%;     width: 200px;height: 260px;"/>
									@elseif(app()->getLocale()=='en')
										<img class="img-logo  img-fluid  lazy" src="{{setting()->en_site_logo ?
                         URL::asset('Dashboard/img/settingEnLogo/'.setting()->en_site_logo) :
                         URL::asset('Dashboard/img/Default/logo_en.png')}}"
											 alt="" style="left: 45%;     width: 200px;height: 260px;"/>

									@endif
								</a>
							</div>
						</div>

						<div class="col-12 col-md-9 col-lg-6">
							<div class="footer__item">
								<nav id="footer__navigation" class="navigation">
									<div class="row">
										<div class="col-6 col-sm-4">
											<h5 class="footer__item__title h6">{{__('Admin\site.menu')}}</h5>

											<ul>
												<li><a href="{{ route('front') }}">{{ __('website\home.home')}}</a> </li>
                                                <li > <a href="{{ route('shop') }}">{{ __('website\home.shop') }}</a> </li>
                                                <li > <a href="{{ route('front2') }}"> {{ __('website\home.home2') }}</a> </li>
                                                <li > <a href="{{ route('farmer') }}">{{ __('website\home.servfarmers') }}</a> </li>
                                                <li > <a href="{{ route('servworker') }}">{{ __('website\home.servworkers') }}</a> </li>
												<li><a href="{{ route('blog') }}">{{ __('website\home.blog') }}</a></li>
												<li> <a href="{{ route('aboutUs') }}">{{ __('website\home.aboutus') }}</a> </li>
   												<li> <a href="{{ route('contact') }}">{{ __('website\home.contactus') }}</a> </li>

											</ul>
										</div>


										<div class="col-6 col-sm-4">
											<?php
												$home_category=App\Models\Category::whereNotNull('parent_id')->inRandomOrder()->get();
												if(count($home_category)>0){
											?>
											<h5 class="footer__item__title h6">{{__('Admin/categories.department_sub')}}</h5>
											<ul>

												@foreach($home_category as $cat)
													@if($cat->products()->count()>0)
														<li><a href="{{route('pro_cat',encrypt($cat->id))}}">{{$cat->name}}</a></li>
													@endif
												@endforeach
											</ul>
											<?php
											}
											?>
										</div>

									</div>
								</nav>
							</div>
						</div>

						<div class="col-12 col-md col-lg-4">
							<div class="footer__item">
								<h5 class="footer__item__title h6">{{__('Admin\site.contact_info')}}</h5>

                                <address>
                                    <p>
                                        <span>{{ \App\Models\setting::first()->address }}</span>
                                    </p>

                                    <p>
                                        {{  \App\Models\setting::first()->primary_phone }},
                                        {{  \App\Models\setting::first()->secondery_phone }} <br>
                                        {{--<a href="#">{{  \App\Models\setting::first()->message_maintenance }}</a>--}}
                                    </p>
                                </address>

                                <div class="social-btns">
                                    <a class="fontello-twitter" href="{{  \App\Models\setting::first()->twitter }}"></a>
                                    <a class="fontello-facebook" href="{{  \App\Models\setting::first()->facebook }}"></a>
                                    <a class="fontello-linkedin-squared" href="{{  \App\Models\setting::first()->inestegram }}"></a>
                                </div>
							</div>
						</div>
					</div>

					<div class="row align-items-lg-end justify-content-lg-between copyright">
						<div class="col-12 col-lg-6">
							<div class="footer__item">
                                <span class="__copy">  {{ trans('Admin/general.copyright') }} &copy; 2022
                                    <a class="__dev" href="#">{{ ucfirst(setting()->site_name) }}</a>
                                </span>
							</div>
						</div>

						<div class="col-12 col-lg-6">
							<div class="footer__item">
                                <form class="form--horizontal no-gutters" method="post"  id="ajaxform" autocomplete="off">
                                    @csrf
                                    @method('post')
									<div class="col-sm-6">
										<div class="input-wrp">
											<input class="textfield" name="email" type="email" placeholder="{{ __('Website/home.email') }} " id="email"
                                            value="{{ old('email') }}" required />
                                            @error('email')
                                            <span class="text-danger">{{$message}}</span>
                                            @enderror
										</div>
									</div>

									<div class="col-sm-6">
										<button class="custom-btn custom-btn--medium custom-btn--style-3 wide save-data" type="submit" role="button">{{ __('Website/home.sub') }}</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
	</footer>
			<!-- end footer -->
