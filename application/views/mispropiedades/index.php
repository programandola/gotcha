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

							<!-- VISTA DEL BACKEND - MIS PROPIEDADES -->
							<div id="divContentPanelPrincipal">
								<div id="divContentPanel">
									<!-- Formulario Publicar Anuncio -->
									<h1 class="big_title">Mis Propiedades</h1>
									<div class="divResultAjaxMisAnuncios"></div>

									<?php
										if(count($misPropiedades)>0){
											foreach($misPropiedades as $result){
												$fotoPrincipal=$this->propiedades_model->get_foto_principal_propiedades($result["id_propiedad"]);
												$tipoPropiedad=$this->propiedades_model->get_tipo_propiedad_por_id($result["id_categoria"]);
											?>
												<div class="divMisAnunciosLeft">
													<div id="divImg"> 
														<?php
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
														<a target="_blank" href="<? echo base_url()."propiedades/index/".$tipoPropiedad->nombre."/".$this->propiedades_model->texto_con_guion($result["propiedad"])."/".$result["id_propiedad"]?>"><img title="<?php echo $result["propiedad"]?>" src="<?php echo base_url().$principal?>"></a>
													</div>
													<div id="divMisAnunciosRight">
														<h1 class="titulopropiedad"><a target="_blank" href="<? echo base_url()."propiedades/index/".$tipoPropiedad->nombre."/".$this->propiedades_model->texto_con_guion($result["propiedad"])."/".$result["id_propiedad"]?>" title="<?php echo $result["propiedad"]?>"><?php echo $result["propiedad"]?></a></h1>
															<ul>
																<li><p><?php echo $this->propiedades_model->recorta_cadena($result["descripcion"],100)?></p>
																</li>
															</ul>
													</div>
												</div>
											<?php
											}
										}
										else{
											echo "<h2>No existen Propiedades en las que estes Interesado</h2>";
										}
										?>
								</div>
								<aside>
									<h2>Publicidad</h2>
								</aside>
							</div>
							<!--END VISTA MIS PROPIEDADES-->

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

	