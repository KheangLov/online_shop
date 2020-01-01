const stringVal = document.getElementById('side-header').innerHTML;
const newString = stringVal.replace(/([A-Z]+)/g, " $1").replace(/([A-Z][a-z])/g, " $1");
document.getElementById('side-header').innerHTML = newString;

const btnProfileEdit = document.getElementById('btn_profile_edit');
const inpProfileEdit = document.getElementById('profile_edit');

if (btnProfileEdit)
    btnProfileEdit.addEventListener("click", () => {
        inpProfileEdit.click();
    });

$(document).ready(function () {
    $('[data-toggle="tooltip"]').tooltip();
});
