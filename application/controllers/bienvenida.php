<?php
class Bienvenida extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->library('Ion_auth');
		
	}
   public function index(){
  
   //	$valor = $this->session->flashdata($data['usuario']);
   	//echo $valor;
   	  $this->load->view('header');
      $this->load->view('container');
      if ($this->ion_auth->logged_in()){ 
      $this->load->view('navigator'); 
  }
     // $this->load->view('content');     
      $this->load->view('bienvenida');      
      $this->load->view('footer');
   }
}
?>
