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

							<!-- VISTA DEL BACKEND DE FICHA DE DEPOSITO CLIENTES SIN PAGAR -->
							<div id="divContentPanelPrincipal">
								<div id="divContentPanel">
									<h1>Ficha de Depósito</h1>
									<br>
									<div id="divDepositoSearch">								
										<br>
										<p><select id="selectBuscar" style="width:130px">
												<option value="">Buscar por:</option>
												<option value="Nombre">Solicitante</option>
												<option value="Anunciante">Anunciante</option>
												<option value="Propiedad">ID Propiedad</option>
												<option value="Fecha">Fecha</option>
											</select>	
										</p>
										<div id="busquedaNombre" style="display:none; width:320px">
											<table>
												<tr>
													<td>Solicitante:</td>
													<td><input style="width:200px" type="text" name="nombreInteresado" id="nombreInteresado"></td>
													<td><a href="javascript:void(0);" onclick="busquedas_backend('<? echo base_url()?>deposito/solicitantes_sin_pago_nombre','nombreInteresado')" class="btn btn-primary fileupload-exists">Buscar</a></td>
												</tr>
											</table>
										</div>
										<div id="busquedaAnunciante" style="display:none; width:320px">
											<table>
												<tr>
													<td>Anunciante:</td>
													<td><input style="width:200px" type="text" name="nombreAnuncianteDeposito" id="nombreAnuncianteDeposito"></td>
													<td><a href="javascript:void(0);" onclick="busquedas_backend('<? echo base_url()?>deposito/solicitantes_sin_pago_nombre_anunciante','nombreAnuncianteDeposito')" class="btn btn-primary fileupload-exists">Buscar</a></td>
												</tr>
											</table>
										</div>
										<div id="busquedaPropiedad" style="display:none; width:320px;">
											<table>
												<tr>
													<td>ID Propiedad:</td>
													<td><input type="text" id="id_propiedad" name="id_propiedad"></td>
													<td><a href="javascript:void(0);" onclick="busquedas_backend('<? echo base_url()?>deposito/solicitantes_sin_pago_id_propiedad','IdPropiedadInteresado')" class="btn btn-primary fileupload-exists">Buscar</a></td>
												</tr>
											</table>
										</div>
										<div id="busquedaNombrePropiedad" style="display:none; width:320px;">
											<table>
												<tr>
													<td>Propiedad:</td>
													<td><input type="text" id="propiedad" name="propiedad"></td>
													<td><a href="javascript:void(0);" onclick="busquedas_backend('<? echo base_url()?>deposito/solicitantes_sin_pago_propiedad','propiedadInteresado')" class="btn btn-primary fileupload-exists">Buscar</a></td>
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
													<td><a href="javascript:void(0);" onclick="busquedas_backend('<? echo base_url()?>deposito/solicitantes_sin_pago_fecha','fechaInteresado')" class="btn btn-primary fileupload-exists">Buscar</a></td>
												</tr>
											</table>
										</div>	
									    <div class="clr"></div>
										<!--begin divResultAjaxInteresados-->
										<div id="divResultAjaxInteresados">
											<?php
												$this->load->view("deposito/deposito.php");
											?>	
										</div>
									</div>
								</div>
							</div>
							<!--END VISTA BACKEND DEPOSITO CLIENTES SIN PAGAR-->
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

	