@extends('layouts.app')

@section('content')
<!-- Start Login Register Area -->
<div class="htc__login__register bg__white ptb--130" style="background: rgba(0, 0, 0, 0) url({{ asset('images/bg/5.jpg') }}) no-repeat scroll center center / cover;padding: 250px 0;">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <ul class="login__register__menu">
                    <li class="login"><a href="{{ route('login') }}">{{ __('Login') }}</a></li>
                    <li class="register active"><a href="{{ route('register') }}">{{ __('Register') }}</a></li>
                </ul>
            </div>
        </div>
        <!-- Start Login Register Content -->
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="htc__login__register__wrap">
                    <!-- Start Single Content -->
                    <form class="login" method="POST" action="{{ route('register') }}">
                        @csrf

                        <input id="name" type="text" name="name" placeholder="Name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                        @error('name')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror

                        <input id="email" type="email" placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror

                        <input id="phone" type="number" placeholder="Phone" name="phone" required>

                        @error('phone')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror

                        <input id="password" type="password" placeholder="Password" name="password" required autocomplete="new-password">

                        @error('password')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror

                        <input id="password-confirm" type="password" placeholder="Confirm-Password" name="password_confirmation" required autocomplete="new-password">

                        <button type="submit" class="btn btn-primary btn-block btn-login-custom">
                            {{ __('Register') }}
                        </button>
                    </form>
                    <!-- End Single Content -->
                </div>
            </div>
        </div>
        <!-- End Login Register Content -->
    </div>
</div>
<!-- End Login Register Area -->
@endsection
