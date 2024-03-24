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

  //document.getElementById("myRadio").checked = true;
});