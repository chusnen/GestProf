<?php
defined("BASEPATH") OR exit("El acceso directo al script no está permitido!!!");
//la clase se escribe en singular, en cambio la tabla en plural
//debemos extender de datamapper
class Usuario extends DataMapper{
    //nombre de la tabla, es recomendable establecerlo
    //podemos llamarle usuarios o como queramos, pero de la misma forma que la tabla
    public $table = "usuario";

    //un usuario puede tener un tipo de usuario y un nif
    public $has_one = array("tipo","nif");

    //un usuario puede tener muchos cursos
    // public $has_many = array("curso");

    //validación de los campos de la tabla usuarios
    public $validation = array(
        'login' => array(
        'label' => 'login',
        'rules' => array('required', 'trim', 'unique', 'alpha_dash', 'min_length' => 3, 'max_length' => 15)
        ),
        'contraseña' => array(
        'label' => 'Contraseña',
        'rules' => array('required', 'min_length' => 6, 'max_length' => 15, 'encrypt')
        ),
        'email' => array(
        'label' => 'Dirección de email',
        'rules' => array('required', 'trim', 'valid_email')
        ),
        'tipo' => array(
        'label' => 'Tipo de Usuario',
        'rules' => array('required', 'trim')
        ));
    //validación para encriptar los passwords ofrecida por el m public function _encrypt($field)
    public function _encrypt($field){
        // Don't encrypt an empty string
        if (!empty($this->{$field})){
            // Generate a random salt if empty
            if (empty($this->salt)){
                $this->salt = md5(uniqid(rand(), true));
            }
            $this->{$field} = sha1($this->salt . $this->{$field});
        }
    }
}
/* End of file usuario.php */
/* Location: ./application/models/usuario.php */