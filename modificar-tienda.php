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
		$datos = $database->select("tb_tienda", [
			"id","nombre_tienda"
		], ["id"=>$id]);
	}

	if($_POST){
		$nombre_tienda = $_POST['nombre_tienda'];
		$database->update("tb_tienda", [
			"nombre_tienda" => $nombre_tienda
		], ["id"=>$id]);

		header('Location: '.'listado-tienda.php');
	}
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Modificar Tienda</title>
</head>
<body class="mantenimiento">
	<div id="base">
		<?php include 'menu.php'; ?>
		<br/>
		<br/>
		<h1>Modificar tienda</h1>
		<br/>
		<br/>
		<form action="" method="post">
			<table>
				<tr>
					<td>
						<label>Tienda</label>
					</td>
					<td>
						<?php
						echo "<input class='marg' id='nombre_tienda' value='".$datos[0]["nombre_tienda"]."' type='text' name='nombre_tienda'>";
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