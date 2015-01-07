<?php
class Ingreso extends CI_Controller {
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
            //Muestro las facturas de ingresos que son las que el valor de proveedor es null
            $facturas=$repositorioFacturas->findBy(array('idproveedores' => NULL,
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
            $this->load->view('Ingreso/ingreso',$data);
            $this->load->view('footer');
        }
    }  
}       
?>

      

