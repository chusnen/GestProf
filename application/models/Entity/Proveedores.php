<?php

namespace Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Proveedores
 */
class Proveedores
{
    /**
     * @var integer
     * @GeneratedValue(strategy="AUTO")
     */
    private $idproveedores;

    /**
     * @var string
     */
    private $contacto;

    /**
     * @var \Entity\Personas
     */
    private $idpersona;


    /**
     * Get idproveedores
     *
     * @return integer 
     */
    public function getIdproveedores()
    {
        return $this->idproveedores;
    }

    /**
     * Set contacto
     *
     * @param string $contacto
     * @return Proveedores
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
     * @return Proveedores
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
