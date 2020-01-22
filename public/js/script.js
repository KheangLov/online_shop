$(document).ready(function (e) {
    $('[data-toggle="tooltip"]').tooltip();
    $('#profile_edit').on('change', (function (e) {
        let reader = new FileReader();
        reader.onload = (e) => {
          $('#profile_bg_image').css('background-image', `url("${e.target.result}")`);
        }
        reader.readAsDataURL(this.files[0]);
    }));
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
