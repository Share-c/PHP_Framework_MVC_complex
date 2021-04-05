<?php
use App\Config\HTML;
use App\Biblioteca\Idioma as Id;
?>
<!DOCTYPE html>
<html lang="<?= ICMP['idioma'] ?>">
<head>
	<meta charset="<?= HTML::$charset ?>">
	<title></title>
</head>
<body>
<?php require $this->vista->cuerpo(); ?>
</body>
</html>