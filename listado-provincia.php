<?php
require "medoo.php";

$database = new medoo([
	'database_type' => 'mysql',
	'database_name'=>'concurso',
	'server'=> 'localhost',
	'username' => 'root',
	'password' => 'root']);

$datos=$database->select("tb_provincia",["id","nombre"
	],["ORDER"=>"nombre"]);
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Listado Provincia</title>
</head>
<body class="listado">
	<div id="base">
		<?php include 'menu.php'; ?>
		<br/>
		<br/>
		<h1>Listado general de provincias</h1>
		<br/>
		<br/>
		<p><a href="insert-provincia.php">Agregar una nueva provincia</a></p>
		<table>
			<tr class="trh">
				<td><label>Provincia<label/></td>
				<td><label>Opciones<label/></td>
			</tr>	
			<?php
			$i = 1;
			foreach ($datos as $data) {
				if($i%2 != 0){
					echo "<tr><td>".$data['nombre']."</td><td><a href='modificar-provincia.php?id=".$data["id"]."'><img src='./img/edit.png'/><a/>&nbsp;&nbsp;<a href='eliminar-provincia.php?id=".$data["id"]."'><img src='./img/delete.png'><a/></td></tr>";
				}else{
					echo "<tr class='tr1'><td>".$data['nombre']."</td><td><a href='modificar-provincia.php?id=".$data["id"]."'><img src='./img/edit.png'/><a/>&nbsp;&nbsp;<a href='eliminar-provincia.php?id=".$data["id"]."'><img src='./img/delete.png'><a/></td></tr>";
				}
				$i++;
			}
			?>
		</table>
	</div>
</body>
</html>

