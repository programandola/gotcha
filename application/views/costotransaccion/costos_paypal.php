<p>Costos por Transacción (Tipo Propiedad) Paypal</p>
<?
	if( count($costos) >0 ){
		?>
		<table class="tabla">
			<thead>
				<tr align="center">
					<th>Id Tipo Propiedad</th>
					<th>Tipo Propiedad</th>
					<th>Costo Transacción</th>
					<th></th>
				</tr>
			</thead>
			<?
				foreach($costos as $result){
					$tipoPropiedad=$this->propiedades_model->get_tipo_propiedad_por_id($result->id_categoria);
				?>
					<tr class="resalta" >
						<td><? echo $result->id_categoria ?></td>
						<td><? echo $tipoPropiedad->nombre ?></td>
						<td><? echo $result->costo ?></td>
						<td><a href="javascript:void(0);" onclick="editar_costo_transaccion('<? echo base_url()?>costotransaccion/edita_costo_transaccion/<? echo $result->id_categoria ?>');" class="btn btn-primary fileupload-exists">Editar</a></td>
					</tr>
				<?php
				}
			?>
		</table>
	<?
	}else{
		echo "<h2>No existen Datos</h2>";
	}
?>