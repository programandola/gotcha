<?
	if(count($anunciantes)>0){
		switch ($this->varsPaginacion["pagination"]) {
			case 'index':
				$this->load->view("anunciantes/paginacionIndex.php");
				break;
			case 'nombre':
				$this->load->view("anunciantes/paginacionNombre.php");
				break;
			case 'fecha':
				$this->load->view("anunciantes/paginacionFecha.php");
				break;
			case 'estado':
				$this->load->view("anunciantes/paginacionEstado.php");
				break;
		}
		
?>
		<table class="tablaAnunciantes">
			<thead>
				<tr align="center">
					<th>Id</th>
					<th>Anunciante</th>
					<th>Empresa</th>
					<th>Correo</th>
					<th>Ciudad/Estado</th>
					<th>Teléfono</th>
					<th>Fecha Registro</th>
					<th>On/Off</th>
					<th><img src="<? echo base_url()?>public/images/remove.png"></th>
				</tr>
			</thead>
			<?
			foreach($anunciantes as $result){
				$estado=$this->propiedades_model->get_estado_por_id($result->id_estado);
				if($result->id_anunciantes_tipo == 1){
					$empresa="";
				}else{
					$anunciantes_tipo=$this->anunciantes_model->get_empresa_anunciantes_tipo_por_id_usuario($result->id_usuario);
					$empresa=$anunciantes_tipo->nombre_empresa;
					
				}
				?>
				<tr class="resalta">
					<td><? echo $result->id_usuario ?></td>
					<td><? echo $result->nombre." ".$result->apellidos ?></td>
					<td><? echo $empresa ?></td>
					<td><? echo $result->correo ?></td>
					<td><? echo $estado->nombre ?></td>
					<td><? echo $result->telefono ?></td>
					<td><? echo $result->fecha_registro ?></td>
					<?
					//activar desactivar anunciante
					if($result->status == 1){
					?>
						<td>
							<ul class="ulOnOff">
								<li>On</li>
								<li><a href="javascript:void(0);" onclick="ajax_anunciantes('<? echo base_url()?>anunciantes/desactivar/<? echo $result->id_usuario?>','','')" class="on" title="Desactivar Anunciante">Off</a></li>
							</ul>
						</td>
					<?
					}else{
						?>
						<td>
							<ul class="ulOnOff">
								<li><a href="javascript:void(0);" onclick="ajax_anunciantes('<? echo base_url()?>anunciantes/activar/<? echo $result->id_usuario?>','','')" class="on" title="Activar Anunciante">On</a></li>
								<li>Off</li>
							</ul>
						</td>
					<?
					}
					?>
					<td><a href="javascript:void(0);" onclick="elimina_anunciante('<? echo base_url()?>anunciantes/eliminar_anunciante', <? echo $result->id_usuario ?>);" title="Eliminar Anunciante"><img src="<? echo base_url()?>public/images/eliminar.gif"></a></td>
				</tr>
				<?php
			}
			?>
		</table>
	<?
	}else{
		echo "<h2>No Se Encontraron Resultados</h2>";
		?>
		<a href="<? echo base_url()?>anunciantes"><< Regresar</a>
		<?
	}
?>