<?php
	header('Content-Type: text/csv; charset=utf-8');
	header('Content-Disposition: attachment; filename=datos.csv');
	require 'medoo.php';
	    
    $database = new medoo([
        'database_type' => 'mysql',
        'database_name' => 'concurso',
        'server' => 'localhost',
        'username' => 'root',
        'password' => 'root'
    ]);

	$datos = $database->select("tb_usuarios",[
"[><]tb_provincia"=>["id_provincia"=>"id"],
"[><]tb_tienda"=>["id_tienda"=>"id"],
"[><]tb_cupones"=>["id_codigo"=>"id"] 
],[
	"tb_usuarios.nombre_usr",
	"tb_usuarios.apellido_usr",
	"tb_usuarios.id_codigo",
	"tb_tienda.nombre_tienda",
	"tb_usuarios.noticias"
	]);

	$output = fopen('php://output', 'w');
	fputcsv($output, array('Nombre','Apellido','Codigo','Tienda','Noticias'));
	foreach($datos as $data){
		fputcsv($output, $data);
	}
	fclose($output);
	exit;
?>