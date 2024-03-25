$(document).ready(function () {
  // PHP
  $(".etui-types-card").click(function () {
    var productId = $(this).attr("product-id"); // Получить ID товара из атрибута data
    var productName = $(this).attr("product-name"); // Получить ID товара из атрибута data
    scrollToTop();
    getProductInfo(productId, productName); // Вызвать функцию для получения информации о товаре
  });

  $(".card").click(function () {
    var productId = $(this).attr("product-id"); // Получить ID товара из атрибута data
    var productName = $(this).attr("product-name"); // Получить ID товара из атрибута data
    scrollToTop();
    getProductInfo(productId, productName); // Вызвать функцию для получения информации о товаре
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


function getProductInfo(productId, productName) {
  $.ajax({
    url: 'components/pages/product.php', // Путь к PHP-скрипту для получения информации о товаре
    type: 'POST',
    data: {
      productId: productId,
      index: 0
    }, // Передать ID товара на сервер
    success: function (response) {
      $("#main").html(response); // Вывести информацию о товаре на странице
    }
  });
}


function scrollToTop() {
  window.scrollTo({
    top: 0,
    behavior: 'smooth' // Для плавной прокрутки
  });
}