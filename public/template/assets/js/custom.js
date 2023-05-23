/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

"use strict";

var path = location.pathname.split("/");
var url = location.origin + "/" + path[1];

$("ul.sidebar-menu li a").each(function () {
    if ($(this).attr("href").indexOf(url) !== -1) {
        $(this)
            .parent()
            .addClass("active")
            .parent()
            .parent("li")
            .addClass("active");
    }
});

// datatable
$(document).ready(function () {
    $("#Table")
        .DataTable({
            responsive: true,
            lengthChange: true,
            paging: true,
            ordering: true,
            autoWidth: true,
            buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
        })
        .buttons()
        .container()
        .appendTo("#example1_wrapper .col-md-6:eq(0)");
    $("#ex").DataTable({
        paging: true,
        lengthChange: true,
        searching: true,
        ordering: true,
        info: true,
        autoWidth: false,
        responsive: true,
    });
});

// model confirm

function submitDel(id) {
    $("#del-" + id).submit();
}
function returnlogout() {
    var link = $("#logout").attr("href");
    $(location).attr("href", link);
}

// preview image
function previewImage() {
    const image = document.querySelector("#image");
    const imgPreview = document.querySelector(".img-preview");

    imgPreview.style.display = "block";

    const oFReader = new FileReader();
    oFReader.readAsDataURL(image.files[0]);

    oFReader.onload = function (oFREvent) {
        imgPreview.src = oFREvent.target.result;
    };
}
// for show data entries
document.getElementById("show_entries").addEventListener("change", function () {
    this.form.submit();
});
