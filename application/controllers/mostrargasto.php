<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Mostrargasto extends CI_Controller {
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
        //Si el usuario no identificado no existe me vuelvo a login      
        if(is_null($usuarioAutentificado)){
            $this->load->view('header');        
            $this->load->view('container');
            //$this->load->view('navigator'); 
            // $this->load->view('content'); 
            $this->load->view('Ingreso/login');
            $this->load->view('footer');            
        }
        //Si existe añado los datos a la base de datos, tengo que validar los campos del formulario
        else{
            if(isset($_POST['enviar'])){ 
                //Obtengo el numero de la factura
                $repositorioFacturas=$this->doctrine->em->getRepository('Entity\Facturas'); 
                $facturaelegida=$repositorioFacturas->findOneById($this->input->post('idfactura'));
                $repositorioFormaspago=$this->doctrine->em->getRepository('Entity\FormasPago');
                $repositorioTiposgasto=$this->doctrine->em->getRepository('Entity\TiposGasto');
                $formaspago=$repositorioFormaspago->findAll();
                $tiposgasto=$repositorioTiposgasto->findAll();
                //Le paso a la vista los datos de formas de pago y tipo de ingreso y el numero de la factura elegida
                $data=array('formaspago'=>$formaspago,
                            'tiposgasto'=>$tiposgasto,
                            'numero'=>$facturaelegida->getId());
                $this->load->view('header');                     
                $this->load->view('container');
                $this->load->view('navigator'); 
                // $this->load->view('content');
                $this->load->view('Gasto/anadirgasto',$data);
                $this->load->view('footer');       
            }
            else{
                $this->load->view('header');            
                $this->load->view('container');
                $this->load->view('navigator'); 
                // $this->load->view('content');
                $this->load->view('Ingreso/factura');
                $this->load->view('footer');          
            }
        }
    }
}
/* Fin mostrargasto.php */
/* Localizacion: ./application/controllers/mostrargasto.php */
?>