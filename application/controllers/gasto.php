<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Gasto extends CI_Controller {
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
        if(is_null($usuarioAutentificado)){
            $this->load->view('header');        
            $this->load->view('container');
            //$this->load->view('navigator'); 
            // $this->load->view('content'); 
            $this->load->view('Ingreso/login');
            $this->load->view('footer');            
        }
        else{
            $idusuario=$usuarioAutentificado->getId();
            $repositorioProfesional=$this->doctrine->em->getRepository('Entity\Profesional');
            $profesional=$repositorioProfesional->findOneByLogin($idusuario);
            $personas=$profesional->getIdpersonas();//obtengo el objeto personas
            $repositorioFacturas=$this->doctrine->em->getRepository('Entity\Facturas');           
            //Muestro las facturas de gastos que son las que el valor del cliente es null
            $facturas=$repositorioFacturas->findBy(array('idcliente' => NULL,
                                                         'idprofesional' => $profesional->getIdprofesional()));
            $data=array('nombre'=>$personas->getNombre(),
                        'apellidos'=>$personas->getApellidos(),
                        'nif'=>$personas->getNif(),
                        'actividad'=>$profesional->getActividad(),
                        'facturas'=>$facturas);
            $this->load->view('header');            
            $this->load->view('container');
            $this->load->view('navigator'); 
            // $this->load->view('content');
            $this->load->view('Gasto/gasto',$data);
            $this->load->view('footer');
        }
    }  
} 
/* Fin gasto.php */
/* Localizacion: ./application/controllers/gasto.php */      
<<<<<<< HEAD
?>
=======
?>

      

>>>>>>> 8011f33d8a051de6436db586be2a2cf87510dff8
