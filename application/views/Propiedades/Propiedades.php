<?
	if(count($propiedades)>0){
		switch ($this->varsPaginacion["pagination"]) {
			case 'index':
				$this->load->view("Propiedades/paginacionIndex.php");
				break;
			case 'id_propiedad':
				$this->load->view("Propiedades/paginacionIdPropiedad.php");
				break;
			case 'anunciante':
				$this->load->view("Propiedades/paginacionAnunciante.php");
				break;
			case 'titulo':
				$this->load->view("Propiedades/paginacionTitulo.php");
				break;
			case 'estado':
				$this->load->view("Propiedades/paginacionEstado.php");
				break;
			case 'delegacion':
				$this->load->view("Propiedades/paginacionDelegacion.php");
				break;
			case 'colonia':
				$this->load->view("Propiedades/paginacionColonia.php");
				break;
			case 'fecha':
				$this->load->view("Propiedades/paginacionFecha.php");
				break;
		}
		
?>
		<table class="tablaAnunciantes" style="font-size:12px">
			<thead>
				<tr align="center">
					<th>Id Prop.</th>
					<th>Anunciante</th>
					<th>Titulo</th>
					<th>Dirección</th>
					<th>Estado/Municipio/Colonia</th>
					<th>Fecha</th>
					<th></th>
				</tr>
			</thead>
			<?
			foreach($propiedades as $result){
				$estado=$this->propiedades_model->get_estado_por_id($result->id_estado);
				$delegacion=$this->propiedades_model->get_delegacion_por_id($result->id_delegaciones);
				$colonia=$this->propiedades_model->get_colonia_por_id($result->id_colonias);
				$imgPrincipal=$this->propiedades_model->get_foto_principal_no_principal_propiedades($result->id_propiedad, "thumb");
				$tipoPropiedad=$this->propiedades_model->get_tipo_propiedad_por_id($result->id_categoria);
				$anunciante=$this->usuarios_model->get_user_por_id($result->id_usuario);
				
				?>
				<tr class="resalta">
					<td><? echo $result->id_propiedad ?></td>
					<? 
					if(!empty($anunciante)){
						echo "<td>".$anunciante->nombre." ".$anunciante->apellidos."</td>";
					}else{
						echo "<td></td>";
					} 
					?>
					<td><? echo $result->propiedad ?></td>
					<td><? echo $result->direccion ?></td>
					<td style="font-size:11px"><? echo $estado->nombre."/".$delegacion->nombre."/".$colonia->nombre?></td>
					<td><? echo $result->fecha_republicacion ?></td>
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
		<a href="<? echo base_url()?>Propiedades"><< Regresar</a>
		<?
	}
?>