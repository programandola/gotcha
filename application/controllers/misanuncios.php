<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Misanuncios extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->layout->setLayout('template');
		if(!$this->session->userdata('login')){
			header("Location:".base_url());
		}
		$paginador=new Paginador();
	}

	public function index(){

		$this->layout->setTitle(' Interhabita - Publicidad y Promoción en Internet para Profesionales Inmobiliarios - Anuncios Publicados ');
		$misAnuncios=$this->propiedades_model->get_propiedades_por_id_usuario();	
		$numPaginas=$this->paginador->paginacion_enlaces(count($misAnuncios));
		$this->layout->view('index', compact('misAnuncios','numPaginas'));

	}


	public function edita_anuncio($idPropiedad){

		$this->layout->setTitle(' Interhabita - Publicidad y Promoción en Internet para Profesionales Inmobiliarios - Editar Anuncio ');
		$propiedad=$this->propiedades_model->get_propiedad_por_id($idPropiedad);
		//para llenar el select de tipo de propiedades
		$tipoPropiedad=$this->propiedades_model->get_tipo_propiedad();
		$estados=$this->propiedades_model->get_estados();
		$delegaciones=$this->propiedades_model->get_all_delegaciones_por_id_estado($propiedad->id_estado);
		$colonias=$this->propiedades_model->get_all_colonias_por_id_delegacion($propiedad->id_delegaciones);

		$this->layout->view('editar_anuncio', compact('propiedad','tipoPropiedad','estados','delegaciones','colonias'));

	}


	public function actualiza_anuncio(){
		
		//Validamos que los datos no vengan vacios
		if($_POST["titulo"]==""){
			echo 'Porfavor Ingresa el Titulo de tu Publicación';
            exit;
		}
		else
			if($_POST["precio"]==""){
				echo 'Porfavor Ingresa el Precio de tu Publicación';
            	exit;
		}else
			if($_POST["operacion"]==""){
				echo 'Porfavor Selecciona el Tipo de Operación';
            	exit;
		}else
			if($_POST["selectTipoPropiedad"]==""){
				echo 'Porfavor Selecciona el Tipo de Propiedad';
            	exit;
		}else
			if($_POST["description"]==""){
				echo 'Porfavor Ingresa la Descripción';
            	exit;
		}else
			if($_POST["direccion"]==""){
				echo 'Porfavor Selecciona la Dirección de tu Propiedad';
            	exit;
		}else
			if($_POST["selectEstados"]==""){
				echo 'Porfavor Selecciona el Estado de tu Propiedad';
            	exit;
		}
		else
			if($_POST["selectDelegaciones"]=="" or $_POST["selectDelegaciones"]=="Del/Municipios"){
				echo 'Porfavor Selecciona la Delegación de tu Propiedad';
            	exit;
		}
		else
			if($_POST["selectColonias"]=="" or $_POST["selectColonias"]=="Colonia"){
				echo 'Porfavor Selecciona la Colinia de tu Propiedad';
            	exit;
		}

		
		//actualizamos los datos en la tabla de propiedades
		$this->propiedades_model->actualiza_anuncio();

	}

	public function eliminar_anuncio($idPropiedad){

		//primero borramos las imagenes fisicamente de la carpeta desde el servidor para todas y cada una de las propiedades
		$idSolicArray=array();
		
		$fotosPropiedades=$this->propiedades_model->get_all_fotos_propiedades($idPropiedad);
		//ahora recorremos la tabla de fotos propiedades para extraer la ruta de las imagenes y borrarlas una a una
		//esto lo hacemos mediante un metodo llamado eliminar_imagen_propiedad_fisicamente
		foreach ($fotosPropiedades as $foto) {
			//borramos fotos grandes
			$this->propiedades_model->eliminar_imagen_propiedad_fisicamente($foto->path_foto);
			//borramos fotos thumbs
			$this->propiedades_model->eliminar_imagen_propiedad_fisicamente($foto->path_foto_thumb);
			//despues eliminamos el registro de la tabla fotos propiedades
			$this->propiedades_model->elimina_imagen_propiedad($foto->id_propiedades_fotos);
		}
		//recorro la tabla solicitantes_propiedades para cada una de las propiedades del anunciante 
		//y recogo el id_solicitante metiendo a un array
		$solicitantes=$this->solicitantes_model->get_solicitantes_por_id_propiedad($idPropiedad);
		foreach ($solicitantes as $sol) {
			$idSolicArray[]=$sol->id_solicitante;
		}
		//elimino de la tabla solicitantes propiedades a los interesados por medio de la propiedad
		$this->solicitantes_model->eliminar_solicitantes_propiedades_por_id_propiedad($idPropiedad);


		//elimino al solicitante siempre y cuando no este interesado en otra propiedad
		foreach ($idSolicArray as $idSolic) {
			$solicitante=$this->solicitantes_model->get_solicitantes_propiedades_por_id_solicitante($idSolic);
			if(count($solicitante)==0){//si no se encuentra el solicitante entonces borro de la tabla solicitantes al solicitante
				$this->solicitantes_model->eliminar_solicitante($idSolic);
			}
		}
	
		//despues eliminamos la propiedad del anunciante
		$this->solicitantes_model->eliminar_propiedad($idPropiedad);

		//redirecciono a mis anuncios
		$this->session->set_flashdata('delete', 'Propiedad Eliminada!!!');
		redirect('/misanuncios');
	}


}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

