<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Miperfil extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->layout->setLayout('template');
		if(!$this->session->userdata('login')){
			header("Location:".base_url());
		}
	}

	public function index(){

		$this->layout->setTitle(' Interhabita - Publicidad y Promoción en Internet para Profesionales Inmobiliarios - Mi Cuenta ');
		//recojo los datos del usuario mediante el metodo 
		$datosUser=$this->usuarios_model->get_user_por_id($this->session->userdata('idUser'));
		$estados=$this->propiedades_model->get_estados();
		$empresa=$this->usuarios_model->get_empresa_anunciante_por_id_usuario($this->session->userdata('idUser'));
		$this->layout->view('index',compact('datosUser','empresa','estados'));

	}

	public function updateUser(){

		//validamos los datos que no vengan vacios
		if($_POST["nombre"]==""){
			echo "Ingresa tu Nombre";
			exit;
		}else
			if($_POST["apellidos"]==""){
			echo "Ingresa tus Apellidos";
			exit;
		}else
			if($_POST["correo"]==""){
			echo "Ingresa tu Email";
			exit;
		}else
			if($_POST["telefono"]==""){
			echo "Ingresa tu Telefono";
			exit;
		}else
			if($_POST["estado"]==""){
			echo "Ingresa tu Ciudad ó Estado";
			exit;
		}

		if($_POST["inmobiliaria"]==true && $_POST["empresa"]==""){
			echo "Ingresa el Nombre de tu Agencia Inmobiliaria, Broker ó Constructora";
			exit;
		}


		//actualizar empresa inmobiliaria del usuario si cuenta con ella
		if($_POST["inmobiliaria"]==true){

			$this->usuarios_model->update_empresa_anunciante();

		}
		//actualizar los datos del usuario
		$this->usuarios_model->update_user();


	}

	public function updateUserPass(){

		//validar que los campos no vengan vacios 
		if( $_POST["passActual"]=="" or $_POST["passNuevo"]=="" or $_POST["passNuevoConfirm"]=="" ){

			echo "Ingresa los datos que se te piden";

			exit;
		}

		//validar que la contraseña nueva sea igual a contraseña nueva confirm
		if( $_POST["passNuevo"] != $_POST["passNuevoConfirm"] ){

			echo "Las Contraseña Nueva no coincide con la Confirmación de Contraseña Nueva";

			exit;
		}

		//valida la longitud del password que sea mínimo 6 caracteres
		if(strlen($_POST["passNuevo"])< 6){

			echo "Tú password debe tener mínimo 6 caracteres";

			exit;
			
		}

		//validar que el usuario actual sea el correspondiente en la base de datos
		if($this->usuarios_model->valida_pass_actual($_POST["passActual"])==true){

			$this->usuarios_model->update_user_pass();

		}
		else{

			echo "La contraseña Actual no corresponde reintentar</b>";

		}

	}

	public function upload(){

		if($_FILES["avatar"]["tmp_name"]==""){

			$this->session->set_flashdata('imagenError', "Selecciona una Imagen a Subir");

			redirect('/miperfil','refresh');

		}else{

			$error=NULL;
			$config['upload_path'] = './uploads/avatar/';
	        $config['allowed_types'] = 'gif|jpg|png|jpeg';
	        $config['max_size'] = '5120';
	        $config["overwrite"]=false;

	        $this->load->library('upload', $config);
	        if ( ! $this->upload->do_upload('avatar')){
	            $error = array('error' => $this->upload->display_errors());
	            $this->session->set_flashdata('ControllerMessage', $error["error"]);              			
	        }
	        if($error==null){
	            $ima = $this->upload->data();
	            $file_name = $ima['file_name'];
	        }

	        //para redimensrioar la imagen del usuario
	        $this->_create_thumbnail($file_name);

	        //insertamos el nombre de la imagen en la tabla de usuarios
	        $this->usuarios_model->update_avatar_user($file_name);

	        $this->session->set_flashdata('imagenOk', "Se Actualizo la Imagen de tu Cuenta");

	        redirect('/miperfil','refresh');

		}
		

	}

	//metodo para crear el tumbnail de la imagen subida
    function _create_thumbnail($filename){
        $config['image_library'] = 'gd2';
        //CARPETA EN LA QUE ESTÁ LA IMAGEN A REDIMENSIONAR
        $config['source_image'] = './uploads/avatar/'.$filename;
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        //CARPETA EN LA QUE GUARDAMOS LA MINIATURA
        $config['new_image']='./uploads/avatar/';
        $config['width'] = 200;
        $config['height'] = 200;
        $this->load->library('image_lib', $config); 
        $this->image_lib->resize();
    }

}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */