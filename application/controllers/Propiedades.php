<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Propiedades extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->layout->setLayout('template');
	}

	public function index(){

		$this->layout->setTitle(' Interhabita - Publicidad y Promoción en Internet para Profesionales Inmobiliarios - Propiedades ');
		//extraer todas las propiedades
		$totalPropiedades=$this->propiedades_model->get_all_propiedades_usuarios();
		// paginacion de resultados 
		$this->paginador->paginacion_enlaces(count($totalPropiedades));
		if(isset($_GET["pag"])){
			$this->paginador->inicio_limite_paginacion($_GET["pag"]);
		}else{
			$this->paginador->inicio_limite_paginacion($paginas=null);
		}
		$propiedades=$this->propiedades_model->get_all_propiedades_usuarios_limite($this->paginador->configPaginador["limiteInicio"]);
		$this->varsPaginacion["url"]=base_url()."Propiedades";
		$this->varsPaginacion["pagination"]="index";
		$this->layout->view('index',compact('propiedades','totalPropiedades'));

	}

	public function buscar_id_propiedad(){

		$this->layout->setTitle(' Interhabita - Publicidad y Promoción en Internet para Profesionales Inmobiliarios - Propiedades ');
		//extraer todas las propiedades
		$totalPropiedades=$this->propiedades_model->get_all_propiedades_usuarios_parametro($busqueda="id_propiedad", $_POST["id_propiedad"]);
		// paginacion de resultados 
		$this->paginador->paginacion_enlaces(count($totalPropiedades));
		if(isset($_GET["pag"])){
			$this->paginador->inicio_limite_paginacion($_GET["pag"]);
		}else{
			$this->paginador->inicio_limite_paginacion($paginas=null);
		}
		$propiedades=$this->propiedades_model->get_all_propiedades_usuarios_parametro_limite($busqueda="id_propiedad", $_POST["id_propiedad"], $this->paginador->configPaginador["limiteInicio"]);
		$this->varsPaginacion["url"]=base_url()."Propiedades/buscar_id_propiedad";
		$this->varsPaginacion["pagination"]="id_propiedad";
		$this->varsPaginacion["id_propiedad"]=$_POST["id_propiedad"];
		$this->layout->view('Propiedades',compact('propiedades','totalPropiedades'));

	}

	public function buscar_propiedades_anunciante(){

		$this->layout->setTitle(' Interhabita - Publicidad y Promoción en Internet para Profesionales Inmobiliarios - Propiedades ');
		//extraer todas las propiedades
		$totalPropiedades=$this->propiedades_model->get_all_propiedades_usuarios_parametro($busqueda="anunciante", $_POST["anunciante"]);
		// paginacion de resultados 
		$this->paginador->paginacion_enlaces(count($totalPropiedades));
		if(isset($_POST["pag"])){
			$this->paginador->inicio_limite_paginacion($_POST["pag"]);
		}else{
			$this->paginador->inicio_limite_paginacion($paginas=null);
		}
		$propiedades=$this->propiedades_model->get_all_propiedades_usuarios_parametro_limite($busqueda="anunciante", $_POST["anunciante"], $this->paginador->configPaginador["limiteInicio"]);
		$this->varsPaginacion["url"]=base_url()."Propiedades/buscar_propiedades_anunciante";
		$this->varsPaginacion["pagination"]="anunciante";
		$this->varsPaginacion["anunciante"]=$_POST["anunciante"];
		$this->layout->view('Propiedades',compact('propiedades','totalPropiedades'));

	}

	public function buscar_propiedades_titulo(){

		$this->layout->setTitle(' Interhabita - Publicidad y Promoción en Internet para Profesionales Inmobiliarios - Propiedades ');
		//extraer todas las propiedades
		$totalPropiedades=$this->propiedades_model->get_all_propiedades_usuarios_parametro($busqueda="titulo", $_POST["titulo"]);
		// paginacion de resultados 
		$this->paginador->paginacion_enlaces(count($totalPropiedades));
		if(isset($_POST["pag"])){
			$this->paginador->inicio_limite_paginacion($_POST["pag"]);
		}else{
			$this->paginador->inicio_limite_paginacion($paginas=null);
		}
		$propiedades=$this->propiedades_model->get_all_propiedades_usuarios_parametro_limite($busqueda="titulo", $_POST["titulo"], $this->paginador->configPaginador["limiteInicio"]);
		$this->varsPaginacion["url"]=base_url()."Propiedades/buscar_propiedades_titulo";
		$this->varsPaginacion["pagination"]="titulo";
		$this->varsPaginacion["titulo"]=$_POST["titulo"];
		$this->layout->view('Propiedades',compact('propiedades','totalPropiedades'));

	}

	public function buscar_propiedades_estado(){

		$this->layout->setTitle(' Interhabita - Publicidad y Promoción en Internet para Profesionales Inmobiliarios - Propiedades ');
		//extraer el id del estado por el nombre de estado
		$estados=$this->propiedades_model->get_id_estado_por_nombre($_POST["estado"]);
		$totalPropiedades=$this->propiedades_model->get_all_propiedades_usuarios_parametro($busqueda="estado", $estados->id_estado);
		// paginacion de resultados 
		$this->paginador->paginacion_enlaces(count($totalPropiedades));
		if(isset($_POST["pag"])){
			$this->paginador->inicio_limite_paginacion($_POST["pag"]);
		}else{
			$this->paginador->inicio_limite_paginacion($paginas=null);
		}
		$propiedades=$this->propiedades_model->get_all_propiedades_usuarios_parametro_limite($busqueda="estado", $estados->id_estado, $this->paginador->configPaginador["limiteInicio"]);
		$this->varsPaginacion["url"]=base_url()."Propiedades/buscar_propiedades_estado";
		$this->varsPaginacion["pagination"]="estado";
		$this->varsPaginacion["estado"]=$_POST["estado"];
		$this->layout->view('Propiedades',compact('propiedades','totalPropiedades'));

	}

	public function buscar_propiedades_delegacion(){

		$this->layout->setTitle(' Interhabita - Publicidad y Promoción en Internet para Profesionales Inmobiliarios - Propiedades ');
		//extraer el id del delegacion por el nombre de delegacion
		$delegaciones=$this->propiedades_model->get_id_delegacion_por_nombre($_POST["delegacion"]);
		$totalPropiedades=$this->propiedades_model->get_all_propiedades_usuarios_parametro($busqueda="delegacion", $delegaciones->id_delegaciones);
		// paginacion de resultados 
		$this->paginador->paginacion_enlaces(count($totalPropiedades));
		if(isset($_POST["pag"])){
			$this->paginador->inicio_limite_paginacion($_POST["pag"]);
		}else{
			$this->paginador->inicio_limite_paginacion($paginas=null);
		}
		$propiedades=$this->propiedades_model->get_all_propiedades_usuarios_parametro_limite($busqueda="delegacion", $delegaciones->id_delegaciones, $this->paginador->configPaginador["limiteInicio"]);
		$this->varsPaginacion["url"]=base_url()."Propiedades/buscar_propiedades_delegacion";
		$this->varsPaginacion["pagination"]="delegacion";
		$this->varsPaginacion["delegacion"]=$_POST["delegacion"];
		$this->layout->view('Propiedades',compact('propiedades','totalPropiedades'));

	}

	public function buscar_propiedades_colonia(){

		$this->layout->setTitle(' Interhabita - Publicidad y Promoción en Internet para Profesionales Inmobiliarios - Propiedades ');
		//extraer el id del colonia por el nombre de colonia
		$colonia=$this->propiedades_model->get_id_colonias_por_nombre($_POST["colonia"]);
		$totalPropiedades=$this->propiedades_model->get_all_propiedades_usuarios_parametro($busqueda="colonia", $colonia->id_colonias);
		// paginacion de resultados 
		$this->paginador->paginacion_enlaces(count($totalPropiedades));
		if(isset($_POST["pag"])){
			$this->paginador->inicio_limite_paginacion($_POST["pag"]);
		}else{
			$this->paginador->inicio_limite_paginacion($paginas=null);
		}
		$propiedades=$this->propiedades_model->get_all_propiedades_usuarios_parametro_limite($busqueda="colonia", $colonia->id_colonias, $this->paginador->configPaginador["limiteInicio"]);
		$this->varsPaginacion["url"]=base_url()."Propiedades/buscar_propiedades_colonia";
		$this->varsPaginacion["pagination"]="colonia";
		$this->varsPaginacion["colonia"]=$_POST["colonia"];
		$this->layout->view('Propiedades',compact('propiedades','totalPropiedades'));

	}

	public function buscar_propiedades_fecha(){

		$this->layout->setTitle(' Interhabita - Publicidad y Promoción en Internet para Profesionales Inmobiliarios - Propiedades ');
		
		$totalPropiedades=$this->propiedades_model->get_all_propiedades_usuarios_parametro($busqueda="fecha", $_POST["fechaDe"]);
		// paginacion de resultados 
		$this->paginador->paginacion_enlaces(count($totalPropiedades));
		if(isset($_POST["pag"])){
			$this->paginador->inicio_limite_paginacion($_POST["pag"]);
		}else{
			$this->paginador->inicio_limite_paginacion($paginas=null);
		}
		$propiedades=$this->propiedades_model->get_all_propiedades_usuarios_parametro_limite($busqueda="fecha", $_POST["fechaDe"], $this->paginador->configPaginador["limiteInicio"]);
		$this->varsPaginacion["url"]=base_url()."Propiedades/buscar_propiedades_fecha";
		$this->varsPaginacion["pagination"]="fecha";
		$this->varsPaginacion["fechaDe"]=$_POST["fechaDe"];
		$this->varsPaginacion["fechaA"]=$_POST["fechaA"];
		$this->layout->view('Propiedades',compact('propiedades','totalPropiedades'));

	}

	



}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */