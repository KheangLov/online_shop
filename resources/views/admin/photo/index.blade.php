@extends('layouts.admin')

@section('content')
<div class="card card-custom bg-color">
    <div class="card-header">
        <h4 class="modal-title" id="exampleModalLongTitle">Product Images</h4>
    </div>
    <div class="card-body">
        <input type="file" name="images[]" id="upload_images" class="d-none" multiple>
        <button type="button" id="btn_upload_images" class="btn btn-primary mb-3 font-weight-bold">
            <i class="fas fa-camera mb-2"></i>
            Upload Image
        </button>
        @if (!empty($images))
            <select id="images-pick" class="image-picker show-html" multiple="multiple" data-limit="4">
                @foreach ($images as $img)
                    <option data-img-src="{{ asset($img->path) }}" data-img-alt="{{ $img->name }}" value="{{ $img->id }}"></option>
                @endforeach
            </select>
        @endif
        <div id="product_image_model_footer">
        </div>
    </div>
    <div class="card-footer">
        
    </div>
</div>
@endsection
