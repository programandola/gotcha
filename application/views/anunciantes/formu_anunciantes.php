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

							<!-- VISTA DEL BACKEND - ADD ANUNCIANTES -->
							<div id="divContentPanelPrincipal">
								<div id="divContentPanel">
									<a href="<? echo base_url()?>anunciantes"><< Regresar</a>
									<br><br>
									<h2>Agregar Anunciante</h2>
									<br>
									<form name="formuAnunciante" id="formuAnunciante">
						           		<p><b>Verifica que tus datos sean correctos y verdaderos porque serán los que se utilizarán para enviar a los clientes interesados en tus propiedades.</b></p>
						           		<p>Los campos marcados con * son obligatorios</p>
						           		<div id="divResultAjax"></div>
						           		<table>
						           			<tr>
						           				<td><label>Nombre *</label> <input type="text" name="nombre" id="nombre" required></td>
						           				<td><label>Apellidos *</label><input type="text" name="apellidos" id="apellidos" required></td>
						           			</tr>
						           			<tr>
						           				<td><label>Correo *</label><input type="text" name="correo" id="correo" onchange="valida_correo(this.id, '#divResultAjax')" required></td>
						           				<td><label>Telefono</label><input type="text" name="telefono" id="telefono"  required></td>
						           			</tr>
						           			<tr>
						           				<td><label>Password *</label><input type="password" name="pass" id="pass" required></td>
						           				<td><label>Confirmar Password *</label><input type="password" name="c-pass" id="c-pass" required></td>
						           			</tr>
						           			<tr>
						           				<td><label>Celular</label><input type="text" name="celular" id="celular" required></td>
						           				<td><label>Estado * </label>
						           					<select name="comboEstado" id="comboEstado">
						           						<option value="">Selecciona tu estado</option>
						           						<?php  
						           						$estados=$this->propiedades_model->get_estados();
						           						if(count($estados)>0){
						           							foreach ($estados as $estado) {
						           							?>
						           								<option value="<?php echo $estado->id_estado?>"><?php echo $estado->nombre?></option>
						           							<?php
						           							}
						           						}
						           						?>
						           					</select>
						           				</td>
						           			</tr>
						           			<tr>
						           				<td><label>Tipo de Anunciante? *</label>
						           					<select name="comboAnunciante" id="comboAnunciante">
						           					    <option value="">Seleccionar</option>
						           					    <?php  
						           						$tipoAnunciante=$this->usuarios_model->get_anunciantes_tipo();
						           						if(count($tipoAnunciante)>0){
						           							foreach ($tipoAnunciante as $tipo) {
						           							?>
						           								<option value="<?php echo $tipo->id_anunciantes_tipo?>"><?php echo $tipo->tipo_anunciante?></option>
						           							<?php
						           							}
						           						}
						           						?>
						           					</select>
						           				</td>
						           				<td>
						           					<div class="divOculto">
						           					    <label>Nombre Empresa *</label>
						           					    <input type="text" id="empresa" name="empresa">
						           					</div>
						           				</td>
						           			</tr>
						           			<tr>
						           				<td colspan="2"><input type="button" value="Agregar" class="btn btn-primary fileupload-exists" onclick="registro('<?php echo base_url()?>anunciantes/add_anunciantes');"></td>
						           			</tr>
						           		</table>
						           		
						           </form>
									
								</div>
								<aside>
									<? $this->load->view('aside.php'); ?>
								</aside>
							</div>
							<!--END VISTA BACKEND ADD ANUNCIANTES-->

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