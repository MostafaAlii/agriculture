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
                            {{ __('website\home.smsforget') }}

                            @if (session()->has('status'))
                                <div class="alert alert-success" role="alert">
                                    <strong style="padding-right: 35px;">{{ session()->get('status') }}</strong>
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <form class="form-horizontal" novalidate method="POST"
                                action="{{ route('admin.password.email') }}">
                                @csrf
                                <fieldset class="form-group position-relative has-icon-left">
                                    <input class="form-control" id="login" name="email" :value="old('email')" required
                                        autofocus placeholder=" {{ trans('Admin/site.email') }}">
                                    <div class="form-control-position">
                                        <i class="la la-user"></i>
                                    </div>
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </fieldset>
                                <button type="submit" class="btn btn-outline-info btn-block"><i class="ft-unlock"></i>
                                    {{ __('website\home.emaillink') }}</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
