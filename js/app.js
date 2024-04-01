$(document).ready(function () {
  scrollToTop();
  // PHP
  $(".etui-types-card").click(function () {
    var productId = $(this).attr("product-id"); // Получить ID товара из атрибута data
    scrollToTop();
    getProductInfo(productId); // Вызвать функцию для получения информации о товаре
  });

  $(".card-info").click(function () {
    var productId = $(this).attr("product-id"); // Получить ID товара из атрибута data
    scrollToTop();
    getProductInfo(productId); // Вызвать функцию для получения информации о товаре
  });

  // Adding to the favorites list
  $(".favorite-icon").click(function () {
    var favoriteProductId = $(this).attr("data-product-id"); // Получить ID товара из атрибута data

    if ($(this).hasClass('in-favorites')) {
      removeFavorite(favoriteProductId);
    } else {
      addToFavorite(favoriteProductId);
    }
  });


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
    data: {
      productId: productId,
      index: 0
    }, // Передать ID товара на сервер
    success: function (response) {
      $("#main").html(response); // Вывести информацию о товаре на странице
    }
  });
}

function addToFavorite(favoriteProductId) {
  $.ajax({
    url: 'components/header.php',
    type: 'POST',
    data: {
      favoriteProductId: favoriteProductId
    },
    success: function (response) {
      $("#header").html(response);
    }
  });
}


function removeFavorite(removeFavoriteProductId) {
  $.ajax({
    url: 'components/header.php',
    type: 'POST',
    data: {
      removeFavoriteProductId: removeFavoriteProductId
    },
    success: function (response) {
      $("#header").html(response);
    }
  });
}



function addToCart() {
  var cartProductId = $(".product").attr("product-id");

  $.ajax({
    url: 'components/header.php',
    type: 'POST',
    data: {
      cartProductId: cartProductId
    },
    success: function (response) {
      $("#header").html(response);
    }
  });
}

function scrollToTop() {
  window.scrollTo({
    top: 0,
    behavior: 'smooth' // Для плавной прокрутки
  });
}