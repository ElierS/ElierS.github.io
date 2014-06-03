<?php
	require 'medoo.php';

	$database = new medoo([
		'database_type' => 'mysql',
		'database_name' => 'concurso',
		'server' => 'localhost',
		'username' => 'root',
		'password' => 'root'
	]);

	$id = $_REQUEST['id'];
	if($id){
		$datos = $database->select("tb_provincia", [
			"id","nombre"
		], ["id"=>$id]);
	}

	if($_POST){
		$nombre = $_POST['nombre'];
		$database->update("tb_provincia", [
			"nombre" => $nombre
		], ["id"=>$id]);

		header('Location: '.'listado-provincia.php');
	}
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Modificar Provincia</title>
</head>
<body class="mantenimiento">
	<div id="base">
		<?php include 'menu.php'; ?>
		<br/>
		<br/>
		<h1>Modificar provincia</h1>
		<br/>
		<br/>
		<form action="" method="post">
			<table>
				<tr>
					<td>
						<label>Provincia</label>
					</td>
					<td>
						<?php
						echo "<input class='marg' id='nombre' value='".$datos[0]["nombre"]."' type='text' name='nombre'>";
						?>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<button type="submit">Modificar</button>
						<button type="button" onclick="history.back()">Cancelar</button>
					</td>
				</tr>
			</table>
		</form>
	</div>
</body>
</html>