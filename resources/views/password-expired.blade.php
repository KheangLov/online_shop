@extends('layouts.app')

@section('content')
<!-- Start Login Register Area -->
<div class="htc__login__register bg__white ptb--130" style="background: rgba(0, 0, 0, 0) url({{ asset('images/bg/5.jpg') }}) no-repeat scroll center center / cover ;">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <ul class="login__register__menu">
                    <li class="login active"><a href="#">{{ __('Password Expired') }}</a></li>
                </ul>
            </div>
        </div>
        <!-- Start Login Register Content -->
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="htc__login__register__wrap">
                    <!-- Start Single Content -->
                    <form class="login" method="post" action="{{ route('password_update', ['id' => $id]) }}">
                        @method('PUT')
                        @csrf
                        <input type="password" name="old_password" placeholder="Old Password">
                        @error('password')
                            <div class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </div>
                        @enderror

                        <input type="password" name="new_password" placeholder="New Password">
                        <input type="password" name="password_confirmation" placeholder="Confirm Password">
                        <button type="submit" class="btn btn-primary btn-block btn-login-custom">
                            {{ __('Change') }}
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
