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
								<h1>Contactanos</h1>
								<p>¿Tienes alguna duda? Envíanos un mensaje y nos pondremos en contacto a la brevedad.
								<div id="contactanos">
									<form class="contact-form" method="post" action="" name="formContact" id="formContact">
                                        <p>
                                            <label for="name">Nombre</label>
                                            <input type="text" name="nombreContact" id="nombreContact" class="required" title="" required>
                                        </p>

                                        <p>
                                            <label for="email">Correo Electrónico</label>
                                            <input type="text" name="emailContact" id="emailContact" class="email required" title="" required onchange="valida_correo(this.id, '#divResultAjaxContacto')">
                                        </p>

                                        <p>
                                            <label for="comment">Mensaje</label>
                                            <textarea name="commentContact" id="commentContact" class="required" title="" required></textarea>
                                        </p>
										<p>
											<input type="checkbox" name="boletinContact" id="boletinContact" value="Si" checked> Deseo suscribirme al boletin.
										</p>                                       
                                        <p>
                                            <input type="button" value="Enviar Mensaje" id="submit" onclick="contactanos('<? echo base_url()?>index/contactanos');" class="btn btn-large btn-primary" name="submit">
                                        </p>
                                        <div id="divResultAjaxContacto"></div>
                                    </form>
									
								</div>
								<div id="contactanoslateral">
								<h2>¿Necesitas Ayuda?</h2>
								<p>Te invitamos a que te pongas en contacto con uno de nuestros asesores, quienes te brindarán toda la asesoría para encontrar la propiedad que de solución a tus necesidades.</p>
								<img src="/public/images/contacto.jpg"/>
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

