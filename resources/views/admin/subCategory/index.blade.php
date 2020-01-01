@extends('layouts.admin')

@section('content')
<a href="{{ route('category.index') }}" class="btn btn-primary btn-lg btn-add mb-5">Category</a>
<div class="row">
    <div class="col-sm-4">
        <div class="card card-custom bg-color">
            <div class="card-header d-flex bd-highlight">
                <h2 class="p-2 w-100 bd-highlight">{{ isset($edit) && $edit ? 'Edit' : 'Add' }} Sub-Category</h2>
            </div>
            <div class="card-body">
                @if ($message = Session::get('message'))
                    <div class="alert alert-success" role="alert">
                        {{ $message }}
                    </div>
                @endif
                @if ($edit = true && isset($subCategory))
                    <form method="POST" action="{{ route('sub_cate_update', ['id' => $subCategory->id ?? 0]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <div class="form-group">
                            <label for="name">{{ __('Name') }}</label>
                            <input id="name" type="text" class="form-control" name="name" required value="{{ $subCategory->name ?? '' }}">
                        </div>
                        <div class="form-group">
                            <label for="category">{{ __('Category') }}</label>
                            <select name="category" id="category" class="form-control">
                                @foreach ($categories as $cate)
                                    <option value="{{ $cate->id }}"{{ ($subCategory->id === $cate->id) ? ' selected' : '' }}>
                                        {{ ucfirst($cate->name) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description">{{ __('Description') }}</label>
                            <textarea id="description" cols="5" rows="3" class="form-control" name="description">{{ $subCategory->description ?? '' }}</textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-reg">
                                {{ __('Update') }}
                            </button>
                            <a href="{{ route('sub_cate') }}" class="btn btn-secondary btn-cancel">
                                {{ __('Cancel') }}
                            </a>
                        </div>
                    </form>
                @else
                    <form method="POST" action="{{ route('sub_cate_create') }}">
                        @csrf
                        <div class="form-group">
                            <label for="name">{{ __('Name') }}</label>
                            <input id="name" type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group">
                            <label for="category">{{ __('Category') }}</label>
                            <select name="category" id="category" class="form-control">
                                @foreach ($categories as $cate)
                                    <option value="{{ $cate->id }}">{{ ucfirst($cate->name) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="description">{{ __('Description') }}</label>
                            <textarea id="description" cols="5" rows="3" class="form-control" name="description"></textarea>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary btn-reg">
                                {{ __('Create') }}
                            </button>
                        </div>
                    </form>
                @endif
            </div>
            <div class="card-footer text-muted">
            </div>
        </div>
    </div>
    <div class="col-sm-8">
        <div class="card card-custom bg-color">
            <div class="card-header d-flex bd-highlight">
                <h2 class="p-2 w-100 bd-highlight">Sub-Category List</h2>
                <input type="text" class="custom-input p-2 flex-shrink-1 bd-highlight" placeholder="Search...">
            </div>
            <div class="card-body">
                @if ($message = Session::get('delete_success'))
                    <div class="alert alert-success" role="alert">
                        {{ $message }}
                    </div>
                @endif
                <table class="table custom-table">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Name</th>
                            <th scope="col">Category</th>
                            <th scope="col">User</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php ($id = 0)
                        @foreach ($subCategories as $subCate)
                            <tr>
                                <th>{{ ++$id }}</th>
                                <td>{{ $subCate->name }}</td>
                                <td>{{ $subCate->category->name }}</td>
                                <td>{{ $subCate->user->name }}</td>
                                <td>
                                    <a href="{{ route('sub_cate', ['id' => $cate->id]) }}" class="btn-action btn-edit" data-toggle="tooltip" data-placement="bottom" title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3 h-5 w-5 mr-4 hover:text-primary cursor-pointer">
                                            <path d="M12 20h9"></path>
                                            <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                                        </svg>
                                    </a>
                                    <button type="button" class="btn-action btn-del p-0" data-toggle="modal" data-target="#btn_delete_sub_cate_{{ $subCate->id }}" data-placement="bottom" title="Delete">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 h-5 w-5 hover:text-danger cursor-pointer">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                            <line x1="10" y1="11" x2="10" y2="17"></line>
                                            <line x1="14" y1="11" x2="14" y2="17"></line>
                                        </svg>
                                    </button>
                                    <div class="modal fade custom-modal" id="btn_delete_sub_cate_{{ $subCate->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalCenterTitle">Confirm dialog</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    Are you sure you want to delete this category?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary btn-cancel" data-dismiss="modal">
                                                        {{ __('Cancel') }}
                                                    </button>
                                                    <a href="{{ route('sub_cate_delete', ['id' => $subCate->id]) }}" class="btn btn-primary btn-reg">
                                                        Yes
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer text-muted">
            </div>
        </div>
    </div>
</div>
@endsection
