@extends('layouts.admin')

@section('content')
<form method="POST" action="{{ route('product_update', ['id' => $product->id]) }}" enctype="multipart/form-data">
    @method('PUT')
    @csrf
    <div class="card card-custom bg-color">
        <div class="card-header d-flex bd-highlight">
            <h2 class="p-2 w-100 bd-highlight">Edit Product</h2>
        </div>
        <div class="card-body">
            <div class="profile-upload text-center mb-4">
                <div class="profile-overlay">
                    <div class="profile-pic" id="profile_bg_image" style="background-image: url('{{ asset($product->thumbnail ? $product->thumbnail : 'images/no-image.png') }}');"></div>
                    <button type="button" class="btn btn-primary btn-profile-upload" id="btn_profile_edit" data-toggle="tooltip" data-placement="top" title="Product thumbnail">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32px" height="32px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user w-4 h-4">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                    </button>
                    <input type="file" name="thumbnail" id="profile_edit" class="d-none" value="{{ asset($product->thumbnail) }}">
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="row justify-content-center">
                        <div class="form-group col-md-12">
                            <label for="name">{{ __('Name') }}</label>
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $product->name }}" required autofocus>
                            @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-12">
                            <label for="price">{{ __('Price') }}</label>
                            <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ $product->price }}" required>

                            @error('price')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group col-md-12">
                            <label for="condition">{{ __('Condition') }}</label>
                            <select id="condition" class="form-control" name="condition">
                                @foreach ($conditions as $condition)
                                    <option value="{{ strtolower($condition) }}"{{ strtolower($product->condition) === strtolower($condition) ? ' selected' : '' }}>{{ ucfirst($condition) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="location">{{ __('Location') }}</label>
                            <select id="location" class="form-control" name="location">
                                @foreach ($provinces as $province)
                                    <option value="{{ strtolower($province) }}"{{ strtolower($product->province) === strtolower($province) ? ' selected' : '' }}>{{ ucfirst($province) }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="status">{{ __('Status') }}</label>
                            <select id="status" class="form-control" name="status">
                                <option value="0"{{ $product->status == 0 ? ' selected' : '' }}>Inactive</option>
                                <option value="1"{{ $product->status == 1 ? ' selected' : '' }}>Active</option>
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="description">{{ __('Description') }}</label>
                            <textarea name="description" class="form-control" id="description" cols="5" rows="3">{{ $product->description }}</textarea>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="row justify-content-center">
                        <div class="form-group col-md-12">
                            <label for="category">{{ __('Category') }}</label>
                            <select id="category" class="form-control" name="category">
                                <option value="0">Select any category</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"{{ $product->category_id === $category->id ? ' selected' : '' }}>{{ ucfirst($category->name) }}</option>
                                @endforeach
                            </select>
                            <a class="btn btn-link" data-toggle="collapse" href="#multiCollapseExample1" role="button" aria-expanded="false" aria-controls="multiCollapseExample1">
                                + add categories
                            </a>
                            <div class="collapse multi-collapse" id="multiCollapseExample1">
                                <div class="card card-body" style="background-color: #222;">
                                    <div class="profile-upload text-center mb-4">
                                        <div class="profile-overlay">
                                            <div class="profile-pic" id="category_img" style="background-image: url('{{ asset('images/no-image.png') }}');"></div>
                                            <button type="button" class="btn btn-primary btn-profile-upload" id="btn_category_image">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="32px" height="32px" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-user w-4 h-4">
                                                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                    <circle cx="12" cy="7" r="4"></circle>
                                                </svg>
                                            </button>
                                            <input type="file" name="cate_image" id="category_image" class="d-none">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">{{ __('Name') }}</label>
                                        <input id="cate_name" type="text" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label for="description">{{ __('Description') }}</label>
                                        <textarea id="cate_description" cols="5" rows="3" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button type="button" id="procate_submit" class="btn btn-primary btn-reg">
                                            {{ __('Create') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="sub_cate">{{ __('Sub Category') }}</label>
                            <select id="sub_cate" class="form-control" name="subCategory">
                                <option value="0">Select any sub-category</option>
                                @foreach ($subCategories as $subCate)
                                    <option value="{{ $subCate->id }}"{{ $product->sub_category_id === $subCate->id ? ' selected' : '' }}>{{ ucfirst($subCate->name) }}</option>
                                @endforeach
                            </select>
                            <a class="btn btn-link" data-toggle="collapse" href="#multiCollapseExample2" role="button" aria-expanded="false" aria-controls="multiCollapseExample2">
                                + add sub-categories
                            </a>
                            <div class="collapse multi-collapse" id="multiCollapseExample2">
                                <div class="card card-body" style="background-color: #222;">
                                    <div class="form-group">
                                        <label for="name">{{ __('Name') }}</label>
                                        <input id="sub_cate_name" type="text" class="form-control" name="sub_cate_name">
                                    </div>
                                    <div class="form-group">
                                        <label for="category">{{ __('Category') }}</label>
                                        <select name="sub_cate_category" id="sub_cate_category" class="form-control">
                                            @foreach ($categories as $cate)
                                                <option value="{{ $cate->id }}">{{ ucfirst($cate->name) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">{{ __('Description') }}</label>
                                        <textarea id="sub_cate_description" cols="5" rows="3" class="form-control" name="sub_cate_description"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <button type="button" class="btn btn-primary btn-reg" id="pro_subcate_submit">
                                            {{ __('Create') }}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="images">{{ __('Images') }}</label>
                            <button type="button" class="d-block btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-xl">
                                Open gallery
                            </button>

                            <div class="modal custom-modal fade bd-example-modal-xl w-100" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl w-100" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="exampleModalLongTitle">Product Images</h4>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="file" name="images[]" id="upload_images" class="d-none" multiple>
                                        <button type="button" id="btn_upload_images" class="btn btn-primary mb-3 font-weight-bold">
                                            <i class="fas fa-camera mb-2"></i>
                                            Upload Image
                                        </button>
                                        @if (!empty($images))
                                            <select id="images-pick" class="image-picker show-html" multiple="multiple" data-limit="5">
                                                @foreach ($images as $img)
                                                    <option data-img-src="{{ asset($img->path) }}" data-img-alt="{{ $img->name }}" value="{{ $img->id }}"{{ $img->post_id === $product->id ? ' selected' : '' }}></option>
                                                @endforeach
                                            </select>
                                        @endif
                                    </div>
                                    <div class="modal-footer d-flex" id="product_image_model_footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary" id="btn_choose_imgs" data-dismiss="modal">Choose</button>
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <div class="form-group col-md-12">
                <button type="submit" class="btn btn-primary btn-reg">
                    {{ __('Update') }}
                </button>
                <a href="{{ route('user_list') }}" class="btn btn-primary btn-cancel">
                    {{ __('Cancel') }}
                </a>
            </div>
        </div>
    </div>
</form>
@endsection
