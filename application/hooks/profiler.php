<?php
if (!defined('BASEPATH'))
exit('No direct script access allowed');
 
class Profiler_hook {
/*
* @params: ninguno
* @author: you
* @return void
* description:
* Permite la carga del profiler despues de que se cargue
* cualquier controlador a través de la configuración de hooks.
* Sólo se cargará en entornos de desarrollo mediante la BASE_URL_HOOK_PROFILER
* definida como constante.
*
*/
 

	private $ci;
    public function __construct()
    {
        $this->ci =& get_instance();
        !$this->ci->load->library('session') ? $this->ci->load->library('session') : false;
        !$this->ci->load->helper('url') ? $this->ci->load->helper('url') : false;
    }    
 
    public function check_login()
    {
        if($this->ci->session->userdata('login') == FALSE)
        {
            redirect(base_url(),'refresh');
        }
    }
 
}
?>