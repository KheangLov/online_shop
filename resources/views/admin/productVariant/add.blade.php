@extends('layouts.admin')

@section('content')
@if ($message = Session::get('message'))
    <div class="toast fade alert alert-success" id="myToast" data-delay="3500" style="position: absolute; top: 1%; right: 2%; z-index: 999;">
        <div class="toast-body">
            {{ $message }}
            <button type="button" class="ml-2 mb-1 close text-white" data-dismiss="toast">&times;</button>
        </div>
    </div>
@endif
<div class="row">
    <div class="col-md-3">
        <div class="card card-custom bg-color mb-4">
            <div class="card-header">
                <h2 class="font-weight-bold p-2 w-100 m-0 text-truncate">Products</h2>
            </div>
        </div>
        @foreach ($products as $product)
            <a href="{{ route('pv_add', ['id' => $product->id]) }}" class="text-decoration-none product-to-at">
                <div class="card card-custom bg-color-light mb-3">
                    <div class="card-body d-flex">
                        <img src="{{ asset($product->thumbnail) }}" alt="{{ $product->thumbnail }}" class="img-fluid mr-3" style="width: 40px; height: 40px; border-radius: 25%; border: 2px solid #fff;">
                        <div class="align-middle text-truncate">
                            <h5 class="w-100 m-0 p-0" data-toggle="tooltip" data-placement="top" title="{{ ucfirst($product->name) }}">
                                {{ ucfirst($product->name) }}
                            </h5>
                            <span class="text-muted">{{ ucfirst($product->category->name) }}</span>
                        </div>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
    <div class="col-md-9">
        <div class="card card-custom bg-color">
            <div class="card-header d-flex bd-highlight">
                <h2 class="p-2 w-100 bd-highlight text-nowrap">Add Product-Variant</h2>
            </div>
            <div class="card-body">
                @if ($message = Session::get('success'))
                    <div class="toast fade alert alert-success" id="myToast" data-delay="3500" style="position: absolute; top: 1%; right: 2%; z-index: 999;">
                        <div class="toast-body">
                            {{ $message }}
                            <button type="button" class="ml-2 mb-1 close text-white" data-dismiss="toast">&times;</button>
                        </div>
                    </div>
                @endif
                @if ($message = Session::get('error'))
                    <div class="toast fade alert alert-danger" id="myToast" data-delay="3500" style="position: absolute; top: 1%; right: 2%; z-index: 999;">
                        <div class="toast-body">
                            {{ $message }}
                            <button type="button" class="ml-2 mb-1 close text-white" data-dismiss="toast">&times;</button>
                        </div>
                    </div>
                @endif
                <form method="POST" action="{{ route('pv_create') }}">
                    @csrf
                    <div class="row justify-content-center">
                        <div class="form-group col-md-7">
                            <input type="hidden" name="product_id" value="{{ !empty($id) ? $id : '' }}">
                            <label for="color">{{ __('Color') }}</label>
                            <input id="color" name="color" type="text" class="form-control">
                        </div>
                        <div class="form-group col-md-7">
                            <label for="size">{{ __('Size') }}</label>
                            <input id="size" name="size" type="text" class="form-control">
                        </div>
                        <div class="form-group col-md-7">
                            <label for="price">{{ __('Price') }}</label>
                            <input id="price" name="price" type="number" class="form-control">
                        </div>
                        <div class="form-group col-md-7">
                            <label for="discount">{{ __('Discount') }}</label>
                            <input id="discount" name="discount" type="number" class="form-control">
                        </div>
                        <div class="form-group col-md-7">
                            <label for="quantity">{{ __('Quantity') }}</label>
                            <input id="quantity" name="quantity" type="number" class="form-control">
                        </div>
                        <div class="form-group col-md-7">
                            <button type="submit" class="btn btn-primary btn-reg">
                                {{ __('Create') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="card-footer">
            </div>
        </div>
    </div>
</div>
@endsection
