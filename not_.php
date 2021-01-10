<?php if(($_SESSION['funcao']=='Administrador' or ($_SESSION['funcao']=='Gestor') or ($_SESSION['funcao']=='Publicador'))){?>
<h4 style="text-align:center">Informação sobre as Notícias</h4>
<?php
	$liga=liga();
	$sql = "SELECT * FROM dw_noticias";
	$res = $liga->query($sql);
	if ($res->num_rows > 0){ ?>
		<table class="table" id="cr">
			<tr>
				<th>TITULO</th>
				<th colspan="3" style="text-align:left;">DATA/HORA</th>
			</tr>
			<?php
				while($row = $res->fetch_assoc()){?>
				<tr>
					<td><?php echo utf8_decode($row["titulo"])?></td>
					<td><?php echo $row["datahora"];?></td>
					<td>
	                <?php $a= $row['id'];?>
						<button type="submit" class="btn btn-primary" onclick="window.location.href='dw_pub.php?nt=<?php echo $a?>'">
	                    	Alterar
	                    </button>
	  				</td>
	  				<td>
                        <button type="submit" class="btn btn-default" onclick="window.location.href='?nt=<?php echo $a?>'">
	                    	Eliminar
	                    </button>
	                </td>
				</tr>
				<?php
					    }
					}
					$liga->close();
				?>
		</table>
	<?php 
 		}else{
		header("location:index.php");
	}
?>