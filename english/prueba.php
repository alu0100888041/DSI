<?php
	include 'conexion.php';
	$query1 = mysqli_query($con,"SELECT id, origen FROM binter GROUP BY origen");
	$query2 = mysqli_query($con,"SELECT id, destino FROM binter GROUP BY destino");
	$query3 = mysqli_query($con,"SELECT id, origen FROM binter GROUP BY origen");
	$query4 = mysqli_query($con,"SELECT id, destino FROM binter GROUP BY destino");
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>TripFinder</title>
	<link rel="stylesheet" type="text/css" href="css/vuelos.css">
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
	      <a href="index.html" class="brand-logo">TripFinder</a>
	      <ul id="nav-mobile" class="right hide-on-med-and-down margencabeceras">
	        <li><a href="index.html">Inicio</a></li>
	        <li  class="active"><a href="vuelos.php">Vuelos</a></li>
	        <li><a href="hoteles.html">Hoteles</a></li>
	        <li><a href="vuho.html">Vuelo+Hotel</a></li>
	        <li><a href="contacto.html">Contacto</a></li>
	      </ul>
	    </div>
	</nav>
</div>

<nav>
    <div class="nav-wrapper margenbread">
      <div class="col s12">
        <a href="#!" class="breadcrumb margenbreadtext">Vuelos</a>
      </div>
    </div>
</nav>


<div class="container">
	<div class="row margentabs">
	    <div class="col s12">
	      <ul class="tabs">
	      	<li class="tab col s3"><a class="active" href="#idavuelta">Ida y vuelta</a></li>
	        <li class="tab col s3"><a href="#ida3">Solo ida</a></li>
	      </ul>
	    </div>
	<form action="<?php echo HTMLSPECIALCHARS($_SERVER['PHP_SELF'])?>" method="post" name="frm">
			<div id="idavuelta" class="col s12">
				<div class="row">
					<div class="col s12">
					    <div class="row">
					        <div class="input-field col s3">
					        	<select name="origen">
					        		<option value="" disabled selected>Origen</option>
									<?php while($datos = mysqli_fetch_array($query1)){
									?>
									     <option value="<?php echo $datos['origen']?>"> <?php echo $datos['origen']?> </option>
									<?php
										}
									?>
    							</select>
					          <!-- <input type="text" name="origen" id="origen" class="autocomplete">
					          <label for="origen">Origen</label> -->
					        </div>
					        <div class="input-field col s3">
					        	<select name="destino">
					        		<option value="" disabled selected>Destino</option>
									<?php while($datos2 = mysqli_fetch_array($query2)){
									?>
									     <option value="<?php echo $datos2['destino']?>"> <?php echo $datos2['destino']?> </option>
									<?php
										}
									?>
					        	</select>

					          <!-- <input type="text" id="destino" name="destino" class="autocomplete">
					          <label for="destino">Destino</label> -->
					        </div>
					        <div class="input-field col s2">
					          <input type="text" id="ida" name="ida" class="datepicker">
					          <label for="ida">Ida</label>
					        </div>
					        <div class="input-field col s2">
					          <input type="text" id="vuelta" name="vuelta" class="datepicker">
					          <label for="vuelta">Vuelta</label>
					        </div>
					        <div class="input-field col s2">
					          <input type="text" id="pasajeros" name="pasajeros" class="autocomplete">
					          <label for="pasajeros">Número de pasajeros</label>
					        </div>
					    </div>
					</div>
				</div>
			</div>



			<div id="ida3" class="col s12">
				<div class="row">
					<div class="col s12">
					    <div class="row">
					        <div class="input-field col s3">
					        	<select name="origen">
					        		<option value="" disabled selected>Origen</option>
									<?php while($datos = mysqli_fetch_array($query3)){
									?>
									     <option value="<?php echo $datos['origen']?>"> <?php echo $datos['origen']?> </option>
									<?php
										}
									?>
    							</select>
					          <!-- <input type="text" id="origen2" class="autocomplete">
					          <label for="origen2">Origen</label> -->
					        </div>
					        <div class="input-field col s3">
					        	<select name="destino">
					        		<option value="" disabled selected>Destino</option>
									<?php while($datos2 = mysqli_fetch_array($query4)){
									?>
									     <option value="<?php echo $datos2['destino']?>"> <?php echo $datos2['destino']?> </option>
									<?php
										}
									?>
					        	</select>
					          <!-- <input type="text" id="destino2" class="autocomplete">
					          <label for="destino2">Destino</label> -->
					        </div>
					        <div class="input-field col s2">
					          <input type="text" id="ida2" class="datepicker">
					          <label for="ida2">Ida</label>
					        </div>
					        <div class="input-field col s2">
					          <input disabled type="text" id="disabled" class="validate">
					          <label for="disabled">Vuelta</label>
					        </div>
					        <div class="input-field col s2">
					          <input type="number" id="pasajeros2" class="autocomplete">
					          <label for="pasajeros2">Número de pasajeros</label>
					        </div>
					    </div>
					</div>
				</div>
			</div>

		</div>
		<div class="row">
			<button class="btn waves-effect waves-light col s2" type="submit" name="submit">Buscar
		    <i class="material-icons right">search</i>
			</button>
		    <button class="btn waves-effect waves-light col s3 offset-s1" type="reset" name="action">Refrescar valores
		    <i class="material-icons right">refresh</i>
		  	</button>
		</div>
	</form>

<?php
if (isset($_POST['submit'])) {
echo "<h1>IDA</h1> <br>";
$ida=0;
?>

<table class="centered responsive-table highlight bordered">
	<thead>
		<tr>
			<th><?php echo "Origen"?></th>
			<th><?php echo "Destino"?></th>
			<th><?php echo "Salida"?></th>
			<th><?php echo "Llegada"?></th>
			<th><?php echo "Aerolínea"?></th>
			<th><?php echo "Precio"?></th>
		</tr>
	</thead>
<!-- IDA BINTER -->
<?php
	include("conexion.php");

	mysqli_select_db($con,$db) or die ("problemas al conectar base de datos");
	// if (isset($_POST['submit'])) {
		$origen=$_POST["origen"];
		$destino=$_POST["destino"];
		$ida=$_POST["ida"];
		$SQL1 = "SELECT * FROM binter WHERE origen= '$origen' AND destino='$destino'";
		$registro1 = mysqli_query($con,$SQL1) or die ("problemas en consulta: ". mysqli_error());

		while ($reg = mysqli_fetch_array($registro1)) {
?>
	<tbody>
		<tr>
			<td><?php echo $reg['origen']?></td>
			<td><?php echo $reg['destino']?></td>
			<td><?php echo $reg['salida']?></td>
			<td><?php echo $reg['llegada']?></td>
			<td><?php echo $reg['aerolinea']?></td>
			<td><a href="#"><?php echo $reg['precio']?>€</a></td>
		</tr>
<?php
	$ida=$ida+1;
		}
		// }
?>

<!-- IDA CANARY -->
<?php
	include("conexion.php");

	mysqli_select_db($con,$db) or die ("problemas al conectar base de datos");
	// if (isset($_POST['submit'])) {
		$origen=$_POST["origen"];
		$destino=$_POST["destino"];
		$ida=$_POST["ida"];
		$SQL2 = "SELECT * FROM canaryfly WHERE origen= '$origen' AND destino='$destino'";
		$registro2 = mysqli_query($con,$SQL2) or die ("problemas en consulta: ". mysqli_error());

		while ($reg2 = mysqli_fetch_array($registro2)) {
?>
		<tr>
			<td><?php echo $reg2['origen']?></td>
			<td><?php echo $reg2['destino']?></td>
			<td><?php echo $reg2['salida']?></td>
			<td><?php echo $reg2['llegada']?></td>
			<td><?php echo $reg2['aerolinea']?></td>
			<td><a href="#"><?php echo $reg2['precio']?>€</a></td>
		</tr>
	</tbody>
<?php
	$ida=$ida+1;
		}
	if ($ida==0) {
		echo "Disculpe señor/a, no hay vuelos con esta ruta.";
	}
		}
?>
</table>



<?php
if (isset($_POST['submit'])) {
echo "<h1>VUELTA</h1> <br>";
$vuelta=0;
?>

<table class="centered responsive-table highlight bordered">
	<thead>
		<tr>
			<th>Origen</th>
			<th>Destino</th>
			<th>Salida</th>
			<th>Llegada</th>
			<th>Aerolínea</th>
			<th>Precio</th>
		</tr>
	</thead>
<!-- VUELTA BINTER -->
<?php
	include("conexion.php");

	mysqli_select_db($con,$db) or die ("problemas al conectar base de datos");
	// if (isset($_POST['submit'])) {
		$origen=$_POST["origen"];
		$destino=$_POST["destino"];
		$ida=$_POST["ida"];
		$SQL3 = "SELECT * FROM binter WHERE origen= '$destino' AND destino='$origen'";
		$registro3 = mysqli_query($con,$SQL3) or die ("problemas en consulta: ". mysqli_error());

		while ($reg3 = mysqli_fetch_array($registro3)) {
?>
	<tbody>
		<tr>
			<td><?php echo $reg3['origen']?></td>
			<td><?php echo $reg3['destino']?></td>
			<td><?php echo $reg3['salida']?></td>
			<td><?php echo $reg3['llegada']?></td>
			<td><?php echo $reg3['aerolinea']?></td>
			<td><a href="#"><?php echo $reg3['precio']?>€</a></td>
		</tr>
<?php
	$vuelta=$vuelta+1;
		}
		//}
?>

<!-- VUELTA CANARY -->
<?php
	include("conexion.php");

	mysqli_select_db($con,$db) or die ("problemas al conectar base de datos");
	// if (isset($_POST['submit'])) {
		$origen=$_POST["origen"];
		$destino=$_POST["destino"];
		$ida=$_POST["ida"];
		$SQL4 = "SELECT * FROM canaryfly WHERE origen= '$destino' AND destino='$origen'";
		$registro4 = mysqli_query($con,$SQL4) or die ("problemas en consulta: ". mysqli_error());

		while ($reg4 = mysqli_fetch_array($registro4)) {
?>
		<tr>
			<td><?php echo $reg4['origen']?></td>
			<td><?php echo $reg4['destino']?></td>
			<td><?php echo $reg4['salida']?></td>
			<td><?php echo $reg4['llegada']?></td>
			<td><?php echo $reg4['aerolinea']?></td>
			<td><a href="#"><?php echo $reg4['precio']?>€</a></td>
		</tr>
	</tbody>
<?php
	$vuelta=$vuelta+1;
		}
	if ($vuelta==0) {
		echo "Disculpe señor/a, no hay vuelos con esta ruta.";
	}
		}
?>
</table>

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
			<ul><img class="col s1 info" src="./multimedia/contacto.png" alt="contacto"> <p class="col s6">Teléfono: +34 922 1658 7235</p> </ul>
			</div>
			
		<div class="row">
			<ul> <img class="col s1 info" src="./multimedia/chat.png" alt="contacto"> <p class="col s6">Chat</p></ul>
		</div>
		
		<div class="row">
			<ul><img class="col s1 info" src="./multimedia/facebook.png" alt="contacto"> <p class="col s6">Facebook: <a class="color" href=" www.facebook.com/VuelosTop.ES">  facebook.com/VuelosTop.ES </a></p> </ul>
		</div>
	</div>


    <!-- POLITICAS -->
    <div class="footer-copyright">
    	<div class="container right-align">
		 Política de privacidad &nbsp; © 2018 TripFinder Inc
		</div>
	</div>
</footer>

<script>
$(function(){
	$('.datepicker').pickadate({
		monthsFull: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
		monthsShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct', 'Nov', 'Dic'],
		weekdaysFull: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
		weekdaysShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Jue', 'Vie', 'Sáb'],
		selectMonths: true,
		selectYears: 100, // Puedes cambiarlo para mostrar más o menos años
		today: 'Hoy',
		clear: 'Limpiar',
		close: 'Ok',
		labelMonthNext: 'Siguiente mes',
		labelMonthPrev: 'Mes anterior',
		labelMonthSelect: 'Selecciona un mes',
		labelYearSelect: 'Selecciona un año',
		format:'yyyy/mm/dd'
		
	});
});
</script>

<script type="text/javascript">
	$(document).ready(function(){
		$('select').material_select();
	});
</script>

</body>
</html>