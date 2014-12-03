<?php
class Bienvenida extends CI_Controller {
   function index(){
      $this->load->view('header');
      $this->load->view('container'); 
      $this->load->view('navigator'); 
     // $this->load->view('content');     
      $this->load->view('bienvenida');      
      $this->load->view('footer');
   }
}
?>
