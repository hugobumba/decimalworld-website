<?php if(($_SESSION['funcao']=='Administrador' or ($_SESSION['funcao']=='Gestor') )){?>
<h4 style="text-align:center">Informações sobre os Sertificados e Parcerias</h4>
<?php
	$liga=liga();
	$sql = "SELECT * FROM dw_certs";
	$res = $liga->query($sql);
	if ($res->num_rows > 0){?>
<table class="table" id="cr">
			<tr>
				<th>EMPRESA</th>
                <th>NOME</th>
				<th colspan="3" style="text-align:left;">FOTO</th>
			</tr>
	        <?php
				while($row = $res->fetch_assoc()){?>
				<tr>
                	<td><?php echo utf8_decode($row["empresa"]);?></td>
					<td><?php echo utf8_decode($row["nome"]);?></td>
                    <td><img class="img-rounded"  width="50px" heigth="50px" src='dw_img/<?php echo $row["foto"]; ?>.jpg'></td>
                    <td>
                        <button type="submit" class="btn btn-default" style="text-decoration:none" onclick="window.location.href='?tcp=<?php echo $row['id']; ?>'">
	                    	Eliminar
	                    </button>
	                </td>
				</tr>
				<?php
				    }
				}
				$liga->close(); ?>
 		</table>
<?php } ?>