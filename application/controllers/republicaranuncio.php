<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Republicaranuncio extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->layout->setLayout('template');
	}

	public function activa($md5Propiedad, $md5IdPropiedad, $idPropiedad){

    	//extraemos los datos de la propiedad para comparar con los mandados por el enlace
    	$propiedad=$this->propiedades_model->get_propiedad_por_id($idPropiedad);

    	//valido que el nombre de la propiedad y el id_propiedad en md5 de la tabla sea igual al enviado por el enlace
    	if( $md5Propiedad == md5($propiedad->nombre) && $md5IdPropiedad == md5($propiedad->id_propiedad) ){

    		//republico el anuncio cambiando la fecha de publicacion y poniendo el estatus en 1 como activo
    		$this->propiedades_model->activa_desactiva_propiedad_actualiza_fecha_republicacion($idPropiedad, $status=1);

    		$this->layout->view('republicar_anuncio');

    	}

		

    }


}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */