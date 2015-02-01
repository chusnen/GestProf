<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mostrarcliente extends CI_Controller {
	public function _construct(){
		parent::__construct();
        //Cargo la libreria doctrine para poder usar la bd mapeada a objetos
		$this->load->library('doctrine');
        //Cargo el helper form para trabajar con la ayuda de codeignier para formularios
		$this->load->helper('form');
	}
    function index(){
    	$email=$this->session->userdata('identity');         
        $repositorioUsers = $this->doctrine->em->getRepository('Entity\Users');
        $usuarioAutentificado = $repositorioUsers->findOneByEmail($email);          
        //Compruebo que los datos del formulario se han enviado por post
        if(is_null($usuarioAutentificado)){
            $this->load->view('header');        
            $this->load->view('container');
            //$this->load->view('navigator'); 
            // $this->load->view('content'); 
            $this->load->view('Ingreso/login');
            $this->load->view('footer');            
        }
        else{
            $repositorioProvincia=$this->doctrine->em->getRepository('Entity\Provincia');
            $provincias=$repositorioProvincia->findAll();
            $data=array('provincias'=>$provincias);
            $this->load->view('header');            
            $this->load->view('container');
            $this->load->view('navigator'); 
            // $this->load->view('content');
            $this->load->view('Ingreso/anadircliente',$data);
            $this->load->view('footer'); 
        }
    }
}
/* Fin mostrarcliente.php */
/* Localizacion: ./application/controllers/mostrarcliente.php */
?>