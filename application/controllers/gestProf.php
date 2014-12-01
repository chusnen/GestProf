<?php
class GestProf extends CI_Controller {
   function index(){
      $this->load->view('header');
      $this->load->view('navigator');
      $this->load->view('container');      
      $this->load->view('footer');
   }
}
?>
