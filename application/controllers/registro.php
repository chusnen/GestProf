<?php
class Registro extends CI_Controller {
	public function _construct(){
		parent::__construct();
		$this->load->library('doctrine');
		$this->load->helper('form');
	}
    function index(){
      $this->load->view('header');
     // $this->load->view('navigator');
      $this->load->view('container'); 
     // $this->load->view('content'); 
      $this->load->view('Registro/registro');      
      $this->load->view('footer');
    }
    public function create(){
   		//capturo los datos que me envian desde la vista
        $data = array(
         'usuario' => $this->input->post('usuario'),
         'email' => $this->input->post('email'),
         'password' => $this->input->post('password'),
         'confirmarpassword' => $this->input->post('confirmarpassword'),
         'nombre' => $this->input->post('nombre'),
         'apellidos' => $this->input->post('apellidos'),
         'nif' => $this->input->post('nif'),
         'telefono' => $this->input->post('telefono'),
         'direccion' => $this->input->post('direccion'),
         'actividad' => $this->input->post('actividad'),
         'nccb' => $this->input->post('nccb')
      );
		$users=new Entity\Users;
        $users->setUsername($this->input->post('usuario'));
        $users->setPassword($this->input->post('password'));
        $users->setEmail($this->input->post('email'));
  // Guardamos el objeto Users en la base de datos
        $this->doctrine->em->persist($users);
 				 

		echo "<b>Success1!</b>";
		echo $users->getId();
		// $usersGroup=new Entity\Groups;
		// $usersGroup->setid('2');//pongo el grupo member por defecto
		// $usersGroup->setUser($users);
		// // Guardamos el objeto UsersGroup en la base de datos
  //   	$this->doctrine->em->persist($usersGroup);

   		$personas=new Entity\Personas;
        $personas->setNif($this->input->post('nif'));
        $personas->setNombre($this->input->post('nombre'));
        $personas->setApellidos($this->input->post('apellidos'));
        $personas->setTelefono($this->input->post('telefono'));
        $personas->setDireccion($this->input->post('direccion'));
        $personas->setFax($this->input->post('fax'));
     // Guardamos el objeto Persona en la base de datos
        $this->doctrine->em->persist($personas);
	
		echo "<b>Success2!</b>";
		echo $personas->getId();   

		$profesional=new Entity\Profesional;
		//$profesional->setIdprofesional('1');
        $profesional->setActividad($this->input->post('actividad'));
        $profesional->setNccc($this->input->post('nccb'));
        $profesional->setIdpersonas($personas);
        $profesional->setLogin($users);
	
      
        
        // Guardamos el objeto Profesional en la base de datos
    	$this->doctrine->em->persist($profesional);
    	$this->doctrine->em->flush();    
    	echo "<b>Success3!</b>";   
    }
}
?>
