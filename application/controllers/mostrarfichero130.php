<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mostrarfichero130 extends CI_Controller {

	function __construct(){
		parent::__construct();		
		$this->load->helper('url');
		//Cargo la libreria doctrine para poder usar la bd mapeada a objetos
		$this->load->library('doctrine');		
	}	
	
	function index(){
		$this->load->view('header');            
        $this->load->view('container');
		$this->load->view('navigator');
		$this->load->view('Modelos/mostrarpaginaeleccionfichero');
		$this->load->view('footer');   
	}
}
?>