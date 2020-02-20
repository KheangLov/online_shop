@extends('layouts.admin')

@section('content')
<a href="{{ route('pv_add') }}" class="btn btn-lg btn-secondary mb-5">
    <i class="fas fa-plus mr-1"></i>
    Add Product-Variant
</a>
<div class="card card-custom bg-color">
    <div class="card-header text-nowrap">
        <div class="row">
            <div class="col-sm-6">
                <h2 class="p-2 w-100 bd-highlight text-truncate">Product-Variant List</h2>
            </div>
            <div class="col-sm-6">
                <div class="p-2">
                    {{-- <input type="text" class="form-control" id="user_search" placeholder="Search..."> --}}
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
                        <th scope="col">Name</th>
                        <th scope="col">Color</th>
                        <th scope="col">Size</th>
                        <th scope="col">Price</th>
                        <th scope="col">Discount</th>
                        <th scope="col">Quantity</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @php($i = 0)
                    @foreach ($products as $product)
                        @foreach ($product->productVariants as $product_var)
                            <tr>
                                <th scope="row">{{ ++$i }}</th>
                                <td>{{ ucfirst($product->name) }}</td>
                                <td>{{ ucfirst($product_var->color) }}</td>
                                <td>{{ $product_var->size }}</td>
                                <td>$ {{ $product_var->price }}</td>
                                <td>% {{ $product_var->discount }}</td>
                                <td>{{ $product_var->quantity }}</td>
                                <td>
                                    <a href="{{ route('pv_edit', ['id' => $product_var->id]) }}" class="btn-action btn-edit" data-toggle="tooltip" data-placement="bottom" title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-3 h-5 w-5 mr-4 hover:text-primary cursor-pointer">
                                            <path d="M12 20h9"></path>
                                            <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                                        </svg>
                                    </a>
                                    <div class="d-inline" data-toggle="tooltip" data-placement="bottom" title="Delete">
                                        <button type="button" class="btn-action btn-del p-0" data-toggle="modal" data-target="#btn_delete_user_{{ $product_var->id }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="20px" height="20px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 h-5 w-5 hover:text-danger cursor-pointer">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                                <line x1="14" y1="11" x2="14" y2="17"></line>
                                            </svg>
                                        </button>
                                    </div>
                                    <div class="modal fade custom-modal" id="btn_delete_user_{{ $product_var->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                                    <a href="{{ route('pv_delete', ['id' => $product_var->id]) }}" class="btn btn-primary btn-reg">
                                                        Yes
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer text-muted">
    </div>
</div>
@endsection
