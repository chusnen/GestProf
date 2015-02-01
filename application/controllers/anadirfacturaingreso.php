<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Anadirfacturaingreso extends CI_Controller {
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
            //$this->load->view('content'); 
            $this->load->view('Ingreso/login');
            $this->load->view('footer');            
        }
        else{
            $detalles=new stdClass(); //creo el objeto detalles porque la primera vez esta vacio
            $repositorioiva=$this->doctrine->em->getRepository('Entity\Iva');
            $ivas=$repositorioiva->findAll();
            $repositorioprofesionales=$this->doctrine->em->getRepository('Entity\Profesional');
            $profesional=$repositorioprofesionales->findOneByLogin($usuarioAutentificado->getId());
            $repositorioClientes=$this->doctrine->em->getRepository('Entity\Clientes');
            $clientes=$repositorioClientes->findByIdprofesional($profesional->getIdprofesional());
            $data=array('detalles'=>$detalles,
                        'ivas'=>$ivas,
                        'clientes'=>$clientes);      
            $idusuario=$usuarioAutentificado->getId();
            $profesional=$repositorioprofesionales->findOneByLogin($idusuario);
            $personas=$profesional->getIdpersonas();//obtengo el objeto personas
            $clientes=$repositorioClientes->findByIdprofesional($profesional->getIdprofesional());
            $repositorioFacturas=$this->doctrine->em->getRepository('Entity\Facturas');           
            if(isset($_POST['enviar'])){               
                //creamos nuestras reglas de validación, https://ellislab.com/codeigniter/user-guide/libraries/form_validation.html#rulereference 
                //required=campo obligatorio||valid_email=validar correo||xss_clean=evitamos inyecciones de código
                $this->form_validation->set_rules('numero', 'Numero', 'required|xss_clean');
                $this->form_validation->set_rules('cliente', 'Cliente', 'required|xss_clean');
                $this->form_validation->set_rules('cliente', 'Cliente', 'callback_cliente_check');
                $this->form_validation->set_rules('fecha', 'Fecha', 'required|xss_clean');
                $this->form_validation->set_rules('numero', 'Numero', 'callback_numero_check');//llamamos a la funcion
                //que nos comprueba si el profesional tiene una factura con el mismo número     
                //comprobamos si los datos son correctos, el comodín %s nos mostrará el nombre del campo
                //que ha fallado 
                $this->form_validation->set_message('required', 'El  campo %s es requerido');
                $this->form_validation->set_message('valid_email', 'El campo %s no es válido');
                //si el formulario no pasa la validación lo devolvemos a la página
                //pero esta vez le mostramos los errores al lado de cada campo
                if($this->form_validation->run() == FALSE){
                    $this->load->view('header');            
                    $this->load->view('container');
                    $this->load->view('navigator'); 
                    //$this->load->view('content');
                    $this->load->view('Ingreso/factura',$data);
                    $this->load->view('footer');                       
                    //en caso de que la validación sea correcta cogemos las variables y las envíamos
                    //al modelo
                }
                else{
                    //Creo e objeto factura antes por que si no daría error la bd, si ya existe es porque lo he creado y existe en la bd por lo que
                    //sólo añado el detalle
                    $factura=new Entity\Facturas;
                    $factura->setNumero($this->input->post('numero'));
                    $factura->setDescripcion($this->input->post('descripcion'));
                    $factura->setIdprofesional($profesional);
                    $factura->setIdcliente($repositorioClientes->findOneByIdcliente($this->input->post('cliente')));
                    $factura->setFecha($this->input->post('fecha'));
                    // Guardamos el objeto factura en la base de datos
                    $this->doctrine->em->persist($factura);
                    $this->doctrine->em->flush();
                    $data=array('detalles'=>$detalles,
                        'ivas'=>$ivas,
                        'clientes'=>$clientes,
                        'numero'=>$factura->getId()); 
                    $this->load->view('header');            
                    $this->load->view('container');
                    $this->load->view('navigator'); 
                    // $this->load->view('content');
                    $this->load->view('Ingreso/anadirdetalle',$data);
                    $this->load->view('footer');       
                }
            }
            else{                    
                $this->load->view('header');            
                $this->load->view('container');
                $this->load->view('navigator'); 
                // $this->load->view('content');
                $this->load->view('Ingreso/factura',$data);
                $this->load->view('footer');          
            }
        }
    }
    //Funcion que nos valida el numero de factura le pasamos el numero de factura
    public function numero_check($numero) {
        if($numero==null){
            $this->form_validation->set_message('numero_check','El campo %s no puede estar vacío');
            return FALSE;
        }
        else{
            $email=$this->session->userdata('identity');         
            $repositorioUsers = $this->doctrine->em->getRepository('Entity\Users');
            $usuarioAutentificado = $repositorioUsers->findOneByEmail($email);
            $idusuario=$usuarioAutentificado->getId();
            $repositorioProfesional=$this->doctrine->em->getRepository('Entity\Profesional');
            $profesional=$repositorioProfesional->findOneByLogin($idusuario);
            $repositorioFacturas = $this->doctrine->em->getRepository('Entity\Facturas');
            // Buscamos si existe el email en la bd
            $numero = $repositorioFacturas->findOneBy(array('numero' => $numero,
                                                            'idproveedores' => NULL,
                                                            'idprofesional' => $profesional->getIdprofesional()));
            if($numero==null){
                //Si $numero está vacío es porque no lo ha encontrado una factura con el mismo numero
                //Importante se busca por numero y por idprofesional porque un profesional no puede tener
                //dos facturas cuyo numero sea igual
                return TRUE;
            }
            else{
                $this->form_validation->set_message('numero_check','El Número de factura ya está dado de alta');
                return FALSE;
            }
        }
    }
    public function cliente_check($cliente) {
        if($cliente==0){
            $this->form_validation->set_message('cliente_check','Tienes que seleccionar un cliente');
            return FALSE;
        }
        else{
            return TRUE;
        }
    }   
}
/* Fin anadirfacturaingreso.php */
/* Localizacion: ./application/controllers/anadirfacturaingreso.php */
?>