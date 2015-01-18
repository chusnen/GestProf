<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fichero303 extends CI_Controller {

	function __construct(){
		parent::__construct();		
		$this->load->helper('url');
		//Cargo la libreria doctrine para poder usar la bd mapeada a objetos
		$this->load->library('doctrine');
		$this->load->library('PHPExcel.php');		
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
        	if(isset($_POST['enviar']))
	        { 
	        	//creamos nuestras reglas de validación, https://ellislab.com/codeigniter/user-guide/libraries/form_validation.html#rulereference 
	            //required=campo obligatorio||valid_email=validar correo||xss_clean=evitamos inyecciones de código
	            $this->form_validation->set_rules('ano', 'ano', 'required|xss_clean|integer|exact_length[4]');
	            $this->form_validation->set_rules('trimestre', 'trimestre', 'required|xss_clean|is_natural_no_zero');
	            $this->form_validation->set_rules('trimestre', 'trimestre', 'callback_trimestre_check');    
	            //comprobamos si los datos son correctos, el comodín %s nos mostrará el nombre del campo
	            //que ha fallado 
	            $this->form_validation->set_message('required', 'El  %s es requerido');
	            $this->form_validation->set_message('integer', 'El campo %s tiene que ser un número entero');
	            $this->form_validation->set_message('exact_length', 'El Año no es válido');
	            $this->form_validation->set_message('is_natural_no_zero', 'El Trimestre tiene que ser una número entre 1 y 4');
	            //si el formulario no pasa la validación lo devolvemos a la página
	            //pero esta vez le mostramos los errores al lado de cada campo
	            if($this->form_validation->run() == FALSE){              
	                $this->load->view('header');            
	                $this->load->view('container');
	                $this->load->view('navigator'); 
	                //$this->load->view('content');
	                $this->load->view('Modelos/mostrarpaginaeleccionfichero');
	                $this->load->view('footer');  	                 
	                //en caso de que la validación sea correcta cogemos las variables y las envíamos
	                //al modelo
	            }
	            else{ 
	            	$repositorioprofesionales=$this->doctrine->em->getRepository('Entity\Profesional');
            		$profesional=$repositorioprofesionales->findOneByLogin($usuarioAutentificado->getId());                        
					$repositorioFacturas=$this->doctrine->em->getRepository('Entity\Facturas'); 
					$repositorioDetalles=$this->doctrine->em->getRepository('Entity\DetallesFactura');
					$repositorioIva=$this->doctrine->em->getRepository('Entity\Iva');
					//Dependiendo del año elegido y del trimestre conseguimos las fechas para escoger las facturas
					//que están entre las fechas indicadas.
					if ($this->input->post('trimestre')==1){
						$inicioTrimestre=$this->input->post('ano').'/01/01';
						$finTrimestre=$this->input->post('ano').'/03/31';
					}
					elseif ($this->input->post('trimestre')==2){
						$inicioTrimestre=$this->input->post('ano').'/04/01';
						$finTrimestre=$this->input->post('ano').'/06/30';
					}
					elseif ($this->input->post('trimestre')==3){
						$inicioTrimestre=$this->input->post('ano').'/07/01';
						$finTrimestre=$this->input->post('ano').'/09/30';
					}
					else{
						$inicioTrimestre=$this->input->post('ano').'/10/01';
						$finTrimestre=$this->input->post('ano').'/12/31';
					}
					//Generamos la consulta
					$nulo='NULL'; 
					$consulta=$this->doctrine->em->createQuery("SELECT factura FROM Entity\Facturas factura WHERE factura.idproveedores IS NULL and factura.fecha BETWEEN '".$inicioTrimestre."' and '".$finTrimestre."' and factura.idprofesional ='".$profesional->getIdprofesional()."'");
					//Guardamos todas las facturas de ingresos que cumplen dicha condicion 
					$facturasingresoelegidas = $consulta->getResult();
					//vamos sacando las bases, coutas y iva según el tipo de iva de cada factura
					$basesuperreducida=0;
					$basereducida=0;
					$basenormal=0;
					$coutasuperreducida=0;
					$coutareducida=0;
					$coutanormal=0;
					$ivasuperreducido=$repositorioIva->findOneByIdiva('1');
					$ivareducido=$repositorioIva->findOneByIdiva('2');
					$ivanormal=$repositorioIva->findOneByIdiva('3');
					foreach ($facturasingresoelegidas as $facturaingresoelegida) {
						$detalleselegidos=$repositorioDetalles->findByIdfactura($facturaingresoelegida->getId());
						foreach ($detalleselegidos as $detalleelegido) {
							if($detalleelegido->getIdiva()->getDescripcion()=="Super Reducido")
							{
								$basesuperreducida=$basesuperreducida+$detalleelegido->getBaseimponible();
								$coutasuperreducida=$coutasuperreducida+$detalleelegido->getCantidadiva();
							}
							elseif($detalleelegido->getIdiva()->getDescripcion()=="Reducido")
							{
								$basereducida=$basereducida+$detalleelegido->getBaseimponible();
								$coutareducida=$coutareducida+$detalleelegido->getCantidadiva();
							}
							elseif($detalleelegido->getIdiva()->getDescripcion()=="Normal")
							{
								$basenormal=$basenormal+$detalleelegido->getBaseimponible();
								$coutanormal=$coutanormal+$detalleelegido->getCantidadiva();
							}
						}
					}
					$coutadevengada=$coutasuperreducida+$coutareducida+$coutanormal;
					//ahora obtenemos los datos necesarios para el iva deducible
					$basededucible=0;
					$coutadeducible=0;
					$consulta=$this->doctrine->em->createQuery("SELECT factura FROM Entity\Facturas factura WHERE factura.idcliente IS NULL and factura.fecha BETWEEN '".$inicioTrimestre."' and '".$finTrimestre."' and factura.idprofesional ='".$profesional->getIdprofesional()."'");
                    //Guardamos todas las facturas de gastos que cumplen dicha condicion 
					$facturasgastoselegidas = $consulta->getResult();
					foreach ($facturasgastoselegidas as $facturagastoelegida) {
						$detalleselegidos=$repositorioDetalles->findByIdfactura($facturagastoelegida->getId());
						foreach ($detalleselegidos as $detalleelegido) {							
							$basededucible=$basededucible+$detalleelegido->getBaseimponible();
							$coutadeducible=$coutadeducible+$detalleelegido->getCantidadiva();							
						}
					}
					$total=$coutadevengada-$coutadeducible;
					if ($this->input->post('tipodocumento')==0){
						//Mandamos al navegador que genere un fichero de texto para que se guarde en el ordenador cliente
				        header('Content-type: text/plain');
						header("Content-Disposition: attachment; filename=\"303.303\"");
						//Vamos introduciendo en una cadena toda la codificacion del diseño de registro de hacienda
						$cadena="<T3030";
						$cadena.=$this->input->post('ano');
						$cadena.=$this->input->post('trimestre');
						$cadena.='T';
						$cadena.='0000>';
						$cadena.='<AUX>';
						$cadena.=str_repeat(' ',70);//70 espacios en blanco
						$cadena.='1.01';//Version del programa
						$cadena.=str_repeat(' ',4);//4 espacios en blanco
						$cadena.='76119212E';//Nif empresa de desarrollo
						$cadena.=str_repeat(' ',213);//213 espacios en blanco
						$cadena.='</AUX>';
						$pagina1='<T';
						$pagina1.='303';
						$pagina1.='01';
						$pagina1.='>';
						$pagina1.='N';//PI :El tipo de declaración puede ser: C (solicitud de compensación) D (devolución) G (cuenta corriente tributaria-ingreso) I (ingreso) N (sin actividad/resultado cero) V (cuenta corriente tributaria -devolución)
						$pagina1.=$profesional->getIdpersonas()->getNif();
						$pagina1.=str_pad($profesional->getIdpersonas()->getApellidos(),30);//Escribe el apellido rellenando de blanco por la derecha hasta 30 posiciones
						$pagina1.=str_pad($profesional->getIdpersonas()->getNombre(),15);//Escribe el apellido rellenando de blanco por la derecha hasta 30 posiciones
						//implemetar las preguntas de si esta inscrito y todo lo demas
						$pagina1.='2222';
						$pagina1.=str_repeat(' ',8);//implementar lo de concurso acreedores
						$pagina1.=' ';//implementar lo de concuso acreedores
						$pagina1.=' ';//implementar lo de concuso acreedores
						$pagina1.='2222';
						$pagina1.=$this->input->post('ano');
						$pagina1.=$this->input->post('trimestre');
						$pagina1.='T';
						$pagina1.=str_pad($basesuperreducida,17,STR_PAD_LEFT);//Escribe la baseimponible super reducida rellenando de ceros por la izquierda hasta 17 posiciones
						$pagina1.=str_pad($ivasuperreducido->getTipo(),5,STR_PAD_LEFT);////Escribe el iva super reducido rellenando de ceros por la izquierda hasta 5 posiciones
						$pagina1.=str_pad($coutasuperreducida,17,STR_PAD_LEFT);//Escribe la cuota super reducida rellenando de ceros por la izquierda hasta 17 posiciones
						$pagina1.=str_pad($basereducida,17,STR_PAD_LEFT);//Escribe la baseimponible  reducida rellenando de ceros por la izquierda hasta 17 posiciones
						$pagina1.=str_pad($ivareducido->getTipo(),5,STR_PAD_LEFT);////Escribe el iva  reducido rellenando de ceros por la izquierda hasta 5 posiciones
						$pagina1.=str_pad($coutareducida,17,STR_PAD_LEFT);//Escribe la cuota  reducida rellenando de ceros por la izquierda hasta 17 posiciones
						$pagina1.=str_pad($basenormal,17,STR_PAD_LEFT);//Escribe la baseimponible normal rellenando de ceros por la izquierda hasta 17 posiciones
						$pagina1.=str_pad($ivanormal->getTipo(),5,STR_PAD_LEFT);////Escribe el iva normal rellenando de ceros por la izquierda hasta 5 posiciones
						$pagina1.=str_pad($coutanormal,17,STR_PAD_LEFT);//Escribe la cuota normal rellenando de ceros por la izquierda hasta 17 posiciones
						$pagina1.=str_repeat('0',253);//implementar lo de adquisicion intracomunitarias de bienes
						$pagina1.=str_pad($coutadevengada,17,STR_PAD_LEFT);//Escribe la cuota total rellenando de ceros por la izquierda hasta 17 posiciones
						$pagina1.=str_pad($basededucible,17,STR_PAD_LEFT);//Escribe la base imponible deducible rellenando de ceros por la izquierda hasta 17 posiciones
						$pagina1.=str_pad($coutadeducible,17,STR_PAD_LEFT);//Escribe la cuota deducible rellenando de ceros por la izquierda hasta 17 posiciones
						$pagina1.=str_repeat('0',255);//Implementar lo de bienes de inversion
						$pagina1.=str_pad($coutadeducible,17,STR_PAD_LEFT);//Escribe el total cuota deducible rellenando de ceros por la izquierda hasta 17 posiciones
						$pagina1.=str_pad($coutadeducible,17,STR_PAD_LEFT);//Escribe el total cuota deducible rellenando de ceros por la izquierda hasta 17 posiciones
						$pagina1.=str_pad($total,17,STR_PAD_LEFT);//Escribe el total de la declaración rellenando de ceros por la izquierda hasta 17 posiciones
						$pagina1.=str_repeat(' ',582);//Reservado para hacienda
						$pagina1.=str_repeat(' ',13);//Reservado para hacienda
						$pagina1.='</T30301>';
						$cadena.=$pagina1;
						$cadena.=' </T3030';
						$cadena.=$this->input->post('ano');
						$cadena.=$this->input->post('trimestre');
						$cadena.='T0000>';
						print($cadena);
						$this->load->view('Modelos/Fichero');
					}
					else{
						$nombre=$profesional->getIdpersonas()->getApellidos();
						$nombre.=' ';
						$nombre.=$profesional->getIdpersonas()->getNombre();
						$objReader = new PHPExcel_Reader_Excel2007();
						// (file_exists($_SERVER["DOCUMENT_ROOT"] . 'Plantillasexcel/modelo130.xlsx')
						$objPHPExcel = $objReader->load('./Plantillasexcel/modelo303.xlsx');
						// Asignar hoja de calculo activa
						$objPHPExcel->setActiveSheetIndex(0);
						//Asignar los datos a las celdas
						$objPHPExcel->getActiveSheet()->setCellValue('I2', $this->input->post('ano'));
						$objPHPExcel->getActiveSheet()->setCellValue('N2', $this->input->post('trimestre'));
						$objPHPExcel->getActiveSheet()->setCellValue('A6', $profesional->getIdpersonas()->getNif());
						$objPHPExcel->getActiveSheet()->setCellValue('F6', $nombre);	
						$objPHPExcel->getActiveSheet()->setCellValue('F12', $basesuperreducida);
						$objPHPExcel->getActiveSheet()->setCellValue('F13', $basereducida);
						$objPHPExcel->getActiveSheet()->setCellValue('F14', $basenormal);
						$objPHPExcel->getActiveSheet()->setCellValue('J12', $ivasuperreducido->getTipo());
						$objPHPExcel->getActiveSheet()->setCellValue('J13', $ivareducido->getTipo());
						$objPHPExcel->getActiveSheet()->setCellValue('J14', $ivanormal->getTipo());
						$objPHPExcel->getActiveSheet()->setCellValue('N12', $coutasuperreducida);
						$objPHPExcel->getActiveSheet()->setCellValue('N13', $coutareducida);
						$objPHPExcel->getActiveSheet()->setCellValue('N14', $coutanormal);
						$objPHPExcel->getActiveSheet()->setCellValue('J26', $basededucible);
						$objPHPExcel->getActiveSheet()->setCellValue('N26', $coutadeducible);
						$objPHPExcel->getActiveSheet()->setCellValue('A77', $profesional->getIddelegacion()->getPoblacion());
						// redireccionamos la salida al navegador del cliente (Excel2007)
						header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
						header('Content-Disposition: attachment;filename="303.xlsx"');
						header('Cache-Control: max-age=0');		
						$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
						$objWriter->save('php://output');
						$this->load->view('Modelos/Fichero');		
					}
				}
			}
		}
	}
	public function trimestre_check($trimestre){
		if($trimestre<=0 || $trimestre>4){
			$this->form_validation->set_message('trimestre_check','El Trimestre debe ser un numero entre 1 y 4');
            return FALSE;
		}
		else{
			return TRUE;
		}
	}	
}
/* Fin fichero303.php */
/* Localizacion: ./application/controllers/fichero303.php */
?>