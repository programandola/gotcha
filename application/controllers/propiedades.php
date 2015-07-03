<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Propiedades extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->layout->setLayout('template');
	}

	public function index($nombreTipoPropiedad=null, $nombrePropiedad=null, $idPropiedad=null){

		$this->layout->setTitle(' Interhabita - Publicidad y Promoción en Internet para Profesionales Inmobiliarios - '.$nombreTipoPropiedad.' ');
		$tipo_propiedad=$this->propiedades_model->get_tipo_propiedad();
		$estados=$this->propiedades_model->get_estados();
		$datosPropiedad=$this->propiedades_model->get_propiedad_por_id($idPropiedad);
		$fotosPropiedad=$this->propiedades_model->get_all_fotos_propiedades($idPropiedad);

		$this->layout->view('index', compact('nombreTipoPropiedad', 'tipo_propiedad', 'estados', 'datosPropiedad', 'fotosPropiedad'));

	}

	public function contacto(){

		if($this->input->post("nombre")==""){

			echo "<p>Ingresa tu Nombre</p>";

			exit;

		}else
			if($this->input->post("correo")==""){

			echo "<p>Ingresa tu Correo</p>";

			exit;
			
		}else
			if($this->input->post("telefono")==""){

			echo "<p>Ingresa tu Telefono</p>";

			exit;
			
		}

		//validamos el correo electronico sea correcto
		$this->propiedades_model->valida_email($this->input->post("correo"));

		$datosUserAnunciante=$this->usuarios_model->get_user_por_id_categoria_propiedad($this->input->post("id_propiedad"));

		//ingresamos el nuevo cliente y recuperamos el id de ese cliente
		$lastInsertedId=$this->solicitantes_model->ingresa_clientes();

		//extraemos los datos del solicitante ingresado ó existente
		$datosSolicitante=$this->solicitantes_model->get_solicitante_por_id($lastInsertedId);

		//ingresamos en la tabla solicitantes-propiedades al cliente
		$this->solicitantes_model->ingresa_solicitantes_propiedades($lastInsertedId, $this->input->post("id_propiedad"));
		
		$this->contacto_model->envia_mensaje_email_anunciante_y_admin($datosUserAnunciante, $datosSolicitante);

	}

	public function envia_contacto_logeado(){

		if($this->input->post("mensaje")==""){

			echo "<p>Ingresa tus Observaciones</p>";

			exit;
			
		}

		//obtenemos los datos del usuario cliente que ya inicio sesion
		$userData=$this->usuarios_model->get_user_por_id($this->session->userdata('idUser'));

		$datosUserAnunciante=$this->usuarios_model->get_user_por_id_categoria_propiedad($this->input->post("id_propiedad"));

		//ingresamos en la tabla clientes_interesados al cliente
		$this->clientes_model->ingresa_clientes_interesados_propiedades($userData->id_usuario, $this->input->post("id_propiedad"));
		
		$this->contacto_model->envia_mensaje_email_anunciante_y_admin($datosUserAnunciante);

	}




}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */