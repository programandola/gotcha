<?php if ( ! defined('BASEPATH') ) exit('No direct script access allowed');
class Paginador {
	//propiedades
	public $configPaginador;

	public function __construct(){
		$this->configPaginador=array();
		//numero de registros a mostrar por pagina
		$this->configPaginador["reg_x_pagina"]=10;
		
	}


	//retorna el numero de paginas a mostrar para la paginación de resultados
	public function paginacion_enlaces($total_registros){

		$this->configPaginador["paginas"]=ceil($total_registros/$this->configPaginador["reg_x_pagina"]);

	}

	public function inicio_limite_paginacion($paginaActual=null){

		if(!empty($paginaActual)){
			$this->configPaginador["paginaActual"]=$paginaActual;
			$this->configPaginador["limiteInicio"]=($paginaActual-1)*$this->configPaginador["reg_x_pagina"];
		}else{
			$this->configPaginador["paginaActual"]=1;
			$this->configPaginador["limiteInicio"]=0;
		}

	}

	public function rango_paginacion($limite, $totalPaginas, $paginaSeleccionada){
		if($limite && is_numeric($limite)){
			$limte=$limite;
		}else{
			$limite=10;
		}

		$rango=ceil($limite/2);
		$rango_derecho=$totalPaginas-$paginaSeleccionada;
		$paginas=array();

		if($rango_derecho < $rango){
			$resto=$rango-$rango_derecho;
		}else{
			$resto=0;
		}

		$rango_izquierdo=$paginaSeleccionada - ($rango+$resto);

		for($i=$paginaSeleccionada; $i>$rango_izquierdo; $i--){
			if($i==0){
				break;
			}
			$paginas[]=$i;
		}

		sort($paginas);

		if($paginaSeleccionada < $rango){
			$rango_derecho=$limite;
		}else{
			$rango_derecho = $paginaSeleccionada + $rango;
		}
		for($i=$paginaSeleccionada+1; $i < $rango_derecho; $i++){
			if($i>$totalPaginas){
				break;
			}
			$paginas[]=$i;
		}
		return $paginas;
	}

}  
?>