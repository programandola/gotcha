<?php
if(count($solicitantesSinPago)>0){
	switch ($this->varsPaginacion["pagination"]) {
		case 'index':
			$this->load->view("deposito/paginacionIndex.php");
			break;
		case 'nombre':
			$this->load->view("deposito/paginacionNombre.php");
			break;
		case 'idPropiedad':
			$this->load->view("deposito/paginacionIdPropiedad.php");
			break;
		case 'propiedad':
			$this->load->view("deposito/paginacionPropiedad.php");
			break;
		case 'fecha':
			$this->load->view("deposito/paginacionFecha.php");
			break;
	}		
	?>
	<table class="tabla">
		<thead>
			<tr align="center">
				<th>ID Propiedad</th>
				<th>Propiedad</th>
				<th>Valor</th>
				<th>Solicitante</th>
				<th>Anunciante</th>
				<th>Solicitado desde</th>
				<th>Compra Contacto</th>
				<th>Ficha Depósito</th>
			</tr>
		</thead>
		<?php
		foreach ($solicitantesSinPago as $value) {
			$imgPrincipal=$this->propiedades_model->get_foto_principal_no_principal_propiedades($value->id_propiedad, "thumb");
			$nombrePropiedad=$this->propiedades_model->get_tipo_propiedad_por_id($value->id_categoria);
			$costoTransaccion=$this->propiedades_model->get_costos_transacciones_paypal_tipo_propiedad_por_id($value->id_categoria);
			$anunciante=$this->usuarios_model->get_user_por_id($value->id_usuario);
		?>
		<tr class="resalta">
			<td><?php echo $value->id_propiedad;?></td>
			<td><a target="_blank" title="Ir a la Propiedad" href="<?php echo base_url()."propiedades/index/".$nombrePropiedad->nombre."/".$this->propiedades_model->texto_con_guion($value->propiedad)."/".$value->id_propiedad;?>"><img style="width:75px; height:65px;" src="<?php echo base_url().$imgPrincipal?>"></a></td>
			<td>$<?php echo number_format($value->precio);?></td>
			<td><?php echo $value->cliente;?></td>
			<td><?php echo $anunciante->nombre;?></td>
			<td><?php echo $value->fecha_registro;?></td>
			<td>$<?php echo $costoTransaccion->costo;?></td>
			<td><a href="<? echo base_url()."deposito/confirm_deposito/".$value->id?>" style="text-transform:capitalize;" class="btn btn-primary fileupload-exists">Agregar Pago</a></td>
		</tr>
		<?php
		}
		?>
	</table>
	<?php
}else{
	echo "<h2>No se encontraron resultados</h2>";
	?>
	<br><a href="<? echo base_url()?>deposito"><< Regresar</a>
	<?
}
?>