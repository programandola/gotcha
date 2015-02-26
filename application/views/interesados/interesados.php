<?
	if( count($datos) >0 ){
		switch ($this->varsPaginacion["pagination"]) {
			case 'index':
				$this->load->view("interesados/paginacionIndex.php");
				break;
			case 'nombre':
				$this->load->view("interesados/paginacionNombre.php");
				break;
			case 'propiedad':
				$this->load->view("interesados/paginacionPropiedad.php");
				break;
			case 'fecha':
				$this->load->view("interesados/paginacionFecha.php");
				break;
		}
		
?>
		<table class="tablaAnunciantes">
			<thead>
				<tr align="center">
					<th>ID Solicitante</th>
					<th>ID Propiedad</th>
					<th>Solicitante</th>
					<th>Correo</th>
					<th>Teléfono</th>
					<th>Celular</th>
					<th>Fecha Solicitud</th>
					<th>Imagen</th>
				</tr>
			</thead>
			<?
				
				foreach($datos as $result){
					$imgPrincipal=$this->propiedades_model->get_foto_principal_no_principal_propiedades($result->id_propiedad, "thumb");
					$tipoPropiedad=$this->propiedades_model->get_tipo_propiedad_por_id($result->id_categoria);
				?>
					<tr class="resalta" >
						<td><? echo $result->id_solicitante ?></td>
						<td><? echo $result->id_propiedad ?></td>
						<td><? echo $result->cliente ?></td>
						<td><? echo $result->correo ?></td>
						<td><? echo $result->telefono ?></td>
						<td><? echo $result->celular ?></td>
						<td><? echo $result->fecha_registro ?></td>
						<td><a target="_blank" title="Ir a la Publicación" href="<?php echo base_url()."propiedades/index/".$tipoPropiedad->nombre."/".$this->propiedades_model->texto_con_guion($result->propiedad)."/".$result->id_propiedad;?>"><img style="width:75px; height:60px;" src="<? echo base_url().$imgPrincipal?>"></a></td>
					</tr>
				<?php
				}
			?>
		</table>
	<?
	}else{
		echo "<h2>No Se Encontraron Resultados</h2>";
		?>
		<a href="<? echo base_url()?>interesados"><< Regresar</a>
		<?
	}
?>