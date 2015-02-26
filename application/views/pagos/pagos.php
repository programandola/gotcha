<?
//paginaciones
if( count($datos) >0 ){
	switch ($this->varsPaginacion["controler"]) {
		case 'index':
			$this->load->view('pagos/paginacionPrincipal.php');
			break;
		case 'nombre':
			$this->load->view('pagos/paginacionPaypalNombre.php');
			break;
		case 'fecha':
			$this->load->view('pagos/paginacionPaypalFecha.php');
			break;
		case 'idpropiedad':
			$this->load->view('pagos/paginacionidPropiedadPaypal.php');
			break;
		case 'solicitante':
			$this->load->view('pagos/paginacionPaypalSolicitante.php');
			break;
	}

?>
		<table class="tabla">
			<thead>
				<tr align="center">
					<th>Fecha Solicitud</th>
					<th>Fecha Pago</th>
					<th>ID Prop.</th>
					<th>ID Solic.</th>
					<th>Solicitante</th>
					<th>Anunciante</th>
					<th>Tipo Pago</th>
					<th>Status Pago</th>
					<th>Monto</th>
				</tr>
			</thead>
			<?
			foreach($datos as $result){
				$costoTransaccion=$this->propiedades_model->get_costo_transaccion_paypal_por_id_categoria($result->id_categoria);
				
				$solicitante=$this->solicitantes_model->get_solicitante_por_id($result->id_solicitante);
				?>
					<tr class="resalta" >
						<td><? echo $result->fecha_registro ?></td>
						<td><? echo $result->fecha_pago ?></td>
						<td><? echo $result->id_propiedad ?></td>
						<td><? echo $result->id_solicitante ?></td>
						<td><? echo $solicitante->nombre ?></td>
						<td><? echo $result->nombre." ".$result->apellidos ?></td>
						<?
						if(!empty($result->id_metodos_de_pago)){
							$metodoPago=$this->solicitantes_model->get_metodo_pago_por_id($result->id_metodos_de_pago);
							echo "<td>".$metodoPago->tipo_pago."</td>";
						}else{
							echo "<td></td>";
						}
						if($result->status=="Pagado"){
							?>
							<td><img title="Pagado" src="<? echo base_url()?>public/images/palomita_verde.png"></td>
							<?
						}else{
							?>
							<td><img title="Sin Pago" src="<? echo base_url()?>public/images/fail.png"></td>
							<?
						}
						?>
						<td>$<? echo $costoTransaccion->costo ?></td>
					</tr>
			<?php
			}
			?>
		</table>
	<?
	}else{
		echo "<h2>No Se Encontraron Resultados</h2>";
		?>
		<a href="<? echo base_url()?>pagos"><< Regresar</a>
		<?
	}
	
?>