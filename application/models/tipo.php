<?php
defined("BASEPATH") OR exit("El acceso directo al script no está permitido!!!");
//la clase se escribe en singular, en cambio la tabla en plural
//debemos extender de datamapper
class Tipo extends DataMapper
{
/*  function __construct(){
        // Llamar a la base de datos que será nuestro modelo
    $this->load->database();
  }*/
  //no hace falta en este caso, pero es una buena costumbre definir la propiedad table
  public $table = "tipousuario";
  //relación a muchos con usuarios, un tipo puede pertenecer a muchos usuarios
  public $has_many = array("usuario");
  public $validation = array(
    'idtipo' => array(
    'label' => 'IdTipo',
    'rules' => array('required', 'trim', 'unique', 'alpha_dash', 'min_length' => 1),
    ),
    'descripcion' => array(
    'label' => 'Descripcion',
    'rules' => array('required', 'trim', 'unique', 'alpha_dash', 'min_length' => 2, 'max_length' => 100),
    ));

    public function get_tipo($slug = FALSE){
        if ($slug === FALSE){
        }
        $query = $this->db->get('tipousuario');
        return $query->result_array();
        $query = $this->db->get_where('news', array('slug' => $slug));
        return $query->row_array();
    }
}
/* End of file tipo.php */
/* Location: ./application/models/tipo.php */