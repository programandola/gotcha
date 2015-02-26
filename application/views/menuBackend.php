<div class="container">
	<div id="contentMenu">
		<ul>
		<?php
		//para perfilar los niveles de usuarios cliente, anunciante y administrador
		switch ($this->session->userdata('nivelUser')) {
			case '1'://para el backend de Anunciantes
					if($this->uri->segment(1)=="miperfil"){
						?>
						<li class="lihover"><a href="<?php echo base_url()?>miperfil">Mi Cuenta</a></li>
						<?
					}else{
						?>
						<li><a href="<?php echo base_url()?>miperfil">Mi Cuenta</a></li>
						<?
					}
					if($this->uri->segment(1)=="anunciar"){
						?>
						<li class="lihover"><a href="<?php echo base_url()?>anunciar">Publicar Anuncio</a></li>
						<?
					}else{
						?>
						<li><a href="<?php echo base_url()?>anunciar">Publicar Anuncio</a></li>
						<?
					}
					if($this->uri->segment(1)=="misanuncios"){
						?>
						<li class="lihover"><a href="<?php echo base_url()?>misanuncios">Anuncios Publicados</a></li>
						<?
					}else{
						?>
						<li><a href="<?php echo base_url()?>misanuncios">Anuncios Publicados</a></li>
						<?
					}
					if($this->uri->segment(1)=="solicitantes"){
						?>
						<li class="lihover"><a href="<?php echo base_url()?>solicitantes/index/spago">Mis Solicitantes</a></li>
						<?
					}else{
						?>
						<li><a href="<?php echo base_url()?>solicitantes/index/spago">Mis Solicitantes</a></li>
						<?
					}
					?>
					<li><a href="#" id="cerrar-sesion"  title="Cerrar Sesión">Cerrar Sesión</a></li>
					<?
				break;
			case '2'://para el backend de Clientes
				if($this->uri->segment(1)=="miperfil"){
							?>
							<li class="lihover"><a href="<?php echo base_url()?>miperfil">Mi Cuenta</a></li>
							<?
						}else{
							?>
							<li><a href="<?php echo base_url()?>miperfil">Mi Cuenta</a></li>
							<?
						}
						if($this->uri->segment(1)=="mispropiedades"){
							?>
							<li class="lihover"><a href="<?php echo base_url()?>mispropiedades">Mis Propiedades</a></li>
							<?
						}else{
							?>
							<li><a href="<?php echo base_url()?>mispropiedades">Mis Propiedades</a></li>
							<?
						}
						if($this->uri->segment(1)=="favoritos"){
							?>
							<li class="lihover"><a href="<?php echo base_url()?>interesados">Favoritos</a></li>
							<?
						}else{
							?>
							<li><a href="<?php echo base_url()?>favoritos">Favoritos</a></li>
							<?
						}
				break;
			case '3'://para el backend del Administrador
					if($this->uri->segment(1)=="miperfil"){
						?>
						<li class="lihover"><a href="<?php echo base_url()?>miperfil">Mi Cuenta</a></li>
						<?
					}else{
						?>
						<li><a href="<?php echo base_url()?>miperfil">Mi Cuenta</a></li>
						<?
					}
					if($this->uri->segment(1)=="anunciantes"){
						?>
						<li class="lihover"><a href="<?php echo base_url()?>anunciantes">Anunciantes</a></li>
						<?
					}else{
						?>
						<li><a href="<?php echo base_url()?>anunciantes">Anunciantes</a></li>
						<?
					}
					if($this->uri->segment(1)=="interesados"){
						?>
						<li class="lihover"><a href="<?php echo base_url()?>interesados">Solicitantes</a></li>
						<?
					}else{
						?>
						<li><a href="<?php echo base_url()?>interesados">Solicitantes</a></li>
						<?
					}
					?>
					<li><a href="#" id="cerrar-sesion"  title="Cerrar Sesión">Cerrar Sesión</a></li>
					<?
				break;
			case '4'://para el backend del Root
					if($this->uri->segment(1)=="miperfil"){
						?>
						<li class="lihover"><a href="<?php echo base_url()?>miperfil">Mi Cuenta</a></li>
						<?
					}else{
						?>
						<li><a href="<?php echo base_url()?>miperfil">Mi Cuenta</a></li>
						<?
					}
					if($this->uri->segment(1)=="anunciantes"){
						?>
						<li class="lihover"><a href="<?php echo base_url()?>anunciantes">Anunciantes</a></li>
						<?
					}else{
						?>
						<li><a href="<?php echo base_url()?>anunciantes">Anunciantes</a></li>
						<?
					}
					if($this->uri->segment(1)=="interesados"){
						?>
						<li class="lihover"><a href="<?php echo base_url()?>interesados">Solicitantes</a></li>
						<?
					}else{
						?>
						<li><a href="<?php echo base_url()?>interesados">Solicitantes</a></li>
						<?
					}
					if($this->uri->segment(1)=="Propiedades"){
						?>
						<li class="lihover"><a href="<?php echo base_url()?>Propiedades">Propiedades</a></li>
						<?
					}else{
						?>
						<li><a href="<?php echo base_url()?>Propiedades">Propiedades</a></li>
						<?
					}
					if($this->uri->segment(1)=="pagos"){
						?>
						<li class="lihover"><a href="<?php echo base_url()?>pagos">Pagos</a></li>
						<?
					}else{
						?>
						<li><a href="<?php echo base_url()?>pagos">Pagos</a></li>
						<?
					}
					if($this->uri->segment(1)=="ordencompra"){
						?>
						<li class="lihover"><a href="<?php echo base_url()?>ordencompra">Depósitos</a></li>
						<?
					}else{
						?>
						<li><a href="<?php echo base_url()?>ordencompra">Depósitos</a></li>
						<?
					}
					if($this->uri->segment(1)=="costotransaccion"){
						?>
						<li class="lihover"><a href="<?php echo base_url()?>costotransaccion">Costo Transacción</a></li>
						<?
					}else{
						?>
						<li><a href="<?php echo base_url()?>costotransaccion">Costo Transacción</a></li>
						<?
					}
					?>
					<li><a href="#" id="cerrar-sesion"  title="Cerrar Sesión">Cerrar Sesión</a></li>
					<?
				break;
		}//end switch niveles de usuario
		?>
	</div>
</div>
