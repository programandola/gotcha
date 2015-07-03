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

							<!-- VISTA DEL BACKEND DETALLES ORDEN DE COMPRA -->
							<div id="divContentPanelPrincipal">
								<div id="divContentPanel">
									<h1>Detalles de Orden de Compra</h1>
									<a href="<? echo base_url()?>ordencompra"><< Regresar</a>
									<br>
									<p>Estos son los detalles de la orden de compra </p>
									<div>
										<table class="tabla">
											<thead>
												<tr align="center">
													<th>No. Orden</th>
													<th>ID Propiedad</th>
													<th>Propiedad</th>
													<th>Valor</th>
													<th>Solicitante</th>
													<th>Anunciante</th>
													<th>Solicitado desde</th>
													<th>Costo</th>
												</tr>
											</thead>
											<?php
											$total=0;
											foreach ($datos as $key => $value) {

												$idOrdenCompra=$value->id_orden_de_compra;
												$solicitantes=$this->solicitantes_model->get_solicitante_detalles_orden_de_compra($value->id_solicitantes_propiedades);

												$imgPrincipal=$this->propiedades_model->get_foto_principal_no_principal_propiedades($solicitantes->id_propiedad, "thumb");
												$nombrePropiedad=$this->propiedades_model->get_tipo_propiedad_por_id($solicitantes->id_categoria);
												$costoTransaccion=$this->propiedades_model->get_costos_transacciones_paypal_tipo_propiedad_por_id($solicitantes->id_categoria);
												$anunciante=$this->usuarios_model->get_user_por_id($solicitantes->id_usuario);
												$total+=$costoTransaccion->costo;
												?>
												<tr class="resalta">
													<td><? echo $idOrdenCompra ?></td>
													<td><?php echo $solicitantes->id_propiedad;?></td>
													<td><a target="_blank" title="Ir a la Propiedad" href="<?php echo base_url()."propiedades/index/".$nombrePropiedad->nombre."/".$this->propiedades_model->texto_con_guion($solicitantes->propiedad)."/".$solicitantes->id_propiedad;?>"><img style="width:75px; height:65px;" src="<?php echo base_url().$imgPrincipal?>"></a></td>
													<td>$<?php echo number_format($solicitantes->precio);?></td>
													<td><?php echo $solicitantes->cliente;?></td>
													<td><?php echo $anunciante->nombre;?></td>
													<td><?php echo $solicitantes->fecha_registro;?></td>
													<td>$<?php echo $costoTransaccion->costo;?></td>
												</tr>
											<?
											}
											?>
										</table>
										<div style="text-align:right; width:100%">
											<p><strong>Total de Compra $<? echo $total ?>.00</strong></p>
										</div>
										<br>
										<a href="javascript:void(0);" onclick="return confirmActivaPagoDeposito('<? echo base_url()?>ordencompra/activar_pago_orden_compra/<? echo $idOrdenCompra ?>')" class="btn btn-primary fileupload-exists">Activar Pago</a>
									</div>
									<br><br>
								</div>
							</div>
							<!--END VISTA BACKEND DETALLES ORDEN DE COMPRA-->
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

	