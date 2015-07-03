<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Anunciantes extends CI_Controller {

	public $varsPaginacion;

	public function __construct(){
		parent::__construct();
		$this->layout->setLayout('template');
		$paginador=new Paginador();
		$this->varsPaginacion=array();
		if(!$this->session->userdata('login')){
			header("Location:".base_url());
		}
	}

	public function index(){
		$this->layout->setTitle(' Interhabita - Publicidad y Promoción en Internet para Profesionales Inmobiliarios - Anunciantes ');
		//extraer todos los anunciantes
		$totalAnunciantes=$this->anunciantes_model->get_all_anunciantes();
		// paginacion de resultados 
		$this->paginador->paginacion_enlaces(count($totalAnunciantes));
		if(isset($_GET["pag"])){
			$this->paginador->inicio_limite_paginacion($_GET["pag"]);
		}else{
			$this->paginador->inicio_limite_paginacion($paginas=null);
		}
		//echo $this->paginador->configPaginador["paginas"];
		$anunciantes=$this->anunciantes_model->get_all_anunciantes_limite($this->paginador->configPaginador["limiteInicio"]);
		$this->varsPaginacion["url"]=base_url()."anunciantes";
		$this->varsPaginacion["pagination"]="index";
		$this->layout->view('index',compact('anunciantes','totalAnunciantes'));


	}

	public function nombre_asc(){

		//extraer todos los anunciantes
		$totalAnunciantes=$this->anunciantes_model->get_all_anunciantes_nombre_asc();
		// paginacion de resultados 
		$this->paginador->paginacion_enlaces(count($totalAnunciantes));
		if(isset($_GET["pag"])){
			$this->paginador->inicio_limite_paginacion($_GET["pag"]);
		}else{
			$this->paginador->inicio_limite_paginacion($paginas=null);
		}
		//echo $this->paginador->configPaginador["paginas"];
		$anunciantes=$this->anunciantes_model->get_all_anunciantes_nombre_asc_limite($this->paginador->configPaginador["limiteInicio"]);

		$this->layout->view('anunciantes',compact('anunciantes'));


	}

	public function fecha_asc(){

		//extraer todos los anunciantes por fecha ascendente
		$totalAnunciantes=$this->anunciantes_model->get_all_anunciantes_fecha_asc();
		// paginacion de resultados 
		$this->paginador->paginacion_enlaces(count($totalAnunciantes));
		if(isset($_GET["pag"])){
			$this->paginador->inicio_limite_paginacion($_GET["pag"]);
		}else{
			$this->paginador->inicio_limite_paginacion($paginas=null);
		}
		//echo $this->paginador->configPaginador["paginas"];
		$anunciantes=$this->anunciantes_model->get_all_anunciantes_fecha_asc_limite($this->paginador->configPaginador["limiteInicio"]);
		$this->layout->view('anunciantes',compact('anunciantes'));


	}

	public function desactivar($idUser){

		//desactivo el anunciante
		$this->anunciantes_model->activa_desactiva_anunciante($idUser, 0);

		$totalAnunciantes=$this->anunciantes_model->get_all_anunciantes();
		// paginacion de resultados 
		$this->paginador->paginacion_enlaces(count($totalAnunciantes));
		if(isset($_GET["pag"])){
			$this->paginador->inicio_limite_paginacion($_GET["pag"]);
		}else{
			$this->paginador->inicio_limite_paginacion($paginas=null);
		}
		//echo $this->paginador->configPaginador["paginas"];
		$anunciantes=$this->anunciantes_model->get_all_anunciantes_limite($this->paginador->configPaginador["limiteInicio"]);
		$this->varsPaginacion["url"]=base_url()."anunciantes";
		$this->varsPaginacion["pagination"]="index";
		$this->layout->view('anunciantes',compact('anunciantes','totalAnunciantes'));

	}

	public function activar($idUser){

		//activo el anunciante
		$this->anunciantes_model->activa_desactiva_anunciante($idUser, 1);

		$totalAnunciantes=$this->anunciantes_model->get_all_anunciantes();
		// paginacion de resultados 
		$this->paginador->paginacion_enlaces(count($totalAnunciantes));
		if(isset($_GET["pag"])){
			$this->paginador->inicio_limite_paginacion($_GET["pag"]);
		}else{
			$this->paginador->inicio_limite_paginacion($paginas=null);
		}
		//echo $this->paginador->configPaginador["paginas"];
		$anunciantes=$this->anunciantes_model->get_all_anunciantes_limite($this->paginador->configPaginador["limiteInicio"]);
		$this->varsPaginacion["url"]=base_url()."anunciantes";
		$this->varsPaginacion["pagination"]="index";
		$this->layout->view('anunciantes',compact('anunciantes','totalAnunciantes'));
		
	}

	public function buscar_anunciante_nombre(){

		//metodo para buscar anunciantes por nombre
		$totalAnunciantes=$this->anunciantes_model->get_all_anunciantes_por_nombre();
		// paginacion de resultados 
		$this->paginador->paginacion_enlaces(count($totalAnunciantes));
		if(isset($_POST["pag"])){
			$this->paginador->inicio_limite_paginacion($_POST["pag"]);
		}else{
			$this->paginador->inicio_limite_paginacion($paginas=null);
		}
		$this->varsPaginacion["url"]=base_url()."anunciantes/buscar_anunciante_nombre";
		$this->varsPaginacion["pagination"]="nombre";
		$this->varsPaginacion["anunciante"]=$_POST["nombre"];
		$anunciantes=$this->anunciantes_model->get_all_anunciantes_por_nombre_limite($this->paginador->configPaginador["limiteInicio"]);
		$this->layout->view('anunciantes',compact('anunciantes','totalAnunciantes'));

	}

	public function buscar_anunciantes_por_fechas(){

		//metodo para buscar anunciantes por fechas
		$totalAnunciantes=$this->anunciantes_model->get_all_anunciantes_por_fechas();
		// paginacion de resultados 
		$this->paginador->paginacion_enlaces(count($totalAnunciantes));
		if(isset($_POST["pag"])){
			$this->paginador->inicio_limite_paginacion($_POST["pag"]);
		}else{
			$this->paginador->inicio_limite_paginacion($paginas=null);
		}
		
		$anunciantes=$this->anunciantes_model->get_all_anunciantes_por_fechas_limite($this->paginador->configPaginador["limiteInicio"]);
		$this->varsPaginacion["url"]=base_url()."anunciantes/buscar_anunciantes_por_fechas";
		$this->varsPaginacion["pagination"]="fecha";
		$this->varsPaginacion["fechaDe"]=$_POST["fechaDe"];
		$this->varsPaginacion["fechaA"]=$_POST["fechaA"];
		$this->layout->view('anunciantes',compact('anunciantes','totalAnunciantes'));

	}

	public function buscar_anunciantes_estado(){

		//metodo para buscar anunciantes por estado
		$estado=$this->propiedades_model->get_id_estado_por_nombre($_POST["estado"]);
		if(count($estado)==0){
			echo "<h2>No se econtraron resultados</h2>"."<br>";
			echo '<a href="'.base_url().'anunciantes"><< Regresar</a>';
			exit;
		}
		$totalAnunciantes=$this->anunciantes_model->get_all_anunciantes_por_id_estado($estado->id_estado);
		// paginacion de resultados 
		$this->paginador->paginacion_enlaces(count($totalAnunciantes));
		if(isset($_POST["pag"])){
			$this->paginador->inicio_limite_paginacion($_POST["pag"]);
		}else{
			$this->paginador->inicio_limite_paginacion($paginas=null);
		}
		
		$anunciantes=$this->anunciantes_model->get_all_anunciantes_estado_limite($this->paginador->configPaginador["limiteInicio"], $estado->id_estado);
		$this->varsPaginacion["url"]=base_url()."anunciantes/buscar_anunciantes_estado";
		$this->varsPaginacion["pagination"]="estado";
		$this->varsPaginacion["estado"]=$_POST["estado"];
		$this->layout->view('anunciantes',compact('anunciantes','totalAnunciantes'));

	}

	public function llena_formu_anunciantes(){
		$this->layout->setTitle(' Interhabita - Publicidad y Promoción en Internet para Profesionales Inmobiliarios - Add Anunciantes ');
		$this->layout->view('formu_anunciantes');

	}

	public function add_anunciantes(){

		//validaciones de campos del registro
		if($_POST["nombre"]==""){
			echo "El campo nombre es Obligatorio";
			exit;
		}
		else
			if($_POST["apellidos"]==""){
				echo "El campo Apellidos es Obligatorio";
				exit;

		}
		else
			if($_POST["correo"]==""){
				echo "El campo Correo es Obligatorio";
				exit;

		}
		else
			if($_POST["pass"]==""){
				echo "El campo Password es Obligatorio";
				exit;

		}else
			if($_POST["c-pass"]==""){
				echo "El campo Confirmar Password es Obligatorio";
				exit;

		}else
			if($_POST["comboEstado"]==""){
				echo "Selecciona tu Estado";
				exit;

		}else
			if($_POST["comboAnunciante"]==""){
				echo "Selecciona el tipo de Anunciante";
				exit;

		}


		if($_POST["pass"] != $_POST["c-pass"]){
			echo "Los Passwords no coinciden, reintentar";
			exit;
		}

		//validamos si se eligio en tipo de anunciante agencia inmobiliaria ó constructor si es asi validamos que el campo empresa no venga vacio
		if($_POST["comboAnunciante"]==2 || $_POST["comboAnunciante"]==3){

			if($_POST["empresa"]==""){

				echo "Ingresa el nombre de tu Empresa Inmobiliaria";
				exit;

			}

		}

		//valida la longitud del password que sea mínimo 6 caracteres
		if(strlen($this->input->post('pass'))< 6){
			echo "Tú password debe tener mínimo 6 caracteres";
			exit;
		}

		//valido el correo que sea el formato correcto desde php
		$this->propiedades_model->valida_email($this->input->post('correo'));

		//se valida si la cuenta de correo ya existe
		$this->usuarios_model->valida_correo_registro($this->input->post('correo'));

		//si todo fue bien agregamos al anunciante
		$this->anunciantes_model->add_anunciantes();
		
		//mando mensaje en pantalla todo ok
		echo "Se agrego el anunciante correctamente";

	}

	
	public function eliminar_anunciante($idUser){

		//primero borramos las imagenes fisicamente de la carpeta desde el servidor para todas y cada una de las propiedades
		//extraemos todas las propiedades del usuario
		$propiedades=$this->propiedades_model->get_propiedades_por_id_usuario_para_root($idUser);
		$idSolicArray=array();
		foreach ($propiedades as $value) {
			$fotosPropiedades=$this->propiedades_model->get_all_fotos_propiedades($value->id_propiedad);
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
			$solicitantes=$this->solicitantes_model->get_solicitantes_por_id_propiedad($value->id_propiedad);
			foreach ($solicitantes as $sol) {
				$idSolicArray[]=$sol->id_solicitante;
			}
			//elimino de la tabla solicitantes propiedades a los interesados por medio de la propiedad
			$this->solicitantes_model->eliminar_solicitantes_propiedades_por_id_propiedad($value->id_propiedad);


		}

		//elimino al solicitante siempre y cuando no este interesado en otra propiedad
		foreach ($idSolicArray as $idSolic) {

			$solicitante=$this->solicitantes_model->get_solicitantes_propiedades_por_id_solicitante($idSolic);
			if(count($solicitante)==0){//si no se encuentra el solicitante entonces borro de la tabla solicitantes al solicitante
				$this->solicitantes_model->eliminar_solicitante($idSolic);
			}

		}
		
		//eliminamos si existe la empresa del anunciante
		$empresa=$this->usuarios_model->get_empresa_anunciante_por_id_usuario($idUser);
		if(count($empresa)>0){
			$this->solicitantes_model->eliminar_empresa_anunciante($idUser);
		}
		//eliminamos al usuario del boletin si existe
		$boletin=$this->anunciantes_model->get_user_boletin_por_id($idUser);
		if(count($boletin)>0){
			$this->anunciantes_model->eliminar_usuario_boletin($idUser);
		}
		//despues eliminamos las propiedades del anunciante
		$this->solicitantes_model->eliminar_propiedades_anunciante($idUser);
		//al final eliminamos el anunciante
		$this->usuarios_model->eliminar_anunciante($idUser);

		//redirecciono a anunciantes index
		$this->session->set_flashdata('anunciante', 'Anunciante Eliminado!!!');
		redirect('/anunciantes/index');

	}



	

}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

