<?php
	function liga(){
	$con = new mysqli("localhost", "root", "", "dw_db");
		if ($con->connect_error){
			die("Conexão falhada: ".$con->connect_error);
		}else
			return($con);
	}

	//ordenar Categorias
	function ordenar(){
		
		if(isset($_POST['slc'])){
			$orde=$_POST['slc'];	
		}else{
			$orde=5;	
		}
		if($orde == 1){
			$sql1="SELECT * FROM dw_servicos ORDER BY id DESC";
		}
		if($orde == 2){
			$sql1="SELECT * FROM dw_servicos ORDER BY nome ASC";	
		}
		if($orde == 3){
			$sql1="SELECT * FROM dw_servicos ORDER BY nome DESC";			
		}
		if($orde == 4){
			$sql1="SELECT * FROM dw_servicos ORDER BY id ASC";
		}
		if($orde == 5){
			$sql1="SELECT * FROM dw_servicos";
		}
		return $sql1;
	}

	// Ordenar Serviços
	function ordenar2(){
		if(isset($_POST['ctg']))
		{
			$orde=$_POST['ctg'];
		}else{
			$orde=5;	
		}
		if($orde == 1){
			$sql1="SELECT * FROM dw_conteudos ORDER BY id DESC";
		}
		if($orde == 2){
			$sql1="SELECT * FROM dw_conteudos ORDER BY nome ASC";	
		}
		if($orde == 3){
			$sql1="SELECT * FROM dw_conteudos ORDER BY nome DESC";			
		}
		if($orde == 4){
			$sql1="SELECT * FROM dw_conteudos ORDER BY id ASC";
		}
		if($orde == 5){
			$sql1="SELECT * FROM dw_conteudos";
		}
		return $sql1;
	}

	//Selecionar os serviços
	if(isset($_GET['idpos']))
	{
		$str="pos".$_GET['idpos'];
		echo $str;
		if(isset($_GET[$str]))
			$pos=1;
		else
			$pos=0;
		echo $pos;	
	}

	//Selecionar os serviços	
	if(isset($_POST['idpos']))
	{
		$str="pos".$_POST['idpos'];
		if(isset($_POST[$str]))
			$pos=1;
		else
			$pos=0;
		echo $pos;
		$liga = liga();
		$id_p=$_POST['idpos'];
		$sql="UPDATE dw_conteudos SET posicao=? WHERE id=?";	
		$lista= $liga->prepare($sql);
		$lista->bind_param('ii',$pos,$id_p);
		if($lista->execute() && $liga->affected_rows>0)
			header("location:dw_gestao.php?p=cat_");
		$liga->close();		
	}

	//Selecionar as categorias
	if(isset($_POST['idps']))
	{
		$str="pss".$_POST['idps'];
		if(isset($_POST[$str]))
			$pos=1;
		else
			$pos=0;
		echo $pos;
		$liga = liga();
		$id_p=$_POST['idps'];
		$sql="UPDATE dw_servicos SET posicao_s=? WHERE id=?";	
		$lista= $liga->prepare($sql);
		$lista->bind_param('ii',$pos,$id_p);
		if($lista->execute() && $liga->affected_rows>0)
			header("location:dw_gestao.php?p=serv_");
		$liga->close();		
	}

	// eliminar os pedidos
	if(isset($_GET['po'])){
		$i=$_GET['po'];
		$liga=liga();
	    $sql= "DELETE dw_problemas. * FROM dw_problemas WHERE id=?";
		$res=$liga->prepare($sql);
		$res->bind_param('i',$i);
		$res->execute();
		$liga->close();
		header("location:dw_gestao.php?p=ped_");
	}

	// eliminar noticias
	if(isset($_GET['nt'])){
		$i=$_GET['nt'];
		$liga=liga();
	    $sql= "DELETE dw_noticias. * FROM dw_noticias WHERE id=?";
		$res=$liga->prepare($sql);
		$res->bind_param('i',$i);
		$res->execute();
		$liga->close();
	}

	// eliminar Serviços
	if(isset($_GET['ca'])){
		$i=$_GET['ca'];
		$liga=liga();
		$sql1="SELECT foto FROM dw_conteudos WHERE id=?";
		$lista= $liga->prepare($sql1);
		$lista->bind_param('i',$i);
		$lista->execute();
		$lista->bind_result($ft);		
		if ($lista->fetch())
		{
			$ftg=$ft;
			$return = unlink("dw_img/".$ftg.".jpg");		
			$lista->close();
			$liga->close();
		}
		$liga=liga();
	    $sql= "DELETE dw_conteudos. * FROM dw_conteudos WHERE id=?";
		$res=$liga->prepare($sql);
		$res->bind_param('i',$i);
		$res->execute();
		$liga->close();
		header("location:dw_gestao.php?p=cat_");	
	}

	// eliminar os Categorias
	if(isset($_GET['s'])){
		$i=$_GET['s'];
		$liga=liga();
		$sql1="SELECT foto FROM dw_servicos WHERE id=?";
		$lista= $liga->prepare($sql1);
		$lista->bind_param('i',$i);
		$lista->execute();
		$lista->bind_result($ft);		
		if ($lista->fetch())
		{
			$ftg=$ft;
			unlink("dw_img/".$ftg.".jpg");		
			$lista->close();
			$liga->close();
		}
		$liga=liga();
	    $sql= "DELETE dw_servicos. * FROM dw_servicos WHERE id=?";
		$res=$liga->prepare($sql);
		$res->bind_param('i',$i);
		$res->execute();
		$liga->close();
		header("location:dw_gestao.php?p=serv_");
	}

	//Eliminar Certificados
	if(isset($_GET['tcp'])){
		$i=$_GET['tcp'];
		$liga=liga();
		$sql1="SELECT foto FROM dw_certs WHERE id=?";
		$lista= $liga->prepare($sql1);
		$lista->bind_param('i',$i);
		$lista->execute();
		$lista->bind_result($ft);		
		if ($lista->fetch())
		{
			$ftg=$ft;
			$return = unlink("dw_img/".$ftg.".jpg");		
			$lista->close();
			$liga->close();
		}
		$liga=liga();
	    $sql= "DELETE dw_certs. * FROM dw_certs WHERE id=?";
		$res=$liga->prepare($sql);
		$res->bind_param('i',$i);
		$res->execute();
		$liga->close();
		header("location:dw_gestao.php?p=certs_");	
	}

	//eliminar os colobadores
	if(isset($_GET['kp'])){
		$i=$_GET['kp'];
		$liga=liga();
		if ($_SESSION['id'] == $i)
		{
			header("location:dw_gestao.php?p=col_");
			echo "<script>alert('Não é possivel se eliminar infelizmente');</script>";
		}
		else
		{
			$sql= "DELETE dw_users. * FROM dw_users WHERE id=?";
			$res=$liga->prepare($sql);
			$res->bind_param('i',$i);
			$res->execute();
			$liga->close();
			header("location:dw_gestao.php?p=col_");
		}			
	}
	$bool=0;

	// mudar as funcoes
	if (isset($_GET['pq'])){
		$sql_1= 'SELECT funcao FROM dw_users WHERE id=?';
		$con=liga();
		$idv=$_GET["ipv"];
		$vl=$_GET["pq"];
		$ligar = $con->prepare($sql_1);
		$ligar->bind_param('i',$idv);
		$ligar->execute();
		$ligar->bind_result($funcao);
		if($ligar->fetch())
			{
				$fc=$funcao;
				$ligar->close();
				$con->close();
			}
		if($fc == "Administrador")
		{
			$con=liga();
			$sql_2='SELECT funcao FROM dw_users WHERE funcao="Administrador"';
			$res2=$con->query($sql_2);
			$count=$res2->num_rows;	
			$con->close();
			if($count==1)
			{
				$bool=0;
				header("location:dw_gestao.php?p=col_");
			}
			else
			{
				$liga=liga();
				$sql="UPDATE dw_users SET funcao=? WHERE id=?";
				$lista= $liga->prepare($sql);
				$lista->bind_param('si',$vl,$idv);
				if($lista->execute() && $liga->affected_rows>0)
				{
					$bool=1;
					$lista->close();
				}
				$liga->close();
				if($_SESSION['id']==$idv)
				{
					if($bool=1)
					{
						$con=liga();
						$sql1 = "SELECT funcao FROM dw_users WHERE id=?";
						$ligar = $con->prepare($sql1);
						$ligar->bind_param('i',$idv);
						$ligar->execute();
						$ligar->bind_result($funcao);
						if($ligar->fetch())
						{
							$_SESSION['funcao']=$funcao;
							$ligar->close();
							$con->close();
							header("location:dw_gestao.php?p=col_");
						}		
					}
				}
				else
				{
					$bool=0;
					header("location:dw_gestao.php?p=col_");	
				}
	
			}	 
		}
		else
		{	
			$liga=liga();
			$sql="UPDATE dw_users SET funcao=? WHERE id=?";
			$lista= $liga->prepare($sql);
			$lista->bind_param('si',$vl,$idv);
			if($lista->execute() && $liga->affected_rows>0)
			{
				$lista->close();
				header("location:dw_gestao.php?p=col_");
			}
			$liga->close();
		}
	}
	
	//Alterar PassWord
	if (isset($_POST['altp'])){
		$liga=liga();
		$idv=$_POST["ipv"];
		$vl=$_POST["altp"];
		$sql="UPDATE dw_users SET senha=? WHERE id=?";
		$lista= $liga->prepare($sql);
		$lista->bind_param('si',$vl,$idv);
		if($lista->execute() && $liga->affected_rows>0)
			header("location:dw_gestao.php?p=col_");			
		$liga->close();
	}

	//Alterar as Foto das Categorias
	if (isset($_POST['ifot']))
	{
		$liga=liga();
		$id=$_POST['ifot'];
		$foto = $_FILES["fot"]; 
		$img = uniqid(time());
		$im1 = "dw_img/".$img.".jpg";
		move_uploaded_file($foto["tmp_name"], $im1);
		$sql="UPDATE  dw_servicos SET foto=? WHERE id=?";
		$lista= $liga->prepare($sql);
		$lista->bind_param('si',$img,$id);
		if($lista->execute() && $liga->affected_rows>0)
		{	
			echo "<script>alert('Imagem da Categoria Alterada');</script>";
			header("location:dw_gestao.php?p=serv_");
			
		}
		else
		{
			echo "<script>alert('Erro na Alteração da Imagem');</script>";
			header("location:dw_gestao.php?p=serv_");
		}
		$liga->close();	
	}

	//Alterar as Foto dos Serviços
	if (isset($_POST['ifsr']))
	{
		$liga=liga();
		$id=$_POST['ifsr'];
		$foto = $_FILES["ftsr"]; 
		$img = uniqid(time());
		$im1 = "dw_img/".$img.".jpg";
		move_uploaded_file($foto["tmp_name"], $im1);
		$sql="UPDATE  dw_conteudos SET foto=? WHERE id=?";
		$lista= $liga->prepare($sql);
		$lista->bind_param('si',$img,$id);
		if($lista->execute() && $liga->affected_rows>0)
		{	
			echo "<script>alert('Imagem do Serviço Alterada');</script>";
			header("location:dw_gestao.php?p=cat_");	
		}
		else
		{
			echo "<script>alert('Erro na Alteração da Imagem');</script>";
			header("location:dw_gestao.php?p=cat_");
		}
		$liga->close();	
	}

	//validação das permisões
	if (isset($_GET['vl'])){
		header("location: index.php");
	}
?>	