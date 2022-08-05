@extends('dashboard.layouts.login')
@section('css')
@endsection
@section('pageTitle')
    {{ trans('Admin/login.loginPageTitle') }}
@endsection
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    @if (session()->has('status'))
        <div class="alert alert-success" role="alert">
            <strong style="padding-right: 35px;">{{ session()->get('status') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

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
                                action="{{ route('admin.password.update') }}">
                                @csrf
                                <input type="hidden" name="token" value="{{ $request->route('token') }}">
                                <fieldset class="form-group position-relative has-icon-left">
                                    <input class="form-control" id="login" placeholder="{{ __('website\home.email') }}"
                                        type="login" name="email" :value="old('email')" required autofocus>
                                    <div class="form-control-position">
                                        <i class="la la-user"></i>
                                    </div>
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </fieldset>
                                <fieldset class="form-group position-relative has-icon-left">
                                    <input class="form-control" id="user-password"
                                        placeholder="{{ __('website\home.newpassword') }} *" type="password"
                                        name="password" required>
                                    <div class="form-control-position">
                                        <i class="la la-key"></i>
                                    </div>
                                    @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </fieldset>
                                <fieldset class="form-group position-relative has-icon-left">
                                    <input class="form-control"
                                        placeholder="{{ __('website\home.confirmpassword') }} *" type="password"
                                        name="password_confirmation" required>
                                    <div class="form-control-position">
                                        <i class="la la-key"></i>
                                    </div>
                                    @error('password_confirmation')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </fieldset>

                                <button type="submit" class="btn btn-outline-info btn-block"><i class="ft-unlock"></i>
                                    {{ __('website\home.ResetPassword') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
