$(document).ready(function(e) {
    const checkWidth = function() {
        if ($(document).width() < 1196) {
            $('#btn_side_collapse').addClass('d-none');
            $("#sidebar .link-text").each(function() {
                $(this).addClass("d-none");
            });
            $("#sidebar .inner-link").each(function() {
                $(this).css("padding", "10px 0");
            });
            $("#admin .main-wrapper").css({
                width: "calc(100% - 65px)",
                "margin-left": "65px"
            });
            $("#sidebar").css("width", "65px");
            $("#sidebar .sidebar-link").each(function() {
                const title = $(this)
                    .children(".inner-link")
                    .text()
                    .trim();
                $(this).attr({
                    "data-toggle": "tooltip",
                    "data-placement": "right",
                    title: title,
                    "data-original-title": title
                });
            });
            $("#side-header")
                .addClass("d-none")
                .removeClass("mb-3");
            $("#btn_side_collapse_icon")
                .removeClass("fa-bars")
                .addClass("fa-ellipsis-v");
            $("#sidebar .inner-link.active").css({
                "background-color": "transparent",
                "border-radius": "0",
                "box-shadow": "none",
                color: "#7367F0"
            });
        } else {
            $('#btn_side_collapse').removeClass('d-none');
            setTimeout(function() {
                $("#sidebar .link-text").each(function() {
                    $(this).removeClass("d-none");
                });
            }, 200);
            $("#sidebar .inner-link").each(function() {
                $(this).css("padding", "");
            });
            $("#admin .main-wrapper").css({
                width: "calc(100% - 260px)",
                "margin-left": "260px"
            });
            $("#sidebar").css("width", "260px");
            setTimeout(function() {
                $("#side-header")
                    .addClass("mb-3")
                    .removeClass("d-none");
            }, 200);
            $("#sidebar .sidebar-link").each(function() {
                $(this).attr({
                    "data-toggle": "",
                    "data-placement": "",
                    title: "",
                    "data-original-title": ""
                });
            });
            $("#btn_side_collapse_icon")
                .removeClass("fa-ellipsis-v")
                .addClass("fa-bars");
            $("#sidebar .inner-link.active").css({
                "background-color": "",
                "border-radius": "",
                "box-shadow": "",
                color: ""
            });
        }
    };
    $(window).resize(checkWidth);

    checkWidth();

    setTimeout(function() {
        if (localStorage.getItem("toggle") === "true") {
            $("#sidebar .link-text").each(function(index) {
                $(this).addClass("d-none");
            });
            $("#sidebar .inner-link").each(function(index) {
                $(this).css("padding", "10px 0");
            });
            $("#admin .main-wrapper").css({
                width: "calc(100% - 65px)",
                "margin-left": "65px"
            });
            $("#sidebar").css("width", "65px");
            $("#side-header")
                .addClass("d-none")
                .removeClass("mb-3");
            $("#btn_side_collapse_icon")
                .removeClass("fa-bars")
                .addClass("fa-ellipsis-v");
            $("#sidebar .sidebar-link").each(function() {
                const title = $(this)
                    .children(".inner-link")
                    .text()
                    .trim();
                $(this).attr({
                    "data-toggle": "tooltip",
                    "data-placement": "right",
                    title: title,
                    "data-original-title": title
                });
            });
            $("#sidebar .inner-link.active").css({
                "background-color": "transparent",
                "border-radius": "0",
                "box-shadow": "none",
                color: "#7367F0"
            });
            $("#loading_page").addClass("d-none");
            $("#admin").removeClass("d-none");
        } else {
            setTimeout(function() {
                $("#sidebar .link-text").each(function(index) {
                    $(this).removeClass("d-none");
                });
            }, 200);
            $("#sidebar .inner-link").each(function(index) {
                $(this).css("padding", "");
            });
            $("#admin .main-wrapper").css({
                width: "calc(100% - 260px)",
                "margin-left": "260px"
            });
            $("#sidebar").css("width", "260px");
            setTimeout(function() {
                $("#side-header")
                    .addClass("mb-3")
                    .removeClass("d-none");
            }, 200);
            $("#btn_side_collapse_icon")
                .removeClass("fa-ellipsis-v")
                .addClass("fa-bars");
            $("#sidebar .sidebar-link").each(function() {
                $(this).attr({
                    "data-toggle": "",
                    "data-placement": "",
                    title: "",
                    "data-original-title": ""
                });
            });
            $("#sidebar .inner-link.active").css({
                "background-color": "",
                "border-radius": "",
                "box-shadow": "",
                color: ""
            });
            $("#loading_page").addClass("d-none");
            $("#admin").removeClass("d-none");
        }
        $('[data-toggle="tooltip"]').tooltip();
    }, 1500);

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
        }
    });

    const imagePickerMethod = function() {
        $("#images-pick").imagepicker({
            limit_reached: function() {
                alert("We are full!");
            },
            changed: function(select, newValues) {
                console.log(newValues);
                if (newValues.length > 0 && !$('#btn_delete_imgs').length) {
                    $('#product_image_model_footer').prepend(`
                        <button type="button" class="btn btn-danger mr-auto" id="btn_delete_imgs" data-toggle="modal" data-target="#confirm_delete_images">Delete</button>
                        <div class="modal fade bd-example-modal-sm" id="confirm_delete_images" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalCenterTitle">Confirm dialog</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        Are you sure you want to delete?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
                                        <button type="button" class="btn btn-primary" data-dismiss="modal" id="btn_confirm_delete_images">Yes</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    `);
                    $('#btn_confirm_delete_images').click(function() {
                        let formData = new FormData();
                        $.each($("#images-pick").data("picker").selected_values(), function(index, val) {
                            formData.append('files_id[]', val);
                        });

                        $.ajax({
                            type: "POST",
                            url: "/admin/images/delete",
                            data: formData,
                            processData: false,
                            contentType: false,
                            cache: false,
                            success: function(data) {
                                const { deletedRows, success } = data;
                                $('#btn_upload_images').after(
                                    `<div class="alert alert-success alert-dismissible fade show" role="alert">
                                        ${success}
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>`
                                );
                                $.each(deletedRows, function(index, val) {
                                    $(`#images-pick option[value=${val.id}]`).remove();
                                    $(`.thumbnails.image_picker_selector li .thumbnail.selected .image_picker_image[alt="${val.name}"]`).closest('li').remove();
                                });
                            }
                        });
                    });
                }
                else if (newValues.length <= 0) $('#btn_delete_imgs').remove();
            }
        });
    };

    imagePickerMethod();

    $("#btn_choose_imgs").click(function() {
        const images = $("#images-pick")
            .data("picker")
            .selected_values();
        $('#images_choosed').val(JSON.stringify(images));
        console.log(
            $("#images-pick")
                .data("picker")
                .selected_values()
        );
    });

    $("#myToast").toast("show");

    $("#profile_edit").on("change", function(e) {
        let reader = new FileReader();
        reader.onload = e => {
            $("#profile_bg_image").css(
                "background-image",
                `url("${e.target.result}")`
            );
        };
        reader.readAsDataURL(this.files[0]);
    });

    $("#category_image").on("change", function(e) {
        let reader = new FileReader();
        reader.onload = e => {
            $("#category_img").css(
                "background-image",
                `url("${e.target.result}")`
            );
        };
        reader.readAsDataURL(this.files[0]);
    });

    $("#procate_submit").on("click", function(e) {
        let image = "";
        if ($("#category_image").prop("files").length > 0) {
            image = $("#category_image").prop("files");
        }

        const name = $("#cate_name").val();
        const desc = $("#cate_description").val();
        let formData = new FormData();
        if (image) formData.append("image", image[0]);
        formData.append("name", name);
        formData.append("description", desc);

        $.ajax({
            type: "POST",
            url: "/admin/product/category",
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            enctype: "multipart/form-data",
            success: function(data) {
                alert(data.success);
                const { name, id } = data.cate;
                $('#category').append(`<option value="${id}">${name}</option>`);
                $('#sub_cate_category').append(`<option value="${id}">${name}</option>`)
            }
        });
    });

    $("#pro_subcate_submit").on("click", function(e) {
        const name = $("#sub_cate_name").val();
        const categoryId = $('#sub_cate_category').val();
        const desc = $("#sub_cate_description").val();

        let formData = new FormData();
        formData.append("name", name);
        formData.append("category_id", categoryId);
        formData.append("description", desc);

        $.ajax({
            type: "POST",
            url: "/admin/product/sub-category",
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            enctype: "multipart/form-data",
            success: function(data) {
                alert(data.success);
                const { name, id } = data.subCate;
                $('#sub_cate').append(`<option value="${id}">${name}</option>`);
            }
        });
    });

    $("#upload_images").on("change", function(e) {
        const images = $("#upload_images").prop("files");
        let formData = new FormData();
        $.each(images, function(index, val) {
            formData.append('images[]', val)
        });
        $.ajax({
            type: "POST",
            url: "/admin/images/upload",
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            enctype: "multipart/form-data",
            success: function(data) {
                const { images, success } = data;
                $('#btn_upload_images').after(
                    `<div class="alert alert-success alert-dismissible fade show" role="alert">
                        ${success}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>`
                );
                $.each(images, function(index, val) {
                    $('#images-pick').prepend(`<option data-img-src="//localhost:3000/${val.path}" data-img-alt="${val.name}" value="${val.id}"></option>`);
                    $('.thumbnails.image_picker_selector').prepend(`
                        <li>
                            <div class="thumbnail">
                                <img class="image_picker_image" src="//localhost:3000/${val.path}" alt="${val.name}">
                            </div>
                        </li>
                    `);
                });
                imagePickerMethod();
            }
        });
    });

    $("#btn_side_collapse").on("click", function(e) {
        if ($("#btn_side_collapse_icon").hasClass("fa-bars")) {
            localStorage.setItem("toggle", true);
            $("#sidebar .link-text").each(function() {
                $(this).addClass("d-none");
            });
            $("#sidebar .inner-link").each(function() {
                $(this).css("padding", "10px 0");
            });
            $("#admin .main-wrapper").css({
                width: "calc(100% - 65px)",
                "margin-left": "65px"
            });
            $("#sidebar").css("width", "65px");
            $("#sidebar .sidebar-link").each(function() {
                const title = $(this)
                    .children(".inner-link")
                    .text()
                    .trim();
                $(this).attr({
                    "data-toggle": "tooltip",
                    "data-placement": "right",
                    title: title,
                    "data-original-title": title
                });
            });
            $("#side-header")
                .addClass("d-none")
                .removeClass("mb-3");
            $("#btn_side_collapse_icon")
                .removeClass("fa-bars")
                .addClass("fa-ellipsis-v");
            $("#sidebar .inner-link.active").css({
                "background-color": "transparent",
                "border-radius": "0",
                "box-shadow": "none",
                color: "#7367F0"
            });
        } else {
            localStorage.setItem("toggle", false);
            setTimeout(function() {
                $("#sidebar .link-text").each(function() {
                    $(this).removeClass("d-none");
                });
            }, 200);
            $("#sidebar .inner-link").each(function() {
                $(this).css("padding", "");
            });
            $("#admin .main-wrapper").css({
                width: "calc(100% - 260px)",
                "margin-left": "260px"
            });
            $("#sidebar").css("width", "260px");
            setTimeout(function() {
                $("#side-header")
                    .addClass("mb-3")
                    .removeClass("d-none");
            }, 200);
            $("#sidebar .sidebar-link").each(function() {
                $(this).attr({
                    "data-toggle": "",
                    "data-placement": "",
                    title: "",
                    "data-original-title": ""
                });
            });
            $("#btn_side_collapse_icon")
                .removeClass("fa-ellipsis-v")
                .addClass("fa-bars");
            $("#sidebar .inner-link.active").css({
                "background-color": "",
                "border-radius": "",
                "box-shadow": "",
                color: ""
            });
        }
    });

    $('#btn_submit_pv').on('click', function(e) {
        const productId = $('#pv_product_id').val();
        const color = $('#pv_color').val();
        const size = $('#pv_size').val();
        const price = $('#pv_price').val();
        const discount = $('#pv_discount').val();
        const qty = $('#pv_quantity').val();

        let formData = new FormData();
        formData.append('product_id', productId);
        formData.append('color', color);
        formData.append('size', size);
        formData.append('price', price);
        formData.append('discount', discount);
        formData.append('quantity', qty);

        $.ajax({
            type: "POST",
            url: "/admin/product-variant/create",
            data: formData,
            processData: false,
            contentType: false,
            cache: false,
            enctype: "multipart/form-data",
            success: function(data) {
                // $('#accordionExample')
                alert('Success: ', data);
            }
        });
    });
});

const stringVal = document.getElementById("side-header").innerHTML;
const newString = stringVal
    .replace(/([A-Z]+)/g, " $1")
    .replace(/([A-Z][a-z])/g, " $1");
document.getElementById("side-header").innerHTML = newString;

const btnProfileEdit = document.getElementById("btn_profile_edit");
const inpProfileEdit = document.getElementById("profile_edit");

if (btnProfileEdit)
    btnProfileEdit.addEventListener("click", () => {
        inpProfileEdit.click();
    });

const btnImgsUpload = document.getElementById("btn_upload_images");
const inpImgsUpload = document.getElementById("upload_images");

if (btnImgsUpload)
    btnImgsUpload.addEventListener("click", () => {
        inpImgsUpload.click();
    });

const btnCateImg = document.getElementById("btn_category_image");
const inpCateImg = document.getElementById("category_image");
const asdsad = document.getElementById('asdsad');

if (btnCateImg)
    btnCateImg.addEventListener("click", () => {
        inpCateImg.click();
    });

const footerYear = document.getElementById('cpyr_year');
if (footerYear) {
    const current_date = new Date()
    const cmm = current_date.getFullYear()
    footerYear.innerText = cmm;
}
