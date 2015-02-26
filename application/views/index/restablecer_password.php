
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

				
			</div><!-- #container-wrap-header -->



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

							<div style="height:400px">
								<div id="divRestablecerPassword" style="width:400px; margin:0 auto; padding:10px; margin-top:50px; margin-bottom:30px; border:1px solid silver">
								<div>
									<h2 style="text-align:center">Cambiar Contraseña</h2>
									<div id="divAjaxRestablecerPassword"></div>
									<form>
										<ul>
											<li>Contraseña Nueva:</li>
											<li><input type="password" id="passNuevo"></li>
											<li>Contraseña Nueva Confirmar:</li>
											<li><input type="password" id="passNuevoConfirm"></li>
											<li><input type="hidden" id="sha1IdUsuario" value="<?php echo $sha1IdUsuario?>"><input type="hidden" id="sha1Correo" value="<?php echo $sha1Correo?>"></li>
											<li style="text-align:center"><br><input type="button" value="Cambiar Contraseña" class="btn btn-primary fileupload-exists" onclick="actualiza_password('<?php echo base_url()?>index/actualiza_password');"></li>
										</ul>
									</form>
								</div>
								</div>
								<div id="divSuccess" style="display:none; text-align:center">
									<img src="<?php echo base_url()?>public/images/Palomita.png"> 
									<br>
									<label>Cambiaste tu Contraseña con Exito!!!</label>
									<br>
									<input type="button" value="Ir a mi Cuenta" class="btn btn-primary fileupload-exists">
								</div>
							</div>

							
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

