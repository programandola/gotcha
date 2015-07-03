<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Favoritos extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->layout->setLayout('template');
		if(!$this->session->userdata('login')){
			header("Location:".base_url());
		}
	}

	public function index(){

		$favoritos=$this->propiedades_model->get_favoritos_por_id_usuario();
			
		$this->layout->view('index', compact('favoritos'));

	}

	public function eliminar($idFavoritos=null){

		$this->propiedades_model->eliminar_favoritos($idFavoritos);

		redirect(base_url()."favoritos", 'refresh');

	}

	public function add_favoritos(){

		$this->propiedades_model->add_favoritos();

	}


}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

