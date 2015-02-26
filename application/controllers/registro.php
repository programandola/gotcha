<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Registro extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->layout->setLayout('template');
	}

	public function index(){
	
		//validaciones de campos del registro
		if($this->input->post('nombre')==""){
			echo "El campo nombre es Obligatorio";
			exit;
		}
		else
			if($this->input->post('apellidos')==""){
				echo "El campo Apellidos es Obligatorio";
				exit;

		}
		else
			if($this->input->post('correo')==""){
				echo "El campo Correo es Obligatorio";
				exit;

		}
		else
			if($this->input->post('telefono')==""){
				echo "El campo Telefono es Obligatorio";
				exit;

		}
		else
			if($this->input->post('pass')==""){
				echo "El campo Password es Obligatorio";
				exit;

		}else
			if($this->input->post('c-pass')==""){
				echo "El campo Confirmar Password es Obligatorio";
				exit;

		}else
			if($this->input->post('comboEstado')==""){
				echo "Selecciona tu Estado";
				exit;

		}else
			if($this->input->post('comboAnunciante')==""){
				echo "Selecciona el tipo de Anunciante";
				exit;

		}

		//validamos el correo electronico sea correcto
		$this->propiedades_model->valida_email($this->input->post("correo"));

		//valida que los passwords sean iguales
		if($this->input->post('pass') != $this->input->post('c-pass')){
			echo "Los Passwords no coinciden, reintentar";
			exit;
		}

		//valida la longitud del password que sea mínimo 6 caracteres
		if(strlen($this->input->post('pass'))< 6){
			echo "Tú password debe tener mínimo 6 caracteres";
			exit;
		}

		//validamos si se eligio en tipo de anunciante agencia inmobiliaria ó constructor si es asi validamos que el campo empresa no venga vacio
		if($this->input->post('comboAnunciante')==2 || $this->input->post('comboAnunciante')==3){

			if($this->input->post('empresa')==""){

				echo "Ingresa el nombre de tu Empresa Inmobiliaria";
				exit;

			}

		}

		//descartado a peticion del usuario el campo login
		//$this->usuarios_model->valida_user_registro($_POST["login"]);

		$this->usuarios_model->valida_correo_registro($this->input->post('correo'));

		$this->usuarios_model->registro_anunciantes_clientes();

		
	}


}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */