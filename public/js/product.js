$(document).ready(function(e) {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
    });

    $('.product__menu').on('click', 'button', function() {
        const value = $(this).attr('data-id');
        let formData = new FormData();
        formData.append('id', value);

        $.ajax({
            type: "POST",
            url: "/get-product-by-category",
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            success: function(data) {
                const { products } = data;
                $('#shop_products').html('');
                if (products.length > 0) {
                    products.forEach(product => {
                        $('#shop_products').append(`
                            <div class="col-md-3 single__pro col-lg-3 cat--1 col-sm-4 col-xs-12">
                                <div class="product foo">
                                    <div class="product__inner">
                                        <div class="pro__thumb">
                                            <a href="/product/details/${product.id}">
                                                <img class="custom_product_thumbnail" src="${product.thumbnail}" alt="product images">
                                            </a>
                                        </div>
                                        <div class="product__hover__info">
                                            <ul class="product__action">
                                                <li><a data-toggle="modal" data-target="#productModal" title="Quick View" class="quick-view modal-view detail-link" href="#"><span class="ti-plus"></span></a></li>
                                                <li><a title="Add TO Cart" href="cart.html"><span class="ti-shopping-cart"></span></a></li>
                                                <li><a title="Wishlist" href="wishlist.html"><span class="ti-heart"></span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="product__details">
                                        <h2>
                                            <a href="" style="text-transform: capitalize;">${product.name}</a>
                                        </h2>
                                        <ul class="product__price">
                                            <li class="new__price" style="padding: 0;">$${product.price}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        `);
                    });
                }
            }
        });
    })
});
