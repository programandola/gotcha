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

							<!-- VISTA DEL BACKEND - PROPIEDADES -->
							<div id="divContentPanelPrincipal">
								<div id="divContentPanel">
									<!-- Lista Anunciantes -->
									<h1 class="big_title">Propiedades</h1>
									<div id="divLoading" class="ajaxSucess">
										<? if($this->session->flashdata("anunciante")){
											echo "<strong>".$this->session->flashdata("anunciante")."</strong>";
										} ?>
									</div>
									<div id="divInteresadosSearch">								
										<br>
										<p><select id="selectBuscar" style="width:130px">
														<option value="">Buscar por:</option>
														<option value="Propiedad">ID Propiedad</option>
														<option value="Titulo">Titulo</option>
														<option value="Nombre">Anunciante</option>
														<option value="Estado">Estado</option>
														<option value="Delegacion">Delegación</option>
														<option value="Colonia">Colonia</option>
														<option value="Fecha">Fecha</option>
													</select>	
										</p>
										<div id="busquedaNombre" style="display:none; width:320px">
											<table>
												<tr>
													<td>Anunciante:</td>
													<td><input style="width:200px" type="text" name="nombreAnunciante" id="nombreAnunciante"></td>
													<td><a href="javascript:void(0);" onclick="busquedas_backend('<? echo base_url()?>Propiedades/buscar_propiedades_anunciante','nombreAnuncianteP')" class="btn btn-primary fileupload-exists">Buscar</a></td>
												</tr>
											</table>
										</div>
										<div id="busquedaPropiedad" style="display:none; width:320px;">
											<table>
												<tr>
													<td>ID Propiedad:</td>
													<td><input type="text" id="id_propiedad" name="id_propiedad"></td>
													<td><a href="javascript:void(0);" onclick="busquedas_backend('<? echo base_url()?>Propiedades/buscar_id_propiedad','idPropiedad')" class="btn btn-primary fileupload-exists">Buscar</a></td>
												</tr>
											</table>
										</div>
										<div id="busquedaFecha" style="display:none; width:320px;">
											<table>
												<tr>
													<td>De:</td>
													<td><input style="width:200px" type="date" name="fechaPropiedadesDe" id="fechaPropiedadesDe"></td>
												</tr>
												<tr>
													<td>A:</td>
													<td><input style="width:200px" type="date" name="fechaPropiedadesA" id="fechaPropiedadesA"></td>
													<td><a href="javascript:void(0);" onclick="busquedas_backend('<? echo base_url()?>Propiedades/buscar_propiedades_fecha','fechaPropiedad')" class="btn btn-primary fileupload-exists">Buscar</a></td>
												</tr>
											</table>
										</div>	
										<div id="busquedaTitulo" style="display:none; width:320px;">
											<table>
												<tr>
													<td>Titulo:</td>
													<td><input type="text" id="tpropiedad" name="tpropiedad"></td>
													<td><a href="javascript:void(0);" onclick="busquedas_backend('<? echo base_url()?>Propiedades/buscar_propiedades_titulo','tituloPropiedad')" class="btn btn-primary fileupload-exists">Buscar</a></td>
												</tr>
											</table>
										</div>
										<div id="busquedaEstado" style="display:none; width:320px;">
											<table>
												<tr>
													<td>Ciudad/Estado:</td>
													<td><input type="text" id="estado" name="estado"></td>
													<td><a href="javascript:void(0);" onclick="busquedas_backend('<? echo base_url()?>Propiedades/buscar_propiedades_estado','estadoPropiedad')" class="btn btn-primary fileupload-exists">Buscar</a></td>
												</tr>
											</table>
										</div>
										<div id="busquedaDelegacion" style="display:none; width:320px;">
											<table>
												<tr>
													<td>Delegación:</td>
													<td><input type="text" id="delegacion" name="delegacion"></td>
													<td><a href="javascript:void(0);" onclick="busquedas_backend('<? echo base_url()?>Propiedades/buscar_propiedades_delegacion','delegacionPropiedad')" class="btn btn-primary fileupload-exists">Buscar</a></td>
												</tr>
											</table>
										</div>
										<div id="busquedaColonia" style="display:none; width:320px;">
											<table>
												<tr>
													<td>Colonia:</td>
													<td><input type="text" id="colonia" name="colonia"></td>
													<td><a href="javascript:void(0);" onclick="busquedas_backend('<? echo base_url()?>Propiedades/buscar_propiedades_colonia','coloniaPropiedad')" class="btn btn-primary fileupload-exists">Buscar</a></td>
												</tr>
											</table>
										</div>
									</div>
									<div id="divResultAjaxPropiedades">
										<?php
										$this->load->view('Propiedades/Propiedades.php');
										?>
									</div>
								</div>
								<aside>
									<? $this->load->view('aside.php'); ?>
								</aside>
							</div>
							<!--END VISTA BACKEND PROPIEDADES-->

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

	