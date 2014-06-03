<?php
require "medoo.php";

$database = new medoo([
	'database_type' => 'mysql',
	'database_name'=>'concurso',
	'server'=> 'localhost',
	'username' => 'root',
	'password' => 'root']);

$datos=$database->select("tb_tienda",["id","nombre_tienda"
	],["ORDER"=>"nombre_tienda"]);
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Listado Tienda</title>
</head>
<body class="listado">
	<div id="base">
		<?php include 'menu.php'; ?>
		<br/>
		<br/>
		<h1>Listado general de tiendas</h1>
		<br/>
		<br/>
		<p><a href="insert-tienda.php">Agregar una nueva tienda</a></p>
		<table>
			<tr class="trh">
				<td><label>Tienda<label/></td>
				<td><label>Opciones<label/></td>
			</tr>	
			<?php
			$i = 1;
			foreach ($datos as $data) {
				if($i%2 != 0){
					echo "<tr><td>".$data['nombre_tienda']."</td><td><a href='modificar-tienda.php?id=".$data["id"]."'><img src='./img/edit.png'/><a/>&nbsp;&nbsp;<a href='eliminar-tienda.php?id=".$data["id"]."'><img src='./img/delete.png'><a/></td></tr>";
				}else{
					echo "<tr class='tr1'><td>".$data['nombre_tienda']."</td><td><a href='modificar-tienda.php?id=".$data["id"]."'><img src='./img/edit.png'/><a/>&nbsp;&nbsp;<a href='eliminar-tienda.php?id=".$data["id"]."'><img src='./img/delete.png'><a/></td></tr>";
				}
				$i++;
			}
			?>
		</table>
	</div>
</body>
</html>

