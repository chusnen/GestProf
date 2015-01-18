<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Login extends CI_Controller {
	public function __construct(){
		parent::__construct();		
	}
    function index(){
        $Usuario=new Tipo();
    	$data['tipo'] = $Usuario;
        $this->load->view('header');
        //$this->load->view('navigator');
        $this->load->view('container'); 
        $this->load->view('Registro/login',$data);        
        $this->load->view('footer');
    }
}
/* Fin login.php */
/* Localizacion: ./application/controllers/login.php */
?>