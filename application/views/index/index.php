	<body class="home blog boxed layout-three" style="">
		<?php
		$this->load->view('pop-ups.php');
		?>
		<div id="outer">
			<div id="container-wrap-header">
				<div id="top-wrap" class="wrap">
					<?php
						$this->load->view('header.php');
					?>
				</div><!-- #top-wrap -->

				<div id="header-wrap" class="wrap">
					<?php
						$this->load->view('header-buscador.php')
					?>
				</div><!-- #header-wrap -->
			</div><!-- #container-wrap-header -->
	<div id="submenu-wrap" class="wrap">
		<?php
			$this->load->view('nav.php');
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

							<div id="wpsight-latest-listings-2" class="widget widget-latest widget-latest-listings row">						

								<div class="post-624 property type-property status-publish hentry span4 clear clearfix">

									<div class="widget-inner">

										<div class="post-image listing-image alignnone"><a href="javascript:void(0);" onclick="open_registro();" title="ANUNCIANTES" rel="bookmark"><img src="public/images/home-1.jpg" class="attachment-post-thumbnail wp-post-image" alt="" title=""></a></div><!-- .post-image --> 					    		
										<h3 class="post-title">
											<?php
											if( $this->session->userdata('login') ){
											?>
												<a href="<?php echo base_url()?>anunciar">AFILIATE</a>
											<?
											}else{
												?>
												<a href="javascript:void(0);" onclick="open_registro();" title="ANUNCIANTES" rel="bookmark">AFILIATE</a>
												<?
											}
											?>
											</h3>
											<div class="post-teaser">
												<p>Registra tu campo gratuitamente.
												</p>
											</div>


										</div><!-- .widget-inner -->

									</div><!-- .post-624 -->					    
									<div class="post-614 property type-property status-publish hentry span4 clearfix">

										<div class="widget-inner">

											<div class="post-image listing-image alignnone"><a href="#"><img src="public/images/home-2.jpg" class="attachment-post-thumbnail wp-post-image" alt="" title=""></a></div><!-- .post-image --> 					    		
											<h3 class="post-title">
												<a href="" title="BUSQUEDA DE PROPIEDADES" rel="bookmark">BUSQUEDA DE CAMPOS</a>
												</h3>
												<div class="post-teaser">
													<p>Busca y encuentra un campo cerca de tí entre más  de 100,00 campos en todo el país.</p>
												</div>
											</div><!-- .widget-inner -->
										</div><!-- .post-614 -->					    
										<div class="post-605 property type-property status-publish hentry span4 clearfix">

											<div class="widget-inner">

												<div class="post-image listing-image alignnone"><a href="#"><img src="public/images/home-3.jpg" class="attachment-post-thumbnail wp-post-image" alt="" title=""></a></div><!-- .post-image --> 					    		
												<h3 class="post-title">
													<a href="" title="ANUNCIANTES" rel="bookmark">ARTICULOS DE INTERES</a>
													</h3>
													<div class="post-teaser">
														<p>Consulta nuesto Blog especializado en campos Gotcha, aquí encontraras herramientas profesionales que harán de tu campo uno de los mejores en todo el país.
														</p>
													</div>


												</div><!-- .widget-inner -->

											</div><!-- .post-605 -->					    

										</div><!-- .post-585 -->				
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
				</div>
				<!-- #footer-bottom-wrap -->

				<div id="credit-wrap" class="wrap">
					<?php
						$this->load->view('credit.php');
					?>
				</div>
				<!-- #credit-wrap -->
			</div><!-- #outer -->
		<div style="left: 0;margin: 0; padding: 0;position: absolute;top: 0;width: 100%;"><div class="error"></div></div>
	</body>

