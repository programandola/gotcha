<div class="container">
	<div id="top" class="row">
		<div id="top-logo" class="span4">
			<div id="logo"><a href="<?php echo base_url()?>" title="">
				<img src="<?php echo base_url()?>public/images/logo.jpg" alt=""></a>
			</div>
			<!-- #logo -->		
		</div><!-- #top-logo -->
		
		<div id="top-menu" class="span8">
			<div class="wpsight-menu wpsight-menu-main">
				<ul id="menu-top" class="sf-menu sf-js-enabled l_tinynav1">
					<?php
						if( $this->session->userdata('login') ){
							?>
							<li id="menu-item-21" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-21"><a href="<?php echo base_url()?>miperfil" title="Mi cuenta"><?php echo $this->session->userdata('login')?></a></li>
							<?php
							if( $this->session->userdata('nivelUser') == 1){
								?>
								<li id="menu-item-21" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-21"><a href="<?php echo base_url()?>anunciar" title="Publicar Anuncio">Publicar Anuncio</a></li>
								<?php
							}
						}
						else{
						?>
						<li id="menu-item-21" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-21"><a href="#" id="open-login" title="Ingresar">Ingresar</a></li>
						<li id="open-registro" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-21"><a href="#" title="Publicar Anuncio">Publicar Anuncio</a></li>
				<?php
				}
				?>
				</ul>
			</div><!--#wpsight-->
		</div><!-- #top-menu -->
	</div><!-- #top -->	
</div><!-- .container -->