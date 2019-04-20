$("#sidebar .components > li > a").on("click", function() {

    // $("#sidebar .components > li > a[aria-expanded='true'] + ul").fadeOut("slow", function() {
    //     $(this).removeClass("show");
    // })
    // $("#sidebar .components > li > a[aria-expanded='true']").attr("aria-expanded",false);
});

$(document).ready(function() {
    //URL
    if($("#sidebar").find(`a[href="${window.url}"]`).data("link") == "u") {
        $("#sidebar").find(`a[href="${window.url}"]`).addClass("active");
        $("#sidebar").find(`a[href="${window.url}"]`).closest("ul").addClass("show");
        $("#sidebar").find(`a[href="${window.url}"]`).closest("ul").prev().attr("aria-expanded",true).parent().addClass("active");
    } else
        $("#sidebar").find(`a[href="${window.url}"]`).parent().addClass("active");
    //URL

});