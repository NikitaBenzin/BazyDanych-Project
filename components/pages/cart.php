<?php

include("../dbconfig.php");

// JSON 
$pdo = new PDO("mysql:dbname=" . $db_name . ";host=" . $db_server, $db_user, $db_pass);


// Making Accessories Section
// Accessories
$sql = "SELECT * FROM `products`";
$result = mysqli_query($connect, $sql);

$stmt = $pdo->prepare("SELECT cart FROM users WHERE session_id = :session_id");
$stmt->bindParam(':session_id', $_COOKIE['user_id']);
$stmt->execute();
$favoriteResult = $stmt->fetch(PDO::FETCH_ASSOC);
$arrayAsString = $favoriteResult['cart'];
$resultArray = json_decode($arrayAsString, true);


$accessoriesSection = '';

if (mysqli_num_rows($result) > 0) {
  while ($product = mysqli_fetch_assoc($result)) {
    foreach ($resultArray as $favProductId) {

      if ($favProductId == $product["id"]) {
        $stmt = $pdo->query("SELECT product_images FROM products_category WHERE product_id = " . $product["id"]);
        $category = $stmt->fetch(PDO::FETCH_ASSOC);
        $json_data = json_decode($category['product_images'], true);

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

        $accessoriesSection .= '
        <li class="card" product-id="' . $product["id"] . '">
          <div class="card-favorite">
            <svg data-product-id="' . $product["id"] . '" class="delete-icon" xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24"><path fill="#DF6464" d="m376-300 104-104 104 104 56-56-104-104 104-104-56-56-104 104-104-104-56 56 104 104-104 104 56 56Zm-96 180q-33 0-56.5-23.5T200-200v-520h-40v-80h200v-40h240v40h200v80h-40v520q0 33-23.5 56.5T680-120H280Zm400-600H280v520h400v-520Zm-400 0v520-520Z"/></svg>
          </div>
          <img class="card-image" src="' . $json_data[0]['images'][0] . '" alt="' . $product["product_name"] . '">
          <section product-id="' . $product["id"] . '" class="card-info">
            <p class="card-info-name">' . $product["product_name"] . '</p>
            <section class="card-info-price">
              <span class="card-info-price-current">' . $product_prise . '</span>
              <span class="card-info-price-previous">
                <span class="crossed-out-price">' . $product_discount_prise . '</span>
                <span class="discount">' . $product_discount . '</span>
              </span>
            </section>

          </section>
          <section class="product-amount">
            <div data-product-id="' . $product["id"] . '" class="quantity_inner">        
              <button data-product-id="' . $product["id"] . '" class="bt_minus">-</button>
              <input type="text" class="quantity" value="1" data-max-count="20">
              <button data-product-id="' . $product["id"] . '" class="bt_plus">+</button>
            </div>

            <span data-product-price="' . substr($product_prise, 0, -3) . '" class="totalField">' . substr($product_prise, 0, -3) . ' zł</span>
          </section>
        </li>
        ';
      }
    }
  }
};

if (strlen($accessoriesSection) <= 1) {
  $accessoriesSection .= '
    <div class="empty-cart">
      <svg width="255.000000" height="196.000000" viewBox="0 0 255 196" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><desc></desc><defs>  <clipPath id="clip82_128">    <rect id="Illustration" width="255.000000" height="196.000000" fill="white" fill-opacity="0"/>  </clipPath></defs><rect id="Illustration" width="255.000000" height="196.000000" fill="#FFFFFF" fill-opacity="0"/><g clip-path="url(#clip82_128)">  <path id="Vector" d="M18.17 180.56C23.59 190.66 35.11 194.99 35.11 194.99C35.11 194.99 37.83 182.95 32.4 172.86C26.98 162.76 15.46 158.42 15.46 158.42C15.46 158.42 12.74 170.46 18.17 180.56Z" fill="#FFA542" fill-opacity="1.000000" fill-rule="nonzero"/>  <path id="Vector" d="M21.9 177.24C31.69 183.15 35.46 194.9 35.46 194.9C35.46 194.9 23.36 197.06 13.56 191.14C3.77 185.23 0 173.48 0 173.48C0 173.48 12.1 171.32 21.9 177.24Z" fill="#FFCE7F" fill-opacity="1.000000" fill-rule="nonzero"/>  <path id="Vector" d="M180.38 -115.98L241.49 -115.98L241.49 -115.11L180.38 -115.11L180.38 -115.98Z" fill="#F2F2F2" fill-opacity="1.000000" fill-rule="evenodd"/>  <path id="Vector" d="M224.03 -115.33L224.9 -115.33L224.9 -107.22L224.03 -107.22L224.03 -115.33Z" fill="#F2F2F2" fill-opacity="1.000000" fill-rule="evenodd"/>  <path id="Vector" d="M197.4 -115.33L198.28 -115.33L198.28 -107.22L197.4 -107.22L197.4 -115.33Z" fill="#F2F2F2" fill-opacity="1.000000" fill-rule="evenodd"/>  <path id="Vector" d="M211.37 -73.92L272.48 -73.92L272.48 -73.05L211.37 -73.05L211.37 -73.92Z" fill="#F2F2F2" fill-opacity="1.000000" fill-rule="evenodd"/>  <path id="Vector" d="M227.96 -81.81L228.83 -81.81L228.83 -73.7L227.96 -73.7L227.96 -81.81Z" fill="#F2F2F2" fill-opacity="1.000000" fill-rule="evenodd"/>  <path id="Vector" d="M254.58 -81.81L255.46 -81.81L255.46 -73.7L254.58 -73.7L254.58 -81.81Z" fill="#F2F2F2" fill-opacity="1.000000" fill-rule="evenodd"/>  <path id="Vector" d="M292.56 -54.21L353.67 -54.21L353.67 -53.33L292.56 -53.33L292.56 -54.21Z" fill="#F2F2F2" fill-opacity="1.000000" fill-rule="evenodd"/>  <path id="Vector" d="M309.15 -62.09L310.02 -62.09L310.02 -53.99L309.15 -53.99L309.15 -62.09Z" fill="#F2F2F2" fill-opacity="1.000000" fill-rule="evenodd"/>  <path id="Vector" d="M335.77 -62.09L336.65 -62.09L336.65 -53.99L335.77 -53.99L335.77 -62.09Z" fill="#F2F2F2" fill-opacity="1.000000" fill-rule="evenodd"/>  <path id="Vector" d="M286.45 149.09L347.56 149.09L347.56 149.96L286.45 149.96L286.45 149.09Z" fill="#F2F2F2" fill-opacity="1.000000" fill-rule="evenodd"/>  <path id="Vector" d="M303.04 141.2L303.91 141.2L303.91 149.31L303.04 149.31L303.04 141.2Z" fill="#F2F2F2" fill-opacity="1.000000" fill-rule="evenodd"/>  <path id="Vector" d="M329.66 141.2L330.53 141.2L330.53 149.31L329.66 149.31L329.66 141.2Z" fill="#F2F2F2" fill-opacity="1.000000" fill-rule="evenodd"/>  <path id="Vector" d="M182.12 8.45L243.23 8.45L243.23 9.32L182.12 9.32L182.12 8.45Z" fill="#F2F2F2" fill-opacity="1.000000" fill-rule="evenodd"/>  <path id="Vector" d="M198.71 0.56L199.58 0.56L199.58 8.66L198.71 8.66L198.71 0.56Z" fill="#F2F2F2" fill-opacity="1.000000" fill-rule="evenodd"/>  <path id="Vector" d="M225.34 0.56L226.21 0.56L226.21 8.66L225.34 8.66L225.34 0.56Z" fill="#F2F2F2" fill-opacity="1.000000" fill-rule="evenodd"/>  <path id="Vector" d="M201.33 114.04L262.44 114.04L262.44 114.91L201.33 114.91L201.33 114.04Z" fill="#F2F2F2" fill-opacity="1.000000" fill-rule="evenodd"/>  <path id="Vector" d="M217.92 106.15L218.79 106.15L218.79 114.26L217.92 114.26L217.92 106.15Z" fill="#F2F2F2" fill-opacity="1.000000" fill-rule="evenodd"/>  <path id="Vector" d="M244.54 106.15L245.42 106.15L245.42 114.26L244.54 114.26L244.54 106.15Z" fill="#F2F2F2" fill-opacity="1.000000" fill-rule="evenodd"/>  <path id="Vector" d="M299.11 82.05L360.22 82.05L360.22 82.93L299.11 82.93L299.11 82.05Z" fill="#F2F2F2" fill-opacity="1.000000" fill-rule="evenodd"/>  <path id="Vector" d="M315.69 74.17L316.57 74.17L316.57 82.27L315.69 82.27L315.69 74.17Z" fill="#F2F2F2" fill-opacity="1.000000" fill-rule="evenodd"/>  <path id="Vector" d="M342.32 74.17L343.19 74.17L343.19 82.27L342.32 82.27L342.32 74.17Z" fill="#F2F2F2" fill-opacity="1.000000" fill-rule="evenodd"/>  <path id="Vector" d="M158.03 175.93L54.68 175.93L54.68 175.19L157.29 175.19L157.29 138.99L63.37 138.99L58.8 129.45L59.47 129.13L63.83 138.24L158.03 138.24L158.03 175.93Z" fill="#2F2E41" fill-opacity="1.000000" fill-rule="nonzero"/>  <path id="Vector" d="M76.24 186.38C76.24 190.71 72.75 194.22 68.43 194.22C64.12 194.22 60.63 190.71 60.63 186.38C60.63 182.06 64.12 178.55 68.43 178.55C72.75 178.55 76.24 182.06 76.24 186.38Z" fill="#3F3D56" fill-opacity="1.000000" fill-rule="evenodd"/>  <path id="Vector" d="M153.2 186.38C153.2 190.71 149.71 194.22 145.39 194.22C141.08 194.22 137.59 190.71 137.59 186.38C137.59 182.06 141.08 178.55 145.39 178.55C149.71 178.55 153.2 182.06 153.2 186.38Z" fill="#3F3D56" fill-opacity="1.000000" fill-rule="evenodd"/>  <path id="Vector" d="M240.94 19.94C240.94 22.62 238.78 24.8 236.11 24.8C233.44 24.8 231.28 22.62 231.28 19.94C231.28 17.27 233.44 15.09 236.11 15.09C238.78 15.09 240.94 17.27 240.94 19.94Z" fill="#FFA542" fill-opacity="1.000000" fill-rule="evenodd"/>  <path id="Vector" d="M169.09 126.67L52.91 126.67L27.78 44.2L194.98 44.2L194.82 44.69L169.09 126.67ZM53.46 125.93L168.54 125.93L193.96 44.95L28.78 44.95L53.46 125.93Z" fill="#2F2E41" fill-opacity="1.000000" fill-rule="nonzero"/>  <path id="Vector" d="M160.02 122.38L57.98 122.38L35.9 49.24L182.76 49.24L182.63 49.67L160.02 122.38Z" fill="#F2F2F2" fill-opacity="1.000000" fill-rule="nonzero"/>  <path id="Vector" d="M197.06 36.83L196.34 36.64L201.25 18.08L229.79 18.08L229.79 18.83L201.82 18.83L197.06 36.83Z" fill="#2F2E41" fill-opacity="1.000000" fill-rule="nonzero"/>  <path id="Vector" d="M35.9 69.2L186.62 69.2L186.62 69.95L35.9 69.95L35.9 69.2Z" fill="#2F2E41" fill-opacity="1.000000" fill-rule="evenodd"/>  <path id="Vector" d="M44.28 96.7L177.99 96.7L177.99 97.45L44.28 97.45L44.28 96.7Z" fill="#2F2E41" fill-opacity="1.000000" fill-rule="evenodd"/>  <path id="Vector" d="M111 44.57L111.75 44.57L111.75 126.3L111 126.3L111 44.57Z" fill="#2F2E41" fill-opacity="1.000000" fill-rule="evenodd"/>  <path id="Vector" d="M139.7 126.28L145.04 44.55L145.78 44.6L140.44 126.32L139.7 126.28Z" fill="#2F2E41" fill-opacity="1.000000" fill-rule="evenodd"/>  <path id="Vector" d="M76.99 44.6L77.73 44.55L83.03 126.28L82.29 126.33L76.99 44.6Z" fill="#2F2E41" fill-opacity="1.000000" fill-rule="evenodd"/>  <path id="Vector" d="M0 194.43L242.48 194.43L242.48 196L0 196L0 194.43Z" fill="#2F2E41" fill-opacity="1.000000" fill-rule="evenodd"/>  <path id="Vector" d="M26.29 22.9L87.4 22.9L87.4 23.78L26.29 23.78L26.29 22.9Z" fill="#F2F2F2" fill-opacity="1.000000" fill-rule="evenodd"/>  <path id="Vector" d="M42.88 15.02L43.75 15.02L43.75 23.12L42.88 23.12L42.88 15.02Z" fill="#F2F2F2" fill-opacity="1.000000" fill-rule="evenodd"/>  <path id="Vector" d="M69.51 15.02L70.38 15.02L70.38 23.12L69.51 23.12L69.51 15.02Z" fill="#F2F2F2" fill-opacity="1.000000" fill-rule="evenodd"/>  <path id="Vector" d="M47.68 -106.78L108.79 -106.78L108.79 -105.91L47.68 -105.91L47.68 -106.78Z" fill="#F2F2F2" fill-opacity="1.000000" fill-rule="evenodd"/>  <path id="Vector" d="M91.33 -106.13L92.21 -106.13L92.21 -98.02L91.33 -98.02L91.33 -106.13Z" fill="#F2F2F2" fill-opacity="1.000000" fill-rule="evenodd"/>  <path id="Vector" d="M64.71 -106.13L65.58 -106.13L65.58 -98.02L64.71 -98.02L64.71 -106.13Z" fill="#F2F2F2" fill-opacity="1.000000" fill-rule="evenodd"/>  <path id="Vector" d="M109.23 -20.47L170.34 -20.47L170.34 -19.59L109.23 -19.59L109.23 -20.47Z" fill="#F2F2F2" fill-opacity="1.000000" fill-rule="evenodd"/>  <path id="Vector" d="M152.88 -19.81L153.75 -19.81L153.75 -11.71L152.88 -11.71L152.88 -19.81Z" fill="#F2F2F2" fill-opacity="1.000000" fill-rule="evenodd"/>  <path id="Vector" d="M126.25 -19.81L127.13 -19.81L127.13 -11.71L126.25 -11.71L126.25 -19.81Z" fill="#F2F2F2" fill-opacity="1.000000" fill-rule="evenodd"/>  <path id="Vector" d="M5.34 -20.91L66.45 -20.91L66.45 -20.03L5.34 -20.03L5.34 -20.91Z" fill="#F2F2F2" fill-opacity="1.000000" fill-rule="evenodd"/>  <path id="Vector" d="M48.99 -20.25L49.86 -20.25L49.86 -12.15L48.99 -12.15L48.99 -20.25Z" fill="#F2F2F2" fill-opacity="1.000000" fill-rule="evenodd"/>  <path id="Vector" d="M22.36 -20.25L23.24 -20.25L23.24 -12.15L22.36 -12.15L22.36 -20.25Z" fill="#F2F2F2" fill-opacity="1.000000" fill-rule="evenodd"/>  <path id="Vector" d="M78.67 -64.72L139.78 -64.72L139.78 -63.85L78.67 -63.85L78.67 -64.72Z" fill="#F2F2F2" fill-opacity="1.000000" fill-rule="evenodd"/>  <path id="Vector" d="M95.26 -72.61L96.13 -72.61L96.13 -64.5L95.26 -64.5L95.26 -72.61Z" fill="#F2F2F2" fill-opacity="1.000000" fill-rule="evenodd"/>  <path id="Vector" d="M121.89 -72.61L122.76 -72.61L122.76 -64.5L121.89 -64.5L121.89 -72.61Z" fill="#F2F2F2" fill-opacity="1.000000" fill-rule="evenodd"/></g></svg>
      
      <h3>Koszyk jest pusty</h3>
      <p>Ale nigdy nie jest za późno, aby to naprawić :)</p>
    </div>
  ';
};

echo '
<section class="products">
  <span>Koszyk</span>
  <div class="cart-section">
    <ul class="cart">
      ' . $accessoriesSection . '
    </ul>

    <div class="total"> 
      <div class="total-info">
        <span>Całkowita kwota</span>
        <span id="total-amount">123 zl</span>
      </div>
      <button onclick="checkout()" id="checkout">Idź do kasy</button>
    </div>
  </div>
</section>

<script src="../../js/cart.js"></>

';
$pdo = null;

mysqli_close($connect);
