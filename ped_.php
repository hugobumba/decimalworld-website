<?php if($_SESSION['funcao']=='Administrador' or $_SESSION['funcao']=='Gestor'){?>
<h4 style="text-align:center">Informações sobre os Pedidos</h4>
<?php
	$liga=liga();
	$sql = "SELECT * FROM dw_problemas";
	$paginas = "10";
	if(isset($_POST['pagina']))
	{
		$pg=$_POST['pagina'];~
		$pn = $pg;
	} 
	else
	{
		$pn = "1";
	
	}
	$pri = $pn - 1;
	$pri = $pri * $paginas;
	$limite = $liga->query("SELECT * FROM dw_problemas LIMIT ".$pri.",".$paginas."");
	$reg = $liga->query($sql);
	$tr= $reg->num_rows;
	$tp = $tr / $paginas;
	if ($tr > 0){?>
		<table class="table" id="cr">
		<tr>
			<th>NOME</th>
			<th>CONTACTO</th>
			<th>EMAIL</th>
			<th colspan="2" style="text-align:left;">DATA/HORA</th>
		</tr>
		<?php
			while($row = $limite->fetch_assoc()){?>
           <tr >
				<td><?php echo $row["nome"];?></td>
				<td><?php echo $row["contacto"];?></td>
				<td><?php echo $row["email"];?></td>
				<td><?php echo $row["datahora"];?></td>
				<td>
                	<?php $a=$row['id'];?>
                    <button type="button" id="imais<?php echo $a;?>" class="btn btn-info" data-toggle="modal" data-target="#mais<?php echo $row['id'];?>" style="float:rigth">
                       	 Mais
                     </button>              
                     <div class="modal fade" id="mais<?php echo $row['id'];?>" role="dialog">
						<div class="modal-dialog modal-nm">
                            <div class="modal-content">
                                    <div class="modal-body" align="center">
                                    		<p>Problema:</p>
                                            <div class="well">
                                                <?php 
													echo $row['problema'];
												 ?>
                                            </div>
                                    </div>
                                    <div class="modal-footer" style="text-align:center">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>      
                                    </div>
                                  </div>
                            </div>
                         </div>
                      </div>
                </td>
                <td>     
                      <button type="submit"  id="del<?php echo $a;?>" class="btn btn-default" onclick="window.location.href='?po=<?php echo $a; ?>'">
                    	Eliminar
                    </button>
                 </td>
			</tr>
			<?php
                }
			}
			$liga->close(); ?>
 </table>
  	<div align="center">
    <?php
		$ant = $pn -1;
		$seg = $pn +1;
	?>
    <ul class="list-inline">
    	<li>
    	<form action="" method="post">
        	<input type="hidden" name="pagina" value="<?php echo $ant; ?>" />
        	<input type="submit" class="btn btn-default" value="Anterior"
            <?php 
            if($pn <= 1)
                echo "disabled='disabled'";
            else
                echo "";	
         ?> 
           />
       </form>
       </li>
       <li>
       <form action="" method="post">
        <input type="hidden" name="pagina" value="<?php echo $seg; ?>" />
        <input type="submit" class="btn btn-default" value="Seguinte" 
        <?php 
            if($pn >= $tp)
                echo "disabled='disabled'";
            else
                echo "";
         ?>/>
       </form>
       </li>
      </ul>
   </div>
<?php 
 	}elseif($_SESSION['funcao']=='Publicador')
		header("location:dw_gestao.php?p=not_");
	else
		header("location:index.php");
?>