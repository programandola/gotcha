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

							<!-- VISTA DEL BACKEND DE PAGO ACTIVADO SUCCESS-->
							<div id="divContentPanelPrincipal">
								<div id="divContentPanel">
									<h1>Pago Activado</h1>
									<br>
									<div style="border:1px solid silver; width:800px; padding:15px;">
										<p><img src="<? echo base_url()?>public/images/icono_paloma.png"> Los pagos de la Orden de Compra <b>No. <? echo $idOrdenCompra ?></b> se realizarón correctamente.</p>
										<p><img src="<? echo base_url()?>public/images/icono_paloma.png"> Se mando un email por cada solicitante al anunciante con los datos comprados</p>
										<p><img src="<? echo base_url()?>public/images/icono_paloma.png"> El anunciante también puede consultar los datos del ó de los solicitantes comprados en la parte de <b>Mis Solicitantes</b> desde su perfil</p>
									</div>
									<br>
									
									<a href="<? echo base_url()?>ordencompra"><< Regresar a Orden de Compra</a>
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

	