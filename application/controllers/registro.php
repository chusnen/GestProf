<?php
class Registro extends CI_Controller {
   function index(){
      $this->load->view('header');
     // $this->load->view('navigator');
      $this->load->view('container'); 
     // $this->load->view('content'); 
      $this->load->view('Registro/registro');      
      $this->load->view('footer');
   }
}
?>
