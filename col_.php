<?php if($_SESSION["funcao"]=="Administrador"){?>
<h4 style="text-align:center">Informações sobre os Colaboradores</h4>
<?php
	$liga=liga();
	$sql = "SELECT * FROM dw_users";
	$res = $liga->query($sql);
	if ($res->num_rows > 0){ ?>
	<table class="table" id="cr">
		<tr>
			<th>NOME</th>
			<th>EMAIL</th>
			<th>CONTACTO</th>
            <th colspan="3" style="text-align:left;">FUNÇÃO</th>
	    </tr>
		<?php
			while($row = $res->fetch_assoc()){?>
			<tr>
				<td><?php echo $row["nome"];?></td>
			    <td><?php echo $row["email"];?></td>
				<td><?php echo $row["contacto"];?></td>
				<td><?php echo $row["funcao"];?></td>
                <td>
                	<button type="button" class="btn btn-info" data-toggle="modal" data-target="#myModal<?php echo $row['id'];?>">
                		Mais
                	</button>
                    <div class="modal fade" id="myModal<?php echo $row['id'];?>" role="dialog">
						<div class="modal-dialog modal-sm">
                          <!-- Modal content-->
                          	<div class="modal-content">
                            	<div class="modal-header">
                              		<button type="button" class="close" data-dismiss="modal">&times;</button>
                              			<h4 class="modal-title">
                                        	<b><?php  echo $row['nome'];?></b> 
                                        	<sub><?php  echo $row['funcao'];?></sub>
                                        </h4>
                            	</div>
                            	<div class="modal-body">
                              		<?php $b= $row['id'];?>
		        					<form id="<?php echo "form".$b ?>" method="get" style="text-align:center">
                                    	  <img src="dw_img/150631-OUD927-864-min.jpg" class="img-circle" alt="user" width="60" height="50"><br />
			            				<input type="hidden" name="ipv" value="<?php echo $b;?>" /><br />
			           				 	<select name="pq"  id="<?php echo $b; ?>" onchange="submete(this.id);">
											<?php
                                                echo '<option value="-1">Mudar de função</option>';
                                                echo '<option value="Administrador">Administrador</option>';
                                                echo '<option value="Publicador">Publicador</option>';
                                                echo '<option value="Gestor">Gestor</option>'; 
                                            ?>
                                      	</select><br />
	            					</form><br />
                                    <div class="well">
                                    	<form method="post" style="text-align:center">
                                        <div class="form-group">
                                            <label>Nova PassWord:</label><br />
                                            <input type="password" name="altp"  class="form-control" maxlength="20" required /><br />
                                            <input type="hidden" name="ipv" value="<?php echo $b;?>" /><br />
                                            <input type="submit" class="btn btn-default" value="Alterar PassWord"/>
                                            <br />
                                        </div>
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
                	<button type="submit" class="btn btn-default" style="float:left" onclick="window.location.href='?kp=<?php echo $b; ?>'">
                        Eliminar
                	</button><br />
		        </td>
		    </tr>
	    <?php
			}
		}
		$liga->close(); ?>  
		</table>
<?php 
	}else{
	header("location:dw_gestao.php?p=not_");
	}
?>