<?php if(($_SESSION['funcao']=='Administrador' or ($_SESSION['funcao']=='Gestor') )){?>
<?php
	$con=liga();
	$sql2="SELECT posicao FROM dw_conteudos WHERE posicao = 1";
	$res2=$con->query($sql2);
	$count=$res2->num_rows;	
	$con->close();	 
?>
<h4 style="text-align:center">Informação sobre os Serviços</h4>
<p>
	<form id="formpd2" method="post">
       <select style="float:right" id="ctg" name="ctg" class="form-control" onchange="document.getElementById('formpd2').submit();">
            <option value="-1">Ordenar Por:</option>
            <option value="1">Mais Recentes</option>
            <option value="2">Nome Ascendente</option>
            <option value="3">Nome Descendente</option>
            <option value="4">Mais Antigos</option>           
        </select>
    </form>
</p>
<?php
	$liga=liga();
	$sql = ordenar2();
	$res = $liga->query($sql);
	if ($res->num_rows > 0){ ?>
		<table class="table" id="cr">
			<tr>
                <th>TITULO</th>
                <th>CATEGORIA</th>
                <th>MARCAR</th>
				<th colspan="3" style="text-align:left;">OUTROS</th>
			</tr>
			<?php
				while($row = $res->fetch_assoc()){?>
				<tr>
                    <td><?php echo utf8_decode($row["nome_cont"])?></td>
                    <td><?php echo utf8_decode($row["nome"])?></td>
                    <td align="center">
                    	<form method="post">
                        <input type="hidden" name="idpos" value="<?php echo $row['id']; ?>"  />
                    	<input type="checkbox" name="pos<?php echo $row['id']; ?>" 
                        	id="pos<?php echo $row['id']; ?>" onclick="this.form.submit();"
                             <?php if ($row['posicao']==1) { echo 'checked="checked"';} ?>
                             <?php if($count==3)
							 {
								 if($row['posicao']!=1)
									echo "disabled='disabled'";
							 }
							 else
							 	echo ""; 	 
							?>
                             />
                        </form>
                    </td>
					<td>
	                <?php $a= $row['id'];?>
<button type="button" class="btn btn-info" data-toggle="modal" data-target="#ims<?php echo $row['id'];?>">
                		<span class="glyphicon glyphicon-picture"> Imagem</span>
                        </button>
                    <div class="modal fade" id="ims<?php echo $row['id'];?>" role="dialog">
						<div class="modal-dialog modal-nm">
                          <!-- Modal content-->
                          	<div class="modal-content">
                            	<div class="modal-header">
                              		<button type="button" class="close" data-dismiss="modal">&times;</button>
                                    <p>Alterar Imagem dos Serviços</p>
                            	</div>
                            	<div class="modal-body">
                                <p>Imagem Atual</p>
                                	<p align="center"><img src="dw_img/<?php echo $row['foto']; ?>.jpg" class="img-circle" alt="user" width="70" height="60"></p><br />
                                    <div align="center" style="overflow:scroll">
                                        <form enctype="multipart/form-data" method="post">
                                            Escolhe a Imagem Nova:<br />
                                            <input type="hidden" name="ifsr" value="<?php echo $row['id']; ?>"/>
                                            <input type="file" name="ftsr" id="ftsr" required/>
                                            <input type="submit" class="btn btn-primary" value="Alterar"/>
                                        </form>
                                    </div>
                            	</div>
                            	<div class="modal-footer" style="text-align:center">
                             		 <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                            	</div>
                          	</div>
                        </div>
                   </div> 
                    </td>
                    <td>
						<button type="submit" class="btn btn-primary" onclick="window.location.href='dw_cont.php?cont=<?php echo $a?>'">
	                    	Alterar
	                    </button>
	  				</td>
	  				<td>
                        <button type="submit"  class="btn btn-default" onclick="window.location.href='?ca=<?php echo $a; ?>'">
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
 		}elseif($_SESSION['funcao']=='Publicador')
		header("location:dw_gestao.php?p=not_");
	else
		header("location:index.php");
?>