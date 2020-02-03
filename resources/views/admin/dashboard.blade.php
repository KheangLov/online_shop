@extends('layouts.admin')

@section('content')
@if ($message = Session::get('warning'))
    <div class="alert alert-warning mb-4 alert-dismissible fade show font-weight-bold" role="alert">
        <i class="fas fa-exclamation mr-2"></i>
        {{ $message }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif
@if ($message = Session::get('logged_user'))
    <div class="card card-custom bg-color text-center">
        <div class="card-header">
            <span class="icon-congrate">
                <svg xmlns="http://www.w3.org/2000/svg" width="50px" height="50px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-award h-8 w-8">
                    <circle cx="12" cy="8" r="7"></circle>
                    <polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"></polyline>
                </svg>
            </span>
        </div>
        <div class="card-body">
            <h2 class="card-title">Welcome user {{ $message->name }}!</strong></h2>
            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
        </div>
    </div>
@endif
@endsection
