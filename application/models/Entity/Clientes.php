<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Clientes
 */
class Clientes
{
    /**
     * @var integer
     */
    private $idcliente;

    /**
     * @var string
     */
    private $contacto;

    /**
     * @var \Entity\Personas
     */
    private $idpersona;


    /**
     * Set idcliente
     *
     * @param integer $idcliente
     * @return Clientes
     */
    public function setIdcliente($idcliente)
    {
        $this->idcliente = $idcliente;
    
        return $this;
    }

    /**
     * Get idcliente
     *
     * @return integer 
     */
    public function getIdcliente()
    {
        return $this->idcliente;
    }

    /**
     * Set contacto
     *
     * @param string $contacto
     * @return Clientes
     */
    public function setContacto($contacto)
    {
        $this->contacto = $contacto;
    
        return $this;
    }

    /**
     * Get contacto
     *
     * @return string 
     */
    public function getContacto()
    {
        return $this->contacto;
    }

    /**
     * Set idpersona
     *
     * @param \Entity\Personas $idpersona
     * @return Clientes
     */
    public function setIdpersona(\Entity\Personas $idpersona = null)
    {
        $this->idpersona = $idpersona;
    
        return $this;
    }

    /**
     * Get idpersona
     *
     * @return \Entity\Personas 
     */
    public function getIdpersona()
    {
        return $this->idpersona;
    }
}
