<?php
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
    	$idusuario=$usuarioAutentificado->getId();
        $repositorioProfesional=$this->doctrine->em->getRepository('Entity\Profesional');
        $profesional=$repositorioProfesional->findOneByLogin($idusuario);
        $personas=$profesional->getIdpersonas();//obtengo el objeto personas
        $repositorioiva=$this->doctrine->em->getRepository('Entity\Iva');
        $ivas=$repositorioiva->findAll();
        if(is_null($usuarioAutentificado)){
            $this->load->view('header');        
            $this->load->view('container');
            //$this->load->view('navigator'); 
            // $this->load->view('content'); 
            $this->load->view('Ingreso/login');
            $this->load->view('footer');            
        }
        else{
            $repositorioFacturas=$this->doctrine->em->getRepository('Entity\Facturas'); 
            $facturaelegida=$repositorioFacturas->findOneBy(array('id' => $this->input->post('numero'),
                                                      'idprofesional' => $profesional->getIdprofesional()));
            echo $facturaelegida->getNumero();
            $detalle=new Entity\DetallesFactura;
            $detalle->setIdfactura($facturaelegida);
            $detalle->setDescripcion($this->input->post('descripcion'));
            $detalle->setPreciounitario($this->input->post('preciounitario'));
            $detalle->setCantidad($this->input->post('cantidad'));
            $detalle->setDescuento($this->input->post('descuento'));
            $detalle->setIdiva($repositorioiva->findOneByIdiva($this->input->post('iva')));
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
    public function enviar(){
        $email=$this->session->userdata('identity');         
        $repositorioUsers = $this->doctrine->em->getRepository('Entity\Users');
        $usuarioAutentificado = $repositorioUsers->findOneByEmail($email);
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
  
