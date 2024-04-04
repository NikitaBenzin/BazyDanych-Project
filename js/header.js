$(document).ready(function () {
  $('.nav-favorite').click(function () {
    var page = $(this).attr("page");
    $("#main").load(page);

    $(".burger-bg, .burger-menu").removeClass("open");
    $("body").removeClass("burger-menu-open");
  });

  $('.nav-cart').click(function () {
    var page = $(this).attr("page");
    $("#main").load(page);

    $(".burger-bg, .burger-menu").removeClass("open");
    $("body").removeClass("burger-menu-open");

  });

});