<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mispropiedades extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->layout->setLayout('template');
		if(!$this->session->userdata('login')){
			header("Location:".base_url());
		}
	}

	public function index(){

		//para listar las propiedades del usuario - cliente
		$misPropiedades=$this->propiedades_model->get_propiedades_id_cliente();

		$this->layout->view('index', compact('misPropiedades'));

	}


}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

