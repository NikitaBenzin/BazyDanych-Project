<?php
include("../dbconfig.php");

// Подключение к базе данных
$pdo = new PDO("mysql:dbname=" . $db_name . ";host=" . $db_server, $db_user, $db_pass);

// Получение ID товара из POST-запроса
$productId = $_POST['productId'];
$index = $_POST['index'];

// Connect to the PRODUCT table
$productTable = $pdo->prepare("SELECT * FROM products WHERE id = :productId");
$productTable->bindParam(':productId', $productId);
$productTable->execute();
$product = $productTable->fetch(PDO::FETCH_ASSOC);

// Connect to the CATEGORY table
$categoryTable = $pdo->prepare("SELECT * FROM products_category WHERE product_id = :productId");
$categoryTable->bindParam(':productId', $productId);
$categoryTable->execute();
$category = $categoryTable->fetch(PDO::FETCH_ASSOC);
$json_data = json_decode($category['product_images'], true);

$pdo = null;
// Check if the product have a discount
$product_discount = '';
$product_discount_prise = '';
$product_prise = $product["price"] . " zł";
if ($product["discount"] != 0) {
  $product_discount = "-" . $product["discount"] . "%";
  $product_discount_prise =  "";
  $product_discount_prise .= $product["price"] . " zł";
  $product_prise = $product["price"] - $product["discount"] . " zł";
}

$product_branded = '';
if ($product["branded"] == 1) {
  $product_branded = '
  <svg width="25.000000" height="31.000000" viewBox="0 0 25 31" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
    <desc>
    </desc>
    <defs />
    <path id="Vector" d="M17.54 9.93C16.9 9.88 16.21 10.03 15.15 10.45C15.24 10.41 14.15 10.85 13.84 10.97C13.16 11.21 12.6 11.34 11.97 11.34C11.34 11.34 10.77 11.22 10.11 10.99C9.9 10.91 9.69 10.83 9.42 10.73C9.31 10.68 8.91 10.52 8.82 10.48C7.94 10.13 7.44 9.99 7.03 10C5.46 10.02 3.98 10.95 3.12 12.49C1.36 15.63 2.34 21.3 4.9 25.12C6.27 27.14 7.02 27.86 7.32 27.85C7.62 27.83 7.84 27.77 8.38 27.53L8.61 27.43C9.97 26.83 10.93 26.57 12.37 26.57C13.76 26.57 14.69 26.83 16 27.41L16.23 27.51C16.77 27.75 16.96 27.8 17.3 27.79C17.79 27.79 18.39 27.21 19.72 25.2C20.08 24.66 20.4 24.08 20.68 23.5C20.5 23.34 20.32 23.18 20.15 23.01C18.4 21.3 17.32 18.98 17.29 16.12C17.26 14.01 17.93 11.94 19.2 10.28C18.67 10.07 18.11 9.96 17.54 9.93ZM17.75 7.14C18.72 7.21 21.47 7.51 23.26 10.21C23.12 10.29 19.97 12.17 20 16.1C20.05 20.79 24 22.35 24.05 22.37C24.01 22.49 23.41 24.6 21.96 26.78C20.7 28.68 19.4 30.56 17.35 30.59C15.32 30.64 14.67 29.37 12.37 29.37C10.06 29.37 9.34 30.56 7.43 30.64C5.44 30.71 3.94 28.59 2.67 26.72C0.08 22.86 -1.89 15.85 0.77 11.1C2.09 8.73 4.43 7.24 6.99 7.21C8.93 7.16 10.78 8.55 11.97 8.55C13.14 8.55 15.24 6.94 17.75 7.14ZM16.2 4.59C15.15 5.9 13.42 6.92 11.74 6.79C11.51 5.01 12.36 3.15 13.34 1.99C14.43 0.68 16.25 -0.29 17.77 -0.36C17.97 1.45 17.26 3.28 16.2 4.59Z" fill="#1C1C27" fill-opacity="1.000000" fill-rule="nonzero" />
  </svg>
  ';
}

// COLOR PICKER
$colorPicker = '';
$colorPickerIndex = 0;

if (count($json_data) > 1) {
  foreach ($json_data as $key) {
    $colorPicker .= '
    <label class="color-picker-label" for="' . $colorPickerIndex . '">
      <input id="' . $colorPickerIndex . '" data-color="' . $colorPickerIndex . '" type="radio" name="color" class="hidden-radio">
      <img src="' . $key['color'] . '" alt="" class="custom-radio"> 
    </label>
    ';
    $colorPickerIndex += 1;
  }
} else {
  $colorPicker .= 'Monokolor';
}


$pdo = new PDO("mysql:dbname=" . $db_name . ";host=" . $db_server, $db_user, $db_pass);

$stmt = $pdo->prepare("SELECT favorites FROM users WHERE session_id = :session_id");
$stmt->bindParam(':session_id', $_COOKIE['user_id']);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

$arrayAsString = $result['favorites'];

// Преобразование строки в массив с помощью json_decode()
$resultArray = json_decode($arrayAsString, true);


$icoClass = "";
if ($resultArray) {
  foreach ($resultArray as $favProductId) {
    if ($favProductId == $productId) {
      $icoClass .= 'in-favorites';
    }
  }
}


$pdo = null;

// Product information
echo '
  <div class="back-btn">
    <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path fill="#838383" d="M400-80 0-480l400-400 71 71-329 329 329 329-71 71Z"/></svg>
    <p>Back</p>
  </div>

  <div product-id="' . $productId . '" class="product">
      
    <div class="card">
      <div class="card-favorite">
        ' . $product_branded . '

        <svg data-product-id="' . $productId . '" class="favorite-icon ' . $icoClass . '" width="25.000000" height="31.000000" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><desc></desc><defs /><path fill="#1C1C27" id="Vector" d="M10.48 1.65C13.07 -0.63 17.06 -0.56 19.55 1.9C22.04 4.35 22.12 8.26 19.81 10.81L10.48 20L1.15 10.81C-1.16 8.26 -1.07 4.34 1.41 1.9C3.91 -0.55 7.89 -0.64 10.48 1.65ZM17.99 3.42C16.34 1.8 13.68 1.73 11.95 3.26L10.48 4.56L9.01 3.26C7.28 1.73 4.62 1.8 2.97 3.43C1.33 5.04 1.25 7.62 2.76 9.32L10.48 16.93L18.2 9.33C19.71 7.62 19.63 5.04 17.99 3.42Z" fill="#838383" fill-opacity="1.000000" fill-rule="nonzero" /></svg>
      </div>

      <div id="big-image">
        <img src="' . $json_data[$index]['images'][0] . '" id="big">
      </div>
      
      <section class="card-info">
        <p class="card-info-name">' . $product["product_name"] . '</p>
        <section class="card-info-price">
          <span class="card-info-price-current">' . $product_prise . '</span>
          <span class="card-info-price-previous">
            <span class="crossed-out-price">' . $product_discount_prise . '</span>
            <span class="discount">' . $product_discount . '</span>
          </span>
        </section>
      </section>

      <div id="small-images">
        <a class="small-image-active" href="' . $json_data[$index]['images'][0] . '">
          <img src="' . $json_data[$index]['images'][0] . '">
        </a>
      
        <a href="' . $json_data[$index]['images'][1] . '">
          <img src="' . $json_data[$index]['images'][1] . '">
        </a>
      </div>

    </div>
    
    <div class="product-interaction">
      <div class="color-picker">
        <label>Kolor: </label>
        ' . $colorPicker . '
      </div>
      <button onclick="addToCart()" id="add-to-cart">
        <svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path fill="#FFFFFF" d="M280-80q-33 0-56.5-23.5T200-160q0-33 23.5-56.5T280-240q33 0 56.5 23.5T360-160q0 33-23.5 56.5T280-80Zm400 0q-33 0-56.5-23.5T600-160q0-33 23.5-56.5T680-240q33 0 56.5 23.5T760-160q0 33-23.5 56.5T680-80ZM246-720l96 200h280l110-200H246Zm-38-80h590q23 0 35 20.5t1 41.5L692-482q-11 20-29.5 31T622-440H324l-44 80h480v80H280q-45 0-68-39.5t-2-78.5l54-98-144-304H40v-80h130l38 80Zm134 280h280-280Z"/></svg>
        <span>Włóż do torby</span>
      </button>
    </div>
  </div>
  
  <span class="slide-block">
    <button class="slide-btn">
      <p>Informacje o produkcie</p>
      <svg width="8.000000" height="5.000000" viewBox="0 0 8 5" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><desc></desc><defs /><path id="Vector" d="M4 5L0 1.24L1.33 0L4 2.5L6.66 0L8 1.24L4 5Z" fill="#101010" fill-opacity="1.000000" fill-rule="nonzero" /></svg>
    </button>
    <p class="slide-info">' . $product["description"] . '</p>
  </span>

  <script>
    document.querySelectorAll(\'input[name="color"]\')[' . $index . '].checked = true;
  </script>


  <script src="../../js/product.js"></>
';
