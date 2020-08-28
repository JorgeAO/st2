<?php 
	setlocale (LC_ALL, "es_ES");
	date_default_timezone_set ('America/Bogota'); 
?>
<script type="text/javascript" src="../recursos/librerias/jquery/jquery-3.2.0.min.js"></script>
<script type="text/javascript" src="../recursos/librerias/propias/js/scripts.js"></script>
<script type="text/javascript" src="../recursos/librerias/bootstrap/bootstrap-4.1.2/js/bootstrap.min.js"></script>

<link rel="stylesheet" type="text/css" href="../recursos/librerias/bootstrap/bootstrap-4.1.2/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="../recursos/librerias/propias/css/estilos.css">
<link rel="stylesheet" type="text/css" href="/SmartTrader/recursos/librerias/fontawesome/font-awesome-4.7.0/css/font-awesome.min.css">

<? require 'Menu.php'; ?>

<br>

<div class="col-sm-12">
	<div class="row">
		<div class="col-sm-3">
			<div class="card bg-info text-white">
				<div class="card-body">
					<p class="texto-26"><?=date('l d').' / '.date('F').' / '.date('Y')?></p>
				</div>
			</div>
		</div>
	</div>
</div>