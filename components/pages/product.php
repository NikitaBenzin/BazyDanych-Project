<?php

// Подключение к базе данных
$pdo = new PDO('mysql:dbname=iapple_shop;host=localhost', 'root', '');

// Получение ID товара из POST-запроса
$productId = $_POST['productId'];

// Получение информации о товаре из базы данных
$stmt = $pdo->prepare("SELECT * FROM products WHERE id = :productId");
$stmt->bindParam(':productId', $productId);
$stmt->execute();
$product = $stmt->fetch(PDO::FETCH_ASSOC);

// Вывод информации о товаре
echo "<h2>" . $product['product_name'] . "</h2>";
echo "<p>" . $product['description'] . "</p>";

// Закрытие соединения
$pdo = null;
