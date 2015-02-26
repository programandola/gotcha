<div class="container">
<div id="header" class="clearfix">
	<div id="bannertop">
		<?
		// 1 se le pasa 1 al metodo para los banners del header 
		// 2 para los banners del aside ó laterales
		$banner=$this->propiedades_model->get_banner(1);
		?>
		<a target="_blank" title="<? echo $banner->titulo ?>" href="<? if(!empty($banner->url)){echo $banner->url;}else{ echo "javascript:void(0);"; } ?>"><img src="<? echo base_url().$banner->path_banner ?>" /></a>
	</div>
	<br>
	<div class="listing-search count-5 clearfix clear"><form method="get" action="./index_files/index.htm">
	<div class="form-inner"><!-- .listing-search-main -->


		<!-- .listing-search-property-type -->
		<div class="listing-search-field listing-search-field-taxonomy listing-search-field-location">
			<label>
				<select class="listing-search-location select" name="selectEstados" id="selectEstados">
					<option value="">Ciudad/Estado</option>

					<?php foreach($estados as $estado){
						?>
						<option value="<? echo $estado->id_estado ?>"><? echo $estado->nombre ?></option>
					<?php
					}
					?>
					
				</select>
			</label>
			<!-- .listing-search-location -->
	</div>
	<div class="listing-search-field listing-search-field-select listing-search-field-details_1">
		<label>
			<select class="listing-search-details_1 select" name="selectDelegaciones" id="selectDelegaciones">
				<option value="">Del/Municipio</option>
			</select>
		</label>
		<!-- .listing-search-details_1 -->
	
</div><!-- .listing-search-field .listing-search-field-details_1 -->
<div class="listing-search-field listing-search-field-select listing-search-field-details_2">
	<label>
		<select class="listing-search-details_2 select" name="selectColonias" id="selectColonias">
			<option value="">Colonia</option>
		</select>
	</label>
	<!-- .listing-search-details_2 -->
</div>
	<!-- .listing-search-field .listing-search-field-details_2 -->
<div class="listing-search-field listing-search-field-select listing-search-field-details_1">
		<input type="button" class="listing-search-submit btn btn-large btn-primary" name="btonSearch" id="btonSearch" onclick="buscar();" value="Buscar">
	</div>
</div><!-- .listing-search-details -->

	</div>
	
	</div><!-- .listing-search -->

	</div><!-- #header -->	</div><!-- .container -->