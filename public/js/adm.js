$("#sidebar .components > li > a").on("click", function() {

    // $("#sidebar .components > li > a[aria-expanded='true'] + ul").fadeOut("slow", function() {
    //     $(this).removeClass("show");
    // })
    // $("#sidebar .components > li > a[aria-expanded='true']").attr("aria-expanded",false);
});

$(document).ready(function() {
    //URL
    $("#sidebar").find(`a[href="${window.url}"]`).addClass("active");
    $("#sidebar").find(`a[href="${window.url}"]`).closest("ul").addClass("show");
    $("#sidebar").find(`a[href="${window.url}"]`).closest("ul").prev().attr("aria-expanded",true).parent().addClass("active");
    //URL

});