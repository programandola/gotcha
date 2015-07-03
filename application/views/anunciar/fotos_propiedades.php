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

							<!-- VISTA DEL BACKEND SUBIR FOTOS A LA PROPIEDAD -->
							<div id="divContentPanelPrincipal">
								<div id="divContentPanel">
									<!-- navegacion -->
									<a href="<?php echo base_url()?>misanuncios">Anuncios Publicados</a> > <a href="<?php echo base_url()?>misanuncios/edita_anuncio/<?php echo $lastInsertId?>">Editar Datos Anuncio</a> > Agregar Fotos
									<!-- BOTONES PARA LOS TABS -->
									<div id="divBtnTabs">
										<ul>
											<li class="liTabsLink"><a href="<?php echo base_url()?>misanuncios/edita_anuncio/<?php echo $lastInsertId?>">Editar Datos Anuncio</a></li>
											<li class="liTabsHover">Sube Fotos a tu Anuncio</li>
										</ul>
									</div>
									<!-- div contentTab-->
									<div id="divContentTabs">
										<!-- Formulario Publicar Anuncio -->
										<ul>
											<li><img src="<?php echo base_url()?>public/images/icon_alert.gif"> 1.- Selecciona la imagen a subir, hasta 6 Imagenes podrás agregar a tu Anuncio</li>
											<li><img src="<?php echo base_url()?>public/images/icon_alert.gif"> 2.- La Imagen que subas deben ser máximo de 2 MB</li>
											<li><img src="<?php echo base_url()?>public/images/icon_alert.gif"> 3.- Solo puedes subir Imagenes del Tipo .jpg | .jpeg | .png | .gif</li>
										</ul>
										<div class="clearfix"></div>
	    								<div class="ajaxFail">
	    									<!--$ERROR MUESTRA LOS ERRORES QUE PUEDAN HABER AL SUBIR LA IMAGEN-->
	    									<?=@$error?>
	    									<?php 
	    									if($this->session->flashdata('imagenError')){
	    										echo $this->session->flashdata('imagenError');
	    										?>
	    										<a style="float:right; color:white;" href="javascript:void(0);" onclick="cerrarAlert('.ajaxFail')">Cerrar</a>
	    										<?
	    									}
	    									?>
	    								</div>
	    								<br>
										<?
										$atributos = array( 'id' => 'formFotosPropiedades','name'=>'formFotosPropiedades');
										echo form_open_multipart(base_url()."anunciar/subir_imagenes_propiedades",$atributos);
										?>
		                                 <div class="fileupload fileupload-new" data-provides="fileupload">
			                                 <div>
			                                        <span class="btn btn-primary btn-file">
			                                            <input type="file" id="imagen" name="imagen">
			                                            <input type="hidden" id="lastInsertId" name="lastInsertId" value="<?php echo $lastInsertId?>">
			                                            <input type="hidden" id="tipoPropiedad" name="tipoPropiedad" value="<?php echo $tipoPropiedad->nombre?>">
			                                            <input type="hidden" id="idTipoPropiedad" name="idTipoPropiedad" value="<?php echo $idTipoPropiedad?>">
			                                        </span>
			                                  </div>
		                                  </div>
		                                  <div class="clearfix"></div>
		                                  <br>
										  <input type="submit" class="btn btn-primary" id="submitUploadFotos" name="submitUploadFotos" value="Subir Imagen">    
										  <div id="divUploadFotos" style="display:none"><br>Subiendo Imagen <img src="<? echo base_url()?>public/images/loading-barra.gif"></div>              
										<?=form_close()?><!-- end form -->
										<br>
										<?
										if($this->session->flashdata('message') && $this->session->flashdata('message')=="No puedes Eliminar la Imagen Principal."){
											?>
											<div id="divResultAjaxFotos" class="ajaxFail">
												<?php echo $this->session->flashdata('message')?>
												<a style="float:right; color:white;" href="javascript:void(0);" onclick="cerrarAlert('.ajaxFail')">Cerrar</a>
											</div>
											<?
										}else{
											?>
											<div id="divResultAjaxFotos" class="ajaxSucess">
												<?php echo $this->session->flashdata('message')?>
												<a style="float:right; color:white;" href="javascript:void(0);" onclick="cerrarAlert('.ajaxSucess')">Cerrar</a>
											</div>
											<?
										}
										?>
										 <br><br>
		                                 <div class="fileupload-preview thumbnail">
		                                 	<?php
		                                 	if(count($fotosPropiedades)>0){
		                                 		?>
		                                 		<h2 style="text-align:center">-- Imagenes de tu propiedad --</h2>
		                                 		<br>
												<table>
														<tr style="border:1px solid #c34747; background-color:#c34747; width:10px; color:white">
															<td>Foto Propiedad</td>
															<td>Principal</td>
															<td>Acción</td>
														</tr>
		                                 		<?php
		                                 		foreach ($fotosPropiedades as $foto) {
		                                 			?>
		                                 			<tr style="border:1px dashed silver;">
			                                 			<td><img title="Imagen de tu Propiedad" src="<?php echo base_url().$foto->path_foto_thumb?>"></td>
			                                 			<?php
			                                 			if($foto->principal==1){
			                                 				?>
			                                 				<td><input title="Imagen Principal" type="radio" id="imgPrincipal" name="imgPrincipal" value="<?php echo $foto->id_propiedades_fotos?>" onclick="imagen_principal('<?php echo base_url()?>anunciar/establece_imagen_principal');" checked></td>
			                                 				<td><a href="#" class="btn btn-primary fileupload-exists" data-dismiss="fileupload" onclick="elimina_imagen_propiedad('<?php echo base_url()?>anunciar/elimina_imagen_propiedad/<?php echo $lastInsertId?>/<?php echo $foto->id_propiedades_fotos?>/<?php echo $idTipoPropiedad?>');">Eliminar</a></td>
			                                 				<?php

			                                 			}else{
			                                 				?>
			                                 				<td><input title="Establece Imagen Principal" type="radio" id="imgPrincipal" name="imgPrincipal" value="<?php echo $foto->id_propiedades_fotos?>" onclick="imagen_principal('<?php echo base_url()?>anunciar/establece_imagen_principal');"></td>
			                                 				<td><a href="#" class="btn btn-primary fileupload-exists" data-dismiss="fileupload" onclick="elimina_imagen_propiedad('<?php echo base_url()?>anunciar/elimina_imagen_propiedad/<?php echo $lastInsertId?>/<?php echo $foto->id_propiedades_fotos?>/<?php echo $idTipoPropiedad?>');">Eliminar</a></td>

			                                 				<?php
			                                 			}
			                                 			?>
			                                 			
			                                 		</tr>
			                                 	<?php
		                                 		}
		                                 	?>
		                                 		</table>
		                                 	<?php
		                                 	}else{
		                                 		echo "No has subido Fotos de tu Anuncio";
		                                 	}
		                                 	?>
		                                 </div>
		                                 <br>
		                                 <a href="<?php echo base_url()?>anunciar/finalizar_anuncio" class="btn btn-primary fileupload-exists">Publicar Anuncio</a>
		                                 <br><br>
		                               </div>
		                               <!-- end div contentTab-->
								</div>
								<aside>
									<? $this->load->view('aside.php'); ?>
								</aside>
							</div>
							<!--END VISTA SUBIR IMAGENES PROPIEDAD-->

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

	