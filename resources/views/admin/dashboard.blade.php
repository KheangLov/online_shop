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
@if (strtolower(Auth::user()->role->name) === 'admin')
    <div class="row">
        <div class="col-sm-6">
            <div class="card card-custom mb-4 bg-color">
                <div class="card-header">
                    <h2>Activity logs</h2>
                </div>
                <div class="card-body">
                    <div class="table-responsive" style="overflow-y: scroll; max-height: 295px;">
                        <table class="table custom-table text-nowrap text-truncate">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Log-Name</th>
                                    <th>Description</th>
                                    <th>Subject ID</th>
                                    <th>Subject Type</th>
                                    <th>Causer ID</th>
                                    <th>Causer Type</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($ai = 0)
                                @foreach ($activityLogs as $activity)
                                    <tr>
                                        <td>{{ ++$ai }}</td>
                                        <td>{{ $activity->log_name }}</td>
                                        <td>{{ $activity->description }}</td>
                                        <td>{{ $activity->subject_id }}</td>
                                        <td>{{ $activity->subject_type }}</td>
                                        <td>{{ $activity->causer_id }}</td>
                                        <td>{{ $activity->causer_type }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-sm-6">
            <div class="card card-custom mb-4 bg-color">
                <div class="card-header">
                    <h2>User's last login</h2>
                </div>
                <div class="card-body">
                    <div class="table-responsive" style="overflow-y: scroll; max-height: 295px;">
                        <table class="table custom-table text-nowrap text-truncate">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Username</th>
                                    <th>Last Login</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php($i = 0)
                                @foreach ($lastLog as $item)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{ ucfirst($item->name) }}</td>
                                        <td>{{ Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $item->last_login_at)->setTimezone('Asia/Phnom_Penh')->format('F d, Y h:i:s A') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
@endsection
