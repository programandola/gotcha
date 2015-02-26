<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Deposito extends CI_Controller {

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

		$this->layout->setTitle(' Interhabita - Publicidad y Promoción en Internet para Profesionales Inmobiliarios - Deposito ');
		$numRegistros=$this->solicitantes_model->get_solicitantes_propiedades($status="Sin Pagar", "deposito");

		// paginacion de resultados 
		$this->paginador->paginacion_enlaces(count($numRegistros));
		if(isset($_GET["pag"])){
			$this->paginador->inicio_limite_paginacion($_GET["pag"]);
		}else{
			$this->paginador->inicio_limite_paginacion($paginas=null);
		}

		$solicitantesSinPago=$this->solicitantes_model->get_solicitantes_propiedades_limite($status="Sin Pagar", $this->paginador->configPaginador["limiteInicio"], "deposito");
		
		$this->varsPaginacion["url"]=base_url()."deposito";
		$this->varsPaginacion["pagination"]="index";
		$this->layout->view('index',compact('solicitantesSinPago','numRegistros'));

	}


	public function solicitantes_sin_pago_nombre(){

		$this->layout->setTitle(' Interhabita - Publicidad y Promoción en Internet para Profesionales Inmobiliarios - Deposito ');
		$numRegistros=$this->solicitantes_model->get_all_clientes_interesados_ficha_deposito_parametro("nombre", $_POST["nombre"], $status="Sin Pagar");
		//paginacion de resultados 
		$this->paginador->paginacion_enlaces(count($numRegistros));
		if(isset($_POST["pag"])){
			$this->paginador->inicio_limite_paginacion($_POST["pag"]);
		}else{
			$this->paginador->inicio_limite_paginacion($paginas=null);
		}


		$solicitantesSinPago=$this->solicitantes_model->get_all_clientes_interesados_ficha_deposito_parametro_limite("nombre", $_POST["nombre"], $status="Sin Pagar", $this->paginador->configPaginador["limiteInicio"]);
		$this->varsPaginacion["url"]=base_url()."deposito/solicitantes_sin_pago_nombre";
		$this->varsPaginacion["pagination"]="nombre";
		$this->varsPaginacion["nombre"]=$_POST["nombre"];
		$this->layout->view('deposito',compact('solicitantesSinPago','numRegistros'));

	}

	public function solicitantes_sin_pago_id_propiedad(){

		$this->layout->setTitle(' Interhabita - Publicidad y Promoción en Internet para Profesionales Inmobiliarios - Deposito ');
		$numRegistros=$this->solicitantes_model->get_all_clientes_interesados_ficha_deposito_parametro("id_propiedad", $_POST["id_propiedad"], $status="Sin Pagar");
		//paginacion de resultados 
		$this->paginador->paginacion_enlaces(count($numRegistros));
		if(isset($_POST["pag"])){
			$this->paginador->inicio_limite_paginacion($_POST["pag"]);
		}else{
			$this->paginador->inicio_limite_paginacion($paginas=null);
		}
		$solicitantesSinPago=$this->solicitantes_model->get_all_clientes_interesados_ficha_deposito_parametro_limite("id_propiedad", $_POST["id_propiedad"], $status="Sin Pagar", $this->paginador->configPaginador["limiteInicio"]);

		$this->varsPaginacion["url"]=base_url()."deposito/solicitantes_sin_pago_id_propiedad";
		$this->varsPaginacion["pagination"]="idPropiedad";
		$this->varsPaginacion["id_propiedad"]=$_POST["id_propiedad"];
		$this->layout->view('deposito',compact('solicitantesSinPago','numRegistros'));

	}


	public function solicitantes_sin_pago_propiedad(){

		$this->layout->setTitle(' Interhabita - Publicidad y Promoción en Internet para Profesionales Inmobiliarios - Deposito ');
		$numRegistros=$this->solicitantes_model->get_all_clientes_interesados_ficha_deposito_parametro("propiedad", $_POST["propiedad"], $status="Sin Pagar");
		//paginacion de resultados 
		$this->paginador->paginacion_enlaces(count($numRegistros));
		if(isset($_POST["pag"])){
			$this->paginador->inicio_limite_paginacion($_POST["pag"]);
		}else{
			$this->paginador->inicio_limite_paginacion($paginas=null);
		}
		$solicitantesSinPago=$this->solicitantes_model->get_all_clientes_interesados_ficha_deposito_parametro_limite("propiedad", $_POST["propiedad"], $status="Sin Pagar", $this->paginador->configPaginador["limiteInicio"]);
		$this->varsPaginacion["url"]=base_url()."deposito/solicitantes_sin_pago_propiedad";
		$this->varsPaginacion["pagination"]="propiedad";
		$this->varsPaginacion["propiedad"]=$_POST["propiedad"];
		$this->layout->view('deposito',compact('solicitantesSinPago','numRegistros'));

	}

	public function solicitantes_sin_pago_fecha(){

		$this->layout->setTitle(' Interhabita - Publicidad y Promoción en Internet para Profesionales Inmobiliarios - Deposito ');
		$numRegistros=$this->solicitantes_model->get_all_clientes_interesados_ficha_deposito_parametro("fecha", "fecha", $status="Sin Pagar");
		//paginacion de resultados 
		$this->paginador->paginacion_enlaces(count($numRegistros));
		if(isset($_POST["pag"])){
			$this->paginador->inicio_limite_paginacion($_POST["pag"]);
		}else{
			$this->paginador->inicio_limite_paginacion($paginas=null);
		}
		$solicitantesSinPago=$this->solicitantes_model->get_all_clientes_interesados_ficha_deposito_parametro_limite("fecha", "fecha", $status="Sin Pagar", $this->paginador->configPaginador["limiteInicio"]);
		$this->varsPaginacion["url"]=base_url()."deposito/solicitantes_sin_pago_fecha";
		$this->varsPaginacion["pagination"]="fecha";
		$this->varsPaginacion["fechaDe"]=$_POST["fechaDe"];
		$this->varsPaginacion["fechaA"]=$_POST["fechaA"];
		$this->layout->view('deposito',compact('solicitantesSinPago','numRegistros'));

	}


	public function solicitantes_sin_pago_nombre_anunciante(){

		$this->layout->setTitle(' Interhabita - Publicidad y Promoción en Internet para Profesionales Inmobiliarios - Deposito ');
		$numRegistros=$this->solicitantes_model->get_all_clientes_interesados_ficha_deposito_parametro("anunciante", $_POST["nombre"], $status="Sin Pagar");
		//paginacion de resultados 
		$this->paginador->paginacion_enlaces(count($numRegistros));
		if(isset($_POST["pag"])){
			$this->paginador->inicio_limite_paginacion($_POST["pag"]);
		}else{
			$this->paginador->inicio_limite_paginacion($paginas=null);
		}
		$solicitantesSinPago=$this->solicitantes_model->get_all_clientes_interesados_ficha_deposito_parametro_limite("anunciante", $_POST["nombre"], $status="Sin Pagar", $this->paginador->configPaginador["limiteInicio"]);
		$this->varsPaginacion["url"]=base_url()."deposito/solicitantes_sin_pago_nombre_anunciante";
		$this->varsPaginacion["pagination"]="anunciante";
		$this->varsPaginacion["nombre"]=$_POST["nombre"];
		$this->layout->view('deposito',compact('solicitantesSinPago','numRegistros'));

	}

	public function confirm_deposito($id){

		$this->layout->setTitle(' Interhabita - Publicidad y Promoción en Internet para Profesionales Inmobiliarios - Agregar Deposito ');
		$solicitante=$this->solicitantes_model->get_solicitante_propiedad_por_id($id);
		$costoTransaccion=$this->propiedades_model->get_costos_transacciones_paypal_tipo_propiedad_por_id($solicitante->id_categoria);

		$this->layout->view('add_deposito', compact('solicitante','costoTransaccion'));
	}

	public function add_deposito(){

		//validar que se seleccione un metodo de pago
		if($_POST["idFormaPago"]==""){

			echo "Debes de Ingresar un método de pago";
			exit;

		}

		$this->solicitantes_model->add_pago_deposito($_POST["id"], $_POST["fechaPagoDeposito"], $_POST["idFormaPago"]);
		//enviamos el mail al anunciante con los datos del solicitante
		$this->solicitantes_model->envia_mail_anunciante_con_datos_solicitante($_POST["id"]);

	}


}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

