<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->layout->setLayout('template');
	}

	public function index(){

		//primero debemos validar que el usuario y pass no vengan vacios
		if($_POST["login"]=="" && $_POST["pass"]==""){

			echo "Ingresa tu Correo y Password para Accesar";

			exit;

		}else
			if($_POST["login"]=="" or $_POST["pass"]==""){

				echo "Ingresa tu Correo y/ó Password";

				exit;

		}

		//despues llamamos al metodo que valida que el user exista en la base de datos
		$this->usuarios_model->login();
		

		
	}

	public function cerrar_sesion(){

		$this->usuarios_model->cerrar_sesion();

	}

}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */