<?php
	session_start();
	include 'dw_code.php';
	if(($_SESSION['funcao']=='Administrador') or ($_SESSION['funcao']=='Gestor')){
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Adicionar Serviço</title>
		<meta charset="utf-8">
		<link rel="shortcut icon" href="dw_img/dw_logo1.png"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="https://fonts.googleapis.com/css?family=Poppins:300" rel="stylesheet">
		<link rel="stylesheet" type="text/css" href="dw_serv_css.css">
        <script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <script>
			$(window).load(function() {
				// loader
				$(".loader").fadeOut();;
			});
		</script>
		<style>
			.loader {
			position: fixed;
			left: 0px;
			top: 0px;
			width: 100%;
			height: 100%;
			z-index: 9999;
			background: url(dw_img/Preloader_6.gif) center no-repeat #fff;
			}
			.button {
				color: black;
				text-align: center;
				font-size: 30px;
				padding: 10px;
				width: 100px;
				transition: all 0.5s;
			}
			.button a{text-decoration: none;}
			.button span {
				cursor: pointer;
				display: inline-block;
				position: relative;
				transition: 0.5s;
			}
			.button span:after {
				content: '\00AB';
				position: absolute;
				opacity: 0;
				top: 0;
				left: -10px;
				transition: 0.5s;
			}
			a{text-decoration:none;}
			.button:after{content:'Adicionar Certificado/Parceria';}
			.button:hover:after{content:'Voltar'; color: #2481BA;}
			.button:hover span {padding-left: 10px; color: #2481BA;}
			.button:hover span:after {
				opacity: 1;
				left: 0;
			}
			h1{text-align:center;}
		</style>
	</head>
	<body style="background-image: url('dw_img/4288.jpg');">
    <div class="loader"></div>
		<form method="post" enctype="multipart/form-data" action="dw_code.php">
			<table style="margin: auto;">
				<th style="padding-bottom: 50px" colspan="2"><img src="dw_img/001-career.png" width="70px"><br><h1><a class="button" href="index.php"><span>&nbsp;</span></a></h1></th>
				<tr>
					<td><input type="text" id="ecp" name="ecp" required placeholder="Nome da empresa"></td>
				</tr>
				<tr>
					<td><input type="text" id="ncp" name="ncp" required placeholder="Nome do certificado"></td>
				</tr>
				<tr>
					<td><input type="file" id="fcp" name="fcp" required style="font-family: Poppins"></td>
				</tr>
				<td><input type="submit" name="adcp" id="adcp" value="Adicionar"></td>
			</table>
		</form>
	</body>
</html>
<?php }else{header('Location:index.php');} ?>