<?php
session_start();
?>


<!DOCTYPE html>
<html>
<head>
    <html lang="es">
	<meta charset="UTF-8">
	<title>Compra</title>
	<link rel="stylesheet" type="text/css" href="css/compra.css">
	<link rel="stylesheet" type="text/css" href="css/materialize.min.css">
	<!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.98.0/css/materialize.min.css">-->
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<script type = "text/javascript" src = "https://code.jquery.com/jquery-3.3.1.min.js"></script>           
    <script src = "https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.3/js/materialize.min.js"></script> 
	<script src="js/irarriba.js"></script>
</head>
<body>
	<div class="navbar-fixed">
	<nav>
	    <div class="nav-wrapper">
	      <a href="index.php" class="brand-logo">TripFinder</a>
	      <ul id="nav-mobile" class="right hide-on-med-and-down margencabeceras">
	        <li><a href="index.php">Inicio</a></li>
	        <li><a href="vuelos.php">Vuelos</a></li>
	        <li class="active"><a href="hoteles.php">Hoteles</a></li>
	        <li><a href="contacto.php">Contacto</a></li>
	        <li><a href="login.php">Login</a></li>
	      </ul>
	    </div>
	</nav>
	</div>

	<nav>
	    <div class="nav-wrapper margenbread">
	      <div class="col s12">
	        <a href="#!" class="breadcrumb margenbreadtext">Vuelos</a>
	        <a href="#!" class="breadcrumb">Compra</a>
	      </div>
	    </div>
	</nav>

	<h1 align="center">Resumen de reserva</h1>
	<br><br>
<div class="container">
	<table class="centered highlight bordered">
		<thead class="row">
			<tr>
				<th class="col s2">Isla</th>
				<th class="col s2">Hotel</th>
				<th class="col s2">Entrada</th>
				<th class="col s2">Salida</th>
				<th class="col s1">Huéspedes</th>
				<th class="col s2">Habitaciones</th>
				<th class="col s1">Precio total</th>
			</tr>
		</thead>
		
<?php
include("conexion.php");
mysqli_select_db($con,$db) or die ("problemas al conectar base de datos");
	$id_hotel = $_POST['grupo1'];
	
	$consulta_hotel = "SELECT * FROM hoteles WHERE id= '$id_hotel'";
	$registro = mysqli_query($con,$consulta_hotel) or die ("problemas en consulta: ". mysqli_error());
	$reg = mysqli_fetch_array($registro);
	$_SESSION['hotel'] = $reg['hotel'];
	$_SESSION['precio'] = $reg['precio'];
?>

		<tbody class="row">
			<tr>
				<td class="col s2"><?php echo $reg['isla']?></td>
				<td class="col s2"><?php echo $reg['hotel']?></td>
				<td class="col s2"><?php echo $_SESSION['entrada']?></td>
				<td class="col s2"><?php echo $_SESSION['salida']?></td>
				<td class="col s1"><?php echo $_SESSION['huespedes']?></td>
				<td class="col s2"><?php echo $_SESSION['habitaciones']?></td>
				<td class="col s1"><?php echo ($reg['precio']*$_SESSION['habitaciones']*$_SESSION['huespedes'])?>€</td>
			</tr>
		</tbody>
	</table>
<br><br>

	<form action="datoscomprahoteles.php">
		<div class="row">
			<button class="btn waves-effect waves-light col s2" type="submit" name="submit">Continuar
		    <i class="material-icons right">arrow_forward</i>
			</button>
	</form>
	<form action="hoteles.php">
			<button class="btn waves-effect waves-light col s2 offset-s1" type="submit" name="submit">Cancelar
		    <i class="material-icons right">close</i>
			</button>
		</div>
	</form>

</div>

<footer class="page-footer foo">


	<div class="volverarriba">
		<a href="#" id="volverarriba" title="Volver hacia arriba"></a>
	</div>


	<div class="container">
		<div class="row col s10">
				<h1 class="contactanos">Contáctanos</h1>
			
		</div>
			
		<div class="row">
				<p class="col s12">Si tienes cualquier duda sobre tu compra, reserva o la web, puedes contactar con nosotros como prefieras:</p>
		</div>
			
		<div class="row">
			<ul><img class="col s1 info" src="./multimedia/contacto.png" alt="telefono"> <p class="col s6">Teléfono: +34 922 1658 7235</p> </ul>
			</div>
			
		<div class="row">
			<ul> <img class="col s1 info" src="./multimedia/chat.png" alt="chat"> <p class="col s6">Chat</p></ul>
		</div>
		
		<div class="row">
			<ul><img class="col s1 info" src="./multimedia/facebook.png" alt="facebook"> <p class="col s6">Facebook: <a class="color" href=" www.facebook.com/VuelosTop.ES">  facebook.com/VuelosTop.ES </a></p> </ul>
		</div>

		<div>
			<a href="pagarhoteles.php">
			<img src="multimedia/español.jpg" title="Español" class="bandera" alt="español"></a>
			<a href="english/pagarhoteles.php">
			<img src="multimedia/ingles.png" title="Inglés" class="bandera" alt="inglés"></a>
		</div>
	</div>


    <!-- POLITICAS -->
    <div class="footer-copyright">
    	<div class="container left-align">
		 Política de privacidad &nbsp; © 2018 TripFinder Inc
		</div>
		<a class="container right-align" href="singleton.html">Info. Aerolíneas</a>
	</div>
</footer>
</body>
</html>