<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mostrargraficos extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->helper('url');
		//Cargo la libreria doctrine para poder usar la bd mapeada a objetos
		$this->load->library('doctrine');
				
	}	
	
	function index()
	{
		$email=$this->session->userdata('identity');         
        $repositorioUsers = $this->doctrine->em->getRepository('Entity\Users');
        $usuarioAutentificado = $repositorioUsers->findOneByEmail($email);       
        if(is_null($usuarioAutentificado)){
            $this->load->view('header');        
            $this->load->view('container');
            //$this->load->view('navigator'); 
            //$this->load->view('content'); 
            $this->load->view('Ingreso/login');
            $this->load->view('footer');            
        }
        else{
        	
            $this->load->view('header');            
		   	$this->load->view('container');
		    $this->load->view('navigator');       
		    $this->load->view('Graficos/menugraficos');
		   // $this->load->view('Registro/enviado');  
		    $this->load->view('footer'); 		
		}		
	}
}
?>