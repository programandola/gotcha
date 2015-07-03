<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Pagos extends CI_Controller {

	public $activaPaginacion;
	public $varsPaginacion;

	public function __construct(){
		parent::__construct();
		$this->layout->setLayout('template');
		$paginador=new Paginador();
		$this->varsPaginacion=array();
		if(!$this->session->userdata('login')){
			header("Location:".base_url());
		}
	}

	public function index(){

		$this->layout->setTitle(' Interhabita - Publicidad y Promoción en Internet para Profesionales Inmobiliarios - Reportes Paypal ');

		//extraer todos los reportes paypal
		$numRegistros=$this->solicitantes_model->get_all_pagos_paypal();
		// paginacion de resultados 
		$this->paginador->paginacion_enlaces(count($numRegistros));
		if(isset($_POST["pag"])){
			$this->paginador->inicio_limite_paginacion($_POST["pag"]);
		}else{
			$this->paginador->inicio_limite_paginacion($paginas=null);
		}
		$datos=$this->solicitantes_model->get_all_pagos_paypal_parametro_limite(null, null, $this->paginador->configPaginador["limiteInicio"], "undefined");
		$this->varsPaginacion["url"]=base_url()."pagos/paginacion_index";
		$this->varsPaginacion["controler"]="index";
		$this->layout->view('index',compact('datos','numRegistros'));
	

	}

	public function paginacion_index(){

		$this->layout->setTitle(' Interhabita - Publicidad y Promoción en Internet para Profesionales Inmobiliarios - Reportes Paypal ');
		//extraer todos los reportes paypal
		$numRegistros=$this->solicitantes_model->get_all_pagos_paypal();
		// paginacion de resultados 
		$this->paginador->paginacion_enlaces(count($numRegistros));
		if(isset($_POST["pag"])){
			$this->paginador->inicio_limite_paginacion($_POST["pag"]);
		}else{
			$this->paginador->inicio_limite_paginacion($paginas=null);
		}
		$datos=$this->solicitantes_model->get_all_pagos_paypal_parametro_limite(null, null, $this->paginador->configPaginador["limiteInicio"], "undefined");
		$this->varsPaginacion["url"]=base_url()."pagos/paginacion_index";
		$this->varsPaginacion["controler"]="index";
		$this->layout->view('pagos',compact('datos','numRegistros'));

	}

	public function get_paypal_anunciantes_nombre(){	
		
		
		//extraer todos los reportes paypal
		$numRegistros=$this->solicitantes_model->get_paypal_anunciantes_parametro("nombre", $_POST["anunciante"], $_POST["statusPago"]);
		// paginacion de resultados 
		$this->paginador->paginacion_enlaces(count($numRegistros));
		if(isset($_POST["pag"])){
			$this->paginador->inicio_limite_paginacion($_POST["pag"]);
		}else{
			$this->paginador->inicio_limite_paginacion($paginas=null);
		}
		$datos=$this->solicitantes_model->get_all_pagos_paypal_parametro_limite("nombre", $_POST["anunciante"], $this->paginador->configPaginador["limiteInicio"], $_POST["statusPago"]);
		
		$this->varsPaginacion["url"]=base_url()."pagos/get_paypal_anunciantes_nombre";
		$this->varsPaginacion["controler"]="nombre";
		$this->varsPaginacion["statusPago"]=$_POST["statusPago"];
		$this->varsPaginacion["anunciante"]=$_POST["anunciante"];
		$this->layout->view('pagos',compact('datos','numRegistros'));
		

	}

	public function get_paypal_anunciantes_fecha(){
		
		//extraer todos los reportes paypal
		$numRegistros=$this->solicitantes_model->get_paypal_anunciantes_parametro("fecha", null, $_POST["statusPago"]);
		// paginacion de resultados 
		$this->paginador->paginacion_enlaces(count($numRegistros));
		if(isset($_POST["pag"])){
			$this->paginador->inicio_limite_paginacion($_POST["pag"]);
		}else{
			$this->paginador->inicio_limite_paginacion($paginas=null);
		}
		$datos=$this->solicitantes_model->get_all_pagos_paypal_parametro_limite("fecha", null, $this->paginador->configPaginador["limiteInicio"], $_POST["statusPago"]);
		$this->varsPaginacion["url"]=base_url()."pagos/get_paypal_anunciantes_fecha";
		$this->varsPaginacion["fechaComparar"]=$_POST["fechaComparar"];
		$this->varsPaginacion["fechaDe"]=$_POST["fechaDe"];
		$this->varsPaginacion["fechaA"]=$_POST["fechaA"];
		$this->varsPaginacion["statusPago"]=$_POST["statusPago"];
		$this->varsPaginacion["controler"]="fecha";

		$this->layout->view('pagos',compact('datos','numRegistros','statusPago','url','controler'));

	}

	public function get_paypal_anunciantes_id_propiedad(){

		//extraer todos los reportes paypal
		$numRegistros=$this->solicitantes_model->get_paypal_anunciantes_parametro("propiedad", $_POST["idPropiedad"], null);
		// paginacion de resultados 
		$this->paginador->paginacion_enlaces(count($numRegistros));
		if(isset($_POST["pag"])){
			$this->paginador->inicio_limite_paginacion($_POST["pag"]);
		}else{
			$this->paginador->inicio_limite_paginacion($paginas=null);
		}
		$datos=$this->solicitantes_model->get_all_pagos_paypal_parametro_limite("idPropiedadPaypal", $_POST["idPropiedad"], $this->paginador->configPaginador["limiteInicio"], "undefined");
		$this->varsPaginacion["url"]=base_url()."pagos/get_paypal_anunciantes_id_propiedad";
		$this->varsPaginacion["controler"]="idpropiedad";
		$this->varsPaginacion["idPropiedad"]=$_POST["idPropiedad"];

		$this->layout->view('pagos',compact('datos','numRegistros'));

	}


	public function get_paypal_por_solicitante(){		

		//extraer todos los reportes paypal
		$numRegistros=$this->solicitantes_model->get_paypal_anunciantes_parametro("solicitante", $_POST["solicitante"], $_POST["statusPago"]);
		
		// paginacion de resultados 
		$this->paginador->paginacion_enlaces(count($numRegistros));
		if(isset($_POST["pag"])){
			$this->paginador->inicio_limite_paginacion($_POST["pag"]);
		}else{
			$this->paginador->inicio_limite_paginacion($paginas=null);
		}
		$datos=$this->solicitantes_model->get_all_pagos_paypal_parametro_limite("solicitante", $_POST["solicitante"], $this->paginador->configPaginador["limiteInicio"], $_POST["statusPago"]);

		$this->varsPaginacion["url"]=base_url()."pagos/get_paypal_por_solicitante";
		$this->varsPaginacion["controler"]="solicitante";
		$this->varsPaginacion["solicitante"]=$_POST["solicitante"];
		$this->varsPaginacion["statusPago"]=$_POST["statusPago"];

		$this->layout->view('pagos',compact('datos','numRegistros'));

	}

	



}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

