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
				echo count($numRegistros)." Solicitantes Encontrados";
			}
			?>
		</li>
		<li>
			<?
			//mostramos el boton de primero y anterior si la pagina actual es >= a 2
			if($this->paginador->configPaginador["paginaActual"] >= 2){
				?>
				<!-- boton primero-->
				<a class="btn btn-primary fileupload-exists" title="Primero" href="<? echo $this->varsPaginacion["url"]?>?pag=1"><<</a>
				<!-- boton anterior-->
				<a class="btn btn-primary fileupload-exists" title="Anterior" href="<? echo $this->varsPaginacion["url"]?>?pag=<? echo $this->paginador->configPaginador["paginaActual"]-1 ?>"><</a>
				<?
			}
			for($i=0; $i< count($rangos); $i++){
				if($rangos[$i]==$this->paginador->configPaginador["paginaActual"]){
					echo "<b>".$rangos[$i]."</b>";
				}
				else{
					?>
					<a class="btn btn-primary fileupload-exists" title="Pagina <? echo $rangos[$i]?>" href="<?php echo $this->varsPaginacion["url"]."?pag=".$rangos[$i]?>"><? echo $rangos[$i]; ?></a>
					<?php
				}
			}
			//mostramos el boton de siguiente y ultimo si el numero total de paginas es > a 2
			if($this->paginador->configPaginador["paginas"] > 2){
				//boton siguiente
				if($this->paginador->configPaginador["paginas"] > $this->paginador->configPaginador["paginaActual"] ){
					?>
					<a class="btn btn-primary fileupload-exists" title="Siguiente" href="<?php echo $this->varsPaginacion["url"]."?pag=".$this->paginador->configPaginador["paginaActual"]+1;?>">></a>
					<!-- boton ultimo-->
					<a class="btn btn-primary fileupload-exists" title="Ultimo" href="<?php echo $this->varsPaginacion["url"]."?pag=".$this->paginador->configPaginador["paginas"];?>">>></a>
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