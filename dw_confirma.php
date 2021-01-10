<?php
	session_start();
?>
<?php
	if(($_SESSION['funcao']=='Administrador' or ($_SESSION['funcao']=='Gestor') or ($_SESSION['funcao']=='Publicador'))){
	?>
<!DOCTYPE html>
<html>
	<head>
		<title>Confirmação</title>
		<meta charset="utf-8">
		<link rel="shortcut icon" href="dw_img/dw_logo1.png"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="https://fonts.googleapis.com/css?family=Poppins:300" rel="stylesheet">
		<style>
			@import url('https://fonts.googleapis.com/css?family=Poppins:300');
			*{font-family: Poppins;}
			body{
				background-image: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url('dw_img/OLQE6F0.jpg');
				background-size: cover;
				background-position: center;
				background-repeat: no-repeat;
				background-attachment: fixed;
			}
			h1, p{
				text-align: center;
			}
			table{
				border: 1px solid black;
				padding: 50px;
				border-radius: 10px;
				background-color: white;
				margin: auto;
			}
			input[type=submit]{
			    width: 100%;
			    margin: 8px 0;
			    padding: 12px 20px;
			    border-radius: 4px;
			    display: inline-block;
			    border: 1px solid #ccc;
			    box-sizing: border-box;
			}
			select{
			    width: 100%;
			    padding: 12px;
			    border: 1px solid #ccc;
			    border-radius: 10px;
			    box-sizing: border-box;
			    margin-top: 6px;
			    margin-bottom: 16px;
			    resize: none;
			}
		</style>
	</head>
	<body>
		<form style="text-align: center;" method="post" action="dw_code.php">
			<table>
				<th style="padding-bottom: 50px" colspan="2"><img src="dw_img/001-career.png" width="70px"><br><h1>Aprovação</h1><br><?php
			echo "<p>Deseja confirmar a entrada de ".$_GET['nome']." (".$_GET['email'].")?<p><br>";
		?></th>
				<tr>
					<td>Confirmação:</td>
					<td>
						<select name="aut">
						<option value="" selected>- Confirmar -</option>
						<option value="sim">Sim</option>
						<option value="nao">Não</option>
						</select>
					</td>
				</tr>
				<tr>
					<td>Função:</td>
					<td>
						<select name="reg_fun">
						<option value="" selected>- Selecione a sua função -</option>
						<option value="Administrador">Administrador</option>
						<option value="Gestor">Gestor</option>
						<option value="Publicador">Publicador</option>
						<option value="Espera">Espera</option>
						</select>
					</td>
				</tr>
				<tr>
					<td><input type="hidden" name="hnome" value="<?php echo $_GET['nome']; ?>"></td>
					<td><input type="hidden" name="hemail" value="<?php echo $_GET['email']; ?>"></td>
					<td><input type="hidden" name="hcontacto" value="<?php echo $_GET['contacto']; ?>"></td>
					<td><input type="hidden" name="hsenha" value="<?php echo $_GET['senha']; ?>"></td>
					<td><input type="submit" name="conf" id="conf" value="Confirmar"></td>
				</tr>
			</table>
		</form>
	</body>
</html>
<?php }else{header('Location:dw_login.php');} ?>