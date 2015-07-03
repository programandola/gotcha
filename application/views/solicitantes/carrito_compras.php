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

							<!-- VISTA DEL BACKEND DEL CARRITO DE COMPRAS  -->
							<div id="divContentPanelPrincipal">
								<div id="divContentPanel">
									<h1>Carrito de Compras</h1>
									<br><br>
									<div id="divLoading"></div>
									<div>
										<?
										if(!empty($_SESSION["carrito"])){
											?>
											<h3>1.- Detalle de tu Compra</h3>
											<table class="tabla">
												<thead>
													<tr align="center">
														<th>Id Solicitud</th>
														<th>Solicitante</th>
														<th>Propiedad</th>
														<th>Costo</th>
														<th><img src="<? echo base_url()?>public/images/remove.png"></th>
													</tr>
												</thead>
												<?
												$total=0;
												$ivaOrden=0;
												foreach ($_SESSION["carrito"] as $item) {
													?>
													<tr>
														<?
														
														foreach ($item as $key => $value) {
															if($key!="cantidad"){
																if($key=="costo"){
																	echo "<td>$".$value.".00</td>";
																	$total+=$value;
																}else{
																	echo "<td>".$value."</td>";
																}
															}
															if($key=="idCliente"){
																$item=$value;
															}
														}
													?>
													<td><a href="<? echo base_url()?>solicitantes/carrito_compras?item=<? echo $item ?>" title="Quitar Solicitante del Carrito"><img src="<? echo base_url()?>public/images/delete.png"  border="0" width="18" height="18"></a></td>
													</tr>
													<?
												}
												?>
											</table>
											<div style="float:right">
												<table style="background-color:#E6E6E6; width:300px; text-align:right">
													<tr style="text-weight:bold">
														<td><b>Total a Pagar:</b></td>
														<td><b>$<? echo $total?>.00</b></td>
													</tr>
												</table>
												<a class="btn btn-primary fileupload-exists" href="<? echo base_url()?>solicitantes/index/spago">Continuar Comprando</a>
											</div>
											<div style="float:left; width:100%">
												<h2>2.- Forma de Pago</h2>
												<select id="selectFormaPago" style="width:250px">
													<option value="">Selecciona Forma de Pago</option>
													<?
													$metodosPago=$this->solicitantes_model->get_all_metodos_de_pago();
													foreach ($metodosPago as $metodo) {
														if($metodo->id_metodos_de_pago==1){//paypal
															?>
															<option value="<? echo $metodo->id_metodos_de_pago ?>" selected><? echo $metodo->tipo_pago ?></option>
															<?
														}else{
															?>
															<option value="<? echo $metodo->id_metodos_de_pago ?>"><? echo $metodo->tipo_pago ?></option>
															<?
														}
													}
													?>
												</select>
											</div>
											<div id="divFormaPagoPaypal" style="float:left; padding:8px; width:70%; border:1px solid #F2F2F2">
												<img src="<? echo base_url()?>public/images/logo-paypal.png">
												<p>Te redireccionaremos a PayPal para que realices tu pago.</p>
												
												<p>Cuando el pago se haya efectuado de forma exitosa te redireccionaremos nuevamente a Clientes Comprados. Si por algún motivo PayPal no te redirecciona nuevamente, revisa tu correo a donde enviaremos los datos de los clientes que compraste.</p>
												<br>
												<!-- Pago de Paypal -->
											    <!--entornos producción https://www.paypal.com/cgi-bin/webscr-->
											    <!--entorno de pruebas https://www.sandbox.paypal.com/cgi-bin/webscr-->
												<!-- Pago de Paypal -->
												<form action="https://www.paypal.com/mx/cgi-bin/webscr" method="post">
													<input type="hidden" name="cmd" value="_cart">
													<input type="hidden" name="upload" value="1">
													<input type="hidden" name="business" value="mrgotcha@yahoo.com">
													<?
												  	$i=0;
												  	foreach ($_SESSION["carrito"] as $item) {
												  		$i++;
												  		foreach ($item as $key => $value) {
												  			if($key=="propiedad"){
												  				?>
												  				<input type="hidden" name="item_name_<? echo $i?>" value="<?php echo $value?>" />
												  				<?
												  			}
												  			if($key=="idCliente"){
												  				?>
												  				<input type="hidden" name="item_number_<? echo $i?>" value="<?php echo $value?>" />
												  				<?
												  			}
												  			if($key=="costo"){
												  				?>
												  				<input type="hidden" name="amount_<? echo $i?>" value="<?php echo $value?>" />
												  				<?
												  			}
												  			if($key=="cantidad"){
												  				?>
												  				<!--para pasar los datos de cada cliente en la variable custom-->
													  			<input type="hidden" name="quantity_<? echo $i?>" value="<? echo $value;?>">
												  			<?
												  			}		
												  		}
												  	}
												  	?>
												  	<input type="hidden" name="custom" value="<? echo count($_SESSION['carrito']); ?>">
													<input type="hidden" name="currency_code" value="MXN">
													<input type="hidden" name="no_shipping" value="1">
													<input type="hidden" name="lc" value="MX" />
													<input type="hidden" name="rm" value="2">
													<input type="hidden" name="return" value="http://interhabita.com/solicitantes/pago_correcto_paypapl"/>
													<input type="hidden" name="cancel_return" value = "http://interhabita.com/solicitantes/index/spago"/>
													<input type="image" style="width:146px; height:47px" target="_blank" src="<? echo base_url()?>public/images/btn_paypal.gif" name="submit" alt="Make payments with PayPal - it's fast, free and secure!" title="Make payments with PayPal - it's fast, free and secure!">
												</form>
											</div>
											<div id="divFormaPagoScotiaBank" style="display:none; float:left; padding:8px; width:70%; border:1px solid #F2F2F2">
												<img src="<? echo base_url()?>public/images/scotiabank_logo.gif">
												<br>
												<div style="display:inline-block; width:60%;">
													<br>
													<ul style="padding-left:30px; background-color:#F2F2F2">
														<li>SCOTIABANK</li>
														<li>TITULAR: JUAN MANUEL CHAIREZ</li>
														<li>CUENTA: 00101820067</li>
														<li>CLABE INTERBANCARIA: 044180001018200670</li>
													</ul>
												</div>
												<br><br>
												<p>Debes realizar las siguientes instrucciones:</p>
												<ul>
													<li>1.- Imprimir el Documento</li>
													<li>2.- Acudir a Scotiabank y efectuar deposito ó realizar transferencia electronica via internet</li>
													<li>3.- Enviar comprobante de pago a: <a href="mailto:operaciones@interhabita.com">operaciones@interhabita.com</a></li>
												</ul>
												<br>
												<p>Da click en el siguiente boton para guardar e imprimir tu orden de compra</p>
												<br>
												<input type="hidden" id="metodo_de_pago">
												<a onclick="redirect_orden_de_compra('<? echo base_url()?>solicitantes/orden_compra');" href="javascript:void(0);" class="btn btn-primary fileupload-exists">Guardar y Continuar</a>
											</div>
											<?
											}else{
												?>
												<h2>Carrito de compras vacio</h2>
												<a href="<? echo base_url()?>solicitantes/index/spago"><< Regresar</a>
												<?
											}
										?>
									</div>
								</div>
							</div>
							<!--END VISTA BACKEND CLIENTES INTERESADOS-->
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

	