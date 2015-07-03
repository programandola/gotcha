<?
if(!$this->session->userdata('login')){
	?>
	<!-- popup registrarse -->
		<div id="popup-registro" style="display: none;">
		    <div class="content-popup">
		        <div class="close"><a href="#" id="close"><img src="<?php echo base_url();?>public/images/close.png"/></a></div>
		        <div>
		           <h2><strong>Registrate</strong></h2>
		           <form id="formuRegistro" name="formuRegistro">
		           		<p><b>Verifica que tus Datos sean correctos y verdaderos.</b></p>
		           		<p>Los campos marcados con * son obligatorios</p>
		           		<div id="divResultAjax"></div>
		           		<table>
		           			<tr>
		           				<td><label>Nombre *</label> <input type="text" name="nombre" id="nombre" required></td>
		           				<td><label>Apellidos *</label><input type="text" name="apellidos" id="apellidos" required></td>
		           			</tr>
		           			<tr>
		           				<td><label>Correo *</label><input type="text" name="correo" id="correo" onchange="valida_correo(this.id, '#divResultAjax')" required></td>
		           				<td><label>Telefono *</label><input type="text" name="telefono" id="telefono" required></td>
		           			</tr>
		           			<tr>
		           				<td><label>Password *</label><input type="password" name="pass" id="pass" required></td>
		           				<td><label>Confirmar Password *</label><input type="password" name="c-pass" id="c-pass" required></td>
		           			</tr>
		           			<tr>
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
		           				<td>
		           					<input type="checkbox" id="checkBoletinAnunciante" checked> Deseo suscribirme al boletín
		           				</td>
		           				
		           			</tr>
		           			<tr>
		           				<td colspan="2"><input type="button" value="Registrame" class="btn btn-primary fileupload-exists" onclick="registro('<?php echo base_url()?>registro');"></td>
		           			</tr>
		           		</table>
		           		
		           </form>
		        </div>
		    </div>
		</div>
		<!-- end popup registrarse-->
		<?
}
?>
		<!-- popup login -->
		<div id="popup-login" style="display: none;">
		    <div class="content-popup-login">
		        <div class="close"><a href="#" id="close-login"><img src="<?php echo base_url();?>public/images/close.png"/></a></div>
		        <!--div Login-->
		        <div id="divLogin">
		           <h2><strong>Ingresa a tu Cuenta</strong></h2>
		           <br>
		           		<div id="divResultAjaxLogin"></div>
		           		<ul>
		           			<li>Correo Electrónico</li>
		           			<li><input type="text" name="u-login" id="u-login" onchange="valida_correo(this.id, '#divResultAjaxLogin');" required autocomplete="on"></li>
		           			<li>Password</li>
		           			<li><input type="password" name="u-pass" id="u-pass" required></li>
		           			<li><br></li>
		           			<li><input type="button" class="btn btn-primary fileupload-exists" value="Ingresar" onclick="login('<?php echo base_url();?>login')"></li>
		           			<li><a href="#" id="botonPassword" >Olvidaste tu Password?</a></li>
		           		</ul>
		        </div>
		        <!--end div Login-->
		        <!--div recuperar password-->
		        <div id="divRecuperaPassword">
		        	<h2>Recuperar Password</h2>
		        	<br>
		        	<div id="divResultAjaxPassword" class="ajaxSucess"></div>
		        	<form id="formPassword" name="formPassword">
		        		<ul>
			        		<li>Ingresa tu Email para Recuperar tu Password</li>
			        		<li><input type="text" id="correoUsuario" onchange="valida_correo(this.id, '#divResultAjaxPassword');"></li>
			        		<li><br></li>
			        		<li><input type="button" class="btn btn-primary fileupload-exists" value="Envíar" onclick="recupera_password('<?php echo base_url()?>index/recuperar_password')"></li>
			        		<li><br><a href="#" id="botonLogin"><< Regresar a Login</a></li>
			        	</ul>
		        	</form>
		        </div>
		        <!--end div recuperar password-->
		    </div>
		</div>
		<!-- end popup login-->
		<!-- popup cerrar sesion -->
		<div id="popup-cerrar-sesion" style="display: none;">
		    <div class="content-popup-salir">
		        <div class="close"><a href="#" id="close-cerrar-sesion"><img src="<?php echo base_url();?>public/images/close.png"/></a></div>
		        <div id="salir">
		           <h2>Cerrar Sesión</h2>
		           		<br>
		           		<h3>Realmente Deseas Cerrar Sesión ?</h3>
		           		<input type="button" value="Aceptar" class="btn btn-primary fileupload-exists" onclick="cerrar_sesion('<?php echo base_url()?>index/cerrar_sesion');">
		           		<input type="button" value="Cancelar" class="btn btn-primary fileupload-exists" id="boton-cancela">
		        </div>
		    </div>
		</div>
		<!-- end cerrar sesion-->
		<!-- begin popup cambiar imagen de mi cuenta -->
		<div id="popup-avatar" style="display: none;">
		    <div class="content-popup-avatar">
		        <div class="close">
		        	<a href="#" id="close-avatar"><img src="<?php echo base_url();?>public/images/close.png"/></a>
		        </div>
		        <div>
		           <h2>Cambiar Imagen de Mi Cuenta</h2>
		           <p>Imagen Actual:</p>
		           <?
					if( $datosUser->avatar !="" ){
						?>
						<a href="#"><img class="imgAvatar" src="./uploads/avatar/<?php echo $datosUser->avatar;?>"></a>
						<?php
					}
					else{
						?>
						<a href="#"><img class="imgAvatar" src="<?php echo base_url()?>public/images/avatar-default.png"></a>
						<?php
					}
					$atributos = array( 'id' => 'formAvatar','name'=>'formAvatar');
					echo form_open_multipart(base_url()."miperfil/upload",$atributos);
					?>
					<br>
					<p>Selecciona Imagen Nueva: <input type="file" id="avatar" name="avatar"></p>
					<input type="submit" value="Actualizar Imagen" id="submitAvatar" name="submitAvatar" title="Subit Imagen" class="btn btn-primary fileupload-exists">
					<br>
					<div id="divUploadAvatar" style="display:none"><br>Subiendo Imagen <img src="<? echo base_url()?>public/images/loading-barra.gif"></div>
					<?=form_close()?>
				</div>
		    </div>
		</div>
		<!-- end popup Avatar-->