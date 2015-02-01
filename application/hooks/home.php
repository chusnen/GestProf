<?php
if (!defined( 'BASEPATH')) exit('No direct script access allowed'); 
//comprobar si existe la sesión, si no existe siempre redirigirá al usuario al login, en el constructor lo que hacemos es instanciar el superobjeto de codeigniter con $this->ci =& get_instance();. 
class Home
{
    private $ci;
    public function __construct()
    {
        $this->ci =& get_instance();
        !$this->ci->load->library('session') ? $this->ci->load->library('session') : false;
        !$this->ci->load->helper('url') ? $this->ci->load->helper('url') : false;
    }    
 
    public function check_login()
    {
        if($this->ci->uri->segment(2) == 'login' && $this->ci->session->userdata('id') == true)
        {
 
            redirect(base_url('bienvenida'));
 
        }else if($this->ci->session->userdata('id') == false && $this->ci->uri->segment(2) != 'login')
        {
 
            redirect(base_url('auth/login'));
 
        }
    }
}
/*
/end hooks/home.php
*/