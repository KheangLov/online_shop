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
                                        <input id="cate_name" type="text" class="form-control" name="cate_name" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="description">{{ __('Description') }}</label>
                                        <textarea id="cate_description" cols="5" rows="3" class="form-control" name="cate_description"></textarea>
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
                                    <div class="form-group">
                                        <label for="name">{{ __('Name') }}</label>
                                        <input id="sub_cate_name" type="text" class="form-control" name="sub_cate_name" required>
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
                                        <button type="submit" class="btn btn-primary btn-reg">
                                            {{ __('Create') }}
                                        </button>
                                    </div>
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
                    <div class="row justify-content-center">
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
                                                    <option data-img-src="{{ asset($img->path) }}" data-img-alt="{{ $img->name }}" value="{{ $img->id }}"></option>
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
                        <div class="form-group col-md-12">
                            <label for="product_variants">{{ __('Product Variants') }}</label>
                            <button type="button" class="d-block btn btn-link mb-4">
                                <i class="fas fa-plus mr-1"></i>
                                Add Product Variant
                            </button>
                            <div class="accordion" id="accordionExample">
                                <div class="card" style="background-color: #222;">
                                    <div class="card-header p-0" id="headingOne">
                                        <button class="btn btn-link btn-block" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                            Collapsible Group Item #1
                                        </button>
                                    </div>

                                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
                                        <div class="card-body">
                                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                        </div>
                                    </div>
                                </div>
                                <div class="card" style="background-color: #222;">
                                    <div class="card-header p-0" id="headingTwo">
                                        <button class="btn btn-link btn-block" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                            Collapsible Group Item #2
                                        </button>
                                    </div>
                                    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
                                        <div class="card-body">
                                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod. Brunch 3 wolf moon tempor, sunt aliqua put a bird on it squid single-origin coffee nulla assumenda shoreditch et. Nihil anim keffiyeh helvetica, craft beer labore wes anderson cred nesciunt sapiente ea proident. Ad vegan excepteur butcher vice lomo. Leggings occaecat craft beer farm-to-table, raw denim aesthetic synth nesciunt you probably haven't heard of them accusamus labore sustainable VHS.
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
