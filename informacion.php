<?php
require "medoo.php";

$database = new medoo([
	'database_type' => 'mysql',
	'database_name'=>'concurso',
	'server'=> 'localhost',
	'username' => 'root',
	'password' => 'root']);

$datos=$database->select("tb_usuarios",[
"[><]tb_provincia"=>["id_provincia"=>"id"],
"[><]tb_tienda"=>["id_tienda"=>"id"],
"[><]tb_cupones"=>["id_codigo"=>"id"] 
],[
	"tb_usuarios.nombre_usr",
	"tb_usuarios.apellido_usr",
	"tb_cupones.cupon",
	"tb_tienda.nombre_tienda",
	"tb_usuarios.noticias"
	]
);
?>
<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Información de Participantes</title>
</head>
<body class="listado">
	<div id="base">
		<?php include 'menu.php'; ?>
		<br/>
		<br/>
		<h2>Ver gr&aacute;fico de: <a id="link2" href="grafico-provincias.php">Participantes por provincia</a><a id="link2" href="grafico-tiendas.php">Participantes por tienda</a></h2>
		<br/>
		<br/>
		<h2>Exportar a: <a id="link" href="csv.php">CSV</a><a id="link" href="pdf.php" target="_blank">PDF</a></h2>
		<br/>
		<br/>
		<h1>Listado general de participantes</h1>
		<table border="1">
			<tr class="trh">
				<td><label>Nombre</label></td>
				<td><label>Apellido</label></td>
				<td><label>Codigo</label></td>
				<td><label>Tienda</label></td>
				<td><label>Noticias</label></td>
			</tr>
				<?php
			$i = 1;
			foreach ($datos as $data) {
				if($i%2 != 0){
					echo "<tr><td>".$data['nombre_usr']."</td><td>".$data['apellido_usr']."</td><td>".$data['cupon']."</td><td>".$data['nombre_tienda']."</td><td>".$data['noticias']."</td></tr>";
				}else{
					echo "<tr class='tr1'><td>".$data['nombre_usr']."</td><td>".$data['apellido_usr']."</td><td>".$data['cupon']."</td><td>".$data['nombre_tienda']."</td><td>".$data['noticias']."</td><tr>";
				}
				$i++;
			}
			?>
		</table>
	</div>
</body>
</html>