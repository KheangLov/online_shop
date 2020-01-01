@extends('layouts.admin')

@section('content')
<div class="card card-custom bg-color">
    <div class="card-header d-flex bd-highlight">
        <h2 class="p-2 w-100 bd-highlight">Add Product</h2>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('product_create') }}" enctype="multipart/form-data">
            @csrf
            <div class="row justify-content-center">
                <div class="form-group col-md-7">
                    <label for="name">{{ __('Name') }}</label>
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" required autofocus>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group col-md-7">
                    <label for="price">{{ __('Price') }}</label>
                    <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price" required>

                    @error('price')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-group col-md-7">
                    <label for="condition">{{ __('Condition') }}</label>
                    <select id="condition" class="form-control" name="condition" id="exampleFormControlSelect1">
                        <option value="new">New</option>
                        <option value="old">Old</option>
                        <option value="medium">Medium</option>
                    </select>
                </div>
                <div class="form-group col-md-7">
                    <label for="location">{{ __('Location') }}</label>
                    <select id="location" class="form-control" name="location" id="exampleFormControlSelect1">
                        <option value="phnom penh">Phnom Penh</option>
                        <option value="Siem Reap">Siem Reap</option>
                    </select>
                </div>
                <div class="form-group col-md-7">
                    <label for="status">{{ __('Status') }}</label>
                    <select id="status" class="form-control" name="status" id="exampleFormControlSelect1">
                        <option value="0">Inactive</option>
                        <option value="1">Active</option>
                    </select>
                </div>
                <div class="form-group col-md-7">
                    <label for="category">{{ __('Category') }}</label>
                    <select id="category" class="form-control" name="category" id="exampleFormControlSelect1">
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ ucfirst($category->name) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-7">
                    <label for="sub_cate">{{ __('Sub Category') }}</label>
                    <select id="sub_cate" class="form-control" name="subCategory" id="exampleFormControlSelect1">
                        @foreach ($subCategories as $subCate)
                            <option value="{{ $subCate->id }}">{{ ucfirst($subCate->name) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-md-7">
                    <label for="thumbnail">{{ __('Thumbnail') }}</label>
                    <input type="file" name="thumbnail" class="form-control" id="thumbnail">
                </div>
                <div class="form-group col-md-7">
                    <label for="description">{{ __('Description') }}</label>
                    <textarea name="description" class="form-control" id="description" cols="5" rows="3"></textarea>
                </div>
                <div class="form-group col-md-7">
                    <button type="submit" class="btn btn-primary btn-reg">
                        {{ __('Create') }}
                    </button>
                    <a href="{{ route('user_list') }}" class="btn btn-primary btn-cancel">
                        {{ __('Cancel') }}
                    </a>
                </div>
            </div>
        </form>
    </div>
    <div class="card-footer">
    </div>
</div>
@endsection
