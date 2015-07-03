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

							<!-- VISTA DEL BACKEND - REPORTE PAYPAL -->
							<div id="divContentPanelPrincipal">
								<div id="divContentPanel">
									<h1 class="big_title">Pagos</h1>
									<div id="divLoading"></div>
									<div id="divPaypalSearch">
										<br>
										<p><select id="selectBuscar" style="width:130px">
												<option value="">Buscar por:</option>
												<option value="Nombre">Anunciante</option>
												<option value="Solicitante">Solicitante</option>
												<option value="FechaSolicitud">Fecha Solicitud</option>
												<option value="FechaPago">Fecha Pago</option>
												<option value="IdPropiedad">Id Propiedad</option>
											</select>	
										</p>
										<div id="busquedaNombre" style="display:none; width:320px">
											<table>
												<tr>
													<td>Anunciante:</td>
													<td><input style="width:200px" type="text" name="nombreAnunciante" id="nombreAnunciante"></td>
												</tr>
												<tr>
													<td colspan="2"><input type="radio" name="statusPago" id="statusPago" value="Pagado"> Pagados&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="statusPago" id="statusPago" value="Sin Pagar"> Sin Pagar</td>
												</tr>
												<tr>
													<td colspan="2"><a href="javascript:void(0);" onclick="busquedas_backend('<? echo base_url()?>pagos/get_paypal_anunciantes_nombre','paypalNombreAnunciante')" class="btn btn-primary fileupload-exists">Buscar</a></td>
												</tr>
											</table>
										</div>
										<div id="busquedaSolicitante" style="display:none; width:320px">
											<table>
												<tr>
													<td>Solicitante:</td>
													<td><input style="width:200px" type="text" name="nombreSolicitante" id="nombreSolicitante"></td>
												</tr>
												<tr>
													<td colspan="2"><input type="radio" name="statusPago" id="statusPago" value="Pagado"> Pagados&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="statusPago" id="statusPago" value="Sin Pagar"> Sin Pagar</td>
												</tr>
												<tr>
													<td colspan="2"><a href="javascript:void(0);" onclick="busquedas_backend('<? echo base_url()?>pagos/get_paypal_por_solicitante','paypalNombreSolicitante')" class="btn btn-primary fileupload-exists">Buscar</a></td>
												</tr>
											</table>
										</div>
										<div id="busquedaFechaSolicitud" style="display:none; width:320px;">
											<p>Fecha Solicitud:</p>
											<table>
												<tr>
													<td>De:</td>
													<td><input style="width:200px" type="date" name="fechaSolicitudDe" id="fechaSolicitudDe"></td>
												</tr>
												<tr>
													<td>A:</td>
													<td><input style="width:200px" type="date" name="fechaSolicitudA" id="fechaSolicitudA"></td>
												</tr>
												<tr>
													<td colspan="2"><input type="radio" name="statusPago" id="statusPago" value="Pagado"> Pagados&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="statusPago" id="statusPago" value="Sin Pagar"> Sin Pagar</td>
												</tr>
												<tr>
													<td colspan="2"><a href="javascript:void(0);" onclick="busquedas_backend('<? echo base_url()?>pagos/get_paypal_anunciantes_fecha','paypalFechaSolicitud')" class="btn btn-primary fileupload-exists">Buscar</a></td>
												</tr>
											</table>
										</div>	
										<div id="busquedaFechaPago" style="display:none; width:320px;">
											<p>Fecha Pago:</p>
											<table>
												<tr>
													<td>De:</td>
													<td><input style="width:200px" type="date" name="fechaPagoDe" id="fechaPagoDe"></td>
												</tr>
												<tr>
													<td>A:</td>
													<td><input style="width:200px" type="date" name="fechaPagoA" id="fechaPagoA"></td>
												</tr>
												<tr>
													<td colspan="2"><a href="javascript:void(0);" onclick="busquedas_backend('<? echo base_url()?>pagos/get_paypal_anunciantes_fecha','paypalFechaPago')" class="btn btn-primary fileupload-exists">Buscar</a></td>
												</tr>
											</table>
										</div>	
										<div id="busquedaIdPropiedad" style="display:none; width:380px">
											<table>
												<tr>
													<td>Id Propiedad:</td>
													<td><input style="width:200px" type="text" name="idPropiedad" id="idPropiedad"></td>
													<td><a href="javascript:void(0);" onclick="busquedas_backend('<? echo base_url()?>pagos/get_paypal_anunciantes_id_propiedad','paypalIdPropiedad')" class="btn btn-primary fileupload-exists">Buscar</a></td>
												</tr>
											</table>
										</div>
									</div>
									<div id="divResultAjaxReportePaypal">
										<?php
										$this->load->view('pagos/pagos.php');
										?>
									</div>
								</div>
								<aside>
									<? $this->load->view('aside.php'); ?>
								</aside>
							</div>
							<!--END VISTA BACKEND REPORTE PAYPAL-->

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

	