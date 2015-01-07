<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Charts extends CI_Controller {

	function __construct()
	{
		parent::__construct();
		
		$this->load->helper('url');
		//Cargo la libreria doctrine para poder usar la bd mapeada a objetos
		$this->load->library('doctrine');
		$this->load->library('highCharts.php');
		
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
        	
            $idusuario=$usuarioAutentificado->getId();
        	//$repositorioFacturas=$this->doctrine->em->getRepository('Entity\Facturas'); 
        	$repositorioProfesional=$this->doctrine->em->getRepository('Entity\Profesional');
            $profesional=$repositorioProfesional->findOneByLogin($idusuario);   
            //$data["datos"]=array('ingresos'=>$ingresos,
                       // 'gastos'=>$gastos);
			//$this->load->view('header');            
		   // $this->load->view('container');
		    //$this->load->view('navigator');
		    //echo json_encode($data);
		   	$data['charts'] = $this->getChart($profesional);
		    $this->load->view('charts',$data);
		   // $this->load->view('Registro/enviado');  
		    //$this->load->view('footer'); 		
		}
		
	}
	private function getChart($profesional) {
		$this->highcharts->set_type('column');
       
        $this->highcharts->set_dimensions(740, 300); 
        $this->highcharts->set_axis_titles('Comparativa', 'Euros');
       // $credits->href = base_url();
        //$credits->text = "Code 2 Learn : HighCharts";
        //$this->highcharts->set_credits($credits);
        $this->highcharts->render_to("content_top");

        //$result = $this->student_name->getStudentDetails($stuName);
        //$idusuario=$usuarioAutentificado->getId();
        $repositorioFacturas=$this->doctrine->em->getRepository('Entity\Facturas'); 
        	      
        //Muestro las facturas de ingresos que son las que el valor de proveedor es null
        $facturasingreso=$repositorioFacturas->findBy(array('idproveedores' => NULL,
                                                         'idprofesional' => $profesional->getIdprofesional()));
        //Muestro las facturas de gastos que son las que el valor de cliente es null
        $facturasgasto=$repositorioFacturas->findBy(array('idcliente' => NULL,
                                                         'idprofesional' => $profesional->getIdprofesional()));
        $ingresos=0;
        $gastos=0;
        foreach ($facturasingreso as $facturaingreso) {
            $ingresos=$ingresos+$facturaingreso->getTotal();
        }
        foreach ($facturasgasto as $facturagasto) {
            $gastos=$ingresos+$facturagasto->getTotal();
        }
        $categoria="Situacion";
        $this->highcharts->push_xcategorie($categoria);
       // $ingresos=99;
        //echo $ingresos;
        if ($ingresos<$gastos){
        	$this->highcharts->set_title('Perdidas');
        }
        else
        {
        	$this->highcharts->set_title('Beneficios');
        }
        $misdatos1=array($ingresos);
        $misdatos2=array($gastos);
        $serie1['data']=$misdatos1;
        $serie2['data']=$misdatos2;
        $this->highcharts->set_serie($serie1,'Ingresos');
        $this->highcharts->set_serie($serie2,'Gastos');
        return $this->highcharts->render();
	}
}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */