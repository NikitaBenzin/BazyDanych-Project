$(document).ready(function () {
  // PHP
  $(".etui-types-card").click(function () {
    var productId = $(this).attr("product-id"); // Получить ID товара из атрибута data
    getProductInfo(productId); // Вызвать функцию для получения информации о товаре
  });


  // VISUAL
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


function getProductInfo(productId) {
  $.ajax({
    url: 'components/pages/product.php', // Путь к PHP-скрипту для получения информации о товаре
    type: 'POST',
    data: { productId: productId }, // Передать ID товара на сервер
    success: function (response) {
      $("#main").html(response); // Вывести информацию о товаре на странице
    }
  });
}