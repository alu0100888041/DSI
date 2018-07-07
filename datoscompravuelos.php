<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
    <html lang="es">
	<meta charset="UTF-8">
	<title>Datos de compra</title>
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
	        <li  class="active"><a href="vuelos.php">Vuelos</a></li>
	        <li><a href="hoteles.php">Hoteles</a></li>
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
	        <a href="#!" class="breadcrumb ">Ida y Vuelta</a>
			<a href="#!" class="breadcrumb ">Resumen</a>
			<a href="#!" class="breadcrumb ">Compra</a>
	      </div>
	    </div>
	</nav>










<!-- ////////////////////////////////////   Script patron proxy /////////////////////////////////////////////-->




<script type="text/javascript">
                	//1

//Funcion para validar dni
function validate_dni(dni) {

//Proxy
var continue_ = pre_validator_proxy(0, 0, dni);
if (continue_ != "Se han encontrado errores: <p>"){
    return continue_;
}

  //variables;
  var numero;
  var letr;
  var letra ='TRWAGMYFPDXBNJZSQVHLCKET';
  var expresion_regular_dni;
  var respuesta;

  //validar que el dni sea de formato 8 números / 1 letra
  expresion_regular_dni = /^\d{8}[a-zA-Z]$/;

  //validar que el dni sea de formato 8 números / 1 letra
  if(expresion_regular_dni.test (dni) == true){

       //extraer las diferentes partes
       numero = dni.substr(0,dni.length-1);
       letr = dni.substr(dni.length-1,1);

       //extraer secuencia
       numero = numero % 23;
       letra=letra.substring(numero,numero+1);

      if (letra!=letr.toUpperCase()) {
         respuesta = 'DNI INCORRECTO, la letra del NIF no se corresponde';
         dni = "";
       }else{
         respuesta = 'DNI CORRECTO';
       }
  }else{
     respuesta = 'DNI INCORRECTO, formato no válido';
     dni = "";
   }

   return respuesta;

}

				//2

function validate_email(email){

  //Proxy
  var continue_ = pre_validator_proxy(email, 0, 0);
  if (continue_ != "Se han encontrado errores: <p>"){
      return continue_;
  }

  if (/^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i.test(email)){
      respuesta = "Válido";
   } else {
      respuesta = "Email incorrecto";
   }
        return respuesta;
}

//3

function validate_phone(phone){

  //Proxy
  var continue_ = pre_validator_proxy(0, phone, 0);
  if (continue_ != "Se han encontrado errores: <p>"){
      return continue_;
  }

////
//Regular Expression HERE
////


}

//Proxy
function pre_validator_proxy(email, phone, Dni){

  var info = "Se han encontrado errores: <p>";

let validator = {

  set: function(obj, prop, value) {
    console.log("La propiedad es", prop);
    console.log("EL valor es ", value);
    //Phone
    if (prop === 'phone') {
      console.log("Comprobando phone ");


      if ( (parseInt(value[0]) != 6) && (parseInt(value[0]) != 7) ) {
        info += 'El teléfono móvil no puede empezar por ' + value[0] + ' <p>';
        correct = false;
        //console.log("El telefono debe ser un número");
      }

      if (value < 0) {
          info += 'El teléfono debe ser un número positivo <p>'
          correct = false;
          console.log("El telefono debe ser un número positivo");
      }

    }

    //Email
    if (prop === 'email') {
      console.log("Comprobando email ");
        var regex = new RegExp("^[0-9]+$");
        if (regex.test(value)){
          info += 'El email debe contener texto y no sólo numeros <p>'
          console.log("Numericos");
        }else if( /^[0-9][a-zA-Z]/i.test(value) ) {
          console.log("Perfe");

        }

    }

    //Dni
    if (prop === 'Dni') {
      console.log("Comprobando number ", value[0]);
      var regex = new RegExp("^[a-zA-Z]+$");
      if (regex.test(value[0])) {
        info += 'El Dni debe empezar por un número <p>'
          console.log("No usas numeros");
      }else{
          console.log("Perfe");
      }
    }


    obj[prop] = value;
    return true;
    }
};

let person = new Proxy({}, validator);

console.log("Creando");

if(email != 0){
  person.email = email;
  return info;
}else if(phone != 0){
  person.phone = phone;
  return info;
}else if(Dni != 0){
  person.Dni = Dni;
  return info;
}


}

</script>





<!-- ////////////////////////////////////////////////////////////////////////////////////////// -->






<?php 

  //Function -> Salida de datos.
function dataForm($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

$nombreValido = $apellidoValido = $emailValido = $telefonoValido = $dniValido = $errorsapellido = $errorsNombre = $errorsEmail = $errorsTel = $errorsdni = $nombre = $email = $telefono = $dni = $apellido = NULL;   

if(isset($_POST['submit']) && $_SERVER["REQUEST_METHOD"] == "POST") {
	$nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null ;
	$apellido = isset($_POST['apellidos']) ? $_POST['apellidos'] : null ;
	$nombreValido = dataForm($nombre);
    $apellidoValido = dataForm($apellido);
	$emailValido = dataForm($_POST['correo']);
    $telefonoValido = dataForm($_POST['telefono']);
    $dniValido = dataForm($_POST['dni']);

 //Regla nombre
  if (empty($_POST['nombre'])) {
    $errorsNombre = "\n Por favor ingrese su nombre."; 
  } elseif (!preg_match("/^[a-zA-Z ]*$/",$nombreValido)) {
    $errorsNombre = "\n Sólo se permiten letras y espacios en blanco"; 
  } else {  //Caso verdadero obtenemos datos.  
    $nombre = dataForm($_POST['nombre']);
  }

   //Regla apellido
  if (empty($_POST['apellidos'])) {
    $errorsapellido = "\n Por favor ingrese sus apellidos."; 
  } elseif (!preg_match("/^[a-zA-Z ]*$/",$apellidoValido)) {
    $errorsapellido = "\n Sólo se permiten letras y espacios en blanco"; 
  } else {  //Caso verdadero obtenemos datos.  
    $apellido = dataForm($_POST['apellidos']);
  }

  //Regla email
  if (empty($_POST['correo'])) {
    $errorsEmail = "\n Por favor ingrese su email. "; 
  } elseif (!filter_var($emailValido, FILTER_VALIDATE_EMAIL)) {
    $errorsEmail = "\n Ingrese un email con formato: texto@texto.texto";
  } else { //Caso verdadero obtenemos datos.  
    $email = dataForm($_POST['correo']);
  }

  //Regla telefono.
  if (empty($_POST['telefono'])) {
    $errorsTel = "\n Por favor ingrese su número telefono. "; 
  } elseif (!preg_match("/^[0-9]{9}$/", $telefonoValido)) {
    $errorsTel = "\n Número no valido, ingrese un número de 9 cifras";
  } else { //Caso verdadero obtenemos datos.  
    $telefono = dataForm($_POST['telefono']);
  }

    //Regla DNI.
  if (empty($_POST['dni'])) {
    $errorsdni = "\n Por favor ingrese su DNI. "; 
  } elseif (!preg_match("/^\d{8}[a-zA-Z]$/", $dniValido)) {
    $errorsdni = "\n Ingrese un DNI con formato: 99999999A";
  } else { //Caso verdadero obtenemos datos.  
    $dni = dataForm($_POST['dni']);
  }

 //Comprobamos si todos los datos son verdadero.
if ($nombre && $apellido && $email && $telefono && $dni){
 
 
if (isset($_POST['submit'])) {


	include 'conexion.php';

	$nombre = $_POST["nombre"];
	$apellidos = $_POST["apellidos"];
	$dni = $_POST["dni"];
	$telefono = $_POST["telefono"];
	$correo = $_POST["correo"];
	$pasajeros = $_SESSION['pasajeros'];
	$ida = $_SESSION['ida'];
    $vuelta = $_SESSION['vuelta'];
	$id_ida = $_SESSION['id_ida'];
	$id_vuelta = $_SESSION['id_vuelta'];
	$insertar_ida = "INSERT INTO reservas_vuelos VALUES('$nombre','$apellidos','$dni','$telefono','$correo','$pasajeros','$ida','$id_ida')";
	$insertar_vuelta = "INSERT INTO reservas_vuelos VALUES('$nombre','$apellidos','$dni','$telefono','$correo','$pasajeros','$vuelta','$id_vuelta')";

	$resultado = mysqli_query($con,$insertar_ida);
	$resultado2 = mysqli_query($con,$insertar_vuelta);


	if((!$resultado)&&(!$resultado2)){
?>
		 <h1 align="center">Error al realizar la compra</h1>

	<?php }else{ ?>

		<h1 align="center">Compra realizada con éxito</h1>
		<?php
	} } } }
		?>


<div class="error">

<?php 
//Caso enviar, mensaje OK, invisible formulario.   
if(isset($msg)){
  echo "<p class='err'>".$msg."</p>";
} else { //Caso falso mostramos formulario.
?>

</div>



<br><br>
	<h1 align="center">Datos de compra</h1>
<div class="container">
	<form action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>" method="POST" autocomplete="off" enctype="multipart/form-data">
		<div class="row">
			<div class="input-field col s2 nombre">
				<label for="nombre">Nombre</label>
				<input  type="text" name="nombre" id="nombre" required class="autocomplete">
				      
      <?php if (!empty($errorsNombre)) {  echo "<span class=estiloError>$errorsNombre</span>";  }  ?>
			</div>

			<div class="input-field col s4 offset-s2">
				<label for="apellidos">Apellidos</label>
				<input type="text" name="apellidos" id="apellidos" required class="autocomplete">
				      
      <?php if (!empty($errorsapellido)) {  echo "<span class=estiloError>$errorsapellido</span>";  }  ?>
			</div>

				<div class="input-field col s2 offset-s2">
				<label for="dni">DNI</label>
				<input type="text" id="dni" name="dni" required class="autocomplete" onFocusout='document.getElementById("demo").innerHTML = validate_dni(this.value);'>
				  <p id="demo"></p>


      <?php if (!empty($errorsdni)) {  echo "<span class=estiloError>$errorsdni</span>";  }  ?>
			</div>

		</div>

		<div class="row">
			<div class="input-field col s2">
				<label for="telefono">Número de teléfono</label>
				<input type="tel" id="telefono" name="telefono" required class="autocomplete" onFocusout='document.getElementById("demo3").innerHTML = validate_phone(this.value);'>
				<p id="demo3"></p>
				           
       <?php if (!empty($errorsTel)) {  echo "<span class=estiloError>$errorsTel</span>";  }  ?>
			</div>

			<div class="input-field col s4 offset-s2">
				<label for="correo">Correo electrónico</label>
				<input type="text" id="correo" name="correo" required class="autocomplete" onFocusout='document.getElementById("demo2").innerHTML = validate_email(this.value);'>
				<p id="demo2"></p>
			     
      	<?php if (!empty($errorsEmail)) {  echo "<span class=estiloError>$errorsEmail</span>";  }  ?>
			</div>
		</div>

		<div class="row">
			<button class="btn waves-effect waves-light col s2" type="submit" name="submit">Pagar
		    <i class="material-icons right">attach_money</i>
			</button>
		</div>


 <br><br>
	</form>
<?php } ?>
</div>
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
			<a href="compra.php">
			<img src="multimedia/español.jpg" title="Español" class="bandera" alt="español"></a>
			<a href="english/compra.php">
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