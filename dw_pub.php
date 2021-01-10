<?php 
	session_start();
	function liga(){
	$liga = new mysqli("localhost", "root", "", "dw_db");
	if ($liga->connect_error){
			die('Erro na ligação : ('.$liga->connect_errno.') '.$liga->connect_error);
	}else
		return($liga);
}
if(($_SESSION['funcao']=='Administrador' or ($_SESSION['funcao']=='Gestor') or ($_SESSION['funcao']=='Publicador'))){	
?>
<!DOCTYPE html>
<html>
	<head>
		<title>Publicar</title>
		<meta charset="utf-8">
		<link rel="shortcut icon" href="dw_img/dw_logo1.png"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="https://fonts.googleapis.com/css?family=Poppins:300" rel="stylesheet">
        <script src="http://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
        <script>
			$(window).load(function() {
				$(".loader").fadeOut();;
			});
		</script>
		<style>
			@import url('https://fonts.googleapis.com/css?family=Poppins:300');
			*{font-family: Poppins;}
			.loader {
			position: fixed;
			left: 0px;
			top: 0px;
			width: 100%;
			height: 100%;
			z-index: 9999;
			background: url(dw_img/Preloader_6.gif) center no-repeat #fff;
			}
			input[type=text], input[type=submit]{
				width: 100%;
				margin: 8px 0;
				padding: 10px;
				border-radius: 4px;
				font-family: Poppins;
				display: inline-block;
				box-sizing: border-box;
				border: 1px solid black;
			}
			input[type=text]{
				padding: 20px;
				font-size: 20px;
			}
			table{
				padding: 50px;
				border-radius: 10px;
				background-color: white;
				border: 1px solid black;
			}
			textarea{
				width: 100%;
				resize: none;
			    height: 200px;
			    padding: 20px;
				font-size: 20px;
			    border-radius: 4px;
				font-family: Poppins;
			    box-sizing: border-box;
			    border: 1px solid black;
			}
			input[type=submit]{
			    color: white;
			    border: none;
			    margin: 8px 0;
			    padding: 14px 20px;
			    border-radius: 4px;
			    border: 1px solid #ccc;
			    background-color: #2E64FE;
			}
			input[type=submit]:hover{
			    background-color: White;
			    border: 1px solid #2E64FE;
			    color: #2E64FE;
			}
			h1, h6{
				text-align: center;
			}
			body{
				/*background-color: #CEE3F6;*/
				background-size: cover;
				background-position: center;
				background-repeat: no-repeat;
				background-attachment: scroll;
				background-image: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url('dw_img/8010.jpg');
			}
			.button1 {
				color: black;
				text-align: center;
				font-size: 30px;
				padding: 10px;
				width: 100px;
				transition: all 0.5s;
			}
			.button1 a{text-decoration: none;}
			.button1 span {
				cursor: pointer;
				display: inline-block;
				position: relative;
				transition: 0.5s;
			}
			.button1 span:after {
				content: '\00AB';
				position: absolute;
				opacity: 0;
				top: 0;
				left: -10px;
				transition: 0.5s;
			}
			.button1:hover span {padding-left: 15px; color: #2481BA;}
			.button1:hover span:after {
				opacity: 1;
				left: 0;
			}
			a{text-decoration:none;}
			.button1:after{content:'Alterar Notícia';}
			.button1:hover:after{content:'Voltar'; color: #2481BA;}
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
			.button:hover span {padding-left: 15px; color: #2481BA;}
			.button:hover span:after {
				opacity: 1;
				left: 0;
			}
			a{text-decoration:none;}
			.button:after{content:'Publicar Notícia';}
			.button:hover:after{content:'Voltar'; color: #2481BA;}
			h1{text-align:center;}
		</style>
	</head>
	<body>
    	<div class="loader"></div>
        <?php 
		if(isset($_GET['nt'])){
			$con=liga();
			$id=$_GET['nt'];
			$sql="SELECT id,titulo,noticia FROM dw_noticias WHERE id=?";
			$ligar = $con->prepare($sql);
			$ligar->bind_param('i',$id);
			$ligar->execute();
			$ligar->bind_result($id,$titulo,$noticia);
			if($ligar->fetch()){
				$id1=$id;
				$tit1=$titulo;
				$not1=$noticia;
		}
		?>
        <h1><a class="button1" href="dw_gestao.php?p=not_"><span>&nbsp;</span></a></h1>
		<form method="post" action="dw_code.php">
        	<input type="hidden" name="id2" id="id2"  value="<?php echo $id1; ?>">
			<table style="margin: auto;">
				<tr>
					<td><input type="text" name="tn" id="tn"  required value="<?php echo utf8_decode($tit1) ; ?>"></td>
				</tr>
				<tr>
					<td><textarea name="nt" id="nt" required><?php echo utf8_decode($not1);?></textarea></td>
				</tr>
				<td><input type="submit" name="pub" id="pub" value="Alterar"></td>
			</table>
		</form>
		<?php }else{ ?>
		<form method="post" action="dw_code.php">
			<table style="margin: auto;">
				<th style="padding-bottom: 50px" colspan="2"><img src="dw_img/001-career.png" width="70px"><br><h1><a class="button" href="index.php"><span>&nbsp;</span></a></h1></th>
				<tr>
					<td><input type="text" name="tn" id="tn" required placeholder="Digite o título da notícia"></td>
				</tr>
				<tr>
					<td><textarea name="nt" id="nt" required placeholder="Digite a notícia"></textarea></td>
				</tr>
				<td><input type="submit" name="pub" id="pub" value="Publicar"></td>
			</table>
		</form>
        <?php }?>
	</body>
</html>
<?php
	}else
	header('location:index.php');
?>