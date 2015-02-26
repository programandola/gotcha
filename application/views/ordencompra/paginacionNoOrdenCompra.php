<?
//paginacion de resultados
if($this->paginador->configPaginador["paginas"] > 1){
	?>
	<!--begin ul paginacion-->
	<ul id="ulRangosPaginacion" >
		<?
		//para los rangos de la paginación
		$rangos=$this->paginador->rango_paginacion(10, $this->paginador->configPaginador["paginas"], $this->paginador->configPaginador["paginaActual"]);
		?>
		<li>
			<?
			if(count($rangos)>0){
				echo count($numRegistros)." Registros Encontrados";
			}
			?>
		</li>
		<li>
			<?
			//mostramos el boton de primero y anterior si la pagina actual es >= a 2
			if($this->paginador->configPaginador["paginaActual"] >= 2){
				?>
				<!-- boton primero-->
				<a class="btn btn-primary fileupload-exists" title="Primero" onclick="paginacion_orden_compra('<? echo base_url() ?>ordencompra/no_orden_compra','idOrdenCompra','<? echo $this->varsPaginacion["idOrdenCompra"] ?>',1);" href="javascript:void(0);"><<</a>
				<!-- boton anterior-->
				<a class="btn btn-primary fileupload-exists" title="Anterior" onclick="paginacion_orden_compra('<? echo base_url() ?>ordencompra/no_orden_compra','idOrdenCompra','<? echo $this->varsPaginacion["idOrdenCompra"] ?>',<? echo $this->paginador->configPaginador["paginaActual"]-1 ?>);" href="javascript:void(0);"><</a>
				<?
			}
			for($i=0; $i< count($rangos); $i++){
				if($rangos[$i]==$this->paginador->configPaginador["paginaActual"]){
					echo "<b>".$rangos[$i]."</b>";
				}
				else{
					?>
					<a class="btn btn-primary fileupload-exists" title="Pagina <? echo $rangos[$i]?>" onclick="paginacion_orden_compra('<? echo base_url() ?>ordencompra/no_orden_compra','idOrdenCompra','<? echo $this->varsPaginacion["idOrdenCompra"] ?>',<? echo $rangos[$i] ?>);" href="javascript:void(0);"><? echo $rangos[$i]; ?></a>
					<?php
				}
			}
			//mostramos el boton de siguiente y ultimo si el numero total de paginas es > a 2
			if($this->paginador->configPaginador["paginas"] > 2){
				//boton siguiente
				if($this->paginador->configPaginador["paginas"] > $this->paginador->configPaginador["paginaActual"] ){
					?>
					<a class="btn btn-primary fileupload-exists" title="Siguiente" onclick="paginacion_orden_compra('<? echo base_url() ?>ordencompra/no_orden_compra','idOrdenCompra','<? echo $this->varsPaginacion["idOrdenCompra"] ?>',<? echo $this->paginador->configPaginador["paginaActual"]+1 ?>);" href="javascript:void(0);">></a>
					<!-- boton ultimo-->
					<a class="btn btn-primary fileupload-exists" title="Ultimo" onclick="paginacion_orden_compra('<? echo base_url() ?>ordencompra/no_orden_compra','idOrdenCompra','<? echo $this->varsPaginacion["idOrdenCompra"] ?>',<? echo $this->paginador->configPaginador["paginas"] ?>);" href="javascript:void(0);">>></a>
				<?
				}
			}
			?>
		</li>
	</ul>
	<!--end ul paginacion-->
	<?
}//end paginacion
?>