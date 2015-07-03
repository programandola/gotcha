<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Costotransaccion extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->layout->setLayout('template');
		if(!$this->session->userdata('login')){
			header("Location:".base_url());
		}
	}

	public function index(){

		$this->layout->setTitle(' Interhabita - Publicidad y Promoción en Internet para Profesionales Inmobiliarios - Costo Transacción ');
		$costos=$this->propiedades_model->get_costos_transacciones_paypal();

		$this->layout->view('index', compact('costos'));

	}

	public function edita_costo_transaccion($idTipoPropiedad){

		$datos=$this->propiedades_model->get_costos_transacciones_paypal_tipo_propiedad_por_id($idTipoPropiedad);

		$this->layout->view('edita_costo_transaccion_paypal',compact('datos'));

	}

	public function actualiza_costo_transaccion(){

		if($_POST["costo"]==""){

			echo "Ingresa el Costo de la Transacción";

			exit;

		}

		$this->propiedades_model->actualiza_costo_transaccion();

		echo "Se actualizo el Costo de Transacción Correctamente";

	}

	

}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

