@extends('layouts.admin')

@section('content')
<a href="{{ route('user_add') }}" class="btn btn-lg btn-secondary mb-5">
    <i class="fas fa-plus mr-1"></i>
    Add User
</a>
<div class="card card-custom bg-color">
    <div class="card-header text-nowrap">
        <div class="row">
            <div class="col-sm-6">
                <h2 class="p-2 w-100 bd-highlight text-truncate">User List</h2>
            </div>
            <div class="col-sm-6">
                <div class="p-2">
                    <input type="text" class="form-control" id="user_search" placeholder="Search...">
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        @if ($message = Session::get('success'))
            <div class="alert alert-success" role="alert">
                {{ $message }}
            </div>
        @endif
        @if ($message = Session::get('warning'))
            <div class="alert alert-warning" role="alert">
                {{ $message }}
            </div>
        @endif
        <div class="table-responsive-xl" id="user_table">
            <table class="table custom-table text-nowrap text-truncate">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Avatar</th>
                        <th scope="col">Username</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Role</th>
                        <th scope="col">Status</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php($i = 0)
                    @php($no = $users->currentPage() - 1 !== 0 ? strval($users->currentPage() - 1) : '')
                    @foreach ($users as $user)
                        <tr>
                            @php($i++)
                            @if ($i === 10)
                                @php($i = 0)
                                @php($no = $users->currentPage())
                            @endif
                            <th scope="row">{{ $no . $i }}</th>
                            <td>
                                <div class="list-avatar">
                                    <a href="{{ route('user_detail', ['id' => $user->id]) }}" class="avatar-link" data-toggle="tooltip" data-placement="top" title="View">
                                        <div class="avatar" style="background-image: url('{{ asset($user->profile ? $user->profile : 'images/avatar_profile_user_music_headphones_shirt_cool-512.png') }}');"></div>
                                    </a>
                                </div>
                            </td>
                            <td class="text-nowrap text-truncate">{{ $user->name }}</td>
                            @if ($user->email_verified_at !== null)
                                <td>{{ $user->email }}</td>
                            @else
                                <td class="text-warning" data-toggle="tooltip" data-placement="bottom" title="Email haven't verified!">
                                    {{ $user->email }}
                                </td>
                            @endif
                            <td>{{ $user->phone }}</td>
                            <td>{{ $user->role->name }}</td>
                            <td>
                                <span class="badge badge-custom{{ ($user->status === 'active') ? ' badge-success' : (($user->status === 'inactive') ? ' badge-danger' : ' badge-warning' ) }}">
                                    {{ $user->status }}
                                </span>
                            </td>
                            <td>
                                <a href="{{ route('user_edit', ['id' => $user->id]) }}" class="btn-action btn-edit" data-toggle="tooltip" data-placement="bottom" title="Edit">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3 h-5 w-5 mr-4 hover:text-primary cursor-pointer">
                                        <path d="M12 20h9"></path>
                                        <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                                    </svg>
                                </a>
                                @if (Auth::user()->id !== $user->id)
                                    <div class="d-inline" data-toggle="tooltip" data-placement="bottom" title="Delete">
                                        <button type="button" class="btn-action btn-del p-0" data-toggle="modal" data-target="#btn_delete_user_{{ $user->id }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 h-5 w-5 hover:text-danger cursor-pointer">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                                <line x1="14" y1="11" x2="14" y2="17"></line>
                                            </svg>
                                        </button>
                                    </div>
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
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer text-muted">
        <div class="d-xl-none d-lg-none d-md-none d-sm-block">
            {{ $users->links('share.paginate') }}
        </div>
        <div class="d-none d-md-block">
            {{ $users->onEachSide(1)->links() }}
        </div>
    </div>
</div>
@endsection
