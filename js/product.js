$(document).ready(function () {
  $(".slide-btn").click(function () {
    $(".slide-info").toggle("linear");
  });

  $(".back-btn").click(function () {
    window.location.replace("/");
  });

  window.addEventListener("popstate", function (event) {
    window.location.replace("/");
  });

  $("#small-images > a").click(function (event) {
    event.preventDefault();
    $("#big").attr("src", this.href);
    $("#small-images > a").removeClass("small-image-active");
    $(this).addClass("small-image-active");
  });



  var url = $(".card-info-name").text().replace(/ /g, "-");

  var newURL = `${url}`;

  var newStateTitle = "Product";

  var stateData = $('.product').attr('id');

  history.pushState(stateData, newStateTitle, newURL);

  // Adding to the favorites list
  $(".favorite-icon").click(function () {
    var favoriteProductId = $(this).attr("data-product-id"); // Получить ID товара из атрибута data

    if ($(this).hasClass('in-favorites')) {
      removeFavorite(favoriteProductId);
    } else {
      addToFavorite(favoriteProductId);
    }
  });


  $(".favorite-icon").click(function () {

    if ($(this).hasClass("in-favorites")) {
      $(this).removeClass("in-favorites");
    }
    else {
      $(this).addClass("in-favorites");
    }
  });

  $("input[name='color']").click(function () {
    var index = parseInt($(this).data('color'));

    $.ajax({
      url: 'components/pages/product.php',
      type: 'POST',
      data: {
        productId: $('.product').attr('product-id'),
        index: index
      },
      success: function (response) {
        $("#main").html(response);
      }
    });
  });
});



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