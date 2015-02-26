<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Anunciar extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->layout->setLayout('template');
		if(!$this->session->userdata('login')){
			header("Location:".base_url());
		}
	}

	public function index(){
		$this->layout->setTitle(' Interhabita - Publicidad y Promoción en Internet para Profesionales Inmobiliarios - Publicar Anuncio ');
		//para llenar el select de tipo de propiedades
		$tipoPropiedad=$this->propiedades_model->get_tipo_propiedad();
		$estados=$this->propiedades_model->get_estados();
		$this->layout->view('index', compact('tipoPropiedad','estados'));

	}



	public function publicar_anuncio(){
		//validamos los campos que son requeridos no vengan vacios
		
		if($_POST["title"]==""){
            echo "Ingresa el Titulo de tu Anuncio";
            exit;
		}
		else
			if($_POST["precio"]==""){
            	echo "Porfavor Ingresa el Precio de tu Publicación";
            	exit;
		}else
			if($_POST["selectOperacion"]==""){
            	echo "Porfavor Selecciona el Tipo de Operación";
            	exit;
		}else
			if($_POST["selectTipoPropiedad"]==""){
            	echo "Porfavor Selecciona el Tipo de Propiedad";
            	exit;
		}else
			if($_POST["description"]==""){
            	echo "Porfavor Ingresa la Descripción";
            	exit;
		}else
			if($_POST["direccion"]==""){
            	echo "Porfavor Selecciona la Calle y Número de tu Propiedad";
            	exit;
		}else
			if($_POST["selectEstados"]==""){
            	echo "Porfavor Selecciona Ciudad/Estado de tu Propiedad";
            	exit;
		}
		else
			if($_POST["selectDelegaciones"]=="" or $_POST["selectDelegaciones"]=="Del/Municipios"){
            	echo "Porfavor Selecciona la Delegación de tu Propiedad";
            	exit;
		}
		else
			if($_POST["selectColonias"]=="" or $_POST["selectColonias"]=="Colonias"){
            	echo "Porfavor Selecciona la Colonia de tu Propiedad";
            	exit;
		}
	
		//ingreso los datos del registro en la tabla y recogo el ultimo id insertado
		$lastInsertId=$this->propiedades_model->ingresar_anuncio();
		
		$tipoPropiedad=$_POST["selectTipoPropiedad"];

		//redirigo por medio de javascript agregar imagenes de la propiedad
		?>
		<script>
		window.location="http://interhabita.com/anunciar/fotos_propiedades/"+<? echo $lastInsertId?>+"/"+<? echo $tipoPropiedad?>;
		</script>
		<?

	}


	public function fotos_propiedades($lastInsertId, $idTipoPropiedad){
		$this->layout->setTitle(' Interhabita - Publicidad y Promoción en Internet para Profesionales Inmobiliarios - Fotos Propiedades ');
		//para llenar el select de tipo de propiedades
		$tipoPropiedad=$this->propiedades_model->get_tipo_propiedad_por_id($idTipoPropiedad);
		$fotosPropiedades=$this->propiedades_model->get_all_fotos_propiedades($lastInsertId);

		$this->layout->view('fotos_propiedades', compact('lastInsertId','tipoPropiedad', 'idTipoPropiedad', 'fotosPropiedades'));
	}


	public function subir_imagenes_propiedades(){

		//tamaño máximo de la imagen a subir de 2Mb
		$max_size=2300000;

		//si no se eligio imagen redirigimos con el mensaje de error
		if($_FILES["imagen"]["tmp_name"]==""){

			$this->session->set_flashdata('imagenError', "Error: Selecciona una Imagen a Subir .gif | .jpg | .png | .jpeg");

			redirect('/anunciar/fotos_propiedades/'.$_POST["lastInsertId"]."/".$_POST["idTipoPropiedad"],'refresh');
			
		}else
			if($_FILES['imagen']['size']>$max_size){
    			
    			$this->session->set_flashdata('imagenError', "Error: La imagen a subir debe ser máximo de 2 Mb");
    			
    			redirect('/anunciar/fotos_propiedades/'.$_POST["lastInsertId"]."/".$_POST["idTipoPropiedad"],'refresh');
    	
    	}else{
			//primero subimos la imagen
			$error=NULL;
			$config['upload_path'] = './uploads/';
	        $config['allowed_types'] = 'gif|jpg|png|jpeg';
	        $config['max_size'] = '2000';//tamaño maximo a subir en las fotos
	        $config["overwrite"]=false;

	        $this->load->library('upload', $config);
	        if ( ! $this->upload->do_upload('imagen')){
	            $error = array('error' => $this->upload->display_errors());
	            $this->session->set_flashdata('ControllerMessage', $error["error"]); 
	            redirect('/anunciar/fotos_propiedades/');             			
	        }
	        if($error==null){
	            $ima = $this->upload->data();
	            $file_name = $ima['file_name'];
	        }

	        //redimensrioamos la imagen big
	        $this->create_thumbnail($file_name, $_POST["tipoPropiedad"]);

	        /*
	        $pathBig=$_POST["tipoPropiedad"]."/";
	        $this->img->rimg($file_name, array('width' => 450, 'height' => 250, 'alt' => $file_name, 'title' => $file_name), "", $pathBig);
	        */

	        //creo la imagen thumb
	        $pathThumb=$_POST["tipoPropiedad"]."/thumbs/";
	        $this->img->rimg($file_name, array('width' => 100, 'height' => 90, 'alt' => $file_name, 'title' => $file_name), "", $pathThumb);

	        //insertamos la imagen en la tabla
	        $fotoPath="uploads/".$_POST["tipoPropiedad"]."/".$file_name;
	        $fotoPathThumb="uploads/".$_POST["tipoPropiedad"]."/thumbs/".$file_name;
	        $this->propiedades_model->insert_foto_propiedades($fotoPath, $fotoPathThumb, $_POST["lastInsertId"]);

	        //al final borramos la imagen subida en la carpeta uploads
	        unlink('./uploads/'.$file_name);

	        $this->session->set_flashdata('message', "Se subio tu Imagen Correctamente");

	        redirect('/anunciar/fotos_propiedades/'.$_POST["lastInsertId"]."/".$_POST["idTipoPropiedad"],'refresh');

		}

     
	}


	
	//metodo para crear el tumbnail de la imagen subida
    public function create_thumbnail($filename, $carpeta){
    	//imagen normal
        $config['image_library'] = 'gd2';
        //CARPETA EN LA QUE ESTÁ LA IMAGEN A REDIMENSIONAR
        $config['source_image'] = './uploads/'.$filename;
        $config['create_thumb'] = TRUE;
        $config['maintain_ratio'] = TRUE;
        //CARPETA EN LA QUE GUARDAMOS LA IMAGEN
       	$config['new_image']='./uploads/'.$carpeta."/".$filename;
        $config['width'] = 900;
        $config['height'] = 670;
        $this->load->library('image_lib', $config);
        if ( ! $this->image_lib->resize())
			{
			    echo $this->image_lib->display_errors();
			}

    }
    


    public function establece_imagen_principal(){

    	
       	$this->propiedades_model->establece_imagen_principal();

    }


    public function elimina_imagen_propiedad($idPropiedad, $idFotosPropiedades, $idTipoPropiedad){

    	//primero borramos fisicamente la imagen de la carpeta uploads/propiedad
		$datosFoto=$this->propiedades_model->get_foto_por_id($idFotosPropiedades);
		
		//valido que la imagen a borrar no sea la principal
		if($datosFoto->principal==1){

			$this->session->set_flashdata('message', 'No puedes Eliminar la Imagen Principal');

			redirect('/anunciar/fotos_propiedades/'.$idPropiedad."/".$idTipoPropiedad,'refresh');

		}else{

			//borrado de imagen big
			if(!unlink("./".$datosFoto->path_foto)){

				echo "Hubo un error al eliminar el archivo";

			}
			//borrado de imagen thumb
			if(!unlink("./".$datosFoto->path_foto_thumb)){

				echo "Hubo un error al eliminar el archivo";

			}
			
			$this->propiedades_model->elimina_imagen_propiedad($idFotosPropiedades);

    		redirect('/anunciar/fotos_propiedades/'.$idPropiedad."/".$idTipoPropiedad,'refresh');
		}


    }


    public function finalizar_anuncio(){

    	$this->layout->view('finalizar_anuncio');

    }




}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

