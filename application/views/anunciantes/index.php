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

							<!-- VISTA DEL BACKEND - ANUNCIANTES -->
							<div id="divContentPanelPrincipal">
								<div id="divContentPanel">
									<!-- Lista Anunciantes -->
									<h1 class="big_title">Anunciantes</h1>
									<div id="divLoading" class="ajaxSucess">
										<? if($this->session->flashdata("anunciante")){
											echo "<strong>".$this->session->flashdata("anunciante")."</strong>";
										} ?>
									</div>
									<div id="divAnunciantesSearch">
										<a href="<? echo base_url()?>anunciantes/llena_formu_anunciantes" class="btn btn-primary fileupload-exists">Agregar Anunciante</a>							
										<br>
										<p><select id="selectBuscar" style="width:130px">
												<option value="">Buscar por:</option>
												<option value="Nombre">Anunciante</option>
												<option value="Fecha">Fecha</option>
												<option value="Estado">Ciudad/Estado</option>
											</select>	
										</p>
										<div id="busquedaNombre" style="display:none; width:320px">
											<table>
												<tr>
													<td>Anunciante:</td>
													<td><input style="width:200px" type="text" name="nombreAnunciante" id="nombreAnunciante"></td>
													<td><a href="javascript:void(0);" onclick="busquedas_backend('<? echo base_url()?>anunciantes/buscar_anunciante_nombre','nombreAnunciante')" class="btn btn-primary fileupload-exists">Buscar</a></td>
												</tr>
											</table>
										</div>
										<div id="busquedaFecha" style="display:none; width:320px;">
											<table>
												<tr>
													<td>De:</td>
													<td><input style="width:200px" type="date" name="fechaAnuncianteDe" id="fechaAnuncianteDe"></td>
												</tr>
												<tr>
													<td>A:</td>
													<td><input style="width:200px" type="date" name="fechaAnuncianteA" id="fechaAnuncianteA"></td>
													<td><a href="javascript:void(0);" onclick="busquedas_backend('<? echo base_url()?>anunciantes/buscar_anunciantes_por_fechas','fechaAnunciante')" class="btn btn-primary fileupload-exists">Buscar</a></td>
												</tr>
											</table>
										</div>	
										<div id="busquedaEstado" style="display:none; width:320px">
											<table>
												<tr>
													<td>Ciudad/Estado:</td>
													<td><input style="width:200px" type="text" name="estadoAnunciante" id="estadoAnunciante"></td>
													<td><a href="javascript:void(0);" onclick="busquedas_backend('<? echo base_url()?>anunciantes/buscar_anunciantes_estado','estadoAnunciante')" class="btn btn-primary fileupload-exists">Buscar</a></td>
												</tr>
											</table>
										</div>
									</div>
									<div id="divResultAjaxAnunciantes">
										<?php
										$this->load->view('anunciantes/anunciantes.php');
										?>
									</div>
								</div>
								<aside>
									<? $this->load->view('aside.php'); ?>
								</aside>
							</div>
							<!--END VISTA BACKEND ANUNCIANTES-->

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

	