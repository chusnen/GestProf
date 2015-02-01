<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Anadirdetallegasto extends CI_Controller {
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
            //Compruebo que los datos del formulario se han enviado por post
            if(isset($_POST['anadir'])){
                 //Necesito tener los ivas, el numero de factura y los detalles para mostrarlos si hay un error de validación del formulario
                //para mandarselo a la vista    
                $repositorioiva=$this->doctrine->em->getRepository('Entity\Iva');
                $ivas=$repositorioiva->findAll();
                $repositorioProfesional=$this->doctrine->em->getRepository('Entity\Profesional');
                $profesional=$repositorioProfesional->findOneByLogin($usuarioAutentificado->getId());
                $repositorioFacturas=$this->doctrine->em->getRepository('Entity\Facturas'); 
                
                //Obtengo la factura que tengo que añadir los datalle mediante el usuario logeado y el numero de factura
                //enviado por mediante un campo hidden
                $facturaelegida=$repositorioFacturas->findOneBy(array('id' => $this->input->post('numero'),
                                                                      'idprofesional' => $profesional->getIdprofesional()));
                $repositorioDetalles=$this->doctrine->em->getRepository('Entity\DetallesFactura');
                $detalles=$repositorioDetalles->findByIdfactura($facturaelegida->getId());
                $data=array('detalles'=>$detalles,
                            'ivas'=>$ivas,
                            'numero'=>$facturaelegida->getId());
                //creamos nuestras reglas de validación, https://ellislab.com/codeigniter/user-guide/libraries/form_validation.html#rulereference 
                //required=campo obligatorio||valid_email=validar correo||xss_clean=evitamos inyecciones de código
                $this->form_validation->set_rules('descripcion', 'Descripcion', 'required|xss_clean|max_length[45]|');
                $this->form_validation->set_rules('preciounitario', 'Precio Unitario', 'required|xss_clean|max_length[13]|numeric');
                $this->form_validation->set_rules('cantidad', 'Cantidad', 'required|xss_clean|max_length[13]|numeric');
                $this->form_validation->set_rules('descuento', 'Descuento', 'xss_clean|max_length[13]|numeric');
                $this->form_validation->set_rules('descuento', 'Descuento', 'callback_descuento_check');    
                 $this->form_validation->set_rules('iva', 'Iva', 'callback_iva_check');    
                //comprobamos si los datos son correctos, el comodín %s nos mostrará el nombre del campo
                //que ha fallado 
                $this->form_validation->set_message('required', 'El  campo %s es requerido');
                $this->form_validation->set_message('numeric','El campo %s debe ser un número váildo, indicar los decimales con ,');
                $this->form_validation->set_message('max_length','Hay demasiados carácteres en el campo %s');
                //si el formulario no pasa la validación lo devolvemos a la página
                //pero esta vez le mostramos los errores al lado de cada campo
                if($this->form_validation->run() == FALSE){             
                    $this->load->view('header');            
                    $this->load->view('container');
                    $this->load->view('navigator'); 
                    //$this->load->view('content');
                    $this->load->view('Gasto/anadirdetalle',$data);
                    $this->load->view('footer');                         
                    //en caso de que la validación sea correcta cogemos las variables y las envíamos
                    //al modelo
                }
                else{ 
                    //Añado los detalles de la factura que estoy añadiendo
                    $detalle=new Entity\DetallesFactura;
                    $detalle->setIdfactura($facturaelegida);
                    $detalle->setDescripcion($this->input->post('descripcion'));
                    $detalle->setPreciounitario($this->input->post('preciounitario'));
                    $detalle->setCantidad($this->input->post('cantidad'));
                    $detalle->setDescuento($this->input->post('descuento'));
                    $detalle->setIdiva($repositorioiva->findOneByIdiva($this->input->post('iva')));
                    //Cálculo la $base imponible, el iva y el total dependiendo de si hay descuento o no
                    if($detalle->getDescuento()==null){
                        $baseimponible=($detalle->getPreciounitario()*$detalle->getCantidad());
                        $iva=$baseimponible*$detalle->getIdiva()->getTipo()/100;
                        $total=$baseimponible+$iva;
                    }
                    else{
                        $baseimponible=($detalle->getPreciounitario()*$detalle->getCantidad()-($detalle->getPreciounitario()*$detalle->getCantidad())*$detalle->getDescuento('descuento')/100);
                        $iva=$baseimponible*$detalle->getIdIva()->getTipo()/100;
                        $total=$baseimponible+$iva;
                    }
                    $detalle->setBaseimponible($baseimponible);
                    $detalle->setCantidadiva($iva);
                    $detalle->setTotal($total);
                    // Guardamos el objeto detalle en la base de datos
                    $this->doctrine->em->persist($detalle);
                    //Volcamos los datos en la base de datos y limpiamos la caché
                    $this->doctrine->em->flush();
                    $repositorioDetalles=$this->doctrine->em->getRepository('Entity\DetallesFactura');
                    $detalles=$repositorioDetalles->findByIdfactura($facturaelegida->getId());
                    //Mandamos los datos a las vista para que nos muestre los ivas, añada los detalles a la tabla
                    //y el id de factura para tenerlo disponible para poder enviarlo en un campo hidden
                    $data=array('detalles'=>$detalles,
                                'ivas'=>$ivas,
                                'numero'=>$facturaelegida->getId());
                    $this->load->view('header');            
                    $this->load->view('container');
                    $this->load->view('navigator'); 
                    // $this->load->view('content');
                    $this->load->view('Gasto/anadirdetalle',$data);
                    $this->load->view('footer');
                }
            }
        }
    }
    public function enviar(){
        $email=$this->session->userdata('identity');         
        $repositorioUsers = $this->doctrine->em->getRepository('Entity\Users');
        $usuarioAutentificado = $repositorioUsers->findOneByEmail($email);
         //Compruebo que el usuario existe
        if(is_null($usuarioAutentificado)){
            $this->load->view('header');        
            $this->load->view('container');
            $this->load->view('Ingreso/login');
            $this->load->view('footer');            
        }
        else{ 
            //Añado los totales en la tabla factura una vex que he añadido todo los detalles
            $idusuario=$usuarioAutentificado->getId();
            $repositorioProfesional=$this->doctrine->em->getRepository('Entity\Profesional');
            $profesional=$repositorioProfesional->findOneByLogin($idusuario);
            $personas=$profesional->getIdpersonas();//obtengo el objeto personas
            $repositorioFacturas=$this->doctrine->em->getRepository('Entity\Facturas');
            $facturaelegida=$repositorioFacturas->findOneBy(array('id' => $this->input->post('numero'),
                                                          'idprofesional' => $profesional->getIdprofesional()));
            $repositorioDetalles=$this->doctrine->em->getRepository('Entity\DetallesFactura');
            $detalles=$repositorioDetalles->findByIdfactura($this->input->post('numero'));
            $baseimponible=0;
            $cantidadiva=0;
            foreach ($detalles as $detalle ) {
               $baseimponible=$baseimponible+$detalle->getBaseimponible();
               $cantidadiva=$cantidadiva+$detalle->getCantidadIva();        
            }
            $total=$baseimponible+$cantidadiva;
            //modifico la factura elegida y le añado los detalles
            $facturaelegida->setBaseimponible($baseimponible);
            $facturaelegida->setIva($cantidadiva);
            $facturaelegida->setTotal($total);
            // Guardamos el objeto detalle en la base de datos
            $this->doctrine->em->persist($facturaelegida);
            //Volcamos los datos en la base de datos y limpiamos la caché
            $this->doctrine->em->flush();
            //Muestro las facturas de gastos que son las que el valor del cliente es null
            $facturas=$repositorioFacturas->findBy(array('idcliente' => NULL,
                                                         'idprofesional' => $profesional->getIdprofesional()));
            $data=array('facturas'=>$facturas,
                        'nombre'=>$personas->getNombre(),
                        'apellidos'=>$personas->getApellidos(),
                        'nif'=>$personas->getNif(),
                        'actividad'=>$profesional->getActividad());
            $this->doctrine->em->flush();
            $this->load->view('header');            
            $this->load->view('container');
            $this->load->view('navigator'); 
            // $this->load->view('content');
            $this->load->view('Gasto\gasto',$data);
            $this->load->view('footer');
        }
    }
    public function descuento_check($descuento) {
        if($descuento<0 || $descuento>100){
            $this->form_validation->set_message('descuento_check','Tienes que indicar una cantidad entre 0 y 100');
            return FALSE;
        }
        else{
            return TRUE;
        }
    }
    public function iva_check($iva) {
        if($iva==0){
            $this->form_validation->set_message('iva_check','Tienes que indicar un tipo de Iva');
            return FALSE;
        }
        else{
            return TRUE;
        }
    }      
}
/* Fin anadirdetallegasto.php */
/* Localizacion: ./application/controllers/anadirdetallegasto.php */
?>