$(document).ready(function () {
  // PHP
  // $(".menu").click(function () {
  // 	var plik = $(this).attr("mup");
  // 	$("#strona").load(plik);
  // });

  $(".burger").click(function () {
    $(".burger-bg, .burger-menu").addClass("open");
    $("body").addClass("burger-menu-open");

    $(".burger-bg").click(function () {
      $(".burger-bg, .burger-menu").removeClass("open");
      $("body").removeClass("burger-menu-open");
    });
  });

  $(".favorite-icon").click(function () {

    if ($(this).hasClass("in-favorites")) {
      $(this).removeClass("in-favorites");
    }
    else {
      $(this).addClass("in-favorites");
    }
  });

}); 