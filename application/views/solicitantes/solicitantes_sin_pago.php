<?php
if(!empty($paginacionSinPago)){
	$numRegistros=$this->solicitantes_model->get_solicitantes_propiedades($status="Sin Pagar", null);
	// paginacion de resultados 
	$this->paginador->paginacion_enlaces(count($numRegistros));
	if(isset($_POST["pag"])){
		$this->paginador->inicio_limite_paginacion($_POST["pag"]);
	}else{
		$this->paginador->inicio_limite_paginacion($paginas=null);
	}
	$solicitantesSinPago=$this->solicitantes_model->get_solicitantes_propiedades_limite($status="Sin Pagar", $this->paginador->configPaginador["limiteInicio"], null);
	$this->varsPaginacion["urlSinPago"]=base_url()."solicitantes/solicitantes_sin_pago";

}
if(count($solicitantesSinPago)>0){
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
						echo count($numRegistros)." Solicitantes Encontrados";
					}
					?>
				</li>
				<li>
					<?
					//mostramos el boton de primero y anterior si la pagina actual es >= a 2
					if($this->paginador->configPaginador["paginaActual"] >= 2){
						?>
						<!-- boton primero-->
						<a class="btn btn-primary fileupload-exists" title="Primero" onclick="solicitantes_paginacion_ajax('<?php echo $this->varsPaginacion["urlSinPago"]?>',1,'divSolicitantesSinPago');" href="javascript:void(0);"><<</a>
						<!-- boton anterior-->
						<a class="btn btn-primary fileupload-exists" title="Anterior" onclick="solicitantes_paginacion_ajax('<?php echo $this->varsPaginacion["urlSinPago"]?>',<? echo $this->paginador->configPaginador["paginaActual"]-1 ?>,'divSolicitantesSinPago');" href="javascript:void(0);"><</a>
						<?
					}
					for($i=0; $i< count($rangos); $i++){
						if($rangos[$i]==$this->paginador->configPaginador["paginaActual"]){
							echo "<b>".$rangos[$i]."</b>";
						}
						else{
							?>
							<a class="btn btn-primary fileupload-exists" title="Pagina <? echo $rangos[$i]?>" onclick="solicitantes_paginacion_ajax('<?php echo $this->varsPaginacion["urlSinPago"]?>',<?php echo $rangos[$i]?>,'divSolicitantesSinPago');" href="javascript:void(0);"><?php echo $rangos[$i];?></a>
							<?php
						}
					}
					//mostramos el boton de siguiente y ultimo si el numero total de paginas es > a 2
					if($this->paginador->configPaginador["paginas"] > 2){
						//boton siguiente
						if($this->paginador->configPaginador["paginas"] > $this->paginador->configPaginador["paginaActual"] ){
							?>
							<a class="btn btn-primary fileupload-exists" title="Siguiente" onclick="solicitantes_paginacion_ajax('<?php echo $this->varsPaginacion["urlSinPago"]?>',<?php echo $this->paginador->configPaginador["paginaActual"]+1;?>,'divSolicitantesSinPago');" href="javascript:void(0);">></a>
							<!-- boton ultimo-->
							<a class="btn btn-primary fileupload-exists" title="Ultimo" onclick="solicitantes_paginacion_ajax('<?php echo $this->varsPaginacion["urlSinPago"]?>',<?php echo $this->paginador->configPaginador["paginas"];?>,'divSolicitantesSinPago');" href="javascript:void(0);">>></a>
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
	<table class="tabla">
		<thead>
			<tr align="center">
				<th>Propiedad</th>
				<th>Valor</th>
				<th>Solicitante</th>
				<th>Solicitado desde</th>
				<th>Compra Contacto</th>
				<th></th>
			</tr>
		</thead>
		<?php
		foreach ($solicitantesSinPago as $value) {
			$imgPrincipal=$this->propiedades_model->get_foto_principal_no_principal_propiedades($value->id_propiedad, "thumb");
			$nombrePropiedad=$this->propiedades_model->get_tipo_propiedad_por_id($value->id_categoria);
			$costoTransaccion=$this->propiedades_model->get_costos_transacciones_paypal_tipo_propiedad_por_id($value->id_categoria);
		?>
		<tr class="resalta">
			<td><a target="_blank" title="Ir a la Propiedad" href="<?php echo base_url()."propiedades/index/".$nombrePropiedad->nombre."/".$this->propiedades_model->texto_con_guion($value->propiedad)."/".$value->id_propiedad;?>"><img style="width:75px; height:65px;" src="<?php echo base_url().$imgPrincipal?>"></a></td>
			<td>$<?php echo number_format($value->precio);?></td>
			<td><?php echo $value->cliente;?></td>
			<td><?php echo $value->fecha_registro;?></td>
			<td>$<?php echo $costoTransaccion->costo;?></td>
			<td><a href="javascript:void(0);" title="Agregar Cliente al Carrito de Compras" onclick="add_item_carrito('<? echo base_url()?>solicitantes/add_item_carrito',<? echo $value->id?>,'<? echo $value->propiedad; ?>',<?php echo $costoTransaccion->costo;?>, '<?php echo $value->cliente;?>');"><img src="<? echo base_url()?>public/images/agregar-carrito-on.jpg"></a></td>
			
		</tr>
		<?php
		}
		?>
	</table>
	<?php
}else{
	echo "No existen solicitantes aun";
}
?>