<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<title><?= $this->_titlepage ?></title>
	<title>Fondo de empleados Provenir</title>
	<link rel="stylesheet" href="/scripts/galeriafull/css/supersized.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="/skins/page/css/global.css">
	<link rel="stylesheet" href="/scripts/galeriafull/theme/supersized.shutter.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="/components/bootstrap/dist/css/bootstrap.min.css">
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.6.1/jquery.min.js"></script>
	<script type="text/javascript" src="/scripts/galeriafull/js/jquery.easing.min.js"></script>
	<script type="text/javascript" src="/scripts/galeriafull/js/supersized.3.2.7.min.js"></script>
	<script type="text/javascript" src="/scripts/galeriafull/theme/supersized.shutter.min.js"></script>
	
	<!-- lightgallery  -->
	<link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/1.7.0/css/lightgallery.min.css" />
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/lightgallery/1.7.0/js/lightgallery-all.min.js"></script>


	<meta property="og:url" content="http://localhost:8043/page/album?album=<?= $this->_data['idgaleria'] ?>" />
	<meta property="og:title" content="<?= $this->_data['titulogaleria'] ?>" />
	<meta property="og:description" content="<?= $this->_data['descripciongaleria'] ?>" />
	<meta property="og:image:width" content="400" />
	<meta property="og:image:height" content="300" />
	<meta property="og:image" content="hhttp://localhost:8043/<?= $this->_data['imagengaleria'] ?>" />
</head>

<body>
	<header>
		<?= $this->_data['header']; ?>
	</header>
	<div><?= $this->_content ?></div>
	
</body>

</html>