<body class="home blog boxed layout-three" style="">
	<?php
		$this->load->view('pop-ups.php');
	?>
		<div id="outer">
			<div id="container-wrap-header">
				<?php
					$this->load->view('headerAdmin.php');
				?>
			</div><!-- #container-wrap-header -->

			<div id="submenu-wrap" class="wrap">
				<?php
					$this->load->view('menuBackend.php');
				?>
			</div><!-- #submenu-wrap -->

	<div id="container-wrap-main">
		<div id="main-wrap" class="wrap">

			<div id="main-middle-wrap" class="wrap">
				<div class="container">

					<div id="main-middle" class="row">


					</div><!-- #main-middle -->	

				</div><!-- .container -->
			</div><!-- #main-middle-wrap -->

			<div id="main-bottom-wrap" class="wrap">
				<div class="container">

					<div id="main-bottom" class="clearfix">

						<div id="wpsight-latest-listings-2-wrap" class="widget-wrap widget-latest-wrap">

							<!-- VISTA DEL BACKEND DEL USUARIO ANUNCIANTE Y CLIENTE - EDITAR ANUNCIO -->
							<div id="divContentPanelPrincipal">
								<div id="divContentPanel">
									<!-- navegacion -->
									<a href="<?php echo base_url()?>misanuncios">Anuncios Publicados</a> > Editar Datos Anuncio
									<!-- Formulario Publicar Anuncio -->
									<!-- BOTONES PARA LOS TABS -->
									<div id="divBtnTabs">
										<ul>
											<li>Editar Datos Anuncio</li>
											<li class="liTabsLink"><a href="<?php echo base_url()?>anunciar/fotos_propiedades/<?php echo $propiedad->id_propiedad?>/<?php echo $propiedad->id_categoria?>">Sube Fotos a tu Anuncio</a></li>
										</ul>
									</div>
									<div id="divContentTabs">
										<p>Los campos marcados con * son obligatorios</p>
										<div id="divResultAjaxActualizaAnuncio"></div>
										<form id="formEditarAnuncio">
											<label for="title">Título *</label>
		                                 	<input type="text" id="title" name="title" class="form-control" placeholder="Título" value="<?php echo $propiedad->nombre?>">
											<div class="clearfix"></div>
											<div class="third"> 
												<label>Precio *</label>
		                                                <div class="input-group">
		                                                    <span class="input-group-addon">$</span>
		                                                    <input type="text" class="formcell" id="precio" name="precio" value="<?php echo $propiedad->precio?>" onkeypress="solo_numeros()">
		                                                    <span class="input-group-addon">MXN</span>
		                                                </div>
											</div>
											<div class="third"> 
		                                    <label for="tipo">Tipo *</label>
		                                        <select id="selectOperacion" name="selectOperacion">
		                                        	<?php
		                                        	if($propiedad->tipo_operacion=="Venta"){
		                                        		?>
		                                        		<option value="Venta" Selected>Venta</option>
		                                        		<option value="Renta">Renta</option>
		                                        		<?php
		                                        	}else
		                                        		if($propiedad->tipo_operacion=="Renta"){
		                                        			?>
			                                        		<option value="Venta">Venta</option>
			                                        		<option value="Renta" Selected>Renta</option>
			                                        		<?php
		                                        	}
		                                        	?>
													
		                                        </select>
											</div>
											<div class="third"> 
		                                    <label for="status">Propiedad * </label>
		                                        <select id="selectTipoPropiedad" name="selectTipoPropiedad">
		                                        	<option value="">Seleccionar</option>
		                                        	<?php
		                                        	foreach($tipoPropiedad as $tipo){
		                                        		if($tipo->id_categoria==$propiedad->id_categoria){
		                                        			?>
		                                        			<option value="<?php echo $tipo->id_categoria;?>" Selected><?php echo $tipo->nombre;?></option>
		                                        			<?php
		                                        		}
		                                        		else{
		                                        			?>
		                                        			<option value="<?php echo $tipo->id_categoria;?>"><?php echo $tipo->nombre;?></option>
		                                        			<?php
		                                        		}
		                                        	}
		                                        	?>
		                                        </select>
											</div>
											
											<div class="clearfix"></div>
											<hr>									
											<div class="two"> 
		                                    <label for="type">Superficie de Terreno</label>
		                                        <input type="text" class="formcell" id="terreno" name="terreno" value="<?php echo $propiedad->m2_terreno?>" onkeypress="solo_numeros()">
												<span class="input-group-addon">m<sup>2</sup></span>
											</div>
											<div class="two"> 
		                                    <label for="type">Area Construida</label>
		                                        <input type="text" class="formcell" id="construido" name="construido" value="<?php echo $propiedad->m2_construccion?>" onkeypress="solo_numeros()">
												<span class="input-group-addon">m<sup>2</sup></span>
											</div>
											<div class="clearfix"></div>
											<div class="four"> 
		                                    <label for="type">Antiguedad</label>
		                                        <input type="text" class="formcell" id="antiguedad" name="antiguedad" value="<?php echo $propiedad->antiguedad?>" onkeypress="solo_numeros()">
		                                        <span class="input-group-addon">años</span>
											</div>
											<div class="four"> 
		                                    <label for="type">Recamaras</label>
		                                        <input type="text" class="formcell" id="recamaras" name="recamaras" value="<?php echo $propiedad->num_recamaras?>" onkeypress="solo_numeros()">
											</div>
											<div class="four"> 
		                                    <label for="type">Baños</label>
		                                        <input type="text" class="formcell" id="banos" name="banos" value="<?php echo $propiedad->num_banos?>" onkeypress="solo_numeros()">
											</div>
											<div class="four"> 
		                                    <label for="type">Autos</label>
		                                        <input type="text" class="formcell" id="autos" name="autos" value="<?php echo $propiedad->num_autos?>" onkeypress="solo_numeros()">
											</div>
											<div class="clearfix"></div>
											<label for="description">Descripción *</label>
		                                 	<textarea class="form-control" name="description" id="description" rows="6" placeholder="Agregue los detalles de su propiedad"><?php echo $propiedad->descripcion?></textarea>    
											<label for="address">Dirección *</label>
		                                 	<input id="direccion" name="direccion" type="text" class="form-control" placeholder="Calle y Numero" value="<?php echo $propiedad->direccion?>">
											<div class="third">
											<label for="status">Ciudad/Estado *</label>
		                                        <select name="selectEstadosPublicar" id="selectEstadosPublicar">
		                                        	<option value="">Seleccionar</option>
														<?php foreach($estados as $estado){
																if($estado->id_estado==$propiedad->id_estado){
																	?>
																	<option value="<?php echo $estado->id_estado;?>" Selected><?php echo $estado->nombre;?></option>
																	<?php
																}
																else{
																	?>
																	<option value="<?php echo $estado->id_estado;?>"><?php echo $estado->nombre;?></option>
																	<?php
																}//end if
															  }//end foreach
														?>
		                                        </select>
											</div>
											<div class="third">
											<label for="status">Del/Municipio *</label>
		                                        <select name="selectDelegacionesPublicar" id="selectDelegacionesPublicar">
		                                        	<?php
		                                        	foreach ($delegaciones as $del) {
		                                        		if($del->id_delegaciones==$propiedad->id_delegaciones){
		                                        			?>
															<option value="<?php echo $del->id_delegaciones;?>" Selected><?php echo $del->nombre;?></option>
		                                        			<?php
		                                        		}else{
		                                        			?>
															<option value="<?php echo $del->id_delegaciones;?>"><?php echo $del->nombre;?></option>
		                                        			<?php
		                                        		}
		                                        	}
		                                        	?>
		                                        </select>
											</div>
											<div class="third">
											<label for="status">Colonia *</label>
		                                        <select name="selectColoniasPublicar" id="selectColoniasPublicar">
		                                        	<?php
		                                        	foreach ($colonias as $col) {
		                                        		if($col->id_colonias==$propiedad->id_colonias){
		                                        			?>
															<option value="<?php echo $col->id_colonias;?>" Selected><?php echo $col->nombre;?></option>
		                                        			<?php
		                                        		}else{
		                                        			?>
															<option value="<?php echo $col->id_colonias;?>"><?php echo $col->nombre;?></option>
		                                        			<?php
		                                        		}
		                                        	}
		                                        	?>
		                                        </select>
											</div>
												
		                                    <div class="clearfix"></div>
											<input type="hidden" id="idPropiedad" name="idPropiedad" value="<?php echo $propiedad->id_propiedad?>">
											<input type="button" class="btn btn-primary" value="Guardar Cambios" onclick="actualiza_anuncio('<?php echo base_url()?>misanuncios/actualiza_anuncio');">                  
										</form><!-- end form -->
										<!-- end Formulario Publicar Anuncio -->
									</div>
								</div>
								<aside>
									<? $this->load->view('aside.php'); ?>
								</aside>
							</div>
							<!--END VISTA EDITAR ANUNCUIO-->

							<div id="wpsight-latest-listings-2" class="widget widget-latest widget-latest-listings row">	


												
									</div><!-- .widget -->
								</div><!-- .widget-wrap -->		



							</div><!-- .widget-wrap -->	</div><!-- #main-bottom -->	</div><!-- .container -->
						</div><!-- #main-bottom-wrap -->

					</div><!-- #main-wrap -->

				</div><!-- #container-wrap-main -->

				<div id="footer-bottom-wrap" class="wrap">
					<?php
						$this->load->view('footer.php');
					?>
				</div><!-- #footer-bottom-wrap -->

			<div id="credit-wrap" class="wrap">
				<?php
					$this->load->view('credit.php');
				?>
			</div><!-- #credit-wrap -->
		</div><!-- #outer -->
	</body>

	