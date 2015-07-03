<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Cronjobspropiedades extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->layout->setLayout('template');
	}

	public function actualiza(){

		//ejecuto el metodo para enviar correo y desactivar propiedades caducas
		$this->propiedades_model->envia_correo_anunciante_propiedad_caducada_y_desactiva();

		
	}


}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */