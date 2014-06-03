<?php
require "medoo.php";

$database = new medoo([
	'database_type' => 'mysql',
	'database_name'=>'concurso',
	'server'=> 'localhost',
	'username' => 'root',
	'password' => 'root']);

if($_POST){
	$provincia = $_POST['provincia'];

	$database->insert("tb_provincia",[
		"nombre"=>$provincia
	]);

	header('Location: '.'listado-provincia.php');
}
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Ingresar Provincias</title>
	<script src="js/jquery-1.10.2.js"></script>
	<script src="js/parsley.js"></script>
</head>
<body class="mantenimiento">
	<div id="base">
		<?php include 'menu.php'; ?>
		<br/>
		<br/>
		<h1>Ingrese una nueva provincia</h1>
		<br/>
		<br/>
		<form action="" method="post" parsley-validate>
			<table>
				<tr>
					<td>
						<label>Provincia</label>
					</td>
					<td>
						<input class='marg' type="text" name="provincia" placeholder="Provincia" parsley-required="true" parsley-error-message="Se requiere la provincia">
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<button type="submit">Agregar</button>
						<button type="button" onclick="history.back()">Cancelar</button>
					</td>
				</tr>
			</table>
		</form>
	</div>
</body>
</html>