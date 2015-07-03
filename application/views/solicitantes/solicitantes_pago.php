<?
echo $this->session->flashdata('message_paypal');
if(!empty($paginacionPago)){
	$numRegistrosPago=$this->solicitantes_model->get_solicitantes_propiedades($status="Pagado", null);	 
	// paginacion de resultados 
	$this->paginador->paginacion_enlaces(count($numRegistrosPago));
	if(isset($_POST["pagcp"])){
		$this->paginador->inicio_limite_paginacion($_POST["pagcp"]);
	}else{
		$this->paginador->inicio_limite_paginacion($paginas=null);
	}
	$solicitantesPago=$this->solicitantes_model->get_solicitantes_propiedades_limite($status="Pagado", $this->paginador->configPaginador["limiteInicio"], null);
	$this->varsPaginacion["urlPago"]=base_url()."solicitantes/solicitantes_pago";
}
if(count($solicitantesPago)>0){
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
					echo count($numRegistrosPago)." Solicitantes Encontrados";
				}
				?>
			</li>
			<li>
				<?
				//mostramos el boton de primero y anterior si la pagina actual es >= a 2
				if($this->paginador->configPaginador["paginaActual"] >= 2){
					?>
					<!-- boton primero-->
					<a class="btn btn-primary fileupload-exists" title="Primero" onclick="solicitantes_paginacion_ajax('<?php echo $this->varsPaginacion["urlPago"]?>',1,'divSolicitantesPago');" href="javascript:void(0);"><<</a>
					<!-- boton anterior-->
					<a class="btn btn-primary fileupload-exists" title="Anterior" onclick="solicitantes_paginacion_ajax('<?php echo $this->varsPaginacion["urlPago"]?>',<? echo $this->paginador->configPaginador["paginaActual"]-1 ?>,'divSolicitantesPago');" href="javascript:void(0);"><</a>
					<?
				}
				for($i=0; $i< count($rangos); $i++){
					if($rangos[$i]==$this->paginador->configPaginador["paginaActual"]){
						echo "<b>".$rangos[$i]."</b>";
					}
					else{
						?>
						<a class="btn btn-primary fileupload-exists" title="Pagina <? echo $rangos[$i]?>" onclick="solicitantes_paginacion_ajax('<?php echo $this->varsPaginacion["urlPago"]?>',<?php echo $rangos[$i]?>,'divSolicitantesPago');" href="javascript:void(0);"><?php echo $rangos[$i];?></a>
						<?php
					}
				}
				//mostramos el boton de siguiente y ultimo si el numero total de paginas es > a 2
				if($this->paginador->configPaginador["paginas"] > 2){
					//boton siguiente
					if($this->paginador->configPaginador["paginas"] > $this->paginador->configPaginador["paginaActual"] ){
						?>
						<a class="btn btn-primary fileupload-exists" title="Siguiente" onclick="solicitantes_paginacion_ajax('<?php echo $this->varsPaginacion["urlPago"]?>',<?php echo $this->paginador->configPaginador["paginaActual"]+1;?>,'divSolicitantesPago');" href="javascript:void(0);">></a>
						<!-- boton ultimo-->
						<a class="btn btn-primary fileupload-exists" title="Ultimo" onclick="solicitantes_paginacion_ajax('<?php echo $this->varsPaginacion["urlPago"]?>',<?php echo $this->paginador->configPaginador["paginas"];?>,'divSolicitantesPago');" href="javascript:void(0);">>></a>
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
				<th>Solicitante</th>
				<th>Email</th>
				<th>Telefono</th>
				<th>Fecha Compra</th>
				<th>Valor Prop.</th> 	
				<th>Foto</th>
				<th></th>
			</tr>
		</thead>
		<?php

			foreach ($solicitantesPago as $value) {
				$imgPrincipal=$this->propiedades_model->get_foto_principal_no_principal_propiedades($value->id_propiedad, "thumb");
				$nombrePropiedad=$this->propiedades_model->get_tipo_propiedad_por_id($value->id_categoria);
			?>
			<tr class="resalta">
				<td><?php echo $value->cliente;?></td>
				<td><?php echo $value->correo;?></td>
				<td><?php echo $value->telefono;?></td>
				<td><?php echo $value->fecha_pago;?></td>
				<td>$<?php echo number_format($value->precio);?></td>
				<td><a target="_blank" title="Ir a la Propiedad" href="<?php echo base_url()."propiedades/index/".$nombrePropiedad->nombre."/".$this->propiedades_model->texto_con_guion($value->propiedad)."/".$value->id_propiedad;?>"><img style="width:75px; height:65px;" src="<?php echo base_url().$imgPrincipal?>"></a></td>
			</tr>
		<?php
		}
		?>
	</table>
	<?
	}else{
		echo "<p>No existen solicitantes aun</p>";
}
?>