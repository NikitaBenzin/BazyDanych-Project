<?PHP
include("dbconfig.php");

session_start(); // Начинаем сессию

$sessionId = '';
$favoriteAmount = '0';
$cartAmount = '0';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['favoriteProductId'])) {
    $dbConnection = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

    $sessionId = $_SESSION['user_id'];
    // Получение текущего массива favorites из базы данных
    $query = "SELECT favorites FROM users WHERE session_id = '$sessionId'";
    $result = mysqli_query($dbConnection, $query);

    if ($result) {
      $row = mysqli_fetch_assoc($result);
      $favorites_json = $row['favorites'];

      // Преобразование JSON-строки в PHP-массив
      $favorites = json_decode($favorites_json, true);

      // Добавление нового элемента в массив
      $new_item = $_POST['favoriteProductId'];
      $favorites[] = $new_item;

      // Преобразование обновленного массива в JSON-строку
      $updated_favorites_json = json_encode($favorites);

      // Обновление записи в базе данных с обновленным значением favorites
      $update_query = "UPDATE users SET favorites = '$updated_favorites_json' WHERE session_id = '$sessionId'";
      mysqli_query($dbConnection, $update_query);
    }
    $dbConnection->close();
  }

  if (isset($_POST['cartProductId'])) {
    $dbConnection = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

    $sessionId = $_SESSION['user_id'];

    $query = "SELECT cart FROM users WHERE session_id = '$sessionId'";
    $result = mysqli_query($dbConnection, $query);

    if ($result) {
      $row = mysqli_fetch_assoc($result);
      $cart_json = $row['cart'];

      $cart = json_decode($cart_json, true);

      $isInCart = false;
      foreach ($cart as $cartProductId) {
        if ($cartProductId == $_POST['cartProductId']) {
          $isInCart = true;
        }
      }

      if (!$isInCart) {
        $new_item = $_POST['cartProductId'];
        $cart[] = $new_item;

        $updated_cart_json = json_encode($cart);

        $update_query = "UPDATE users SET cart = '$updated_cart_json' WHERE session_id = '$sessionId'";
        mysqli_query($dbConnection, $update_query);
      }
    }
    $dbConnection->close();
  }

  if (isset($_POST['removeFavoriteProductId'])) {
    $productId = $_POST['removeFavoriteProductId'];

    $pdo = new PDO("mysql:dbname=" . $db_name . ";host=" . $db_server, $db_user, $db_pass);
    $stmt = $pdo->prepare("SELECT favorites FROM users WHERE session_id = :session_id");
    $stmt->bindParam(':session_id', $_SESSION['user_id']);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    $favorites = json_decode($user['favorites'], true);

    $favoriteNew = [];
    foreach ($favorites as $favProductId) {
      if ($favProductId != $productId) {
        array_push($favoriteNew, $favProductId);
      }
    }

    // Преобразуем массив обратно в JSON-строку
    $favorites_json = json_encode($favoriteNew);

    // Обновляем запись в базе данных с новым значением поля favorites
    $stmt = $pdo->prepare("UPDATE users SET favorites = :favorites WHERE session_id = :session_id");
    $stmt->bindParam(':favorites', $favorites_json);
    $stmt->bindParam(':session_id', $_SESSION['user_id']);
    $stmt->execute();

    $pdo = null;
  }

  if (isset($_POST['removeCartProductId'])) {
    $productId = $_POST['removeCartProductId'];

    $pdo = new PDO("mysql:dbname=" . $db_name . ";host=" . $db_server, $db_user, $db_pass);
    $stmt = $pdo->prepare("SELECT cart FROM users WHERE session_id = :session_id");
    $stmt->bindParam(':session_id', $_SESSION['user_id']);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    $cart = json_decode($user['cart'], true);

    $cartNew = [];
    foreach ($cart as $cartProductId) {
      if ($cartProductId != $productId) {
        array_push($cartNew, $cartProductId);
      }
    }

    // Преобразуем массив обратно в JSON-строку
    $cart_json = json_encode($cartNew);

    // Обновляем запись в базе данных с новым значением поля cart
    $stmt = $pdo->prepare("UPDATE users SET cart = :cart WHERE session_id = :session_id");
    $stmt->bindParam(':cart', $cart_json);
    $stmt->bindParam(':session_id', $_SESSION['user_id']);
    $stmt->execute();

    $pdo = null;
  }
}

if (!isset($_SESSION['user_id'])) {

  $sessionId = uniqid();

  $dbConnection = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

  $favorites = array(); // Пустой массив для favorites
  $cart = array(); // Пустой массив для cart

  // Преобразование массивов в JSON-строки и экранирование их
  $favorites_json = mysqli_real_escape_string($dbConnection, json_encode($favorites));
  $cart_json = mysqli_real_escape_string($dbConnection, json_encode($cart));

  $query = "INSERT INTO users (session_id, favorites, cart) VALUES ('$sessionId', '$favorites_json', '$cart_json')";
  $result = mysqli_query($dbConnection, $query);

  $dbConnection->close();
  $_SESSION['user_id'] = $sessionId;
  setcookie('user_id', $sessionId, time() + (86400 * 30), "/");
} else {
  // Если у пользователя уже есть уникальный идентификатор, используем его
  $sessionId = $_COOKIE['user_id'];

  // Здесь вы можете проверить, есть ли этот идентификатор в базе данных
  $dbConnection = mysqli_connect($db_server, $db_user, $db_pass, $db_name);

  // Получение текущего массива favorites из базы данных
  $query = "SELECT favorites FROM users WHERE session_id = '$sessionId'";
  $result = mysqli_query($dbConnection, $query);

  if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $favorites_json = $row['favorites'];

    // Преобразование JSON-строки в PHP-массив
    $favoriteAmount = count(json_decode($favorites_json, true));
  }

  $query = "SELECT cart FROM users WHERE session_id = '$sessionId'";
  $result = mysqli_query($dbConnection, $query);

  if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $cart_json = $row['cart'];

    $cartAmount = count(json_decode($cart_json, true));
  }
  $dbConnection->close();
}

$dropDownMenu = '';
$sql = "SELECT * FROM `products` WHERE category_id = 3;";
$result = mysqli_query($connect, $sql);

if (mysqli_num_rows($result) > 0) {
  while ($product = mysqli_fetch_assoc($result)) {
    $dropDownMenu .= '
      <p product-id="' . $product['id'] . '" class="link header-link" href="#">' . $product['product_name'] . '</p>
    ';
  }
};


session_write_close();

echo '

  <a href="/" class="logo">iApple</a>
  <span class="burger">
    <svg height="24" viewBox="0 -960 960 960" width="24"><path fill="#838383" d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/></svg>
  </span>
  <span class="burger-bg"></span>
  <div class="burger-menu">
    <div class="model-pick">
      <span>
        <svg width="15.000000" height="21.000000" viewBox="0 0 15 21" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><desc></desc><defs /><path id="Vector" d="M2.14 2.09L2.14 18.9L12.85 18.9L12.85 2.09L2.14 2.09ZM1.07 0L13.92 0C14.21 0 14.48 0.11 14.68 0.3C14.88 0.5 15 0.77 15 1.05L15 19.95C15 20.22 14.88 20.49 14.68 20.69C14.48 20.88 14.21 21 13.92 21L1.07 21C0.78 21 0.51 20.88 0.31 20.69C0.11 20.49 0 20.22 0 19.95L0 1.05C0 0.77 0.11 0.5 0.31 0.3C0.51 0.11 0.78 0 1.07 0ZM7.5 15.75C7.78 15.75 8.05 15.86 8.25 16.05C8.45 16.25 8.57 16.52 8.57 16.79C8.57 17.07 8.45 17.34 8.25 17.54C8.05 17.73 7.78 17.85 7.5 17.85C7.21 17.85 6.94 17.73 6.74 17.54C6.54 17.34 6.42 17.07 6.42 16.79C6.42 16.52 6.54 16.25 6.74 16.05C6.94 15.86 7.21 15.75 7.5 15.75Z" fill="#838383" fill-opacity="1.000000" fill-rule="nonzero" /></svg>
        <p>Wybierz model telefonu</p>
        <svg width="8.000000" height="5.000000" viewBox="0 0 8 5" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><desc></desc><defs /><path id="Vector" d="M4 5L0 1.24L1.33 0L4 2.5L6.66 0L8 1.24L4 5Z" fill="#101010" fill-opacity="1.000000" fill-rule="nonzero" /></svg>
      </span>
      <div class="drop-down-menu">
        <p>Apple</p>
        <span class="drop-down-menu-variants">
        ' . $dropDownMenu . '
        </span>

      </div>
    </div>
    <nav class="header-nav">
      <div class="nav-favorite" page="components/pages/favorites.php">
        <svg width="22.000000" height="20.000000" viewBox="0 0 22 20" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><desc></desc><defs /><path id="Vector" d="M10.48 1.65C13.07 -0.63 17.06 -0.56 19.55 1.9C22.04 4.35 22.12 8.26 19.81 10.81L10.48 20L1.15 10.81C-1.16 8.26 -1.07 4.34 1.41 1.9C3.91 -0.55 7.89 -0.64 10.48 1.65ZM17.99 3.42C16.34 1.8 13.68 1.73 11.95 3.26L10.48 4.56L9.01 3.26C7.28 1.73 4.62 1.8 2.97 3.43C1.33 5.04 1.25 7.62 2.76 9.32L10.48 16.93L18.2 9.33C19.71 7.62 19.63 5.04 17.99 3.42Z" fill="#838383" fill-opacity="1.000000" fill-rule="nonzero" /></svg>
        <span class="cart-amount">' . $favoriteAmount . '</span>
      </div>
      <div class="nav-cart" page="components/pages/cart.php">
        <svg width="23.000000" height="24.000000" viewBox="0 0 23 24" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"><desc></desc><defs /><path id="Vector" d="M3.08 5.04L-0.52 1.5L1.05 -0.05L4.65 3.5L21.57 3.5C21.74 3.5 21.91 3.54 22.07 3.61C22.22 3.69 22.36 3.8 22.46 3.94C22.56 4.07 22.63 4.23 22.66 4.4C22.69 4.57 22.68 4.74 22.63 4.9L19.97 13.64C19.9 13.86 19.76 14.06 19.57 14.2C19.38 14.34 19.15 14.42 18.91 14.42L5.3 14.42L5.3 16.6L17.51 16.6L17.51 18.79L4.19 18.79C3.9 18.79 3.61 18.67 3.41 18.47C3.2 18.26 3.08 17.98 3.08 17.69L3.08 5.04ZM5.3 5.68L5.3 12.23L18.08 12.23L20.08 5.68L5.3 5.68ZM4.75 23.15C4.3 23.15 3.88 22.98 3.57 22.68C3.26 22.37 3.08 21.95 3.08 21.52C3.08 21.08 3.26 20.67 3.57 20.36C3.88 20.05 4.3 19.88 4.75 19.88C5.19 19.88 5.61 20.05 5.92 20.36C6.24 20.67 6.41 21.08 6.41 21.52C6.41 21.95 6.24 22.37 5.92 22.68C5.61 22.98 5.19 23.15 4.75 23.15ZM18.07 23.15C17.63 23.15 17.2 22.98 16.89 22.68C16.58 22.37 16.4 21.95 16.4 21.52C16.4 21.08 16.58 20.67 16.89 20.36C17.2 20.05 17.63 19.88 18.07 19.88C18.51 19.88 18.93 20.05 19.24 20.36C19.56 20.67 19.73 21.08 19.73 21.52C19.73 21.95 19.56 22.37 19.24 22.68C18.93 22.98 18.51 23.15 18.07 23.15Z" fill="#838383" fill-opacity="1.000000" fill-rule="nonzero" /></svg>
        <span class="cart-amount">' . $cartAmount . '</span>
      </div>
    </nav>

  </div>
  <script src="./js/header.js"></script>
';
