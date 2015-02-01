<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Bienvenida extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->library('Ion_auth');
		
	}
  public function index(){  
    if($this->session->userdata('identity')!='admin@admin.com'){
   	  $this->load->view('header');
      $this->load->view('container');
      if ($this->ion_auth->logged_in()){ 
        $this->load->view('navigator'); 
      }
     // $this->load->view('content');     
      $this->load->view('bienvenida');      
      $this->load->view('footer');
    }
    else{
      $this->load->view('header');
      $this->load->view('container');
      $this->load->view('navigatoradministrador'); 
      $this->load->view('bienvenidaadministrador');      
      $this->load->view('footer');
    }
  }
}
/* Fin bienvanida.php */
/* Localizacion: ./application/controllers/bienvenida.php */
?>