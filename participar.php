<?php
require "medoo.php";

$database = new medoo([
	'database_type' => 'mysql',
	'database_name'=>'concurso',
	'server'=> 'localhost',
	'username' => 'root',
	'password' => 'root']);

require_once('recaptchalib.php'); //libreria descargarda de Google
 
// Llaves creadas en Google
$publickey = "6LfFge8SAAAAABXg6y3FTjjJIvL_ANFrY9o0JoO2"; //llave publica
$privatekey = "6LfFge8SAAAAABS0MjULQPWLu7LFWc-KBaAgeoRr"; //lave privada
//Respuesta de reCAPTCHA
$resp = null;
# Errores de reCAPTCHA si es que hay
$error = null;
	if($_POST){
        	if ($_POST["recaptcha_response_field"]) { //
            	//la función necesita la llave privada.
            	$resp = recaptcha_check_answer ($privatekey, 
                                                    $_SERVER["REMOTE_ADDR"],
                                                    $_POST["recaptcha_challenge_field"],
                                                    $_POST["recaptcha_response_field"]); 
             
                if ($resp->is_valid) {
                    	$nombre = $_POST['nombre'];
						$apellido = $_POST['apellido'];
						$email = $_POST['email'];
						$provincia = $_POST['provincias'];
						$tienda = $_POST['tiendas'];
						$codigo = $_POST['codigo'];
						if(isset($_POST['noticias'])){
							$noticias="Si";
						}else{
							$noticias="No";
						}

						$dataprovincias=$database->select("tb_provincia",["id"],
							["nombre"=>$provincia]);

						$datatiendas=$database->select("tb_tienda",["id"]
							,["nombre_tienda"=>$tienda]);

						$datacodigo=$database->select("tb_cupones",["id"],
							["cupon"=>$codigo]);

						if(isset($datacodigo[0]["id"])){
							$cupon_duplicado=$database->select("tb_usuarios",["id_codigo"],
							["id_codigo"=>$datacodigo[0]["id"]]);

							if(isset($cupon_duplicado[0]["id_codigo"])){
								$errCupD = "El cupon ya existe";
							}else{
								$database->insert("tb_usuarios",[
									"nombre_usr"=>$nombre,
									"apellido_usr"=>$apellido,
									"email_usr"=>$email,
									"id_provincia"=>$dataprovincias[0]["id"],
									"id_tienda"=>$datatiendas[0]["id"],
									"id_codigo"=>$datacodigo[0]["id"],
									"noticias"=>$noticias
								]);
	                        header('Location: '.'confirmacion.php');
							}
						}else{
							$errCup = "No existe el cupon";
						}
                    } else {
                        //En caso falló el reCAPTCHA
                        // $error = $resp->error; 
                        $err = "Error en la captcha";//.$error;
                    }
            	}
        }
?>

<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Participar</title>
</head>
<body class="mantenimiento">
	<div id="base">
		<?php include 'menu.php'; ?>
		<br/>
		<br/>
		<h1>&#161;Particip&aacute; y gan&aacute;&#33;</h1>
		<br/>
		<br/>
		<form action="" method="post">
			<table>
				<tr>
					<td>
						<label>Nombre</label>
					</td>
					<td>
						<input class='marg' type="text" name="nombre">
					</td>
				</tr>
				<tr>
					<td>
						<label>Apellido</label>
					</td>
					<td>
						<input class='marg' type="text" name="apellido">
					</td>
				</tr>
				<tr>
					<td>
						<label>Email</label>
					</td>
					<td>
						<input class='marg' type="text" name="email">
					</td>
				</tr>
				<tr>
					<td>
						<label>Provincia</label>
					</td>
					<td>
						<select class='marg' name="provincias">
							<?php
							$provinc=$database->select("tb_provincia",["nombre"],["ORDER"=>"nombre"]);

							foreach ($provinc as $data) {
								echo "<option>".$data["nombre"]."</option>";
							}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						<label>Tienda</label>
					</td>
					<td>
						<select class='marg' name="tiendas">
							<?php
							$tiend=$database->select("tb_tienda",["nombre_tienda"],["ORDER"=>"nombre_tienda"]);

							foreach ($tiend as $data) {
								echo "<option>".$data["nombre_tienda"]."</option>";
							}
							?>
						</select>
					</td>
				</tr>
				<tr>
					<td>
						<label>C&oacute;digo Cup&oacute;n</label>
					</td>
					<td>
						<input class='marg' type="text" name="codigo">
					</td>
					<td>
						<?php 
							if(isset($errCup)){
								echo "<label>".$errCup."</label>";
							}
							if(isset($errCupD)){
								echo "<label>".$errCupD."</label>";
							}
						?>
					</td>
				</tr>
				<tr>
					<td>
						<input type="checkbox" name="noticias" value="1">Desea recibir noticias
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<?php     
                   			echo recaptcha_get_html($publickey, $error); //imprimimos el formulario de reCATPCHA
                		?>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<?php 
							if(isset($err)){
								echo "<label>".$err."</label>";
							}
						?>
					</td>
				</tr>
			</table>
			<p>
				<button type="submit">Participar</button>
				<button type="button" onclick="location='index.php'">Cancelar</button>
			</p>
		</form>
	</div>
</body>
</html>