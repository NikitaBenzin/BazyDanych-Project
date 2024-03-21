<!DOCTYPE html>
<html lang="pl-PL">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Bazy Danych - sklep</title>
	<link rel="stylesheet" href="./css/bootstrap/bootstrap.min.css">
	<link rel="stylesheet" href="./css/styles.css">
	<link rel="stylesheet" href="./css/header.css">
	<link rel="stylesheet" href="./css/footer.css">
	<link rel="stylesheet" href="./css/home.css">
</head>

<body>

	<div class="container">
		<?PHP
		include './components/header.php';
		?>

		<main id="main">
			<?PHP
			include './components/home.php';
			?>
		</main>

		<?PHP
		include './components/footer.php';
		?>
	</div>

	<!-- SCRIPTS -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
	<script src="./js/bootstrap/bootstrap.min.js"></script>
	<script src="./js/jq.js"></script>
	<script src="./js/app.js"></script>
</body>

</html>