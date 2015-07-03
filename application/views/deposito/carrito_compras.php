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

							<!-- VISTA DEL BACKEND DEL CLIENTES INTERESADOS PAGO Y SIN PAGO -->
							<div id="divContentPanelPrincipal">
								<div id="divContentPanel">
									<h1>Mis clientes</h1>
									<br>
									<div id="divLoading"></div>
									<ul class="ulSolicitantes">
										<?
										if($opcion=="cpago"){
											?>
											<li class="liNoResaltado"><a href="<? echo base_url()?>solicitantes/index/cpago">Clientes Comprados</a></li>
											<li class="liResaltado"><a href="<? echo base_url()?>solicitantes/index/spago">Clientes por Comprar</a></li>
											<?
										}else
											if($opcion=="spago"){
												?>
												<li class="liResaltado"><a href="<? echo base_url()?>solicitantes/index/cpago">Clientes Comprados</a></li>
												<li class="liNoResaltado"><a href="<? echo base_url()?>solicitantes/index/spago">Clientes por Comprar</a></li>
											<?
										}
										?>
  									</ul>
								    <div class="clr"></div>
								    <section class="block">
								      <article>
								        <br>
										<!--begin divSolicitantesPago-->
										<div id="divSolicitantes">
											<?php
											if($opcion=="cpago"){
												$this->load->view("solicitantes/solicitantes_pago.php");
											}else
												if($opcion=="spago"){
												$this->load->view("solicitantes/solicitantes_sin_pago.php");
											}
											?>	
										</div>
										<!--end divSolicitantesPago-->
								      </article>
								    
								 </section>
								</div>
								<aside>
									<center><h3>Clientes Agregados para Pago</h3></center>
									<div id="divAjaxCarritoCompra"><? $this->carrito->view_carrito(); ?></div>
								</aside>
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

	