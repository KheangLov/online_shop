@extends('layouts.admin')

@section('content')
<a href="{{ route('product_add') }}" class="btn btn-lg btn-secondary mb-5">
    <i class="fas fa-plus mr-1"></i>
    Add Product
</a>
<a href="{{ route('images') }}" class="btn btn-lg btn-secondary mb-5">
    <i class="fas fa-plus mr-1"></i>
    Upload photo
</a>
<div class="card card-custom bg-color">
    <div class="card-header text-nowrap">
        <div class="row">
            <div class="col-sm-6">
                <h2 class="p-2 w-100 bd-highlight text-truncate">Product List</h2>
            </div>
            <div class="col-sm-6">
                <div class="p-2">
                    {{-- <input type="text" class="form-control" placeholder="Search..."> --}}
                </div>
            </div>
        </div>
    </div>
    <div class="card-body">
        @if ($message = Session::get('message'))
            <div class="alert alert-success" role="alert">
                {{ $message }}
            </div>
        @endif
        <div class="table-responsive-xl">
            <table class="table custom-table text-nowrap text-truncate">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Image</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Discount</th>
                        <th scope="col">Location</th>
                        <th scope="col">Category</th>
                        <th scope="col">Sub-Category</th>
                        <th scope="col">User</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php ($i = 0)
                    @foreach ($posts as $post)
                        <tr>
                            <th>{{ ++$i }}</th>
                            <td>
                                <img src="{{ asset($post->thumbnail) }}" alt="{{ $post->thumbnail }}" class="img-fluid" style="width: 35px; height: 35px; border-radius: 25%; border: 2px solid #fff;">
                            </td>
                            <td>{{ $post->name }}</td>
                            <td>$ {{ $post->price }}</td>
                            <td>% {{ $post->discount }}</td>
                            <td>{{ $post->location }}</td>
                            <td>{{ $post->category->name }}</td>
                            <td>{{ $post->subCategory->name }}</td>
                            <td>{{ $post->user->name }}</td>
                            <td>
                                @if (Auth::user()->id === $post->user->id)
                                    <a href="{{ route('product_edit', ['id' => $post->id]) }}" class="btn-action btn-edit" data-toggle="tooltip" data-placement="bottom" title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3 h-5 w-5 mr-4 hover:text-primary cursor-pointer">
                                            <path d="M12 20h9"></path>
                                            <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                                        </svg>
                                    </a>
                                    <button type="button" class="btn-action btn-del p-0" data-toggle="modal" data-target="#btn_delete_product_{{ $post->id }}" data-placement="bottom" title="Delete">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 h-5 w-5 hover:text-danger cursor-pointer">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                            <line x1="10" y1="11" x2="10" y2="17"></line>
                                            <line x1="14" y1="11" x2="14" y2="17"></line>
                                        </svg>
                                    </button>
                                    <div class="modal fade custom-modal" id="btn_delete_product_{{ $post->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                                    <a href="{{ route('product_delete', ['id' => $post->id]) }}" class="btn btn-primary btn-reg">
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
    </div>
</div>
@endsection
