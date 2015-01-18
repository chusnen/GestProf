<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Fichero130 extends CI_Controller {

	function __construct(){
		parent::__construct();		
		$this->load->helper('url');
		//Cargo la libreria doctrine para poder usar la bd mapeada a objetos
		$this->load->library('doctrine');
	 	$this->load->library('clasefichero130');
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
	            	//$repositoriofacturas=$this->doctrine->em->getRepository('Entity\Facturas');
	            	$repositorioprofesionales=$this->doctrine->em->getRepository('Entity\Profesional');
            		$profesional=$repositorioprofesionales->findOneByLogin($usuarioAutentificado->getId());                        
					//Hacemos los calculos llamando a las funciones que he creado
                    if($this->input->post('trimestre')==1){
                    	$ingresoscomputables=$this->clasefichero130->calcularingresoscomputables('1',$this->input->post('ano'),$profesional->getIdprofesional());
                    	$gastoscomputables=$this->clasefichero130->calculargastoscomputables('1',$this->input->post('ano'),$profesional->getIdprofesional());
                    	$rendimientoneto=$ingresoscomputables-$gastoscomputables;
                    	$minoracion=$this->clasefichero130->minoracion($rendimientoneto);
                    	if($rendimientoneto<0){
                    		$porcentaje=0;
                    	}
                    	else{
                    	$porcentaje=$this->clasefichero130->porcentaje($rendimientoneto);
                    	}
                    	$resultadotrimestresanteriores=0;
                    	$pagofraccionado=$porcentaje-$resultadotrimestresanteriores;
                    	$total=$pagofraccionado-$minoracion;
                    	$resultadonegativotrimestreanteriores=0;
                    }
                    //fin 1er trimestre
                    elseif($this->input->post('trimestre')==2){
                    	$ingresoscomputables=$this->clasefichero130->calcularingresoscomputables('2',$this->input->post('ano'),$profesional->getIdprofesional());
                    	$gastoscomputables=$this->clasefichero130->calculargastoscomputables('2',$this->input->post('ano'),$profesional->getIdprofesional());
                    	$rendimientoprimertrimestre=$this->clasefichero130->calcularingresoscomputables('1',$this->input->post('ano'),$profesional->getIdprofesional())-$this->clasefichero130->calculargastoscomputables('1',$this->input->post('ano'),$profesional->getIdprofesional());
                    	$rendimientoneto=$ingresoscomputables-$gastoscomputables;
                    	$minoracion=$this->clasefichero130->minoracion($rendimientonetoprimertrimestre);
                    	if($rendimientoneto<0){
                    		$porcentaje=0;
                    	}
                    	else{
                    	$porcentaje=$this->clasefichero130->porcentaje($rendimientoneto);
                    	}
                    	$resultadotrimestresanteriores=$this->clasefichero130->porcentaje($rendimientoprimertrimestre);
                    	$pagofraccionado=$porcentaje-$resultadotrimestresanteriores;
                    	$total=$pagofraccionado-$minoracion;
                    	if ($resultadotrimestresanteriores-$minoracion<0){
                    		$resultadonegativotrimestreanteriores=$resultadotrimestresanteriores-$minoracion;
                    	}
                    	else{
                    		$resultadonegativotrimestreanteriores=0;
                    	}
                    }
                     //fin 2do trimestre
                    elseif($this->input->post('trimestre')==3){
                    	$ingresoscomputables=$this->clasefichero130->calcularingresoscomputables('3',$this->input->post('ano'),$profesional->getIdprofesional());
                    	$gastoscomputables=$this->clasefichero130->calculargastoscomputables('3',$this->input->post('ano'),$profesional->getIdprofesional());
                    	$rendimientoprimertrimestre=$this->clasefichero130->calcularingresoscomputables('1',$this->input->post('ano'),$profesional->getIdprofesional())-$this->clasefichero130->calculargastoscomputables('1',$this->input->post('ano'),$profesional->getIdprofesional());
                    	$rendimientosegundotrimestre=$this->clasefichero130->calcularingresoscomputables('2',$this->input->post('ano'),$profesional->getIdprofesional())-$this->clasefichero130->calculargastoscomputables('2',$this->input->post('ano'),$profesional->getIdprofesional());
                    	$rendimientoneto=$ingresoscomputables-$gastoscomputables;
                    	$minoracion=$this->clasefichero130->minoracion($rendimientonetoprimertrimestre);
                    	if($rendimientoneto<0){
                    		$porcentaje=0;
                    	}
                    	else{
                    	$porcentaje=$this->clasefichero130->porcentaje($rendimientoneto);
                    	}
                    	$resultadotrimestresanteriores=$this->clasefichero130->porcentaje($rendimientosegundotrimestre);
                    	$pagofraccionado=$porcentaje-$resultadotrimestresanteriores;
                    	$total=$pagofraccionado-$minoracion;
                    	if ($resultadotrimestresanteriores-$minoracion<0){
                    		$resultadonegativotrimestreanteriores=$resultadotrimestresanteriores-$minoracion;
                    	}
                    	else{
                    		$resultadonegativotrimestreanteriores=0;
                    	}
                    }
                    //fin 3er trimestre
                    else{
                    	$ingresoscomputables=$this->clasefichero130->calcularingresoscomputables('4',$this->input->post('ano'),$profesional->getIdprofesional());
                    	$gastoscomputables=$this->clasefichero130->calculargastoscomputables('4',$this->input->post('ano'),$profesional->getIdprofesional());
                    	$rendimientoprimertrimestre=$this->clasefichero130->calcularingresoscomputables('1',$this->input->post('ano'),$profesional->getIdprofesional())-$this->clasefichero130->calculargastoscomputables('1',$this->input->post('ano'),$profesional->getIdprofesional());
                    	$rendimientotercertrimestre=$this->clasefichero130->calcularingresoscomputables('3',$this->input->post('ano'),$profesional->getIdprofesional())-$this->clasefichero130->calculargastoscomputables('3',$this->input->post('ano'),$profesional->getIdprofesional());
                    	$rendimientoneto=$ingresoscomputables-$gastoscomputables;
                    	$minoracion=$this->clasefichero130->minoracion($rendimientoprimertrimestre);
                    	if($rendimientoneto<0){
                    		$porcentaje=0;
                    	}
                    	else{
                    	$porcentaje=$this->clasefichero130->porcentaje($rendimientoneto);
                    	}
                    	$resultadotrimestresanteriores=$this->clasefichero130->porcentaje($rendimientotercertrimestre);
                    	$pagofraccionado=$porcentaje-$resultadotrimestresanteriores;
                    	$total=$pagofraccionado-$minoracion;
                    	if ($resultadotrimestresanteriores-$minoracion<0){
                    		$resultadonegativotrimestreanteriores=$resultadotrimestresanteriores-$minoracion;
                    	}
                    	else{
                    		$resultadonegativotrimestreanteriores=0;
                    	}
                    }
                    //Comprobamos el tipo de declaración
                    if($pagofraccionado<0){
                    	$tipodeclaracion='N';
                    }
                    else
                    {
                    	$tipodeclaracion='I';
                    }
                    //Quitamos los acentos a las cadena
                    $apellidos=$this->clasefichero130->quitaracentos($profesional->getIdpersonas()->getApellidos());
                    $nombre=$this->clasefichero130->quitaracentos($profesional->getIdpersonas()->getNombre());
					$poblacion=$this->clasefichero130->quitaracentos($profesional->getIddelegacion()->getPoblacion());
					//Mandamos al navegador que genere un fichero de texto para que se guarde en el ordenador cliente
			        if ($this->input->post('tipodocumento')==0){
			        	header('Content-type: text/plain');
						header("Content-Disposition: attachment; filename=\"130.130\"");
						echo $resultadonegativotrimestreanteriores;
						//Vamos introduciendo en una cadena toda la codificacion del diseño de registro de hacienda
						$cadena='130';//Modelo
						$cadena.='01';//Número de página
						$cadena.=' ';//Una posicion en blanco
						$cadena.=$tipodeclaracion;// El tipo de declaración puede ser: B (resultado a deducir) G (cuenta corriente tributaria-ingreso) I (ingreso) N (negativa) U (domiciliación del ingreso en CCC)
						$cadena.=str_pad($profesional->getIddelegacion()->getIddelegacion(),5,STR_PAD_LEFT);////Escribe el iva super reducido rellenando de ceros por la izquierda hasta 5 posiciones
						$cadena.=$profesional->getIdpersonas()->getNif();
						$cadena.=substr(strtoupper($apellidos), 0, 4);//Cuatro primeras letras del apellido
						$cadena.=str_pad(strtoupper($apellidos),30);
						$cadena.=str_pad(strtoupper($nombre),15);
						$cadena.=$this->input->post('ano');
						$cadena.=$this->input->post('trimestre');
						$cadena.='T';
						$cadena.=str_pad($ingresoscomputables,13,STR_PAD_LEFT);
						$cadena.=str_pad($gastoscomputables,13,STR_PAD_LEFT);
						$cadena.=str_pad($rendimientoneto,13,STR_PAD_LEFT);
						$cadena.=str_pad($porcentaje,13,STR_PAD_LEFT);
						$cadena.=str_pad($resultadotrimestresanteriores,13,STR_PAD_LEFT);
						$cadena.=str_repeat('0',13);
						$cadena.=str_pad($pagofraccionado,13,STR_PAD_LEFT);
						$cadena.=str_repeat('0',52);
						$cadena.=str_pad($pagofraccionado,13,STR_PAD_LEFT);
						$cadena.=str_pad($minoracion,13,STR_PAD_LEFT);
						$cadena.=str_pad($total,13,STR_PAD_LEFT);
						$cadena.=str_repeat('0',26);
						$cadena.=str_pad($total,13,STR_PAD_LEFT);
						$cadena.=str_repeat('0',13);
						$cadena.=str_pad($total,13,STR_PAD_LEFT);
						$cadena.=str_pad($total,13,STR_PAD_LEFT);
						$cadena.=str_repeat('0',1);
						$cadena.=str_repeat(' ',20);
						$cadena.=str_repeat(' ',1);	
						$cadena.=str_repeat(' ',16);
						$cadena.=str_pad(strtoupper($nombre),100);
						$cadena.=str_pad($profesional->getIdpersonas()->getTelefono(),9);
						$cadena.=str_repeat(' ',350);
						$cadena.=str_pad(strtoupper($poblacion),16);
						$cadena.='01';
						$cadena.=str_pad('ENERO',10);
						$cadena.='2015';
						print($cadena);
						$this->load->view('Modelos/Fichero');
					}
					else{
						$nombre=$apellidos;
						$nombre.=' ';
						$nombre.=$profesional->getIdpersonas()->getNombre();
						// Cargando la hoja de cálculo
						//$ This-> load-> helper ('archivo');
						$objReader = new PHPExcel_Reader_Excel2007();
						// (file_exists($_SERVER["DOCUMENT_ROOT"] . 'Plantillasexcel/modelo130.xlsx')
						$objPHPExcel = $objReader->load('./Plantillasexcel/modelo130.xlsx');
						// Asignar hoja de calculo activa
						$objPHPExcel->setActiveSheetIndex(0);
						//Asignar los datos a las celdas
						$objPHPExcel->getActiveSheet()->setCellValue('M2', $this->input->post('ano'));
						$objPHPExcel->getActiveSheet()->setCellValue('T2', $this->input->post('trimestre'));
						$objPHPExcel->getActiveSheet()->setCellValue('B6', $profesional->getIdpersonas()->getNif());
						$objPHPExcel->getActiveSheet()->setCellValue('M6', $nombre);	
						$objPHPExcel->getActiveSheet()->setCellValue('B8', substr(strtoupper($apellidos), 0, 4));
						$objPHPExcel->getActiveSheet()->setCellValue('P14', $ingresoscomputables);
						$objPHPExcel->getActiveSheet()->setCellValue('P15', $gastoscomputables);
						$objPHPExcel->getActiveSheet()->setCellValue('P16', $rendimientoneto);
						$objPHPExcel->getActiveSheet()->setCellValue('P17', $porcentaje);
						$objPHPExcel->getActiveSheet()->setCellValue('P21', $resultadotrimestresanteriores);
						$objPHPExcel->getActiveSheet()->setCellValue('P26', $pagofraccionado);
						$objPHPExcel->getActiveSheet()->setCellValue('P41', $pagofraccionado);
						$objPHPExcel->getActiveSheet()->setCellValue('P42', $minoracion);
						$objPHPExcel->getActiveSheet()->setCellValue('P43', $total);
						if($total>0 and $total>=abs($resultadonegativotrimestreanteriores)){
							$objPHPExcel->getActiveSheet()->setCellValue('P45', abs($resultadonegativotrimestreanteriores));
						}
						else{
							$objPHPExcel->getActiveSheet()->setCellValue('P45', $total);
						}
						$objPHPExcel->getActiveSheet()->setCellValue('B72', $poblacion);
						// redireccionamos la salida al navegador del cliente (Excel2007)
						header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
						header('Content-Disposition: attachment;filename="130.xlsx"');
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
/* Fin fichero130.php */
/* Localizacion: ./application/controllers/fichero130.php */
?>