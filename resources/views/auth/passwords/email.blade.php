@extends('layouts.app')

@section('content')
<!-- Start Login Register Area -->
<div class="htc__login__register bg__white ptb--130" style="background: rgba(0, 0, 0, 0) url({{ asset('images/bg/5.jpg') }}) no-repeat scroll center center / cover ; padding: 250px 0;">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <ul class="login__register__menu">
                    <li class="login active"><a href="{{ route('password.request') }}">{{ __('Reset Password') }}</a></li>
                </ul>
            </div>
        </div>
        <!-- Start Login Register Content -->
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="htc__login__register__wrap">
                    <h3 class="text-center" style="margin-bottom: 30px; font-size: 20px;">Send to your email to reset the password!</h3>

                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="login" method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <input id="email" type="email" placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                        <button type="submit" class="btn btn-primary btn-block btn-login-custom">
                            {{ __('Send Password Reset Link') }}
                        </button>
                    </form>

                    <h3 class="text-center" style="margin-top: 30px; font-size: 20px;">Please check your email after sent!</h3>
                </div>
            </div>
        </div>
        <!-- End Login Register Content -->
    </div>
</div>
<!-- End Login Register Area -->
@endsection
