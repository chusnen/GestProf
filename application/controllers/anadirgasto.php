<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Anadirgasto extends CI_Controller {
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
            $repositorioFormaspago=$this->doctrine->em->getRepository('Entity\FormasPago');
            $repositorioTiposgasto=$this->doctrine->em->getRepository('Entity\TiposGasto');
            $formaspago=$repositorioFormaspago->findAll();
            $tiposgasto=$repositorioTiposgasto->findAll(); 
            $repositorioFacturas=$this->doctrine->em->getRepository('Entity\Facturas');     
            if(isset($_POST['enviar'])){                
                //Obtengo el numero de la factura               
                $facturaelegida=$repositorioFacturas->findOneById($this->input->post('idfactura'));
                $data= array('formaspago'=>$formaspago,
                             'tiposgasto'=>$tiposgasto,
                             'numero'=>$facturaelegida->getId());
                //creamos nuestras reglas de validación, https://ellislab.com/codeigniter/user-guide/libraries/form_validation.html#rulereference 
                //required=campo obligatorio||valid_email=validar correo||xss_clean=evitamos inyecciones de código
                $this->form_validation->set_rules('fecha', 'Fecha', 'required|xss_clean');
                $this->form_validation->set_rules('formapago', 'Forma de Pago', 'required|xss_clean');
                $this->form_validation->set_rules('tipogasto', 'Tipo de gasto', 'required|xss_clean');
                $this->form_validation->set_rules('formapago', 'Forma de Pago', 'callback_formapago_check');
                $this->form_validation->set_rules('tipogasto', 'Tipo de gasto', 'callback_tipogasto_check');
                //comprobamos si los datos son correctos, el comodín %s nos mostrará el nombre del campo
                //que ha fallado 
                $this->form_validation->set_message('required', 'El  campo %s es requerido');
                //si el formulario no pasa la validación lo devolvemos a la página
                //pero esta vez le mostramos los errores al lado de cada campo
                if($this->form_validation->run() == FALSE){             
                    $this->load->view('header');            
                    $this->load->view('container');
                    $this->load->view('navigator'); 
                    //$this->load->view('content');
                    $this->load->view('Gasto/anadirgasto',$data);
                    $this->load->view('footer');                         
                    //en caso de que la validación sea correcta cogemos las variables y las envíamos
                    //al modelo
                }
                else{ 
                    //Obtengo la forma de pago seleccionada y el tipo de ingreso
                    $formapagoelegida=$repositorioFormaspago->findOneByIdformapago($this->input->post('formapago'));
                    $tipogastoelegido=$repositorioTiposgasto->findOneByIdtipogasto($this->input->post('tipogasto'));
                    //Creo un nuevo objeto cajas para guardarlo en la bd
                    $caja=new Entity\Cajas;
                    $caja->setFecha($this->input->post('fecha'));
                    $caja->setIdforma($formapagoelegida);
                    // Guardamos el objeto caja en la base de datos
                    $this->doctrine->em->persist($caja);
                    //Creo un nuevo objeto Ingreso para guardarlo en la bd
                    $gasto=new Entity\Gastos;
                    $gasto->setIdcaja($caja);
                    $gasto->setIdtipogasto($tipogastoelegido);
                    // Guardamos el objeto ingreso en la base de datos
                    $this->doctrine->em->persist($gasto);
                    //Guardo en la tabla factura el id de caja en la factura elegida
                    $facturaelegida->setIdcaja($caja);
                    // Guardamos el objeto factura solo con el campo idcaja modificado en la base de datos
                    $this->doctrine->em->persist($facturaelegida);
                    $this->doctrine->em->flush();
                    $idusuario=$usuarioAutentificado->getId();
                    $repositorioProfesional=$this->doctrine->em->getRepository('Entity\Profesional');
                    $profesional=$repositorioProfesional->findOneByLogin($idusuario);
                    $personas=$profesional->getIdpersonas();//obtengo el objeto personas         
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
            else{
                //Si no se envian los datos por post vuelvo a mostarar la pantalla mostraringreso
                //Obtengo el numero de la factura               
                $facturaelegida=$repositorioFacturas->findOneById($this->input->post('idfactura'));
                $data= array('formaspago'=>$formaspago,
                             'tiposgasto'=>$tiposgasto,
                             'numero'=>$facturaelegida->getId());
                $this->load->view('header');            
                $this->load->view('container');
                $this->load->view('navigator'); 
                // $this->load->view('content');
                $this->load->view('Gasto/anadirgasto',$data);
                $this->load->view('footer');          
            }
        }
    }
    public function formapago_check($formapago) {
        if($formapago==0){
            $this->form_validation->set_message('formapago_check','Tienes que seleccionar una forma de pago');
            return FALSE;

        }
        else{
            return TRUE;
        }

    }
    public function tipogasto_check($tipogasto) {
        if($tipogasto==0){
            $this->form_validation->set_message('tipogasto_check','Tienes que seleccionar un tipo de gasto');
            return FALSE;
        }
        else{
            return TRUE;
        }
    }   
}
/* Fin anadiingreso.php */
/* Localizacion: ./application/controllers/anadiringreso.php */
?>