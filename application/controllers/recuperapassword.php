<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Recuperapassword extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->layout->setLayout('template');
	}

	public function index(){

		//validaciones de campos del registro
		if($_POST["correoUsuario"]==""){

			echo "Ingresa tu Correo";

			exit;
		}
		
		//validamos si el correo existe en la base de datos
		$userDatos=$this->usuarios_model->get_user_por_correo($_POST["correoUsuario"]);
		if( count($userDatos) == 0 ){

			echo "EL mail ingresado no existe en nuestro sistema";

			exit;

		}

		$this->usuarios_model->recupera_password_usuario($userDatos->id_usuario, $userDatos->correo);
	
		
	}


	public function restablecer($sha1IdUsuario, $sha1Correo){

		

	}


}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */