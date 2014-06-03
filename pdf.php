<?php
	
	require 'medoo.php';
	require('pdf/fpdf.php');
	
	$pdf = new FPDF();

	function trimString($str, $len, $sub){
		if (strlen($str) >= $len) return substr($str, 0, $sub). "...";
		else return $str;
	}

	function createTable($header, $obj){
		$w = [75,40,30,30,18];
		
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
	]
	);
		$i=0;
	    foreach($header as $col){
	    	$obj->Cell($w[$i],10,$col,1);
	    	$i++;
		}
	    $obj->Ln();
    
	    foreach($datos as $row){
			$obj->Cell(75,8,trimString($row["nombre_usr"], 43, 37), 1);
			$obj->Cell(40,8,trimString($row["apellido_usr"], 27, 20), 1);
			$obj->Cell(30,8,$row["id_codigo"], 1);
			$obj->Cell(30,8,$row["nombre_tienda"], 1);
			$obj->Cell(18,8,$row["noticias"], 1);

			$obj->Ln();

		}
      $obj->Output();
   }

	$pdf->SetFont('Arial','I',10);
	$header = ['Nombre','Apellido','Codigo','Tienda','Noticias'];

	$pdf->AddPage();
	createTable($header, $pdf);

?>