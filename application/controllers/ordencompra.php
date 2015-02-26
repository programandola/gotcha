<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ordencompra extends CI_Controller {

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

		$this->layout->setTitle(' Interhabita - Publicidad y Promoción en Internet para Profesionales Inmobiliarios - Orden de Compra ');
		
		$numRegistros=$this->solicitantes_model->get_all_orden_de_compra(null, null);

		// paginacion de resultados 
		$this->paginador->paginacion_enlaces(count($numRegistros));
		if(isset($_GET["pag"])){
			$this->paginador->inicio_limite_paginacion($_GET["pag"]);
		}else{
			$this->paginador->inicio_limite_paginacion($paginas=null);
		}

		$datos=$this->solicitantes_model->get_all_orden_de_compra_limite(null, null, $this->paginador->configPaginador["limiteInicio"]);
		
		$this->varsPaginacion["url"]=base_url()."ordencompra";
		$this->varsPaginacion["pagination"]="index";
		$this->layout->view('index',compact('datos','numRegistros'));

	}

	public function no_orden_compra(){

		$this->layout->setTitle(' Interhabita - Publicidad y Promoción en Internet para Profesionales Inmobiliarios - Orden de Compra ');
		
		$numRegistros=$this->solicitantes_model->get_all_orden_de_compra("idOrdenCompra", $this->input->post("idOrdenCompra"));

		// paginacion de resultados 
		$this->paginador->paginacion_enlaces(count($numRegistros));
		if(isset($_POST["pag"])){
			$this->paginador->inicio_limite_paginacion($this->input->post("pag"));
		}else{
			$this->paginador->inicio_limite_paginacion($paginas=null);
		}

		$datos=$this->solicitantes_model->get_all_orden_de_compra_limite("idOrdenCompra", $this->input->post("idOrdenCompra"), $this->paginador->configPaginador["limiteInicio"]);
		
		$this->varsPaginacion["url"]=base_url()."ordencompra/no_orden_compra";
		$this->varsPaginacion["pagination"]="no_orden_compra";
		$this->varsPaginacion["idOrdenCompra"]=$this->input->post("idOrdenCompra");
		$this->layout->view('ordencompra',compact('datos','numRegistros'));

	}

	public function orden_compra_anunciante(){

		$this->layout->setTitle(' Interhabita - Publicidad y Promoción en Internet para Profesionales Inmobiliarios - Orden de Compra ');
		
		$numRegistros=$this->solicitantes_model->get_all_orden_de_compra("anunciante", $this->input->post("anunciante"));

		// paginacion de resultados 
		$this->paginador->paginacion_enlaces(count($numRegistros));
		if(isset($_POST["pag"])){
			$this->paginador->inicio_limite_paginacion($this->input->post("pag"));
		}else{
			$this->paginador->inicio_limite_paginacion($paginas=null);
		}

		$datos=$this->solicitantes_model->get_all_orden_de_compra_limite("anunciante", $this->input->post("anunciante"), $this->paginador->configPaginador["limiteInicio"]);
		
		$this->varsPaginacion["url"]=base_url()."ordencompra/orden_compra_anunciante";
		$this->varsPaginacion["pagination"]="anunciante";
		$this->varsPaginacion["anunciante"]=$this->input->post("anunciante");
		$this->layout->view('ordencompra',compact('datos','numRegistros'));

	}

	public function orden_compra_fecha(){

		$this->layout->setTitle(' Interhabita - Publicidad y Promoción en Internet para Profesionales Inmobiliarios - Orden de Compra ');
		
		$numRegistros=$this->solicitantes_model->get_all_orden_de_compra("fecha", null);

		// paginacion de resultados 
		$this->paginador->paginacion_enlaces(count($numRegistros));
		if(isset($_POST["pag"])){
			$this->paginador->inicio_limite_paginacion($this->input->post("pag"));
		}else{
			$this->paginador->inicio_limite_paginacion($paginas=null);
		}

		$datos=$this->solicitantes_model->get_all_orden_de_compra_limite("fecha", null, $this->paginador->configPaginador["limiteInicio"]);
		
		$this->varsPaginacion["url"]=base_url()."ordencompra/orden_compra_fecha";
		$this->varsPaginacion["pagination"]="fecha";
		$this->varsPaginacion["fechaDe"]=$this->input->post("fechaDe");
		$this->varsPaginacion["fechaA"]=$this->input->post("fechaA");
		$this->layout->view('ordencompra',compact('datos','numRegistros'));

	}

	public function detalles_orden_compra($idOrdenCompra){

		$this->layout->setTitle(' Interhabita - Publicidad y Promoción en Internet para Profesionales Inmobiliarios - Detalles Orden de Compra ');
		
		$datos=$this->solicitantes_model->get_detalles_orden_de_compra($idOrdenCompra);

		$this->layout->view('detalles_orden_compra',compact('datos'));

	}


	public function activar_pago_orden_compra($idOrdenCompra){


		$this->layout->setTitle(' Interhabita - Publicidad y Promoción en Internet para Profesionales Inmobiliarios - Activar Pago Orden de Compra ');
		
		$datos=$this->solicitantes_model->get_detalles_orden_de_compra($idOrdenCompra);

		foreach ($datos as $value) {
			//acatualizamos el pago en la tabla
			$this->solicitantes_model->add_pago_deposito($value->id_solicitantes_propiedades, 2);
			//enviamos el mail al anunciante con los datos del solicitante
			$this->solicitantes_model->envia_mail_anunciante_con_datos_solicitante($value->id_solicitantes_propiedades);
		}

		//cambio el estado de la orden a true = pagada en la tabla orden_de_compra
		$this->solicitantes_model->status_orden_compra($status=true, $idOrdenCompra);

		$this->layout->view('pago_activado', compact('idOrdenCompra'));


	}


}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

