$(document).ready(function () {
  window.addEventListener("popstate", function (event) {
    window.location.replace("/");
  });

  var newURL = 'favorites';
  var newStateTitle = "Product";
  var stateData = $('.product').attr('id');
  history.pushState(stateData, newStateTitle, newURL);

  // Removing from favorites list
  $(".favorite-icon").click(function () {
    var favoriteProductId = $(this).attr("data-product-id");
    removeFavorite(favoriteProductId);
  });

});


function removeFavorite(removeFavoriteProductId) {
  $.ajax({
    url: 'components/header.php',
    type: 'POST',
    data: {
      removeFavoriteProductId: removeFavoriteProductId
    },
    success: function (response) {
      $("#header").html(response);

      $.ajax({
        url: 'components/pages/favorites.php',
        type: 'POST',
        data: '',
        success: function (response) {
          $("#main").html(response);
        }
      });
    }
  });
}
