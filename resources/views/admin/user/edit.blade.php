@extends('layouts.admin')

@section('content')
<div class="card card-custom bg-color">
    <div class="card-header d-flex bd-highlight">
        <h2 class="p-2 w-100 bd-highlight">Edit User</h2>
    </div>
    <div class="card-body">
        @if ($message = Session::get('success'))
            <div class="alert alert-success" role="alert">
                {{ $message }}
            </div>
        @endif
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="pills-home-tab" data-toggle="pill" href="#pills-home" role="tab" aria-controls="pills-home" aria-selected="true">
                    Info
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#pills-profile" role="tab" aria-controls="pills-profile" aria-selected="false">
                    Password
                </a>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">
                <form method="POST" action="{{ route('user_update', ['id' => $user->id]) }}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="profile-upload text-center mb-4">
                        <div class="profile-overlay">
                            <div class="profile-pic" style="background-image: url('{{ asset($user->profile) }}');"></div>
                            <button type="button" class="btn btn-primary btn-profile-upload" id="btn_profile_edit">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32px" height="32px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user w-4 h-4">
                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                    <circle cx="12" cy="7" r="4"></circle>
                                </svg>
                            </button>
                            <input type="file" name="profile" id="profile_edit" class="d-none">
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="form-group col-md-7">
                            <label for="name">{{ __('Name') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $user->name }}" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-7">
                            <label for="email">{{ __('E-Mail Address') }}</label>
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-7">
                            <label for="phone">{{ __('Phone Number') }}</label>
                            <input id="phone" type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ $user->phone }}" required>

                            @error('phone')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-7">
                            <label for="status">{{ __('Status') }}</label>
                            <select id="status" class="form-control" name="status" id="exampleFormControlSelect1">
                                <option value="active"{{ ($user->status === 'active') ? ' selected' : '' }}>{{ __('Active') }}</option>
                                <option value="inactive"{{ ($user->status === 'inactive') ? ' selected' : '' }}>{{ __('Inactive') }}</option>
                                <option value="ban"{{ ($user->status === 'ban') ? ' selected' : '' }}>{{ __('Ban') }}</option>
                            </select>
                        </div>
                        <div class="form-group col-md-7">
                            <label for="role">{{ __('Role') }}</label>
                            <select id="role" class="form-control" name="role" id="exampleFormControlSelect1">
                                @foreach ($roles as $role)
                                    <option value="{{ $role->id }}"{{ ($user->role_id === $role->id) ? ' selected' : '' }}>{{ ucfirst($role->name) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-7">
                            <button type="submit" class="btn btn-primary btn-reg">
                                {{ __('Update') }}
                            </button>
                            <a href="{{ route('user_list') }}" class="btn btn-primary btn-cancel">
                                {{ __('Cancel') }}
                            </a>
                        </div>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                <form method="POST" action="{{ route('user_password', ['id' => $user->id]) }}">
                    @method('PUT')
                    @csrf
                    <div class="row justify-content-center">
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
                            <button type="submit" class="btn btn-primary btn-reg">
                                {{ __('Change Password') }}
                            </button>
                            <a href="{{ route('user_list') }}" class="btn btn-primary btn-cancel">
                                {{ __('Cancel') }}
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="card-footer">
    </div>
</div>
@endsection
