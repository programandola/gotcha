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
						echo count($numRegistros)." Anunciantes Encontrados";
					}
					?>
				</li>
				<li>
					<?
					//mostramos el boton de primero y anterior si la pagina actual es >= a 2
					if($this->paginador->configPaginador["paginaActual"] >= 2){
						?>
						<!-- boton primero-->
						<a class="btn btn-primary fileupload-exists" title="Primero" href="javascript:void(0);" onclick="ajax_interesados_fecha('<? echo $this->varsPaginacion["url"]?>','<? echo $this->varsPaginacion["fechaDe"] ?>','<? echo $this->varsPaginacion["fechaA"] ?>',1);"><<</a>
						<!-- boton anterior-->
						<a class="btn btn-primary fileupload-exists" title="Anterior" href="javascript:void(0);" onclick="ajax_interesados_fecha('<? echo $this->varsPaginacion["url"]?>','<? echo $this->varsPaginacion["fechaDe"] ?>','<? echo $this->varsPaginacion["fechaA"] ?>', <? echo $this->paginador->configPaginador["paginaActual"]-1?>);"><</a>
						<?
					}
					for($i=0; $i< count($rangos); $i++){
						if($rangos[$i]==$this->paginador->configPaginador["paginaActual"]){
							echo "<b>".$rangos[$i]."</b>";
						}
						else{
							?>
							<a class="btn btn-primary fileupload-exists" title="Pagina <? echo $rangos[$i]?>" href="javascript:void(0);" onclick="ajax_interesados_fecha('<? echo $this->varsPaginacion["url"]?>','<? echo $this->varsPaginacion["fechaDe"] ?>','<? echo $this->varsPaginacion["fechaA"] ?>', <?php echo $rangos[$i];?>);"><?php echo $rangos[$i];?></a>
							<?php
						}
					}
						//mostramos el boton de siguiente y ultimo si el numero total de paginas es > a 2
						if($this->paginador->configPaginador["paginas"] > 2){
							//boton siguiente
							if($this->paginador->configPaginador["paginas"] > $this->paginador->configPaginador["paginaActual"] ){
								?>
								<a class="btn btn-primary fileupload-exists" title="Siguiente" href="javascript:void(0);" onclick="ajax_interesados_fecha('<? echo $this->varsPaginacion["url"]?>','<? echo $this->varsPaginacion["fechaDe"] ?>','<? echo $this->varsPaginacion["fechaA"] ?>', <?php echo $this->paginador->configPaginador["paginaActual"]+1?>);">></a>
								<!-- boton ultimo-->
								<a class="btn btn-primary fileupload-exists" title="Ultimo" onclick="ajax_interesados_fecha('<? echo $this->varsPaginacion["url"]?>','<? echo $this->varsPaginacion["fechaDe"] ?>','<? echo $this->varsPaginacion["fechaA"] ?>', <?php echo $this->paginador->configPaginador["paginas"]?>);">>></a>
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