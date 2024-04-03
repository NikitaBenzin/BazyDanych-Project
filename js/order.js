$(document).ready(function () {
  window.addEventListener("popstate", function (event) {
    window.location.replace("/");
  });


});

function submitOrder() {
  let isError = false;

  // Функция для проверки, содержит ли строка только буквы английского алфавита
  function isValidEnglishLetters(input) {
    return /^[a-zA-Z]+$/.test(input);
  }

  // Функция для проверки, содержит ли строка только цифры
  function isValidDigits(input) {
    return /^\d+$/.test(input);
  }

  // Проверка поля "Ulica"
  var streetInput = document.getElementById("street");
  if (streetInput.value.trim() === "" || !isValidEnglishLetters(streetInput.value)) {
    streetInput.classList.add('invalid-input');
    isError = true;
  } else {
    streetInput.classList.remove('invalid-input');
  }

  // Проверка поля "Nr domu"
  var houseNumberInput = document.getElementById("houseNumber");
  if (houseNumberInput.value.trim() === "" || !isValidDigits(houseNumberInput.value)) {
    houseNumberInput.classList.add('invalid-input');
    isError = true;
  } else {
    houseNumberInput.classList.remove('invalid-input');
  }

  // Проверка поля "Nr lokalu"
  var flatNumberInput = document.getElementById("flatNumber");
  if (flatNumberInput.value.trim() === "" || !isValidDigits(flatNumberInput.value)) {
    flatNumberInput.classList.add('invalid-input');
    isError = true;
  } else {
    flatNumberInput.classList.remove('invalid-input');
  }

  // Проверка поля "Zip"
  var zipInput = document.getElementById("zip");
  if (!zipInput.checkValidity()) {
    zipInput.classList.add('invalid-input');
    isError = true;
  } else {
    zipInput.classList.remove('invalid-input');
  }

  // Проверка поля "Miejscowość"
  var cityInput = document.getElementById("city");
  if (cityInput.value.trim() === "" || !isValidEnglishLetters(cityInput.value)) {
    cityInput.classList.add('invalid-input');
    isError = true;
  } else {
    cityInput.classList.remove('invalid-input');
  }

  // Проверка поля "Phone"
  var phoneInput = document.getElementById("phone");
  if (phoneInput.value.trim() === "" || !isValidDigits(phoneInput.value.substr(3))) {
    phoneInput.classList.add('invalid-input');
    isError = true;
  } else {
    phoneInput.classList.remove('invalid-input');
  }

  if (!isError) {
    let orderAddress = `${streetInput.value} ${houseNumberInput.value} / ${flatNumberInput.value} | ${cityInput.value} ${zipInput.value}`;

    $.ajax({
      url: 'components/pages/orderNumber.php',
      type: 'POST',
      data: {
        orderAddress: orderAddress,
        phoneNumber: `${phoneInput.value}`,
        payMethod: document.getElementById("payMethod").value
      },
      success: function (response) {
        $("#main").html(response);
      }
    });
    window.scrollTo({
      top: 0,
      behavior: 'smooth' // Для плавной прокрутки
    });
  }
};