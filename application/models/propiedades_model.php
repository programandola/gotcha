<?php
class Propiedades_model Extends CI_Model{

	function __construct(){
		parent::__construct();
		$this->layout->setLayout('template');
		$this->load->helper("file");
		$paginador=new Paginador();
	}


	public function get_tipo_propiedad(){
		$query=$this->db
		->select("id_categoria, nombre")
		->from("propiedades_categorias")
		->order_by("nombre","asc")
		->get();
		return $query->result();
	}

	public function get_tipo_propiedad_por_id($id=null){
		$where=array("id_categoria"=>$id);

		$query=$this->db
		->select("id_categoria, nombre")
		->from("propiedades_categorias")
		->where($where)
		->get();
		return $query->row();
	}

	public function get_id_tipo_propiedad_por_nombre($nombre=null){
		$where=array("nombre"=>$nombre);

		$query=$this->db
		->select("id_categoria")
		->from("propiedades_categorias")
		->where($where)
		->get();
		return $query->row();
	}

	public function get_all_tipo_propiedad_por_tipo_operacion($tipoOperacion){

		$query=$this->db
		->distinct()
		->select("pc.nombre, pc.id_categoria")
		->from("propiedades_categorias pc")
		->join("propiedades p","pc.id_categoria=p.id_categoria","inner")
		->where("p.tipo_operacion",$tipoOperacion)
		->where("p.status",1)
		->order_by("pc.nombre", "asc")
		->get();

		return $query->result();

	}

	
	public function get_all_estados_por_tipo_propiedad_y_operacion($tipoPropiedad, $operacion){

		$where=array("p.tipo_operacion"=>$operacion,
			         "p.id_categoria"=>$tipoPropiedad,
			         "p.status"=>1
			         );

		$query=$this->db
		->distinct()
		->select("e.id_estado, e.nombre")
		->from("estados e")
		->join("propiedades p","e.id_estado=p.id_estado","inner")
		->where($where)
		->order_by("e.nombre", "asc")
		->get();
		return $query->result();
	}

	public function get_all_delegaciones_por_estado_tipopropiedad_operacion($idEstado, $tipoPropiedad, $operacion){

		$where=array("p.tipo_operacion"=>$operacion,
			         "p.id_categoria"=>$tipoPropiedad,
			         "p.id_estado"=>$idEstado,
			         "p.status"=>1
			         );

		$query=$this->db
		->distinct()
		->select("d.id_delegaciones, d.nombre")
		->from("propiedades p")
		->join("delegaciones d","p.id_delegaciones=d.id_delegaciones","inner")
		->where($where)
		->order_by("d.nombre", "asc")
		->get();
		return $query->result();
	}

	public function get_all_colonias_por_delegacion_estado_tipopropiedad_operacion($idDelegacion, $tipoPropiedad, $operacion, $idEstado){

		$where=array("p.tipo_operacion"=>$operacion,
			         "p.id_categoria"=>$tipoPropiedad,
			         "p.id_estado"=>$idEstado,
			         "p.id_delegaciones"=>$idDelegacion,
			         "p.status"=>1
			         );

		$query=$this->db
		->distinct()
		->select("c.id_colonias, c.nombre")
		->from("propiedades p")
		->join("colonias c","p.id_colonias=c.id_colonias","inner")
		->where($where)
		->order_by("c.nombre", "asc")
		->get();
		return $query->result();
	}

	

	public function get_estados(){
		$query=$this->db
		->select("id_estado, nombre")
		->from("estados")
		->get();
		return $query->result();
	}

	public function get_estado_por_id($id){
		$where=array("id_estado"=>$id);
		$query=$this->db
		->select("id_estado, nombre")
		->from("estados")
		->where($where)
		->get();
		return $query->row();
	}

	public function get_id_estado_por_nombre($nombre){
		$where=array("nombre"=>$nombre);
		$query=$this->db
		->select("id_estado, nombre")
		->from("estados")
		->where($where)
		->get();
		return $query->row();
	}

	public function get_all_delegaciones_por_id_estado($id=null){

		$where=array("id_estado"=>$id);
		
		$query=$this->db
		->select("id_delegaciones, nombre")
		->from("delegaciones")
		->where($where)
		->order_by("nombre","asc")
		->get();

		return $query->result();

	}

	public function get_delegacion_por_id($id=null){
		$where=array("id_delegaciones"=>$id);
		$query=$this->db
		->select("id_delegaciones, nombre")
		->from("delegaciones")
		->where($where)
		->get();
		return $query->row();
	}

	public function get_id_delegacion_por_nombre($nombre=null){
		$where=array("nombre"=>$nombre);
		$query=$this->db
		->select("id_delegaciones, nombre")
		->from("delegaciones")
		->where($where)
		->get();
		return $query->row();
	}


	public function get_all_colonias_por_id_delegacion($id=null){

		$where=array("id_delegaciones"=>$id);
		
		$query=$this->db
		->select("id_colonias, nombre")
		->from("colonias")
		->where($where)
		->order_by("nombre", "asc")
		->get();

		return $query->result();

	}

	public function get_colonia_por_id($id=null){

		$where=array("id_colonias"=>$id);
		
		$query=$this->db
		->select("id_colonias, nombre")
		->from("colonias")
		->where($where)
		->get();

		return $query->row();

	}

	public function get_id_colonias_por_nombre($nombre){

		$where=array("nombre"=>$nombre);
		
		$query=$this->db
		->select("id_colonias")
		->from("colonias")
		->where($where)
		->get();

		return $query->row();

	}




	public function get_foto_principal_propiedades($id_propiedad=null){
		$where=array("id_propiedad"=>$id_propiedad);
		$query=$this->db
		->select("path_foto, path_foto_thumb")
		->from("propiedades_fotos")
		->where($where)
		->where('principal','1')
		->get();

		return $query->row();

	}

	public function get_foto_no_principal_propiedades($id_propiedad=null){
		$where=array("id_propiedad"=>$id_propiedad);
		$query=$this->db
		->select("path_foto, path_foto_thumb")
		->from("propiedades_fotos")
		->where($where)
		->where('principal','0')
		->limit(1,0)
		->get();

		return $query->row();

	}

	public function get_foto_principal_no_principal_propiedades($id_propiedad=null, $opcion){

		if($opcion=="thumb"){
			$fotoPrincipal=$this->get_foto_principal_propiedades($id_propiedad);
			if(count($fotoPrincipal)>0){
				$principal=$fotoPrincipal->path_foto_thumb;
			}else{
				$fotoNoPrincipal=$this->get_foto_no_principal_propiedades($id_propiedad);
				if(count($fotoNoPrincipal)>0){
					$principal=$fotoNoPrincipal->path_foto_thumb;
				}else{
					$principal="";
				}
			}
		}else
			if($opcion=="big"){
				$fotoPrincipal=$this->get_foto_principal_propiedades($id_propiedad);
				if(count($fotoPrincipal)>0){
					$principal=$fotoPrincipal->path_foto;
				}else{
					$fotoNoPrincipal=$this->get_foto_no_principal_propiedades($id_propiedad);
					if(count($fotoNoPrincipal)>0){
						$principal=$fotoNoPrincipal->path_foto;
					}else{
						$principal="";
					}
				}
		}

		if($principal==""){
			$principal="public/images/Sin_imagen_disponible.jpg";
		}

		return $principal;
	}

	public function get_all_fotos_propiedades($id_propiedad=null){
		$where=array("id_propiedad"=>$id_propiedad);
		$query=$this->db
		->select("id_propiedades_fotos, path_foto, path_foto_thumb, principal")
		->from("propiedades_fotos")
		->where($where)
		->get();

		return $query->result();

	}

	public function get_foto_por_id($idFotosPropiedades){

		$where=array("id_propiedades_fotos"=>$idFotosPropiedades);
		$query=$this->db
		->select("id_propiedades_fotos, path_foto, path_foto_thumb, principal")
		->from("propiedades_fotos")
		->where($where)
		->get();

		return $query->row();


	}


	public function get_delegacion_por_id_estado($idEstado=null){
		$where=array("id_estado"=>$idEstado);
		$query=$this->db
		->select("id_delegaciones, nombre")
		->from("delegaciones")
		->where($where)
		->get();
		return $query->row();
	}


	//metodo para las busquedas del sitio inmobiliaría
	public function buscador($limiteInicio=null){

			$where=array();

				foreach($_GET as $nombre_campo => $valor){ 
					if($valor!=""){
						switch ($nombre_campo) {
							case 'tipoOperacion':
								$nombre_campo="tipo_operacion";
								break;
							case 'tipoPropiedades':
								$nombre_campo="id_categoria";
								break;
							case 'delegaciones':
								$nombre_campo="id_delegaciones";
								break;
							case 'estados':
								$nombre_campo="id_estado";
								break;
							case 'colonias':
								$nombre_campo="id_colonias";
								break;
							case 'recamaras':
								$nombre_campo="num_recamaras";
								break;
							case 'banos':
								$nombre_campo="num_banos";
								break;
							case 'autos':
								$nombre_campo="num_autos";
								break;
							
						}
						if($nombre_campo=='precio' || $nombre_campo=='antiguedad' || $nombre_campo=='metros'){
							switch ($nombre_campo) {
								case 'precio':
									$separa=explode("-",$valor);
									$val1=$separa[0];
									$val2=$separa[1];
									$where['precio >=']=$val1;
									$where['precio <=']=$val2;
									break;
								case 'antiguedad':
									$separa=explode("-",$valor);
									$val1=$separa[0];
									$val2=$separa[1];
									$where['antiguedad >=']=$val1;
									$where['antiguedad <=']=$val2;
									break;
								case 'metros':
									$separa=explode("-",$valor);
									$val1=$separa[0];
									$val2=$separa[1];
									$where['m2_terreno >=']=$val1;
									$where['m2_terreno <=']=$val2;
									break;
							}
						}else{
							$where[$nombre_campo]=$valor;
						}
					}
				}

				unset($where["pag"]);

				if($limiteInicio==0){
					$query=$this->db
					->distinct()
					->select("nombre,precio,descripcion,num_recamaras,m2_construccion,m2_terreno,num_banos,antiguedad,num_autos,id_propiedad,fecha_registro,tipo_operacion,id_categoria,id_delegaciones,id_colonias")
					->from("propiedades")
					->where($where)
					->where('status',1)
					->limit($this->paginador->configPaginador["reg_x_pagina"])
					->get();
				}else{
					$query=$this->db
					->distinct()
					->select("nombre,precio,descripcion,num_recamaras,m2_construccion,m2_terreno,num_banos,antiguedad,num_autos,id_propiedad,fecha_registro,tipo_operacion,id_categoria,id_delegaciones,id_colonias")
					->from("propiedades")
					->where($where)
					->where('status',1)
					->limit($this->paginador->configPaginador["reg_x_pagina"], $limiteInicio)
					->get();
				}


				
				return $query->result_array();	
				
			
	}//end buscador

	//metodo para las busquedas del sitio inmobiliaría
	public function get_total_resultados_buscador(){

	$where=array();

		foreach($_GET as $nombre_campo => $valor){ 
			if($valor!=""){
				switch ($nombre_campo) {
					case 'delegaciones':
						$nombre_campo="id_delegaciones";
						break;
					case 'estados':
						$nombre_campo="id_estado";
						break;
					case 'colonias':
						$nombre_campo="id_colonias";
						break;
					
				}
				if($nombre_campo=='precio' || $nombre_campo=='antiguedad' || $nombre_campo=='metros'){
					switch ($nombre_campo) {
						case 'precio':
							$separa=explode("-",$valor);
							$val1=$separa[0];
							$val2=$separa[1];
							$where['precio >=']=$val1;
							$where['precio <=']=$val2;
							break;
						case 'antiguedad':
							$separa=explode("-",$valor);
							$val1=$separa[0];
							$val2=$separa[1];
							$where['antiguedad >=']=$val1;
							$where['antiguedad <=']=$val2;
							break;
						case 'metros':
							$separa=explode("-",$valor);
							$val1=$separa[0];
							$val2=$separa[1];
							$where['m2_terreno >=']=$val1;
							$where['m2_terreno <=']=$val2;
							break;
					}
				}else{
					$where[$nombre_campo]=$valor;
				}
			}
		}

		unset($where["pag"]);

		$query=$this->db
			->distinct()
			->select("nombre,precio,descripcion,num_recamaras,m2_construccion,m2_terreno,num_banos,antiguedad,num_autos,id_propiedad,fecha_registro,tipo_operacion,id_categoria,id_delegaciones,id_colonias")
			->from("propiedades")
			->where($where)
			->where('status',1)
			->get();

		return $query->result_array();	
			
	}//end 


		public function get_propiedad_por_id($id_propiedad){
			$where=array('id_propiedad'=>$id_propiedad);
			$query=$this->db
			->select("id_propiedad,nombre,precio,tipo_operacion,descripcion,num_habitaciones,num_recamaras,m2_construccion,m2_terreno,num_banos,antiguedad,num_autos,direccion,id_estado,id_delegaciones,id_colonias,id_categoria,fecha_republicacion,status")
			->from("propiedades")
			->where($where)
			->get();

			return $query->row();
		}


		public function get_propiedades_por_id_usuario(){

			$where=array( 'id_usuario'=>$this->session->userdata('idUser'),
				          'status'=>1
				        );

			$query=$this->db
			->select("id_propiedad,nombre,precio,descripcion,num_recamaras,m2_construccion,m2_terreno,num_banos,antiguedad,num_autos,id_propiedad")
			->from("propiedades")
			->where($where)
			->get();

			return $query->result_array();
		}

		public function get_propiedades_por_id_usuario_para_root($idUser){

			$query=$this->db
			->select("id_propiedad,nombre,precio,descripcion,num_recamaras,m2_construccion,m2_terreno,num_banos,antiguedad,num_autos,id_propiedad")
			->from("propiedades")
			->where('id_usuario', $idUser)
			->where('status',1)
			->get();

			return $query->result();
		}


		public function get_propiedades_por_id_usuario_limite($limiteInicio=null){

			$where=array( 'id_usuario'=>$this->session->userdata('idUser'),
				          'status'=>1
				        );

			if($limiteInicio==0){
				$query=$this->db
				->select("id_propiedad,nombre,precio,descripcion,num_recamaras,m2_construccion,m2_terreno,num_banos,antiguedad,num_autos,id_propiedad")
				->from("propiedades")
				->where($where)
				->limit($this->paginador->configPaginador["reg_x_pagina"])
				->get();
			}else{
				$query=$this->db
				->select("id_propiedad,nombre,precio,descripcion,num_recamaras,m2_construccion,m2_terreno,num_banos,antiguedad,num_autos,id_propiedad")
				->from("propiedades")
				->where($where)
				->limit($this->paginador->configPaginador["reg_x_pagina"], $limiteInicio)
				->get();
			}

			return $query->result_array();

		}


		public function get_propiedades_id_cliente(){

			$where=array('ui.id_usuario'=>$this->session->userdata('idUser'));

			$query=$this->db
			->select("p.id_propiedad, p.nombre as propiedad, p.descripcion, p.id_categoria")
			->from("usuarios u")
			->join("usuarios_interesados_propiedades ui","u.id_usuario=ui.id_usuario","inner")
			->join("propiedades p","ui.id_propiedad=p.id_propiedad","inner")
			->where($where)
			->get();

			return $query->result_array();

		}


		public function ingresar_anuncio(){
	
			$date=date("Y-m-d");
			$arreglo=array(
							"nombre"=>$_POST["title"],
							"tipo_operacion"=>$_POST["selectOperacion"],
							"direccion"=>$_POST["direccion"],
							"precio"=>$_POST["precio"],
							"descripcion"=>$_POST["description"],
							"num_habitaciones"=>"",
							"num_recamaras"=>$_POST["recamaras"],
							"m2_construccion"=>$_POST["construido"],
							"m2_terreno"=>$_POST["terreno"],
							"num_banos"=>$_POST["banos"],
							"antiguedad"=>$_POST["antiguedad"],
							"num_autos"=>$_POST["autos"],
							"id_usuario"=>$this->session->userdata('idUser'),
							"id_estado"=>$_POST["selectEstados"],
							"id_delegaciones"=>$_POST["selectDelegaciones"],
							"id_colonias"=>$_POST["selectColonias"],
							"id_categoria"=>$_POST["selectTipoPropiedad"],
							"status"=>"1",
							"fecha_registro"=>date("Y-m-d"),
							"fecha_republicacion"=>date("Y-m-d")
				          );
	

			$this->db->insert('propiedades', $arreglo);

			return $this->db->insert_id();

		

		}

		public function insert_foto_propiedades($fotoPath, $fotoPathThumb, $idPropiedad){

			$arreglo=array(
							"id_propiedad"=>$idPropiedad,
							"path_foto"=>$fotoPath,
							"path_foto_thumb"=>$fotoPathThumb,
							"path_foto_seoslug"=>"",
							"principal"=>0
				          );
	

			$this->db->insert('propiedades_fotos', $arreglo);


		}

		public function establece_imagen_principal(){

			$datos=array("principal"=>0);
			$this->db->where('id_propiedad', $_POST["idPropiedad"]);
			$this->db->update('propiedades_fotos', $datos);

			
			$datos=array("principal"=>1);
			$this->db->where('id_propiedades_fotos', $_POST["idFotoPrincipal"]);
			$this->db->where('id_propiedad', $_POST["idPropiedad"]);
			$this->db->update('propiedades_fotos', $datos);

			echo "<b>Se Actualizo la Imagen Principal de tu Propiedad</b>";

		}

		public function actualiza_anuncio(){

			$datos=array( "nombre"=>$_POST["titulo"],
							"tipo_operacion"=>$_POST["operacion"],
							"direccion"=>$_POST["direccion"],
							"precio"=>$_POST["precio"],
							"descripcion"=>$_POST["description"],
							"num_habitaciones"=>"",
							"num_recamaras"=>$_POST["recamaras"],
							"m2_construccion"=>$_POST["construido"],
							"m2_terreno"=>$_POST["terreno"],
							"num_banos"=>$_POST["banos"],
							"antiguedad"=>$_POST["antiguedad"],
							"num_autos"=>$_POST["autos"],
							"id_usuario"=>$this->session->userdata('idUser'),
							"id_estado"=>$_POST["selectEstados"],
							"id_delegaciones"=>$_POST["selectDelegaciones"],
							"id_colonias"=>$_POST["selectColonias"],
							"id_categoria"=>$_POST["selectTipoPropiedad"],
							"status"=>"1"
						);

			$this->db->where('id_propiedad', $_POST["id_propiedad"]);
			$this->db->update('propiedades', $datos);

			echo "Se Actualizaron los Datos de la Propiedad Correctamente!!!";
	

		}


		public function elimina_imagen_propiedad($idFotosPropiedades){

			//despues eliminamos el registro de la tabla
			$this->db->delete('propiedades_fotos', array('id_propiedades_fotos'=>$idFotosPropiedades));

			$this->session->set_flashdata('message', 'Se Elimino la Imagen Correctamente.');
			
		}

		public function eliminar_imagen_propiedad_fisicamente($path){
			
			if(file_exists($path)){
				unlink($path);
			}

		}


		public function get_favoritos_por_id_usuario(){

			$where=array('f.id_usuario'=>$this->session->userdata('idUser'));

			$query=$this->db
			->select("f.id_favoritos, f.id_propiedad, p.nombre, p.id_categoria")
			->from("favoritos f")
			->join("propiedades p","f.id_propiedad=p.id_propiedad","inner")
			->join("usuarios u","p.id_usuario=u.id_usuario","inner")
			->where($where)
			->get();

			return $query->result_array();

		}

		public function eliminar_favoritos($idFavoritos){

			$this->db->delete('favoritos', array('id_favoritos'=>$idFavoritos));

			$this->session->set_flashdata('favorito', 'Eliminado Correctamente!!!');

		}

		public function add_favoritos(){

			//valido si ya existe la propiedad en favoritos
			$favoritos=$this->get_favoritos_por_id_usuario($_POST["id_usuario"]);
			foreach ($favoritos as $value) {
				if($value["id_propiedad"]==$_POST["id_propiedad"]){
					exit;
				}
			}

			$arreglo=array(
							"id_propiedad"=>$_POST["id_propiedad"],
							"id_usuario"=>$_POST["id_usuario"]
				          );
	

			$this->db->insert('favoritos', $arreglo);

		}


		public function get_all_propiedades_usuarios(){

			$where=array( );

			$query=$this->db
			->select("id_propiedad, id_categoria, nombre as propiedad, direccion, id_estado, id_delegaciones, id_colonias, id_usuario")
			->select("DATE_FORMAT(fecha_republicacion, '%d-%m-%Y') as fecha_republicacion", FALSE)
			->from("propiedades")
			->where('status',1)
			->get();

			return $query->result();

		}

		public function get_all_propiedades_usuarios_limite($limiteInicio){

			$where=array('status' => 1 );

			if($limiteInicio==0){
				$query=$this->db
				->select("id_propiedad, id_categoria, nombre as propiedad, direccion, id_estado, id_delegaciones, id_colonias, id_usuario")
				->select("DATE_FORMAT(fecha_republicacion, '%d-%m-%Y') as fecha_republicacion", FALSE)
				->from("propiedades")
				->where($where)
				->limit($this->paginador->configPaginador["reg_x_pagina"])
				->get();
			}else{
				$query=$this->db
				->select("id_propiedad, id_categoria, nombre as propiedad, direccion, id_estado, id_delegaciones, id_colonias, id_usuario")
				->select("DATE_FORMAT(fecha_republicacion, '%d-%m-%Y') as fecha_republicacion", FALSE)
				->from("propiedades")
				->where($where)
				->limit($this->paginador->configPaginador["reg_x_pagina"], $limiteInicio)
				->get();
			}

			return $query->result();

		}

		public function get_all_propiedades_usuarios_parametro($busqueda, $campoValor){

			$where=array('status' => 1 );

			if($busqueda=="id_propiedad"){
				$query=$this->db
				->select("id_propiedad, id_categoria, nombre as propiedad, direccion, id_estado, id_delegaciones, id_colonias, id_usuario")
				->select("DATE_FORMAT(fecha_republicacion, '%d-%m-%Y') as fecha_republicacion", FALSE)
				->from("propiedades")
				->where($where)
				->where("id_propiedad",$campoValor)
				->get();
			}else
				if($busqueda=="anunciante"){
					$query=$this->db
					->select("p.id_propiedad, p.id_categoria, p.nombre as propiedad, p.direccion, p.id_estado, p.id_delegaciones, p.id_colonias, p.id_usuario")
					->select("DATE_FORMAT(fecha_republicacion, '%d-%m-%Y') as fecha_republicacion", FALSE)
					->from("propiedades p")
					->join("usuarios u","p.id_usuario=u.id_usuario","inner")
					->where("p.status",1)
					->like('u.nombre',$campoValor)
					->get();
			}else
				if($busqueda=="titulo"){
					$query=$this->db
					->select("id_propiedad, id_categoria, nombre as propiedad, direccion, id_estado, id_delegaciones, id_colonias, id_usuario")
					->select("DATE_FORMAT(fecha_republicacion, '%d-%m-%Y') as fecha_republicacion", FALSE)
					->from("propiedades")
					->where($where)
					->like('nombre',$campoValor)
					->get();
			}else
				if($busqueda=="estado"){
					$query=$this->db
					->select("id_propiedad, id_categoria, nombre as propiedad, direccion, id_estado, id_delegaciones, id_colonias, id_usuario")
					->select("DATE_FORMAT(fecha_republicacion, '%d-%m-%Y') as fecha_republicacion", FALSE)
					->from("propiedades")
					->where($where)
					->like('id_estado',$campoValor)
					->get();
			}else
				if($busqueda=="delegacion"){
					$query=$this->db
					->select("id_propiedad, id_categoria, nombre as propiedad, direccion, id_estado, id_delegaciones, id_colonias, id_usuario")
					->select("DATE_FORMAT(fecha_republicacion, '%d-%m-%Y') as fecha_republicacion", FALSE)
					->from("propiedades")
					->where($where)
					->like('id_delegaciones',$campoValor)
					->get();
			}else
				if($busqueda=="estado"){
					$query=$this->db
					->select("id_propiedad, id_categoria, nombre as propiedad, direccion, id_estado, id_delegaciones, id_colonias, id_usuario")
					->select("DATE_FORMAT(fecha_republicacion, '%d-%m-%Y') as fecha_republicacion", FALSE)
					->from("propiedades")
					->where($where)
					->like('p.id_estado',$campoValor)
					->get();
			}else
				if($busqueda=="colonia"){
					$query=$this->db
					->select("id_propiedad, id_categoria, nombre as propiedad, direccion, id_estado, id_delegaciones, id_colonias, id_usuario")
					->select("DATE_FORMAT(fecha_republicacion, '%d-%m-%Y') as fecha_republicacion", FALSE)
					->from("propiedades")
					->where($where)
					->like('id_colonias',$campoValor)
					->get();
			}else
				if($busqueda=="fecha"){
					$fechaA=$_POST["fechaA"];
					if($fechaA==""){
						$fechaA=date('Y-m-d');
					}
					$where['fecha_republicacion >=']=$_POST["fechaDe"]." 00:00:00";
					$where['fecha_republicacion <=']=$fechaA." 23:59:59";
					$where['status']=1;
					$query=$this->db
					->select("id_propiedad, id_categoria, nombre as propiedad, direccion, id_estado, id_delegaciones, id_colonias, id_usuario")
					->select("DATE_FORMAT(fecha_republicacion, '%d-%m-%Y') as fecha_republicacion", FALSE)
					->from("propiedades")
					->where($where)
					->get();
			}

			return $query->result();

		}

		public function get_all_propiedades_usuarios_parametro_limite($busqueda, $campoValor, $limiteInicio){

			$where=array('status' => 1 );

			if($busqueda=="id_propiedad"){
				if($limiteInicio==0){
					$query=$this->db
					->select("id_propiedad, id_categoria, nombre as propiedad, direccion, id_estado, id_delegaciones, id_colonias, id_usuario")
					->select("DATE_FORMAT(fecha_republicacion, '%d-%m-%Y') as fecha_republicacion", FALSE)
					->from("propiedades")
					->where($where)
					->where("id_propiedad",$campoValor)
					->limit($this->paginador->configPaginador["reg_x_pagina"])
					->get();
				}else{
					$query=$this->db
					->select("id_propiedad, id_categoria, nombre as propiedad, direccion, id_estado, id_delegaciones, id_colonias, id_usuario")
					->select("DATE_FORMAT(fecha_republicacion, '%d-%m-%Y') as fecha_republicacion", FALSE)
					->from("propiedades")
					->where($where)
					->where("id_propiedad",$campoValor)
					->limit($this->paginador->configPaginador["reg_x_pagina"], $limiteInicio)
					->get();
				}		
			}else
				if($busqueda=="anunciante"){
					if($limiteInicio==0){
					$query=$this->db
					->select("p.id_propiedad, p.id_categoria, p.nombre as propiedad, p.direccion, p.id_estado, p.id_delegaciones, p.id_colonias, p.id_usuario")
					->select("DATE_FORMAT(fecha_republicacion, '%d-%m-%Y') as fecha_republicacion", FALSE)
					->from("propiedades p")
					->join("usuarios u","p.id_usuario=u.id_usuario","inner")
					->where("p.status",1)
					->like("u.nombre",$campoValor)
					->limit($this->paginador->configPaginador["reg_x_pagina"])
					->get();
					}else{
						$query=$this->db
						->select("p.id_propiedad, p.id_categoria, p.nombre as propiedad, p.direccion, p.id_estado, p.id_delegaciones, p.id_colonias, p.id_usuario")
						->select("DATE_FORMAT(fecha_republicacion, '%d-%m-%Y') as fecha_republicacion", FALSE)
						->from("propiedades p")
						->join("usuarios u","p.id_usuario=u.id_usuario","inner")
						->where("p.status",1)
						->like("u.nombre",$campoValor)
						->limit($this->paginador->configPaginador["reg_x_pagina"], $limiteInicio)
						->get();
					}		
			}else
				if($busqueda=="titulo"){
					if($limiteInicio==0){
					$query=$this->db
					->select("id_propiedad, id_categoria, nombre as propiedad, direccion, id_estado, id_delegaciones, id_colonias, id_usuario")
					->select("DATE_FORMAT(fecha_republicacion, '%d-%m-%Y') as fecha_republicacion", FALSE)
					->from("propiedades")
					->where($where)
					->like("nombre",$campoValor)
					->limit($this->paginador->configPaginador["reg_x_pagina"])
					->get();
					}else{
						$query=$this->db
						->select("id_propiedad, id_categoria, nombre as propiedad, direccion, id_estado, id_delegaciones, id_colonias, id_usuario")
						->select("DATE_FORMAT(fecha_republicacion, '%d-%m-%Y') as fecha_republicacion", FALSE)
						->from("propiedades")
						->where($where)
						->like("nombre",$campoValor)
						->limit($this->paginador->configPaginador["reg_x_pagina"], $limiteInicio)
						->get();
					}		
			}else
				if($busqueda=="estado"){
					if($limiteInicio==0){
					$query=$this->db
					->select("id_propiedad, id_categoria, nombre as propiedad, direccion, id_estado, id_delegaciones, id_colonias, id_usuario")
					->select("DATE_FORMAT(fecha_republicacion, '%d-%m-%Y') as fecha_republicacion", FALSE)
					->from("propiedades")
					->where($where)
					->like("id_estado",$campoValor)
					->limit($this->paginador->configPaginador["reg_x_pagina"])
					->get();
					}else{
						$query=$this->db
						->select("id_propiedad, id_categoria, nombre as propiedad, direccion, id_estado, id_delegaciones, id_colonias, id_usuario")
						->select("DATE_FORMAT(fecha_republicacion, '%d-%m-%Y') as fecha_republicacion", FALSE)
						->from("propiedades")
						->where($where)
						->like("id_estado",$campoValor)
						->limit($this->paginador->configPaginador["reg_x_pagina"], $limiteInicio)
						->get();
					}		
			}else
				if($busqueda=="delegacion"){
					if($limiteInicio==0){
					$query=$this->db
					->select("id_propiedad, id_categoria, nombre as propiedad, direccion, id_estado, id_delegaciones, id_colonias, id_usuario")
					->select("DATE_FORMAT(fecha_republicacion, '%d-%m-%Y') as fecha_republicacion", FALSE)
					->from("propiedades")
					->where($where)
					->like("id_delegaciones",$campoValor)
					->limit($this->paginador->configPaginador["reg_x_pagina"])
					->get();
					}else{
						$query=$this->db
						->select("id_propiedad, id_categoria, nombre as propiedad, direccion, id_estado, id_delegaciones, id_colonias, id_usuario")
						->select("DATE_FORMAT(fecha_republicacion, '%d-%m-%Y') as fecha_republicacion", FALSE)
						->from("propiedades")
						->where($where)
						->like("id_delegaciones",$campoValor)
						->limit($this->paginador->configPaginador["reg_x_pagina"], $limiteInicio)
						->get();
					}		
			}else
				if($busqueda=="colonia"){
					if($limiteInicio==0){
					$query=$this->db
					->select("id_propiedad, id_categoria, nombre as propiedad, direccion, id_estado, id_delegaciones, id_colonias, id_usuario")
					->select("DATE_FORMAT(fecha_republicacion, '%d-%m-%Y') as fecha_republicacion", FALSE)
					->from("propiedades")
					->where($where)
					->like("id_colonias",$campoValor)
					->limit($this->paginador->configPaginador["reg_x_pagina"])
					->get();
					}else{
						$query=$this->db
						->select("id_propiedad, id_categoria, nombre as propiedad, direccion, id_estado, id_delegaciones, id_colonias, id_usuario")
						->select("DATE_FORMAT(fecha_republicacion, '%d-%m-%Y') as fecha_republicacion", FALSE)
						->from("propiedades")
						->where($where)
						->like("id_colonias",$campoValor)
						->limit($this->paginador->configPaginador["reg_x_pagina"], $limiteInicio)
						->get();
					}		
			}else
				if($busqueda=="fecha"){
					if($limiteInicio==0){
						$fechaA=$_POST["fechaA"];
						if($fechaA==""){
							$fechaA=date('Y-m-d');
						}
						$where['fecha_republicacion >=']=$_POST["fechaDe"]." 00:00:00";
						$where['fecha_republicacion <=']=$fechaA." 23:59:59";
						$where['status']=1;
						$query=$this->db
						->select("id_propiedad, id_categoria, nombre as propiedad, direccion, id_estado, id_delegaciones, id_colonias, id_usuario")
						->select("DATE_FORMAT(fecha_republicacion, '%d-%m-%Y') as fecha_republicacion", FALSE)
						->from("propiedades")
						->where($where)
						->limit($this->paginador->configPaginador["reg_x_pagina"])
						->get();
					}else{
						$fechaA=$_POST["fechaA"];
						if($fechaA==""){
							$fechaA=date('Y-m-d');
						}
						$where['fecha_republicacion >=']=$_POST["fechaDe"]." 00:00:00";
						$where['fecha_republicacion <=']=$fechaA." 23:59:59";
						$where['status']=1;
						$query=$this->db
						->select("id_propiedad, id_categoria, nombre as propiedad, direccion, id_estado, id_delegaciones, id_colonias, id_usuario")
						->select("DATE_FORMAT(fecha_republicacion, '%d-%m-%Y') as fecha_republicacion", FALSE)
						->from("propiedades")
						->where($where)
						->limit($this->paginador->configPaginador["reg_x_pagina"], $limiteInicio)
						->get();
					}		
			}


			return $query->result();

		}



		public function activa_desactiva_propiedad_actualiza_fecha_republicacion($idPropiedad, $status){

			$dato=array( 
				         "status"=>$status,

				         "fecha_republicacion"=>date("Y-m-d")

				       );

			$this->db->where('id_propiedad', $idPropiedad);

			$this->db->update('propiedades', $dato);

		}

		public function get_costos_transacciones_paypal(){

			$query=$this->db
			->select('id_categoria, costo')
			->from('costo_transaccion_paypal')
			->get();

			return $query->result();

		}

		public function get_costos_transacciones_paypal_tipo_propiedad_por_id($idTipoPropiedad){

			$query=$this->db
			->select('pc.id_categoria, pc.nombre, ctp.costo')
			->from('propiedades_categorias pc')
			->join("costo_transaccion_paypal ctp","pc.id_categoria=ctp.id_categoria","inner")
			->where('pc.id_categoria', $idTipoPropiedad)
			->get();

			return $query->row();

		}

		public function actualiza_costo_transaccion(){

			$data=array("costo"=>$_POST["costo"]);
			$this->db->where('id_categoria', $_POST["idTipoPropiedad"]);
			$this->db->update('costo_transaccion_paypal', $data); 

		}

		public function get_costo_transaccion_paypal_por_id_categoria($idTipoPropiedad){

			$query=$this->db
			->select('costo')
			->from('costo_transaccion_paypal')
			->where('id_categoria', $idTipoPropiedad)
			->get();

			return $query->row();

		}


		public function get_banner($idBannerTipo){

			$query=$this->db
				->select('path_banner, url, titulo')
				->from('banner')
				->where('id_banner_tipo', $idBannerTipo)
				->order_by('id_banner','RANDOM')
				->get();

			return $query->row();

		}

		

	

	/* FILTROS DE BUSQUEDA */

	//filtro para recamaras
	public function filtro_recamaras($limite, $varsGets){

		//numero de recamaras a verificar si el limite viene vacio
		if ($limite=="") {
			$limite=10;
		}


		$where=array();

		foreach ($varsGets as $key => $value) {

			if($key == 'antiguedad' || $key == 'precio' || $key == 'm2_terreno'){
				
			}else{
				$where[$key]=$value;
			}

		}

		//arreglo guardara los totales de las recamaras
		$arrayRec=array();

		for ($i=1; $i <= $limite; $i++) { 

			$query=$this->db
			->select("num_recamaras")
			->from("propiedades")
			->where('num_recamaras', $i)
			->where($where)
			->where('status',1)
			->get();

			$arrayRec[$i]=$query->num_rows();
			
		}
		

		return $arrayRec;

	}

	//filtro para autos
	public function filtro_autos($limite, $varsGets){

		//numero de recamaras a verificar si el limite viene vacio
		if ($limite=="") {
			$limite=10;
		}
		
		$where=array();

		foreach ($varsGets as $key => $value) {

			if($key == 'antiguedad' || $key == 'precio' || $key == 'm2_terreno'){
				
			}else{
				$where[$key]=$value;
			}

		}

		//arreglo guardara los totales de los autos
		$arrayAutos=array();

		for ($i=1; $i <= $limite; $i++) { 

			$query=$this->db
			->select("num_autos")
			->from("propiedades")
			->where('num_autos', $i)
			->where($where)
			->where('status',1)
			->get();

			$arrayAutos[$i]=$query->num_rows();
			
		}
		

		return $arrayAutos;

	}


	//filtro para baños
	public function filtro_banos($limite, $varsGets){

		//numero de recamaras a verificar si el limite viene vacio
		if ($limite=="") {
			$limite=10;
		}
		
		$where=array();

		foreach ($varsGets as $key => $value) {

			if($key == 'antiguedad' || $key == 'precio' || $key == 'm2_terreno'){
				
			}else{
				$where[$key]=$value;
			}

		}



		//arreglo guardara los totales de los baños
		$arrayBanos=array();

		for ($i=1; $i <= $limite; $i++) { 

			$query=$this->db
			->select("num_banos")
			->from("propiedades")
			->where($where)
			->where('num_banos',$i)
			->where('status',1)
			->get();

			$arrayBanos[$i]=$query->num_rows();
			
		}
		

		return $arrayBanos;

	}

	//filtro para antiguedad
	public function filtro_antiguedad($varsGets){	

		//arreglo guarda los rangos para antiguedad
		$rangos=array('1,10','10,20','20,50','50,100');

		$where=array();

		foreach ($varsGets as $key => $value) {

			if($key == 'antiguedad' || $key == 'precio' || $key == 'm2_terreno'){
				
			}else{
				$where[$key]=$value;
			}

		}

		//arreglo para guardar resultados
		$antiguedad=array();

		//realizo los querys a la base de datos
		foreach ($rangos as $rango) {

			$rango1=explode(",",$rango);

			$query=$this->db
			->select("antiguedad")
			->from("propiedades")
			->where($where)
			->where('antiguedad >=', $rango1[0])
			->where('antiguedad <=', $rango1[1])
			->where('status',1)
			->get();

			$antiguedad[$rango]=$query->num_rows();
		}
		
		return $antiguedad;

	}

	//filtro para metros totales
	public function filtro_metros_totales($varsGets){	

		//arreglo guarda los rangos para antiguedad
		$rangos=array('100,150','150,300','300,500','500,1000');

		$where=array();

		foreach ($varsGets as $key => $value) {

			if($key == 'antiguedad' || $key == 'precio' || $key == 'm2_terreno'){
				
			}else{
				$where[$key]=$value;
			}

		}

		//arreglo para guardar resultados
		$metros=array();

		//realizo los querys a la base de datos
		foreach ($rangos as $rango) {

			$rango1=explode(",",$rango);

			$query=$this->db
			->select("m2_terreno")
			->from("propiedades")
			->where($where)
			->where('m2_terreno >=', $rango1[0])
			->where('m2_terreno <=', $rango1[1])
			->where('status',1)
			->get();

			$metros[$rango]=$query->num_rows();
		}
		
		return $metros;

	}

	//filtro para zona ó colonias
	public function filtro_zona($varsGets){	

		//extraigo todas las colonias por id_delegacion
		$colonias=$this->get_all_colonias_por_id_delegacion($varsGets['id_delegaciones']);

		$where=array();

		foreach($varsGets as $key => $value) {

			if($key == 'antiguedad' || $key == 'precio' || $key == 'm2_terreno'){
				
			}else{
				$where[$key]=$value;
			}
			

		}


		//arreglo para guardar resultados
		$colArray=array();

		//realizo los querys a la base de datos
		foreach ($colonias as $value) {

			$query=$this->db
			->select("nombre")
			->from("propiedades")
			->where($where)
			->where('id_colonias', $value->id_colonias)
			->where('status',1)
			->get();

			$colArray[$value->nombre]=$query->num_rows();
		}
		
		return $colArray;

	}

	//filtro para tipo operacion
	public function filtro_tipo_operacion($varsGets){	


		//arreglo para guardar resultados
		$datos=array('Venta','Renta');

		$where=array();

		foreach ($varsGets as $key => $value) {

			if($key == 'antiguedad' || $key == 'precio' || $key == 'm2_terreno'){
				
			}else{
				$where[$key]=$value;
			}
		}

		//array tipos de operacion
		$tipos=array();

		foreach ($datos as $value) {
			$query=$this->db
			->select("tipo_operacion")
			->from("propiedades")
			->where($where)
			->where('tipo_operacion', $value)
			->where('status',1)
			->get();

			$tipos[$value]=$query->num_rows();
		}
		
		
		return $tipos;

	}

	//filtro para tipo propiedad
	public function filtro_tipo_propiedad($varsGets){	


		//extraigo todas los tipos de propiedades
		$tipoPropiedad=$this->get_tipo_propiedad();

		$where=array();

		foreach ($varsGets as $key => $value) {

			if($key == 'antiguedad' || $key == 'precio' || $key == 'm2_terreno'){
				
			}else{
				$where[$key]=$value;
			}

		}

		//arreglo para guardar resultados
		$tipoProArray=array();

		//realizo los querys a la base de datos
		foreach ($tipoPropiedad as $tipo) {

			$query=$this->db
			->select("nombre")
			->from("propiedades")
			->where($where)
			->where('id_categoria', $tipo->id_categoria)
			->where('status',1)
			->get();

			$tipoProArray[$tipo->nombre]=$query->num_rows();
		}
		
		return $tipoProArray;

	}

	//filtro para tipo propiedad
	public function filtro_estados($varsGets){	


		//extraigo todas los tipos de propiedades
		$estados=$this->get_estados();

		$where=array();

		foreach ($varsGets as $key => $value) {

			if($key == 'antiguedad' || $key == 'precio' || $key == 'm2_terreno'){
				
			}else{
				$where[$key]=$value;
			}

		}

		//arreglo para guardar resultados
		$estadosArray=array();

		//realizo los querys a la base de datos
		foreach ($estados as $estado) {

			$query=$this->db
			->select("id_estado")
			->from("propiedades")
			->where($where)
			->where('id_estado', $estado->id_estado)
			->where('status',1)
			->get();

			$estadosArray[$estado->nombre]=$query->num_rows();
		}
		
		return $estadosArray;

	}

	//filtro para tipo propiedad
	public function filtro_delegaciones($varsGets){	


		//extraigo todas los tipos de propiedades
		$delegaciones=$this->get_all_delegaciones_por_id_estado($varsGets["id_estado"]);


		$where=array();

		foreach ($varsGets as $key => $value) {

			if($key == 'antiguedad' || $key == 'precio' || $key == 'm2_terreno'){
				
			}else{
				$where[$key]=$value;
			}

		}

		//arreglo para guardar resultados
		$delArray=array();

		//realizo los querys a la base de datos
		foreach ($delegaciones as $del) {

			$query=$this->db
			->select("id_delegaciones")
			->from("propiedades")
			->where($where)
			->where('id_delegaciones', $del->id_delegaciones)
			->where('status',1)
			->get();

			$delArray[$del->nombre]=$query->num_rows();
		}
		
		return $delArray;

	}



	/*
	//filtro para tipo propiedad
	public function filtro_publicado($idDelegacion){	

		$datos=array('Ayer'=>1,
					 'Hoy'=>0,
					 'Ultima Semana'=>7,
					 'Ultimos 15 días'=>15,
					 'Ultimos 30 días'=>30,
					 'Mas de 1 mes'=>31
					);

		//arreglo para guardar resultados
		$publicadoArray=array();

		//realizo los querys a la base de datos
		foreach ($datos as $key => $value) {

			$query=$this->db
			->select("DATE_FORMAT(p.fecha_registro, '%Y-%m-%d') as fecha_registro")
			->from("propiedades")
			->where('id_delegaciones', $idDelegacion)
			->get();

			$result=$query->result();

			foreach ($result as $res) {

				$numDias=$this->calcula_dias_diferencia_entre_fechas($res->fecha_registro);
				//para validar cuando sea 1 dia
				if($value == $numDias){

					$publicadoArray[$key]=$query->num_rows();

				}else
					if($numDias == 0){
						$publicadoArray[$key]=$query->num_rows();
				}else
					if($numDias <= 7){
						$publicadoArray[$key]=$query->num_rows();
				}

			}

			
			
		}
		
		return $publicadoArray;

	}
	*/

	///////////////////////


	///////////////////////////////////////////////////


	public function recorta_cadena($cadena, $numRecortar){

		$cadena=substr($cadena, 0, $numRecortar);

		return $cadena;

	}

	public function texto_con_guion($texto){

		$quita_espacios_inicio_fin=trim($texto);

		return $texto_guion=str_replace(" ", "-", $quita_espacios_inicio_fin);

	}

	public function valida_email($email){

		if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		   
		    echo "La direccion de correo eletrónico no es valida!!!";
			exit;

		}

	}

	
	

	public function calcula_dias_diferencia_entre_fechas($fechaRepublicacion){

		$separaFechaRegistro=explode("-", $fechaRepublicacion);
		
		$anoRegistro = $separaFechaRegistro[0]; 
		$mesRegistro = $separaFechaRegistro[1]; 
		$diaRegistro = $separaFechaRegistro[2];

		//defino fecha actual
		$anoActual=date('Y');
		$mesActual = date('m'); 
		$diaActual = date('d'); 

		//calculo timestamp de las dos fechas 
		$timestamp1 = mktime(0,0,0,$mesRegistro,$diaRegistro,$anoRegistro); 
		$timestamp2 = mktime(0,0,0,$mesActual,$diaActual,$anoActual); 

		//resto a una fecha la otra 
		$segundos_diferencia = $timestamp2 - $timestamp1; 
		//echo $segundos_diferencia; 

		//convierto segundos en días 
		$dias_diferencia = $segundos_diferencia / (60 * 60 * 24); 

		//quito los decimales a los días de diferencia y se redondea al antero mas bajo
		return $dias_diferencia = floor($dias_diferencia); 
 

	}

	public function envia_correo_anunciante_propiedad_caducada_y_desactiva(){

		//el numero de días limite para que la propiedad caduque
		$limiteDias=30;

		$propiedades=$this->get_all_propiedades_usuarios();

		foreach ($propiedades as $pro) {
			
			//si la fecha supera los 30 días de publicado mandamos un correo al usuario para que reactive su propiedad y la desactivamos
			if( $this->calcula_dias_diferencia_entre_fechas($pro->fecha_republicacion) > $limiteDias ){

				//primero desactivamos la propiedad del usuario y cambiamos la fecha de publicacion a la fecha actual
				$this->activa_desactiva_propiedad_actualiza_fecha_republicacion($pro->id_propiedad, $status=0);

				//mandamos mail al anuciante para que reactive su propiedad
				$mail = new PHPMailer();
				$mail->From = "staff@interhabita.com";
				$mail->FromName = "Administrador Interhabita";
				$mail->Subject = "Reactiva tu Propiedad (Inmobiliaria Interhabita)";
				$mail->AddAddress($pro->correo, '');

				$md5Propiedad=md5($pro->propiedad);
				$md5IdPropiedad=md5($pro->id_propiedad);

				//cuerpo del mensaje
				$body='
				 <!DOCTYPE HTML><html><head><title>Reactivar Propiedad Anunciante</title><meta http-equiv="Content-Type" content="text/html"; charset="utf-8"><meta name="viewport" content="width=320, target-densitydpi=device-dpi">
					<style type="text/css">
					@media only screen and (max-width: 660px) { 
					table[class=w0], td[class=w0] { width: 0 !important; }
					table[class=w10], td[class=w10], img[class=w10] { width:10px !important; }
					table[class=w15], td[class=w15], img[class=w15] { width:5px !important; }
					table[class=w30], td[class=w30], img[class=w30] { width:10px !important; }
					table[class=w60], td[class=w60], img[class=w60] { width:10px !important; }
					table[class=w125], td[class=w125], img[class=w125] { width:80px !important; }
					table[class=w130], td[class=w130], img[class=w130] { width:55px !important; }
					table[class=w140], td[class=w140], img[class=w140] { width:90px !important; }
					table[class=w160], td[class=w160], img[class=w160] { width:180px !important; }
					table[class=w170], td[class=w170], img[class=w170] { width:100px !important; }
					table[class=w180], td[class=w180], img[class=w180] { width:80px !important; }
					table[class=w195], td[class=w195], img[class=w195] { width:80px !important; }
					table[class=w220], td[class=w220], img[class=w220] { width:80px !important; }
					table[class=w240], td[class=w240], img[class=w240] { width:180px !important; }
					table[class=w255], td[class=w255], img[class=w255] { width:185px !important; }
					table[class=w275], td[class=w275], img[class=w275] { width:135px !important; }
					table[class=w280], td[class=w280], img[class=w280] { width:135px !important; }
					table[class=w300], td[class=w300], img[class=w300] { width:140px !important; }
					table[class=w325], td[class=w325], img[class=w325] { width:95px !important; }
					table[class=w360], td[class=w360], img[class=w360] { width:140px !important; }
					table[class=w410], td[class=w410], img[class=w410] { width:180px !important; }
					table[class=w470], td[class=w470], img[class=w470] { width:200px !important; }
					table[class=w580], td[class=w580], img[class=w580] { width:280px !important; }
					table[class=w640], td[class=w640], img[class=w640] { width:300px !important; }
					table[class*=hide], td[class*=hide], img[class*=hide], p[class*=hide], span[class*=hide] { display:none !important; }
					table[class=h0], td[class=h0] { height: 0 !important; }
					p[class=footer-content-left] { text-align: center !important; }
					#headline p { font-size: 30px !important; }
					.article-content, #left-sidebar{ -webkit-text-size-adjust: 90% !important; -ms-text-size-adjust: 90% !important; }
					.header-content, .footer-content-left {-webkit-text-size-adjust: 80% !important; -ms-text-size-adjust: 80% !important;}
					img { height: auto; line-height: 100%;}
					 } 
					/* Client-specific Styles */
					#outlook a { padding: 0; }	/* Force Outlook to provide a "view in browser" button. */
					body { width: 100% !important; }
					.ReadMsgBody { width: 100%; }
					.ExternalClass { width: 100%; display:block !important; } /* Force Hotmail to display emails at full width */
					body { background-color: #c7c7c7; margin: 0; padding: 0; }
					img { outline: none; text-decoration: none; display: block;}
					br, strong br, b br, em br, i br { line-height:100%; }
					h1, h2, h3, h4, h5, h6 { line-height: 100% !important; -webkit-font-smoothing: antialiased; }
					h1 a, h2 a, h3 a, h4 a, h5 a, h6 a { color: blue !important; }
					h1 a:active, h2 a:active,  h3 a:active, h4 a:active, h5 a:active, h6 a:active {	color: red !important; }
					/* Preferably not the same color as the normal header link color.  There is limited support for psuedo classes in email clients, this was added just for good measure. */
					h1 a:visited, h2 a:visited,  h3 a:visited, h4 a:visited, h5 a:visited, h6 a:visited { color: purple !important; }
					/* Preferably not the same color as the normal header link color. There is limited support for psuedo classes in email clients, this was added just for good measure. */  
					table td, table tr { border-collapse: collapse; }
					.yshortcuts, .yshortcuts a, .yshortcuts a:link,.yshortcuts a:visited, .yshortcuts a:hover, .yshortcuts a span {
					color: black; text-decoration: none !important; border-bottom: none !important; background: none !important;
					}	/* Body text color for the New Yahoo.  This example sets the font of Yahoos Shortcuts to black. */
					/* This most probably wont work in all email clients. Dont include code blocks in email. */
					code {
					  white-space: normal;
					  word-break: break-all;
					}
					#background-table { background-color: #c7c7c7; }
					a {color:white;}
					/* Webkit Elements */
					#top-bar { border-radius:100px 0px 0px 0px; -moz-border-radius: 10px 0px 0px 0px; -webkit-border-radius:100px 0px 0px 0px; -webkit-font-smoothing: antialiased; background-color: #000000; color: #888888; height:100px;}
					#footer { border-radius:0px 0px 100px 0px; -moz-border-radius: 0px 0px 100px 0px; -webkit-border-radius:0px 0px 100px 0px; -webkit-font-smoothing: antialiased; height:100px;}
					/* Fonts and Content */
					body, td { font-family: Helvetica, sans-serif; font-size: 14px;}
					.header-content, .footer-content-left, .footer-content-right { -webkit-text-size-adjust: none; -ms-text-size-adjust: none; }
					/* Prevent Webkit and Windows Mobile platforms from changing default font sizes on header and footer. */
					#footer { background-color: #000000; color: #888888; }
					#footer a { color: #eeeeee; text-decoration: none; font-weight: bold; }
					.content {color:#888888}
					</style>
					<!--[if gte mso 9]>
					<style _tmplitem="241" >
					.article-content ol, .article-content ul {
					   margin: 0 0 0 24px;
					   padding: 0;
					   list-style-position: inside;
					}
					</style>
					<![endif]--></head><body><table width="100%" cellpadding="0" cellspacing="0" border="0" id="background-table" style="table-layout:fixed" align="center">
						<tbody><tr>
							<td align="center" bgcolor="#c7c7c7">
					        	<table class="w640" style="margin:0 10px;" width="640" cellpadding="0" cellspacing="0" border="0">
					            	<tbody><tr><td class="w640" width="640" height="20"></td></tr>
					                
					            	<tr>
					                	<td class="w640" width="640">
					                        <table id="top-bar" class="w640" width="640" cellpadding="0" cellspacing="0" border="0" bgcolor="#000000">
					    <tbody><tr>
					        <td class="w15" width="15"></td>
					        <td class="w325" width="610" valign="middle" align="center">
								<div id="logo"><a href="http://interhabita.com/" title="">
									<img src="http://interhabita.com/public/images/logo.png" alt=""></a>
								</div>
					        </td>
					        <td class="w15" width="15"></td>
					    </tr>
					</tbody></table>
					                        
					                    </td>
					                </tr>
					                <tr>
					                
					                </tr>
					</tr>
					                <tr>
										<td class="content" width="640" height="15" bgcolor="#000000">
											<table>
												<tr height="25px"></tr><tr>
													<td width="600" align="center" >
														Hola Estimad@ <b>'.$pro->usuario.'</b> <br>La Propiedad: <b>'.$pro->propiedad.'</b><br> Cumplio su fecha limite de publicación para republicarla da click en el siguiente enlace:<br><br>
														<a href="http://interhabita.com/republicaranuncio/activa/'.$md5Propiedad.'/'.$md5IdPropiedad.'/'.$pro->id_propiedad.'">Reactivar mi Propiedad</a>

													</td>
												</tr>
												<tr height="25px"></tr></table>
										</td>
									</tr>
					                <tr>
					                <td class="w640" width="640">
					    <table id="footer" class="w640" width="640" cellpadding="0" cellspacing="0" border="0" bgcolor="#000000">
					        <tbody>
					        <tr>
					            <td class="w30" width="30"></td>
					            <td class="w580" width="580" valign="top" align="center">
					            	<br><br>
									<p>Interhabita staff</br>
									OF. (0155) 96880854</br>
									<a href="mailto:staff@interhabita.com">staff@interhabita.com</a></br>
									<a href="http://www.interhabita.com">www.interhabita.com</a></p>
					            <td class="w30" width="30"></td>
					        </tr>
							<tr>
					            <td class="w30" width="30" height="25"></td>
					            <td class="w580" width="580" valign="top" align="center">
					            <td class="w30" width="30"></td>
					        </tr>
					    </tbody></table>
					</td>
					                </tr>
					                <tr><td class="w640" width="640" height="60"></td></tr>
					            </tbody></table>
					        </td>
						</tr>
					</tbody></table></br></body></html>
				';

			  	$mail->IsHTML(true);
				$mail->Body = $body;
				$mail->Send();

			}
			
			
		}

	}

	public function suminu($idestado){
		$del=$this->get_all_delegaciones_por_id_estado($idestado);
		foreach ($del as $value) {
			?>
			UPDATE colonias set id_delegaciones=(select id_delegaciones from delegaciones where nombre='<? echo utf8_decode($value->nombre) ?>' and id_estado=<? echo $idestado ?>) where delegacion='<? echo utf8_decode($value->nombre) ?>';
			<?
			echo "<br>";
		}
	}



}//end class

