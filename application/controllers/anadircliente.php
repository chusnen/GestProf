<?php
class Anadircliente extends CI_Controller {
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
        $repositorioProvincia=$this->doctrine->em->getRepository('Entity\Provincia');
        $provincias=$repositorioProvincia->findAll();
        $data=array('provincias'=>$provincias);
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
	            $this->form_validation->set_rules('nif', 'nif', 'required|xss_clean');
	            $this->form_validation->set_rules('nombre', 'nombre', 'required|xss_clean');
	            $this->form_validation->set_rules('nif', 'nif', 'callback_nif_check');     
	            //comprobamos si los datos son correctos, el comodín %s nos mostrará el nombre del campo
	            //que ha fallado 
	            $this->form_validation->set_message('required', 'El  %s es requerido');
	            $this->form_validation->set_message('valid_email', 'El %s no es válido');
	            //si el formulario no pasa la validación lo devolvemos a la página
	            //pero esta vez le mostramos los errores al lado de cada campo
	            if($this->form_validation->run() == FALSE){
	               //redirect('ingreso/anadircliente',$data);	                
	                $this->load->view('header');            
	                $this->load->view('container');
	                $this->load->view('navigator'); 
	                //$this->load->view('content');
	                $this->load->view('Ingreso/anadircliente',$data);
	                $this->load->view('footer');  
	                 
	                //en caso de que la validación sea correcta cogemos las variables y las envíamos
	                //al modelo
	            }
	            else{                         
	                //Creo la persona
	                $personas=new Entity\Personas;
	                $personas->setNif($this->input->post('nif'));
	                $personas->setNombre($this->input->post('nombre'));
	                $personas->setApellidos($this->input->post('apellidos'));
	                $personas->setTelefono($this->input->post('telefono'));
	                $personas->setDireccion($this->input->post('direccion'));
	                $personas->setFax($this->input->post('fax'));
	                //obtengo el objeto provincia que he escogido en el select
	                $provincia=$repositorioProvincia->findOneByIdprovincia($this->input->post('provincia'));
	                $personas->setIdprovincia($provincia);
	                // Guardamos el objeto Persona en la base de datos
	                $this->doctrine->em->persist($personas);
	                     
	                //obtengo el id del profesional
	                $repositorioprofesionales=$this->doctrine->em->getRepository('Entity\Profesional');
	                $profesional=$repositorioprofesionales->findOneByLogin($usuarioAutentificado->getId());                
	                //Creo el cliente
	                $clientes=new Entity\Clientes;
	                $clientes->setIdpersona($personas);
	                $clientes->setIdprofesional($profesional);
	                $clientes->setContacto($this->input->post('contacto'));   
	                // Guardamos el objeto Persona en la base de datos
	                $this->doctrine->em->persist($clientes);    
	                    
	                //Volcamos los datos en la base de datos y limpiamos la caché
	                $this->doctrine->em->flush();           
	                //si el modelo hace la inserción en la base de datos nos devolverá a la siguiente url
	                //en la que según nuestro formulario debe mostrarse el mensaje de confirmación.
	                $this->load->view('header');            
	                $this->load->view('container');
	                $this->load->view('navigator'); 
	                // $this->load->view('content');
	                $this->load->view('Registro/enviado');  
	                $this->load->view('footer'); 
	            }   
	    	}
	    }       
    }
    //Comprobamos si el nif es valido y si existe en la base de datos
    public function nif_check($str) {
        if($str==null){
            $this->form_validation->set_message('nif_check','El campo %s no puede estar vacío');
            return FALSE;
        }
        else{
            $letra = substr($str, -1);
            $numeros = substr($str, 0, -1);
            $letraCorrecta=substr("TRWAGMYFPDXBNJZSQVHLCKE", $numeros%23, 1);
            if (strlen($letra) != 1 ){
                $this->form_validation->set_message('nif_check','No puede tener más de una letra');
                return FALSE;
            }
            elseif(strlen ($numeros) != 8){
                $this->form_validation->set_message('nif_check','El nif tiene que tener 8 números');
                return FALSE;
            }
            elseif ( strtolower($letraCorrecta) != strtolower($letra)){
                $this->form_validation->set_message('nif_check','La letra del %s no es válida, la correcta es '.$letraCorrecta);
                return FALSE;
            }            
            else{
                $repositorioPersonas = $this->doctrine->em->getRepository('Entity\Personas');
                // Buscamos si existe el email en la bd
                $nif = $repositorioPersonas->findOneByNif($str);
                if($nif==null){
                    //Si $usuario está vacío es porque no lo ha encontrado
                    return TRUE;
                }
                else{
                    $this->form_validation->set_message('nif_check','El Nif ya está dado de alta');
                    return FALSE;
                }
            }
        }
    } 
}