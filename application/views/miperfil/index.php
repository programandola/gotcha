
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

							<!-- VISTA DEL BACKEND MI PERFIL -->
							<div id="divContentPanelPrincipal">
								<div id="divContentPanel">
									<h1 class="big_title">Mi Cuenta</h1>
									<h2>Bienvenido(a) a tu Panel de Administración</h2>
									<br>
									<div style="text-align:center; width:120px; border:1px solid gray; box-shadow: 7px 7px 5px silver;">
										<?
										if( $datosUser->avatar !="" ){
											?>
											<a href="#" id="open-avatar" title="Cambiar Imagen Cuenta"><img src="./uploads/avatar/<?php echo $datosUser->avatar;?>"></a>
											<?php
										}
										else{
											?>
											<a href="#" id="open-avatar" title="Cambiar Imagen Cuenta"><img src="<?php echo base_url()?>public/images/avatar-default.png"></a>
											<?php
										}
										?>
										<h2><b><?php echo $this->session->userdata('login')?></b></h2>
									</div>
										<!--$ERROR MUESTRA LOS ERRORES QUE PUEDAN HABER AL SUBIR LA IMAGEN-->
										<div class="ajaxFail">
											<?
											//si no se subio imagen mostramos mensaje de error
											if($this->session->flashdata('imagenError')){
												echo $this->session->flashdata('imagenError');
												?>
												<a style="float:right; color:white;" href="javascript:void(0);" onclick="cerrarAlert('.ajaxFail')">Cerrar</a>
												<?
											}
											?>
											<?=@$error?>
										</div>
										<!-- si se actualizo la imagen de la cuenta correctamente -->
										<div class="ajaxSucess">
											<?
											//si se subio la imagen de la cuenta ok
											if($this->session->flashdata('imagenOk')){
												echo $this->session->flashdata('imagenOk');
												?>
												<a style="float:right; color:white;" href="javascript:void(0);" onclick="cerrarAlert('.ajaxSucess')">Cerrar</a>
												<?
											}
											?>
										</div>
									<br><br>
									<h2>DATOS DE MI CUENTA</h2>
									<hr>
									<div id="divResultAjaxUser"></div>
									<p>Los campos marcados con * son obligatorios</p>
									<table>
										<tr>
											<td>Nombre *<br><input type="text" name="u-nombre" id="u-nombre" value="<?php echo $datosUser->nombre;?>" required></td>
											<td>Apellidos *<br><input type="text" name="u-apellidos" id="u-apellidos" value="<?php echo $datosUser->apellidos;?>" required></td>
										</tr>
										<tr>
											<td>Email *<br><input type="text" name="u-correo" id="u-correo" value="<?php echo $datosUser->correo;?>" required></td>
											<td>Teléfono *<br><input type="text" name="u-telefono" id="u-telefono" value="<?php echo $datosUser->telefono;?>" required></td>
										</tr>
										<tr>
											<td>Celular<br><input type="text" name="u-celular" id="u-celular" value="<?php echo $datosUser->celular;?>" required></td>
											<td>Ciudad/Estado *<br>
												<select name="u-selectEstados" id="u-selectEstados">
													<option value="">Seleccionar</option>
														<?php foreach($estados as $estado){
																if($estado->id_estado==$datosUser->id_estado){
																	?> 
																	<option value="<?php echo $estado->id_estado;?>" selected="selected"><?php echo $estado->nombre;?></option>
																	<?
																}else{
																	?>
																	<option value="<?php echo $estado->id_estado;?>"><?php echo $estado->nombre;?></option>
																	<?
																}
															  }
														?>
		                                        </select>
											</td>
										</tr>
											<?
											if(count($empresa)>0){
												$tipoAnunciante=$this->usuarios_model->get_anunciantes_tipo_por_id($empresa->id_anunciantes_tipo);
												?>
												<tr>
													<input type="hidden" id="u-inmobiliaria" name="u-inmobiliaria" value="true">
													<td><? echo $tipoAnunciante->tipo_anunciante ?><br><input type="text" name="u-empresa" id="u-empresa" value="<?php echo $empresa->nombre_empresa;?>" required></td>
													<td>Dirección <? echo $tipoAnunciante->tipo_anunciante ?><br><input type="text" name="u-empresa-direccion" id="u-empresa-direccion" value="<?php echo $empresa->direccion;?>" required></td>
													<input type="hidden" id="u-inmobiliaria" name="u-inmobiliaria" value="false">
												</tr>
												<?
											}
											?>
										<tr>
											<td colspan="2"><input type="button" value="Actualizar Cuenta" class="btn btn-primary fileupload-exists" onclick="update_user('<?php echo base_url()?>miperfil/updateUser')"></td>
										</tr>
									</table>
									<br><br>
									<h2>CAMBIAR CONTRASEÑA</h2>
									<hr>
									<div id="divResultAjaxUserPass"></div>
									<form name="formuPassword" id="formuPassword">
										<table>
											<tr>
												<td>Contraseña Actual<br><input type="password" name="passActual" id="passActual" required></td>
												<td>Contraseña Nueva<br><input type="password" name="passNuevo" id="passNuevo" required></td>
											</tr>
											<tr>
												<td>Confirmar Contraseña Nueva<br><input type="password" name="passNuevoConfirm" id="passNuevoConfirm" required></td>
											</tr>
											<tr>
												<td colspan="2"><input type="button" value="Cambiar Contraseña" class="btn btn-primary fileupload-exists" onclick="update_user_pass('<?php echo base_url()?>miperfil/updateUserPass');"></td>
											</tr>
										</table>
									<form>
								</div>
								<aside>
									<? $this->load->view('aside.php'); ?>
								</aside>
							</div>
							<!-- end resultados backend-->

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

	