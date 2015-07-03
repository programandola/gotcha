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
								<div id="anunciate">
									<h1>Anúnciate</h1>
									<p>Anúnciate</p>
									<p>Anúnciate</p>
									<p>Anúnciate</p>
									<p>Anúnciate</p>
									<p>Anúnciate</p><p>Anúnciate</p><p>Anúnciate</p><p>Anúnciate</p><p>Anúnciate</p>
									<p>Anúnciate</p><p>Anúnciate</p><p>Anúnciate</p><p>Anúnciate</p><p>Anúnciate</p>
									<p>cambio git hub</p>
								</div>
							</div><!-- .widget -->
						</div><!-- .widget-wrap -->		
					</div><!-- .widget-wrap -->	
				</div><!-- #main-bottom -->	</div><!-- .container -->
			</div><!-- #main-bottom-wrap -->
		</div><!-- #main-wrap -->

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

