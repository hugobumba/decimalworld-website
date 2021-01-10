<?php
	session_start();
	function liga(){
	$liga = new mysqli("localhost", "root", "", "dw_db");
	if ($liga->connect_error){
			die('Erro na ligação : ('.$liga->connect_errno.') '.$liga->connect_error);
	}else
		return($liga);
}
#terminar sessão
if (isset($_GET['op'])){
	if($_GET['op']=='Sair'){
		session_unset();
		session_destroy();
	}
}
#mudar nome
$vl=0;
if(isset($_POST["nm"])){
		$liga=liga();
		$kp=$_POST["nm"];
		$lp=$_POST["idn"];
		$sql="UPDATE dw_users SET nome=? WHERE id=?";
		$lista= $liga->prepare($sql);
		$lista->bind_param('si',$kp,$lp);
		if($lista->execute() && $liga->affected_rows>0){
			$vl=1;
			$lista->close();
		}
		$liga->close();
		if($vl=1)
		{
			$con=liga();
			$sql = "SELECT nome FROM dw_users WHERE id=?";
			$ligar = $con->prepare($sql);
			$ligar->bind_param('i',$lp);
			$ligar->execute();
			$ligar->bind_result($nome);
			if($ligar->fetch())
			{
				$_SESSION['nome']=$nome;
				echo '<script>alert("O nome foi alterado");</script>';
				$ligar->close();
				$con->close();
			}
				
		}
		$vl=0;
	}
#Mudar Senha
$vl=0;
	if(isset($_POST["ps"])){
		$lp=$_POST["idn"];
		$kp=$_POST["ps"];
		$ant=$_POST["ant"];
		if($_SESSION['senha'] == $ant)
		{
			$liga=liga();
			$sql="UPDATE dw_users SET senha=? WHERE id=?";
			$lista= $liga->prepare($sql);
			$lista->bind_param('si',$kp,$lp);
			if($lista->execute() && $liga->affected_rows>0){
				$vl=1;
				$lista->close();	
			}
			$liga->close();
			if($vl=1)
			{
				$con=liga();
				$sql = "SELECT senha FROM dw_users WHERE id=?";
				$ligar = $con->prepare($sql);
				$ligar->bind_param('i',$lp);
				$ligar->execute();
				$ligar->bind_result($senha);
				if($ligar->fetch())
				{
					$_SESSION['senha']=$senha;
					echo '<script>alert("A Password foi alterada");</script>';
					$ligar->close();
					$con->close();
				}	
			}
		$vl=0;
		}
		else
		{
			echo '<script>alert("A Password antiga não coicide");</script>';
		}
		$vl=0;		
	}
?>
<!DOCTYPE html>
<html>
	<head>
		<title>DecimalWorld</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="shortcut icon" href="dw_img/dw_logo1.png"/>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>	
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
		<script src="dw_nav.js"></script>
		<script src="dw_scroll.js"></script>
		<script>
			$(window).load(function() {
				$(".loader").fadeOut(500);
			});
			$(window).load(function() {
				$(".back").fadeOut(500);
			});
</script> 	
<!--STYLE-->
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
			background: url(dw_img/Preloader_5.gif) center no-repeat #fff;
			}
			.back{
				position: fixed;
				left: 0px;
				top: 0px;
				width: 100%;
				height: 100%;
				z-index: 9980;
				background-color:white;
			}
			.modiv{
				border: 1px solid #ccc;
				background-color: white;
				border-radius: 5px;
				padding: 25px;
			}
			.srvcs{transition: all 0.3s ease; opacity: 1; border: 1px solid black;}
			.srvcs:hover{
				transition: all 0.3s ease;	opacity: 2;
				border-radius: 30px;
			}
			.animate-fading{animation:fading 1s;}
			@keyframes fading{
				0%{opacity:0;}
				50%{opacity:1;}
			}
			hr{
				height: 5px;
				margin: 5px;
				border: 0;
				box-shadow: 15px 15px 15px -15px #2481BA inset;
			}
			td{padding: 5px;}
			.animate-bottom{position:relative; animation:animatebottom 0.4s;}
			@keyframes animatebottom{
				from{bottom:-300px; opacity:0;}
				to{bottom:0;opacity:1;}
			}
			.cool-link {
				display: inline-block;
				color: #000;
				text-decoration: none;
				width: 100%;
				color: #f1f1f1;
				padding: 0px 0;
				border-radius: 10px;
				text-decoration: none;
				display: inline-block;
				transition: background-color .5s;
				transition: all 0.3s ease;
				opacity:1;
			}
			.cool-link::after {
				content: '';
				display: block;
				width: 0;
				height: 2px;
				background: #000;
				transition: width .3s;
			}
			.cool-link:hover::after {
				width: 100%;
				transition: width .3s;
				transform: scale(1.1);
				opacity:2;
				transition:all 0.3s ease;
				text-shadow: 0px 0px 5px white;
			}
			body {
				font: 400 15px Lato, sans-serif;
				line-height: 1.8;
				color: #818181;
			}
			h2 {
				font-size: 24px;
				text-transform: uppercase;
				color: #303030;
				font-weight: 600;
				margin-bottom: 30px;
			}
			h4 {
				font-size: 19px;
				line-height: 1.375em;
				color: #303030;
				font-weight: 400;
				margin-bottom: 30px;
			}
			.dropdown-menu .sub-menu {
				left: 100%;	top: 0;
				position: absolute;
				visibility: hidden;
				margin-top: -1px;
			}
			.dropdown-menu li:hover .sub-menu {visibility: visible;}
			.dropdown:hover .dropdown-menu {display: block;}
			.nav-tabs .dropdown-menu,
			.dropdown-menu,
			.navbar .dropdown-menu {margin-top: 0;}
			.navbar .sub-menu:before {
				border-bottom: 7px solid transparent;
				border-left: none;
				border-right: 7px solid rgba(0, 0, 0, 0.2);
				border-top: 7px solid transparent;
				left: -7px;	top: 100px;
			}
			.navbar .sub-menu:after {
				border-top: 6px solid transparent;
				border-left: none;
				border-right: 6px solid #fff;
				border-bottom: 6px solid transparent;
				left: 10px;	top: 11px; left: -6px;
			}
			.nvbt{
				position: relative;
				display: block;
				padding: 10px 15px;
				background-color: rgba(255,255,255,0);
				border: 0px;
				color: white;
			}
			.bt{background-color: #2481BA; color: white;}
			.bt:hover{background-color: white; color: #2481BA;}  
			.jumbotron {
				background-color: #f4511e;
				color: #fff;
				padding: 100px 25px;
				font-family: Montserrat, sans-serif;
			}
			.container-fluid {padding: 60px 50px;}
			.bg-grey {background-color: #f6f6f6;}
			.logo-small {color: #f4511e; font-size: 50px;}
			.logo {color: #f4511e; font-size: 200px;}
			.thumbnail {
				padding: 0 0 15px 0;
				border: none;
				border-radius: 0;
			}
			.thumbnail img {width: 100%; height: 100%; margin-bottom: 10px;}
			.bt:hover{border: 1px solid #ccc; text-decoration:none;}
			.carousel-control.right, .carousel-control.left {
				background-image: none; color: #f4511e;
			}
			.carousel-indicators li {border-color: #f4511e;}
			.carousel-indicators li.active {background-color: #f4511e;}
			.item h4 {
				font-size: 19px;
				line-height: 1.375em;
				font-weight: 400;
				font-style: italic;
				margin: 70px 0;
			}
			.item span {font-style: normal;}
			.navbar {
				margin-bottom: 0;
				background-color: rgba(255,255,255,0);
				border: 0;
				font-size: 12px;
				line-height: 1.42857143;
				letter-spacing: 4px;
				border-radius: 0;
				font-family: Montserrat, sans-serif;
			}
			.navbar li a, .navbar .navbar-brand {color: #fff;}
			.navbar-nav li a:hover, .navbar-nav li.active a {
				color: #f4511e;
				background-color: #fff;
			}
			.navbar-fixed-top{background-color: rgba(255,255,255,0);}
			footer .glyphicon {
				font-size: 20px;
				margin-bottom: 20px;
				color: #f4511e;
			}
			.slideanim {visibility:hidden;}
			.slide {
				animation-name: slide;
				-webkit-animation-name: slide;
				animation-duration: 1s;
				-webkit-animation-duration: 1s;
				visibility: visible;
			}
			@keyframes slide {
				0% {opacity: 0;	transform: translateY(70%);} 
				100% {opacity: 1; transform: translateY(0%);}
			}
			@-webkit-keyframes slide {
				0% {opacity: 0; -webkit-transform: translateY(70%);} 
				100% {opacity: 1;-webkit-transform: translateY(0%);}
			}
			@media screen and (max-width: 768px) {
				.col-sm-4 {text-align: center; margin: 25px 0;}
				.btn-lg {width: 100%; margin-bottom: 35px;}
			}
			@media screen and (max-width: 480px) {
				.logo {font-size: 150px;}
			}
		</style>
		<!--<script>
	$(window).load(function() {
		$(".se-pre-con").fadeOut("slow");;
	});
</script>-->
	</head>
	<body id="myPage" data-spy="scroll" data-target="navbar" data-offset="60" onload="">
    	<div class="back"></div>
    	<div class="loader"></div>
		<nav class="navbar-default navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>                       
					</button>
					<a href="index.php"><img src="dw_img/dw_logo5.png" width="150px"></a>
				</div>
<!--NAVBAR-->
				<div class="collapse navbar-collapse" id="myNavbar">
					<div class="nav navbar-nav navbar-left">
						<li style="cursor:pointer"><a style="color: white;" onClick="window.location.href='index.php#sobre'">SOBRE</a></li>
						<li class="dropdown" style="cursor:pointer">
				            <a data-toggle="dropdown" class="dropdown-toggle" style="color: white;" onClick="window.location.href='index.php#services'">SERVIÇOS&#9662;</b></a>
				            <ul class="dropdown-menu">
				              	<?php
									$con=liga();
									$sql1 = "SELECT * FROM dw_servicos";
									$res1 = $con->query($sql1);
									if($res1->num_rows>0){
										while($row1=$res1->fetch_assoc()){?>
	                                    	<li>
	                                    	<a class='test cool-link' tabindex='-1' href='dw_conteudo.php?cr=<?php echo $row1['id'];?>'><?php echo utf8_decode($row1['nome']);?>&#9662;</a>
	    										<ul class='dropdown-menu  sub-menu'><?php
													$sql2='SELECT dw_conteudos.id,dw_conteudos.nome_cont FROM dw_conteudos INNER JOIN dw_servicos ON dw_conteudos.nome=dw_servicos.nome WHERE dw_conteudos.nome="'.$row1["nome"].'"';
													$res2=$con->query($sql2);
													if($res2->num_rows > 0){
														while($row2=$res2->fetch_assoc()){
															?>
	     										 			<li><a class='cool-link' href='dw_conteudo.php?sr=<?php echo $row2['id'];?>'><?php echo utf8_decode($row2['nome_cont']);?></a></li>
                                                         <?php   
	                                                	}
													}
													?>
												</ul>
	                                     	</li>
                                            <?php
									    }
									}
									$con->close();
								?>
				            </ul>
			          	</li>
						<li style="cursor:pointer"><a style="color: white;" onClick="window.location.href='index.php#noticias'">NOTÍCIAS</a></li>
						<li style="cursor:pointer"><a style="color: white;" onClick="window.location.href='index.php#cerpar'">CERTIFICAÇÕES E PARCERIAS</a></li>
                        <li style="cursor:pointer"><a style="color: white;" onClick="window.location.href='index.php#contact'">CONTACTOS</a></li>
						<li style="cursor:pointer"><a style="color: white;" href="dw_suporte.php">SUPORTE</a></li>
					</div>
<!--USER-->
					<ul class="nav navbar-nav navbar-right">
						<form method="post" action="dw_code.php">
							<div class="dropdown">
								<?php
									if((isset($_SESSION['sessao'])) && ($_SESSION['sessao']==session_id())){
											if($_SESSION["funcao"] == 'Administrador'){
												$p=base64_encode($_SESSION['id']);
												echo'<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" style="background-color: black;">'.$_SESSION["nome"].'&#9662;</button>
													<ul class="dropdown-menu">
														<li><a href="dw_gestao.php" class="cool-link">Administrar Site</a></li>
														<li><a href="dw_serv.php" class="cool-link">Adicionar Categoria</a></li>
														<li><a href="dw_cont.php"  class="cool-link">Adicionar Serviço</a></li>
														<li><a href="dw_pub.php"  class="cool-link">Publicar Notícia</a></li>
														<li><a href="dw_cert.php"  class="cool-link">Adicionar Certificação/Parceira</a></li>
														<li><a href="dw_registo.php"  class="cool-link">Novo Utilizador</a></li>
														<li><a data-toggle="modal" data-target="#md">Outros</a></li>
														<li role="presentation" class="divider"></li>
														<li><a href="?op=Sair" target="_self"  class="cool-link">Terminar Sessão</a></li>
													</ul>';
											}elseif($_SESSION["funcao"] == 'Gestor'){
												$p=base64_encode($_SESSION['id']);
												echo'<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" style="background-color: black;">'.$_SESSION["nome"].'&#9662;</button>
													<ul class="dropdown-menu">
														<li><a href="dw_gestao.php">Gerir Site</a></li>
														<li><a href="dw_serv.php">Adicionar Categoria</a></li>
														<li><a href="dw_cont.php">Adicionar Serviço</a></li>
														<li><a href="dw_pub.php">Publicar Sotícia</a></li>
														<li><a href="dw_cert.php"  class="cool-link">Adicionar Certificação/Parceira</a></li>
														<li><a data-toggle="modal" data-target="#md">Outros</a>
														<li role="presentation" class="divider"></li>
														<li><a href="?op=Sair" target="_self">Terminar Sessão</a></li>
													</ul>';
											}elseif($_SESSION["funcao"] == 'Publicador'){
												$p=base64_encode($_SESSION['id']);
												echo'<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" style="background-color: black;">'.$_SESSION["nome"].'&#9662;</button>
													<ul class="dropdown-menu">
														<li><a href="dw_gestao.php">Gerir Notícias</a></li>	
														<li><a href="dw_pub.php">Publicar Notícia</a></li>
														<li><a data-toggle="modal" data-target="#md">Outros</a>
														<li role="presentation" class="divider"></li>
														<li><a href="?op=Sair" target="_self">Terminar Sessão</a></li>
													</ul>';
											}else{
												$p=base64_encode($_SESSION['id']);
												echo'<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" style="background-color: black;">'.$_SESSION["nome"].'&#9662;</button>
													<ul class="dropdown-menu">
														<li><a data-toggle="modal" data-target="#md">Outros</a>
														<li role="presentation" class="divider"></li>
														<li><a href="?op=Sair" target="_self">Terminar Sessão</a></li>
													</ul>';
											}
									}
								?>	
							</div>
						</form>
					</ul>
				</div>
			</div>
		</nav>
		<div class="jumbotron text-center animate-fading" style="background-size: cover; background-position: center; background-repeat: no-repeat; background-image: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url('dw_img/img1.png');">
			<div class="animate-bottom">
				<h1>Bem-vindo à DecimalWorld</h1>
			<p>Sistema de Informação Unipessoal, Lda</p>
			</div>
		</div>
		<?php
				if(isset($_GET['cr']))
				{
					$i=$_GET['cr'];
					$liga=liga();
					$sql1="SELECT nome,servico,foto FROM dw_servicos WHERE id=?";
					$lista= $liga->prepare($sql1);
					$lista->bind_param('i',$i);
					$lista->execute();
					$lista->bind_result($nms,$crs,$ft);		
					if ($lista->fetch())
					{
						$nm_1=$nms;
						$cat_1=$crs;
						$ft_1=$ft;		
						$lista->close();
						$liga->close();
					}?>
					<p style='text-align:center'><img class="img-rounded"  width="100" heigth="100" src='dw_img/<?php echo $ft_1; ?>.jpg'></p><br>
					<h1 style='text-align:center;'><?php echo utf8_decode($nm_1) ;?></h1><br>
					<h4 style='text-align:center;'><?php echo utf8_decode($cat_1) ;?></h4>
                    <div class="container-fluid text-center" style="background-image: url('dw_img/8010.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat; background-attachment: fixed;">
			<h2 style="color: white">Alguns Serviços Associados</h2><br>
			<div class="row slide">
            		<?php
						$con=liga(); 
						$sql3='SELECT dw_conteudos.id,dw_conteudos.nome_cont,dw_conteudos.nome,dw_conteudos.foto,dw_conteudos.descricao FROM dw_conteudos INNER JOIN dw_servicos ON dw_conteudos.nome=dw_servicos.nome WHERE dw_conteudos.nome="'.$nm_1.'" ORDER BY RAND() LIMIT 2';
						$res3=$con->query($sql3);
						if($res3->num_rows > 0)
						{
							while($row3=$res3->fetch_assoc())
							{?>
								<div class="col-sm-6" style="padding-top:50px;">
									<div class="modiv srvcs">
										<img src="dw_img/<?php echo $row3["foto"]; ?>.jpg" width="50px" height="50px">
										<h4><?php echo utf8_decode($row3["nome_cont"]); ?></h4>
										<h5><b>Categoria: <?php echo utf8_decode($row3["nome"]); ?></b></h5>
										<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#<?php echo $row3["id"]; ?>exampleModalLong">Ver mais</button>
										<div class="modal fade" id="<?php echo $row3["id"];?>exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="<?php echo $row3["id"];?>exampleModalLongTitle" aria-hidden="true">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="<?php echo $row3["id"];?>exampleModalLongTitle">DecimalWorld</h5>
													</div>
													<div class="modal-body">
														<img src="dw_img/<?php echo $row3["foto"]; ?>.jpg" width="100px" style="margin:auto; display: block; margin-left: auto; margin-right: auto;">
														<h1><?php echo utf8_decode($row3["nome_cont"]); ?></h1><br>
															<?php echo utf8_decode($row3["descricao"]); ?>
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-secondary" data-dismiss="modal" style="border:1px solid #ccc; color:black">Fechar</button>
														<a href="dw_conteudo.php?sr=<?php echo $row3["id"];?>"><button type="button" style="float:left; color:white; background-color:#2481BA" class="btn btn-secondary">Ver página</button></a>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
						<?php
							}
							
						}
						$con->close();
															
					?>
            	</div>
            </div>
                    <?php
				}elseif(isset ($_GET['sr']))
				{
					$i=$_GET['sr'];
					$liga=liga();
					$sql1="SELECT nome_cont,descricao,nome,foto FROM dw_conteudos WHERE id=?";
					$lista= $liga->prepare($sql1);
					$lista->bind_param('i',$i);
					$lista->execute();
					$lista->bind_result($nc,$desc,$nm,$ft);		
					if ($lista->fetch())
					{
						$nc1=$nc;
						$desc1=$desc;
						$nm1=$nm;
						$ft1=$ft;		
						$lista->close();
						$liga->close();
					}?>
                    <p style='text-align:center'><img class="img-rounded"  width="100" heigth="100" src='dw_img/<?php echo $ft1; ?>.jpg'></p><br>
					<h1 style='text-align:center;'><?php echo utf8_decode($nc1) ;?></h1>
					<h5 style='text-align:center;'>Categoria: <b><?php echo utf8_decode($nm1) ;?></b></h5><br>
					<h3 style='text-align:center;'><?php echo utf8_decode($desc1) ;?></h3>
					<?php
				}
				else
					echo "<p align='center'>Não existe</p>";	
			?>
		<div align="center" style="cursor:pointer"><a onClick="window.location.href='index.php#contact'" style="text-align:center">Entre em contacto</a></div>
		<footer class="container-fluid text-center">
			<a href="#myPage" title="To Top"><span class="glyphicon glyphicon-chevron-up" style="color: #ccc;"></span></a>
			<p>Copyright © 2018 DecimalWorld - Sistema de Informação Unipessoal, Lda. Todos os direitos reservados.</p>
		</footer>
         <div class="modal fade" id="md" role="dialog">
   			 <div class="modal-dialog modal-sm">
      			<div class="modal-content">
        			<div class="modal-header">
          				<button type="button" class="close" data-dismiss="modal">&times;</button>
          				<h4 class="modal-title">Outros</h4>
        			</div>
        			<div class="modal-body" align="center">
                    	<div class="well">
                    	 <form method="post">
                         	Digite o Novo nome:
            				<input type="hidden" name="idn" id="idn" value="<?php echo $_SESSION['id']; ?>">
            				<input type="text"  class="form-control" name="nm" id="nm" required/>
                            <input type="submit" class="btn btn-info" value="Alterar"><br>
                         </form><br>
                         <form method="post">
                         	Digite a Password Atual:
                         	<input type="password" class="form-control" name="ant" id="ant" required>   
                            Digite a Nova Password:
                            <input type="hidden" name="idn" id="idn" value="<?php echo $_SESSION['id']; ?>">
                            <input type="password" class="form-control" name="ps" id="ps" required>
                            <input type="checkbox" onclick="myFunction()">Mostrar Palavra-passe
                            <input type="submit" class="btn btn-info" value="Alterar"><br>
            			</form>
                       </div>
                       <script>
					function myFunction() {
					    var x = document.getElementById("ant");
						var y= document.getElementById("ps");
					    if (x.type === "password") {
					        x.type = "text";
							y.type="text";
					    } else {
					        x.type = "password";
							y.type="password";
					    }
					}
				</script>
        			</div>
        			<div class="modal-footer">
          				<button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
        			</div>
      			</div>
    		</div>
  		</div>
	</body>
</html>>