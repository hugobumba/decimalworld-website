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
		<title>Adicionar Categoria</title>
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
			.button:hover span {padding-left: 15px; color: #2481BA;}
			.button:hover span:after {
				opacity: 1;
				left: 0;
			}
			a{text-decoration:none;}
			.button:after{content:'Alterar Categoria';}
			.button:hover:after{content:'Voltar'; color: #2481BA;}
			h1{text-align:center;}
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
			.button1:after{content:'Adicionar Categoria';}
			.button1:hover:after{content:'Voltar'; color: #2481BA;}
		</style>
	</head>
	<body>
    	<div class="loader"></div>
    	 <?php 
		if(isset($_GET['nt'])){
			$con=liga();
			$id=$_GET['nt'];
			$sql="SELECT id,nome,servico,foto FROM dw_servicos WHERE id=?";
			$ligar = $con->prepare($sql);
			$ligar->bind_param('i',$id);
			$ligar->execute();
			$ligar->bind_result($id,$nome,$serv,$foto);
			if($ligar->fetch()){
				$id1=$id;
				$nm=$nome;
				$ser1=$serv;
				$ft=$foto;
		}
		?>
        <form method="post" action="dw_code.php" enctype="multipart/form-data">
			<table style="margin: auto;">
				<th style="padding-bottom: 50px" colspan="2"><img src="dw_img/<?php echo $ft; ?>.jpg'" width="70px"><br><h1><a class="button" href="dw_gestao.php?p=serv_"><span>&nbsp;</span></a></h1></th>
				<tr>
                	<input type="hidden" id="id3" name="id3" value="<?php echo $id1; ?>">
					<td><input type="text" id="ts" name="ts" placeholder="Nova categoria" required value="<?php echo utf8_decode($nm); ?>"></td>
				</tr>
				<tr>
					<td><textarea type="text" id="ds" name="ds" required placeholder="Descriçao da categoria"><?php echo utf8_decode($ser1); ?></textarea></td>
				</tr>
				<td><input type="submit" name="add" id="add" value="Alterar"></td>
			</table>
		</form>
        <?php }else{ 
		?>
		<form method="post" action="dw_code.php" enctype="multipart/form-data">
			<table style="margin: auto;">
				<th style="padding-bottom: 50px" colspan="2"><img src="dw_img/001-career.png" width="70px"><br><h1><a class="button1" href="index.php"><span>&nbsp;</span></a></h1></th></th>
				<tr>
					<td><input type="text" id="ts" name="ts" required placeholder="Novo categoria"></td>
				</tr>
				<tr>
					<td><textarea type="text" id="ds" name="ds" required placeholder="Descriçao da categoria"></textarea></td>
				</tr>
				<tr>
					<td><input type="file" id="fs" name="fs" required style="font-family: Poppins"></td>
				</tr>
				<td><input type="submit" name="add" id="add" value="Adicionar"></td>
			</table>
		</form>
        <?php }?>
	</body>
</html>
<?php
	}else
	header('location:index.php');
?>