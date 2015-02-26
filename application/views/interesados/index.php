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

							<!-- VISTA DEL BACKEND - INTERESADOS -->
							<div id="divContentPanelPrincipal">
								<div id="divContentPanel">
									<!-- Lista Interesados -->
									<h1 class="big_title">Solicitantes</h1>
									
									<div id="divInteresadosSearch">								
										<br>
										<p><select id="selectBuscar" style="width:130px">
														<option value="">Buscar por:</option>
														<option value="Nombre">Solicitante</option>
														<option value="Propiedad">ID Propiedad</option>
														<option value="Fecha">Fecha</option>
													</select>	
										</p>
										<div id="busquedaNombre" style="display:none; width:320px">
										<table>
											<tr>
												<td>Solicitante:</td>
												<td><input style="width:200px" type="text" name="nombreInteresado" id="nombreInteresado"></td>
												<td><a href="javascript:void(0);" onclick="busquedas_backend('<? echo base_url()?>interesados/buscar_interesado_nombre','nombreInteresado')" class="btn btn-primary fileupload-exists">Buscar</a></td>
											</tr>
										</table>
										</div>
										<div id="busquedaPropiedad" style="display:none; width:320px;">
										<table>
											<tr>
												<td>ID Propiedad:</td>
												<td><input type="text" id="propiedad" name="propiedad"></td>
												<td><a href="javascript:void(0);" onclick="busquedas_backend('<? echo base_url()?>interesados/buscar_interesado_propiedad','propiedadInteresado')" class="btn btn-primary fileupload-exists">Buscar</a></td>
											</tr>
										</table>
										</div>
										<div id="busquedaFecha" style="display:none; width:320px;">
										<table>
											<tr>
												<td>De:</td>
												<td><input style="width:200px" type="date" name="fechaInteresadosDe" id="fechaInteresadosDe"></td>
											</tr>
											<tr>
												<td>A:</td>
												<td><input style="width:200px" type="date" name="fechaInteresadosA" id="fechaInteresadosA"></td>
												<td><a href="javascript:void(0);" onclick="busquedas_backend('<? echo base_url()?>interesados/buscar_interesado_fecha','fechaInteresado')" class="btn btn-primary fileupload-exists">Buscar</a></td>
											</tr>
										</table>
										</div>	
									</div>
									<div id="divResultAjaxInteresados">
										<?php
										$this->load->view('interesados/interesados.php');
										?>
									</div>
								</div>
								<aside>
									<? $this->load->view('aside.php'); ?>
								</aside>
							</div>
							<!--END VISTA BACKEND INTERESADOS-->

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

	