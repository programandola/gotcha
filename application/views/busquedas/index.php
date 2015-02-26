	<body class="home blog boxed layout-three" style="">
		<div id="outer">

			
			<div id="container-wrap-header">
				<div id="top-wrap" class="wrap">
					<div class="container">

						<div id="top" class="row">

							<div id="top-logo" class="span4">

								<div id="logo"><a href="#" title=""><img src="logo.png" alt=""></a></div><!-- #logo -->		
							</div><!-- #top-logo -->

							<div id="top-menu" class="span8">

								<div class="wpsight-menu wpsight-menu-main"><ul id="menu-top" class="sf-menu sf-js-enabled l_tinynav1"><li id="menu-item-21" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-21"><a href="#">Menu superior</a></li>
								</ul><select class="tinynav"><option value="#">&nbsp;Selecione una página…</option><option value="#">&nbsp;Menu superior</option></select></div>		
							</div><!-- #top-menu -->

						</div><!-- #top -->	
					</div><!-- .container -->
				</div><!-- #top-wrap -->

				<div id="header-wrap" class="wrap">
					<div class="container">

						<div id="header" class="clearfix">

							<div id="hero">La <em>casa</em> de tu sueños está <em>aquí</em>!</div><br>
							<div class="listing-search count-5 clearfix clear"><form method="get" action="./index_files/index.htm"><div class="form-inner"><div class="listing-search-main">
								<input type="text" class="listing-search-text text" name="textSearch" id="textSearch" title="Palavra chave ou ID do imóvel…" value="">
								<input type="button" class="listing-search-submit btn btn-large btn-primary" name="btonSearch" id="btonSearch" value="Buscar">
							</div><!-- .listing-search-main -->

							<div class="listing-search-details">
								<div class="listing-search-field listing-search-field-select listing-search-field-status"><select class="listing-search-status select" name="selectOperacion" id="selectOperacion">
									<option value="">Tipo</option>
									<option value="sale">Venta</option>
									<option value="rent">Renta</option>
								</select><!-- .listing-search-status -->
							</div><!-- .listing-search-field .listing-search-field-status -->
							<!-- .listing-search-field .listing-search-field-location --><div class="listing-search-field listing-search-field-taxonomy listing-search-field-property-type">
							<select class="listing-search-property-type select" name="selectPropiedades" id="selectPropiedades">
								<option value="">Propiedad</option>
								<?php foreach($tipo_propiedad as $tipo){?>
									<option value="<?php echo $tipo->id_categoria;?>"><?php echo $tipo->nombre;?></option>
								<?php
									}
								?>
							</select>
						
						</div><!-- .listing-search-field .listing-search-field-property-type -->
					<!-- .listing-search-property-type -->
					<div class="listing-search-field listing-search-field-taxonomy listing-search-field-location">
						<select class="listing-search-location select" name="selectEstados" id="selectEstados">
							<option value="">Ciudad/Estado</option>
							<?php foreach($estados as $estado){?>
								<option value="<?php echo $estado->id_estado;?>"><?php echo $estado->nombre;?></option>
							<?php
								}
							?>
						</select><!-- .listing-search-location -->
				</div>
				<div class="listing-search-field listing-search-field-select listing-search-field-details_1">
					<select class="listing-search-details_1 select" name="selectDelegaciones" id="selectDelegaciones">
						<option value="">Del/Municipio</option>
						
					</select><!-- .listing-search-details_1 -->
				
			</div><!-- .listing-search-field .listing-search-field-details_1 --><div class="listing-search-field listing-search-field-select listing-search-field-details_2"><select class="listing-search-details_2 select" name="selectColonias" id="selectColonias">
			<option value="">Colonia</option>
		</select><!-- .listing-search-details_2 -->
	</div><!-- .listing-search-field .listing-search-field-details_2 --></div><!-- .listing-search-details -->

	</div>
	</div><!-- .listing-search -->

	</div><!-- #header -->	</div><!-- .container -->
	</div><!-- #header-wrap -->

	</div><!-- #container-wrap-header --><div id="submenu-wrap" class="wrap">
	<div class="container">

		<div id="submenu">	
			<div class="wpsight-menu wpsight-menu-sub"><ul id="menu-submenu" class="sf-menu sf-js-enabled l_tinynav2"><li id="menu-item-76" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-76"><a href="#">Menu</a></li>

			</ul><select class="tinynav"><option value="#">&nbsp;Selecione uma página…</option><option value="http://vempracasa.com/imoveis/">&nbsp;Lista de Imóveis</option><option value="http://vempracasa.com/imobiliarias/">&nbsp;Imobiliárias</option><option value="http://vempracasa.com/mapa-de-imoveis/">&nbsp;Buscar no Mapa</option><option value="http://vempracasa.com/contato/" current-menu-item="true">&nbsp;Contato</option></select></div>		
		</div><!-- .submenu -->	</div><!-- .container -->
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

							<div id="wpsight-latest-listings-2" class="widget widget-latest widget-latest-listings row">						

								<div class="post-624 property type-property status-publish hentry span4 clear clearfix">

									<div class="widget-inner">

										<div class="post-image listing-image alignnone"><a href="#"><img src="img/1.jpg" class="attachment-post-thumbnail wp-post-image" alt="" title=""></a></div><!-- .post-image --> 					    		
										<h3 class="post-title">
											<a href="" title="ANUNCIANTES" rel="bookmark">
												ANUNCIANTES 				    			</a>
											</h3>


											<div class="post-teaser">
												<p>Puedes anunciar tus propiedades sin límite y gratuitamente de por vida. 
													Solo debes registrarte en “MI IRC”
													Activa alertas para que te avisemos en el momento en que un cliente este interesado en tu propiedad.
												</p>
											</div>


										</div><!-- .widget-inner -->

									</div><!-- .post-624 -->					    
									<div class="post-614 property type-property status-publish hentry span4 clearfix">

										<div class="widget-inner">

											<div class="post-image listing-image alignnone"><a href="#"><img src="img/1.jpg" class="attachment-post-thumbnail wp-post-image" alt="" title=""></a></div><!-- .post-image --> 					    		
											<h3 class="post-title">
												<a href="" title="ANUNCIANTES" rel="bookmark">
													ANUNCIANTES 				    			</a>
												</h3>


												<div class="post-teaser">
													<p>Puedes anunciar tus propiedades sin límite y gratuitamente de por vida. 
														Solo debes registrarte en “MI IRC”
														Activa alertas para que te avisemos en el momento en que un cliente este interesado en tu propiedad.
													</p>
												</div>


											</div><!-- .widget-inner -->

										</div><!-- .post-614 -->					    
										<div class="post-605 property type-property status-publish hentry span4 clearfix">

											<div class="widget-inner">

												<div class="post-image listing-image alignnone"><a href="#"><img src="img/1.jpg" class="attachment-post-thumbnail wp-post-image" alt="" title=""></a></div><!-- .post-image --> 					    		
												<h3 class="post-title">
													<a href="" title="ANUNCIANTES" rel="bookmark">
														ANUNCIANTES 				    			</a>
													</h3>


													<div class="post-teaser">
														<p>Puedes anunciar tus propiedades sin límite y gratuitamente de por vida. 
															Solo debes registrarte en “MI IRC”
															Activa alertas para que te avisemos en el momento en que un cliente este interesado en tu propiedad.
														</p>
													</div>


												</div><!-- .widget-inner -->

											</div><!-- .post-605 -->					    

										</div><!-- .post-585 -->				
									</div><!-- .widget -->
								</div><!-- .widget-wrap -->		



							</div><!-- .widget-wrap -->	</div><!-- #main-bottom -->	</div><!-- .container -->
						</div><!-- #main-bottom-wrap -->

					</div><!-- #main-wrap -->

				</div><!-- #container-wrap-main --><div id="footer-bottom-wrap" class="wrap">
				<div class="container">


					<div id="bottom-menu">

						
					</div><!-- #bottom-menu -->		
				</div><!-- #footer-bottom -->	</div><!-- .container -->
			</div><!-- #footer-bottom-wrap -->

			<div id="credit-wrap" class="wrap">
				<div class="container">

					<div id="credit" class="clearfix">			    
						<div class="credit-left">

							<span class="the-year">© 2014</span> - <a href="#" title="">Home Business</a>

						</div>
						<div class="credit-right"><a href="#" target="_blank">
							<img title="Sistema para imobiliarias" alt="" src="#">
						</a></div>	</div><!-- #credit -->	</div><!-- .container -->
					</div><!-- #credit-wrap -->


				</div><!-- #outer -->
	</body>

