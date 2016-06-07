<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title><?php echo $titulo; ?></title>
	<link rel="stylesheet" href="<?php echo $baseUrl; ?>/css/bootstrap.min.css">
	<link rel="stylesheet" href="<?php echo $baseUrl; ?>/css/estilo.min.css">
	<link rel="stylesheet" href="<?php echo $baseUrl; ?>/css/font-awesome.min.css">
</head>
<body>
	<?php echo $menu; ?>

	<?php echo $contenido; ?>

	<footer class="footer">
		<p>ITEMSYSTEM 2016</p>
	</footer>
	<script src="<?php echo $baseUrl; ?>/js/jquery-1.12.3.min.js"></script>
	<script src="<?php echo $baseUrl; ?>/js/bootstrap.min.js"></script>
</body>
</html>