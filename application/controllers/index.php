<?php 
session_start();
if ( ! defined('BASEPATH')) exit('No direc	t script access allowed');

class Index extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->layout->setLayout('template');
		$paginador=new Paginador();
	}

	public function index(){
		$this->layout->setTitle(' Gotcha Paintball ');
		$tipo_propiedad=$this->propiedades_model->get_tipo_propiedad();
		$estados=$this->propiedades_model->get_estados();
		$this->layout->view('index', compact('tipo_propiedad', 'estados'));
	}

	public function texto_cambiante(){

		// Busco el elemento seleccionado
		switch ($_POST['variable']) {
			case '1':
				echo "<font color='white'>Central Publicitaria<br>Para Profesionales Inmobiliarios</font>";
				break;
			case '2':
				echo "<font color='white'>Más de 100,000 propiedades<br>Más de 170,000 búsquedas mensuales</font>";
				break;
			case '3':
				echo "<font color='white'>Publica <font color='yellow'>GRATIS</font> todas tus propiedades<br>y llega a más clientes!</font>";
				break;
			case '4':
				echo "<font color='white'>Tenemos la propiedad que buscas<br>100% garantizado!</font>";
				break;
			case '5':
				echo "<font color='white'>Anúnciate <font color='#04B404'>Fácil</font>,<font color='#0080FF'> Rápido</font> y <font color='yellow'>Grátis</font>!</font>";
				break;
			case '6':
				echo "<font color='white'>Si no tenemos la propiedad que buscas,<br>Es que no existe!</font>";
				break;
		}

	}


	public function texto_cambiante_admin(){

		// Busco el elemento seleccionado
		switch ($_POST['variable']) {
			case '1':
				echo "Sabias que con InterHabita cada 20 segundos, alguien encuentra su casa, depto, oficina, bodega o local?";
				break;
			case '2':
				echo "Sabias que puedes ANUNCIAR GRATUITAMENTE , por tiempo ILIMITADO,  todas tus propiedades?";
				break;
			case '3':
				echo "Sabias que para vender una sola propiedad, esta debe ser vista en promedio por al menos 21 personas interesadas?";
				break;
			case '4':
				echo "Sabias que tenemos anuncios pagados para resaltar tus propiedades o productos asociados al Target?";
				break;
			case '5':
				echo "Portal inmobiliario con Altísimo trafico de clientes potenciales.";
				break;
			case '6':
				echo "Cada persona ve en nuestro portal un promedio de 20 propiedades , e invierte un promedio de  8 minutos en nuestro sitio.";
				break;
			case '7':
				echo "100,000 propiedades publicadas.";
				break;
			case '8':
				echo "Articulos de interés por expertos del medio.";
				break;

		}

	}


	public function info($pagina){

		$this->layout->setTitle(' Interhabita - Publicidad y Promoción en Internet para Profesionales Inmobiliarios ');
		$tipo_propiedad=$this->propiedades_model->get_tipo_propiedad();
		$estados=$this->propiedades_model->get_estados();
		$this->layout->view($pagina, compact('tipo_propiedad', 'estados'));

	}

	public function tipo_propiedad(){
		$tipoPropiedad=$this->propiedades_model->get_all_tipo_propiedad_por_tipo_operacion($_POST["operacion"]);
		echo "<option value=''>Propiedad</option>";
		foreach($tipoPropiedad as $tipo){
			echo "<option value='".$tipo->id_categoria."'>".$tipo->nombre."</option>";
		}
	}

	public function estados(){
		$estados=$this->propiedades_model->get_all_estados_por_tipo_propiedad_y_operacion($_POST["tipoPropiedad"], $_POST["operacion"]);
		echo "<option value=''>Ciudad/Estado</option>";
		foreach($estados as $est){
			echo "<option value='".$est->id_estado."'>".$est->nombre."</option>";
		}
	}

	public function delegaciones(){
		$delegaciones=$this->propiedades_model->get_all_delegaciones_por_id_estado($_POST["idEstado"]);
		echo "<option value=''>Del/Municipio</option>";
		foreach($delegaciones as $del){
			echo "<option value='".$del->id_delegaciones."'>".$del->nombre."</option>";
		}
		
	}

	public function delegaciones_publicar_anuncio(){
		$delegaciones=$this->propiedades_model->get_all_delegaciones_por_id_estado($_POST["idEstado"]);
		echo "<option value=''>Del/Municipio</option>";
		foreach($delegaciones as $del){
			echo "<option value='".$del->id_delegaciones."'>".$del->nombre."</option>";
		}
		
	}

	public function colonias(){
		$colonias=$this->propiedades_model->get_all_colonias_por_id_delegacion($_POST["idDelegacion"]);
		echo "<option value=''>Colonia</option>";
		foreach($colonias as $col){
			echo "<option value='".$col->id_colonias."'>".$col->nombre."</option>";
		}
		
	}

	public function colonias_publicar_anuncio(){
		$colonias=$this->propiedades_model->get_all_colonias_por_id_delegacion($_POST["idDelegacion"]);
		echo "<option value=''>Colonia</option>";
		foreach($colonias as $col){
			echo "<option value='".$col->id_colonias."'>".$col->nombre."</option>";
		}
		
	}

	

	public function busquedas(){

		//validaciones para el buscador
		$this->layout->setTitle(' Gotcha Paintball ');
		$estados=$this->propiedades_model->get_estados();
		$resultBusqueda=$this->propiedades_model->get_total_resultados_buscador();
		$this->paginador->paginacion_enlaces(count($resultBusqueda));
		//para obtener el nombre del tipo de propiedad seleccionado
		if(isset($_GET["tipoPropiedades"])){
			$nombreTipoPropiedad=$this->propiedades_model->get_tipo_propiedad_por_id($_GET["tipoPropiedades"]);
			$this->layout->view('busquedas', compact('tipo_propiedad', 'estados', 'resultBusqueda','nombreTipoPropiedad','numPaginas'));
		}else{
			$this->layout->view('busquedas', compact('tipo_propiedad', 'estados', 'resultBusqueda','numPaginas'));
		}
		
	}

	public function activacion($nombreMd5=null, $idUser=null){		

		$users=$this->usuarios_model->get_user_por_id($idUser);
			
		$nombreMd5Tabla=md5($users->nombre);

		$mensajeActivacion=$this->usuarios_model->activar_usuario($nombreMd5, $nombreMd5Tabla, $idUser);	

		$this->layout->setTitle('.: Interhabita - Home - Activacion de Cuenta :.');
		$tipo_propiedad=$this->propiedades_model->get_tipo_propiedad();
		$estados=$this->propiedades_model->get_estados();
		$this->layout->view('activar_usuario', compact('tipo_propiedad', 'estados', 'mensajeActivacion'));

	}


	public function recuperar_password(){

		//validaciones de campos del registro
		if($this->input->post("correoUsuario")==""){

			echo "Ingresa tu Email en el cuadro de texto";

			exit;
		}
		//validamos el correo electronico sea correcto
		$this->propiedades_model->valida_email($this->input->post("correoUsuario"));
		
		//validamos si el correo existe en la base de datos
		$userDatos=$this->usuarios_model->get_user_por_correo($this->input->post("correoUsuario"));

		if( count($userDatos) == 0 ){

			echo "EL Email ingresado no existe en nuestro sistema";

			exit;

		}

		$this->usuarios_model->recupera_password_usuario($userDatos->id_usuario, $userDatos->correo);
		
	}


	public function restablecer_password($sha1IdUsuario, $sha1Correo){

		$this->layout->setTitle(' Interhabita - Publicidad y Promoción en Internet para Profesionales Inmobiliarios - Restablecer Password ');
		$this->layout->view('restablecer_password', compact('sha1IdUsuario','sha1Correo'));

	}

	public function actualiza_password(){

		$this->usuarios_model->actualiza_password();

	}

	public function contactanos(){

		//validaciones 
		if($this->input->post('nombre')==""){

			echo "Ingresa tu Nombre, porfavor!!!";
			exit;

		}else
			if($this->input->post('correo')==""){

				echo "Ingresa tu Correo Eletrónico, porfavor!!!";
				exit;
		}else
			if($this->input->post('comentario')==""){

				echo "Ingresa tu Mensaje, porfavor!!!";
				exit;
		}

		//validamos el correo electronico sea correcto
		$this->propiedades_model->valida_email($this->input->post("correo"));

		$this->contacto_model->contactanos();

	}

	public function mis_colicitantes_sin_pagar($idUser){

		$this->usuarios_model->login_desde_email_anunciante($idUser);

		redirect('/solicitantes/index/spago');

	}



	public function cerrar_sesion(){

		$users=$this->usuarios_model->cerrar_sesion();

	}





}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */