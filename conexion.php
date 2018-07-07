<?php
	// class conexion{
	// 	function recuperarDatos(){
			$host = "localhost";
			$user = "root";
			$pw = "";
			$db = "tripfinder";
			$con = mysqli_connect($host, $user, $pw, $db);// or die ("problemas al conectar server");






			// $mysqli=new mysqli($host, $user, $pw)

			// if ($mysqli->connect_error) {
			//     apc_store('dbStatus', 'down');
			// } else {
			//     apc_store('dbStatus', 'up');
			//     $mysqli->close();
			// }


			// if (apc_fetch('dbStatus') === 'down') {
			//     echo 'The database server is currently not available. Please try again in a minute.';
			//     exit;
			// }

			// $mysqli = new mysqli('localhost', 'user', 'pass', 'database');

?>