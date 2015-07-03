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

							<!-- VISTA DEL BACKEND - MIS ANUNCIOS -->
							<div id="divContentPanelPrincipal">
								<div id="divContentPanel">
									<!-- Formulario Publicar Anuncio -->
									<h1 class="big_title">Anuncios Publicados</h1>
									<div class="ajaxSucess">
										<? if($this->session->flashdata("delete")){
											echo "<strong>".$this->session->flashdata("delete")."</strong>";
										}?>
									</div>
									<div class="divResultAjaxMisAnuncios"></div>
									<?php
									if(count($misAnuncios)>0){
										// paginacion de resultados 
										if(isset($_GET["pag"])){
											$this->paginador->inicio_limite_paginacion($_GET["pag"]);
										}else{
											$this->paginador->inicio_limite_paginacion();
										}
										
										//paginacion de resultados
										if($this->paginador->configPaginador["paginas"] > 1){
											?>
											<!--begin ul paginacion-->
											<ul id="ulRangosPaginacion" >
												<?
												//para los rangos de la paginación
												$rangos=$this->paginador->rango_paginacion(10, $this->paginador->configPaginador["paginas"], $this->paginador->configPaginador["paginaActual"]);
												?>
												<li>
													<?
													if(count($rangos)>0){
														echo count($misAnuncios)." Propiedades Encontradas";
													}
													?>
												</li>
												<li>
													<?
													//mostramos el boton de primero y anterior si la pagina actual es >= a 2
													if($this->paginador->configPaginador["paginaActual"] >= 2){
														?>
														<!-- boton primero-->
														<a class="btn btn-primary fileupload-exists" title="Primero" href="<?php echo base_url()?>misanuncios?pag=1"><<</a>
														<!-- boton anterior-->
														<a class="btn btn-primary fileupload-exists" title="Anterior" href="<?php echo base_url()?>misanuncios?pag=<? echo $this->paginador->configPaginador["paginaActual"]-1; ?>"><</a>
														<?
													}
													for($i=0; $i< count($rangos); $i++){
														if($rangos[$i]==$this->paginador->configPaginador["paginaActual"]){
															echo "<b>".$rangos[$i]."</b>";
														}
														else{
															?>
															<a class="btn btn-primary fileupload-exists" title="Pagina <? echo $rangos[$i]?>" href="<?php echo base_url()?>misanuncios?pag=<?php echo $rangos[$i]?>"><?php echo $rangos[$i];?></a>
															<?php
														}
													}
														//mostramos el boton de siguiente y ultimo si el numero total de paginas es > a 2
														if($this->paginador->configPaginador["paginas"] > 2){
															//boton siguiente
															if($numPaginas > $this->paginador->configPaginador["paginaActual"] ){
																?>
																<a class="btn btn-primary fileupload-exists" title="Siguiente" href="<?php echo base_url()?>misanuncios?pag=<? echo $this->paginador->configPaginador["paginaActual"]+1; ?>">></a>
																<!-- boton ultimo-->
																<a class="btn btn-primary fileupload-exists" title="Ultimo" href="<?php echo base_url()?>misanuncios?pag=<? echo $this->paginador->configPaginador["paginas"]; ?>">>></a>
															<?
															}
														}
														?>
													</li>
												</ul>
												<!--end ul paginacion-->
												<?
											}

											$anuncios=$this->propiedades_model->get_propiedades_por_id_usuario_limite($this->paginador->configPaginador["limiteInicio"]);

											foreach($anuncios as $result){
												$imgPrincipal=$this->propiedades_model->get_foto_principal_no_principal_propiedades($result["id_propiedad"], "thumb");
												?>
												<h1 class="titulopropiedad"><a href="<?php echo base_url();?>misanuncios/edita_anuncio/<?php echo $result["id_propiedad"]?>" title="<?php echo $result["nombre"]?>"><?php echo $result["nombre"]?></a></h1>
												<div class="divMisAnunciosLeft">
													<div id="divImg"> 
														<a href="<?php echo base_url();?>misanuncios/edita_anuncio/<?php echo $result["id_propiedad"]?>"><img title="<?php echo $result["nombre"]?>" src="<?php echo base_url().$imgPrincipal?>"></a>
													</div>
												</div>
												<div class="divMisAnunciosRight">
													<ul>
														<li><?php echo $this->propiedades_model->recorta_cadena($result["descripcion"],100)?>...</li>
														<li><br><input type="button" value="Editar" class="btn btn-primary fileupload-exists" onclick="redirect('<?php echo base_url()."misanuncios/edita_anuncio/".$result["id_propiedad"];?>')"> <input type="button" value="Eliminar" class="btn btn-primary fileupload-exists" onclick="elimina_anuncio('<?php echo base_url()."misanuncios/eliminar_anuncio";?>',<? echo $result["id_propiedad"] ?>)"></li>
													</ul>
												</div>
											<?php
											}
										}
										else{
											echo "<h2>No has Publicado Anuncios Aun</h2>";
										}
										?>
								</div>
								<aside>
									<? $this->load->view('aside.php'); ?>
								</aside>
							</div>
							<!--END VISTA PUBLICAR ANUNCUIO-->

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

	