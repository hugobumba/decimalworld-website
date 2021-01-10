<?php
	session_start();
	include 'dw_code.php';
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.2/modernizr.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
		<script src='https://www.google.com/recaptcha/api.js'></script>
		<script src="dw_nav.js"></script>
        <script src="form4.js"></script>
		<script src="dw_scroll.js"></script>
        <script>
		    $(window).load(function(){
		        $('.loader').fadeOut(500);
		    });
			$(window).load(function(){
		        $('.back').fadeOut(500);
		    });
		</script>

<!--STYLE-->
		<style>
			@import url('https://fonts.googleapis.com/css?family=Poppins:300');
			*{font-family: Poppins;}
			.zoom {
				transition: all 0.3s ease;
				opacity: 1;
			    transition: transform .2s;
			}
			.zoom:hover {
				transition: all 0.3s ease;
				opacity: 2;
			    -ms-transform: scale(1.1);
			    -webkit-transform: scale(1.1);
			    transform: scale(1.1);
			}
			.loader {
				position: fixed;
				left: 0px;
				top: 0px;
				width: 100%;
				height: 100%;
				z-index: 9999;
				background-color:white;
				background: url(dw_img/Preloader_5.gif) center no-repeat #fff;
			}
			.back{
				position: fixed;
				left: 0px;
				top: 0px;
				width: 100%;
				height: 100%;
				z-index: 9998;
				background-color:white;
			}
		    #myDiv {display: none; text-align: center;}
			.modiv{
				border: 1px solid #ccc;
				background-color: white;
				border-radius: 5px;
				padding: 25px;
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
				box-shadow: 20px 20px 20px -20px #2481BA inset;
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
				width: 100%;
				height:100%;
			}
			html{width: 100%; height:100%;}
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
			.srvcs{transition: all 0.3s ease; opacity: 1; border: 1px solid black;}
			.srvcs:hover{
				transition: all 0.3s ease;	opacity: 2;
				border-radius: 30px;
			}
			.bt{background-color: #2481BA; color: white;}
			.bt:hover{background-color: white; color: #2481BA;}  
			.jumbotron {
				background-color: #210B61;
				color: #fff;
				padding: 100px 25px;
				font-family: Montserrat, sans-serif;
			}
			.container-fluid {padding: 60px 50px;}
			.bg-grey {background-color: #f6f6f6;}
			.logo-small {color: #210B61; font-size: 50px;}
			.logo {color: #f4511e; font-size: 200px;}
			.thumbnail {
				padding: 0 0 15px 0;
				border: none;
				border-radius: 0;
			}
			.thumbnail img {width: 100%; height: 100%; margin-bottom: 10px;}
			.bt:hover{border: 1px solid #ccc; text-decoration:none;}
			.carousel-control.right, .carousel-control.left {
				background-image: none; color: #210B61;
			}
			.carousel-indicators li {border-color: #210B61;}
			.carousel-indicators li.active {background-color: #210B61;}
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
				color: #210B61;
				background-color: #fff;
			}
			.navbar-fixed-top{background-color: rgba(255,255,255,0);}
			footer .glyphicon {
				font-size: 20px;
				margin-bottom: 20px;
				color: #210B61;
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
	</head>
	<body id="myPage" data-spy="scroll" data-target="navbar" data-offset="60" class="pd">
		<div class="loader"></div>
        <div class="back"></div>
		<nav class="navbar-default navbar-fixed-top">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>                       
					</button>
					<a href=""><img src="dw_img/dw_logo5.png" width="150px"></a>
				</div>
<!--NAVBAR-->
				<div class="collapse navbar-collapse" id="myNavbar">
					<div class="nav navbar-nav navbar-left">
						<li><a style="color: white;" href="#sobre">SOBRE</a></li>
						<li class="dropdown">
				            <a data-toggle="dropdown" class="dropdown-toggle" style="color: white;" href="index.php#services">SERVIÇOS&#9662;</b></a>
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
						<li><a style="color: white;" href="#noticias">NOTÍCIAS</a></li>
                       	<li><a style="color: white;" href="#cerpar">CERTIFICAÇÕES E PARCERIAS</a></li>
						<li><a style="color: white;" href="#contact">CONTACTOS</a></li>
						<li><a style="color: white;" href="dw_suporte.php">SUPORTE</a></li>
					</div>

<!--USER-->
					<ul class="nav navbar-nav navbar-right">
						<form method="post" action="dw_code.php">
							<div class="dropdown">
								<?php
									if((isset($_SESSION['email'])) && ($_SESSION['sessao']==session_id())){
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
														<li><a href="dw_gestao.php" class="cool-link">Gerir Site</a></li>
														<li><a href="dw_serv.php" class="cool-link">Adicionar Categoria</a></li>
														<li><a href="dw_cont.php" class="cool-link">Adicionar Serviço</a></li>
														<li><a href="dw_pub.php" class="cool-link">Publicar Notícia</a></li>
														<li><a href="dw_cert.php" class="cool-link">Adicionar Certificação/Parceria</a></li>
														<li><a data-toggle="modal" data-target="#md" class="cool-link">Outros</a>
														<li role="presentation" class="divider"></li>
														<li><a href="?op=Sair" target="_self" class="cool-link">Terminar Sessão</a></li>
													</ul>';
											}elseif($_SESSION["funcao"] == 'Publicador'){
												$p=base64_encode($_SESSION['id']);
												echo'<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" style="background-color: black;">'.$_SESSION["nome"].'&#9662;</button>
													<ul class="dropdown-menu">
														<li><a href="dw_gestao.php" class="cool-link">Gerir Notícias</a></li>	
														<li><a href="dw_pub.php" class="cool-link">Publicar Notícia</a></li>
														<li><a data-toggle="modal" data-target="#md" class="cool-link">Outros</a>
														<li role="presentation" class="divider"></li>
														<li><a href="?op=Sair" target="_self" class="cool-link">Terminar Sessão</a></li>
													</ul>';
											}else{
												$p=base64_encode($_SESSION['id']);
												echo'<button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" style="background-color: black;">'.$_SESSION["nome"].'&#9662;</button>
													<ul class="dropdown-menu">
														<li><a data-toggle="modal" data-target="#md" class="cool-link">Outros</a>
														<li role="presentation" class="divider"></li>
														<li><a href="?op=Sair" target="_self" class="cool-link">Terminar Sessão</a></li>
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

<!--HEADER-->
		<div class="jumbotron text-center animate-fading" style="background-size: cover; background-position: center; background-repeat: no-repeat; background-image: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url('dw_img/OLO2ED0.jpg');">
			<div class="animate-bottom">
				<h1>Bem-vindo à DecimalWorld</h1>
				<p>Sistemas de Informação Unipessoal, Lda</p>
			</div>
		</div>

<!--SOBRE-->
		<div id="sobre" class="container-fluid">
			<div class="row">
				<div class="col-sm-12">
					<h2>Sobre</h2><br>
						<div class="col-sm-4"><img src="dw_img/dw_logo1.png" width="250px"></div>
					<h4>A DecimalWorld é constituída por profissionais com larga experiência e capacidade técnica na área de prestação de serviços de Outsourcing, Arquitetura de rede e infraestruturas, segurança digital e presença WEB.
					Toda a equipa tem como foco principal, auxiliar os seus clientes com as soluções mais ajustadas e integradas e na medida das suas necessidades, procuramos criar uma relação forte e personalizada de compromisso total com os objetivos dos nossos clientes.</h4><br>
					<p>Somos especialistas e dedicados em tudo o que fazemos, colocamos ainda ao dispor dos nossos clientes todo o vasto leque de parceiros com quem colaboramos de forma a aumentarmos as nossas capacidades  de apoiar os nossos clientes nos mais diversos projetos e desafios de maior ou menor dimensão, para que o seu projeto seja sempre um sucesso!</p><br>
					<a href="#contact" class="bt btn-default btn-lg bt">Entre em contacto</a>
				</div>
			</div>
		</div>

<!--CATEGORIAS-->
		<div id="services" class="container-fluid text-center" style="background-image: url('dw_img/8010.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat; background-attachment: fixed;">
			<h2 style="color: white">Categorias</h2><br>
			<div class="row slideanim">
				<?php
					$con = liga();
					$sqlc = "SELECT * FROM dw_servicos WHERE posicao_s=1";
					$resc = $con->query($sqlc);
					if ($resc->num_rows > 0){
						$count=$resc->num_rows;
						if($count == 3){ $lis_t="col-sm-4";}
						elseif ($count == 2){ $lis_t="col-sm-6";}
						else {$lis_t="col-sm-12";}
						while ($rowc = $resc->fetch_assoc()){
							echo '<div class="'.$lis_t.'">
									<div class="modiv srvcs">
										<img src="dw_img/'.$rowc["foto"].'.jpg" width="50px" height="50px">
										<h4>'.utf8_decode($rowc["nome"]).'</h4>
										<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#'.$rowc["id"].'exampleModalLong">Ver mais</button>
										<div class="modal fade" id="'.$rowc["id"].'exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="'.$rowc["id"].'exampleModalLongTitle" aria-hidden="true">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="'.$rowc["id"].'exampleModalLongTitle">DecimalWorld</h5>
													</div>
													<div class="modal-body">
														<img src="dw_img/'.$rowc["foto"].'.jpg" width="100px" style="margin:auto; display: block; margin-left: auto; margin-right: auto;">
														<h1>'.utf8_decode($rowc["nome"]).'</h1><br>
														'.utf8_decode($rowc["servico"]).'
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-secondary" data-dismiss="modal" style="border:1px solid #ccc; color:black">Fechar</button>
														<a href="dw_conteudo.php?cr='.$rowc['id'].'"><button type="button" style="float:left; color:white; background-color:#2481BA" class="btn btn-secondary">Ver página</button></a>
													</div>
												</div>
											</div>
										</div>
									</div>
							</div>';
						}
					}
					$con->close();
				?>
			</div>
		</div>

<!--SERVIÇOS-->
		<div id="services" class="container-fluid text-center" style="background-image: url('dw_img/8010.jpg'); background-size: cover; background-position: center; background-repeat: no-repeat; background-attachment: fixed;">
			<h2 style="color: white">Serviços</h2><br>
			<div class="row slideanim">
				<?php
					$con = liga();
					$sqls = "SELECT * FROM dw_conteudos WHERE posicao=1";
					$ress = $con->query($sqls);
					if ($ress->num_rows > 0){
						$count1=$ress->num_rows;
						if($count1 == 3){ $lis_t1="col-sm-4";}
						elseif ($count1 == 2){ $lis_t1="col-sm-6";}
						else {$lis_t1="col-sm-12";}
						while ($rows = $ress->fetch_assoc()){
							echo '<div class="'.$lis_t1.'" style="padding-top:50px;">
									<div class="modiv srvcs">
										<img src="dw_img/'.$rows["foto"].'.jpg" width="50px" height="50px">
										<h4>'.utf8_decode($rows["nome_cont"]).'</h4>
										<h5>Categoria: <b>'.utf8_decode($rows["nome"]).'</b></h5>
										<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#'.$rows["id"].'exampleModalLong">Ver mais</button>
										<div class="modal fade" id="'.$rows["id"].'exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="'.$rows["id"].'exampleModalLongTitle" aria-hidden="true">
											<div class="modal-dialog" role="document">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="'.$rows["id"].'exampleModalLongTitle">DecimalWorld</h5>
													</div>
													<div class="modal-body">
														<img src="dw_img/'.$rows["foto"].'.jpg" width="100px" style="margin:auto; display: block; margin-left: auto; margin-right: auto;">
														<h1>'.utf8_decode($rows["nome_cont"]).'</h1><br>
														'.utf8_decode($rows["descricao"]).'
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-secondary" data-dismiss="modal" style="border:1px solid #ccc; color:black">Fechar</button>
														<a href="dw_conteudo.php?sr='.$rows['id'].'"><button type="button" style="float:left; color:white; background-color:#2481BA" class="btn btn-secondary">Ver página</button></a>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>';
						}
					}
					$con->close();
				?>
			</div>
		</div><hr>

<!--NOTÍCIAS-->
		<div id="myCarousel" class="carousel slide text-center" data-ride="carousel">
			<div id="noticias" class="container-fluid text-center" style="background-color: #0B3861">
				<h2 style="color: white;">Notícias</h2>
				<div class="carousel-inner" role="listbox">
					<?php
						$con = liga();
						$sql = "SELECT titulo, noticia FROM dw_noticias WHERE id=1";
						$res = $con->query($sql);
						if($res->num_rows > 0){
							while($row = $res->fetch_assoc()){
								echo '<div class="item active">
										<h4 style="color: white;"><b>
											'.utf8_decode($row["titulo"]).'</b><br>
											<span>'.utf8_decode($row["noticia"]).'</span>
										</h4>
									</div>';
							}
						}
						$sql = "SELECT titulo, noticia FROM dw_noticias WHERE id<>1";
						$res = $con->query($sql);
						if($res->num_rows > 0){
							while($row = $res->fetch_assoc()){
								echo '<div class="item">
										<h4 style="color: white;"><b>
											'.utf8_decode($row["titulo"]).'</b><br>
											<span>'.utf8_decode($row["noticia"]).'</span>
										</h4>
									</div>';
							}
						}
						$con->close();
					?>
				</div>
				<a class="left carousel-control" style="color: white;" href="#myCarousel" role="button" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
					<span class="sr-only">Previous</span>
				</a>
				<a class="right carousel-control" style="color: white;" href="#myCarousel" role="button" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
					<span class="sr-only">Next</span>
				</a>
			</div>
		</div><hr>

<!--CERTIFICAÇÕES-->
<div id="myCarousel" class="carousel slide text-center" data-ride="carousel">
			<div id="cerpar" class="container-fluid text-center">
				<h2>Certificações e Parcerias</h2>
				<div class="carousel-inner" role="listbox">
					<div style="display: inline-block;">
					<?php
						$con = liga();
						$sql = "SELECT * FROM dw_certs ORDER BY id ASC";
						$res = $con->query($sql);
						if($res->num_rows > 0){
							while($row = $res->fetch_assoc()){
								echo '<img src="dw_img/'.$row["foto"].'.jpg" width="150px"  class="zoom">';
							}
						}
						$con->close();
					?>
					</div>
				</div>
			</div>
		</div><hr>

<!--CONTACTOS-->
		<div id="contact" class="container-fluid bg-grey" style="background-size: cover; background-position: center; background-repeat: no-repeat; background-attachment: scroll; background-image: linear-gradient(rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url('dw_img/110.jpg');">
			<h2 class="text-center" style="color: white;">CONTACTOS</h2>
			<div class="row">
				<div class="col-sm-5">
					<p>Contacte-nos ou deixe-nos um pedido de contacto.</p>
					<a href="callto:+351919569978"><span class="glyphicon glyphicon-phone"></span> +351 919 569 978</a><br>
					<a href="mailto:geral@decimalworld.pt"><span class="glyphicon glyphicon-envelope"></span> geral@decimalworld.pt</a>
				</div>
				<div class="col-sm-7 slideanim">
					<form action="dw_code.php" method="post">
						<table>
							<tr><td><input class="form-control" id="nome" name="nome" placeholder="Nome" type="text" required></tr></td>
							<tr><td><input class="form-control" id="contato" name="contato" placeholder="Contacto" type="number" required></tr></td>
							<tr><td><input class="form-control" id="email" name="email" placeholder="Email" type="email" required></tr></td>
							<tr><td><textarea class="form-control" style="resize:none;" id="prob" name="prob" placeholder="Motivo de contacto" rows="5"></textarea></tr></td>
							<tr><td><div class="g-recaptcha" data-sitekey="6Ld9-lwUAAAAAEZS06Ri4c6CUUzJdicgrQQfy0mo"></div></tr></td>
							<tr><td><input type="submit" class="btn btn-default pull-right bt" name="enp" id="enp" value="Enviar">
						</table>
					</form>
				</div>
			</div>
		</div><hr>

<!--iFRAME-->
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3010.120383717755!2d-8.56960738516535!3d41.02262212649189!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd247eb5f70f496f%3A0xbbe751b8a874bf1d!2sR.+Sr.+do+Padr%C3%A3o+1104%2C+Grij%C3%B3!5e0!3m2!1spt-PT!2spt!4v1525969395346" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe> 
		<footer class="container-fluid text-center" style="background-color: black; color: white">
			<a href="#myPage" title="To Top"><span class="glyphicon glyphicon-chevron-up" style="color: #2481BA;"></span></a>
			<p>Copyright © 2018 DecimalWorld - Sistema de Informação Unipessoal, Lda. Todos os direitos reservados.</p>
		</footer>
		<script>
			$(window).scroll(function() {
				$(".slideanim").each(function(){
					var pos = $(this).offset().top;
					var winTop = $(window).scrollTop();
					if (pos < winTop + 600) {
						$(this).addClass("slide");
					}
				});
			});
		</script>
        <div class="modal fade" id="md" role="dialog">
   			<div class="modal-dialog modal-sm">
      			<div class="modal-content">
        			<div class="modal-header">
          				<button type="button" class="close" data-dismiss="modal">&times;</button>
          				<h4 class="modal-title">Outros</h4>
        			</div>
        			<div class="modal-body" align="center">
                    	<div class="well">
                    	 <form id="form4" method="post">
                         	Digite o Novo nome:
            				<input type="hidden" name="idn" id="idn" value="<?php echo $_SESSION['id']; ?>">
            				<input type="text"  class="form-control" name="nm" id="nm" required/>
                            <input type="submit" class="btn btn-info" value="Alterar"><br>
                         </form><br>
                         <form id="form3" method="post">
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
</html>