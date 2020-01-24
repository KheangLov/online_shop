@extends('layouts.admin')

@section('content')
<div class="card card-custom bg-color">
    <div class="card-header d-flex bd-highlight">
        <h2 class="p-2 w-100 bd-highlight">User's Profile</h2>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-2">
                <div class="profile-upload mb-3">
                    <div class="profile-overlay">
                        <div class="profile-pic" id="profile_bg_image" style="background-image: url('{{ asset($user->profile ? $user->profile : 'images/avatar_profile_user_music_headphones_shirt_cool-512.png') }}');"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="row">
                    <div class="col-md-4">
                        <strong class="detail-label">Username</strong>
                    </div>
                    <div class="col-md-8">
                        <p>{{ ucfirst($user->name) }}</p>
                    </div>
                    <div class="col-md-4">
                        <strong class="detail-label">Email</strong>
                    </div>
                    <div class="col-md-8">
                        @if ($user->email_verified_at !== null)
                            <p>{{ $user->email }}</p>
                        @else
                            <p class="text-warning" data-toggle="tooltip" data-placement="top" title="Email haven't verified!">
                                {{ $user->email }}
                            </p>
                        @endif
                    </div>
                    <div class="col-md-4">
                        <strong class="detail-label">Phone</strong>
                    </div>
                    <div class="col-md-8">
                        <p>{{ $user->phone}}</p>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="row">
                    <div class="col-md-4">
                        <strong class="detail-label">Role</strong>
                    </div>
                    <div class="col-md-8">
                        <p>{{ ucfirst($user->role->name) }}</p>
                    </div>
                    <div class="col-md-4">
                        <strong class="detail-label">Status</strong>
                    </div>
                    <div class="col-md-8">
                        <p>{{ $user->status}}</p>
                    </div>
                    <div class="col-md-4">
                        <strong class="detail-label">Joined</strong>
                    </div>
                    <div class="col-md-8">
                        <p>{{ $user->created_at->format("Y")}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <a href="{{ route('user_edit', ['id' => $user->id]) }}" class="btn btn-lg btn-primary mr-2">
                <i class="fas fa-pen"></i>
                Edit
            </a>
            <button type="button" class="btn btn-lg btn-danger" data-toggle="modal" data-target="#btn_delete_user_{{ $user->id }}">
                <i class="fas fa-trash-alt"></i>
                Delete
            </button>
            <div class="modal fade custom-modal" id="btn_delete_user_{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalCenterTitle">Confirm dialog</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete this user?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-cancel" data-dismiss="modal">{{ __('Cancel') }}</button>
                            <a href="{{ route('user_delete', ['id' => $user->id]) }}" class="btn btn-primary btn-reg">
                                Yes
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
