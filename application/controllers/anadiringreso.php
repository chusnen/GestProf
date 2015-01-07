<?php
class Anadiringreso extends CI_Controller {
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
        $repositorioFormaspago=$this->doctrine->em->getRepository('Entity\FormasPago');
        $repositorioTiposingreso=$this->doctrine->em->getRepository('Entity\TiposIngreso');
        $formaspago=$repositorioFormaspago->findAll();
        $tiposingreso=$repositorioTiposingreso->findAll();
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
            //Obtengo el numero de la factura
            $repositorioFacturas=$this->doctrine->em->getRepository('Entity\Facturas'); 
            $facturaelegida=$repositorioFacturas->findOneById($this->input->post('numero'));
            echo $facturaelegida->getNumero();   
            if(isset($_POST['enviar'])){ 
                    //Obtengo la forma de pago seleccionada y el tipo de ingreso
                    $formapagoelegida=$repositorioFormaspago->findOneByIdformapago($this->input->post('formapago'));
                    $tipoingresoelegido=$repositorioTiposingreso->findOneByIdtipoingreso($this->input->post('tipoingreso'));
                    //Creo un nuevo objeto cajas para guardarlo en la bd
                    $caja=new Entity\Cajas;
                    $caja->setFecha($this->input->post('fecha'));
                    $caja->setIdforma($formapagoelegida);
                    // Guardamos el objeto caja en la base de datos
                    $this->doctrine->em->persist($caja);
                    //Creo un nuevo objeto Ingreso para guardarlo en la bd
                    $ingreso=new Entity\Ingresos;
                    $ingreso->setIdcaja($caja);
                    $ingreso->setIdtipoingreso($tipoingresoelegido);
                    // Guardamos el objeto ingreso en la base de datos
                    $this->doctrine->em->persist($ingreso);

                    //Guardo en la tabla factura el id de caja en la factura elegida
                    $facturaelegida->setIdcaja($caja);
                    // Guardamos el objeto factura solo con el campo idcaja modificado en la base de datos
                    $this->doctrine->em->persist($facturaelegida);

                    $this->doctrine->em->flush();
                   
                    $idusuario=$usuarioAutentificado->getId();
                    $repositorioProfesional=$this->doctrine->em->getRepository('Entity\Profesional');
                    $profesional=$repositorioProfesional->findOneByLogin($idusuario);
                    $personas=$profesional->getIdpersonas();//obtengo el objeto personas
                    $repositorioFacturas=$this->doctrine->em->getRepository('Entity\Facturas');           
                    $facturas=$repositorioFacturas->findByIdprofesional($profesional->getIdprofesional());
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
                else{
                    //Si no se envian los datos por post vuelvo a mostarar la pantalla mostraringreso
                    $repositorioFormaspago=$this->doctrine->em->getRepository('Entity\FormasPago');
                    $repositorioTiposingreso=$this->doctrine->em->getRepository('Entity\TiposIngreso');
                    $formaspago=$repositorioFormaspago->findAll();
                    $tiposingreso=$repositorioTiposingreso->findAll();
                    $datamostraringreso= array('formaspago'=>$formaspago,
                            'tiposingreso'=>$tiposingreso,
                            'numero'=>$facturaelegida->getId());
                    $this->load->view('header');            
                    $this->load->view('container');
                    $this->load->view('navigator'); 
                    // $this->load->view('content');
                    $this->load->view('Ingreso/mostraringreso',$data);
                    $this->load->view('footer');          
                }
            }
        }
    }