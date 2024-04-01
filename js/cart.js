$(document).ready(function () {
  window.addEventListener("popstate", function (event) {
    window.location.replace("/");
  });

  let totalAmount = 0;
  document.querySelectorAll(".totalField").forEach((field) => {
    totalAmount += parseInt(field.textContent.replace("zl", ""));
  });

  $('#total-amount').text(`${totalAmount} zł`);

  var newURL = 'cart';
  var newStateTitle = "Product";
  var stateData = $('.product').attr('id');
  history.pushState(stateData, newStateTitle, newURL);

  // Removing from cart list
  $(".delete-icon").click(function () {
    var cartProductId = $(this).attr("data-product-id");
    removeProduct(cartProductId);
  });

  // Убавляем кол-во по клику
  $('.quantity_inner .bt_minus').click(function () {
    let $input = $(this).parent().find('.quantity');
    let count = parseInt($input.val()) - 1;
    count = count < 1 ? 1 : count;
    $input.val(count);

    var counterContainer = $(this).closest(".product-amount");
    updateTotal(counterContainer);
  });

  // Прибавляем кол-во по клику
  $('.quantity_inner .bt_plus').click(function () {
    let $input = $(this).parent().find('.quantity');
    let count = parseInt($input.val()) + 1;
    count = count > parseInt($input.data('max-count')) ? parseInt($input.data('max-count')) : count;
    $input.val(parseInt(count));

    var counterContainer = $(this).closest(".product-amount");
    updateTotal(counterContainer);
  });

  // Убираем все лишнее и невозможное при изменении поля
  $('.quantity_inner .quantity').bind("change keyup input click", function () {
    if (this.value.match(/[^0-9]/g)) {
      this.value = this.value.replace(/[^0-9]/g, '');
    }
    if (this.value == "") {
      this.value = 1;
    }
    if (this.value > parseInt($(this).data('max-count'))) {
      this.value = parseInt($(this).data('max-count'));
    }
  });


});

function removeProduct(removeCartProductId) {
  $.ajax({
    url: 'components/header.php',
    type: 'POST',
    data: {
      removeCartProductId: removeCartProductId
    },
    success: function (response) {
      $("#header").html(response);

      $.ajax({
        url: 'components/pages/cart.php',
        type: 'POST',
        data: '',
        success: function (response) {
          $("#main").html(response);
        }
      });
    }
  });
}

function updateTotal(counterContainer) {
  var counterContainer = $(counterContainer);
  var counterValue = counterContainer.find(".quantity");
  var totalField = counterContainer.find(".totalField");

  // Обрезаем "zl"
  let currentPrice = parseInt(totalField.data("product-price"));

  // Получаем значение счетчика
  var count = parseInt(counterValue.val());

  var total = count * currentPrice;

  // Обновляем значение в поле итого
  totalField.text(`${total} zł`);


  let totalAmount = 0;
  document.querySelectorAll(".totalField").forEach((field) => {
    totalAmount += parseInt(field.textContent.replace("zl", ""));
  });

  $('#total-amount').text(`${totalAmount} zł`);
}