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
		], ["id" => $id]);
	}

	if($_POST){
		$id = $_POST['id'];

		$database->delete("tb_tienda", ["id" => $id]);

		header('Location: '.'listado-tienda.php');
	}
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Eliminar Tienda</title>
</head>
<body class="mantenimiento">
	<div id="base">
		<?php include 'menu.php'; ?>
		<br/>
		<br/>
		<h1>Eliminar tienda</h1>
		<br/>
		<br/>
		<form action="" method="post">
			<p>
				<?php
					echo "<label>Desea realmente eliminar la tienda ".$datos[0]['nombre_tienda']."</label>";
				?>
				</br>
				</br>
				<button type="submit">Eliminar</button>
				<button type="button" onclick="history.back()">Cancelar</button>
				<?php
					echo "<input id='id' value='".$datos[0]['id']."' name='id' 
								type='hidden'>";
				?>
			</p>
		</form>
	</div>
</body>
</html>