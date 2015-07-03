<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Interesados extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->layout->setLayout('template');
		$paginador=new Paginador();
		if(!$this->session->userdata('login')){
			header("Location:".base_url());
		}
	}

	public function index(){

		$this->layout->setTitle(' Interhabita - Publicidad y Promoción en Internet para Profesionales Inmobiliarios - Solicitantes ');
		$numRegistros=$this->solicitantes_model->get_all_solicitantes_propiedades();
		$this->paginador->paginacion_enlaces(count($numRegistros));
		if(isset($_GET["pag"])){
			$this->paginador->inicio_limite_paginacion($_GET["pag"]);
		}else{
			$this->paginador->inicio_limite_paginacion();
		}
		$datos=$this->solicitantes_model->get_solicitantes_propiedades_limite(null, $this->paginador->configPaginador["limiteInicio"],null);
		$this->varsPaginacion["url"]=base_url()."interesados";
		$this->varsPaginacion["pagination"]="index";
		$this->layout->view('index', compact('datos','numRegistros'));
	}


	public function nombre_asc(){

		//$datos=$this->solicitantes_model->get_all_clientes_interesados_por_parametro('nombre', );
		//$this->paginador->paginacion_enlaces(count($datos));
		//$this->layout->view('interesados', compact('datos'));

	}

	public function fecha_asc(){

		//$interesados=$this->clientes_model->get_all_clientes_interesados_fecha_asc();

		//$interesadosUsersRegistro=$this->clientes_model->get_all_clientes_interesados_usuarios_registro_fecha_asc();

		//$datos=$this->clientes_model->get_agrupa_datos_clientes_interesados($interesados, $interesadosUsersRegistro);

		//$this->layout->view('interesados', compact('datos'));

	}

	public function buscar_interesado_nombre(){

		if(isset($_POST["pag"])){
			$this->paginador->inicio_limite_paginacion($_POST["pag"]);
		}else{
			$this->paginador->inicio_limite_paginacion();
		}
		$numRegistros=$this->solicitantes_model->get_all_clientes_interesados_por_parametro($opcion="nombre", $_POST["nombre"]);
		$this->paginador->paginacion_enlaces(count($numRegistros));
		$datos=$this->solicitantes_model->get_all_clientes_interesados_por_parametro_limite($opcion="nombre", $_POST["nombre"], $this->paginador->configPaginador["limiteInicio"]);
		$this->varsPaginacion["url"]=base_url()."interesados/buscar_interesado_nombre";
		$this->varsPaginacion["pagination"]="nombre";
		$this->varsPaginacion["nombre"]=$_POST["nombre"];
		$this->layout->view('interesados', compact('datos','numRegistros'));

	}

	public function buscar_interesado_propiedad(){


		if(isset($_POST["pag"])){
			$this->paginador->inicio_limite_paginacion($_POST["pag"]);
		}else{
			$this->paginador->inicio_limite_paginacion();
		}
		$numRegistros=$this->solicitantes_model->get_all_clientes_interesados_por_parametro($opcion="propiedad", $_POST["propiedad"]);
		$this->paginador->paginacion_enlaces(count($numRegistros));
		$datos=$this->solicitantes_model->get_all_clientes_interesados_por_parametro_limite($opcion="propiedad", $_POST["propiedad"], $this->paginador->configPaginador["limiteInicio"]);
		$this->varsPaginacion["url"]=base_url()."interesados/buscar_interesado_propiedad";
		$this->varsPaginacion["pagination"]="propiedad";
		$this->varsPaginacion["propiedad"]=$_POST["propiedad"];

		$this->layout->view('interesados', compact('datos','numRegistros'));
		
	}


	public function buscar_interesado_fecha(){

		if(isset($_POST["pag"])){
			$this->paginador->inicio_limite_paginacion($_POST["pag"]);
		}else{
			$this->paginador->inicio_limite_paginacion();
		}
		$numRegistros=$this->solicitantes_model->get_all_clientes_interesados_por_parametro($opcion="fecha", null);
		$this->paginador->paginacion_enlaces(count($numRegistros));
		$datos=$this->solicitantes_model->get_all_clientes_interesados_por_parametro_limite($opcion="fecha", $campo=null, $this->paginador->configPaginador["limiteInicio"]);
		$this->varsPaginacion["url"]=base_url()."interesados/buscar_interesado_fecha";
		$this->varsPaginacion["pagination"]="fecha";
		$this->varsPaginacion["fechaDe"]=$_POST["fechaDe"];
		$this->varsPaginacion["fechaA"]=$_POST["fechaA"];
		$this->layout->view('interesados', compact('datos','numRegistros'));

	}
	

}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

