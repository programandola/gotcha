<div class="container">
	<div id="credit" class="clearfix">			    
		<div class="credit-left">
			<span class="the-year">© 2015</span> - <a href="http://www.gotcha.com.mx" title="">Gotcha.MX</a>
			<ul class="ulNavFooter">
				<li><a href="<? echo base_url()?>index/info/terminosycondiciones">Terminos y Condiciones de Uso</a></li>
				<li><a href="<? echo base_url()?>index/info/privacidadatos">Privacidad de Datos Personales</a></li>
				<li><a href="<? echo base_url()?>index/info/politicasprivacidad">Políticas de Privacidad</a></li>
				<?php
				if( $this->session->userdata('login') ){
				?>
					<li><a href="<?php echo base_url()?>anunciar">Anuncia tu campo</a></li>
				<?
				}else{
					?>
					<li><a href="javascript:void(0);" onclick="open_registro();" rel="bookmark">Anúnciate</a></li>
					<?
				}
				?>
				<li><a href="<? echo base_url()?>index/info/contactanos">Suscribete al boletín</a></li>
				<li><a href="<? echo base_url()?>index/info/contactanos">Contactanos</a></li>
			</ul>
		</div>
		<div class="credit-right">
				<a href="http://www.fb.com/interhabita" target="_blank"><img title="Siguenos en Facebook" alt="Siguenos en Facebook" src="http://interhabita.com/public/images/social-fb.png" style="max-height:48px; vertical-align: middle; float:left;"></a>
				<a href="http://www.torressilvestre.com" target="_blank">Diseño y Desarrollo: <img title="Diseñador Web, Desarrollo Web" alt="Diseñador Web" src="http://www.torressilvestre.com/ilovo.png" style="max-height:30px; vertical-align: middle;"></a>
			<ul>
				<li style="text-align:left;padding-top: 15px;"><p>&copy; Todos los Derechos Reservados de WCE TECH S.A. de C.V.</p><p> Prohibida la Reproducción total ó parcial, incluyendo cualquier medio electrónico ó magnético.</p></li>
			</ul>
		</div>	
	</div><!-- #credit -->	
</div><!-- .container -->