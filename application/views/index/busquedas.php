
	<body class="home blog boxed layout-three" style="">
		<?php
			$this->load->view('pop-ups.php');
		?>
		<div id="outer">

			
			<div id="container-wrap-header">
				<div id="top-wrap" class="wrap">
					<?php
						$this->load->view('header.php');
					?>
				</div><!-- #top-wrap -->

				<div id="header-wrap" class="wrap">
					<?php
						$this->load->view('header-buscador.php')
					?>
				</div><!-- #header-wrap -->
			</div><!-- #container-wrap-header -->

	<div id="submenu-wrap" class="wrap">
		<?php
			$this->load->view('nav.php');
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
							
								<?php

								$search="";
								
								if(count($resultBusqueda)>0){
									//validamos que variables se enviaron y las agregamos al array
									$gets=array();

									$search="?bus=";
									
									if(isset($_GET["estados"]) && $_GET["estados"]!=""){
										$gets['id_estado']=$_GET["estados"];
										$search.="&estados=".$_GET["estados"];
									}
									if(isset($_GET["delegaciones"]) && $_GET["delegaciones"]!=""){
										$gets['id_delegaciones']=$_GET["delegaciones"];
										$search.="&delegaciones=".$_GET["delegaciones"];
									}
									if(isset($_GET["colonias"]) && $_GET["colonias"]!=""){
										$gets['id_colonias']=$_GET["colonias"];
										$search.="&colonias=".$_GET["colonias"];
									}
									if(isset($_GET["tipoOperacion"]) && $_GET["tipoOperacion"]!=""){
										$gets['tipo_operacion']=$_GET["tipoOperacion"];
										$search.="&tipoOperacion=".$_GET["tipoOperacion"];
									}
									if(isset($_GET["tipoPropiedades"]) && $_GET["tipoPropiedades"]!=""){
										$gets['id_categoria']=$_GET["tipoPropiedades"];
										$search.="&tipoPropiedades=".$_GET["tipoPropiedades"];
									}
									if(isset($_GET["recamaras"]) && $_GET["recamaras"]!=""){
										$gets['num_recamaras']=$_GET["recamaras"];
										$search.="&recamaras=".$_GET["recamaras"];
									}
									if(isset($_GET["autos"]) && $_GET["autos"]!=""){
										$gets['num_autos']=$_GET["autos"];
										$search.="&autos=".$_GET["autos"];
									}
									if(isset($_GET["banos"]) && $_GET["banos"]!=""){
										$gets['num_banos']=$_GET["banos"];
										$search.="&banos=".$_GET["banos"];
									}
									if(isset($_GET["antiguedad"]) && $_GET["antiguedad"]!=""){
										$gets['antiguedad']=$_GET["antiguedad"];
										$search.="&antiguedad=".$_GET["antiguedad"];
									}
									if(isset($_GET["metros"]) && $_GET["metros"]!=""){
										$gets['m2_terreno']=$_GET["metros"];
										$search.="&metros=".$_GET["metros"];
									}
									if(isset($_GET["precio"]) && $_GET["precio"]!=""){
										$gets['precio']=$_GET["precio"];
										$search.="&precio=".$_GET["precio"];
									}

									?>
									<!-- begin divFrontResultSearch -->
									<div class="divFrontResultSearch">
										<!-- begin divLeft -->
										<div class="divLeft">

											<?php
											//DELETE FILTROS
											if(! empty($_GET)){
												?>
												<?php
												// delete filtros para estados
												if(isset($_GET["estados"]) && $_GET["estados"]!=""){
													$estado=$this->propiedades_model->get_estado_por_id($_GET["estados"]);
													?>
													<div class="divFiltroAdd">
														<h2><? echo $estado->nombre ?></h2> 
														<a href="<? echo base_url()?>index/busquedas<? echo $search?>&amp;estados=" title="Quitar Filtro Estados"><img src="<? echo base_url()?>public/images/pin.png"></a>
													</div>
													<?
												}
												// delete filtros delegaciones
												if(isset($_GET["delegaciones"]) && $_GET["delegaciones"]!=""){
													$del=$this->propiedades_model->get_delegacion_por_id($_GET["delegaciones"]);
													?>
													<div class="divFiltroAdd">
														<h2><? echo $del->nombre ?></h2> 
														<a href="<? echo base_url()?>index/busquedas<? echo $search?>&amp;delegaciones=" title="Quitar Filtro Delegaciones"><img src="<? echo base_url()?>public/images/pin.png"></a>
													</div>
													<?
												}
												//delete filtros tipo de operacion
												if(isset($_GET["tipoOperacion"]) && $_GET["tipoOperacion"]!=""){
													?>
													<div class="divFiltroAdd">
														<h2><? echo $_GET["tipoOperacion"]?></h2> 
														<a href="<? echo base_url()?>index/busquedas<? echo $search?>&amp;tipoOperacion=" title="Quitar Filtro Tipo Operación"><img src="<? echo base_url()?>public/images/pin.png"></a>
													</div>
													<?
												}
												//delete filtros para las colonias 
												if(isset($_GET["colonias"]) && $_GET["colonias"]!=""){
													$col=$this->propiedades_model->get_colonia_por_id($_GET["colonias"]);
													?>
													<div class="divFiltroAdd">
														<h2><? echo $col->nombre ?></h2> 
														<a href="<? echo base_url()?>index/busquedas<? echo $search?>&amp;colonias=" title="Quitar Filtro Zona"><img src="<? echo base_url()?>public/images/pin.png"></a>
													</div>
													<?
												}
												//delete filtros para tipo de propiedad 
												if(isset($_GET["tipoPropiedades"]) && $_GET["tipoPropiedades"]!=""){
													$tipoPro=$this->propiedades_model->get_tipo_propiedad_por_id($_GET["tipoPropiedades"]);
													?>
													<div class="divFiltroAdd">
														<h2><? echo $tipoPro->nombre ?></h2> 
														<a href="<? echo base_url()?>index/busquedas<? echo $search?>&amp;tipoPropiedades=" title="Quitar Filtro Tipo Propiedad"><img src="<? echo base_url()?>public/images/pin.png"></a>
													</div>
													<?
												}
												//delete filtros precio
												if(isset($_GET["precio"]) && $_GET["precio"]!=""){
													?>
													<div class="divFiltroAdd">
														<h2><? echo $_GET["precio"] ?></h2> 
														<a href="<? echo base_url()?>index/busquedas<? echo $search?>&amp;precio=" title="Quitar Filtro Precio"><img src="<? echo base_url()?>public/images/pin.png"></a>
													</div>
												<?php
												}
												//delete filtros recamaras 
												if(isset($_GET["recamaras"]) && $_GET["recamaras"]!=""){
													?>
													<div class="divFiltroAdd">
														<h2><? echo $_GET["recamaras"]?> Recamaras</h2> 
														<a href="<? echo base_url()?>index/busquedas<? echo $search?>&amp;recamaras=" title="Quitar Filtro Recamaras"><img src="<? echo base_url()?>public/images/pin.png"></a>
													</div>
													<?
												}
												//delete filtros autos 
												if(isset($_GET["autos"]) && $_GET["autos"]!=""){
													?>
													<div class="divFiltroAdd">
														<h2><? echo $_GET["autos"]?> Autos</h2> 
														<a href="<? echo base_url()?>index/busquedas<? echo $search?>&amp;autos=" title="Quitar Filtro Autos"><img src="<? echo base_url()?>public/images/pin.png"></a>
													</div>
													<?
												}
												//delete filtros baños 
												if(isset($_GET["banos"]) && $_GET["banos"]!=""){
													?>
													<div class="divFiltroAdd">
														<h2><? echo $_GET["banos"]?> Baños</h2> 
														<a href="<? echo base_url()?>index/busquedas<? echo $search?>&amp;banos=" title="Quitar Filtro Baños"><img src="<? echo base_url()?>public/images/pin.png"></a>
													</div>
													<?
												}
												//delete filtros antiguedad 
												if(isset($_GET["antiguedad"]) && $_GET["antiguedad"]!=""){
													?>
													<div class="divFiltroAdd">
														<h2>Entre <? echo $_GET["antiguedad"]?> Años</h2> 
														<a href="<? echo base_url()?>index/busquedas<? echo $search?>&amp;antiguedad=" title="Quitar Filtro Antiguedad"><img src="<? echo base_url()?>public/images/pin.png"></a>
													</div>
													<?
												}
												//delete filtros metros totales 
												if(isset($_GET["metros"]) && $_GET["metros"]!=""){
													?>
													<div class="divFiltroAdd">
														<h2>Entre <? echo $_GET["metros"]?> Metros</h2> 
														<a href="<? echo base_url()?>index/busquedas<? echo $search?>&amp;metros=" title="Quitar Filtro Metros Totales"><img src="<? echo base_url()?>public/images/pin.png"></a>
													</div>
													<?
												}
											}
											


											//ADD FILTROS
											//add filtros para estados 
											if(empty($_GET["estados"])){
												$estados=$this->propiedades_model->filtro_estados($gets);
												if( count($estados) > 0 ){
													?>
													<div>
														<h2><a href="javascript:void(0);" onclick="show_hide_filtro('ulEstados')"><img src="<?php echo base_url()?>public/images/bullet-map.png" id="imgBtnRec"> Estados</a></h2>
														<ul id="ulEstados">
															<?php
															foreach ( $estados as $key => $value ) {
																if ( $value != 0 ) {//para no mostrar los resultados vacios
																	$idEstado=$this->propiedades_model->get_id_estado_por_nombre($key);
																?>
																	<li>
																		<a href="<? echo base_url()?>index/busquedas<? echo $search?>&amp;estados=<? echo $idEstado->id_estado ?>" title="<? echo $key?>"> <? echo $key?> <b>(<? echo $value?>)</b></a>
																	</li>
																<?php
																}
															}
															?>
														</ul>
													</div>
													<?php
												}
											}
											//add filtros delegaciones 
											if(! empty($_GET["estados"]) && empty($_GET["delegaciones"]) ){
													$delegaciones=$this->propiedades_model->filtro_delegaciones($gets);
													if( count($delegaciones) > 0 ){
														?>
														<div>
															<h2><a href="javascript:void(0);" onclick="show_hide_filtro('ulEstados')"><img src="<?php echo base_url()?>public/images/bullet-del.png" id="imgBtnRec"> Delegaciones</a></h2>
															<ul id="ulEstados">
																<?php
																foreach ( $delegaciones as $key => $value ) {
																	if ( $value != 0 ) {//para no mostrar los resultados vacios
																		$idDel=$this->propiedades_model->get_id_delegacion_por_nombre($key);
																	?>
																		<li>
																			<a href="<? echo base_url()?>index/busquedas<? echo $search?>&amp;delegaciones=<? echo $idDel->id_delegaciones ?>" title="<? echo $key?>"> <? echo $key?> <b>(<? echo $value?>)</b></a>
																		</li>
																	<?php
																	}
																}
																?>
															</ul>
														</div>
														<?php
													}
												
											}
											//add filtros para zona ó colonias
											if(empty($_GET["colonias"])){
												if( ! empty($gets["id_delegaciones"]) ){
													$zona=$this->propiedades_model->filtro_zona($gets);
													if( count($zona) > 0 ){
														?>
														<div>
															<h2><a href="javascript:void(0);" onclick="show_hide_filtro('ulZona')"><img src="<?php echo base_url()?>public/images/flecha_derecha.jpg" id="imgBtnRec"> Zona</a></h2>
															<ul id="ulZona">
																<?php
																foreach ( $zona as $key => $value ) {
																	if ( $value != 0 ) {//para no mostrar los resultados vacios
																		//extraigo el id de la colonia
																		$idCol=$this->propiedades_model->get_id_colonias_por_nombre($key);
																	?>
																		<li>
																			<a href="<? echo base_url()?>index/busquedas<? echo $search?>&amp;colonias=<? echo $idCol->id_colonias ?>" title="<? echo $key?>"> <? echo $key?> <b>(<? echo $value?>)</b></a>
																		</li>
																	<?php
																	}
																}
																?>
															</ul>
														</div>
														<?php
													}

												}
												
											}
											//add filtros para tipo de operacion
											if(empty($_GET["tipoOperacion"])){
												$tipo=$this->propiedades_model->filtro_tipo_operacion($gets);
												if( count($tipo) > 0 ){
													?>
													<div>
														<h2><a href="javascript:void(0);" onclick="show_hide_filtro('ulTipoOperacion')"><img src="<?php echo base_url()?>public/images/bullet-ope.png" id="imgBtnRec"> Tipo Operación</a></h2>
														<ul id="ulTipoOperacion">
															<?php
															foreach ( $tipo as $key => $value ) {
																if ( $value != 0 ) {//para no mostrar los resultados vacios
																	$operacion=explode(" ",$key);
																?>
																	<li>
																		<a href="<? echo base_url()?>index/busquedas<? echo $search?>&amp;tipoOperacion=<? echo $operacion[0] ?>" title="<? echo $key?>"> <? echo $key?> <b>(<? echo $value?>)</b></a>
																	</li>
																<?php
																}
															}
															?>
														</ul>
													</div>
													<?php
												}
											}
											
											//add filtros para tipo de propiedad
											
											if(empty($_GET["tipoPropiedades"])){ 
												$propiedad=$this->propiedades_model->filtro_tipo_propiedad($gets);
												if( count($propiedad) > 0 ){
													?>
													<div>
														<h2><a href="javascript:void(0);" onclick="show_hide_filtro('ulTipoPropiedad')"><img src="<?php echo base_url()?>public/images/bullet-pro.png" id="imgBtnRec"> Tipo Propiedad</a></h2>
														<ul id="ulTipoPropiedad">
															<?php
															foreach ( $propiedad as $key => $value ) {
																if ( $value != 0 ) {//para no mostrar los resultados vacios
																	//$prop=explode(" ", $key);
																	$cats=$this->propiedades_model->get_id_tipo_propiedad_por_nombre($key);
																?>
																	<li>
																		<a href="<? echo base_url()?>index/busquedas<? echo $search ?>&amp;tipoPropiedades=<? echo $cats->id_categoria?>" title="<? echo $key?>"> <? echo $key?> <b>(<? echo $value?>)</b></a>
																	</li>
																<?php
																}
															}
															?>
														</ul>
													</div>
													<?php
													
												}
											}
											
											//add filtros para precio
											if(empty($_GET["precio"])){ 
												?>
												<div>
													<h2><a href="javascript:void(0);" onclick="show_hide_filtro('ulPrecio')"><img src="<?php echo base_url()?>public/images/bullet-pre.png" id="imgBtnRec"> Precio</a></h2>
													<ul id="ulPrecio">
														<li><input type="text" style="width:60px" placeholder="min" id="precioMin"> a <input style="width:60px" type="text" placeholder="max" id="precioMax"> <a href="javascript:void(0);" onclick="filtro_precio('<? echo base_url()."index/busquedas".$search?>')">Ir</a></li>
													</ul>
												</div>

												<?php

											}
											
											//add filtros recamaras
											if(empty($_GET["recamaras"])){ 
												$recamaras=$this->propiedades_model->filtro_recamaras($limiteRecamaras=10, $gets);
												if( count($recamaras) > 0 ){
													?>
													<div>
														<h2><a href="javascript:void(0);" onclick="show_hide_filtro('ulRecamaras')"><img src="<?php echo base_url()?>public/images/bullet-rec.png" id="imgBtnRec"> Recamaras</a></h2>
														<ul id="ulRecamaras">
															<?php
															foreach ( $recamaras as $key => $value ) {
																if ( $value != 0 ) {
																	if($key==1){ $label="Recámara"; }else{ $label="Recámaras"; }
																	$num=explode(" ", $key);
																?>
																	<li>
																		<a href="<? echo base_url()?>index/busquedas<? echo $search?>&amp;recamaras=<? echo $num[0] ?>" title="<? echo $key." ".$label?> "><? echo $key." ".$label ?> <b>(<? echo $value?>)</b></a>
																	</li>
																<?php
																}
															}
															?>
														</ul>
													</div>
													<?php
												}
											}
											//add filtros autos
											if(empty($_GET["autos"])){ 
												$autos=$this->propiedades_model->filtro_autos($limiteAutos=10, $gets);
												if( count($autos) > 0 ){
													?>
													<div>
														<h2><a href="javascript:void(0);" onclick="show_hide_filtro('ulAutos')"><img src="<?php echo base_url()?>public/images/bullet-car.png" id="imgBtnRec"> Estacionamiento</a></h2>
														<ul id="ulAutos">
															<?php
															foreach ( $autos as $key => $value ) {
																if ( $value != 0 ) {
																	if($key==1){ $label="Auto"; }else{ $label="Autos"; }
																?>
																	<li>
																		<a href="<? echo base_url()?>index/busquedas<? echo $search?>&amp;autos=<? echo $key ?>" title="Para <? echo $key." ".$label ?>">Para <? echo $key." ".$label ?> <b>(<? echo $value?>)</b></a>
																	</li>
																<?php
																}
															}
															?>
														</ul>
													</div>
													<?php
												}
											}
											//add filtros baños
											if(empty($_GET["banos"])){ 
												$banos=$this->propiedades_model->filtro_banos($limiteBanos=10, $gets);
												if( count($banos) > 0 ){
													?>
													<div>
														<h2><a href="javascript:void(0);" onclick="show_hide_filtro('ulBanos')"><img src="<?php echo base_url()?>public/images/bullet-bano.png" id="imgBtnRec"> Baños</a></h2>
														<ul id="ulBanos">
															<?php
															foreach ( $banos as $key => $value ) {
																if ( $value != 0 ) {
																	if($key==1){ $label="Baño"; }else{ $label="Baños"; }
																	$num=explode(" ", $key);
																?>
																	<li>
																		<a href="<? echo base_url()?>index/busquedas<? echo $search?>&amp;banos=<? echo $num[0] ?>" title="<? echo $key." ".$label ?>"><? echo $key." ".$label ?> <b>(<? echo $value?>)</b></a>
																	</li>
																<?php
																}
															}
															?>
														</ul>
													</div>
													<?php
												}
											}
											//add filtros antiguedad
											if(empty($_GET["antiguedad"])){ 
												$antiguedad=$this->propiedades_model->filtro_antiguedad($gets);
												if( count($antiguedad) > 0 ){
													?>
													<div>
														<h2><a href="javascript:void(0);" onclick="show_hide_filtro('ulAntiguedad')"><img src="<?php echo base_url()?>public/images/bullet-ant.png" id="imgBtnRec"> Antigüedad</a></h2>
														<ul id="ulAntiguedad">
															<?php
															foreach ( $antiguedad as $key => $value ) {
																if ( $value != 0 ) {//para no mostrar los resultados vacios
																	$num=explode(",", $key);
																	$key=str_replace(",", " y ", $key);
																?>
																	<li>
																		<a href="<? echo base_url()?>index/busquedas<? echo $search?>&amp;antiguedad=<? echo $num[0]."-".$num[1] ?>" title="Entre <? echo $key." años" ?>">Entre <? echo $key." años"?> <b>(<? echo $value?>)</b></a>
																	</li>
																<?php
																}
															}
															?>
														</ul>
													</div>
													<?php
												}
											}
											//add filtros metros totales
											if(empty($_GET["metros"])){
												$metros=$this->propiedades_model->filtro_metros_totales($gets);
												if( count($metros) > 0 ){
													?>
													<div>
														<h2><a href="javascript:void(0);" onclick="show_hide_filtro('ulMetros')"><img src="<?php echo base_url()?>public/images/bullet-m2.png" id="imgBtnRec"> Metros Totales</a></h2>
														<ul id="ulMetros">
															<?php
															foreach ( $metros as $key => $value ) {
																if ( $value != 0 ) {//para no mostrar los resultados vacios
																	$num=explode(",", $key);
																	$key=str_replace(",", " y ", $key)
																?>
																	<li>
																		<a href="<? echo base_url()?>index/busquedas<? echo $search?>&amp;metros=<? echo $num[0]."-".$num[1] ?>" title="Entre <? echo $key." m2" ?>">Entre <? echo $key." m2"?> <b>(<? echo $value?>)</b></a>
																	</li>
																<?php
																}
															}
															?>
														</ul>
													</div>
													<?php
												}
											}
											?>
										</div>
										<!-- end divLeft -->
										<!-- begin divRight -->
										<div class="divRight">
											<?php
											//paginacion de resultados 
											if(isset($_GET["pag"])){
												$this->paginador->inicio_limite_paginacion($_GET["pag"]);
											}else{
												$this->paginador->inicio_limite_paginacion();
											}
											
											//paginacion de resultados
											if($this->paginador->configPaginador["paginas"] > 1){
												//para los rangos de la paginación
												$rangos=$this->paginador->rango_paginacion(10, $this->paginador->configPaginador["paginas"], $this->paginador->configPaginador["paginaActual"]);
												if(count($rangos)>0){
													?>
													<div>
														<div class="paginacionLeft">
															<? echo "<h2 style='font-weight:normal'>".count($resultBusqueda)." Inmuebles Encontrados</h2>"; ?>
														</div>
														<div class="paginacionRight">
															<? echo "<h2 style='font-weight:normal'>Pagína ".$this->paginador->configPaginador["paginaActual"]." de ".$this->paginador->configPaginador["paginas"]."</h2>";?>
														</div>
													</div>
													<?
												}
												?>
												<!--begin ul paginacion-->
												<ul id="ulRangosPaginacionFront">
													
													<li>
														<?
														//mostramos el boton de primero y anterior si la pagina actual es >= a 2
														if($this->paginador->configPaginador["paginaActual"] >= 2){
															?>
															<!-- boton primero-->
															<a class="btn btn-primary fileupload-exists" title="Primero" href="<?php echo base_url()?>index/busquedas/<? echo $search ?>&amp;pag=1"><<</a>
															<!-- boton anterior-->
															<a class="btn btn-primary fileupload-exists" title="Anterior" href="<?php echo base_url()?>index/busquedas/<? echo $search ?>&amp;pag=<? echo $this->paginador->configPaginador["paginaActual"]-1; ?>"><</a>
															<?
														}
														for($i=0; $i< count($rangos); $i++){
															if($rangos[$i]==$this->paginador->configPaginador["paginaActual"]){
																echo "<b>".$rangos[$i]."</b>";
															}
															else{
																?>
																<a class="btn btn-primary fileupload-exists" style="font-size:10px" title="Pagina <? echo $rangos[$i]?>" href="<?php echo base_url()?>index/busquedas/<? echo $search ?>&amp;pag=<?php echo $rangos[$i]?>"><?php echo $rangos[$i];?></a>
																<?php
															}
														}
														//mostramos el boton de siguiente y ultimo si el numero total de paginas es > a 2
														if($this->paginador->configPaginador["paginas"] > 2){
															//boton siguiente
															if($this->paginador->configPaginador["paginas"] > $this->paginador->configPaginador["paginaActual"] ){
																?>
																<a class="btn btn-primary fileupload-exists" title="Siguiente" href="<?php echo base_url()?>index/busquedas/<? echo $search ?>&amp;pag=<? echo $this->paginador->configPaginador["paginaActual"]+1; ?>">></a>
																<!-- boton ultimo-->
																<a class="btn btn-primary fileupload-exists" title="Ultimo" href="<?php echo base_url()?>index/busquedas/<? echo $search ?>&amp;pag=<? echo $this->paginador->configPaginador["paginas"]; ?>">>></a>
															<?
															}
														}
														?>
													</li>
												</ul>
												<!--end ul paginacion-->
												<?
											}

											//mostrar el total de registros encontrados
											if($this->paginador->configPaginador["paginas"] == 1){
												if(count($resultBusqueda)==1){
													$texto="Inmueble Encontrado";
												}else{
													$texto="Inmuebles Encontrados";
												}
												echo "<h2 style='font-weight:normal'>".count($resultBusqueda)." ".$texto."</h2><br>";
											}

											//llamo al metodo buscador con parametro de resultados con limit
											$resultBusqueda=$this->propiedades_model->buscador($this->paginador->configPaginador["limiteInicio"]);

											foreach($resultBusqueda as $result){
												//imagen principal de la propiedad
												$imgPrincipal=$this->propiedades_model->get_foto_principal_no_principal_propiedades($result["id_propiedad"], "thumb");
												//extrae el nombre de la delegacion 
												$delegacion=$this->propiedades_model->get_delegacion_por_id($result["id_delegaciones"]);
												//extrae el nombre de la colonia 
												$colonia=$this->propiedades_model->get_colonia_por_id($result["id_colonias"]);
												//validar que se envie el tipo de propiedad y si no lo extraemos de la base de datos
												if(empty($nombreTipoPropiedad)){
													$nombreTipoPropiedad=$this->propiedades_model->get_tipo_propiedad_por_id($result["id_categoria"]);
												}
												?>
												<!-- begin divPropiedades -->
												<h1 class="titulopropiedad"><a href="<?php echo base_url();?>propiedades/index/<?php echo $nombreTipoPropiedad->nombre;?>/<?php echo $this->propiedades_model->texto_con_guion($result["nombre"])?>/<?php echo $result["id_propiedad"]?>" title="<?php echo $result["nombre"]?>"><?php echo $result["nombre"]?></a></h1>
												<div class="divPropiedades">
													<div id="divImg"> 
														<a href="<?php echo base_url();?>propiedades/index/<?php echo $nombreTipoPropiedad->nombre;?>/<?php echo $this->propiedades_model->texto_con_guion($result["nombre"])?>/<?php echo $result["id_propiedad"]?>"><img title="<?php echo $result["nombre"]?>" src="<?php echo base_url().$imgPrincipal?>"></a>
													</div>
													<div id="divContent">
														<?php
														$tipoProp=$this->propiedades_model->get_tipo_propiedad_por_id($result["id_categoria"]);
														?>
														<h3><? echo $tipoProp->nombre." en ".$result["tipo_operacion"] ?> <? if(!empty($colonia)){echo $colonia->nombre;} echo ", "; if(!empty($delegacion)){ echo $delegacion->nombre; } ?></h3>
														<div class="preciolista">$ <?php echo number_format($result["precio"])?> MXN</div>
														<div>
															<p>
																<textarea style="background-color:white; width:97%; height:60px; resize: none;" name="" disabled><?php echo nl2br( $this->propiedades_model->recorta_cadena($result["descripcion"],256) );?></textarea>
															</p>
														</div>
													</div>
													<div style="clear: both"></div>
													<div id="divfav">
														<?php
														if(isset($this->session->userdata["idUser"])){
															//validar cuales propiedades estan como favoritos del usuario que inicio sesion
															$favoritos=$this->propiedades_model->get_favoritos_por_id_usuario($this->session->userdata["idUser"]);
															$imgFavorito="";
															if(count($favoritos) > 0 ){
																foreach ($favoritos as $favorito) {
																	if($favorito["id_propiedad"]==$result["id_propiedad"]){
																		$imgFavorito="favoritos_add.png";
																		$title="Agregado en Favoritos";
																	}
																}
															}
															if($imgFavorito==""){
																$imgFavorito="favoritos.png";
																$title="Agregar a Favoritos";
															}
															?>
															<li><a href="javascript:void(0);" title="<?php echo $title?>" onclick="add_favorito('<?php echo base_url()?>favoritos/add_favoritos',<?php echo $result['id_propiedad']?>,<?php echo $this->session->userdata['idUser']?>);"><img src="<?php echo base_url()?>public/images/<?php echo $imgFavorito?>"></a></li>
															<?php
														}else{
															?>
															<li><a href="javascript:void(0);" title="Agregar a Favoritos" onclick="alert('Debes Ingresar Primero')"><img src="<?php echo base_url()?>public/images/favoritos.png"></a></li>
															<?php
														}
														?>	
													</div>
													<div id="divitems">
														<!-- Iconos DTS-->
														<ul>
															<li class="ilist iterreno" title="Terreno"> <?php echo $result["m2_terreno"]?></li>
															<li class="ilist iconstruccion" title="Área Construida"> <?php if($result["m2_construccion"]!=""){echo $result["m2_construccion"]."m<sup>2</sup>";}?></li>
															<li class="ilist ibanos" title="Baños"> <?php echo $result["num_banos"]?></li>
															<li class="ilist iantiguedad" title="Antiguedad"> <?php echo $result["antiguedad"]?></li>
															<li class="ilist irecamaras" title="Recamaras"> <?php echo $result["num_recamaras"]?></li>
															<li class="ilist Autos" title="Estacionamiento"> <?php echo $result["num_autos"]?></li>
														</ul>
													</div>
													<div clas="bt_listado">
														<input type="button" title="Detalles de <?php echo $result["nombre"];?>" value="Detalles" class="btn btn-primary fileupload-exists" onclick="redirect('<?php echo base_url();?>propiedades/index/<?php echo $nombreTipoPropiedad->nombre;?>/<?php echo $this->propiedades_model->texto_con_guion($result["nombre"])?>/<?php echo $result["id_propiedad"]?>')">
													</div>
												</div>
												<!-- end divPropiedades -->
									<?php
									}
									?>
									<div>
										<?php
										//paginacion de resultados 
										if(isset($_GET["pag"])){
											$this->paginador->inicio_limite_paginacion($_GET["pag"]);
										}else{
											$this->paginador->inicio_limite_paginacion();
										}
										
										//paginacion de resultados
										if($this->paginador->configPaginador["paginas"] > 1){
											//para los rangos de la paginación
											$rangos=$this->paginador->rango_paginacion(10, $this->paginador->configPaginador["paginas"], $this->paginador->configPaginador["paginaActual"]);
											
											?>
											<!--begin ul paginacion-->
											<ul id="ulRangosPaginacionFront">
												
												<li>
													<?
													//mostramos el boton de primero y anterior si la pagina actual es >= a 2
													if($this->paginador->configPaginador["paginaActual"] >= 2){
														?>
														<!-- boton primero-->
														<a class="btn btn-primary fileupload-exists" title="Primero" href="<?php echo base_url()?>index/busquedas/<? echo $search ?>&amp;pag=1"><<</a>
														<!-- boton anterior-->
														<a class="btn btn-primary fileupload-exists" title="Anterior" href="<?php echo base_url()?>index/busquedas/<? echo $search ?>&amp;pag=<? echo $this->paginador->configPaginador["paginaActual"]-1; ?>"><</a>
														<?
													}
													for($i=0; $i< count($rangos); $i++){
														if($rangos[$i]==$this->paginador->configPaginador["paginaActual"]){
															echo "<b>".$rangos[$i]."</b>";
														}
														else{
															?>
															<a class="btn btn-primary fileupload-exists" style="font-size:10px" title="Pagina <? echo $rangos[$i]?>" href="<?php echo base_url()?>index/busquedas/<? echo $search ?>&amp;pag=<?php echo $rangos[$i]?>"><?php echo $rangos[$i];?></a>
															<?php
														}
													}
													//mostramos el boton de siguiente y ultimo si el numero total de paginas es > a 2
													if($this->paginador->configPaginador["paginas"] > 2){
														//boton siguiente
														if($this->paginador->configPaginador["paginas"] > $this->paginador->configPaginador["paginaActual"] ){
															?>
															<a class="btn btn-primary fileupload-exists" title="Siguiente" href="<?php echo base_url()?>index/busquedas/<? echo $search ?>&amp;pag=<? echo $this->paginador->configPaginador["paginaActual"]+1; ?>">></a>
															<!-- boton ultimo-->
															<a class="btn btn-primary fileupload-exists" title="Ultimo" href="<?php echo base_url()?>index/busquedas/<? echo $search ?>&amp;pag=<? echo $this->paginador->configPaginador["paginas"]; ?>">>></a>
														<?
														}
													}
													?>
												</li>
											</ul>
											<!--end ul paginacion-->
											<?
										}
										?>
									</div>
									<?
								}
								else{
									echo "<h2>No se encontraron resultados de tu busqueda</h2>";
								}
								?>
								</div>
								<!-- end divRight -->
								<aside>
									<? $this->load->view('aside'); ?>
								</aside>
								
							</div>
							<!-- end  divFrontResultSearch-->

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
				<div style="left: 0;margin: 0; padding: 0;position: absolute;top: 0;width: 100%;"><div class="error"></div></div>
	</body>

