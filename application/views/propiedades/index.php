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

						<p><a href="javascript:void(0);" onclick="goBack();" class="btn btn-primary fileupload-exists"><< Regresar</a></p>
						<div id="wpsight-latest-listings-2-wrap" class="widget-wrap widget-latest-wrap">
								<?php
								$imgPrincipal=$this->propiedades_model->get_foto_principal_no_principal_propiedades($datosPropiedad->id_propiedad, "big");
								?>
										<div class="divPropiedad">
											<div id="divImgBig"> 
												<img title="" id="fotoActual" src="<?php echo base_url().$imgPrincipal?>">
											</div>
											<div id="divImagesTumbs">
												<ul>
												<?php 
												if($fotosPropiedad>0){
													foreach($fotosPropiedad as $foto){
														?>
															<li><a href="javascript:void(0);" onmouseover="cambia_foto_grande('<?php echo base_url().$foto->path_foto?>');"><img src="<?php echo base_url().$foto->path_foto_thumb?>"></a></li>
														<?
													}
												}
												?>
												</ul>
											</div>
											<h1 class="titulo" style="width: 440px;"><?php echo $datosPropiedad->nombre?></h1>
										<div id="divContentPro">
												<div id="div">
													<?
													$tipoProp=$this->propiedades_model->get_tipo_propiedad_por_id($datosPropiedad->id_categoria);
													$colonia=$this->propiedades_model->get_colonia_por_id($datosPropiedad->id_colonias);
													?>
													<h3><b><? echo $tipoProp->nombre." en ".$datosPropiedad->tipo_operacion ?></b></h3>
													<ul>
														<li>$<?php echo number_format($datosPropiedad->precio)?> MXN</li>
													</ul>
												</div>
												<div style="clear: both"></div>
												<div>
													<h2>Descripción:</h2>
													<p><?php echo nl2br($datosPropiedad->descripcion)?></p>
												</div>
												<div id="servicios">
													<h2>Servicios:</h2>
													<ul>
														<li class="ilist iterreno" title="Terreno">
															<?php echo $datosPropiedad->m2_terreno?>
														</li>
														<li class="ilist iconstruccion" title="Área Construida">
															<?php if($datosPropiedad->m2_construccion != ""){ echo $datosPropiedad->m2_construccion."m<sup>2</sup>"; } ?>
														</li>
														<li class="ilist ibanos" title="Baños">
															<?php echo $datosPropiedad->num_banos?>
														</li>
														<li class="ilist iantiguedad" title="Antiguedad">
															<?php echo $datosPropiedad->antiguedad?>
														</li>
														<li class="ilist irecamaras" title="Recamaras">
															<?php echo $datosPropiedad->num_recamaras?>
														</li>
														<li class="ilist autos" title="Estacionamiento">
															<?php echo $datosPropiedad->num_autos?>
														</li>
													</ul>
												</div>
											</div>	
										</div>
										<div style="float:left; width:320px; padding-left:15px;">
											<img src="/public/images/interesado.png"/>
												<div id="div_formulario_contacto">
													<h2>Déjanos tus Datos</h2>
													<div id="divAjaxContacto" style="text-align:center"></div>
													<form name="formContacto" id="formContacto">
														Nombre:<input type="text" name="c-nombre" id="c-nombre">
														<br>
														Correo:<input type="text" name="c-correo" id="c-correo" onchange="valida_correo(this.id)">
														<br>
														Telefono:<input type="text" name="c-telefono" id="c-telefono">
														<br>
														Observaciones:<textarea name="c-mensaje" id="c-mensaje" rows="10" cols="40" placeholder="Hola,
Estoy buscando <? echo $tipoProp->nombre?> en <? echo $datosPropiedad->tipo_operacion?> en <? if(!empty($colonia)){ echo $colonia->nombre; } ?> y me encontré tu propiedad, por favor comunícate conmigo tan pronto te sea posible.
Gracias, "></textarea>
														<br>
														<input type="hidden" id="c-id_propiedad" name="c-id_propiedad" value="<?php echo $datosPropiedad->id_propiedad?>">
														<input type="hidden" id="c-mensaje-vacio" name="c-mensaje-vacio" value="Hola,
Estoy buscando <? echo $tipoProp->nombre?> en <? echo $datosPropiedad->tipo_operacion?> en <? if(!empty($colonia)){ echo $colonia->nombre; } ?> y me encontré tu propiedad, por favor comunícate conmigo tan pronto te sea posible.
Gracias,">
														<input type="button" value="Enviar" class="btn-primary" style="width:120px;" onclick="contacto('<?php echo base_url()?>propiedades/contacto')">
														
													</form>
													</br>
												</div>
										</div>
												
										<aside>
											<? $this->load->view("aside.php") ?>
										</aside>

										<div style="clear: both"></div> 
										

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
				<div class="modal"></div>
				<div style="left: 0;margin: 0; padding: 0;position: absolute;top: 0;width: 100%;"><div class="error"></div></div>
	</body>


