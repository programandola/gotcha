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

							<!-- VISTA DEL BACKEND DE ORDEN DE COMPRA-->
							<div id="divContentPanelPrincipal">
								<div id="divContentPanel">
									<h1>Orden de Compra</h1>
									<br>
									<?
									if(count($datos)>0){
										?>
										<div id="divDepositoSearch">								
											<br>
											<p><select id="selectBuscar" style="width:130px">
													<option value="">Buscar por:</option>
													<option value="Nombre">No. Orden</option>
													<option value="Anunciante">Anunciante</option>
													<option value="Fecha">Fecha</option>
												</select>	
											</p>
											<div id="busquedaNombre" style="display:none; width:320px">
												<table>
													<tr>
														<td>No. Orden:</td>
														<td><input style="width:200px" type="text" name="idOrdenNumero" id="idOrdenNumero"></td>
														<td><a href="javascript:void(0);" onclick="busquedas_backend('<? echo base_url()?>ordencompra/no_orden_compra','idOrdenNumero')" class="btn btn-primary fileupload-exists">Buscar</a></td>
													</tr>
												</table>
											</div>
											<div id="busquedaAnunciante" style="display:none; width:320px">
												<table>
													<tr>
														<td>Anunciante:</td>
														<td><input style="width:200px" type="text" name="nombreAnuncianteOrden" id="nombreAnuncianteOrden"></td>
														<td><a href="javascript:void(0);" onclick="busquedas_backend('<? echo base_url()?>ordencompra/orden_compra_anunciante','nombreAnuncianteOrden')" class="btn btn-primary fileupload-exists">Buscar</a></td>
													</tr>
												</table>
											</div>
											<div id="busquedaFecha" style="display:none; width:320px;">
												<table>
													<tr>
														<td>De:</td>
														<td><input style="width:200px" type="date" name="fechaOrdenDe" id="fechaOrdenDe"></td>
													</tr>
													<tr>
														<td>A:</td>
														<td><input style="width:200px" type="date" name="fechaOrdenA" id="fechaOrdenA"></td>
														<td><a href="javascript:void(0);" onclick="busquedas_backend('<? echo base_url()?>ordencompra/orden_compra_fecha','fechaOrden')" class="btn btn-primary fileupload-exists">Buscar</a></td>
													</tr>
												</table>
											</div>	
										    <div class="clr"></div>
											<!--begin divResultAjaxOrdenCompra-->
											<div id="divResultAjaxOrden">
												<?php
													$this->load->view("ordencompra/ordencompra.php");
												?>	
											</div>
										</div>
										<?
									}else{
										echo "<strong>No existen Registros</strong>";
									}								
									?>
								</div>
								<aside>
									<? $this->load->view('aside.php'); ?>
								</aside>
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

	