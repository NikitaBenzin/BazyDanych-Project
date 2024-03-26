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


  $("input[name='color']").click(function () {
    var index = parseInt($(this).data('color'));

    $.ajax({
      url: 'components/pages/product.php',
      type: 'POST',
      data: {
        productId: $('.product').attr('id') || history.state,
        index: index
      },
      success: function (response) {
        $("#main").html(response);
      }
    });
  });
});