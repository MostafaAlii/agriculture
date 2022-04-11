@extends('dashboard.layouts.login')
@section('css')

@endsection
@section('pageTitle')
    {{ trans('Admin/login.loginPageTitle') }}
@endsection
@section('content')
    @include('dashboard.common._partials.messages')
    <section class="row flexbox-container">
        <div class="col-12 d-flex align-items-center justify-content-center">
            <div class="col-lg-4 col-md-8 col-10 box-shadow-2 p-0">
                <div class="card border-grey border-lighten-3 px-1 py-1 m-0">
                    <div class="card-header border-0">
                        <div class="card-title text-center">
                            <img src="{{ asset('assets/admin/images/logo/logo-dark.png') }}" alt="branding logo">
                        </div>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form-horizontal" novalidate method="POST" autocomplete="off"
                                action="{{ route('admin.login.post') }}">
                                @csrf
                                <fieldset class="form-group position-relative has-icon-left">
                                    <input class="form-control" id="login"
                                        placeholder="{{ trans('Admin/site.loginby') }}" type="login" name="login" required
                                        autofocus>
                                    <div class="form-control-position">
                                        <i class="la la-user"></i>
                                    </div>
                                    @error('login')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </fieldset>
                                <fieldset class="form-group position-relative has-icon-left">
                                    <input class="form-control" id="user-password"
                                        placeholder="{{ trans('Admin/site.password') }}" type="password" name="password"
                                        required autocomplete="current-password">
                                    <div class="form-control-position">
                                        <i class="la la-key"></i>
                                    </div>
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </fieldset>
                                <div class="form-group row">
                                    <div class="col-sm-6 col-12 text-center text-sm-left pr-0">
                                        <fieldset>
                                            <input type="checkbox" id="remember-me" class="chk-remember" name="remember">
                                            <label for="remember-me"> {{ trans('Admin/login.remember_me') }}</label>
                                        </fieldset>
                                    </div>
                                    <div class="col-sm-6 col-12 float-sm-left text-center text-sm-right"><a
                                            href="{{ route('admin.password.request') }}"
                                            class="card-link">{{ trans('Admin/login.forget_password') }}</a></div>
                                </div>
                                <button type="submit" class="btn btn-outline-info btn-block"><i class="ft-unlock"></i>
                                    {{ trans('Admin/login.login') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop
<!-- END: Content-->
