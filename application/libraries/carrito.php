<?php if ( ! defined('BASEPATH') ) exit('No direct script access allowed');
class Carrito{


	public function add_item_carrito($idCliente, $propiedad, $cliente, $costo){

	  if(!isset($_SESSION['carrito'])){
	    $carrito= array($idCliente => array('idCliente'=>$idCliente, 'cliente'=>$cliente, 'propiedad'=>$propiedad, 'costo'=>$costo, 'cantidad'=>1));
	    $_SESSION['carrito']=$carrito;
	  }else{//si ya se ha inicializado la session entonces solamente agrego un nuevo elemento a mi arreglo de session
	  	
	  	  $encontrado=false;
		  foreach($_SESSION['carrito'] as $item){
			  foreach($item as $valor){
				  if($valor==$idCliente){
					  $encontrado=true;
				  }
			  }
		  }
		  if($encontrado==false){
			   $_SESSION['carrito'][$idCliente]['idCliente']=$idCliente;
			   $_SESSION['carrito'][$idCliente]['cliente']=$cliente;
		       $_SESSION['carrito'][$idCliente]['propiedad']=$propiedad;
			   $_SESSION['carrito'][$idCliente]['costo']=$costo;
			   $_SESSION['carrito'][$idCliente]['cantidad']=1;
		  } 
	   }

	}


	public function delete_item_carrito($item){

		//borrar el articulo seleccionado del carrito de compras
		unset($_SESSION['carrito'][$item]);

	}


	public function view_carrito(){

		if(isset($_SESSION['carrito']) && !empty($_SESSION['carrito'])){ 
		  
		  //para contar el total de articulos que contiene el carrito
		  $numClientes=0;
		  foreach($_SESSION['carrito'] as $item){
			  foreach($item as $key=>$value){
				  if($key=='cantidad'){
					  $numClientes+=$value;
				  }
			  }
		  }
		  
		  $total=0;
		  $contador=0;
		  ?>
		  <table style="width:200px; text-align:center; border:1px solid silver">
			  <tr>
			      <td align="center" >
			      <p class="titulos">Carrito de Compras</p>
			      <?
			      if($numClientes==1){
			      	$texto="Solicitante";
			      }else{
			      	$texto="Solicitantes";
			      }
			      ?>
			      <? echo $numClientes." ".$texto?> <a href="<? echo base_url()?>solicitantes/carrito_compras" title="Ver Detalles Carrito de Compra"><img width="22" src="<? echo base_url()?>public/images/carrito.jpg" border="0"></a>';
			      
			      <table>
			      		<tr style="border-top:1px solid silver; border-radius:3px">
			      			<td><strong>Solicitante</strong></td>
			      			<td><strong>Quitar</strong></td>
			      		</tr>
					  <?
				      foreach($_SESSION['carrito'] as $item){
					    $contador++;
					  	ksort($item);//ordenamiento del arreglo
					  	?>
							<tr>
							<?
							  foreach($item as $indice=>$valor){	   
								  if($indice=="cliente"){
									  echo '<td style="width:162px; ">'.$valor.'</td>';
								  }
								  if($indice=="idCliente"){
								  	$itemDelete=$valor;
								  }
								  if($indice=="costo"){
							          $total+=$valor;
								  } 
							   }
							?>
								<td style="display:inline-block; width:20px; "><a href="javascript:void(0);" title="Quitar Cliente de Carrito" onclick="delete_item_carrito('<? echo base_url()?>solicitantes/delete_item_carrito', '<? echo $itemDelete ?>');"><img src="<? echo base_url()?>public/images/delete.png"  border="0" width="18" height="18"></a></li>
							</tr>
					   <?
					   }
				   ?>
				 </table>
			  <div style="align:center; text-align:center;">
			  <b>Total : $<? echo $total?>.00</b>
			  <br>
			  <a href="<? echo base_url()?>solicitantes/carrito_compras" title="Terminar Compra"><img src="<? echo base_url()?>public/images/compraTerminar.jpg" width="130" border="0"></a>
			  </div>
			<?
			}
			else
			{
			?>
			  <table style="width:200px; text-align:center; border:1px solid silver">
			  <tr>
			      <td align="center">
			      <p class="titulos">Carrito de Compras</p>
			      Vacio <img width="22" src="<? echo base_url()?>public/images/carrito.jpg" border="0">
			     
				  
				  </td>
			  </tr>
			  </table>
			<?
			}
			?>
			</td>
			</tr>
			</table>
			<?
	}



	
}
?>