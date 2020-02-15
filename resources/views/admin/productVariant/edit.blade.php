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
<div class="card card-custom bg-color">
    <div class="card-header d-flex bd-highlight">
        <h2 class="p-2 w-100 bd-highlight text-nowrap">Edit Product-Variant</h2>
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
        <form method="POST" action="{{ route('pv_update', ['id' => $productVar->id]) }}">
            @method('PUT')
            @csrf
            <div class="row justify-content-center">
                <div class="form-group col-md-7">
                    <input type="hidden" name="product_id" value="{{ $productVar->post_id }}">
                    <label for="color">{{ __('Color') }}</label>
                    <input id="color" name="color" type="text" class="form-control" value="{{ $productVar->color }}">
                </div>
                <div class="form-group col-md-7">
                    <label for="size">{{ __('Size') }}</label>
                    <input id="size" name="size" type="text" class="form-control" value="{{ $productVar->size }}">
                </div>
                <div class="form-group col-md-7">
                    <label for="price">{{ __('Price') }}</label>
                    <input id="price" name="price" type="number" class="form-control" value="{{ $productVar->price }}">
                </div>
                <div class="form-group col-md-7">
                    <label for="discount">{{ __('Discount') }}</label>
                    <input id="discount" name="discount" type="number" class="form-control" value="{{ $productVar->discount }}">
                </div>
                <div class="form-group col-md-7">
                    <label for="quantity">{{ __('Quantity') }}</label>
                    <input id="quantity" name="quantity" type="number" class="form-control" value="{{ $productVar->quantity }}">
                </div>
                <div class="form-group col-md-7">
                    <button type="submit" class="btn btn-primary btn-reg">
                        {{ __('Update') }}
                    </button>
                </div>
            </div>
        </form>
    </div>
    <div class="card-footer">
    </div>
</div>
@endsection
