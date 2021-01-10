<?php
	session_start();
	function liga(){
		$liga = new mysqli("localhost", "root", "", "dw_db");
		if ($liga->connect_error){
			die('Erro na ligação : ('.$liga->connect_errno.') '.$liga->connect_error);
		}else
			return($liga);
	}
?>
<?php
	if(isset($_SESSION['funcao'])){
		header('location:index.php');
	}else{?>
<!DOCTYPE html>
<html>
	<head>
		<title>Login</title>
		<link rel="shortcut icon" href="dw_img/dw_logo1.png"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="https://fonts.googleapis.com/css?family=Poppins:300" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="dw_log_css.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>
      	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script>
			$(window).load(function() {
				$(".loader").fadeOut();;
			});
		</script>
	</head>
	<body>
        <div class="loader"></div>
		<form method="post" action="index.php" name="lg">
			<table>
				<th colspan="2"><img src="dw_img/001-career.png" width="70px"><br><h1><a class="button" href="index.php"><span>&nbsp;</span></a></h1></th>
				<tr>
					<td>Email:</td>
					<td><input type="email" name="email" id="email" required placeholder="Digite o seu email"></td>
				</tr>
				<tr>
					<td>Palavra-passe:</td>
					<td><input type="password" name="password" id="password" required placeholder="Digite a sua palavra-passe"></td>
				</tr>
				<tr><td></td><td><input type="checkbox" onclick="myFunction()">Mostrar Palavra-passe</td></tr>
				<tr><td></td><td><a href="#" onclick="document.getElementById('id01').style.display='block'" style="width:auto;">Esqueci-me da palavra-passe</a></td></tr>
				<script>
					function myFunction() {
					    var x = document.getElementById("password");
					    if (x.type === "password") {
					        x.type = "text";
					    } else {
					        x.type = "password";
					    }
					}
				</script>
				<td><input type="submit" name="dw_log" id="dw_log" value="Entrar"></td>
			</table>
		</form>
		<div id="id01" class="modal">
			<form class="modal-content animate" method="post" action="dw_code.php">
				<div class="container" margin: auto;">
					<p><img src="dw_img/dw_logo1.png" width="50px"></p>
					<p><b>Inserir e-mail</b></p>
					<input type="email" placeholder="Insira o seu e-mail" name="nwe" id="nwe" required>
					<button type="submit" name="forgot" id="forgot">Enviar</button>
				</div>
			</form>
		</div>
		<script>
			var modal = document.getElementById('id01');
			window.onclick = function(event) {
			    if (event.target == modal) {
			        modal.style.display = "none";
			    }
			}
		</script>
	</body>
</html>
<?php }
?>