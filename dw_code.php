<?php
#LIGAÇÃO À BASE DE DADOS
function liga(){
	$liga = new mysqli("localhost", "root", "", "dw_db");
	if ($liga->connect_error){
		die('Erro na ligação : ('.$liga->connect_errno.') '.$liga->connect_error);
	}else
		return($liga);
}

#VALIDAR EMAIL
function vermail($mail){
    $dw = "/^(([0-9a-zA-Z]+[-._+&])*[0-9a-zA-Z]+@([-0-9a-zA-Z]+[.])+[a-zA-Z]{2,6}){0,1}$/";
    if(preg_match($dw, $mail))
		return true;
    else
		return false;
}

#LOGIN E VARIÁVEIA DE SESSÃO
function login(){
	if(isset($_POST['email']) && isset($_POST['password'])){
		$mail = $_POST['email'];
		$pass = $_POST['password'];
		if (empty($mail) or empty($pass)) {
        	header("Location: dw_login.php?p=1"); 
		}else{
			$con=liga();
			$sql = "SELECT id,nome, email, senha, funcao FROM dw_users WHERE email =? AND senha =? ";
			$ligar = $con->prepare($sql);
			$ligar->bind_param('ss',$mail,$pass);
			$ligar->execute();
			$ligar->bind_result($id,$nome,$email,$senha,$funcao);
			if($ligar->fetch()){ 
				$_SESSION['id']=$id;
				$_SESSION['nome']=$nome;
				$_SESSION['email']=$email;
				$_SESSION['senha']=$senha;
				$_SESSION['funcao']=$funcao;
				$_SESSION['sessao']=session_id();
				$_SESSION['ip_address']	=$_SERVER['REMOTE_ADDR'];
				$_SESSION['user_agent']	=$_SERVER['HTTP_USER_AGENT'];
			}
			else
				header("Location: dw_login.php"); 
		}
		$con->close();
	}
}

#REGISTO
if (isset($_POST['reg'])){
	$con = liga();
    $nome = str_replace(" ", "+", $_POST['reg_nome']);
    $cont = $_POST['reg_cont'];
    $email = $_POST['reg_mail'];
    $pass = $_POST['reg_pp'];
    $cpass = $_POST['reg_cpp'];
	require 'PHPMailer/PHPMailerAutoload.php';
	if (vermail($email) == TRUE){
		if($pass == $cpass){
			function CheckCaptcha($userResponse) {
		        $fields_string = '';
		        $fields = array(
		            'secret' => '6Ld9-lwUAAAAAP3ZoZImR47YwCIvTlpro_ixeFjf',
		            'response' => $userResponse,
		            'remoteip' => $_SERVER['REMOTE_ADDR']
		        );
		        foreach($fields as $key=>$value)
		        $fields_string .= $key . '=' . $value . '&';
		        $fields_string = rtrim($fields_string, '&');
		        $ch = curl_init();
		        curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
		        curl_setopt($ch, CURLOPT_POST, count($fields));
		        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
		        curl_setopt($ch, CURLOPT_RETURNTRANSFER, True);
		        $res = curl_exec($ch);
		        curl_close($ch);
		        return json_decode($res, true);
		    }
		    $result = CheckCaptcha($_POST['g-recaptcha-response']);
		    if ($result['success']) {
	        	$mail = new PHPMailer;
				$mail->Host = 'smtp.gmail.com';
				$mail->Port = 465;
				$mail->SMTPAuth = true;
				$mail->SMTPSecure = 'ssl';
				$mail->Username = 'decimalworldservices@gmail.com';
				$mail->Password = 'PassWord';
				$mail->SetFrom("decimalworldservices@gmail.com", "DecimalWorld");
				$sql = "SELECT * FROM dw_users WHERE funcao = 'Administrador'";
				$res = $con->query($sql);
				if($res->num_rows > 0){
					while($row = $res->fetch_assoc()){
						$mail->AddAddress($row['email'], $row['nome']);
				    }
				}
				$mail->Subject = 'Novo pedido de registo';
				$mail->Body = '
				<html>
					<body>		
						<table style="border: 1px solid black; padding: 40px; border-radius: 10px; background-color: #E0F2F7;">
							<td colspan="2"><a href="www.decimalworld.pt/"><img src="www.decimalworld.pt/dw_img/dw_logo3.png" width="150px"></a></td>
							<tr>
								<td style="font-size: 18px; padding: 5px;">Nome:</td>
								<td style="font-size: 18px; padding: 5px;"><i>'.str_replace("+", " ", $nome).'</i></td>
							</tr>
							<tr>
								<td style="font-size: 18px; padding: 5px;">Email:</td>
								<td style="font-size: 18px; padding: 5px;"><i>'.$email.'</i></td>
							</tr>
							<tr>
								<td style="font-size: 18px; padding: 5px;">Contacto:</td>
								<td style="font-size: 18px; padding: 5px;"><i>'.$cont.'</i></td>
							</tr>
							<td><a href="decimalworld.pt/dw_confirma.php?nome='.$nome.'&email='.$email.'&contacto='.$cont.'&senha='.$pass.'" style="background-color: #2678B2; border: 1px solid black; color: white; padding: 10px 10px; text-align: center; font-size: 16px; margin: 4px 2px; opacity: 0.8; transition: 0.3s; display: inline-block; text-decoration: none; cursor: pointer; border-radius: 4px;">Aprovar</a></td>
						</table>
						<p>Ass: DecimalWorld</p>
					</body>
				</html>';
				$mail->IsHTML(true);
				$mail->Send();
				echo "<script>alert('Foi enviado um email de autorização ao administrador, aguarde pela resposta!');</script>";
				echo '<html>
					<body>
						<p style="text-align: center;"><a href="www.decimalworld.pt/"><img src="www.decimalworld.pt/dw_img/dw_logo3.png" width="200px"></a></p>
						<table style="border: 1px solid black; padding: 40px; border-radius: 10px; background-color: #E0F2F7; margin: auto;">
							<tr>
								<td style="font-size: 18px; padding: 5px;"><a href="index.php" style="text-decoration: none; color: black; font-size: 30px">Voltar para a página inicial</a></td>
							</tr>
						</table>
					</body>
				</html>';
			}else{
				echo '<html>
					<body>
						<p style="text-align: center;"><a href="www.decimalworld.pt/"><img src="www.decimalworld.pt/dw_img/dw_logo3.png" width="200px"></a></p>
						<table style="border: 1px solid black; padding: 40px; border-radius: 10px; background-color: #E0F2F7; margin: auto;">
							<tr>
								<td style="font-size: 18px; padding: 5px;"><a href="javascript:window.history.go(-1)" style="text-decoration: none; color: black; font-size: 30px">Valide o reCAPTCHA</a></td>
							</tr>
						</table>
					</body>
				</html>';
			}
		}else{
			echo '<html>
					<body>
						<p style="text-align: center;"><a href="www.decimalworld.pt/"><img src="www.decimalworld.pt/dw_img/dw_logo3.png" width="200px"></a></p>
						<table style="border: 1px solid black; padding: 40px; border-radius: 10px; background-color: #E0F2F7; margin: auto;">
							<tr>
								<td style="font-size: 18px; padding: 5px;"><a href="javascript:window.history.go(-1)" style="text-decoration: none; color: black; font-size: 30px">As senhas não coincidem</a></td>
							</tr>
						</table>
					</body>
				</html>';
		}
	}else{
		echo '<html>
					<body>
						<p style="text-align: center;"><a href="www.decimalworld.pt/"><img src="www.decimalworld.pt/dw_img/dw_logo3.png" width="200px"></a></p>
						<table style="border: 1px solid black; padding: 40px; border-radius: 10px; background-color: #E0F2F7; margin: auto;">
							<tr>
								<td style="font-size: 18px; padding: 5px;"><a href="javascript:window.history.go(-1)" style="text-decoration: none; color: black; font-size: 30px">O e-mail não é válido</a></td>
							</tr>
						</table>
					</body>
				</html>';
	}
	$con->close();
}

#FORGOT
if (isset($_POST['forgot'])) {
	$con=liga();
	require 'PHPMailer/PHPMailerAutoload.php';
	$nwe = $_POST['nwe'];
	$sql = "SELECT email, nome FROM dw_users WHERE email='$nwe'";
	$res = $con->query($sql);
	if($res->num_rows > 0){
		$mail = new PHPMailer;
		$mail->Host = 'smtp.gmail.com';
		$mail->Port = 465;
		$mail->SMTPAuth = true;
		$mail->SMTPSecure = 'ssl';
		$mail->Username = 'decimalworldservices@gmail.com';
		$mail->Password = 'PassWord';
		$mail->SetFrom("decimalworldservices@gmail.com", "DecimalWorld");
		$mail->AddAddress('hugobumba@hotmail.com', 'Hugo Bumba');
		$mail->Subject = 'Esqueceu-se da palavra-passe';
		$mail->Body = '
		<html>
			<body>		
				<table style="border: 1px solid black; padding: 40px; border-radius: 10px; background-color: #E0F2F7;">
					<td colspan="2"><a href="www.decimalworld.pt/"><img src="www.decimalworld.pt/dw_img/dw_logo3.png" width="150px"></a></td>
					<tr>
						<td style="font-size: 18px; padding: 5px;">Email:</td>
						<td style="font-size: 18px; padding: 5px;"><i>'.$nwe.'</i></td>
					</tr>
					<td><a href="www.decimalworld.pt/dw_gestao.php?p=col_">Alterar palavra-passe</a>
					</td>
				</table>
				<p>Ass: DecimalWorld</p>
			</body>
		</html>';
		$mail->IsHTML(true);
		if(!$mail->Send()){
			echo "Não enviado: ".$mail->ErrorInfo;
		}else{
            echo "<script>alert('Foi enviado um email de autorização ao administrador, aguarde pela resposta!');</script>";
            echo '<html>
					<body>
						<p style="text-align: center;"><a href="www.decimalworld.pt/"><img src="www.decimalworld.pt/dw_img/dw_logo3.png" width="200px"></a></p>
						<table style="border: 1px solid black; padding: 40px; border-radius: 10px; background-color: #E0F2F7; margin: auto;">
							<tr>
								<td style="font-size: 18px; padding: 5px;"><a href="index.php" style="text-decoration: none; color: black; font-size: 30px">Voltar para a página inicial</a></td>
							</tr>
						</table>
					</body>
				</html>';
		}
	}else{
		echo "<script>alert('Este e-mail não está registado')</script>";
		echo '<html>
					<body>
						<p style="text-align: center;"><a href="www.decimalworld.pt/"><img src="www.decimalworld.pt/dw_img/dw_logo3.png" width="200px"></a></p>
						<table style="border: 1px solid black; padding: 40px; border-radius: 10px; background-color: #E0F2F7; margin: auto;">
							<tr>
								<td style="font-size: 18px; padding: 5px;"><a href="index.php" style="text-decoration: none; color: black; font-size: 30px">Voltar para a página inicial</a></td>
							</tr>
						</table>
					</body>
				</html>';
	}
	$con->close();
}

if (isset($_POST['dw_log'])){
	if($_POST['dw_log']=='Entrar'){
		//session_unset();
		//session_destroy();	
		login();
	}
}

if (isset($_GET['op'])){
	if($_GET['op']=='Sair'){
		session_unset();
		session_destroy();
	}
}
	
#ENVIAR PROBLEMA
if (isset($_POST["enp"])){
	$con = liga();
	$nome = $_POST["nome"];
	$cont = $_POST["contato"];
	$mail = $_POST["email"];
	$prob = $_POST["prob"];
	require 'PHPMailer/PHPMailerAutoload';
	function CheckCaptcha($userResponse) {
        $fields_string = '';
        $fields = array(
            'secret' => '6Ld9-lwUAAAAAP3ZoZImR47YwCIvTlpro_ixeFjf',
            'response' => $userResponse,
            'remoteip' => $_SERVER['REMOTE_ADDR']
        );
        foreach($fields as $key=>$value)
        $fields_string .= $key . '=' . $value . '&';
        $fields_string = rtrim($fields_string, '&');
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify');
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, True);
        $res = curl_exec($ch);
        curl_close($ch);
        return json_decode($res, true);
    }
    $result = CheckCaptcha($_POST['g-recaptcha-response']);
	$sql = "INSERT INTO dw_problemas (nome, contacto, email, problema) VALUES ('$nome', '$cont', '$mail', '$prob')";
    if (($result['success']) AND ($con->query($sql) == TRUE)){
		echo "<script>alert('Obrigado por preferir a DecimalWorld, entraremos em contacto consigo!');</script>";
		echo '<html>
					<body>
						<p style="text-align: center;"><a href="www.decimalworld.pt/"><img src="www.decimalworld.pt/dw_img/dw_logo3.png" width="200px"></a></p>
						<table style="border: 1px solid black; padding: 40px; border-radius: 10px; background-color: #E0F2F7; margin: auto;">
							<tr>
								<td style="font-size: 18px; padding: 5px;"><a href="index.php" style="text-decoration: none; color: black; font-size: 30px">Voltar para a página inicial</a></td>
							</tr>
						</table>
					</body>
				</html>';
	}else{
		echo "<script>alert('Houve Algum Erro!');</script>";
		echo '<html>
					<body>
						<p style="text-align: center;"><a href="www.decimalworld.pt/"><img src="www.decimalworld.pt/dw_img/dw_logo3.png" width="200px"></a></p>
						<table style="border: 1px solid black; padding: 40px; border-radius: 10px; background-color: #E0F2F7; margin: auto;">
							<tr>
								<td style="font-size: 18px; padding: 5px;"><a href="index.php" style="text-decoration: none; color: black; font-size: 30px">Voltar para a página inicial</a></td>
							</tr>
						</table>
					</body>
				</html>';
	}
	$con->close();
}

#CONFIRMA
if (isset($_POST['conf'])){
	$con=liga();
	$nome = str_replace("+", " ", $_POST['hnome']);
	$mail = $_POST['hemail'];
	$cont = $_POST['hcontacto'];
	$pass = $_POST['hsenha'];
	$func = $_POST['reg_fun'];
	$para = $mail;
	$tema = 'Sobre a inscrição à DecimalWorld';
	if($_POST['aut'] == 'sim'){
		if ($func != ''){
			$msg = 'O administrador aprovou o seu pedido de registo, inicie sessão no <a href="https://decimalworld.pt/dw_login.php">site</a>';
			$sql2 = "SELECT email FROM dw_users WHERE email='$para'";
			$res2 = $con->query($sql2);
			if($res2->num_rows > 0){
				echo"<script>alert('O utilizador já está registado')</script>";
				echo '<html>
						<body>
							<p style="text-align: center;"><a href="www.decimalworld.pt/"><img src="www.decimalworld.pt/dw_img/dw_logo3.png" width="200px"></a></p>
							<table style="border: 1px solid black; padding: 40px; border-radius: 10px; background-color: #E0F2F7; margin: auto;">
								<tr>
									<td style="font-size: 18px; padding: 5px;"><a href="dw_gestao.php?p=col_" style="text-decoration: none; color: black; font-size: 30px">Ver os colaboradores do site</a></td>
								</tr>
							</table>
						</body>
					</html>';
			}else{
				$sql = "INSERT INTO dw_users (nome, email, contacto, funcao, senha) VALUES ('$nome', '$mail', '$cont', '$func', '$pass')";
				$res = $con->query($sql);
				if($res->num_rows == 0){
					echo "<script>alert('Aprovou o registo de mais um membro na equipa!');</script>";
					mail($mail, $tema, $msg);
					echo '<html>
						<body>
							<p style="text-align: center;"><a href="www.decimalworld.pt/"><img src="www.decimalworld.pt/dw_img/dw_logo3.png" width="200px"></a></p>
							<table style="border: 1px solid black; padding: 40px; border-radius: 10px; background-color: #E0F2F7; margin: auto;">
								<tr>
									<td style="font-size: 18px; padding: 5px;"><a href="dw_gestao.php?p=col_" style="text-decoration: none; color: black; font-size: 30px">Ver os colaboradores do site</a></td>
								</tr>
							</table>
						</body>
					</html>';
				}
			}
		}else{
			echo "<script>alert('Escolha uma das opções!');</script>";
		}
	}elseif($_POST['aut'] == 'nao'){
		echo "<script>alert('Rejetou o pedido de registo.');</script>";
		$msg = 'O administrador rejeitou o seu pedido de registo';
		mail($para, $tema, $msg);
		echo '<html>
					<body>
						<p style="text-align: center;"><a href="www.decimalworld.pt/"><img src="www.decimalworld.pt/dw_img/dw_logo3.png" width="200px"></a></p>
						<table style="border: 1px solid black; padding: 40px; border-radius: 10px; background-color: #E0F2F7; margin: auto;">
							<tr>
								<td style="font-size: 18px; padding: 5px;"><a href="index.php" style="text-decoration: none; color: black; font-size: 30px">Voltar para a página inicial</a></td>
							</tr>
						</table>
					</body>
				</html>';
	}else{
		echo "<script>alert('Atribua uma função!');</script>";
	}
	$con->close();
}

#PUBLICAR E ALTERAR AS NOTÍCIA
if (isset($_POST["pub"])){
	if($_POST["pub"]=="Publicar"){
		$con = liga();
		$titulo = utf8_encode($_POST["tn"]);
		$noticia = utf8_encode($_POST["nt"]);
		$sql = "INSERT INTO dw_noticias(titulo, noticia) VALUES('$titulo', '$noticia')";
		if ($con->query($sql) === TRUE) {
			echo "<script>alert('NOTÍCIA PUBLICADA COM SUCESSO!');</script>";
			echo '<html>
					<body>
						<p style="text-align: center;"><a href="www.decimalworld.pt/"><img src="www.decimalworld.pt/dw_img/dw_logo3.png" width="200px"></a></p>
						<table style="border: 1px solid black; padding: 40px; border-radius: 10px; background-color: #E0F2F7; margin: auto;">
							<tr>
								<td style="font-size: 18px; padding: 5px;"><a href="dw_gestao.php?p=not_" style="text-decoration: none; color: black; font-size: 30px">Ver Notícias</a></td>
							</tr>
						</table>
					</body>
				</html>';
		}else{
			echo "<script>alert('ERRO!');</script>";
			echo '<html>
					<body>
						<p style="text-align: center;"><a href="www.decimalworld.pt/"><img src="www.decimalworld.pt/dw_img/dw_logo3.png" width="200px"></a></p>
						<table style="border: 1px solid black; padding: 40px; border-radius: 10px; background-color: #E0F2F7; margin: auto;">
							<tr>
								<td style="font-size: 18px; padding: 5px;"><a href="dw_pub.php" style="text-decoration: none; color: black; font-size: 30px">Tentar novamente</a></td>
							</tr>
						</table>
					</body>
				</html>';
		}
		$con->close();
	}elseif($_POST["pub"]== "Alterar"){
		$liga = liga();
		$id2=$_POST['id2'];
		$titulo = utf8_encode($_POST["tn"]);
		$noticia = utf8_encode($_POST["nt"]);
		date_default_timezone_set("Europe/Lisbon");
		$data=date("Y-m-d H:i:s");
		$sql_1="UPDATE dw_noticias SET titulo=?,noticia=?,datahora=? WHERE id=?";
		$lista=$liga->prepare($sql_1);
		$lista->bind_param('sssi',$titulo,$noticia,$data,$id2);
		if($lista->execute() && $liga->affected_rows>0){
			echo "<script>alert('NOTÍCIA ALTERIADA COM SUCESSO!')</script>";
			echo '<html>
					<body>
						<p style="text-align: center;"><a href="www.decimalworld.pt/"><img src="www.decimalworld.pt/dw_img/dw_logo3.png" width="200px"></a></p>
						<table style="border: 1px solid black; padding: 40px; border-radius: 10px; background-color: #E0F2F7; margin: auto;">
							<tr>
								<td style="font-size: 18px; padding: 5px;"><a href="dw_gestao.php?p=not_" style="text-decoration: none; color: black; font-size: 30px">Ver Notícias</a></td>
							</tr>
						</table>
					</body>
				</html>';
		}else{
			echo "<script>alert('ERRO!')</script>";
			echo '<html>
					<body>
						<p style="text-align: center;"><a href="www.decimalworld.pt/"><img src="www.decimalworld.pt/dw_img/dw_logo3.png" width="200px"></a></p>
						<table style="border: 1px solid black; padding: 40px; border-radius: 10px; background-color: #E0F2F7; margin: auto;">
							<tr>
								<td style="font-size: 18px; padding: 5px;"><a href="dw_gestao.php?p=not_" style="text-decoration: none; color: black; font-size: 30px">Tentar novamente</a></td>
							</tr>
						</table>
					</body>
				</html>';
		}	
		$liga->close();
	}
}

#ADICIONAR SERVIÇO
if(isset($_POST["addc"])){
	if($_POST['addc']=="Adicionar")
	{
		$con = liga();
		$nome = utf8_encode($_POST["tc"]);
		$desc = utf8_encode($_POST["dc"]);
		$cats = utf8_encode($_POST["cats"]);
		$foto = $_FILES["fc"]; 
		if(!empty($foto["name"])){
			$img = uniqid(time());
			$caminho_imagem = "dw_img/".$img.".jpg";
			move_uploaded_file($foto["tmp_name"], $caminho_imagem);
			$sql = "INSERT INTO dw_conteudos (nome_cont, descricao, nome, foto) VALUES ('$nome', '$desc', '$cats', '$img')";
			if ($con->query($sql) == TRUE) {
				echo "<script>alert('SERVIÇO ADICIONADO COM SUCESSO!')</script>";
				echo '<html>
						<body>
							<p style="text-align: center;"><a href="www.decimalworld.pt/"><img src="www.decimalworld.pt/dw_img/dw_logo3.png" width="200px"></a></p>
							<table style="border: 1px solid black; padding: 40px; border-radius: 10px; background-color: #E0F2F7; margin: auto;">
								<tr>
									<td style="font-size: 18px; padding: 5px;"><a href="dw_gestao.php?p=cat_" style="text-decoration: none; color: black; font-size: 30px">Ver Serviços</a></td>
								</tr>
							</table>
						</body>
					</html>';
			}else{
				echo "<script>alert('ERRO!')</script>";
				echo '<html>
						<body>
							<p style="text-align: center;"><a href="www.decimalworld.pt/"><img src="www.decimalworld.pt/dw_img/dw_logo3.png" width="200px"></a></p>
							<table style="border: 1px solid black; padding: 40px; border-radius: 10px; background-color: #E0F2F7; margin: auto;">
								<tr>
									<td style="font-size: 18px; padding: 5px;"><a href="dw_cont.php" style="text-decoration: none; color: black; font-size: 30px">Tentar novamente</a></td>
								</tr>
							</table>
						</body>
					</html>';
			}
		}
		$con->close();
	}
	elseif($_POST['addc']=="Alterar")
	{
		$liga = liga();
		$id4=$_POST['id4'];
		$nome = utf8_encode($_POST["tc"]);
		$desc = utf8_encode($_POST["dc"]);
		$sql="UPDATE dw_conteudos SET nome_cont=?,descricao=? WHERE id=?";	
		$lista= $liga->prepare($sql);
		$lista->bind_param('ssi',$nome,$desc,$id4);
		if($lista->execute() && $liga->affected_rows>0){
			echo "<script>alert('SERVIÇO ALTERADO COM SUCESSO!')</script>";
			echo '<html>
					<body>
						<p style="text-align: center;"><a href="www.decimalworld.pt/"><img src="www.decimalworld.pt/dw_img/dw_logo3.png" width="200px"></a></p>
						<table style="border: 1px solid black; padding: 40px; border-radius: 10px; background-color: #E0F2F7; margin: auto;">
							<tr>
								<td style="font-size: 18px; padding: 5px;"><a href="dw_gestao.php?p=cat_" style="text-decoration: none; color: black; font-size: 30px">Ver Serviços</a></td>
							</tr>
						</table>
					</body>
				</html>';
		}else{
			echo "<script>alert('ERRO!')</script>";
			echo '<html>
					<body>
						<p style="text-align: center;"><a href="www.decimalworld.pt/"><img src="www.decimalworld.pt/dw_img/dw_logo3.png" width="200px"></a></p>
						<table style="border: 1px solid black; padding: 40px; border-radius: 10px; background-color: #E0F2F7; margin: auto;">
							<tr>
								<td style="font-size: 18px; padding: 5px;"><a href="dw_gestao.php?p=cat_" style="text-decoration: none; color: black; font-size: 30px">Tentar novamente</a></td>
							</tr>
						</table>
					</body>
				</html>';
		}
		$liga->close();	
	}
}

#ADICIONAR CERTIFICADO
if(isset($_POST["adcp"])){
	if($_POST['adcp']=="Adicionar"){
		$con = liga();
		$emp = utf8_encode($_POST["ecp"]);
		$nome = utf8_encode($_POST["ncp"]);
		$foto = $_FILES["fcp"]; 
		if(!empty($foto["name"])){
			$img = uniqid(time());
			$caminho_imagem = "dw_img/".$img.".jpg";
			move_uploaded_file($foto["tmp_name"], $caminho_imagem);
			$sql = "INSERT INTO dw_certs (empresa, nome, foto) VALUES ('$emp', '$nome', '$img')";
			if ($con->query($sql) == TRUE) {
				echo "<script>alert('ADIÇÃO FEITA COM SUCESSO!')</script>";
				echo '<html>
						<body>
							<p style="text-align: center;"><a href="www.decimalworld.pt/"><img src="www.decimalworld.pt/dw_img/dw_logo3.png" width="200px"></a></p>
							<table style="border: 1px solid black; padding: 40px; border-radius: 10px; background-color: #E0F2F7; margin: auto;">
								<tr>
									<td style="font-size: 18px; padding: 5px;"><a href="dw_gestao.php?p=certs_" style="text-decoration: none; color: black; font-size: 30px">Ver Certificados</a></td>
								</tr>
							</table>
						</body>
					</html>';
			}else{
				echo "<script>alert('ERRO!')</script>";
				echo '<html>
						<body>
							<p style="text-align: center;"><a href="www.decimalworld.pt/"><img src="www.decimalworld.pt/dw_img/dw_logo3.png" width="200px"></a></p>
							<table style="border: 1px solid black; padding: 40px; border-radius: 10px; background-color: #E0F2F7; margin: auto;">
								<tr>
									<td style="font-size: 18px; padding: 5px;"><a href="dw_cert.php" style="text-decoration: none; color: black; font-size: 30px">Tentar novamente</a></td>
								</tr>
							</table>
						</body>
					</html>';
			}
		}
		$con->close();
	}
}

#ADICIONAR CATEGORIA
if(isset($_POST["add"])){
	if($_POST["add"] == "Adicionar"){
		$con = liga();
		$nome = utf8_encode($_POST["ts"]);
		$desc = utf8_encode($_POST["ds"]);
		$foto = $_FILES["fs"]; 
		if(!empty($foto["name"])){
			$img = uniqid(time());
			$caminho_imagem = "dw_img/".$img.".jpg";
			move_uploaded_file($foto["tmp_name"], $caminho_imagem);
			$sql = "INSERT INTO dw_servicos (nome, servico, foto) VALUES ('$nome', '$desc', '$img')";
			if ($con->query($sql) == TRUE) {
				echo "<script>alert('CATEGORIA ADICIONADA COM SUCESSO!')</script>";
				echo '<html>
						<body>
							<p style="text-align: center;"><a href="www.decimalworld.pt/"><img src="www.decimalworld.pt/dw_img/dw_logo3.png" width="200px"></a></p>
							<table style="border: 1px solid black; padding: 40px; border-radius: 10px; background-color: #E0F2F7; margin: auto;">
								<tr>
									<td style="font-size: 18px; padding: 5px;"><a href="dw_gestao.php?p=serv_" style="text-decoration: none; color: black; font-size: 30px">Ver Categorias</a></td>
								</tr>
							</table>
						</body>
					</html>';
			}else{
				echo "<script>alert('ERRO!')</script>";
				echo '<html>
						<body>
							<p style="text-align: center;"><a href="www.decimalworld.pt/"><img src="www.decimalworld.pt/dw_img/dw_logo3.png" width="200px"></a></p>
							<table style="border: 1px solid black; padding: 40px; border-radius: 10px; background-color: #E0F2F7; margin: auto;">
								<tr>
									<td style="font-size: 18px; padding: 5px;"><a href="dw_serv.php" style="text-decoration: none; color: black; font-size: 30px">Tentar novamente</a></td>
								</tr>
							</table>
						</body>
					</html>';
			}
			$con->close();
		}
	}elseif($_POST["add"] == "Alterar"){
		$liga = liga();
		$id3=$_POST['id3'];
		$nm = utf8_encode($_POST["ts"]);
		$ds = utf8_encode($_POST["ds"]);		
		$sql="UPDATE dw_servicos SET nome=?,servico=? WHERE id=?";	
		$lista= $liga->prepare($sql);
		$lista->bind_param('ssi',$nm,$ds,$id3);
		if($lista->execute() && $liga->affected_rows>0){
			echo "<script>alert('CATEGORIA ALTERIADA COM SUCESSO!')</script>";
				echo '<html>
						<body>
							<p style="text-align: center;"><a href="www.decimalworld.pt/"><img src="www.decimalworld.pt/dw_img/dw_logo3.png" width="200px"></a></p>
							<table style="border: 1px solid black; padding: 40px; border-radius: 10px; background-color: #E0F2F7; margin: auto;">
								<tr>
									<td style="font-size: 18px; padding: 5px;"><a href="dw_gestao.php?p=serv_" style="text-decoration: none; color: black; font-size: 30px">Ver Categorias</a></td>
								</tr>
							</table>
						</body>
					</html>';
			}else{
				echo "<script>alert('ERRO!')</script>";
				echo '<html>
						<body>
							<p style="text-align: center;"><a href="www.decimalworld.pt/"><img src="www.decimalworld.pt/dw_img/dw_logo3.png" width="200px"></a></p>
							<table style="border: 1px solid black; padding: 40px; border-radius: 10px; background-color: #E0F2F7; margin: auto;">
								<tr>
									<td style="font-size: 18px; padding: 5px;"><a href="dw_gestao.php?p=serv_" style="text-decoration: none; color: black; font-size: 30px">Tentar novamente</a></td>
								</tr>
							</table>
						</body>
					</html>';
			}
		$liga->close();	
	}	
}
$vl=0;

#MUDAR NOME 
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
	if($vl=1){
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

#MUDAR SENHA
$vl=0;
if(isset($_POST["ps"])){
	$lp=$_POST["idn"];
	$kp=$_POST["ps"];
	$ant=$_POST["ant"];
	if($_SESSION['senha'] == $ant){
		$liga=liga();
		$sql="UPDATE dw_users SET senha=? WHERE id=?";
		$lista= $liga->prepare($sql);
		$lista->bind_param('si',$kp,$lp);
		if($lista->execute() && $liga->affected_rows>0){
			$vl=1;
			$lista->close();	
		}
		$liga->close();
		if($vl=1){
			$con=liga();
			$sql = "SELECT senha FROM dw_users WHERE id=?";
			$ligar = $con->prepare($sql);
			$ligar->bind_param('i',$lp);
			$ligar->execute();
			$ligar->bind_result($senha);
			if($ligar->fetch()){
				$_SESSION['senha']=$senha;
				echo '<script>alert("A Password foi alterada");</script>';
				$ligar->close();
				$con->close();
			}	
		}
	$vl=0;
	}else{
		echo '<script>alert("A Password antiga não coincide");</script>';
	}
	$vl=0;		
}
?>