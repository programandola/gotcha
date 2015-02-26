<body class="home blog boxed layout-three" style="">
	<?php
		$this->load->view('pop-ups.php');
	?>
		<div id="outer">
			<div id="container-wrap-header">
				<?php
					$this->load->view('header.php');
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

							<!-- VISTA DEL BACKEND - FAVORITOS -->
							<div id="divContentPanelPrincipal">
								<div id="divContentPanel">
									<h1 class="big_title">Favoritos</h1>
									<div id="divResultFavoritos" class="ajaxSucess">
										<?php echo $this->session->flashdata('favorito');?>
									</div>

									<?php
										if(count($favoritos)>0){
											foreach($favoritos as $result){
												$fotoPrincipal=$this->propiedades_model->get_foto_principal_propiedades($result["id_propiedad"]);
												$tipoPropiedad=$this->propiedades_model->get_tipo_propiedad_por_id($result["id_categoria"]);
														if(count($fotoPrincipal)>0){
															$principal=$fotoPrincipal->path_foto;
														}else{
															$fotoNoPrincipal=$this->propiedades_model->get_foto_no_principal_propiedades($result["id_propiedad"]);
															if(count($fotoNoPrincipal)>0){
																$principal=$fotoNoPrincipal->path_foto;
															}else{
																$principal="";
															}
														}

														if($principal==""){
															$principal="public/images/Sin_imagen_disponible.jpg";
														}
														?>
														<div id="divFavoritos">
															<ul class="ulFavoritos">
																<li><input type="checkbox"></li>
																<li><a target="_blank" href="<?php echo base_url();?>propiedades/index/<?php echo $tipoPropiedad->nombre?>/<?php echo $result["nombre"]?>/<?php echo $result["id_propiedad"]?>"><img title="<?php echo $result["nombre"]?>" src="<?php echo base_url().$principal?>"></a></li>
																<li><h1 class="titulopropiedad"><a target="_blank" href="<?php echo base_url();?>propiedades/index/<?php echo $tipoPropiedad->nombre?>/<?php echo $result["nombre"]?>/<?php echo $result["id_propiedad"]?>" title="<?php echo $result["nombre"]?>"><?php echo $result["nombre"]?></a></h1></li>
																<li><a href="<?php echo base_url()?>favoritos/eliminar/<?php echo $result["id_favoritos"]?>" class="btn btn-primary fileupload-exists">Quitar</a></li>
															</ul>
														</div>
											<?php
											}
										}
										else{
											echo "<h2>No Tienes Favoritos</h2>";
										}
										?>
								</div>
								<aside>
									<h2>Publicidad</h2>
								</aside>
							</div>
							<!--END VISTA FAVORITOS-->

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

	