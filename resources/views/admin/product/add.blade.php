@extends('layouts.admin')

@section('content')
<div class="card card-custom bg-color">
    <div class="card-header d-flex bd-highlight">
        <h2 class="p-2 w-100 bd-highlight">Add Product</h2>
    </div>
    <div class="card-body">
        <form method="POST" action="{{ route('product_create') }}" enctype="multipart/form-data">
            @csrf
            <div class="profile-upload text-center mb-4">
                <div class="profile-overlay">
                    <div class="profile-pic" id="profile_bg_image" style="background-image: url('{{ asset('images/no-image.png') }}');"></div>
                    <button type="button" class="btn btn-primary btn-profile-upload" id="btn_profile_edit" data-toggle="tooltip" data-placement="top" title="Product thumbnail">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32px" height="32px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user w-4 h-4">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </button>
                    <input type="file" name="thumbnail" id="profile_edit" class="d-none">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="row justify-content-center">
                        <div class="form-group col-md-12">
                            <label for="name">{{ __('Name') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" required autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-12">
                            <label for="price">{{ __('Price') }}</label>
                            <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price" required>

                            @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-12">
                            <label for="condition">{{ __('Condition') }}</label>
                            <select id="condition" class="form-control" name="condition" id="exampleFormControlSelect1">
                                @foreach ($conditions as $condition)
                                    <option value="{{ strtolower($condition) }}">{{ ucfirst($condition) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="location">{{ __('Location') }}</label>
                            <select id="location" class="form-control" name="location" id="exampleFormControlSelect1">
                                @foreach ($provinces as $province)
                                    <option value="{{ strtolower($province) }}">{{ ucfirst($province) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="status">{{ __('Status') }}</label>
                            <select id="status" class="form-control" name="status" id="exampleFormControlSelect1">
                                <option value="0">Inactive</option>
                                <option value="1">Active</option>
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="category">{{ __('Category') }}</label>
                            <select id="category" class="form-control" name="category" id="exampleFormControlSelect1">
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}">{{ ucfirst($category->name) }}</option>
                                @endforeach
                            </select>
                            <a class="btn btn-link" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">
                                + add categories
                            </a>
                            <div class="collapse multi-collapse" id="multiCollapseExample1">
                                <div class="card card-body" style="background-color: #222;">
                                    <form method="POST" action="" enctype="multipart/form-data">
                                        @csrf
                                        <div class="profile-upload text-center mb-4">
                                            <div class="profile-overlay">
                                                <div class="profile-pic" id="profile_bg_image" style="background-image: url('{{ asset('images/no-image.png') }}');"></div>
                                                <button type="button" class="btn btn-primary btn-profile-upload" id="btn_profile_edit">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="32px" height="32px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user w-4 h-4">
                                                        <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                        <circle cx="12" cy="7" r="4"></circle>
                                                    </svg>
                                                </button>
                                                <input type="file" name="image" id="profile_edit" class="d-none">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="name">{{ __('Name') }}</label>
                                            <input id="name" type="text" class="form-control" name="name" required>
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
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="sub_cate">{{ __('Sub Category') }}</label>
                            <select id="sub_cate" class="form-control" name="subCategory" id="exampleFormControlSelect1">
                                @foreach ($subCategories as $subCate)
                                    <option value="{{ $subCate->id }}">{{ ucfirst($subCate->name) }}</option>
                                @endforeach
                            </select>
                            <a class="btn btn-link" data-toggle="collapse" href="#multiCollapseExample2" role="button" aria-expanded="false" aria-controls="multiCollapseExample2">
                                + add sub-categories
                            </a>
                            <div class="collapse multi-collapse" id="multiCollapseExample2">
                                <div class="card card-body" style="background-color: #222;">
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
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="description">{{ __('Description') }}</label>
                            <textarea name="description" class="form-control" id="description" cols="5" rows="3"></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-primary btn-reg">
                                {{ __('Create') }}
                            </button>
                            <a href="{{ route('user_list') }}" class="btn btn-primary btn-cancel">
                                {{ __('Cancel') }}
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col">

                </div>
            </div>
        </form>
    </div>
    <div class="card-footer">
    </div>
</div>
@endsection
