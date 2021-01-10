<?php if(($_SESSION['funcao']=='Administrador' or ($_SESSION['funcao']=='Gestor') )){?>
<?php
	$con=liga();
	$sql2="SELECT posicao_s FROM dw_servicos WHERE posicao_s = 1";
	$res2=$con->query($sql2);
	$count=$res2->num_rows;	
	$con->close();	 
?>
<h4 style="text-align:center">Informações sobre as Categorias</h4>
<p>
	<form id="formpd" method="post">
       <select style="float:right" id="slc" name="slc" class="form-control" onchange="document.getElementById('formpd').submit();">
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
	$sql = ordenar();
	$res = $liga->query($sql);
	if ($res->num_rows > 0){?>
		<table class="table" id="cr">
			<tr>
				<th>NOME</th>
                <th>MARCAR</th>
				<th colspan="3" style="text-align:left;">OUTROS</th>
			</tr>
	        <?php
				while($row = $res->fetch_assoc()){?>
				<tr>
					<td><?php echo utf8_decode($row["nome"]);?></td>
                    <td>
                    	<form method="post">
                        <input type="hidden" name="idps" value="<?php echo $row['id']; ?>"  />
                    	<input type="checkbox" name="pss<?php echo $row['id']; ?>" 
                        	id="pos<?php echo $row['id']; ?>" onclick="this.form.submit();"
                             <?php if ($row['posicao_s']==1) { echo 'checked="checked"';} ?>
                             <?php if($count==3)
							 {
								 if($row['posicao_s']!=1)
									echo "disabled='disabled'";
							 }
							 else
							 	echo "";
							?>
                             />
                        </form>
                    </td>
                    <td>
                    	<div class="dropdown">
  							<button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown" data-hover="dropdown">
   								Serviços <span class="caret"></span>
  							</button>
  							<ul class="dropdown-menu">
    							<?php
									$sql2="SELECT dw_conteudos.nome_cont FROM dw_conteudos INNER JOIN dw_servicos ON dw_conteudos.nome=dw_servicos.nome WHERE dw_conteudos.nome='".$row['nome']."'"; 
									$res2=$liga->query($sql2);
									if($res2->num_rows > 0)
									{
										while($row2=$res2->fetch_assoc())
										{
										?>
         									<li><a tabindex="-1" href="#"><?php echo utf8_decode($row2['nome_cont']); ?></a></li>
                                        <?php 
										}	
									}
								?>
                            </ul>
                         </div>       
                   	</td>
                    <td><?php $s= $row["id"];?>
                        <button type="button" class="btn btn-info" data-toggle="modal" data-target="#im<?php echo $row['id'];?>">
                            <span class="glyphicon glyphicon-picture"> Imagem</span>
                        </button>
                        <div class="modal fade" id="im<?php echo $row['id'];?>" role="dialog">
                            <div class="modal-dialog modal-nm">
                              <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <p>Alterar Imagem da Categoria</p>
                                    </div>
                                    <div class="modal-body">
                                    <p>Imagem Atual</p>
                                        <p align="center"><img src="dw_img/<?php echo $row['foto']; ?>.jpg" class="img-circle" alt="user" width="70" height="60"></p><br />
                                        <div align="center" style="overflow:scroll">
                                            <form enctype="multipart/form-data" method="post">
                                                Escolhe a Imagem Nova:<br />
                                                <input type="hidden" name="ifot" value="<?php echo $row['id']; ?>"/>
                                                <input type="file" name="fot" id="fot" required/>
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
						<button type="submit" class=" btn btn-primary" onclick="window.location.href='dw_serv.php?nt=<?php echo $s;?>'">
	                    	Alterar
	                    </button>
	 				</td>
	                <td>
                        <button type="submit" class="btn btn-default" style="text-decoration:none" onclick="window.location.href='?s=<?php echo $s; ?>'">
	                    	Eliminar
	                    </button>
	                </td>
				</tr>
				<?php
				    }
				}
				$liga->close(); ?>
 		</table>
<?php 
	}elseif($_SESSION['funcao']=='Publicador')
		header("location:dw_gestao.php?p=not_");
	else
		header("location:index.php");			
?>