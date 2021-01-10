<?php
	session_start();
	include 'dw_code.php';
	if(($_SESSION['funcao']=='Administrador' or ($_SESSION['funcao']=='Gestor') or ($_SESSION['funcao']=='Publicador'))){
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
			.button:after{content:'Adicionar Serviço';}
			.button:hover:after{content:'Voltar'; color: #2481BA;}
			.button:hover span {padding-left: 10px; color: #2481BA;}
			.button:hover span:after {
				opacity: 1;
				left: 0;
			}
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
			a{text-decoration:none;}
			.button1:after{content:'Alterar Serviço';}
			.button1:hover:after{content:'Voltar'; color: #2481BA;}
			.button1:hover span {padding-left: 10px; color: #2481BA;}
			.button1:hover span:after {
				opacity: 1;
				left: 0;
			}
		</style>
	</head>
	<body style="background-image: url('dw_img/254219-P4LFCP-187.jpg');">
    <div class="loader"></div>
    <?php
		if(isset($_GET['cont']))
		{ 
			$con=liga();
			$id=$_GET['cont'];
			$sql="SELECT id,nome_cont,descricao,nome,foto FROM dw_conteudos WHERE id=?";
			$ligar = $con->prepare($sql);
			$ligar->bind_param('i',$id);
			$ligar->execute();
			$ligar->bind_result($id,$nome,$desc,$nome_c,$foto);
			if($ligar->fetch()){
				$id4=$id;
				$nm=$nome;
				$ds=$desc;
				$n_c=$nome_c;
				$f_t=$foto;
			}
	?>
    <form method="post" action="dw_code.php" enctype="multipart/form-data">
			<table style="margin: auto;">
				<th style="padding-bottom: 50px" colspan="2"><img src="dw_img/<?php echo $f_t;?>.jpg" width="70px"><br><h1><a class="button1" href="dw_gestao.php?p=cat_"><span>&nbsp;</span></a></h1></th>
				<tr>
					<input type="hidden" id="id4" name="id4" value="<?php echo utf8_decode($id4); ?>" >
                    <td><input type="text" id="tc" name="tc" required value="<?php echo utf8_decode($nm); ?>"></td>
				</tr>
				<tr>
					<td><textarea type="text" id="dc" required name="dc"><?php echo utf8_decode($ds); ?></textarea></td>
				</tr>
				<tr>
					<td>Categoria: <?php echo utf8_decode($n_c); ?></td>
				</tr>
				<td><input type="submit" name="addc" id="addc" value="Alterar"></td>
			</table>
		</form>
    <?php }else{ ?>
		<form method="post" action="dw_code.php" enctype="multipart/form-data">
			<table style="margin: auto;">
				<th style="padding-bottom: 50px" colspan="2"><img src="dw_img/001-career.png" width="70px"><br><h1><a class="button" href="index.php"><span>&nbsp;</span></a></h1></th>
				<tr>
					<td><input type="text" id="tc" name="tc" required placeholder="Novo serviço"></td>
				</tr>
				<tr>
					<td><textarea type="text" id="dc" name="dc" required placeholder="Descriçao do serviço"></textarea></td>
				</tr>
				<tr>
					<td><select id="cats" name="cats">
						<?php
							$con = liga();
							$sql = "SELECT * FROM dw_servicos";
							$res = $con->query($sql);
							if ($res->num_rows > 0){
								echo "<option selected>- Selecione a categoria pertencente -</option>";
								while ($row = $res->fetch_assoc()){
									echo "<option>".utf8_decode($row['nome'])."</option>";
								}
							}
							$con->close();
						?>
					</select></td>
				</tr>
				<tr>
					<td><input type="file" id="fc" name="fc" required style="font-family: Poppins"></td>
				</tr>
				<td><input type="submit" name="addc" id="addc" value="Adicionar"></td>
			</table>
		</form>
        <?php }?>
	</body>
</html>
<?php }else{header('Location:index.php');} ?>