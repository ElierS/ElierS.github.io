<?php
require "medoo.php";

$database = new medoo([
	'database_type' => 'mysql',
	'database_name'=>'concurso',
	'server'=> 'localhost',
	'username' => 'root',
	'password' => 'root']);

if($_POST){
	$tienda = $_POST['tienda'];

	$database->insert("tb_tienda",[
		"nombre_tienda"=>$tienda
	]);

	header('Location: '.'listado-tienda.php');
}
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Ingresar Tienda</title>
</head>
<body class="mantenimiento">
	<div id="base">
		<?php include 'menu.php'; ?>
		<br/>
		<br/>
		<h1>Ingrese una nueva tienda</h1>
		<br/>
		<br/>
		<form action="" method="post">
			<table>
				<tr>
					<td>
						<label>Tienda</label>
					</td>
					<td>
						<input class='marg' type="text" name="tienda">
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