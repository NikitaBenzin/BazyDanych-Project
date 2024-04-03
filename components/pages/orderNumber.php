<?php

include("../dbconfig.php");

// JSON 
$pdo = new PDO("mysql:dbname=" . $db_name . ";host=" . $db_server, $db_user, $db_pass);

// Начало сессии
session_start();
$sessionId = $_SESSION['user_id'];
$orderAddress = $_POST['orderAddress'];
$phoneNumber = $_POST['phoneNumber'];
$payMethod = $_POST['payMethod'];
$totalAmount = $_SESSION['totalAmount'];
$productAmountArray = json_encode($_SESSION['productAmountArray']);
$productIdArray = json_encode($_SESSION['productIdArray']);

$sql = "INSERT INTO `orders` (`session_id`, `address`, `phone_number`, `pay_method`, `total_amount`, `products_id`, `products_amount`) VALUES (:sessionId, :orderAddress, :phoneNumber, :payMethod, :totalAmount, :productIdArray, :productAmountArray);";
$stmt = $pdo->prepare($sql);

$stmt->bindParam(':sessionId', $sessionId);
$stmt->bindParam(':orderAddress', $orderAddress);
$stmt->bindParam(':phoneNumber', $phoneNumber);
$stmt->bindParam(':payMethod', $payMethod);
$stmt->bindParam(':totalAmount', $totalAmount);
$stmt->bindParam(':productAmountArray', $productAmountArray);
$stmt->bindParam(':productIdArray', $productIdArray);

// Выполнение запроса
$stmt->execute();

$sql = "UPDATE `users` SET `cart` = '[]' WHERE `users`.`session_id` = :session_id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':session_id', $sessionId);
$stmt->execute();

$sql = "SELECT `order_number` FROM `orders` WHERE session_id = :session_id";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':session_id', $sessionId);
$stmt->execute();
$result = $stmt->fetch(PDO::FETCH_ASSOC);

$orderNumber = $result['order_number'];

echo '
  <div class="card order-number">
    <h3>Twój numer zamówienia to №' . $orderNumber . ', nasz menedżer skontaktuje się z Tobą.</h3>
  </div>
';
$pdo = null;
