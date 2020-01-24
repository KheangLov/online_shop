$(document).ready(function (e) {
    if (localStorage.getItem('toggle') === 'true') {
        $('#sidebar .link-text').each(function(index) {
            $(this).addClass('d-none');
        });
        $('#sidebar .inner-link').each(function(index) {
            $(this).css('padding', '10px 0');
        });
        $('#admin .main-wrapper').css({"width": "calc(100% - 65px)", "margin-left": "65px"});
        $('#sidebar').css('width', '65px');
        $('#side-header').addClass('d-none').removeClass('mb-3');
        $('#btn_side_collapse_icon').removeClass('fa-bars').addClass('fa-ellipsis-v');
        $('#sidebar .inner-link.active').css({'background-color': 'transparent', 'border-radius': '0', 'box-shadow': 'none', 'color': '#7367F0'});
        $('#loading_page').addClass('d-none');
        $('#admin').removeClass('d-none');
    }
    else if(localStorage.getItem('toggle') === 'false') {
        setTimeout(function(){
            $('#sidebar .link-text').each(function(index) {
                $(this).removeClass('d-none');
            });
        }, 200);
        $('#sidebar .inner-link').each(function(index) {
            $(this).css('padding', '');
        });
        $('#admin .main-wrapper').css({"width": "calc(100% - 260px)", "margin-left": "260px"});
        $('#sidebar').css('width', '260px');
        setTimeout(function(){
            $('#side-header').addClass('mb-3').removeClass('d-none');
        }, 200);
        $('#btn_side_collapse_icon').removeClass('fa-ellipsis-v').addClass('fa-bars');
        $('#sidebar .inner-link.active').css({'background-color': '', 'border-radius': '', 'box-shadow': '', 'color': ''});
        $('#loading_page').addClass('d-none');
        $('#admin').removeClass('d-none');
    }
    $('#images-pick').imagepicker({
        limit: 10,
        limit_reached: function() {
            alert('We are full');
        }
      });
    $('[data-toggle="tooltip"]').tooltip();
    $("#myToast").toast('show');
    $('#profile_edit').on('change', (function (e) {
        let reader = new FileReader();
        reader.onload = (e) => {
          $('#profile_bg_image').css('background-image', `url("${e.target.result}")`);
        }
        reader.readAsDataURL(this.files[0]);
    }));
    $('#upload_images').on('change', (function (e) {
        $('#submit_upload').click();
    }));
    $('#btn_side_collapse').on('click', (function (e) {
        if ($('#btn_side_collapse_icon').hasClass('fa-bars')) {
            localStorage.setItem('toggle', true);
            $('#sidebar .link-text').each(function( index ) {
                $(this).addClass('d-none');
            });
            $('#sidebar .inner-link').each(function( index ) {
                $(this).css('padding', '10px 0');
            });
            $('#admin .main-wrapper').css({"width": "calc(100% - 65px)", "margin-left": "65px"});
            $('#sidebar').css('width', '65px');
            $('#side-header').addClass('d-none').removeClass('mb-3');
            $('#btn_side_collapse_icon').removeClass('fa-bars').addClass('fa-ellipsis-v');
            $('#sidebar .inner-link.active').css({'background-color': 'transparent', 'border-radius': '0', 'box-shadow': 'none', 'color': '#7367F0'});
        }
        else {
            localStorage.setItem('toggle', false);
            setTimeout(function(){
                $('#sidebar .link-text').each(function( index ) {
                    $(this).removeClass('d-none');
                });
            }, 200);
            $('#sidebar .inner-link').each(function( index ) {
                $(this).css('padding', '');
            });
            $('#admin .main-wrapper').css({"width": "calc(100% - 260px)", "margin-left": "260px"});
            $('#sidebar').css('width', '260px');
            setTimeout(function(){
                $('#side-header').addClass('mb-3').removeClass('d-none');
            }, 200);
            $('#btn_side_collapse_icon').removeClass('fa-ellipsis-v').addClass('fa-bars');
            $('#sidebar .inner-link.active').css({'background-color': '', 'border-radius': '', 'box-shadow': '', 'color': ''});
        }
    }))
});

const stringVal = document.getElementById('side-header').innerHTML;
const newString = stringVal.replace(/([A-Z]+)/g, " $1").replace(/([A-Z][a-z])/g, " $1");
document.getElementById('side-header').innerHTML = newString;

const btnProfileEdit = document.getElementById('btn_profile_edit');
const inpProfileEdit = document.getElementById('profile_edit');

if (btnProfileEdit)
    btnProfileEdit.addEventListener("click", () => {
        inpProfileEdit.click();
    });

const btnImgsUpload = document.getElementById('btn_upload_images');
const inpImgsUpload = document.getElementById('upload_images');

if (btnImgsUpload)
    btnImgsUpload.addEventListener("click", () => {
        inpImgsUpload.click();
    });

