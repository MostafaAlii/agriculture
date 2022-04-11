<h1>{{ __('website\home.forgetpassword') }}</h1>

{{ __('website\home.smsreset') }} :
<a href="{{ route('password.reset', $token) }}">{{ __('website\home.resetpass') }}</a>
