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
						echo count($totalPropiedades)." Registros Encontrados";
					}
					?>
				</li>
				<li>
					<?
					//mostramos el boton de primero y anterior si la pagina actual es >= a 2
					if($this->paginador->configPaginador["paginaActual"] >= 2){
						?>
						<!-- boton primero-->
						<a class="btn btn-primary fileupload-exists" title="Primero" href="javascript:void(0);" onclick="ajax_propiedades('<? echo $this->varsPaginacion["url"]?>','<? echo $this->varsPaginacion["anunciante"] ?>', 1, 'anunciante')"><<</a>
						<!-- boton anterior-->
						<a class="btn btn-primary fileupload-exists" title="Anterior" onclick="ajax_propiedades('<? echo $this->varsPaginacion["url"]?>','<? echo $this->varsPaginacion["anunciante"] ?>','<? echo $this->paginador->configPaginador["paginaActual"]-1 ?>', 'anunciante')" href="javascript:void(0);"><</a>
						
						<?
					}
					for($i=0; $i< count($rangos); $i++){
						if($rangos[$i]==$this->paginador->configPaginador["paginaActual"]){
							echo "<b>".$rangos[$i]."</b>";
						}
						else{
							?>
							<a class="btn btn-primary fileupload-exists" title="Pagina <? echo $rangos[$i]?>" onclick="ajax_propiedades('<? echo $this->varsPaginacion["url"]?>','<? echo $this->varsPaginacion["anunciante"] ?>','<? echo $rangos[$i] ?>', 'anunciante')" href="javascript:void(0);"><?php echo $rangos[$i];?></a>
							<?php
						}
					}
					//mostramos el boton de siguiente y ultimo si el numero total de paginas es > a 2
					if($this->paginador->configPaginador["paginas"] >= 2){
						//boton siguiente
						if($this->paginador->configPaginador["paginas"] > $this->paginador->configPaginador["paginaActual"] ){
							?>
							<!--botin siguiente-->
							<a class="btn btn-primary fileupload-exists" title="Siguiente" onclick="ajax_propiedades('<? echo $this->varsPaginacion["url"]?>','<? echo $this->varsPaginacion["anunciante"] ?>','<? echo $this->paginador->configPaginador["paginaActual"]+1 ?>', 'anunciante')" href="javascript:void(0);">></a>
							<!-- boton ultimo-->
							<a class="btn btn-primary fileupload-exists" title="Ultimo" onclick="ajax_propiedades('<? echo $this->varsPaginacion["url"]?>','<? echo $this->varsPaginacion["anunciante"] ?>','<? echo $this->paginador->configPaginador["paginas"]?>', 'anunciante')" href="javascript:void(0);">>></a>
						<?
						}
					}
					?>
				</li>
			</ul>
			<!--end ul paginacion-->
			<?
		}
	?>
			