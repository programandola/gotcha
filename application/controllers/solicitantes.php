<?php 
session_start();
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Solicitantes extends CI_Controller {

	public $varsPaginacion;

	public function __construct(){
		parent::__construct();
		$this->layout->setLayout('template');
		$paginador=new Paginador();
		$carrito=new Carrito();
		$this->varsPaginacion=array();
		if(!$this->session->userdata('login')){
			header("Location:".base_url());
		}
	}

	public function index($opcion){

		$this->layout->setTitle(' Interhabita - Publicidad y Promoción en Internet para Profesionales Inmobiliarios - Solicitantes ');
	
		//clientes pago
		$paginacionPago=true;
		$paginacionSinPago=true;

		$this->layout->view('solicitantes',compact('paginacionPago','paginacionSinPago','opcion'));

	}

	public function solicitantes_sin_pago(){
		$this->layout->setTitle(' Interhabita - Publicidad y Promoción en Internet para Profesionales Inmobiliarios - Solicitantes ');
		$numRegistros=$this->solicitantes_model->get_solicitantes_propiedades($status="Sin Pagar");
		// paginacion de resultados 
		$this->paginador->paginacion_enlaces(count($numRegistros));
		if(isset($_POST["pag"])){
			$this->paginador->inicio_limite_paginacion($_POST["pag"]);
		}else{
			$this->paginador->inicio_limite_paginacion($paginas=null);
		}

		$solicitantesSinPago=$this->solicitantes_model->get_solicitantes_propiedades_limite($status="Sin Pagar", $this->paginador->configPaginador["limiteInicio"]);
		$this->varsPaginacion["urlSinPago"]=base_url()."solicitantes/solicitantes_sin_pago";
		$this->layout->view('solicitantes_sin_pago',compact('solicitantesSinPago','numRegistros'));
	}

	public function solicitantes_pago(){
		$this->layout->setTitle(' Interhabita - Publicidad y Promoción en Internet para Profesionales Inmobiliarios - Solicitantes ');
		$numRegistrosPago=$this->solicitantes_model->get_solicitantes_propiedades($status="Pagado");
		// paginacion de resultados 
		$this->paginador->paginacion_enlaces(count($numRegistrosPago));
		if(isset($_POST["pag"])){
			$this->paginador->inicio_limite_paginacion($_POST["pag"]);
		}else{
			$this->paginador->inicio_limite_paginacion($paginas=null);
		}

		$solicitantesPago=$this->solicitantes_model->get_solicitantes_propiedades_limite($status="Pagado", $this->paginador->configPaginador["limiteInicio"]);
		$this->varsPaginacion["urlPago"]=base_url()."solicitantes/solicitantes_pago";
		$this->layout->view('solicitantes_pago',compact('solicitantesPago','numRegistrosPago'));
	}

	public function orden_compra(){

		//primero insertamos la orden de compra
		$lastInsertId=$this->solicitantes_model->add_orden_compra($_GET["id"]);

		//después insertamos los detalles de la compra en la tabla detales_orden_compra
		//recorremos la sesion de carrito para agregar cada uno de los solicitantes a la tabla
		foreach ($_SESSION["carrito"] as $item) {
			foreach ($item as $key => $value) {
				if($key=="idCliente"){
					$idSolicitantesPropiedades=$value;
				}
			}
			//inserto en la tabla solicitantes propiedades el registro
			$this->solicitantes_model->add_detalles_orden_compra($idSolicitantesPropiedades, $lastInsertId);
		}

		$carrito=$_SESSION["carrito"];
		$this->layout->setLayout('templateDeposito');
		$this->layout->view('orden', compact('carrito','lastInsertId'));

	}

	//carrito de compra
	public function add_item_carrito(){

		$this->carrito->add_item_carrito($_POST["idCLiente"], $_POST["propiedad"], $_POST["cliente"], $_POST["costoTransaccion"]);

		$this->carrito->view_carrito();

	}

	public function delete_item_carrito(){

		$this->carrito->delete_item_carrito($_POST["item"]);

		$this->carrito->view_carrito();

	}

	public function carrito_compras(){

		$this->layout->setTitle(' Interhabita - Publicidad y Promoción en Internet para Profesionales Inmobiliarios - Carrito Compra ');

		if(isset($_GET["item"])){

			$this->carrito->delete_item_carrito($_GET["item"]);

		}

		$this->layout->view('carrito_compras');	

	}

	public function pago_correcto_paypapl(){

		$this->layout->setTitle(' Interhabita - Publicidad y Promoción en Internet para Profesionales Inmobiliarios - Pago Correcto Paypal ');


		$this->layout->view('paypal_success');

	}


}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

