<!DOCTYPE html>
<html>
	<head>
		<title>Suporte</title>
		<meta charset="utf-8">
		<link rel="shortcut icon" href="dw_img/dw_logo1.png"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link href="https://fonts.googleapis.com/css?family=Poppins:300" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
			.ola{
				background-color:rgba(192,192,192,0.3);
			}
			.oi{
				transition: all 0.3s ease;
				opacity: 1;
				color: white;
			}
			.oi:hover{
				transition: all 0.3s ease;
				opacity: 2;
			    -ms-transform: scale(1.2);
			    -webkit-transform: scale(1.2);
			    transform: scale(1.2);
			    color: white;
			}
			td{
				border: 1px solid #ccc;
				padding: 10px;
			    border-radius: 10px;
			    -webkit-transition: all 0.5s;
				-moz-transition: all 0.5s;
				transition: all 0.5s;
			}
			a{
				text-decoration: none;
				padding: 20px 40px;
				color: white;
			    font-size: 30px;
			}
			a:hover{
				color: #2481BA;
			}
			td:hover{
				background-color: white;
				border: 1px solid black;
				-webkit-transition: all 0.5s;
				-moz-transition: all 0.5s;
				transition: all 0.5s;
			}
			body{
				background-size: cover;
				background-position: center;
				background-repeat: no-repeat;
				background-attachment: fixed;
				background-image: linear-gradient(rgba(0,0,0,0.3), rgba(0,0,0,0.3)), url('dw_img/8010.jpg');
			}
			.loader {
				position: fixed;
				left: 0px;
				top: 0px;
				width: 100%;
				height: 100%;
				z-index: 9999;
				background: url(dw_img/Preloader_5.gif) center no-repeat #fff;
			}
			h1{
				color: white;
			    font-size: 30px;
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
				position: absolute;
				opacity: 0;
				top: 0;
				left: -10px;
				transition: 0.5s;
			}
			a{text-decoration:none;}
			.button:after{content:'';}
			.button:hover:after{content:'Voltar'; color: white;}
			.button:hover span {padding-left: 10px; color: #2481BA;}
			.button:hover span:after {
				opacity: 1;
				left: 0;
			}
		</style>
	</head>
	<body style="padding-top: 50px;">
    	<div class="loader"></div>
		<h1 style="text-align: center;">Faça o download do arquivo e siga os passos</h1><br>
		<table style="margin: auto;">
			<tr>
				<td><a href="https://www.iperiusremote.com/IperiusRemote.exe" target="_blank">1 - Download</a></td>
			</tr>
			<tr>
				<td><a href="https://www.iperiusremote.com/iperius-remote-quick-start.aspx" target="_blank">2 - Seguir os passos</a></td>
			</tr>
			<tr>
				<td class="ola"><a href="index.php#contact">3 - Contacte-nos</a></td>
			</tr>
		</table><br>
		<div style="text-align: center;">
			
			<a class="button" href="javascript:window.history.go(-1)"><span><i class="fa fa-arrow-circle-o-left oi" style="font-size:30px"></i>&nbsp;</span></a>
		</div>
	</body>
</html>