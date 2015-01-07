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
     * @var \Entity\Profesional
     */
    private $idprofesional;

    /**
     * @var \Entity\Personas
     */
    private $idpersona;


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
     * Set idprofesional
     *
     * @param \Entity\Profesional $idprofesional
     * @return Clientes
     */
    public function setIdprofesional(\Entity\Profesional $idprofesional = null)
    {
        $this->idprofesional = $idprofesional;
    
        return $this;
    }

    /**
     * Get idprofesional
     *
     * @return \Entity\Profesional 
     */
    public function getIdprofesional()
    {
        return $this->idprofesional;
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
