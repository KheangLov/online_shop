@extends('layouts.app')

@section('content')
<!-- Start Login Register Area -->
<div class="htc__login__register bg__white ptb--130" style="background: rgba(0, 0, 0, 0) url({{ asset('images/bg/5.jpg') }}) no-repeat scroll center center / cover ; padding: 250px 0;">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <ul class="login__register__menu">
                    <li class="login active"><a href="{{ route('login') }}">{{ __('Login') }}</a></li>
                    <li class="register"><a href="{{ route('register') }}">{{ __('Register') }}</a></li>
                </ul>
            </div>
        </div>
        <!-- Start Login Register Content -->
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="htc__login__register__wrap">
                    <!-- Start Single Content -->
                    <form class="login" method="post" action="{{ route('login') }}">
                        @csrf

                        <input type="email" name="email" placeholder="Email">
                        @error('email')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror

                        <input type="password" name="password" placeholder="Password">
                        @error('password')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror

                        <div class="form-group row">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input type="checkbox" name="remember" id="remember" class="input-remember-me" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                @if (Route::has('password.request'))
                                    <a class="btn btn-link" href="{{ route('password.request') }}">
                                        {{ __('Forgot Your Password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block btn-login-custom">
                            {{ __('Login') }}
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
