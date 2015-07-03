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

							<!-- VISTA DEL BACKEND ADD DEPOSITO CLIENTES SIN PAGAR -->
							<div id="divContentPanelPrincipal">
								<div id="divContentPanel">
									<h1>Agregar Pago Ficha de Depósito</h1>
									<a href="<? echo base_url()?>deposito"><< Regresar</a>
									<br><br>
								    <div class="clr"></div>
								    <h2>Datos Solicitante</h2>
								    <table style="width:400px; border:1px solid silver">
								    	<tr style="border-bottom:1px dashed silver">
							    			<td style="width:120px; background-color:#E6E6E6; font-weight:bold">ID Propiedad</td>
								    		<td style="width:200px; background-color:#F2F2F2"><? echo $solicitante->id_propiedad ?></td>
								    	</tr>
								    	<tr style="border-bottom:1px dashed silver">
								    		<td style="width:120px; background-color:#E6E6E6; font-weight:bold">Solicitante</td>
								    		<td style="width:200px; background-color:#F2F2F2"><? echo $solicitante->cliente ?></td>
								    	</tr>
								    	<tr style="border-bottom:1px dashed silver">
								    		<td style="width:120px; background-color:#E6E6E6; font-weight:bold">Costo Compra</td>
								    		<td style="width:200px; background-color:#F2F2F2"><? echo $costoTransaccion->costo ?></td>
								    	</tr>
								    </table>
									<div id="divResultAjaxPagoDeposito"></div>
									<div>
										<ul style="width:170px;">
											<li>Selecciona Fecha de Pago: <input type="date" id="fechaPagoDeposito"></li>
											<li>Selecciona Método de Pago: 
												<select id="comboFichaDeposito">
													<option value="">Selecciona</option>
													<option value="2">Depósito ó Transferencia en ScotiaBank</option>
												</select>
											</li>
											<li><br></li>
											<li><input id="btnAddDeposito" onclick="add_deposito('<? echo base_url()?>deposito/add_deposito',<? echo $solicitante->id?>);" type="button" class="btn btn-primary fileupload-exists" value="Actualizar Pago"></li>
										</ul>
									</div>
								</div>
							</div>
							<br><br>
							<!--END VISTA BACKEND ADD DEPOSITO CLIENTES SIN PAGAR-->
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

	