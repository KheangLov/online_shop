@extends('layouts.admin')

@section('content')
<div class="card card-custom bg-color">
    <div class="card-header d-flex bd-highlight">
        <h2 class="p-2 w-100 bd-highlight">Add User</h2>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('user_create') }}" enctype="multipart/form-data">
            @csrf
            <div class="row justify-content-center">
                <div class="form-group col-md-7">
                    <label for="name">{{ __('Name') }}</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" required autocomplete="name" autofocus>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group col-md-7">
                    <label for="email">{{ __('E-Mail Address') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" required autocomplete="email">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group col-md-7">
                    <label for="phone">{{ __('Phone Number') }}</label>
                    <input id="phone" type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" required>

                    @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group col-md-7">
                    <label for="password">{{ __('Password') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group col-md-7">
                    <label for="password-confirm">{{ __('Confirm Password') }}</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                </div>
                <div class="form-group col-md-7">
                    <label for="status">{{ __('Status') }}</label>
                    <select id="status" class="form-control" name="status" id="exampleFormControlSelect1">
                        <option value="active">{{ __('Active') }}</option>
                        <option value="inactive">{{ __('Inactive') }}</option>
                        <option value="ban">{{ __('Ban') }}</option>
                    </select>
                </div>
                <div class="form-group col-md-7">
                    <label for="role">{{ __('Role') }}</label>
                    <select id="role" class="form-control" name="role" id="exampleFormControlSelect1">
                        @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{ ucfirst($role->name) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-7">
                    <label for="profile">{{ __('Profile') }}</label>
                    <input type="file" name="profile" class="form-control" id="profile">
                </div>
                <div class="form-group col-md-7">
                    <button type="submit" class="btn btn-primary btn-reg">
                        {{ __('Create') }}
                    </button>
                    <a href="{{ route('product') }}" class="btn btn-primary btn-cancel">
                        {{ __('Cancel') }}
                    </a>
                </div>
            </div>
        </form>
    </div>
    <div class="card-footer">
    </div>
</div>
@endsection
