<?php
	session_start();
	include 'codigoad.php';
?>
<?php
	if(($_SESSION['funcao']=='Administrador' or ($_SESSION['funcao']=='Gestor') or ($_SESSION['funcao']=='Publicador'))){
	?>
<!DOCTYPE html>
<html>
	<head>
	  <title>Administração</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="gestao.css">
      <link rel="shortcut icon" href="dw_img/dw_logo1.png"/>
  	  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
      <script src="gest.js"></script>
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  	  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	</head>
		<body style="background-color:#36648B">
           <div class="page-header">
          <h1><a class="button" href="index.php"><span>&nbsp;</span></a></h1>   
  			</div>
            <div class="container-fluid text-center" >    
  				<div class="row content">
    				<div class="col-sm-2 sidenav">
                        <?php 
                            if($_SESSION["funcao"]=="Administrador"){?>
                            <p><a class="bt" href="?p=ped_" target="_self" id="ped">Pedidos</a></p>
                            <p><a class="bt" href="?p=col_" target="_self" id="col">Colaboradores</a></p>
                            <p><a class="bt" href="?p=serv_" target="_self" id="serv">Categorias</a></p>
                            <p><a class="bt" href="?p=not_" target="_self" id="notic">Notícias</a></p>
                            <p><a class="bt" href="?p=cat_" target="_self" id="cat">Serviços</a></p>
                            <p><a class="bt" href="?p=certs_" target="_self" id="certs">Certificações e Parcerias</a></p>
                            <?php }    
                        ?>
                         <?php 
                            if($_SESSION["funcao"]=="Gestor"){?> 
                            <p><a class="bt" href="?p=ped_" target="_self" id="ped">Pedidos</a></p>              
                            <p><a class="bt" href="?p=serv_" target="_self" id="col">Categorias</a></p>
                            <p><a class="bt" href="?p=not_" target="_self" id="ped">Notícias</a></p>
                            <p><a class="bt" href="?p=cat_" target="_self" id="cat">Serviços</a></p>
                            <p><a class="bt" href="?p=certs_" target="_self" id="certs">Certificações e Parcerias</a></p>                 
                            <?php }    
                        ?>
                        <?php 
                            if($_SESSION["funcao"]=="Publicador"){?>
                            <p><a class="bt" href="?p=not_" target="_self" id="ped">Notícias</a></p>
                            <?php }    
                        ?>
                    </div>
    				<div class="col-sm-10 text-left">
                     		<input type="text" id="myInput" class="form-control" onkeyup="myFunction()" placeholder="Procura por Nomes/Títulos"/>
                     	<div class="table-responsive" style="background-color:#8DB6CD" align="center">
                			<?php
                    			if(isset($_GET['p'])){
                        			include $_GET['p'].'.php';
                    			}else
                        			include 'not_.php';
                			?>
                       </div>     
                	</div>
             </div>   
         </div>
	</body>
</html>
<?php }
 else
 	header('location:index.php');
?>