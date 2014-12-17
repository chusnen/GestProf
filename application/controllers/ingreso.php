<?php
class Ingreso extends CI_Controller {
	public function _construct(){
		parent::__construct();
        //Cargo la libreria doctrine para poder usar la bd mapeada a objetos
		$this->load->library('doctrine');
        //Cargo el helper form para trabajar con la ayuda de codeignier para formularios
		$this->load->helper('form');
	}
    function index(){
        // $personas=new Entity\Personas;
        // $profesional=new Entity\Profesional;
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
    }
    public function factura(){ 
        $this->load->view('header');            
        $this->load->view('container');
        $this->load->view('navigator'); 
        // $this->load->view('content');
        $this->load->view('Ingreso/factura');
        $this->load->view('footer');
    }
    public function detalle(){ 
        $this->load->view('header');            
        $this->load->view('container');
        $this->load->view('navigator'); 
        // $this->load->view('content');
        $this->load->view('Ingreso/detalle');
        $this->load->view('footer');
    }
    /*public function create(){
        //Compruebo que los datos del formulario se han enviado por post
   		if(isset($_POST['enviar']))
        {
            //creamos nuestras reglas de validación, https://ellislab.com/codeigniter/user-guide/libraries/form_validation.html#rulereference 
            //required=campo obligatorio||valid_email=validar correo||xss_clean=evitamos inyecciones de código
            $this->form_validation->set_rules('usuario', 'Usuario', 'required|xss_clean');
            $this->form_validation->set_rules('password', 'Contraseña', 'required|xss_clean');
            $this->form_validation->set_rules('confirmarpassword', 'Confirmar Contraseña', 'callback_confirmarpassword_check');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|xss_clean');
            $this->form_validation->set_rules('email', 'Email', 'callback_email_check');
            $this->form_validation->set_rules('nif', 'Nif', 'callback_nif_check');
            $this->form_validation->set_rules('nombre', 'Nombre', 'required|xss_clean');
            $this->form_validation->set_rules('apellidos', 'Apellidos', 'required|xss_clean');
            $this->form_validation->set_rules('actividad', 'Actividad', 'required|xss_clean');
            //comprobamos si los datos son correctos, el comodín %s nos mostrará el nombre del campo
            //que ha fallado 
            $this->form_validation->set_message('required', 'El  %s es requerido');
            $this->form_validation->set_message('valid_email', 'El %s no es válido');
            //si el formulario no pasa la validación lo devolvemos a la página
            //pero esta vez le mostramos los errores al lado de cada campo
            if($this->form_validation->run() == FALSE){
                $this->index();
                //en caso de que la validación sea correcta cogemos las variables y las envíamos
                //al modelo
            }
            else{                
         		$users=new Entity\Users;
                $users->setUsername($this->input->post('usuario'));
                $users->setPassword($this->input->post('password'));
                $users->setEmail($this->input->post('email'));
                // Guardamos el objeto Users en la base de datos
                $this->doctrine->em->persist($users);

                //Añado este usuario a la tabla userGroup como profesional (Sólo existe un administrador que soy yo) que controla a que grupo pertenece el usuario 				 
                //Antes tengo que crear un objeto del tipo grupo que me devuelve el grupo de profesionales
                $repositorioGroups = $this->doctrine->em->getRepository('Entity\Groups');
                $grupoProfesionales = $repositorioGroups->findOneById('2');
                $usersGroup=new Entity\UsersGroups;
		        $usersGroup->setGroup($grupoProfesionales);//pongo el grupo profesional por defecto
		        $usersGroup->setUser($users);
		        //Guardamos el objeto UsersGroup en la base de datos
            	$this->doctrine->em->persist($usersGroup);

                //Creo la persona
   		        $personas=new Entity\Personas;
                $personas->setNif($this->input->post('nif'));
                $personas->setNombre($this->input->post('nombre'));
                $personas->setApellidos($this->input->post('apellidos'));
                $personas->setTelefono($this->input->post('telefono'));
                $personas->setDireccion($this->input->post('direccion'));
                $personas->setFax($this->input->post('fax'));
                // Guardamos el objeto Persona en la base de datos
                $this->doctrine->em->persist($personas);

                //Creo al profesional
        		$profesional=new Entity\Profesional;
                $profesional->setActividad($this->input->post('actividad'));
                $profesional->setNccc($this->input->post('nccb'));
                $profesional->setIdpersonas($personas);
                $profesional->setLogin($users);        
                // Guardamos el objeto Profesional en la base de datos
            	$this->doctrine->em->persist($profesional);

                //Volcamos los datos en la base de datos y limpiamos la caché
            	$this->doctrine->em->flush();        	
                //si el modelo hace la inserción en la base de datos nos devolverá a la siguiente url
                //en la que según nuestro formulario debe mostrarse el mensaje de confirmación.
                $this->load->view('header');
                // $this->load->view('navigator');
                $this->load->view('container'); 
                // $this->load->view('content'); 
                $this->load->view('Registro/enviado');      
                $this->load->view('footer');
            }       
        }
    }
    //Función que me controla que las contraseñas sean iguales
    public function confirmarpassword_check($str){
        if($str==null){
            $this->form_validation->set_message('confirmarpassword_check', 'El campo %s no puede estar vacío');
            return FALSE; 
        }
        elseif ($str != $this->input->post('password'))
        {
            $this->form_validation->set_message('confirmarpassword_check', 'Las contraseñas no coinciden');
            return FALSE;
        }
        else
        {
            return TRUE;
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
    //Comprobamos si el usuario no existe en la base de dato mediante comprobacion del email
    public function email_check($str) {
        // Lo primero es obtener el repositorio
        // de la tabla usuario
        $repositorioUsers = $this->doctrine->em->getRepository('Entity\Users');
         
        // Buscamos si existe el email en la bd
        $usuario = $repositorioUsers->findOneByEmail($this->input->post('email'));
        if($usuario==null){
            //Si $usuario está vacío es porque no lo ha encontrado
            return TRUE;
        }
        else{
            $this->form_validation->set_message('email_check','El usuario ya está dado de alta ');
            return FALSE;
        }
    } */      
}
?>
