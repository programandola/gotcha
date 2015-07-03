<?php session_start();
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Paypal extends CI_Controller {

	public function __construct(){
		parent::__construct();
		$this->layout->setLayout('template');
	}


	public function confirmacion_pago(){
		
		//se valida el pago mediante el script de paypal
		
		$this->layout->view("pago_paypal");


	}



}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */

