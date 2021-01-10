<!DOCTYPE html>
<html>
	<head>
		<title>Registo</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="shortcut icon" href="dw_img/dw_logo1.png"/>
		<link rel="stylesheet" type="text/css" href="dw_reg_css.css">
		<link href="https://fonts.googleapis.com/css?family=Poppins:300" rel="stylesheet">
		<script src='https://www.google.com/recaptcha/api.js'></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <script>
			$(window).load(function() {
				$(".loader").fadeOut();;
			});
		</script>
	</head>
	<body>
    	<div class="loader"></div>
		<form method="post" action="dw_code.php">
			<table>
				<th colspan="2"><img src="dw_img/002-people.png" width="70px"><br><h1><a class="button" href="index.php"><span>&nbsp;</span></a></h1></th>
				<tr>
					<td>Nome:</td>
					<td><input type="text" name="reg_nome" id="reg_nome" placeholder="Digite o seu nome" required></td>
				</tr>
				<tr>
					<td>Contacto:</td>
					<td><input type="number" name="reg_cont" id="reg_cont" placeholder="Digite o seu contacto" required></td>
				</tr>
				<tr>
					<td>Email:</td>
					<td><input type="email" name="reg_mail" id="reg_mail" placeholder="Digite o seu email" required></td>
				</tr>
				<tr>
					<td>Senha:</td>
					<td><input type="password" name="reg_pp" id="reg_pp" placeholder="Digite a sua password" required></td>
				</tr>
				<tr>
					<td>Confirmar senha:</td>
					<td><input type="password" name="reg_cpp" id="reg_cpp" placeholder="Digite a sua password" required></td>
				</tr>
				<td><input type="submit" name="reg" id="reg" value="Registar"></td>
				<td><div class="g-recaptcha" data-sitekey="6Ld9-lwUAAAAAEZS06Ri4c6CUUzJdicgrQQfy0mo"></div></td>
			</table>
		</form>
	</body>
</html>