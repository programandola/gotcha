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

							<!-- VISTA DEL BACKEND DEL USUARIO ANUNCIANTE Y CLIENTE - PUBLICAR ANUNCIO -->
							<div id="divContentPanelPrincipal">
								<div id="divContentPanel">
									<!-- Formulario Publicar Anuncio -->
									<h1 class="big_title">Publicar Anuncio</h1>
									<!-- BOTONES PARA LOS TABS -->
									<div id="divBtnTabs">
										<ul>
											<li>Ingresar Datos Anuncio</li>
											<li class="liTabsLink">Sube Fotos a tu Anuncio</li>
										</ul>
									</div>
									<div id="divContentTabs">
										<p>Los campos marcados con * son obligatorios</p>
										<div class="divResultAjaxAnunciar" id="divResultAjaxAnunciar"></div>
										<form id="property_submit_form" method="post">
											<label for="title">Título *</label>
											<input type="text" id="title" name="title" class="form-control" placeholder="Título">	
											<div class="clearfix"></div>
											<div class="third"> 
												<label>Precio *</label>
		                                                <div class="input-group">
		                                                    <span class="input-group-addon">$</span>
		                                                    <input type="text" class="formcell" id="precio" name="precio" onkeypress="solo_numeros()">
		                                                    <span class="input-group-addon">MXN</span>
		                                                </div>
											</div>
											<div class="third"> 
		                                    <label for="tipo">Tipo *</label>
		                                        <select id="selectOperacion" name="selectOperacion">
		                                        	<option value="">Seleccionar</option>
													<option value="Venta">Venta</option>
													<option value="Renta">Renta</option>
		                                        </select>
											</div>
											<div class="third"> 
		                                    <label for="status">Propiedad *</label>
		                                        <select id="selectTipoPropiedad" name="selectTipoPropiedad">
		                                        	<option value="">Seleccionar</option>
		                                        	<?php
		                                        	foreach($tipoPropiedad as $tipo){
		                                        		?>
		                                        		<option value="<?php echo $tipo->id_categoria;?>"><?php echo $tipo->nombre;?></option>
		                                        		<?php
		                                        	}
		                                        	?>
		                                        </select>
											</div>
											
											<div class="clearfix"></div>
											<hr>									
											<div class="two"> 
		                                    <label for="type">Superficie de Terreno</label>
		                                        <input type="text" class="formcell" id="terreno" name="terreno" onpaste="return false" onkeypress="solo_numeros()">
												<span class="input-group-addon">m<sup>2</sup></span>
											</div>
											<div class="two"> 
		                                    <label for="type">Area Construida</label>
		                                        <input type="text" class="formcell" id="construido" name="construido" onpaste="return false" onkeypress="solo_numeros()">
												<span class="input-group-addon">m<sup>2</sup></span>
											</div>
											<div class="clearfix"></div>
											<div class="four"> 
		                                    <label for="type">Antigüedad</label>
		                                        <input type="text" class="formcell" id="antiguedad" name="antiguedad" onpaste="return false" onkeypress="solo_numeros();">
		                                        <span class="input-group-addon">años</span>
											</div>
											<div class="four"> 
		                                    <label for="type">Recamaras</label>
		                                        <input type="text" class="formcell" id="recamaras" name="recamaras" onpaste="return false" onkeypress="solo_numeros()">
											</div>
											<div class="four"> 
		                                    <label for="type">Baños</label>
		                                        <input type="text" class="formcell" id="banos" name="banos" onpaste="return false" onkeypress="solo_numeros()">
											</div>
											<div class="four"> 
		                                    <label for="type">Autos</label>
		                                        <input type="text" class="formcell" id="autos" name="autos" onpaste="return false" onkeypress="solo_numeros()">
											</div>
											<div class="clearfix"></div>
											<label for="description">Descripción *</label>
		                                 	<textarea class="form-control" maxlength="256" name="description" id="description" rows="6" placeholder="Agregue los detalles de su propiedad"></textarea>   
		                                 	<div id="longitud_textarea"></div> 
											<label for="address">Calle *</label>
		                                 	<input id="direccion" name="direccion" type="text" class="form-control" placeholder="Calle y Numero">
											<div class="third">
											<label for="status">Ciudad/Estado *</label>
		                                        <select name="selectEstadosPublicar" id="selectEstadosPublicar">
													<option value="">Seleccionar</option>
														<?php foreach($estados as $estado){?>
															<option value="<?php echo $estado->id_estado;?>"><?php echo $estado->nombre;?></option>
														<?php
															}
														?>
		                                        </select>
											</div>
											<div class="third">
											<label for="status">Del/Municipio *</label>
		                                        <select name="selectDelegacionesPublicar" id="selectDelegacionesPublicar">
		                                        </select>
											</div>
											<div class="third">
											<label for="status">Colonia *</label>
		                                        <select name="selectColoniasPublicar" id="selectColoniasPublicar">
		                                        </select>
											</div>
												
		                                      <div class="clearfix"></div>
											<input type="button" class="btn btn-primary" onclick="return publicar_anuncio('<? echo base_url() ?>anunciar/publicar_anuncio');" value="Guardar y Continuar">                  
										</form><!-- end form -->
										<!-- end Formulario Publicar Anuncio -->
									</div>
								</div>
								<aside>
									<? $this->load->view('aside.php'); ?>
								</aside>
							</div>
							<!--END VISTA PUBLICAR ANUNCUIO-->

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

	