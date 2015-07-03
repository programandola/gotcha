<?php
if(count($datos)>0){
	switch ($this->varsPaginacion["pagination"]) {
		case 'index':
			$this->load->view("ordencompra/paginacionIndex.php");
			break;
		case 'no_orden_compra':
			$this->load->view("ordencompra/paginacionNoOrdenCompra.php");
			break;
		case 'anunciante':
			$this->load->view("ordencompra/paginacionAnunciante.php");
			break;
		case 'fecha':
			$this->load->view("ordencompra/paginacionFecha.php");
			break;
	}		
	?>
	<table class="tabla">
		<thead>
			<tr align="center">
				<th>No. Orden</th>
				<th>Solicitado desde</th>
				<th>Anunciante</th>
				<th></th>
			</tr>
		</thead>
		<?php
		foreach ($datos as $value) {
			//$imgPrincipal=$this->propiedades_model->get_foto_principal_no_principal_propiedades($value->id_propiedad, "thumb");
			//$nombrePropiedad=$this->propiedades_model->get_tipo_propiedad_por_id($value->id_categoria);
			//$costoTransaccion=$this->propiedades_model->get_costos_transacciones_paypal_tipo_propiedad_por_id($value->id_categoria);
			$anunciante=$this->usuarios_model->get_user_por_id($value->id_usuario);
		?>
		<tr class="resalta">
			<td><?php echo $value->id_orden_de_compra;?></td>
			<td><?php echo $value->fecha_registro;?></td>
			<td><?php echo $anunciante->nombre;?></td>
			<td><a href="<? echo base_url()."ordencompra/detalles_orden_compra/".$value->id_orden_de_compra?>" style="text-transform:capitalize;" class="btn btn-primary fileupload-exists">Detalles</a></td>
		</tr>
		<?php
		}
		?>
	</table>
	<?php
}else{
	echo "<h2>No se encontraron resultados</h2>";
	?>
	<br><a href="<? echo base_url()?>ordencompra"><< Regresar</a>
	<?
}
?>